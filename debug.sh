#!/bin/sh
./stop.sh
python3 vortaro.py #> /dev/null 2> /dev/null &
#ps -ef | grep vortaro.py
