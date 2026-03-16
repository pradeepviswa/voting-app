
<?php
include "db.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Voting Results</title>
</head>

<body>

<h1>Voting Results</h1>

<?php

$parties = ["Party A","Party B","Party C","Party D"];

foreach($parties as $p){

$result = $conn->query("SELECT COUNT(*) as total FROM votes WHERE party='$p'");
$row = $result->fetch_assoc();

echo "<h3>$p : ".$row['total']." votes</h3>";

}

?>

<br>
<a href="index.html">Back to Vote</a>

</body>
</html>
