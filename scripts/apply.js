/**
* Author: Chaeyeon Im
* Target: apply.php, jobs.php
* Purpose: 
            - On apply.php, Data validation and displaying reference number which the user applied for job. 
            and if the user apply for another job during the same browser session, the user's information should be filled automatically on the form.
            - On jobs.php, get reference job number which the user selected the job
*/

function validate() {
    var tempMsg = "";
    var result = true;

    var birth = document.getElementById("birth").value;
    var birthSplit = birth.split('/'); // Divides the value of the Date by this "/" and stores it as an Array.
    var currentdate = new Date(); //Get current date
    var year = currentdate.getFullYear(); //Get only a year
    var age = year - parseInt(birthSplit[2],10); // Convert the second index value to integer decimal.

    var selectState = document.getElementById("selectState");
    var selectStateValue = selectState.selectedIndex; //Get index which the user selected the state from combo box. 
    var postcode = document.getElementById("postcode").value;
    var firstnumberPostcode = postcode[0]; //Get first number of the postcode from first index

    var other = document.getElementById("other").checked;
    var otherDescription = document.getElementById("otherSkills").value;

    var birthSpan = document.getElementById("hideTextBirth");
    var postSpan = document.getElementById("hideTextPostcode");
    var otherSpan = document.getElementById("hideTextOther");
    


    if(!birth.match(/^\d{1,2}\/\d{1,2}\/\d{4}$/)) { //Date of birth validation.
        birthSpan.textContent = "Date of birth must be dd/mm/yyyy";
        result = false;
    }
    else if(age <= 14 || age >= 81){ //Age validation
        birthSpan.textContent = "Your age is " + age + ". We only accept applicant who age between 15 to 80. Sorry ^_^.";
        result = false;
    }else{
        birthSpan.textContent = "";
    }

    if(selectStateValue == -1) { //Show error message if the user did not select their state
        postSpan.textContent = "Please select one of the state from the list.";
        result = false;
    }
    else if(!postcode.match(/^(\d{4})$/)){ //Postcode validation
        postSpan.textContent = "The postcode must be four digits.";
        result = false;
    }else{
        postSpan.textContent = "";
    }

    
    if(selectStateValue >= 0){ //if the user select state, the combox's index must be over 0.
        tempMsg = postcodeCheck(selectStateValue,firstnumberPostcode);

        if (tempMsg != ""){
            postSpan.textContent = tempMsg;
            result = false;
        }
    }
    
    
    if(other == true){ //if the user checked other checkbox, that return true
        if(otherDescription.length == 0){ //Checking textarea's length.
            otherSpan.textContent = "You have checked the other skills. Please describe your skills.";
            result = false;
        }else{
            otherSpan.textContent = "";
        }
    }
    else if(other == false){ //If the user wrote something on otherSkill description box without checking other skill, show error message. 
        if(otherDescription.length >= 1){ 
            otherSpan.textContent = "You have not checked the other skills. Please check other skills, if you want to describe your skills.";
            result = false;
        }else{
            otherSpan.textContent = "";
        }
    }else{
        otherSpan.textContent = "";
    }

    

    return result;

}

function postcodeCheck(selectStateValue, firstnumberPostcode) { //Get comboBox index which the user selected and first digit of postcode 

    /* Here is an if statement created to display the same error within a single span. If the user selects "Victoria" and enters "555," an error message asking for a 4-digit number and prompting for the correct postcode for Victoria should appear. 
    However, I have separated the functionality into two functions, and in one of the functions, I use a switch statement to determine the appropriate postcode based on the selected state.*/
    var errMsg = "";
    var postSpan = document.getElementById("hideTextPostcode").textContent;
    
    //State Validation part
    switch(selectStateValue){ 
        case 0:
            if(firstnumberPostcode !== '3' && firstnumberPostcode !== '8'){
                errMsg = "You selected state of Victoria. The first number of postcode must be 3 or 5.";
            }
            break;
        case 1:
            if(firstnumberPostcode !== '1' && firstnumberPostcode !== '2'){
                errMsg = "You selected state of New South Wales. The first number of postcode must be 1 or 2.";
            }
            break;
        case 2:
            if(firstnumberPostcode !== '4' && firstnumberPostcode !== '9'){
                errMsg = "You selected state of Queensland. The first number of postcode must be 4 or 9.";
            }
            break;
        case 3:
            if(firstnumberPostcode !== '0'){
                errMsg = "You selected state of Nothern territory or Australian Capital Territory. The first number of postcode must be 0.";
            }
            break;
        case 4:
            if(firstnumberPostcode !== '6'){
                errMsg = "You selected state of Western Australia. The first number of postcode must be 6.";
            }
            break;
        case 5:
            if(firstnumberPostcode !== '5'){
                errMsg = "You selected state of South Australia. The first number of postcode must be 5.";
            }
            break;
        case 6:
            if(firstnumberPostcode !== '7'){
                errMsg = "You selected state of Tasmania. The first number of postcode must be 7.";
            }
            break;
        case 7:
            if(firstnumberPostcode !== '0'){
                errMsg = "You selected state of Nothern territory or Australian Capital Territory. The first number of postcode must be 0.";
            }
            break;
    }

    /*Here, if the postSpan is empty, meaning that a 4-digit number has been entered, only the message that comes out after breaking from the switch statement is displayed. 
    If the postSpan value is not empty, it implies that the postcode is not 4 digits, so the error message from the break statement is combined and displayed. */
    if(postSpan == ""){
        return errMsg;
    }else if(postSpan != "") {
        return postSpan + " Also " + errMsg;
    }
}

