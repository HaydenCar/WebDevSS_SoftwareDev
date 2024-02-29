<body>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MyDatabase";

$conn = mysqli_connect ($servername,
                        $username,
                        $password,
                        $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    else
    {
        echo "Successfully Connected to Database<br/><br/>";
    }


    $sql = "SELECT * FROM car;";
    $qryResult = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($qryResult)) {

    echo "reg: " . $row ["regNumber"]. " - Make:" .
        $row["CarMake"]. " " . $row ["CarModel"]. " - Req Date:"
        . $row ['RegDate']." - Value: " . $row["CarValue"]. "<br>";
 }


 mysqli_close ($conn);

 ?>
</body>
