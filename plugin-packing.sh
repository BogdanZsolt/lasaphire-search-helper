#!/bin/bash
set -e

zip -r9 la-saphire-search-helper admin inc public *.php package.json README.md rollup.config.js -x public/*.map