latex-fontawesome
=================

Original project is [plorcupine's latex-fontawesome](https://github.com/plorcupine/latex-fontawesome). I edited this project to use latest [Fobnt Awesome](https://fontawesome.com/) icons in XeLaTeX.

The current version of FontAwesome icons used is 4.4.0. See [this](https://www.ctan.org/tex-archive/fonts/fontawesome) for an older version (using FontAwesome version 3.1.1) with better documentation, examples, and for more information.

How to Use
----------

### Requirements
* You must have the FontAwesome font installed on your machine (download the `.otf` file [here](https://github.com/FortAwesome/Font-Awesome/blob/master/otfs/Font%20Awesome%205%20Free-Regular-400.otf?raw=true)).
* You must be using XeLaTeX and have the `fontspec` package installed.

### Usage
1. Download the `fontawesome.sty` file and put it in the same directory as the LaTeX file using the icons.
2. Include the package as normal (in the preamble of the `.tex` file, add the line `\usepackage{fontawesome}`).
3. Use an icon by typing `\faIconName`. For example, to use the `fa-quote-left` icon, convert it to camelcase and prepend the slash: `\faQuoteLeft`.

Make Latest fontawesome.sty
---------------------------

### Requirements
You need [BeautifulSoup](https://www.crummy.com/software/BeautifulSoup) to run ``makesty.py``.
```bash
$ sudo pip install beautifulsoup4
```

### Usage
```bash
$ python makesty.py
```
This should result in the creation of latest ``fontawesome.sty``


Notice
------
* You cannot use the icons which include a digit(0~9) in the name. (Ex. fa-500px)

Contact
-------

You are free to modify it.

If you have any questions, feel free to join me at [`@caddydz` on Telegram](https://t.me/caddydz) and ask away.

Good luck, 3301
