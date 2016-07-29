<?php

$message = "how much for something and where to buy?";
//$message = "masfdfs";

$entity = [];
$entity['products'] = array('item1' => 'bed,something,item1', 'item2' => 'matress,something2,item2','item3' => 'sofa,item3');
$entity['query'] = array('prices' => 'price,much,magkano,pricelist','location'=>'location,saan,find,where');


$sample_data =  array('item1' => array('prices' => 35, 'location' => 'kung saan saan, sa tabi tabi'),'item2' => array('prices' => 10, 'location' => 'sa tabi tabi, Sa May gilid'), 'item1' => array('prices' => 5, 'location' => 'Sa May Gilid'));


  $message_to_reply = 'Yo!';
  $message_arr = preg_split('/([^.:!?]+[.:!?]+)/', $message, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
  $pcond = false;
  foreach ($message_arr as $sentences) {
      $sentences = trim(strtolower(str_replace(array('.',':','!','?'), '', $sentences)));
      $aa = str_replace(' ','|',$sentences);
      foreach ($entity as $ek => $eval) {
          foreach ($eval as $ename => $eitem){
            if(preg_match('/('.$aa.')/', $eitem)){
              if( !isset($ret_ent[$ek]) || empty($ret_ent[$ek])){
                $ret_ent[$ek] = [];
              }
              $ret_ent[$ek][] = $ename;
              var_dump($ename);
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
              $message_to_reply .= "
              ".$value." - ";
              foreach ($ret_ent['query'] as $que) {
                switch ($que) {
                case 'prices':
                  $message_to_reply .= "
                price: ".$sample_data[$value][$que];
                  break;
                case 'location':
                  $message_to_reply .= "
                can be bought at: ".$sample_data[$value][$que];
                  break;
                }
              }
            }
            $message_to_reply = '"text":"'.$message_to_reply.'"';
            
          } else {
            $message_to_reply = '"text":"Sorry I didn\'t catch that, could you rephrase your question."';
          }
          
          // end pattern 1
        }

  }
  if(!$pcond){

  } else {

echo $message_to_reply;
  }
