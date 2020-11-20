<?php
$options = array(
	"location" => "http://localhost/ToCode3Section2/WS-TD/WS-TD.php",
	"uri" => "http://localhost",
	'trace' => 1);
try {
$client = new SoapClient(null, $options); 
$result = $client->customer_reservation("Sahar OUALI",350); 
echo '<br/><h1>Service response</h1>';
print_r($result);
} 
catch (SoapFault $e) {
    echo '<br/><h1>Error: </h1>';
var_dump($e); 
}
// print soap request and response (debug)
	echo '<br/><h1>SOAP Request</h1>'.htmlspecialchars($client->__getLastRequest()).'<br/>';
	echo '<br/><h1>SOAP Response </h1>'.htmlspecialchars($client->__getLastResponse()).'<br/>';
 
?>