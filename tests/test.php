<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DevXyz\Challenge\PaydateCalculator;

date_default_timezone_set('America/Los_Angeles');

// MONTHLY, BIWEEKLY, WEEKLY
$paydateCalulator = new PaydateCalculator('MONTHLY');

$date = date('Y-m-d');
$num = 10;

$paydates = $paydateCalulator->calculatePaydates($date, $num);

print_r($paydates);
return;
