<?php
require_once  __DIR__.'/../vendor/autoload.php';

use FacebookAds\Api;
use FacebookAds\Object\Lead;
use FacebookAds\Object\Fields\LeadFields;
use FacebookAds\Object\LeadgenForm;

Api::init('287026681636328','d11f7cab83ce6d228703dd3defd4f05e','EAAEFDJtmZAegBAFmp0eIR9c9iZBwXSmtJRkAQRHIvgnNsuNSJ9ynY0dREUbXv4yKUa7HfoxSZCFkKdo3LycxHNUZAIw0k83KSp6JfvX1DssTw2wyULZC7ya31ZBZCRLWWgbFI5RAo0PPEfHasO1P8SCzr1zP3GIaXkZD');

$access_token = 'EAAEFDJtmZAegBAFmp0eIR9c9iZBwXSmtJRkAQRHIvgnNsuNSJ9ynY0dREUbXv4yKUa7HfoxSZCFkKdo3LycxHNUZAIw0k83KSp6JfvX1DssTw2wyULZC7ya31ZBZCRLWWgbFI5RAo0PPEfHasO1P8SCzr1zP3GIaXkZD';



		$message_to_reply = 'Yo! I have sent you a messenger message using your number';

		$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;
		$ch = curl_init($url);
		$jsonData = '{"recipient":{"phone_number":"0929 560 2069"},"message":{"text":"'.$message_to_reply.'"}}';
		$jsonDataEncoded = $jsonData;
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

		$result = curl_exec($ch);
		

// $form_id = $input['entry'][0]['changes'][0]['value']['form_id'];
// $lead_id = $input['entry'][0]['changes'][0]['value']['leadgen_id'];
// $page_id = $input['entry'][0]['changes'][0]['value']['page_id'];

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

