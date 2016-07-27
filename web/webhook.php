<?php
require_once  __DIR__.'/../vendor/autoload.php';

use FacebookAds\Api;
use FacebookAds\Object\Lead;
use FacebookAds\Object\Fields\LeadFields;
use FacebookAds\Object\LeadgenForm;

Api::init('287026681636328','d11f7cab83ce6d228703dd3defd4f05e','EAAEFDJtmZAegBAFmp0eIR9c9iZBwXSmtJRkAQRHIvgnNsuNSJ9ynY0dREUbXv4yKUa7HfoxSZCFkKdo3LycxHNUZAIw0k83KSp6JfvX1DssTw2wyULZC7ya31ZBZCRLWWgbFI5RAo0PPEfHasO1P8SCzr1zP3GIaXkZD');

$leads = new Lead('1019631454816193');
$leads->read();
var_dump($leads->field_data);



// $form = Api::instance()->call('/1019071074872231','GET',array('fields' => 'id,name,qualifiers'));
// $formfields = json_decode($form->getBody(),true);
// var_dump($formfields);


