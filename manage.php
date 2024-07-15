<?php
    /* 
    manage.php
    - Displays a list of applicants in a table format.
    - Users can search for applicant information by firstname and lastname.
    - The table list can be displayed in ascending and descending order based on the EOI number.
    - Users can input the desired position number to delete the entire list of applicants who applied for that position.
    - Users can receive statistics by clicking the "Generate" button.
    Author: Chaeyeon Im
    */
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    session_start();

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
    <title>Manage applicants</title>
</head>
<body>
    
    <?php
        include('menu.inc');
    ?>
    <div class="manage-container">
    <h3>Hello Manager!</h3>
    <h5>Connected database on NO AI solutuion Server</h5><br>
    <div class = "manage-button-inline-enhancement"> <!--Ascending order button-->
        <form method="post" action="manageSorting.php" name="formAscId">
            <input type="hidden" name="sorting" value="asc">
            <input type="submit" value="Ascending order by EOI number" class="manage-button-enhancement">
        </form>
    </div>
    <div class = "manage-button-inline-enhancement"> <!--Descending order button-->
        <form method="post" action="manageSorting.php" name="formDescId">
            <input type="hidden" name="sorting" value="desc">
            <input type="submit" value="Descending order by EOI number" class="manage-button-enhancement">
        </form>
    </div>
    <div class = "manage-button-inline-enhancement"> <!--Create report button-->
        <form method="post" action="manageReport.php" name="formReport">
            <input type="hidden" name="report" value="generate">
            <input type="submit" value="Generate Report" class="manage-button-enhancement">
        </form>
    </div>
        <table class="manage-table-center">
            <tr><!--This is the initial table loaded. The functionalities to display based on the position number or etc.. through buttons are shown in the Result table below. -->
                <th>EOInumber</th>
                <th>JobReferenceNumber</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>StreetAddress</th>
                <th>Suburb</th>
                <th>State</th>
                <th>Postcode</th>
                <th>Email</th>
                <th>Phone</th>
                <th>SkillHTML</th>
                <th>SkillJAVA</th>
                <th>SkillC</th>
                <th>SkillDB</th>
                <th>SkillNODE</th>
                <th>SkillPHOTO</th>
                <th>OtherSkills</th>
                <th>Status</th>
            </tr>
            <?php 
                if ($connnection->connect_error) {
                    die("Connection failed: " . $connnection->connect_error);
                }else{

                    //When the user clicks on sorting, the values stored in session storage are retrieved using a foreach loop.
                    if(isset($_SESSION['sorting'])){
                        $searchResult = $_SESSION['sorting'];
                        foreach ($searchResult as $row) {
                            echo "<tr>";
                            echo "<td>" . $row['EOInumber'] . "</td>";
                            echo "<td>" . $row['JobReferenceNumber'] . "</td>";
                            echo "<td>" . $row['Firstname'] . "</td>";
                            echo "<td>" . $row['Lastname'] . "</td>";
                            echo "<td>" . $row['StreetAddress'] . "</td>";
                            echo "<td>" . $row['Suburb'] . "</td>";
                            echo "<td>" . $row['State'] . "</td>";
                            echo "<td>" . $row['Postcode'] . "</td>";
                            echo "<td>" . $row['Email'] . "</td>";
                            echo "<td>" . $row['Phone'] . "</td>";
                            echo "<td class='skillCheck'>" . $row['SkillHTML'] . "</td>";
                            echo "<td class='skillCheck'>" . $row['SkillJAVA'] . "</td>";
                            echo "<td class='skillCheck'>" . $row['SkillC'] . "</td>";
                            echo "<td class='skillCheck'>" . $row['SkillDB'] . "</td>";
                            echo "<td class='skillCheck'>" . $row['SkillNODE'] . "</td>";
                            echo "<td class='skillCheck'>" . $row['SkillPHOTO'] . "</td>";
                            echo "<td>" . $row['OtherSkills'] . "</td>";
                            echo "<td>" . $row['Status'] . "</td>";
                            echo "</tr>";
                        }
                        unset($_SESSION['sorting']);

                    }else{
                        //This is the initial table loaded
                        $query = "SELECT * from eoi";
                        $resultquery = $connnection->query($query);
                        if($resultquery->num_rows > 0){
                            $rows = array();
                            while($row = mysqli_fetch_assoc($resultquery)) {
                                echo "<tr>";
                                echo "<td>".$row['EOInumber']."</td>";
                                echo "<td>".$row['JobReferenceNumber']."</td>";
                                echo "<td>".$row['Firstname']."</td>";
                                echo "<td>".$row['Lastname']."</td>";
                                echo "<td>".$row['StreetAddress']."</td>";
                                echo "<td>".$row['Suburb']."</td>";
                                echo "<td>".$row['State']."</td>";
                                echo "<td>".$row['Postcode']."</td>";
                                echo "<td>".$row['Email']."</td>";
                                echo "<td>".$row['Phone']."</td>";
                                echo "<td class='skillCheck'>".$row['SkillHTML']."</td>";
                                echo "<td class='skillCheck'>".$row['SkillJAVA']."</td>";
                                echo "<td class='skillCheck'>".$row['SkillC']."</td>";
                                echo "<td class='skillCheck'>".$row['SkillDB']."</td>";
                                echo "<td class='skillCheck'>".$row['SkillNODE']."</td>";
                                echo "<td class='skillCheck'>".$row['SkillPHOTO']."</td>";
                                echo "<td>".$row['OtherSkills']."</td>";
                                echo "<td>".$row['Status']."</td>";
                                echo "</tr>";
                            }
                        }else{
                            echo "<h4 style='color: red;'>SQL query error: ".mysqli_error($connnection)."</h4><br>";
                        }
                    }                   
                }
            ?>
        </table>
        <hr>
        <div class="manage-left">
            <div class="manage-group">
                <div class="manage-button-inline">
                    <!--Retrieve specific job reference number button-->
                    <form method="post" action="searchPosition.php" name="formSearchPosition">
                        <select name="managePosition" id="managePosition" class="form-selectPosition">
                            <optgroup label="Please Select Position number">
                                <option value="AABBB">Chief Technology Officer(AABBB)</option>
                                <option value="AACCC">Front-end Developer(AACCC)</option>
                            </optgroup>
                        </select>
                        <input type="submit" value="Search Position" class="manage-hyperButton">
                    </form>
                </div>
            </div>
            <div class="manage-group">
                <div class="manage-button-inline">
                    <!--Delete specific job reference number button-->
                    <form method="post" action="deletePosition.php" name="formDeletePosition">
                        <select name="manageDeletePosition" id="manageDeletePosition" class="form-selectPosition">
                            <optgroup label="Please Select Position number">
                                <option value="AABBB">Chief Technology Officer(AABBB)</option>
                                <option value="AACCC">Front-end Developer(AACCC)</option>
                            </optgroup>
                        </select>
                        <input type="submit" value="Delete Position" class="manage-hyperButton">
                    </form>
                </div>
            </div>
            <div class="manage-group">
                <div class="manage-button-inline">
                    <!--Retrieve specific first name button-->
                    <form method="post" action="searchFName.php" name="formSearchFirstname">
                        <input type="text" name="firstname">
                        <input type="submit" value="Search Firstname" class="manage-hyperButton">
                    </form>
                </div>
            </div>
            <div class="manage-group">
                <div class="manage-button-inline">
                    <!--Retrieve specific last name button-->
                    <form method="post" action="searchLName.php" name="formSearchLastname">
                        <input type="text" name="lastname">
                        <input type="submit" value="Search lastname" class="manage-hyperButton">
                    </form>
                </div>
            </div>
            <div class="manage-group">
                <div class="manage-button-inline">
                    <!--Button to Change Status of a Specific EOI Number-->
                    <form method="post" action="changeStatus.php" name="formChangeStatus">
                        <input type="text" name="selectEOI">
                        <select name="manageSelectStatus" id="manageSelectStatus" class="form-selectStatus">
                            <optgroup label="Please Select the status">
                                <option value="New">New</option>
                                <option value="Current">Current</option>
                                <option value="Final">Final</option>
                            </optgroup>
                        </select>
                        <input type="submit" value="Change Status" class="manage-hyperButton">
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <div class="manage-left">
        <?php
            if(isset($_SESSION['showTable'])){

                /*This part displays HTML tags for the table when there is session storage (showTable). 
                This design choice was made to only show the HTML (tr, th) tags when the button is clicked and the result table is generated. 
                This approach ensures that the table headers are not displayed unnecessarily, improving readability and accessibility.*/
                echo"
                <h2>Result table</h2>
                <table class='manage-table-center'>
                    <tr>
                        <th>EOInumber</th>
                        <th>JobReferenceNumber</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>StreetAddress</th>
                        <th>Suburb</th>
                        <th>State</th>
                        <th>Postcode</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>SkillHTML</th>
                        <th>SkillJAVA</th>
                        <th>SkillC</th>
                        <th>SkillDB</th>
                        <th>SkillNODE</th>
                        <th>SkillPHOTO</th>
                        <th>OtherSkills</th>
                        <th>Status</th>
                    </tr>";

                //This is an 'if' statement that operates when the 'searchPosition' value is present in session storage. 
                //It allows retrieval of applicants with a specific job reference number from the database
                if (isset($_SESSION['searchPosition'])){
                    $searchResult = $_SESSION['searchPosition'];
                    foreach ($searchResult as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['EOInumber'] . "</td>";
                        echo "<td>" . $row['JobReferenceNumber'] . "</td>";
                        echo "<td>" . $row['Firstname'] . "</td>";
                        echo "<td>" . $row['Lastname'] . "</td>";
                        echo "<td>" . $row['StreetAddress'] . "</td>";
                        echo "<td>" . $row['Suburb'] . "</td>";
                        echo "<td>" . $row['State'] . "</td>";
                        echo "<td>" . $row['Postcode'] . "</td>";
                        echo "<td>" . $row['Email'] . "</td>";
                        echo "<td>" . $row['Phone'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillHTML'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillJAVA'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillC'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillDB'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillNODE'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillPHOTO'] . "</td>";
                        echo "<td>" . $row['OtherSkills'] . "</td>";
                        echo "<td>" . $row['Status'] . "</td>";
                        echo "</tr>";
                    }
                    unset($_SESSION['searchPosition']);
                }

                //if statement for delete the specific postion
                if (isset($_SESSION['deletePosition'])){
                    echo "<script>alert('Table removed');</script>";
                    unset($_SESSION['deletePosition']);
                }

                //This is an 'if' statement that operates when the 'searchFirstname' value is present in session storage.
                //It allows retrieval of applicants with a specific first name from the database
                if (isset($_SESSION['searchFirstname'])){
                    $searchResult = $_SESSION['searchFirstname'];
                    foreach ($searchResult as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['EOInumber'] . "</td>";
                        echo "<td>" . $row['JobReferenceNumber'] . "</td>";
                        echo "<td>" . $row['Firstname'] . "</td>";
                        echo "<td>" . $row['Lastname'] . "</td>";
                        echo "<td>" . $row['StreetAddress'] . "</td>";
                        echo "<td>" . $row['Suburb'] . "</td>";
                        echo "<td>" . $row['State'] . "</td>";
                        echo "<td>" . $row['Postcode'] . "</td>";
                        echo "<td>" . $row['Email'] . "</td>";
                        echo "<td>" . $row['Phone'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillHTML'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillJAVA'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillC'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillDB'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillNODE'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillPHOTO'] . "</td>";
                        echo "<td>" . $row['OtherSkills'] . "</td>";
                        echo "<td>" . $row['Status'] . "</td>";
                        echo "</tr>";
                    }
                    unset($_SESSION['searchFirstname']);
                }

                if (isset($_SESSION['searchLastname'])){
                    $searchResult = $_SESSION['searchLastname'];
                    foreach ($searchResult as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['EOInumber'] . "</td>";
                        echo "<td>" . $row['JobReferenceNumber'] . "</td>";
                        echo "<td>" . $row['Firstname'] . "</td>";
                        echo "<td>" . $row['Lastname'] . "</td>";
                        echo "<td>" . $row['StreetAddress'] . "</td>";
                        echo "<td>" . $row['Suburb'] . "</td>";
                        echo "<td>" . $row['State'] . "</td>";
                        echo "<td>" . $row['Postcode'] . "</td>";
                        echo "<td>" . $row['Email'] . "</td>";
                        echo "<td>" . $row['Phone'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillHTML'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillJAVA'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillC'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillDB'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillNODE'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillPHOTO'] . "</td>";
                        echo "<td>" . $row['OtherSkills'] . "</td>";
                        echo "<td>" . $row['Status'] . "</td>";
                        echo "</tr>";
                    }
                    unset($_SESSION['searchLastname']);
                }

                //This is an 'if' statement that operates when the 'changeStatus' value is present in session storage.
                if (isset($_SESSION['changeStatus'])){
                    $searchResult = $_SESSION['changeStatus'];
                    foreach ($searchResult as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['EOInumber'] . "</td>";
                        echo "<td>" . $row['JobReferenceNumber'] . "</td>";
                        echo "<td>" . $row['Firstname'] . "</td>";
                        echo "<td>" . $row['Lastname'] . "</td>";
                        echo "<td>" . $row['StreetAddress'] . "</td>";
                        echo "<td>" . $row['Suburb'] . "</td>";
                        echo "<td>" . $row['State'] . "</td>";
                        echo "<td>" . $row['Postcode'] . "</td>";
                        echo "<td>" . $row['Email'] . "</td>";
                        echo "<td>" . $row['Phone'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillHTML'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillJAVA'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillC'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillDB'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillNODE'] . "</td>";
                        echo "<td class='skillCheck'>" . $row['SkillPHOTO'] . "</td>";
                        echo "<td>" . $row['OtherSkills'] . "</td>";
                        echo "<td>" . $row['Status'] . "</td>";
                        echo "</tr>";
                    }
                    echo "<h4 style='color: blue;'>The status is changed. Please check the table.</h4><br>";
                    unset($_SESSION['changeStatus']);
                }
                
                unset($_SESSION['showTable']); //Remove session value of the 'showTable'
            }

            //This is an 'if' statement for generate report
            if (isset($_SESSION['reportApplicant'])){
                echo "<h3 style='color: blue;'>Generated Report</h3><br>";

                $searchResult = $_SESSION['reportApplicant']; 
                foreach ($searchResult as $row) {
                    echo "<div class='manage-button-inline'>";
                    echo "<span><h3>Total number of applicants :&nbsp</h3></span>";
                    echo "</div>";
                    echo "<div class='manage-button-inline'>";
                    echo "<p>". $row['Number_of_applicant'] ."</p>";
                    echo "</div><br>";
                }
                $searchResult = $_SESSION['job1'];
                foreach ($searchResult as $row) {
                    echo "<div class='manage-button-inline'>";
                    echo "<h3>Number of applicants who applied for the Chief Technology Officer position(AABBB) :&nbsp</h3>";
                    echo "</div>";
                    echo "<div class='manage-button-inline'>";
                    echo "<p>". $row['job1_count'] ."</p>";
                    echo "</div><br>";
                }
                $searchResult = $_SESSION['job2'];
                foreach ($searchResult as $row) {
                    echo "<div class='manage-button-inline'>";
                    echo "<h3>Number of applicants who applied for the Front-end position(AACCC) :&nbsp</h3>";
                    echo "</div>";
                    echo "<div class='manage-button-inline'>";
                    echo "<p>". $row['job2_count'] ."</p>";
                    echo "</div><br>";
                }
                $searchResult = $_SESSION['skillHTML'];
                foreach ($searchResult as $row) {
                    echo "<div class='manage-button-inline'>";
                    echo "<h3>Number of applicants with HTML skills :&nbsp</h3>";
                    echo "</div>";
                    echo "<div class='manage-button-inline'>";
                    echo "<p>". $row['html_count'] ."</p>";
                    echo "</div><br>";
                }
                $searchResult = $_SESSION['skillJAVA'];
                foreach ($searchResult as $row) {
                    echo "<div class='manage-button-inline'>";
                    echo "<h3>Number of applicants with JAVA skills :&nbsp</h3>";
                    echo "</div>";
                    echo "<div class='manage-button-inline'>";
                    echo "<p>". $row['java_count'] ."</p>";
                    echo "</div><br>";
                }
                $searchResult = $_SESSION['skillC'];
                foreach ($searchResult as $row) {
                    echo "<div class='manage-button-inline'>";
                    echo "<h3>Number of applicants with C skills :&nbsp</h3>";
                    echo "</div>";
                    echo "<div class='manage-button-inline'>";
                    echo "<p>". $row['c_count'] ."</p>";
                    echo "</div><br>";
                }
                $searchResult = $_SESSION['skillDB'];
                foreach ($searchResult as $row) {
                    echo "<div class='manage-button-inline'>";
                    echo "<h3>Number of applicants with DB skills :&nbsp</h3>";
                    echo "</div>";
                    echo "<div class='manage-button-inline'>";
                    echo "<p>". $row['db_count'] ."</p>";
                    echo "</div><br>";
                }
                $searchResult = $_SESSION['skillNODE'];
                foreach ($searchResult as $row) {
                    echo "<div class='manage-button-inline'>";
                    echo "<h3>Number of applicants with Node.JS skills :&nbsp</h3>";
                    echo "</div>";
                    echo "<div class='manage-button-inline'>";
                    echo "<p>". $row['node_count'] ."</p>";
                    echo "</div><br>";
                }
                $searchResult = $_SESSION['skillPHOTO'];
                foreach ($searchResult as $row) {
                    echo "<div class='manage-button-inline'>";
                    echo "<h3>Number of applicants with PhotoShop skills :&nbsp</h3>";
                    echo "</div>";
                    echo "<div class='manage-button-inline'>";
                    echo "<p>". $row['photo_count'] ."</p>";
                    echo "</div><br>";
                }
                
                unset($_SESSION['reportApplicant']);
                unset($_SESSION['skillHTML']);
                unset($_SESSION['skillJAVA']);
                unset($_SESSION['skillC']);
                unset($_SESSION['skillDB']);
                unset($_SESSION['skillNODE']);
                unset($_SESSION['skillPHOTO']);
                unset($_SESSION['job1']);
                unset($_SESSION['job2']);
            }
            ?>
        </table>
        </div>
    </div>
    <script>
        /* This section handles displaying checkmark images in the table if skills are checked. 
        It selects the 'td' tags with the class name 'skillCheck' from the currently displayed table. 
        The 'checkImageUrl' variable holds the path to the checkmark image, while 'noneImageUrl' holds the path to the X image.*/
        var cells = document.querySelectorAll(".skillCheck"); 
        var checkImageUrl = "images/check.png";
        var noneImageUrl = "images/x.png";
        
        /* In the application page, when a skill is checked, it is stored as 1 in the database. 
        Therefore, if the 'tutpe' value is 1, the image source ('src') is set to the checkmark image; otherwise, it is set to the X image. */
        cells.forEach(function(cell) {
            if (cell.textContent === "1") {
                cell.innerHTML = '<img src="' + checkImageUrl + '" alt="Checked">';
            }else {
                cell.innerHTML = '<img src="' + noneImageUrl + '" alt="None">';
            }
            
        });
    </script> 
    
    <footer>
        <?php
            include('footer.inc');
        ?>
    </footer>
</body>
</html>
