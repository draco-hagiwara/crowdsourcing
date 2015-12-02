#!/usr/bin/php
define('CRON_CI_INDEX', base_url() . 'index.php');

set_time_limit(0);
chdir(dirname(CRON_CI_INDEX));
require(CRON_CI_INDEX);


print("cron START2 :: ");
print(base_url());
print("<br><br>");

//[cs@cs ~]$ php /home/cs/www/cs.com.dev/application/controllers/cron.php batch entry_timeover
