#!/bin/bash
branch="$1"

git clean -fd
git checkout -- .
git checkout $branch