#!/usr/bin/env sh
set -e
source /scripts/createUser.sh

exec su-exec docker:docker "$@"