#!/bin/sh
docker exec -it oddhill-mysql bash -c "
mysql -uroot -ppassword <<< 'DROP DATABASE IF EXISTS \`database\`;CREATE DATABASE \`database\`;'
mysql -uroot -ppassword database < /source.sql
"
