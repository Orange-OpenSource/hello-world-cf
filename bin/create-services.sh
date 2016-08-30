#!/usr/bin/env bash
if [ $# -ne 1 ];then
    echo "You need to pass your app name as first argument."
    exit 1
fi
cf create-service p-mysql 100mb my-super-database &> /dev/null
cf bind-service $1 my-super-database

cf create-service p-redis shared-vm my-redis &> /dev/null
cf bind-service $1 my-redis
