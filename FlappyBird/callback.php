<?php 
header("Content-Type: application/json; encoding=utf-8"); 

$secret_key = 'NGqGM05Yj2dS6nkeZ9Kr'; // Çàùèùåííûé êëþ÷ ïðèëîæåíèÿ 

$input = $_POST; 

// Ïðîâåðêà ïîäïèñè 
$sig = $input['sig']; 
unset($input['sig']); 
ksort($input); 
$str = ''; 
foreach ($input as $k => $v) { 
  $str .= $k.'='.$v; 
} 

if ($sig != md5($str.$secret_key)) { 
  $response['error'] = array( 
    'error_code' => 10, 
    'error_msg' => 'Íåñîâïàäåíèå âû÷èñëåííîé è ïåðåäàííîé ïîäïèñè çàïðîñà.', 
    'critical' => true 
  ); 
} else { 
  // Ïîäïèñü ïðàâèëüíàÿ 
  switch ($input['notification_type']) { 
    case 'get_item': 
      // Ïîëó÷åíèå èíôîðìàöèè î òîâàðå 
      $item = $input['item']; // íàèìåíîâàíèå òîâàðà 

if ($item == 'item1') { 
        $response['response'] = array( 
          'item_id' => 25, 
          'title' => '300 çîëîòûõ ìîíåò', 
          'photo_url' => 'https://Serrgo.github.io/FlappyBird/coin.png', 
          'price' => 5 
        ); 
      } elseif ($item == 'item_25new') { 
        $response['response'] = array( 
          'item_id' => 27, 
          'title' => '500 çîëîòûõ ìîíåò', 
          'photo_url' => 'https://Serrgo.github.io/FlappyBird/coin.png', 
          'price' => 10 
        ); 
      } else { 
        $response['error'] = array( 
          'error_code' => 20, 
          'error_msg' => 'Òîâàðà íå ñóùåñòâóåò.', 
          'critical' => true 
        ); 
      } 
      break; 

case 'get_item_test': 
      // Ïîëó÷åíèå èíôîðìàöèè î òîâàðå â òåñòîâîì ðåæèìå 
      $item = $input['item']; 
      if ($item == 'item_25new') { 
        $response['response'] = array( 
          'item_id' => 125, 
          'title' => '300 çîëîòûõ ìîíåò (òåñòîâûé ðåæèì)', 
          'photo_url' => 'https://Serrgo.github.io/FlappyBird/coin.png', 
          'price' => 5 
        ); 
      } elseif ($item == 'item2') { 
        $response['response'] = array( 
          'item_id' => 127, 
          'title' => '500 çîëîòûõ ìîíåò (òåñòîâûé ðåæèì)', 
          'photo_url' => 'https://Serrgo.github.io/FlappyBird/coin.png', 
          'price' => 10 
        ); 
      } else { 
        $response['error'] = array( 
          'error_code' => 20, 
          'error_msg' => 'Òîâàðà íå ñóùåñòâóåò.', 
          'critical' => true 
        ); 
      } 
      break; 

case 'order_status_change': 
      // Èçìåíåíèå ñòàòóñà çàêàçà 
      if ($input['status'] == 'chargeable') { 
        $order_id = intval($input['order_id']); 

// Êîä ïðîâåðêè òîâàðà, âêëþ÷àÿ åãî ñòîèìîñòü 
        $app_order_id = 1; // Ïîëó÷àþùèéñÿ ó âàñ èäåíòèôèêàòîð çàêàçà. 

$response['response'] = array( 
          'order_id' => $order_id, 
          'app_order_id' => $app_order_id, 
        ); 
      } else { 
        $response['error'] = array( 
          'error_code' => 100, 
          'error_msg' => 'Ïåðåäàíî íåïîíÿòíî ÷òî âìåñòî chargeable.', 
          'critical' => true 
        ); 
      } 
      break; 

case 'order_status_change_test': 
      // Èçìåíåíèå ñòàòóñà çàêàçà â òåñòîâîì ðåæèìå 
      if ($input['status'] == 'chargeable') { 
        $order_id = intval($input['order_id']); 

$app_order_id = 1; // Òóò ôàêòè÷åñêîãî çàêàçà ìîæåò íå áûòü - òåñòîâûé ðåæèì. 

$response['response'] = array( 
          'order_id' => $order_id, 
          'app_order_id' => $app_order_id, 
        ); 
      } else { 
        $response['error'] = array( 
          'error_code' => 100, 
          'error_msg' => 'Ïåðåäàíî íåïîíÿòíî ÷òî âìåñòî chargeable.', 
          'critical' => true 
        ); 
      } 
      break; 
  } 
} 

echo json_encode($response); 
?> 
