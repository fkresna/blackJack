#!/usr/bin/env bash

echo "Fetching Golden Image DB - This might take a minute."
/usr/bin/ssh -p22 -i ~/.ssh/hg_vagrant vagrant@db-master-dev.xxxx.com "/bin/mysqldump --add-locks --disable-keys --lock-tables --comments --dump-date --order-by-primary go_gi" > go_gi.sql

echo "Dropping current  DB"
mysqladmin --force --silent drop go_v5

echo "Creating new  DB"
mysqladmin --silent --default-character-set=utf8mb4 create xxx

echo "Importing new xxx DB"
mysql go_v5 < go_gi.sql

echo "Cleaning up"
rm go_gi.sql

echo "xxx DB has been refreshed with the latest Golden Image"
echo "Bye"

