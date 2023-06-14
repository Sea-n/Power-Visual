#!/usr/bin/env bash
set -Eeuo pipefail
cd "$(dirname "$0")" || exit 1

if [[ "$#" -ne 1 ]]; then
	echo "Usage: $0 <database>"
	exit 1
fi

name="$1"

cat schema.sql | mysql "$name"

cd dataset/

for f in *.csv; do
echo "Loading $f..."
echo "load data local infile './$f'
into table ${f/.csv/}
fields terminated by ','
enclosed by '\"'
lines terminated by '\n'
ignore 1 lines;" | mysql "$name"
done
