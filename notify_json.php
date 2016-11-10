<?php

try{


			
			$db_name = env('db_name');
			$db_username = env('db_username');
			$db_password = env('db_password');
			$db_collection =  env('db_collection');

			$connection = new MongoClient("mongodb://".$db_username:$db_password.
				"@localhost:27017");

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