#!/bin/bash

# Helper script to avoid git warning about different owners of the project directory.
# When mounting and overriding a folder inside the container, git warns if the current accessing user
# and the user (iri) inside the container are not the same (have different IDs). When this happens,
# it might lead to problems when running composer installation.

USER_ID=$(stat -c "%u" /home/iri/code)
GROUP_ID=$(stat -c "%g" /home/iri/code)

usermod -u $USER_ID iri
groupmod -g $GROUP_ID iri

su iri -c "git config --global --add safe.directory /home/iri/code"

exec runuser -u iri -- "$@"