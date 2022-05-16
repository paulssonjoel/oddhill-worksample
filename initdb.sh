#!/bin/sh
docker exec -it oddhill-mysql bash -c 'mysql -uroot -ppassword database < /source.sql'
