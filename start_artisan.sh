#!/bin/sh
cd /home/users/2/itigo.jp-hasui0310/web/gacha-jiman/
touch cron.log

YMDHMS=`date '+%y/%m/%d %H:%M:%S'`
echo "$YMDHMS *** start ***" >> cron.log

#/usr/local/php7.1/bin/php /home/users/2/itigo.jp-hasui0310/web/gacha-jiman/artisan schedule:run >> cron.log

YMDHMS=`date '+%y/%m/%d %H:%M:%S'`
echo "$YMDHMS *** end ***" >> cron.log

