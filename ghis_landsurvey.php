<?php 
      
      $pop = handle_send();
      var_dump($pop);
      function handle_send(){
            $url ="http://206.225.81.36/ucm_api/index.php"; 
            $request_id = "UCM _" . preg_replace('/\D/', '', date('Y-m-d H:i:s')); 
            $data = [  
                'reference' => 'ref', // your own reference
                'message_type' => "1",
                'message' => 'testing GHIS Land Survey', 
                'user_id' => "313", 
                'app_id' => "600157", 
                'org_id' => "139", 
                'src_address' => 'GHIS', //not more than 11 characters
                'dst_address' => '0209969656',
                'service_id' => "", 
                'operation' => "send", 
                'timestamp' => preg_replace('/\D/', '', date("YYYYmmddHHiiss")), 
                'auth_key' => md5(600157 . date("YYYYmmddHHiiss") . "!QAZ2wsx*") 
            ];
            

              $curl = curl_init($url); 
                  curl_setopt($curl, CURLOPT_HEADER, false); 
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
              curl_setopt($curl, CURLOPT_POST, true); 
              curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                  $ucm_response = curl_exec($curl);
                  return $ucm_response;

      }
 ?>