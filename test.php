<?php


$final_array = array(
		"IP" 		=> "A363045858",		//必要
		"SID" 		=> "JWTEST01000001",	//必要
		"N1" 		=> "TEST",				//
		"K1" 		=> 5000,				//必要
		"FUKA" 		=> "",					//
		"KAKUTEI"	=> "",					//
		"STORE"		=> "51",				//必要
		"OKURL"		=> "",
		"RT"		=> "",
		"NAME1"		=> "",
		"NAME2"		=> "",
		"TEL"		=> "",
		"ADR1"		=> "",
		"ADR2"		=> "",
		"MAIL"		=> "",
	); 

		$url = 'https://www2.paydesign.jp/settle/settle2/ubp25.dll';
		$url = 'https://www2.paydesign.jp/settle/settle2/ubp3.dll';

		$final_array = http_build_query($final_array);
		$opts = array( 'http' => array(
										'method'  => 'POST',
										'header'  => 'Content-type: application/x-www-form-urlencoded;charset=Shift_JIS',
										//'header'  => 'Content-type: text/plain;charset=Shift_JIS',
										'content' => $final_array
										)
						);
		$context  = stream_context_create($opts);
		
		//get result
		$result = file_get_contents($url, false, $context);
		//echo $result;
		
		//make visible what's between each data -> %0D%0A
		$encode_result= urlencode($result);
		//echo '<p>'.$encode_result.'</p>';
		
		//treat result
		list($return_state) = explode('%0D%0A', $encode_result);
		//echo '<p>$return_state= '.$return_state.'</p>';
				
		//check if correct
		if($return_state == 'OK') :
			echo 'IN';
			list($card_process, $sid, $k1, $request_code, $resquest_sequence, $fuka, $blank) = explode('%0D%0A', $encode_result);
			//echo $cb_process.' - '.$sid.' - '.$k1.' - '.$request_code.' - '.$resquest_sequence.' - '.$fuka.' - '.$blank;
			
			//create Session to keep data in case of error
			//$_SESSION['request_code'] = $request_code; 
			//$_SESSION['resquest_sequence'] = $resquest_sequence;
			var_dump( $result);			
		elseif($return_state == 'PRERROR' || $return_state == 'ERROR' ):
			echo 'OUT';
			echo $result;
		endif;

?>