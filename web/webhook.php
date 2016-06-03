<?php

require_once '../vendor/autoload.php';
use FacebookAds\Object\Lead;

$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];

if ($verify_token === 'abc123') {
  echo $challenge;
}

$input = json_decode(file_get_contents('php://input'),true);


$form_id = $input['entry'][0]['changes'][0]['value']['form_id'];
$leadgen_id = $input['entry'][0]['changes'][0]['value']['leadgen_id'];
$page_id = $input['entry'][0]['changes'][0]['value']['page_id'];
$created_time = $input['entry'][0]['changes'][0]['value']['created_time'];



$form = new Lead($form_id);
$leads = $form->read();
error_log(print_r($leads, true));


