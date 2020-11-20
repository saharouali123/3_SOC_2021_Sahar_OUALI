<?php
require_once("../lib/nusoap.php");

function reservation($customer,$amount)
{
    return array('customer'=>$customer,'amount'=>$amount);
}
function hello($customer) 
{
    return 'hello customer: '.$customer; 
} 

$server = new nusoap_server();
$server->configureWSDL('web service','urn:localhost');
$server->wsdl->schemaTargetNamespace ='urn:localhost';
$server->wsdl->addComplexType(
    'reservationINFO',//complex type name
    'complexType', // type simple/complex
    'struct','all', // All-sequence
    '',
    array(
        'customer'=> array('name' => 'customer', 'type' => 'xsd:string'),
        'amount'=>array('name' => 'amount', 'type' => 'xsd:int')
    )
);
$server ->register('reservation',
    array('customer'=>'xsd:string','amount'=>'xsd:string') , //input
    array('return'=> 'tns:reservationINFO'),//output
    'urn:localhost',   //namespace
    'urn:localhost#reservationServer'  //soapaction           
);

$server -> register('hello',
    array('customer'=>'xsd:string'),//input
    array('return' => 'xsd:string'),  //output
    'urn:localhost',   //namespace
    'urn:localhost#helloServer'  //soapaction   
);

$server->service(file_get_contents("php://input"));
?>