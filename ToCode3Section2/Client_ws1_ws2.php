<?php
 
require_once('lib/nusoap.php');
	$error  = '';
	$result = array();
    $wsdl1 = "http://localhost/ToCode3Section2/WS1/WS1.php?wsdl";
	$wsdl2 = "http://localhost/ToCode3Section2/WS2/CurrencyConvertor.wsdl";
    
		if(!$error){
			//create client object
			$client = new nusoap_client($wsdl1, true);
			$err = $client->getError();
			if ($err) {
				echo '<h2>Constructor error</h2>' . $err;
				// At this point, you know the call that follows will fail
			    exit();
			}
			 try {
				 // Call the SOAP method
				$result = $client->call('reservation', array('customer' => 'Sahar','amount'=>350));
                $client2 = new nusoap_client($wsdl2, true);
                   
                try { 
                    $amount = $client2->call('Conversion', array('amount' => $result[amount]));
                    // Display the result
                    echo "<h2>Result<h2/>";
                    print_r($amount) ;
                }
                catch (Exception $ex1) {
                    echo 'Caught exception: ',  $ex1->getMessage(), "\n";
                 }
                
			  }
			  catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			 }
		}	
// Display the request and response (SOAP messages)
echo '<h2>Request</h2>';
echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2>';
echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
// Display the debug messages
echo '<h2>Debug</h2>';
echo '<pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
?>




