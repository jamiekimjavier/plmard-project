
<?php

	$host = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'project';

	$conn = mysqli_connect($host, $user, $password, $database);
	$con = mysqli_connect($host, $user, $password, $database);

	if (!$conn){
		?>
			<script>alert("Connection Unsuccessful!!!")</script>;
		<?php
	}
?>
