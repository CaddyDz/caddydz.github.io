#!/usr/bin/env python
# -*- coding: utf-8 -*-

from bs4 import BeautifulSoup
from urllib.request import urlopen
try:
    from StringIO import StringIO ## for Python 2
except ImportError:
    from io import StringIO ## for Python 3
import gzip
import re

CHEATSHEET_URL = 'https://fontawesome.com/v4/cheatsheet'
OUTPUT_FILE = 'fontawesome.sty'

OUTPUT_HEADER = r'''
%% Copyright 2023 Salim. Djerbouh <caddydz4@gmail.com>
%% It is based on plorcupine's latex-fontawesome project.

% Identify this package.
\NeedsTeXFormat{LaTeX2e}
\ProvidesPackage{fontawesome}[2017/10/22 v4.7.0 font awesome icons]

% Requirements to use.
\usepackage{fontspec}

% Define shortcut to load the Font Awesome font.
\newfontfamily{\FA}{FontAwesome}
% Generic command displaying an icon by its name.
\newcommand*{\faicon}[1]{{
  \FA\csname faicon@#1\endcsname
}}

'''.lstrip()

OUTPUT_LINE = '\expandafter\def\csname faicon@%(name)s\endcsname '
OUTPUT_LINE += '{\symbol{"%(symbol)s}} \def\%(camel_name)s '
OUTPUT_LINE += '{{\FA\csname faicon@%(name)s\endcsname}}\n'

try:
    response = urlopen(CHEATSHEET_URL)
    if response.info().get('Content-Encoding') == 'gzip':
        buf = StringIO(response.read())
        f = gzip.GzipFile(fileobj=buf)
        data = f.read()
    else:
        data = response.read()
    soup = BeautifulSoup(data, 'html.parser')

    cheatsheet = soup.select('div.row > div')
except:
    import sys
    sys.exit(0)

with open(OUTPUT_FILE, 'w') as w:
    w.write(OUTPUT_HEADER)
    for line in cheatsheet:
        data = line.text
        if 'fa' not in data:
            continue

        data = ' '.join(s.strip() for s in data.split())
        # Expects to find 'fa-NAME' ending with " " (single space)
        name = re.findall(r'fa-(\S+)', data)[0]
        # Expects to find 'xfSYMBOL' ending with ;
        symbol = re.findall(r'xf[^;]*', data)[0][1:].upper()

        camel_case = [s.capitalize() for s in name.split('-')]
        camel_name = 'fa' + ''.join(camel_case)

        if re.findall('[0-9]', name):
            continue

        w.write(
            OUTPUT_LINE % {
                'name': name, 'camel_name': camel_name, 'symbol': symbol
            }
        )
    w.write(r'\endinput')