/*
In the autofill part, the process of obtaining element IDs seems to overlap with the autofillGet function, potentially leading to unnecessary memory usage. 
Initially, I considered storing data in an array but found the process of retrieving values too complex. 
I am now looking for a way to store data like a hash map with keys and values.
*/
function autofillStore() {
    var fillEmail = document.getElementById("email").value;
    var fillFname = document.getElementById("fname").value;
    var fillLname = document.getElementById("lname").value;
    var fillPhone = document.getElementById("phone").value;
    var fillBirth = document.getElementById("birth").value;
    var fillStreet = document.getElementById("street").value;
    var fillSuburb = document.getElementById("suburb").value;
    var fillPostcode = document.getElementById("postcode").value;
    var fillOtherskills = document.getElementById("otherSkills").value;

    //Get value the state and country code which the user selected from comboBox
    var comboConturyCode = document.getElementById("countrycode");
    var fillCounturyCode = comboConturyCode.options[comboConturyCode.selectedIndex].value;
    var comboState = document.getElementById("selectState");
    var fillState = comboState.options[comboState.selectedIndex].value;

    var selectedOptionGender = document.querySelector('input[name="gender"]:checked');
    var fillGender = selectedOptionGender.value;
    sessionStorage.setItem('gender',fillGender);

    var selectedOptionSkills = document.getElementsByName("category-skills[]");
    selectedOptionSkills.forEach(function (checkbox) { //Get checkbox element

        var checkboxValue = checkbox.value; //Get checkbox's value
        var Checked = checkbox.checked; //if checkbox is checked, the status should true
        sessionStorage.setItem(checkboxValue, Checked);
    });
    
    //Store each information
    sessionStorage.setItem('email',fillEmail);
    sessionStorage.setItem('fname',fillFname);
    sessionStorage.setItem('lname',fillLname);
    sessionStorage.setItem('countryCode',fillCounturyCode);
    sessionStorage.setItem('phone',fillPhone);
    sessionStorage.setItem('birth',fillBirth);
    sessionStorage.setItem('street',fillStreet);
    sessionStorage.setItem('suburb',fillSuburb);
    sessionStorage.setItem('state',fillState);
    sessionStorage.setItem('postcode',fillPostcode);
    sessionStorage.setItem('otherSkills',fillOtherskills);

}

function autofillGet() {
    var fillEmail = document.getElementById("email");
    var fillFname = document.getElementById("fname");
    var fillLname = document.getElementById("lname");
    var fillPhone = document.getElementById("phone");
    var fillBirth = document.getElementById("birth");
    var fillStreet = document.getElementById("street");
    var fillSuburb = document.getElementById("suburb");
    var fillPostcode = document.getElementById("postcode");
    var fillOtherskills = document.getElementById("otherSkills");

    var getGender = sessionStorage.getItem('gender');
    var getCountryCode = sessionStorage.getItem('countryCode');
    var getState = sessionStorage.getItem('state');

    //Load values from session
    fillEmail.value = sessionStorage.getItem('email');
    fillFname.value = sessionStorage.getItem('fname');
    fillLname.value = sessionStorage.getItem('lname');
    fillPhone.value = sessionStorage.getItem('phone');
    fillBirth.value = sessionStorage.getItem('birth');
    fillStreet.value = sessionStorage.getItem('street');
    fillSuburb.value = sessionStorage.getItem('suburb');
    fillPostcode.value = sessionStorage.getItem('postcode');
    fillOtherskills.value = sessionStorage.getItem('otherSkills');

    var selectedOptionGender = document.getElementsByName("gender");
    for (var i = 0; i < selectedOptionGender.length; i++) {
        if (selectedOptionGender[i].value === getGender) { //Through a for loop, it checks whether the value of a radio button in an array matches the value retrieved from the session.
            selectedOptionGender[i].checked = true; //If there is a match, it changes the state of that radio button to "checked."
            break; //Only one radio button can be selected, the loop exits after finding a match.
        }
    }

    var selectedOptionSkills = document.getElementsByName("category-skills[]");
    selectedOptionSkills.forEach(function (checkbox) {

        var checkboxValue = checkbox.value;
        var Checked = sessionStorage.getItem(checkboxValue) === 'true'; //Get only a true value
        checkbox.checked = Checked;
    });

    //Retrieves the values of a combo box stored in session storage.
    var comboConturyCode = document.getElementById("countrycode");
    comboConturyCode.value = getCountryCode;
    var comboState = document.getElementById("selectState");
    comboState.value = getState;

}

