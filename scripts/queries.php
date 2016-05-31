<?php 
// Database Connection
require_once('scripts/connection.php');


// App Functions
function getUsers(){
	$sql = "SELECT id, firstname, lastname FROM MyGuests";
	$result = $conn->query($sql);

}
?>