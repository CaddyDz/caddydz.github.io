---
layout: blog
title: "Understanding Unix Change Mode (chmod)"
date: 2023-02-06
thumbnail: "/assets/img/chmod.png"
categories: unix
---
CHMOD is used to change permissions of a file, here's how to calculate permission number
{: class="post-cards_description"}

### Permissions:

| Number | Meaning                 |
| :----- | ----------------------- |
| 400    | read by owner           |
| 200    | write by owner          |
| 100    | execute by owner        |
| 040    | read by group           |
| 020    | write by group          |
| 010    | execute by group        |
| 004    | read by anyone          |
| 002    | write by anyone         |
| 001    | execute by anyone       |

To get a combination, just add them up.

For example, to grant read, write and execute permission for the owner of the file, read and execute for the group of the file and execute for anyone
```
400 + 200 + 100 + 040 + 010 + 001 = 751
```

Here's how to read and understand permissions:

> Let's assume you ran `ls -lah` in a macOS directory

```
Owner  Group  Anyone
rwx    rwx    rwx    john staff foo
rwx    rwx    r-x    john staff bar
rw-    rw-    r-x    john staff baz
```
`foo` is 777  
`bar` is 775  
`baz` is 665

### Keymap

| r   | Read          |
| w   | Write         |
| x   | Execute       |
| -   | No permission |