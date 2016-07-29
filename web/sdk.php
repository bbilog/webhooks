<?php
require_once  __DIR__.'/../vendor/autoload.php';

use FacebookAds\Api;
use FacebookAds\Object\Lead;
use FacebookAds\Object\Fields\LeadFields;
use FacebookAds\Object\LeadgenForm;

Api::init('287026681636328','d11f7cab83ce6d228703dd3defd4f05e','EAAEFDJtmZAegBAFmp0eIR9c9iZBwXSmtJRkAQRHIvgnNsuNSJ9ynY0dREUbXv4yKUa7HfoxSZCFkKdo3LycxHNUZAIw0k83KSp6JfvX1DssTw2wyULZC7ya31ZBZCRLWWgbFI5RAo0PPEfHasO1P8SCzr1zP3GIaXkZD');

$access_token = 'EAAEFDJtmZAegBAFmp0eIR9c9iZBwXSmtJRkAQRHIvgnNsuNSJ9ynY0dREUbXv4yKUa7HfoxSZCFkKdo3LycxHNUZAIw0k83KSp6JfvX1DssTw2wyULZC7ya31ZBZCRLWWgbFI5RAo0PPEfHasO1P8SCzr1zP3GIaXkZD';

$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];

if ($verify_token === 'propelrr123abc321') {
  echo $challenge;
}

$input = json_decode(file_get_contents('php://input'),true);
error_log(print_r($input, true));
$message_to_reply = 'Yo!';

