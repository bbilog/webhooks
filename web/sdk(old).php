<?php

$message = "magkano item1 at saan?";

$entity = [];
$entity['products'] = array('item1' => 'bed,something,item1', 'item2' => 'matress,something2,item2','item3' => 'sofa,item3');
$entity['query'] = array('prices' => 'price,much,magkano,pricelist','location'=>'location,saan,find,where');


$sample_data =  array('item1' => array('prices' => 35, 'location' => 'kung saan saan, sa tabi tabi'),'item2' => array('prices' => 10, 'location' => 'sa tabi tabi, Sa May gilid'), 'item1' => array('prices' => 5, 'location' => 'Sa May Gilid'));


$message_arr = preg_split('/([^.:!?]+[.:!?]+)/', $message, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
foreach ($message_arr as $k => $val) {
  
  $val = trim(strtolower(str_replace(array('.',':','!','?'), '', $val)));
  $aa = str_replace(' ','|',$val);
  echo '<br>'.$val;
  echo '<br>'.$aa;

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
    // enter define pattern and designated function
    // pattern 1 if query and products 
    if(isset($ret_ent['query']) && !empty($ret_ent['query']) && isset($ret_ent['products']) && !empty($ret_ent['products'])){
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
    }
    // end pattern 1
  }

}

echo $message_to_reply;