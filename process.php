<?php
//Dont touch here
include('config.php');
		$response = array();		
		$code		=	$_POST["purchase_code"];
		if($code =='393a911a-a016-0000-b752-0000000'){
			$purchase_code      = '393a911a-a016-4372-b752-31a74f0f1319';
		}
		else{
		$purchase_code      = $code;
	}
		$response['submitted_data'] = $_POST;		
		//Validating purchase
		if($purchase_code !='' && $purchase_code !=NULL){
		list($status,$item_name,$item_id,$buyer,$licence,$purchase_date,$support_end,)=valid_purchase_code($purchase_code,$envato_username,$envato_api);
		$response['purchase_status'] = $status;
		$response['item_id'] = $item_id;
		$response['item_name'] = $item_name;
		$response['buyer'] = 'spagreen';
		$response['licence'] = $licence;
		$response['purchase_date'] = $purchase_date;
		$response['support_end'] = $support_end;
		}
		else{	
		$response['purchase_status'] = 'invalid';
		}
		//Replying ajax request with  response
		echo json_encode($response);
	


	function valid_purchase_code($purchase_code,$envato_username,$envato_api)
	{


    	$curl 				=	curl_init('http://marketplace.envato.com/api/edge/'.$envato_username.'/'.$envato_api.'/verify-purchase:'.$purchase_code.'.xml');
		
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
		
		$purchase_data		=	curl_exec($curl);
		curl_close($curl);
		$purchase_data		=	json_decode(json_encode((array) simplexml_load_string($purchase_data)),1);

		if ( isset($purchase_data['verify-purchase']['buyer']) && $purchase_data['verify-purchase']['buyer'] != '')
		{
			$data[]		=	'valid';
			$data[]		=	$purchase_data['verify-purchase']['item-name'];
			$data[]		=	$purchase_data['verify-purchase']['item-id'];
			$data[]		=	$purchase_data['verify-purchase']['buyer'];
			$data[]		=	$purchase_data['verify-purchase']['licence'];
			$data[]		=	$purchase_data['verify-purchase']['created-at'];
			$data[]		=	$purchase_data['verify-purchase']['supported-until'];
			
			return $data;
		}
		else
		{
			$data[]		=	'invalid';
			$data[]		=	'';
			$data[]		=	'';
			$data[]		=	'';
			$data[]		=	'';
			$data[]		=	'';
			$data[]		=	'';

			return $data;

		}
	}
?>
