<?php
// require_once  __DIR__.'/../vendor/autoload.php';

// use FacebookAds\Api;
// use FacebookAds\Object\Lead;
// use FacebookAds\Object\Fields\LeadFields;
// use FacebookAds\Object\LeadgenForm;

// Api::init('287026681636328','d11f7cab83ce6d228703dd3defd4f05e','EAAEFDJtmZAegBAFmp0eIR9c9iZBwXSmtJRkAQRHIvgnNsuNSJ9ynY0dREUbXv4yKUa7HfoxSZCFkKdo3LycxHNUZAIw0k83KSp6JfvX1DssTw2wyULZC7ya31ZBZCRLWWgbFI5RAo0PPEfHasO1P8SCzr1zP3GIaXkZD');

// $leads = new Lead('1019631454816193');
// $leads->read();
// var_dump($leads->field_data);



// $form = Api::instance()->call('/1019071074872231','GET',array('fields' => 'id,name,qualifiers'));
// $formfields = json_decode($form->getBody(),true);
// var_dump($formfields);


1258216397556080


<?php
require_once  __DIR__.'/../vendor/autoload.php';

use FacebookAds\Api;
use FacebookAds\Object\Lead;
use FacebookAds\Object\Fields\LeadFields;
use FacebookAds\Object\LeadgenForm;

Api::init('287026681636328','d11f7cab83ce6d228703dd3defd4f05e','EAAEFDJtmZAegBAFmp0eIR9c9iZBwXSmtJRkAQRHIvgnNsuNSJ9ynY0dREUbXv4yKUa7HfoxSZCFkKdo3LycxHNUZAIw0k83KSp6JfvX1DssTw2wyULZC7ya31ZBZCRLWWgbFI5RAo0PPEfHasO1P8SCzr1zP3GIaXkZD');


$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];

if ($verify_token === 'propelrr123abc321') {
  echo $challenge;
}

$input = json_decode(file_get_contents('php://input'),true);
error_log(print_r($input, true));

$form_id = $input['entry'][0]['changes'][0]['value']['form_id'];
$lead_id = $input['entry'][0]['changes'][0]['value']['leadgen_id'];
$page_id = $input['entry'][0]['changes'][0]['value']['page_id'];

// check if form id is present in leadgendb
// leadgendb id, leadgenid, name, pageid, fields,
// select leadgen id
// $form = Api::instance()->call('/'.$form_id,'GET',array('fields' => 'id,name,qualifiers'));
// $formfields = json_decode($form->getBody(),true);
// var_dump($formfields);

// save leads to database
// leadsdb id, leadsid, leadgenid, pageid, value
// $leads = new Lead($lead_id);
// $leads->read();
// $fdata = $leads->field_data;
// error_log(print_r($fdata, true));

/* 
