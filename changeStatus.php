<?php
    /* 
    changeStatus.php
    Receiving the status selected by the user as a post, storing the results in sessionStorage using a select query.
    Author: Chaeyeon Im
    */
    session_start();
    global $connnection;
    require_once("settings.php");
    $connnection = new mysqli($host, $user, $pwd, $sql_db);

    if ($connnection->connect_error) {
        die("Connection failed: " . $connnection->connect_error);
    }else{
        $selectEOI = $_POST["selectEOI"]; //Getting EOI number which the user selected
        $manageSelectStatus = $_POST["manageSelectStatus"]; //Getting the status which the user selected from select box

        // If the EOI number is null or the select box is not selected by the user, display error
        if(empty($selectEOI)){
            echo "<script>
                    alert('Please. write EOI number.');
                    window.location.href = 'manage.php'; 
                </script>";
        }else if(empty($manageSelectStatus)){
            echo "<script>
                    alert('Please. select the status.');
                    window.location.href = 'manage.php'; 
                </script>";
        }else{

            // Update query
            $query = "UPDATE eoi SET Status = '$manageSelectStatus' WHERE EOInumber = '$selectEOI'";
            $result = $connnection->query($query);
            //if updated query successful, the result query will be stored in the sessionStorage
            $query2 = "SELECT * from eoi WHERE EOInumber = '$selectEOI'";
            $result2 = $connnection->query($query2);
            echo "<script>
                    alert('testing');
                    window.location.href = 'manage.php'; 
                    </script>";

            if ($result == true) {
                
                if ($result2->num_rows > 0){
                    $searchResult = array();
                    while ($row = $result2->fetch_assoc()) {
                        $searchResult[] = $row;
                    }
                    $_SESSION['changeStatus'] = $searchResult; //store the result query
                    $_SESSION['showTable'] = 1; //This value use for flag
                    
                    header("Location: manage.php");
                }else {
                    echo "<script>
                                alert('No result');
                                window.location.href = 'manage.php'; 
                            </script>";
                }
            } else {
                echo "<script>
                            alert('No result');
                            window.location.href = 'manage.php'; 
                        </script>";
            }
        }
    }
?>
