<?php

// $challenge = $_REQUEST['hub_challenge'];
// $verify_token = $_REQUEST['hub_verify_token'];

// if ($verify_token === 'abc123') {
//   echo $challenge;
// }

// $input = json_decode(file_get_contents('php://input'),true);
//error_log(print_r($input, true));
// $form_id = $input['entry'][0]['changes'][0]['value']['form_id'];
// $lead_id = $input['entry'][0]['changes'][0]['value']['leadgen_id'];
// $page_id = $input['entry'][0]['changes'][0]['value']['page_id'];

//$test = array('form_id' => $form_id,'lead_id' => $lead_id,'page_id' => $page_id );

require_once  '../vendor/autoload.php';

use FacebookAds\Api;
use FacebookAds\Object\Lead;
use FacebookAds\Object\Fields\LeadFields;

Api::init(
  '287026681636328','d11f7cab83ce6d228703dd3defd4f05e','EAAEFDJtmZAegBAHdYOpWwZC706O3vBW3EwPfz0yicS3dzvZCeWRTe1izRFjNsOCW917KpY2zPotU96feePfFj2ZCNW4CRz98FazvkQIRZAFDS9tZA0Mcd5JFhJXe8QJM020jpPsL4FUq9RiKlutQA8vaAoafPSa7oZD'
);

$form = new Lead('569457453233536');
$form->read();


//error_log(print_r($test, true));
var_dump($form->id);
echo '<br/>';
var_dump($form->field_data);