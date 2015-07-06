<?php
/**
 * Simple example of web service
 * @author R. Bartolome
 * @version v1.0
 * @return JSON messages with the format:
 * {
 * 	"code": mandatory, string '0' for correct, '1' for error
 * 	"message": empty or string message
 * 	"data": empty or JSON data
 * }
 *
 * This file can be tested from the browser:
 * http://localhost/webservice-php-json/service_test.php
 *
 * Based on
 * http://www.raywenderlich.com/2941/how-to-write-a-simple-phpmysql-web-service-for-an-ios-app
 */

// the API file
require_once 'api.php';

// creates a new instance of the api class
$api = new api();

// message to return
$message = array();

switch($_POST["action"])
{
	case 'get':
		$params = array();
		$params['id'] = isset($_POST["id"]) ? $_POST["id"] : '';
		if (is_array($data = $api->get($params))) {
			$message["code"] = "0";
			$message["data"] = $data;
		} else {
			$message["code"] = "1";
			$message["message"] = "Error on get method";
		}
		break;

	default:
		$message["code"] = "1";
		$message["message"] = "Unknown method " . $_POST["action"];
		break;
}

//the JSON message
header('Content-type: application/json; charset=utf-8');
echo json_encode($message, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHED);

?>
