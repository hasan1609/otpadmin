<?php
include 'koneksi.php';

function getcodeapp($sender,$content,$mysqli){

	$result = mysqli_query($mysqli, "SELECT * FROM `app` ORDER BY `app`");

	if ($result->num_rows > 0) {
	  // output data of each row
		
	  while($row = $result->fetch_assoc()) {
		//echo '<br>';
	    preg_match("/".strtolower($row['app'])."/", strtolower($sender),$matches, PREG_OFFSET_CAPTURE);

	 ///   echo $row['app'];

		    if (empty($matches[0][0])) {
		    	//echo 'filter sender KOSONG<br>';

		    	 preg_match("/".strtolower($row['app'])."/", strtolower($content),$mat, PREG_OFFSET_CAPTURE);

		    	 if (empty($mat)) {
		    	 //	echo 'filter sms KOSONG<br>';
		    	 //	return "OTHER";

		    	 }else{
		    	 	//echo 'filter sms ada';
		    	 	return $row['idapp'];

		    	 }
		    }else{
		    	//echo 'filter sender ADA';
		    		return $row['idapp'];

	   		 	}
	    

	  }
		} else {
		  echo "0 results";
		}
}

function getcodeop($nomor,$mysqli){
	$result = mysqli_query($mysqli, "SELECT * FROM `provider` WHERE `nomor` LIKE '".substr($nomor, 0, 4)."'");


	  // output data of each row
		
	  while($row = $result->fetch_assoc()) {

	  	return $row['idop'];

	  		
			  }
}
?>