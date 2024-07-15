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
        $report = $_POST["report"];
        $flag = 0;
        if(empty($report)){

            echo "<script>
                    alert('Error');
                    window.location.href = 'manage.php'; 
                </script>";
        }else{

            $query = "SELECT COUNT(*) AS Number_of_applicant FROM eoi WHERE EOInumber;";
            $result = $connnection->query($query);
            if ($result->num_rows > 0) {
                $searchResult = array();
                while ($row = $result->fetch_assoc()) {
                    $searchResult[] = $row;
                }
                $_SESSION['reportApplicant'] = $searchResult;
                $flag = $flag + 1;
            }
            $query_skillHTML = "SELECT COUNT(*) AS html_count FROM eoi WHERE SkillHTML = 1";
            $result2 = $connnection->query($query_skillHTML);
            if ($result2->num_rows > 0) {
                $searchResult = array();
                while ($row = $result2->fetch_assoc()) {
                    $searchResult[] = $row;
                }
                $_SESSION['skillHTML'] = $searchResult;
                $flag = $flag + 1;
            }
            $query_skillJAVA = "SELECT COUNT(*) AS java_count FROM eoi WHERE SkillJAVA = 1";
            $result3 = $connnection->query($query_skillJAVA);
            if ($result3->num_rows > 0) {
                $searchResult = array();
                while ($row = $result3->fetch_assoc()) {
                    $searchResult[] = $row;
                }
                $_SESSION['skillJAVA'] = $searchResult;
                $flag = $flag + 1;
            }
            $query_skillC = "SELECT COUNT(*) AS c_count FROM eoi WHERE SkillC = 1";
            $result4 = $connnection->query($query_skillC);
            if ($result4->num_rows > 0) {
                $searchResult = array();
                while ($row = $result4->fetch_assoc()) {
                    $searchResult[] = $row;
                }
                $_SESSION['skillC'] = $searchResult;
                $flag = $flag + 1;
            }
            $query_skillDB = "SELECT COUNT(*) AS db_count FROM eoi WHERE SkillDB = 1";
            $result5 = $connnection->query($query_skillDB);
            if ($result5->num_rows > 0) {
                $searchResult = array();
                while ($row = $result5->fetch_assoc()) {
                    $searchResult[] = $row;
                }
                $_SESSION['skillDB'] = $searchResult;
                $flag = $flag + 1;
            }
            $query_skillNODE = "SELECT COUNT(*) AS node_count FROM eoi WHERE SkillNODE = 1";
            $result6 = $connnection->query($query_skillNODE);
            if ($result6->num_rows > 0) {
                $searchResult = array();
                while ($row = $result6->fetch_assoc()) {
                    $searchResult[] = $row;
                }
                $_SESSION['skillNODE'] = $searchResult;
                $flag = $flag + 1;
            }
            $query_skillPHOTO = "SELECT COUNT(*) AS photo_count FROM eoi WHERE SkillPHOTO = 1";
            $result7 = $connnection->query($query_skillPHOTO);
            if ($result7->num_rows > 0) {
                $searchResult = array();
                while ($row = $result7->fetch_assoc()) {
                    $searchResult[] = $row;
                }
                $_SESSION['skillPHOTO'] = $searchResult;
                $flag = $flag + 1;
            }
            $query_job1 = "SELECT COUNT(*) AS job1_count FROM eoi WHERE JobReferenceNumber = 'AABBB'";
            $result8 = $connnection->query($query_job1);
            if ($result8->num_rows > 0) {
                $searchResult = array();
                while ($row = $result8->fetch_assoc()) {
                    $searchResult[] = $row;
                }
                $_SESSION['job1'] = $searchResult;
                $flag = $flag + 1;
            }
            $query_job2 = "SELECT COUNT(*) AS job2_count FROM eoi WHERE JobReferenceNumber = 'AACCC'";
            $result9 = $connnection->query($query_job2);
            if ($result9->num_rows > 0) {
                $searchResult = array();
                while ($row = $result9->fetch_assoc()) {
                    $searchResult[] = $row;
                }
                $_SESSION['job2'] = $searchResult;
                $flag = $flag + 1;
            }

            if($flag == 9){
                header("Location: manage.php");
            }else{
                echo "<script>
                            alert('Failed generating report');
                            window.location.href = 'manage.php'; 
                        </script>";
            }

        }
    }
?>