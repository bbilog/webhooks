<?php
require_once  __DIR__.'../vendor/autoload.php';

use FacebookAds\Api;
use FacebookAds\Object\Lead;
use FacebookAds\Object\Fields\LeadFields;

$leads = new Lead('1019631454816193');
$asf = $leads->read();
var_dump($asf);

echo 'asdf';

