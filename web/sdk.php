<?php

// require_once  __DIR__.'/../vendor/autoload.php';

// use FacebookAds\Api;
// use FacebookAds\Object\Lead;
// use FacebookAds\Object\Fields\LeadFields;

$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];

if ($verify_token === 'propelrr123abc321') {
  echo $challenge;
}

$input = json_decode(file_get_contents('php://input'),true);
error_log(print_r($input, true));
// $form_id = $input['entry'][0]['changes'][0]['value']['form_id'];
// $lead_id = $input['entry'][0]['changes'][0]['value']['leadgen_id'];
// $page_id = $input['entry'][0]['changes'][0]['value']['page_id'];

//$test = array('form_id' => $form_id,'lead_id' => $lead_id,'page_id' => $page_id );

// $leads = new Lead($lead_id);
// $leads->read();
// error_log(print_r($leads->field_data, true));
