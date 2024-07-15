<?php
    session_start();
    unset($_SESSION['deletePosition']);
    global $connnection;
    require_once("settings.php");
    $connnection = new mysqli($host, $user, $pwd, $sql_db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include('header.inc');
    ?>
    <title>Searching Position</title>
</head>
<body>
    <?php
        include('menu.inc');
    ?>
    <div class="manage-container">
    <?php 
    if ($connnection->connect_error) {
        die("Connection failed: " . $connnection->connect_error);
    }else{
        $managePosition = $_POST["managePosition"];
        if(empty($managePosition)){
            echo "<script>
                    alert('Please select position.');
                    window.location.href = 'manage.php'; 
                </script>";
        }else{
            $query = "SELECT * FROM eoi WHERE JobReferenceNumber = '$managePosition'";
            $result = $connnection->query($query);

            if ($result->num_rows > 0) {
                $searchResult = array();
                while ($row = $result->fetch_assoc()) {
                    $searchResult[] = $row;
                }
                
                $_SESSION['searchPosition'] = $searchResult;
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
    
    </div> 
    <footer>
        <?php
            include('footer.inc');
        ?>
    </footer>
</body>
</html>
