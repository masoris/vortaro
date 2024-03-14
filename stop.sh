#!/bin/sh
kill $(ps aux | grep vortaro.py | grep -v stop.sh | awk '{print $2}') > /dev/null 2> /dev/null
