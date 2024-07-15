<?php
    /* 
    deletePosition.php
    Receiving the position number by the user as a post, storing the results in sessionStorage using a delete query.
    Author: Chaeyeon Im
    */
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    session_start();
    unset($_SESSION['deletePosition']);

    $connnection;
    require_once("settings.php");
    $connnection = new mysqli($host, $user, $pwd, $sql_db);

    if ($connnection->connect_error) {
        die("Connection failed: " . $connnection->connect_error);
    }else{
        $manageDeletePosition = $_POST["manageDeletePosition"]; //Getting the position number
        if(empty($manageDeletePosition)){
            echo "<script>
                    alert('Please select position.');
                    window.location.href = 'manage.php'; 
                </script>";
        }else{
            $query = "DELETE FROM eoi WHERE JobReferenceNumber = '$manageDeletePosition'"; 
            $result = $connnection->query($query);
            if($result){
                if($result == true){
                    
                    $_SESSION['deletePosition'] = $result;
                    echo "<script>
                            alert('Position Deleted');
                            window.location.href = 'manage.php'; 
                        </script>";
                }else{
                    echo "<script>
                            alert('No tables');
                            window.location.href = 'manage.php'; 
                        </script>";
                }
            }else{
                echo "<script>
                        alert('No Result');
                        window.location.href = 'manage.php'; 
                    </script>";
            }
        }
    }
?>

