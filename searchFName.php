<?php
    session_start();

    global $connnection;
    require_once("settings.php");
    $connnection = new mysqli($host, $user, $pwd, $sql_db);

    if ($connnection->connect_error) {
        die("Connection failed: " . $connnection->connect_error);
    }else{
        $managefirstname = $_POST["firstname"];
        if(empty($managefirstname)){
            echo "<script>
                    alert('Please. write firstname.');
                    window.location.href = 'manage.php'; 
                </script>";
        }else{
            $query = "SELECT * FROM eoi WHERE Firstname = '$managefirstname'";
            $result = $connnection->query($query);

            if ($result->num_rows > 0) {
                $searchResult = array();
                while ($row = $result->fetch_assoc()) {
                    $searchResult[] = $row;
                }
                $_SESSION['searchFirstname'] = $searchResult;
                $_SESSION['showTable'] = 1;
                header("Location: manage.php");
            } else {
                echo "<script>
                        alert('No result');
                        window.location.href = 'manage.php'; 
                    </script>";
            }
        }
    }
?>
