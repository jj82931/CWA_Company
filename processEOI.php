<?php 
/* 
    processEOI.php
    - Check validation value from application form
    - Store the user's information to database if that information is valid.
    Author: Chaeyeon Im
*/

$allowedReferer = 'apply.php'; // Allowing processing only if the request comes from a specific page
if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != "" && strpos($_SERVER['HTTP_REFERER'], $allowedReferer) !== false) {
    /*
    This if statement that checks if the 'Referer' header is set in the HTTP request and is not empty. 
    It also verifies whether the referring URL contains a specific allowed referer string ($allowedReferer). 
    Allowing processing if the request comes from the specified previous page
    */
    global $connnection;
    require_once("settings.php");
    $connnection = new mysqli($host, $user, $pwd, $sql_db);

} else {
    echo "<script>
            alert('This is invalid approach. Return to the job description page.');
            window.location.href = 'jobs.php'; 
          </script>"; // Redirecting to the jobs.php if the request comes from a different page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include('header.inc');
    ?>
    <title>ProcessEOI</title>
</head>
<body>
    <?php
        include('menu.inc');
    ?>
    <div class="process-container">
        
        <?php 
            if ($connnection->connect_error) {
                die("Connection failed: " . $connnection->connect_error);
            }else{
                echo"<h3>Please, Check your information carefully. If the alert box does not appear, please make sure to check the error message at bottom.</h3>
                    <h5>Connected database on NO AI solutuion Server</h5><br>";
            }
            
            $errMsg="";
            
            function sanitise_input($data){ //sanitise all input value
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            function job_Validation(){
                $errMsg = "";
                if (empty($_POST["refernceNumberForm"])){
                    return $errMsg = "Please, apply for specific job on description page.";
                }
                if(isset($_POST["refernceNumberForm"])) {
                    global $refernceNumberForm;
                    $refernceNumberForm = $_POST["refernceNumberForm"];
                    $refernceNumberForm= sanitise_input($refernceNumberForm);
                }
            }

            function email_Validation(){
                $errMsg = "";
                if (isset($_POST["email"])) {
                    global $email;
                    $email = $_POST["email"];
                    $email= sanitise_input($email);
                }
                if ($email == ""){
                    return $errMsg = "You must enter your email.";
                }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    return $errMsg = "You must match email format Ex)abc@com.au";
                }
            }

            function firstname_Validation(){
                $errMsg = "";
                if (isset($_POST["fname"])) {
                    global $fname;
                    $fname = $_POST["fname"];
                    $fname= sanitise_input($fname);
                }

                if ($fname == ""){
                    return $errMsg = "You must enter your first name.";
                }else if (!preg_match("/^[a-zA-Z]{1,20}$/", $fname)){
                    return $errMsg = "max 20 alpha letters allowed in your first name.";
                }
            }

            function lastname_Validation(){
                $errMsg = "";
                if (isset($_POST["lname"])) {
                    global $lname;
                    $lname = $_POST["lname"];
                    $lname= sanitise_input($lname);
                }
                
                if ($lname == ""){
                    return $errMsg = "You must enter your last name.";
                }else if (!preg_match("/^[a-zA-Z]{1,20}$/", $lname)){
                    return $errMsg = "max 20 alpha letters allowed in your last name.";
                }
            }
            function country_Validation(){
                $errMsg = "";
                if (isset($_POST["countrycode"])) {
                    global $countrycode;
                    $countrycode = $_POST["countrycode"];
                    $countrycode= sanitise_input($countrycode);
                }
                if (!isset($_POST["countrycode"])){
                    return $errMsg = "You must select country code.";
                }
            }
            function phone_Validation(){
                $errMsg = "";
                if (isset($_POST["phone"])) {
                    global $phone;
                    $phone = $_POST["phone"];
                    $phone= sanitise_input($phone);
                }
                
                if ($phone == ""){
                    return $errMsg = "You must enter your phone number.";
                }else if (!preg_match("/^[0-9\s]{8,12}$/", $phone)){
                    return $errMsg = "Only 8-12 digits allowed";
                }
            }
            function dob_Validation(){
                $errMsg = "";
                global $age;
                if (isset($_POST["birth"])) {
                    global $birth;
                    $birth = $_POST["birth"];
                    $birth= sanitise_input($birth);
                }
                /*
                ^: Represents the start of the string.
                (0[1-9]|[12][0-9]|3[01]): Matches days from 01 to 31.
                \/: Matches the forward slash (/) character.
                (0[1-9]|1[0-2]): Matches months from 01 to 12.
                \/: Matches another forward slash (/) character.
                \d{4}: Matches exactly four digits for the year.                    
                $: Represents the end of the string. 
                */
                if ($birth == ""){
                    return $errMsg = "You must enter your date of birth.";
                }
                else if (!preg_match("/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/", $birth)){ 
                    return $errMsg = "Please, match format dd/mm/yyyy";
                }
                else if(isset($_POST["birth"])){
                    $birth = $_POST["birth"];
                    $transit_birth = new DateTime($birth);
                    $currentDate = new DateTime(date('m.d.y'));
                    $age = $currentDate->diff($transit_birth)->y;
                }
                if((14 > $age) || ($age > 81)){ 
                    return $errMsg = "The applicant's age must be between 15 ~ 80.";
                }
            }
            function gender_Validation(){
                $errMsg = "";
                if (!isset($_POST["gender"])){
                    return $errMsg = "You must select gender.";
                }
                if (isset($_POST["gender"])) {
                    global $gender;
                    $gender = $_POST["gender"];
                }
            }
            function street_Validation(){
                $errMsg = "";
                if (isset($_POST["street"])) {
                    global $street;
                    $street = $_POST["street"];
                    $street= sanitise_input($street);
                }
                
                if ($street == ""){
                    return $errMsg = "You must enter your street address.";
                }else if (!preg_match("/^[a-zA-Z]{1,40}$/", $street)){
                    return $errMsg = "max 40 letters allowed in your street address.";
                }
            }
            function suburb_Validation(){
                $errMsg = "";
                if (isset($_POST["suburb"])) {
                    global $suburb;
                    $suburb = $_POST["suburb"];
                    $suburb= sanitise_input($suburb);
                }
                
                if ($suburb == ""){
                    return $errMsg = "You must enter your suburb.";
                }else if (!preg_match("/^[a-zA-Z]{1,40}$/", $suburb)){
                    return $errMsg = "max 40 letters allowed in your suburb.";
                }
            }
            function state_Validation(){
                $errMsg = "";
                if (isset($_POST["selectState"])) {
                    global $selectState;
                    $selectState = $_POST["selectState"];
                    $selectState= sanitise_input($selectState);
                }
                if (!isset($_POST["selectState"])){
                    return $errMsg = "You must select State.";
                }
            }
            function postcode_Validation(){
                $errMsg = "";
                if (!isset($_POST["selectState"])){
                    return $errMsg = "Please, select State.";
                }
                if (isset($_POST["postcode"])) {
                    global $postcode;
                    $postcode = $_POST["postcode"];
                    $postcode= sanitise_input($postcode);
                }
                if (isset($_POST["selectState"])) {
                    $selectState = $_POST["selectState"];
                    $selectState= sanitise_input($selectState);
                }
                if ($postcode == ""){
                    return $errMsg = "You must enter your postcode.";
                }else if(!preg_match("/^\d{4}$/", $postcode)){
                    return $errMsg = "Postcode must be 4 digits";
                }

                if($selectState == "VIC"){
                    if(!preg_match("/^[38]\d{3}$/", $postcode)){
                        return $errMsg = "You selected VIC. The first number of postcode must be 3 or 8.";
                    }
                }
                if($selectState == "NSW"){
                    if(!preg_match("/^[12]\d{3}$/", $postcode)){
                        return $errMsg = "You selected NSW. The first number of postcode must be 1 or 2.";
                    }
                }
                if($selectState == "QLD"){
                    if(!preg_match("/^[49]\d{3}$/", $postcode)){
                        return $errMsg = "You selected QLD. The first number of postcode must be 4 or 9.";
                    }
                }
                if($selectState == "ACT" || $selectState == "NT"){
                    if(!preg_match("/^0\d{3}$/", $postcode)){
                        return $errMsg = "You selected ACT or NT. The first number of postcode must be 0.";
                    }
                }
                if($selectState == "WA"){
                    if(!preg_match("/^6\d{3}$/", $postcode)){
                        return $errMsg = "You selected WA. The first number of postcode must be 6.";
                    }
                }
                if($selectState == "SA"){
                    if(!preg_match("/^5\d{3}$/", $postcode)){
                        return $errMsg = "You selected SA. The first number of postcode must be 5.";
                    }
                }
                if($selectState == "TAS"){
                    if(!preg_match("/^7\d{3}$/", $postcode)){
                        return $errMsg = "You selected TAS. The first number of postcode must be 7.";
                    }
                }
            }
            function skills_Validation(){
                $skillList = "";
                if (isset($_POST["category-skills"])) {
                    $skills = $_POST["category-skills"];
                    foreach($skills as $checkbox){
                        $skillList = implode(", ", $skills);
                    }
                }
                return $skillList;
            }
            function other_Validation(){
                $errMsg = "";
                global $textarea;
                global $flag;
                global $s_htmlset;
                global $s_java;
                global $s_c;
                global $s_db;
                global $s_node;
                global $s_photo;
                global $s_other;
                $textarea = "";
                $s_htmlset = 0;
                $s_java = 0;
                $s_c = 0;
                $s_db = 0;
                $s_node = 0;
                $s_photo = 0;
                $s_other = 0;

                //If the skill checked, store 1.
                $textarea = $_POST["textarea"];
                $skillList = skills_Validation();
                if(strpos($skillList,"html, css, js") !== false){
                    $s_htmlset = 1;
                }
                if(strpos($skillList,"java") !== false){
                    $s_java = 1;
                }
                if(strpos($skillList,"C") !== false){
                    $s_c = 1;
                }
                if(strpos($skillList,"DB") !== false){
                    $s_db = 1;
                }
                if(strpos($skillList,"node_js") !== false){
                    $s_node = 1;
                }
                if(strpos($skillList,"photoshop") !== false){
                    $s_photo = 1;
                }
                
                if(in_array("other", $_POST["category-skills"])){
                    if(empty($textarea)) {
                        $flag = 1;
                        return $errMsg = "You checked the other on checkbox. Please write your other skills on description";
                    }
                    if (isset($_POST["textarea"])) {
                        $textarea= sanitise_input($textarea);
                        $s_other = 1;
                    }
                }else{
                    if ($textarea !== ""){
                        $flag = 2;
                        return $errMsg = "You must checked the other on checkbox before writing description";
                    }
                }
            }
           

            //if the eoi table does not exist
            $tableList = "Show tables";
            $result = $connnection->query($tableList);
            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {
                    if ($row["Tables_in_" . $sql_db] === "eoi") {
                        $tableExists = true;
                        break;
                    }
                }
                if ($tableExists) {
                    echo "<h2>Application Detail</h2><br>";
                    
                } else {
                    echo "<script> alert('Cannot find eoi table. Creating eoi table...');</scripts>";
                    
                    $createTable = "CREATE TABLE `eoi` (
                        `EOInumber` INT(11) NOT NULL AUTO_INCREMENT,
                        `JobReferenceNumber` VARCHAR(30) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
                        `Firstname` VARCHAR(30) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
                        `Lastname` VARCHAR(30) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
                        `StreetAddress` VARCHAR(100) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
                        `Suburb` VARCHAR(50) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
                        `State` VARCHAR(30) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
                        `Postcode` VARCHAR(30) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
                        `Email` VARCHAR(50) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
                        `Phone` VARCHAR(30) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
                        `SkillHTML` TINYINT(4) NULL DEFAULT '0',
                        `SkillJAVA` TINYINT(4) NULL DEFAULT '0',
                        `SkillC` TINYINT(4) NULL DEFAULT '0',
                        `SkillDB` TINYINT(4) NULL DEFAULT '0',
                        `SkillNODE` TINYINT(4) NULL DEFAULT '0',
                        `SkillPHOTO` TINYINT(4) NULL DEFAULT '0',
                        `OtherSkills` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                        `Status` VARCHAR(10) NOT NULL DEFAULT 'New' COLLATE 'utf8mb4_general_ci',
                        PRIMARY KEY (`EOInumber`) USING BTREE
                    )
                    COLLATE='utf8mb4_general_ci'
                    ENGINE=InnoDB
                    AUTO_INCREMENT=2;";

                    $resultCreate = $connnection->query($createTable);
                    if($resultCreate === true){
                        echo "<script> 
                        alert('Created eoi Table. Return to the application page.');
                        window.location.href = 'apply.php'; 
                        </script>";
                    }
                }
            }
            
        ?>
        <div class="process-form">
            <div class="process-group">
                <div class="process-form-label">
                    <label for="process-job">Job Reference Number</label>
                </div>
                <div class="process-form-display">
                    <p>
                        <?php
                            $errMsg = job_Validation();
                            if($errMsg != ""){
                                echo "<p class='process-form-color'>".$errMsg."</p>";
                            }else{
                                echo $refernceNumberForm;
                            }
                        ?>
                    </p>
                </div>
            </div>
            <div class="process-group">
                <div class="process-form-label">
                    <label for="process-email">email</label>
                </div>
                <div class="process-form-display">
                    <p>
                        <?php
                            $errMsg = email_Validation();
                            if($errMsg != ""){
                                echo "<p class='process-form-color'>".$errMsg."</p>";
                            }else{
                                echo $email;
                            }
                        ?>
                    </p>
                </div>
            </div>
            <div class="process-group">
                <div class="process-form-label">
                    <label for="process-firstname">firstname</label>
                </div>
                <div class="process-form-display">
                    <p>
                        <?php
                            $errMsg = firstname_Validation();
                            if($errMsg != ""){
                                echo "<p class='process-form-color'>".$errMsg."</p>";
                            }else{
                                echo $fname;
                            }
                        ?>
                    </p>
                </div>
            </div>
            <div class="process-group">
                <div class="process-form-label">
                    <label for="process-lastname">lastname</label>
                </div>
                <div class="process-form-display">
                    <p>
                        <?php
                            $errMsg = lastname_Validation();
                            if($errMsg != ""){
                                echo "<p class='process-form-color'>".$errMsg."</p>";
                            }else{
                                echo $lname;
                            }
                        ?>
                    </p>
                </div>
            </div>
            <div class="process-group">
                <div class="process-form-label">
                    <label for="process-phone">Phone</label>
                </div>
                <div class="process-form-smallSelect">
                    <p>
                        <?php
                            $errMsg = country_Validation();
                            if($errMsg != ""){
                                echo "<p class='process-form-color'>".$errMsg."</p>";
                            }else{
                                echo $countrycode;
                            }
                        ?>
                    </p>
                </div>
                <div class="process-form-bigSelect">
                    <p>
                        <?php
                            $errMsg = phone_Validation();
                            if($errMsg != ""){
                                echo "<p class='process-form-color'>".$errMsg."</p>";
                            }else{
                                echo $phone;
                            }
                        ?>
                    </p>
                </div>
            </div>
            <div class="process-group">
                <div class="process-form-label">
                    <label for="process-birth">Date of Birth</label>
                </div>
                <div class="process-form-display">
                    <p>
                        <?php
                            $errMsg = dob_Validation();
                            if($errMsg != ""){
                                echo "<p class='process-form-color'>".$errMsg."</p>";
                            }else{
                                echo $birth."<span> Your age: ".$age."</span>";
                            }
                        ?>
                    </p>
                </div>
            </div>
            <div class="process-group">
                <div class="process-form-label">
                    <label for="process-gender">Gender</label>
                </div>
                <div class="process-form-display">
                    <p>
                        <?php
                            $errMsg = gender_Validation();
                            if($errMsg != ""){
                                echo "<p class='process-form-color'>".$errMsg."</p>";
                            }else{
                                if($gender == "Male"){
                                    echo "Male";
                                }else if($gender == "Female"){
                                    echo "Female";
                                }
                            }
                        ?>
                    </p>
                </div>
            </div>
            <div class="process-group">
                <div class="process-form-label">
                    <label for="process-street">Street Address</label>
                </div>
                <div class="process-form-display">
                    <p>
                        <?php
                            $errMsg = street_Validation();
                            if($errMsg != ""){
                                echo "<p class='process-form-color'>".$errMsg."</p>";
                            }else{
                                echo $street;
                            }
                        ?>
                    </p>
                </div>
            </div>
            <div class="process-group">
                <div class="process-form-label">
                    <label for="process-suburb">Suburb</label>
                </div>
                <div class="process-form-display">
                    <p>
                        <?php
                            $errMsg = suburb_Validation();
                            if($errMsg != ""){
                                echo "<p class='process-form-color'>".$errMsg."</p>";
                            }else{
                                echo $suburb;
                            }
                        ?>
                    </p>
                </div>
            </div>
            <div class="process-group">
                <div class="process-form-label">
                    <label for="process-state">State</label>
                </div>
                <div class="process-form-state">
                    <p>
                        <?php
                            $errMsg = state_Validation();
                            if($errMsg != ""){
                                echo "<p class='process-form-color'>".$errMsg."</p>";
                            }else{
                                echo $selectState;
                            }
                        ?>
                    </p>
                </div>
                <div class="process-form-label2">
                    <label for="process-postcode">Postcode</label>
                </div>
                <div class="process-form-postcode">
                    <p>
                        <?php
                            $errMsg = postcode_Validation();
                            if($errMsg != ""){
                                echo "<p class='process-form-color'>".$errMsg."</p>";
                            }else{
                                echo $postcode;
                            }
                        ?>
                    </p>
                </div>
            </div>
            <div class="process-group">
                <div class="process-form-label">
                        <label for="process-skills">Skills</label>
                </div>
                <div class="process-form-display">
                    <p>
                        <?php
                            $print = skills_Validation();
                            echo $print;
                        ?>
                    </p>
                </div>
            </div>
            <div class="process-group">
                <div class="process-form-label">
                        <label for="process-skills">skill description</label>
                </div>
                <div class="process-form-description">
                    <p>
                        <?php
                            $errMsg = other_Validation();
                            if($errMsg != ""){
                                echo "<p class='process-form-color'>".$errMsg."</p>";
                            }else{
                                echo $textarea;
                            }
                        ?>
                    </p>
                </div>
            </div>
            <?php 
                //If all global variables are not empty, the user's information is stored in the database using an insert query.
                if (empty($refernceNumberForm) || empty($email) || empty($fname) || empty($lname) || empty($countrycode) || empty($phone) 
                || empty($birth) || empty($gender) || empty($street) || empty($suburb) || empty($selectState) || empty($postcode)) {
                    echo "<h4 style='color: red;'>Your information is incorrect. Please check error messages.</h4><br>";
                
                //The flag is set to 1 if the user does not check the 'other skill' option but writes in the 'other description' box. This triggers the corresponding error message. 
                //If the user checks 'other skill' but does not provide input in the 'other description' box, the flag is set to 2, displaying the appropriate error message
                }else if($flag == 1){
                    echo "<h4 style='color: red;'>You checked other skill. Please check error message</h4><br>";
                }else if($flag == 2){
                    echo "<h4 style='color: red;'>Please check error message</h4><br>";
                }else{
                    $fullPhoneNumber = $countrycode . ' ' . $phone;
                    $sql = "INSERT INTO eoi (EOInumber, JobReferenceNumber, Firstname, Lastname, StreetAddress, Suburb, State, Postcode, Email, Phone, SkillHTML, SkillJAVA, SkillC, SkillDB, SkillNODE, SkillPHOTO, OtherSkills, Status)
                    VALUES ('', '$refernceNumberForm', '$fname', '$lname', '$street', '$suburb', '$selectState', '$postcode', '$email', '$fullPhoneNumber', '$s_htmlset', '$s_java', '$s_c', '$s_db', '$s_node', '$s_photo', '$textarea', 'New')";

                    $resultquery = $connnection->query($sql);
                    if($resultquery === true){
                        echo "<script>
                            alert('Your informations are stored sucessfully!');
                            </script>"; 
                    }else{
                        echo "<h4 style='color: red;'>SQL query error: ".mysqli_error($connnection)."</h4><br>";
                    }
                }
            ?>
        </div>
    </div>
      
    <footer>
        <?php
            include('footer.inc');
        ?>
    </footer>
</body>
</html>
