#!/bin/bash

# TYPO3 razor install
# Version 1.0 (12.02.2016)

# Autor: Raphael Zschorsch / www.rafu1987.de

if type "yarn" > /dev/null 2>&1; then
  yarn install
else
  npm install
fi

bower install

cd typo3conf/ext/razor/
bower install
