<?php

class CurrencyConvertor {

    public function Conversion($amount)
    {
        //1 TND = 0,368095 USD 
        // Source : https://www.xe.com/fr/currencyconverter/convert/?Amount=1&From=TND&To=USD
        $amountUSD = $amount * 0.368095 ;
        return array('amountUSD'=>$amountUSD);
    }
    
}

$options = array("uri" => "http://localhost");
//create a SOAPServer instance
$server = new SoapServer(null, $options);
//define the class the SOAP service should expose
$server->setClass('CurrencyConvertor'); 
 $server->handle();
 ?>


