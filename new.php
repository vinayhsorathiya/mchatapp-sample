
<?php
//OG Code by: Bruno_Gastaldi @ https://discuss.api.ai/t/webhook-in-php-example/229/8
//Modified by: Kevin.

header('Content-Type: application/json');
function processMessage($update) {
    if($update["result"]["action"] == ""){
    	//Create File.
	$fp = file_put_contents( 'request.log', $update["result"]["parameters"]["msg"] );
		//Return response.
        sendMessage(array(
            "source" => $update["result"]["source"],
            "speech" => $update["result"]["parameters"]["msg"],
            "displayText" => ".........TEXT HERE...........",
            "contextOut" => array()
        ));
    }
}
function sendMessage($parameters) {
	$req_dump = print_r( $parameters, true );
	$fp = file_put_contents( 'reques4.log', $req_dump );
	header('Content-Type: application/json');
    echo json_encode($parameters);
}

$update_response = file_get_contents("php://input");
$update = json_decode($update_response, true);
if (isset($update["result"]["action"])) {
    processMessage($update);
}
?>