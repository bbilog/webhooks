<?php

require_once '../vendor/autoload.php';
use FacebookAds\Api;
use FacebookAds\Object\Lead;
Api::init('287026681636328','d11f7cab83ce6d228703dd3defd4f05e','EAAEFDJtmZAegBAKvDJpELkpZCQQFbRYuq5ArCdPFBqs9536392mV7WkF1MkFkjjpdzCAplZAHSoXyswarQoIbRgPDZA5cQ4T59KlrtpLkhZAPeY3hd5sTEnTAA4LhwEa7w5jQlSvQt4jB96PyqdMCdnteOu9oi2MZD');

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


