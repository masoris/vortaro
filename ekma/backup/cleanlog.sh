#!/bin/sh

grep -v 110.10.242.192 tiru-enhavon.log > tiru-enhavon.log.1 
grep -v 221.132.71.222 tiru-enhavon.log.1 > tiru-enhavon.log.log 

chmod 777 tiru-enhavon.log.log
mv tiru-enhavon.log.log tiru-enhavon.log
