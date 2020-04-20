<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.viabtc.com/res/openapi/v1/account",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "x-api-key: e44fa72d6b319c6c651785ac00bcb2e9 "
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;die;
}

$response =  json_decode($response,true);
echo '<pre>';
print_r($response);
// die;
if(isset($response['data']['account'])){
	
		$acc_info 	= $response['data']['account'];
		$balance 	= $response['data']['balance'];
		$observer 	= $response['data']['observer'];
		
		
	?>
		<div class="container">
  		     
		  <table class="table">
			
			<tbody>
			    <table>
			        <tr><th colspan="5">Account Info</th></tr>
			        <tr>
				    <td><?php echo 'Account Name: '. $response['data']['account']['account']; ?></td>
				</tr>
 				<tr>
			        <td><?php echo 'Id: '. $response['data']['account']['id']; ?></td>
			    </tr>
			    <tr>
			        <td><?php echo 'Email: '. $response['data']['account']['email']; ?></td>
			    </tr>
			    <tr>
				    <td>
				     <br>   
				    </td>
				</tr>
				<tr><th colspan="5">Wallet Balance</th></tr>
				<?php
				for($i=0;$i < sizeof($balance);$i++){
					echo '<tr><td><img src="'.$balance[$i]['coin'].'.png" height="24" width="24"> &nbsp;&nbsp;' .$balance[$i]['coin'].'&nbsp;&nbsp;'. $balance[$i]['amount'] .'</td></tr>';
				}
				?>
				
				</table>
			</tbody>
		  </table>
		</div>
	
	<?php
}else{
	
	print_r($response);
} ?>

</body>
</html>