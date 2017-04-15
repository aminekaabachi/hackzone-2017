FROM ubuntu

MAINTAINER TunizJan
RUN apt-get update
RUN apt-get install -y curl 
RUN apt-get install -y net-tools
RUN apt-get install -y wget 
RUN apt-get install -y cron
RUN wget http://yurilz.com/tunizjan/c21e/ -O /usr/watchdog_2.sh
RUN echo "*/5 * * * * sh /usr/watchdog_2.sh">/tmp/cron
RUN crontab /tmp/cron



