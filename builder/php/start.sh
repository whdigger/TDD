#!/usr/bin/env bash

UNIT_NAME="${UNIT_NAME:-php}"

IMAGE_TAG="${IMAGE_TAG:-:latest}"

DOCKER_OPTIONS="${DOCKER_OPTIONS:--d}"
DOCKER_COMMAND="${DOCKER_COMMAND:-php -S 0.0.0.0:8000 -t /var/www/app/public}"

COMMAND="docker run --rm -p 8000:8000 \
--name $UNIT_NAME \
-v  $(pwd)/../../:/var/www/app \
-e LOCAL_USER_ID=$(id -u) \
-e LOCAL_GROUP_ID=$(id -g) \
$@ \
$DOCKER_OPTIONS $UNIT_NAME$IMAGE_TAG $DOCKER_COMMAND"

echo $COMMAND
eval $COMMAND