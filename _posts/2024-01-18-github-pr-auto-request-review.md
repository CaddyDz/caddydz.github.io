---
layout: blog
title: "Automate pull request review assignment on GitHub via actions"
date: 2023-01-18
thumbnail: "/assets/img/gh-pr-review.png"
categories: github
---

Managing pull requests (PRs) can be a challenging task. This is where automation can play a pivotal role.
{: class="post-cards_description"}

Explore how to leverage GitHub Actions to automate the assignment of pull request reviews, enhancing productivity and ensuring a smooth workflow. By automating this process, teams can ensure timely reviews and maintain high-quality code standards with minimal manual intervention.

Here's a GitHub actions workflow that automates the process of requesting a review on a pull request within a GitHub repository. Let's break down each section to understand what it does:

`.github/workflows/request_review.yml`

> Remember to change the [username] by the desired assignee.

```yaml
name: Request Review
on:
  pull_request:
    types:
      - opened
      - synchronize

jobs:
  request_review:
    runs-on: ubuntu-latest
    steps:
      - name: Checkout repository
        uses: actions/checkout@v4

      - name: Request review
        run: |
          curl -X POST \
            -H "Authorization: token ${{ secrets.GITHUB_TOKEN }}" \
            -H "Accept: application/vnd.github.v3+json" \
            "https://api.github.com/repos/${{ github.repository }}/pulls/${{ github.event.pull_request.number }}/requested_reviewers" \
            -d "{\"reviewers\":[\"username\"]}"
```

## Workflow Name

- Name: Request Review
  - This is the name given to the workflow. It's used for identification in the GitHub Actions interface.

## Trigger

- on: pull_request: types:
  - This section defines the events that trigger the workflow.
  - Pull Request: The workflow is triggered by activities related to pull requests.
  - Types: The specific types of pull request activities that trigger the workflow are:
    - opened: When a pull request is created.
    - synchronize: When new commits are pushed to the branch that's part of the pull request.

## Jobs

- Jobs: This section defines the jobs that the workflow will execute. There's one job here named request_review.

### Job: request_review

- runs-on: ubuntu-latest
  - This specifies that the job will run on the latest version of Ubuntu available on GitHub Actions runners.

#### Steps within the request_review Job

- Step 1: Checkout repository

  - uses: actions/checkout@v4 - This step uses the checkout action at version 4. It checks out the repository's code so that it can be used by subsequent steps in the job.

- Step 2: Request review [run]

- This step executes a series of commands:
  - It uses curl to send a POST request to GitHub's API.
  - The request is sent to the URL for adding requested reviewers to a pull request in the current repository.
  - The headers include an authorization token (${{ secrets.GITHUB_TOKEN }}) and a specification for the version of the GitHub API.
  - The data (-d) sent in the request specifies the reviewers to be added. Here, it's hard-coded to add a reviewer with the username "username".

## Overview

The workflow automates the process of requesting a review whenever a new pull request is created or updated in the repository. When such an event occurs, it uses GitHub's API to automatically assign a specific user (in this case, "username") as a reviewer for the pull request. This is particularly useful for streamlining code review processes in team projects.
