
<?php
include "db.php";

if(isset($_POST['party'])){

$party = $_POST['party'];

$sql = "INSERT INTO votes (party) VALUES ('$party')";
$conn->query($sql);

echo "<h2>Thank you for voting!</h2>";
echo "<a href='results.php'>See Results</a>";
}

?>