if(isset($input['entry'][0]['messaging']) && !empty($input['entry'][0]['messaging'])){
	$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
	if(isset($input['entry'][0]['messaging'][0]['message']) && !empty($input['entry'][0]['messaging'][0]['message'])){
		// $input['entry'][0]['messaging'][0]['message']['quick_reply'];
		if(isset($input['entry'][0]['messaging'][0]['message']['quick_reply']) && !empty($input['entry'][0]['messaging'][0]['message']['quick_reply'])){

			$payload = $input['entry'][0]['messaging'][0]['message']['quick_reply']['payload'];
			$randresp['POGI_PAYLOAD_ELWIN'] = '"attachment":{"type":"image","payload":{"url":"https://lh3.googleusercontent.com/-1cABf_2Htdk/V5lv4RHnOkI/AAAAAAAABPo/En4auEusT6kZTXC4CgJek9H-ovmLNyjbACL0B/w619-h825-no/9019761398270513083%253Faccount_id%253D2"}}';
			$randresp['POGI_PAYLOAD_VINO'] = '"attachment":{"type":"image","payload":{"url":"https://lh3.googleusercontent.com/-QHH6dmGrQhE/V2qO4rBV17I/AAAAAAAAAEU/79w8DibYYO8jmLxRKXi-LOhGJKc5zhUmwCL0B/w366-h550-no/2016-06-22.jpg"}}';
			$randresp['POGI_PAYLOAD_JLC'] = '"attachment":{"type":"image","payload":{"url":"https://lh4.googleusercontent.com/-McufwNre2-U/V1J8Qq1BI9I/AAAAAAAAAew/-8itXqgbc-0l2pJiriGmZ-KhohGp3R3sQCL0B/w651-h396-no/Screen%2BShot%2B2016-06-04%2Bat%2B2.57.54%2BPM.png"}}';
			$randresp['POGI_PAYLOAD_WALA'] = '"attachment":{"type":"image","payload":{"url":"https://lh5.googleusercontent.com/-ex1Bdu5vJ1g/V1lQDF6E53I/AAAAAAAAAD4/n9ZJ396_m2oZEdmlgAKg4itI5Bx4_PXwwCL0B/w480-h384-no/2016-06-09.jpg"}}';
			
			$message_to_reply = $randresp[$payload];
			$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;
			$ch = curl_init($url);
			$jsonData = '{"recipient":{"id":"'.$sender.'"},"message":{'.$message_to_reply.'}}';
			$jsonDataEncoded = $jsonData;
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

			if(!empty($input['entry'][0]['messaging'][0]['message'])){
				$result = curl_exec($ch);
			}
				

		} else {

			// sample data test for simple contextual processing, word embedding 
			$entity = [];
			$entity['products'] = array('item1' => 'bed,something,item1', 'item2' => 'matress,something2,item2','item3' => 'sofa,item3');
			$entity['query'] = array('price' => 'price,much,magkano,pricelist','location'=>'location,saan,find');

			// sample data
			$sample_data =  array('item1' => array('prices' => 35, 'location' => 'kung saan saan, sa tabi tabi'),'item2' => array('prices' => 10, 'location' => 'sa tabi tabi, Sa May gilid'), 'item1' => array('prices' => 5, 'location' => 'Sa May Gilid'));

			$message_to_reply = 'Yo!';
			$message_arr = preg_split('/([^.:!?]+[.:!?]+)/', $message, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
			$pcond = false;
			foreach ($message_arr as $sentence) {
				$sentence = trim(strtolower(str_replace(array('.',':','!','?'), '', $sentence)));
				$aa = str_replace(' ','|',$sentence);

				$ret_ent = [];
				foreach ($entity as $ek => $eval) {
					foreach ($eval as $ename => $eitem){
						if(preg_match('/('.$aa.')/', $eitem)){
							if( !isset($ret_ent[$ek]) || empty($ret_ent[$ek])){
								$ret_ent[$ek] = [];
							}
							$ret_ent[$ek][] = $ename;
						}
					}
				}

				if(isset($ret_ent) && !empty($ret_ent)){
					$pcond = true;
					// enter define pattern and designated function
					// pattern 1 if query and products 
					if(isset($ret_ent['query']) && !empty($ret_ent['query']) && isset($ret_ent['products']) && !empty($ret_ent['products'])){
						$message_to_reply = '';
						foreach ($ret_ent['products'] as $value) {
							$message_to_reply .= "".$value." - ";
							foreach ($ret_ent['query'] as $que) {
								switch ($que) {
								case 'prices':
									$message_to_reply .= " price: ".$sample_data[$value][$que];
									break;
								case 'location':
									$message_to_reply .= " can be bought at: ".$sample_data[$value][$que];
									break;
								}
							}
						}
					// end pattern 1
						
					} else {
						$message_to_reply = 'Sorry I didn\'t catch that, could you rephrase your question.';
					}
					
					
				} else {
					$pcond = true;
					$message_to_reply = $message;
				}

			}
			$message_to_reply = '"text":"'.$message_to_reply.'"';
			if(!$pcond) {
				$randresp[] = '"attachment":{"type":"template","payload":{"template_type":"generic","elements":[{"title":"Welcome to Happy monkey, I\'m uratex-bot","image_url":"https://scontent.fmnl4-4.fna.fbcdn.net/v/t1.0-1/p160x160/10469695_563190533791082_571472624565872456_n.jpg?oh=9e062ad9f64a9b75bd774cb9af813642&oe=581C080F","subtitle":"The sleep specialist, and mostly I gave random responses","buttons":[{"type":"web_url","url":"https://www.uratex.com.ph","title":"View Website"},{"type":"postback", "title":"It\'s something","payload":"USER_DEFINED_SOMETHING"}]}]}}';
    			//https://lh3.googleusercontent.com/-1cABf_2Htdk/V5lv4RHnOkI/AAAAAAAABPo/En4auEusT6kZTXC4CgJek9H-ovmLNyjbACL0B/w619-h825-no/9019761398270513083%253Faccount_id%253D2
    			$randresp[] = '"text":"Sinong mas pogi:","quick_replies":[{"content_type":"text","title":"Elwin","payload":"POGI_PAYLOAD_ELWIN"},{"content_type":"text","title":"Vino","payload":"POGI_PAYLOAD_VINO"},{"content_type":"text","title":"Both","payload":"POGI_PAYLOAD_WALA"}]';
				$message_to_reply = $randresp[mt_rand(0, count($randresp) - 1)];
				
			}

			$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;
			$ch = curl_init($url);
			$jsonData = '{"recipient":{"id":"'.$sender.'"},"message":{'.$message_to_reply.'}}';
			$jsonDataEncoded = $jsonData;
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

			if(!empty($input['entry'][0]['messaging'][0]['message'])){
				$result = curl_exec($ch);
			}

		}


		
	}
}



// function sendCurl($id,$msg,$atoken)
// {
	
// }

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

