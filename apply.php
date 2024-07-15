<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include('header.inc')
    ?>
    <title>Job application</title>
</head>
<body>
    <?php
        include('menu.inc')
    ?>

    <div class="apply-container">
        <!--Animation part-->
        <div class="apply-mention">
            <h3>Application form</h3>
            <div class="apply-animation" id="apply-animation">
                <span>Share your</span>
                <div class="apply-animation-words">
                    <div class="apply-animation-word">Vision</div>
                    <div class="apply-animation-word">Creativity</div>
                    <div class="apply-animation-word">Passion</div>
                </div>
                <p>with our No AI soulution.</p>
            </div>
        </div>
        <div class="apply-container-application">
            <form method="post" action="processEOI.php" id="apply-js" novalidate="novalidate">
                <div class="apply-personal-container">
                    <fieldset>
                        <legend>Personal details</legend>
                        <p>
                            <label for="email">Email address</label>
                            <input type="text" name="email" class="form-email" id="email" required="required"> <!--html5 support email type https://html.spec.whatwg.org/multipage/input.html-->
                        </p>
                        <p>
                            <label for="fname">First name</label>
                            <input type="text" name="fname" class="form-fname" id="fname" required="required" pattern="[A-Za-z]+">
                        </p>
                        <p>
                            <label for="lname">Last name</label>
                            <input type="text" name="lname" class="form-lname" id="lname" required="required" pattern="[A-Za-z]+">
                        </p>
                        <p>
                            <label for="phone">Phone number</label>
                            <select name="countrycode" id="countrycode" class="form-countrycode">
                            <optgroup label="Please Select Your Country Code"> <!--optgruop can make bold text https://www.w3schools.com/tags/tag_optgroup.asp-->
                                <option value="+61">Australia(+61)</option>
                                <option value="+82">Korea(+82)</option>
                                <option value="+91">India(+91)</option>
                                <option value="+89">China(+89)</option>
                                <option value="+886">Taiwan(+886)</option>
                                <option value="+84">Vietnam(+84)</option>
                            </optgroup>
                            </select>   
                            <input type="text" name="phone" class="form-phone" id="phone" required="required" pattern="\d{8,12}">
                        </p>
                        <p>
                            <label for="birth">Date of birth</label>
                            <input type="text" name="birth" id="birth" class="form-birth" value="" placeholder="dd/mm/yyyy" required="required">
                            <span class="hide-text" id="hideTextBirth"></span>
                        </p>
                        <div class="radio-gender">
                            <fieldset>
                                <legend>Gender</legend>
                                <label for="gender-radio1">Male</label>
                                <input type="radio" name="gender" id="gender-radio1" value="Male" required="required">
                                <label for="gender-radio2">Female</label>
                                <input type="radio" name="gender" id="gender-radio2" value="Female">
                            </fieldset>
                        </div>
                        <p>
                            <label for="street">Street Address</label>
                            <input type="text" name="street" id="street" class="form-street" required="required">
                        </p>
                        <div class="apply-address-inline">
                            <label for="suburb">Suburb</label>
                            <input type="text" name="suburb" id="suburb" class="form-suburb" required="required">
                            <label for="selectState">State</label>
                            <select name="selectState" id="selectState" class="form-selectState">
                                <optgroup label="Please Select Your State">
                                    <option value="VIC">VIC</option>
                                    <option value="NSW">NSW</option>
                                    <option value="QLD">QLD</option>
                                    <option value="NT">NT</option>
                                    <option value="WA">WA</option>
                                    <option value="SA">SA</option>
                                    <option value="TAS">TAS</option>
                                    <option value="ACT">ACT</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="apply-postcode">
                            <div class="apply-postcode-inline">
                                <label for="postcode">Postcode</label>
                                <input type="text" name="postcode" id="postcode" class="form-postcode" required="required">
                                <span class="hide-text" id="hideTextPostcode"></span>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="apply-skills-container">
                    <fieldset>
                        <legend>Skills</legend>
                        <p>
                            <label for="referenceNumberForm">Job refernce number</label>
                            <input type="text" name="refernceNumberForm" id="referenceNumberForm" class="form-referenceNumber" pattern="^[a-zA-Z]{5}$" value="" readonly>
                        </p>
                        <fieldset>
                            <legend>Select Your Skills</legend>
                                <label for="htmlset">HTML,CSS,JS</label>
                                <input type="checkbox" name="category-skills[]" id="htmlset" value="html, css, js">
                                <label for="java">Java</label>
                                <input type="checkbox" name="category-skills[]" id="java" value="java">
                                <label for="C">C Language</label>
                                <input type="checkbox" name="category-skills[]" id="C" value="C">
                                <label for="db">DB</label>
                                <input type="checkbox" name="category-skills[]" id="db" value="DB">
                                <label for="node">Node.js</label>
                                <input type="checkbox" name="category-skills[]" id="node" value="node_js">
                                <label for="photoshop">Photoshop</label>
                                <input type="checkbox" name="category-skills[]" id="photoshop" value="photoshop">
                                <p>
                                    <label for="other">Other skills</label>
                                    <input type="checkbox" name="category-skills[]" id="other" value="other">
                                    <span class="hide-text" id="hideTextOther"></span>
                                </p>
                                <p>
                                    <textarea name="textarea" id="otherSkills" class="form-otherSkills" cols="100" rows="10" placeholder="Please, describe your skills..."></textarea>
                                </p>
                        </fieldset>
                    </fieldset>
                </div>
                <div class="apply-button-container">
                    <input type="submit" name="submit" id="submit" class="apply-submit-button" value="Submit">
                    <input type="reset" name="reset" id="reset" class="apply-reset-button" value="Reset">
                </div>
            </form>
        </div>
    </div>
    <footer>
        <?php
            include('footer.inc')
        ?>
    </footer>
    <script src="scripts/apply.js"></script>
</body>
</html>