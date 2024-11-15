<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "DBMS";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->beginTransaction();
    $conn->exec("INSERT INTO STUDENT (STU_ID, F_NAME, L_Name, FATHER_NAME, DOB, 
BRANCH, CGPA, MESS_ID, HOSTEL_ID, ROOM_NO)
VALUES ('$_POST[sid]','$_POST[fname]','$_POST[lname]','$_POST[father]',
'$_POST[dob]','$_POST[branch]','$_POST[cgpa]','$_POST[mess]',
'$_POST[hostel]','$_POST[room]')");

 $conn->commit();
    echo "<table style='border: solid 1px black;'>";
 echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th><th>FATHER'S NAME</th><th>DOB</th><th>BRANCH</th><th>CGPA</th><th>HOSTEL ID</th><th>MESS ID</th><th>ROOM NO</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
}  $stmt = $conn->prepare("SELECT * FROM STUDENT"); 
    $stmt->execute();
     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
    
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }

$conn = null;
?>
