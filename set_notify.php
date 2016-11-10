<?php

if(!empty($_POST)){

	date_default_timezone_set('Asia/Kolkata');

	$msg = htmlentities($_POST['notification']);
	$date = $_POST['date']." 00:00:00";

	try{

			$db_name = getenv('db_name');
			$db_username = getenv('db_username');
			$db_password = getenv('db_password');
			$db_collection =  getenv('db_collection');


			$connect = "mongodb://".$db_username.":".$db_password."@ds149567.mlab.com:49567/$db_name";

			
			$connection = new MongoClient($connect);
			
			$db= $connection->selectDB($db_name);
			$collection = $db->selectCollection($db_collection);
			$collection->remove();
			$document= array();

			$document['notification'] = $msg;
			$document['expireAt'] = new MongoDate(strtotime($date));
			$collection->save($document);
			$collection->createIndex(array('expireAt' => 1),
			 array('expireAfterSeconds' => 0));
			echo "Notification Published........Redirecting to Home...Please Wait";
			header('refresh:2;url=index.php');

	}catch(Exception $e){
			die('Exception....Try Again');
	}
	



}


?>