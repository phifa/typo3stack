#!/usr/bin/env bash

# DDEV example config
vendor/bin/typo3cms install:setup --database-socket="" --use-existing-database --database-name="DB" --database-user-name="DB" --database-host-name="DB" --database-user-password="DB"  --database-port="3306" --site-name="Site" --site-setup-type="no" --web-server-config="none"



echo "Voila! Everything is done. "
read -p "Return to Exit... " -n1 -s

