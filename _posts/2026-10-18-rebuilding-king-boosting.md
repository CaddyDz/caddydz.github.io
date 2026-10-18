---
layout: blog
title: "Case study: auditing and rebuilding King Boosting, an order marketplace from 2020"
date: 2026-10-18
thumbnail: "/assets/img/kingboosting.png"
categories: case-study
---
In 2020–2021 I led a small team that built King Boosting, an order marketplace with four roles and money at every step. In 2026 I audited my own code, found holes that leaked customer data, and rebuilt it.

**Live demo:** [kingboosting.dsalim.dev](https://kingboosting.dsalim.dev) (demo accounts on the login page, Stripe test mode) · **Source:** [github.com/CaddyDz/KingBoosting](https://github.com/CaddyDz/KingBoosting)

## What it is

Customers buy game "boosts": a skilled player, the booster, plays ranked games on the customer's account until it reaches the rank they paid for. Boosters claim paid orders from a jobs board and get a share of each one. Moderators support every order, and admins pay boosters, issue fines and review applications. One order moves through a lifecycle (paid, claimed, paused, completed, paid out), and every step changes what each role may see and do.

## The 2020 build

I was the lead developer, with six other contributors: KitaniIslam, Riyadh Aissi, Abd el hak, Sadoudi Anis, Oussama Bouguerne and benyou1969. We delivered to the client in February 2021:

- a **Laravel 8** backend, with **Laravel Nova 3** as the whole logged-in app, for customers as well as staff;
- a **Nuxt 2** storefront with a separate page and price calculator for each of 17 services;
- **Stripe** card payments, and order chat over Pusher.

It shipped, and it worked for the happy path. Six years later, that was the part I trusted least.

## What the 2026 audit found

Before rewriting anything, I ran the old app and wrote down how it actually behaved: every role's screens, the order lifecycle, and 42 real prices from the storefront. The worst findings:

- **New users were treated as staff.** Registration assigned no role, and the Nova resources were written as exclusions ("hide this from Members"). A user with no role matched none of them, so a fresh signup saw every order, including each customer's game login and password.
- **Any user could open any order.** One policy check called a query scope by mistake, which returns an object, so `view` was always true.
- **The price came from the browser.** The checkout charged whatever amount the page posted.
- **More:**
  - CSRF was off for the whole app;
  - chat had no authorisation, and messages from every order shared one channel per user;
  - the payout total kept only the last order's share and ignored fines;
  - an order over €999.99 failed to save after the card was charged.

The lesson I took: authorisation written as "everyone except…" fails open. The rebuild's rules are all "only…".

## Rebuild decisions

Each decision is written up as an [ADR in the repository](https://github.com/CaddyDz/KingBoosting/tree/HEAD/docs/adr).

- **One origin, routed by path.** Traefik sends `/api` to Laravel, `/app` to the WebSocket server, and everything else to Nuxt. Sanctum's session cookie then works without CORS or a shared cookie domain.
- **Policies are the only authorisation layer.** Every user has one `role` column instead of a permissions package. One table lists what each role may do to an order in each status, and a test covers every cell: 490 cases. A refusal because of the status (say, someone claimed the order a second earlier) returns a 409 with a reason; anything else returns a 403.
- **Prices are calculated on the server**, from rate tables in config, in integer cents, rounded once. The new engine reproduces all 42 recorded legacy prices to the cent. The bugs the recording exposed (prices that came out as `NaN`, a calculator reading another game's table) are kept in a separate list instead of being reproduced.
- **Payments use Stripe PaymentIntents and a signed webhook.** In production, the webhook is the only thing that can mark an order paid. Checkout supports 3-D Secure.
- **Order actions are classes that lock the row.** Claiming is a single conditional update, so when two boosters press Claim at the same moment, exactly one gets the order:

![Two boosters claiming the same order at the same moment](/assets/img/kingboosting-claim-race.gif)

- **Chat is a private Reverb channel per order**, authorised by the same policy as everything else:

![Customer and booster chatting in two browsers](/assets/img/kingboosting-chat.gif)

- **One order builder, drawn from a catalog API**, replaces the 17 service pages. A new service is a config entry.
- **Original art only.** The old storefront used Riot Games' artwork. The rebuild draws its own rank badges as inline SVG.

## Numbers

| | 2021 | 2026 |
| --- | --- | --- |
| Automated tests | 6, two of them framework examples | 756 backend (Pest), 36 frontend (Vitest), 3 end-to-end (Playwright) |
| Legacy prices reproduced to the cent | n/a | 42 of 42 |
| Service pages | 17 | 1 |
| Frontend static assets | 70 MB | 12 KB |

The demo runs on a VPS behind Traefik, with a nightly reset back to seeded data, a daily database backup and an uptime check. The README has the architecture and order state diagrams, and [shows how to run it](https://github.com/CaddyDz/KingBoosting#running-it) with Docker alone.

**Stack I used:** Laravel 13 (PHP 8.4), Nuxt 4 with Vuetify, Stripe, Laravel Reverb, MySQL 8.4, Docker, Traefik, GitHub Actions, Pest and Playwright.
