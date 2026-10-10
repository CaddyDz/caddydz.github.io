---
layout: blog
title: "Pro tip: your Mac has a built-in speed test (networkQuality)"
date: 2026-10-10
thumbnail: "/assets/img/networkquality.png"
categories: macos
---
Since macOS Monterey, every Mac ships with `networkQuality`, a native command-line speed test. No browser tab, no Python script, no third-party CLI
{: class="post-cards_description"}

#### Run it from any terminal:
```shell
networkQuality
```

```
==== SUMMARY ====
Uplink capacity: 75.910 Mbps
Downlink capacity: 483.249 Mbps
Responsiveness: Medium (200.578 milliseconds | 299 RPM)
Idle Latency: 78.426 milliseconds | 765 RPM
```
> Available since macOS 12 Monterey, lives in `/usr/bin`

#### Why it beats the usual speed test
- **Native**: nothing to install, update or pipe from the internet
- **Concise**: upload capacity, download capacity and **responsiveness**
- **Responsiveness** is measured in RPM (round-trips per minute) while your connection is under load, and rated Low, Medium or High. That's what you actually feel on video calls, SSH sessions and games. High throughput with low RPM means bufferbloat

#### Handy flags

| Flag     | What it does                                                          |
| :------- | --------------------------------------------------------------------- |
| `-s`     | Test upload and download one after the other instead of in parallel   |
| `-v`     | Verbose output                                                        |
| `-I en0` | Test a specific network interface (e.g. Wi-Fi vs Ethernet)            |
| `-c`     | Machine-readable (JSON) output, handy for scripts                     |

> Run `man networkQuality` for the full list

#### Make it yours with an alias:
```shell
alias fast="networkQuality"
```
Drop that in your `~/.zshrc` and `fast` is all you'll ever type again
