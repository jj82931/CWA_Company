

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include('header.inc')
    ?>
    <title>Position Description</title>
</head>
<body>
    <?php
        include('menu.inc')
    ?>
    <div class="banner-image">
        <img class="banner-image-otherpage" src="styles/images/banner.png" alt="banner">
    </div>
    <div class="job-container" id="job-container">
        <div class="job-title">
            <h1>Chief Technology Officer</h1>
        </div>
        <div class="job-attribute">
            <div class="div-job-span1"> <!--The image tag and the h tag are block, so I made two div to put them on a single line.-->
                <div class="div-job-attribute">
                    <img src="images/location.png" alt="location-icon"><h3>Melbourne, 3000 VIC</h3>
                </div>
            </div>
            <div class="div-job-span2">
                <div class="div-job-attribute">
                    <img src="images/role.png" alt="role-icon"><h3>Management (Information & Communication Technology)</h3>
                </div>
            </div>
            <div class="div-job-span3">
                <div class="div-job-attribute">
                    <img src="images/jobtime.png" alt="jobtime-icon"><h3>Full time</h3>
                </div>
            </div>
            <div class="div-job-span4">
                <div class="div-job-attribute">
                    <img src="images/salary.png" alt="salary-icon"><h3>120,000$ ~ 180,000$</h3>
                </div>
            </div>
        </div>
        <div class="job-description"> 
            <!--Initially, I used the a tag inside the button tag to move the page when the button is pressed, 
                but the validation said that it was incorrect to use, so I made the a tag like a button in the CSS.-->
                <button class="job-hyperButton" id="jobApplyButton1">Apply</button>
            <section>
                <h4>About your new job (Reference Number: <p class="job-reference-inline" id="job-referenceNumber1">AABBB</p>)</h4>
                In this pivotal role, you will be entrusted with overseeing and managing our organisation's IT landscape, with a strong emphasis on IT and Infrastructure enhancement. 
                Your leadership will set the course for our future IT team and drive strategic alignment. Working closely with the Manager for Business Solutions (whom will report to you), 
                you will collaborate on applications and data. You are key in refining, further developing and executing the overall IT Strategic plan for the next 3 – 5 years. 
                <p>The Chief Technology Officer will be responsible for:</p>
                <ul>
                    <li>People leadership of a talented team</li>
                    <li>Development and implementation of a IT with business expectations and enables business growth</li>
                    <li>Budget management</li>
                    <li>Enterprise architecture - Software Development, Infrastructure, Cybersecurity</li>
                    <li>Senior internal and external stakeholder engagement and presenting</li>
                    <li>Creates policies around technology infrastructure</li>
                    <li>Continuously educate themselves on technology topics</li>
                    <li>Staying on top of Technology trends and innovation and managing the business on specfic trends to be considered</li>
                </ul>
            </section>
            <section>
                <h4>Reporting lines and training</h4>
                <p>Successful candidates will have supervision from the company's top directors and robust business training provided at Swinburne University of technology.</p>
            </section>
            <section>
                <h4>Qualifications</h4>
                <p>The successful applicant must possess the following qualifications, skills and experience,
                    then we strongly encourage you to apply. Here are some things we would regard highly:</p>
                    <ol type="i">
                        <li>Proven experience over 20 years as a CIO or in a senior IT leadership role within a large organisation.</li>
                        <li>Demonstrated success in driving digital transformation initiatives and implementing innovative technologies.
                            Prior experience developing information technology and management plans and product/service roadmaps.
                            In-depth knowledge of IT operations, cybersecurity, data management, and emerging technologies.</li>
                        <li>Strong business acumen and the ability to align IT strategies with broader business objectives.</li>
                        <li>Expertise in resolving high-priority, sensitive, and complex matters by collaborating with internal and external stakeholders, including managers and staff.</li>
                        <li>A bachelor's or master's degree in computer science, information technology, or a related field is preferred. Relevant certifications (e.g., CCNA, CCNP, MCSE, CIO, CISM, ITIL) are advantageous.</li>
                    </ol>
                        <p>preferable (Nice to have):</p>
                        <ol type="i">
                        <li>Oversee/Manage cloud and on premises server maintenance, networks, and hardware components</li>
                        <li>Flexibility to work in our Melbourne CBD office and the option to work from home 3 days per week.</li>
                    </ol>
            </section>
        </div>
        <!--When I first designed the layout, I wanted to put the aside on a different page, 
            and later I wanted to put the aside tag higher in the middle of the description. I use an inline-block in some of the layouts, but it didn't work.-->
        <div class="job-aside">
            <aside>
                <section id="job-aside-help">
                    Do you need a help? <br>Would you like to enquire?<br><br>
                    Do not hesitate to call
                    <h2>03 1234 1234</h2>
                    <p id="job-aside-help2">
                        Our No AI solution always welcomes applicants.
                    </p>
                </section>
            </aside>
        </div>
    </div>
    <div class="job-container-2">
        <div class="job-divide">
            <hr>
        </div>
        <div class="job-title">
            <h1>Front-end Developer</h1>
        </div>
        <div class="job-attribute">
            <div class="div-job-span1">
                <div class="div-job-attribute">
                    <img src="images/location.png" alt="location-icon"><h3>Melbourne, 3000 VIC</h3>
                </div>
            </div>
            <div class="div-job-span2">
                <div class="div-job-attribute">
                    <img src="images/role.png" alt="role-icon"><h3>Developers/Programmers (Information & Communication Technology)</h3>
                </div>
            </div>
            <div class="div-job-span3">
                <div class="div-job-attribute">
                    <img src="images/jobtime.png" alt="jobtime-icon"><h3>Full time</h3>
                </div>
            </div>
            <div class="div-job-span4">
                <div class="div-job-attribute">
                    <img src="images/salary.png" alt="salary-icon"><h3>70,000$ ~ 110,000$</h3>
                </div>
            </div>
        </div>
        <div class="job-description">
            <button class="job-hyperButton" id="jobApplyButton2">Apply</button>
            <section>
                <h4>About your new job (Reference Number: <p class="job-reference-inline" id="job-referenceNumber2">AACCC</p>)</h4>
                We are looking for a front developer to join our in-house IT team based in Melbourne CBD, Victoria. 
                Tertiary qualifications in an IT-related field favoured, but not required - if you're conscientious and can knuckle down, that's good enough for us.
                In addition to web development, you will collaborate closely with our Front End Developer to implement and document the company's set of products. 
                Your knowledge and expertise will be crucial in ensuring the smooth operation and maintenance of these products. 
                <p>The front developer will be responsible for:</p>
                <ul>
                    <li>Delivering high quality front-end solutions in the iterative development process of our Website and innovative applications.</li>
                    <li>Solve technical problems, identify root causes and quickly resolve issues.</li>
                    <li>Development and implementation of a IT with business expectations and enables business growth.</li>
                    <li>Ability to work individually as well as on group projects.</li>
                    <li>Ensure all documentation (e.g. requirements, design, testing, operations, interface, user guide, etc.) is developed & maintained.</li>
                    <li>Developing robust unit testing throughout the full coding process including documentation.</li>
                </ul>
            </section>
            <section>
                <h4>Reporting lines and training</h4>
                <p>Successful candidates will have supervision from the company's Senior developer and robust business training provided at Swinburne University of technology.</p>
            </section>
            <section>
                <h4>Qualifications</h4>
                <p>The successful applicant must possess the following qualifications, skills and experience,
                    then we strongly encourage you to apply. Here are some things we would regard highly:</p>
                    <ol type="i">
                        <li>Knowledge of PHP, HTML and MYSQL.</li>
                        <li>Experience putting all three together in a project (with examples).</li>
                        <li>You understand the importance of functional testing and cross-browser testing for platforms (Mac / PC/ IOS / Android).</li>
                        <li>Knowledge of differences between client and server</li>
                        <li>Excellent interpersonal skills and an ability to work with a diverse team</li>
                    </ol>
                        <p>preferable (Nice to have):</p>
                        <ol type="i">
                        <li>0-2 years’ experience in theme and template development in various content management systems.</li>
                        <li>Entry level position with 0-2 years’ experience in technical Web development.</li>
                        <li>A bachelor's or master's degree in computer science, information technology, or a related field is preferred.</li>
                    </ol>
            </section>
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