<?php
  
	require_once('../lib/nusoap.php');
	$error  = '';
	$result = '';
	$response = '';
	$wsdl1 = "http://localhost/ToCode3Section2/WS1/WS1.php?wsdl";
	$wsdl2 = "http://localhost/ToCode3Section2/WS2/CurrencyConvertor.wsdl";

	if(isset($_POST['btn'])){
		if($response){
		if(!$error){
			//create client object
			$client2 = new nusoap_client($wsdl2, true);
			 try {
				 
				$result = $client2->call('Conversion', array('amount' =>$response[amount]));
				
			  }catch (Exception $e2) {
			    echo 'Caught exception: ',  $e2->getMessage(), "\n";
			 }
		}}
	}	

	/* Add new Reservation **/
	if(isset($_POST['addbtn'])){
		$customer = trim($_POST['customer']);
		$amount = trim($_POST['amount']);


		if(!$error){
			
			$client1 = new nusoap_client($wsdl1, true);
			$err = $client1->getError();
			if ($err) {
				echo '<h2>Constructor error</h2>' . $err;
				
			    exit();
			}
			 try {
				 
				 $response =  $client1->call('reservation', array('customer' => $customer,'amount'=>$amount));

				 if($response){
					if(!$error){
						//create client object
						$client2 = new nusoap_client($wsdl2, true);
						 try {
							 
							$result = $client2->call('Conversion', array('amount' =>$response[amount]));
							
						  }catch (Exception $e2) {
							echo 'Caught exception: ',  $e2->getMessage(), "\n";
						 }
					}}


			  }catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			 }
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reservation Web Service</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
   <h2>Reservation Information</h2>

  <table class="table">
    <thead>
      <tr>
        <th>Customer</th>
        <th>Amount en TND</th>
        <th>Amount en USD</th>
      </tr>
    </thead>
    <tbody>
    <?php if($response){ ?>
		      <tr>
		        <td><?php echo $response[customer]; ?></td>
		        <td><?php echo $response[amount]; ?></td>
		        <td><?php echo $result[amountUSD]; ?></td>
				<td>
				<button type="submit" name='btn' class="btn btn-default">Conversion en USD</button>
				</td>
		      </tr>
      <?php 
  		} ?>
    </tbody>
  </table>
	<div class='row'>
	<h2>Add New Reservation</h2>
	 <?php if(isset($$response->status)) {

	  if($response->status == 200){ ?>
		<div class="alert alert-success fade in">
    			<a href="#" class="close" data-dismiss="alert">&times;</a>
    			<strong>Success!</strong>&nbsp; Reservation Added succesfully. 
	        </div>
	  <?php }elseif(isset($response) && $response->status != 200) { ?>
			<div class="alert alert-danger fade in">
    			<a href="#" class="close" data-dismiss="alert">&times;</a>
    			<strong>Error!</strong>&nbsp; Cannot Add a reservation. Please try again. 
	        </div>
	 <?php } 
	 }
	 ?>
  	<form class="form-inline" method = 'post' name='form1'>
  		<?php if($error) { ?> 
	    	<div class="alert alert-danger fade in">
    			<a href="#" class="close" data-dismiss="alert">&times;</a>
    			<strong>Error!</strong>&nbsp;<?php echo $error; ?> 
	        </div>
		<?php } ?>
	    <div class="form-group">
	      <input type="text" class="form-control" name="customer" id="customer" placeholder="Enter customer" required>
	      <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter amount en TND" required>
			
	    </div>
	    <button type="submit" name='addbtn' class="btn btn-default">Add New Reservation</button>

    </form>
   </div>
</div>

</body>
</html>



