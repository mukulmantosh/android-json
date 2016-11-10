<?php

try{


			
			$db_name = getenv('db_name');
			$db_username = getenv('db_username');
			$db_password = getenv('db_password');
			$db_collection =  getenv('db_collection');

			$connect = "mongodb://".$db_username.":".$db_password."@ds149567.mlab.com:49567/$db_name";


			$connection = new MongoClient($connect);
			$db= $connection->selectDB($db_name);
			$collection = $db->selectCollection($db_collection);
			$collection_count = $collection->count();

			if($collection_count > 0){

				$coll_find= $collection->findOne();
				
				header('Access-Control-Allow-Origin: *');  
				header('Content-type: application/json');
				$result = array("msg" => $coll_find["notification"]);
				echo json_encode($result);

			}else{

				header('Access-Control-Allow-Origin: *');  
				header('Content-type: application/json');
				$result = array("msg" => null);
				echo json_encode($result);
			}



}catch (MongoConnectionException $e) {
        		header('Access-Control-Allow-Origin: *');  
				header('Content-type: application/json');
				$result = array("msg" => "Server Error");
				echo json_encode($result);
    }
        
    catch (MongoException $e) {
        		header('Access-Control-Allow-Origin: *');  
				header('Content-type: application/json');
				$result = array("msg" => "Server Error");
				echo json_encode($result);
    }



?>