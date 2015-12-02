#!/usr/bin/php
define('CRON_CI_INDEX', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'index.php');

set_time_limit(0);
chdir(dirname(CRON_CI_INDEX));
require(CRON_CI_INDEX);


print("cron START1 :: ");
print(base_url());
print("<br><br>");

