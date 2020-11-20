<?php
//include the class that will generate WSDL file from PhP class
require "../php2wsdl/src/PHPClass2WSDL.php";
require "../vendor/autoload.php"; 
// will be created by composer once you install php composer and run composer install
//don't forget to create composer.json file

$class="CurrencyConvertor";
$serviceURI="http://localhost/ToCode3Section2/WS2/ws2.php";
$expectedFile="CurrencyConvertor.wsdl";


class CurrencyConvertor {

    public function Conversion($amount)
    {
        //1 TND = 0,368095 USD 
        // Source : https://www.xe.com/fr/currencyconverter/convert/?Amount=1&From=TND&To=USD

        $amountUSD = $amount * 0.368095 ;
        return array('amount en USD '=>$amountUSD);
    }
    
}



$gen = new \PHP2WSDL\PHPClass2WSDL($class, $serviceURI);

// Generate the WSDL from the class adding only the public methods.
$gen->generateWSDL();

//store generated wsdl content in a file
file_put_contents($expectedFile, $gen->dump());

//show a link to generated WSDL
echo "Generated WSDL:";
echo "<a href='http://localhost/ToCode3Section2/WS2/$expectedFile'>$expectedFile</a><br/>";
?>