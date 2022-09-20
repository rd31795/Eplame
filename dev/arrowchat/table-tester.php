<?php
$db_host = 'localhost'; // Server Name
$db_user = 'root'; // Username
$db_pass = 'GD!2#hldGHSukj'; // Password
$db_name = 'weddingwire'; // Database Name

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
}

$a = mysqli_query($conn,"select * from information_schema.columns
where table_schema = '" . $db_name . "'
order by table_name,ordinal_position");
$b = mysqli_fetch_all($a,MYSQLI_ASSOC);
$d = array();
foreach($b as $c){
    if(!is_array($d[$c['TABLE_NAME']])){
        $d[$c['TABLE_NAME']] = array();
    }
    $d[$c['TABLE_NAME']][] = $c['COLUMN_NAME'];
}
echo "<pre>",print_r($d),"</pre>";

// USE BELOW TO DISPLAY TABLE INFORMATION


/*$a = mysqli_query($conn,"SELECT * FROM Wo_Users"); //You don't need a ; like you do in SQL
$b = mysqli_fetch_all($a,MYSQLI_ASSOC);
echo "<table>"; // start a table tag in the HTML

foreach($b as $c){   //Creates a loop to loop through results
echo "<tr><td>" . $c['user_id'] . "</td><td>" . $c['username'] . "</td><td>" . $c['avatar'] . "</td></tr>";  //$row['index'] the index here is a field name
}

echo "</table>"; //Close the table in HTML*/

?>