/*-----------------------------------Jobs.php JS part ------------------------------------------------- */

function storeValue(){

    var jobReferenceNumber1 = document.getElementById("job-referenceNumber1").innerHTML;
    var jobReferenceNumber2 = document.getElementById("job-referenceNumber2").innerHTML;

    if(typeof(Storage)!=="undefined"){ //Checking whether the web browser supports session and local storage.
        window.localStorage.setItem('localReferenceNumber1',jobReferenceNumber1);
        window.localStorage.setItem('localReferenceNumber2',jobReferenceNumber2);
            
    }else{
        alert("This web browzer is not supporting a web storage. Sorry\n");
    }
}

function checkValidation() {

    var jobButton1 = document.getElementById("jobApplyButton1");
    var jobButton2 = document.getElementById("jobApplyButton2");
    

    jobButton1.addEventListener('click', function(){
        if(confirm("Are you sure that apply for the Chief Technology Officer?\n")){
            alert("Move on the application page\n"); //Show message to the user
            window.location = 'apply.php'; //When the user click a ok button, then move on apply.php
            window.localStorage.setItem('index',1); //Store button index

        } else {
            alert("Your requesting is cancelled."); //If the user canclled button, show this message.
        }
    });
    
    jobButton2.addEventListener('click', function(){
        if(confirm("Are you sure that apply for the Front-end Developer?\n")){
            alert("Move on the application page\n");
            window.location = 'apply.php';
            window.localStorage.setItem('index',2);
                
        } else {
            alert("Your requesting is cancelled.\n");
        }
    });
}

function getValue(jobIndex) { //Displays the reference number of the job selected by the user by comparing button indexes.
    var jobReferenceForm = document.getElementById("referenceNumberForm");
    var getReferenceNumber;

    if(jobIndex == 1){
        getReferenceNumber = localStorage.getItem('localReferenceNumber1');
        jobReferenceForm.value = getReferenceNumber;
    }
    else if(jobIndex == 2){
        getReferenceNumber = localStorage.getItem('localReferenceNumber2');
        jobReferenceForm.value = getReferenceNumber;

    }else{
        alert("Sorry, Reference number could not get from local storage.\n");
    }
}

/*-----------------------------------Jobs.php JS part end ------------------------------------------------- */



function init () {
    var index = localStorage.getItem('index');
    var result = true; 
    var debug = true;
    

    if(window.location.pathname.endsWith("/jobs.php")){ //Based on the characters following the '/' in the URL path, the developer can determine which function to execute, specifying what action to take on which page.
        storeValue();
        checkValidation();
    }
    else if(window.location.pathname.endsWith("/apply.php")){
        if(index == 1){ //It compares the index of the button selected by the user. Since it was stored in local storage in checkValidation, system can compare it here.
            getValue(index);
            autofillGet();
        }
        else if(index == 2){
            getValue(index);
            autofillGet();
        }
        if(!debug){
            var apply = document.getElementById("apply-js");
            /* Initially, I created two onsubmit handlers to call both the validate() and autofillStore() functions. However, it was mentioned(I saw some post on stackOverFlow) that with this approach, only the last function would be executed. 
            So, I added the isValid variable. When validate functions properly, it returns a true value for the result variable, allowing the subsequent autofillStore function to execute. */
            apply.onsubmit = function() { 
                result = validate(); 
                if (result == true) {
                    autofillStore(); 
                    return true;
                }
                else if(result == false){
                    return false;
                }
            };
        }
    }
 }

 window.onload = init;

