
<?php
    global $con;
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'project';

	$con = mysqli_connect($host, $user, $password, $database);
    $conn = mysqli_connect($host, $user, $password, $database);

	if (!$con){
		?>
			<script>alert("Connection Unsuccessful!!!")</script>;
		<?php
	}

    error_reporting(E_ALL ^ E_NOTICE);

if (!$con){
    ?>
        <script>alert("Connection Unsuccessful!!!")</script>
    <?php
}

function getAll($table, $con)
{
    global $con;
    $query = "SELECT * FROM $table WHERE status='0'";
    $query_run = mysqli_query($con, $query);

    return $query_run;
}

function getByID($table, $id, $con)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id ='$id'";
    return $query_run = mysqli_query($con, $query);
}

function getNameActive($table, $name)
{
    global $con;
    $query = "SELECT * FROM $table WHERE name ='$name' AND status='0' LIMIT 1";
    return $query_run = mysqli_query($con, $query);
}

function getResearchByCategory($cid, $con)
{
    global $con;
    $query = "SELECT * FROM researches WHERE category_id = '$cid' AND status = 0 AND is_verified = 1";
    $result = mysqli_query($con, $query);
    return $result;
}

function getIDActive($table, $id, $con)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id ='$id' AND status='0'";
    return $query_run = mysqli_query($con, $query);
}

function isUserVerified($user_id, $con) {
    global $con;
    $query = "SELECT is_verified FROM register_user WHERE id = $user_id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['is_verified'] == 1;
}


?>

