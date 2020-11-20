<?php
class Reservation {

    public function customer_reservation($customer,$amount)
    {
        return array('customer'=>$customer,'amount'=>$amount);
    }
    public function hello($customer) 
    {
        return 'hello customer: '.$customer; 
    } 
}
?>