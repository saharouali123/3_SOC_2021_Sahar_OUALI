<?php

// je ne trouve pas un service web qui fait la conversion de la monnaie
// il y a un service sous le lien suivant mais il ne marche pas
//http://www.webservicex.com/CurrencyConvertor.asmx?wsdl 
// c'est pour cela j'ai creé mon propre service web afin de pouvoir travailler le reste
$options = array(
	"location" => "http://localhost/ToCode3Section2/WS2/ws2.php",
	"uri" => "http://localhost",
	'trace' => 1);
try {
 // No WSDL is given.  we need to provide web service URI.   
$client = new SoapClient(null, $options); 
$result = $client->Conversion(1000); 
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