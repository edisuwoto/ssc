<?php

if(isset($_GET['send_notification'])){
   send_notification ();
}

function send_notification()
{
	
	//echo 'Infix Edu';
define( 'API_ACCESS_KEY', 'AAAA5vQoj3w:APA91bHVEmjj6T1LR4H8lUq4boQ7Po1tol0jifwg9bUWUf7bbu1vExT6h1zacFRf1X5298BQeQO1H98UYMM1KZzVaCT73Lfuwa4EDGpZZ-t2ITjiiBe5DanAtKdDgfAPao6io_taByzz');
 //   $registrationIds = ;
#prep the bundle
     $msg = array
          (
		'body' 	=> $_REQUEST['body'],
		'title'	=> $_REQUEST['title'],
             	
          );
	$fields = array
			(
				'to'		=> $_REQUEST['token'],
				'notification'	=> $msg
			);
	
	
	$headers = array
			(
				'Authorization: key=' . API_ACCESS_KEY,
				'Content-Type: application/json'
			);
#Send Reponse To FireBase Server	
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		echo $result;
		curl_close( $ch );
}
?>