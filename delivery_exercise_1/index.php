<?php
echo "questo è il mio DevOps Exercise!<br>";

$mysqli = new mysqli("db", "root", "rootpass", "testdb");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
} else {
    echo "Connected to MySQL successfully!<br>";
    $result = $mysqli->query("SHOW DATABASES;");
    while ($row = $result->fetch_assoc()) {
        echo $row["Database"] . "<br>";
    }
}
?>
