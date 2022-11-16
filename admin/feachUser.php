<?php   
include("../library/database.php");
header('Content-Type: application/json');

//หน่วยรับผิดชอบ
$sql = "SELECT * FROM depart ORDER BY dep_id ASC";
$query  = dbQuery($sql);
$resultArray = array();

while ($result = dbFetchArray($query)) {
    array_push($resultArray,$result);
}

echo json_encode($resultArray);

?>