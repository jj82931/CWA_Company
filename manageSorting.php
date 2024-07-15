<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    global $connnection;
    require_once("settings.php");
    $connnection = new mysqli($host, $user, $pwd, $sql_db);
    session_start();

    if ($connnection->connect_error) {
        die("Connection failed: " . $connnection->connect_error);
    }else{
        $sorting = $_POST["sorting"];
        $query = "SELECT * FROM eoi ORDER BY EOInumber $sorting";
        $result = $connnection->query($query);

        if ($result->num_rows > 0) {
            $searchResult = array();
            while ($row = $result->fetch_assoc()) {
                $searchResult[] = $row;
            }
            $_SESSION['sorting'] = $searchResult;
            header("Location: manage.php");
        } else {
            echo "<script>
                    alert('Error');
                    window.location.href = 'manage.php'; 
                </script>";
        }
    }
?>