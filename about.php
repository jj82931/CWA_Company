<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include('header.inc')
    ?>
    <title>About</title>
</head>
<body>
    <?php
        include('menu.inc')
    ?>

    <div class="about-container">
        <div class="about-personel">
            <figure>
                <div class="about-info-inline">
                    
                    <dl>
                        <dt>Your name:&nbsp;</dt>
                        <dd>Chaeyeon Im</dd>
                        <dt>Student Number:&nbsp;</dt>
                        <dd>104532390</dd>
                        <dt>Your tutor's name:&nbsp;</dt>
                        <dd>Jeff</dd>
                        <dt>Course:&nbsp;</dt>
                        <dd>Creating Web Application</dd>
                    </dl>
                    
                </div>
                <div class="about-mypic"><img src="images/1.jpg" alt="My picture" id="imageSlide"></div>
            </figure>
        </div>
        <div class="about-table">
            <h2>Time table</h2>
            <table class="about-table-center">
                <thead>
                    <tr>
                        <th></th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><h4>Noon</h4></td>
                        <td></td>
                        <td class="about-table-active">Creating Web Application</td>
                        <td></td>
                        <td class="about-table-filling">Software Quality and Testing</td> <!--To make the same size row each day of week. This content of td is invisible-->
                        <td class="about-table-filling">Software Quality and Testing</td> 
                    </tr>
                    <tr>
                        <td><h4>1PM</h4></td>
                        <td></td>
                        <td class="about-table-active">Online</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><h4>2PM</h4></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="about-table-active">Technology Inquiry</td>
                    </tr>
                    <tr>
                        <td><h4>3PM</h4></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="about-table-active">Project</td>
                    </tr>
                    <tr>
                        <td><h4>4PM</h4></td>
                        <td></td>
                        <td class="about-table-active">Software Quality and Testing<br>Online</td>
                        <td class="about-table-active">Data Management for</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><h4>5PM</h4></td>
                        <td class="about-table-active">Technology Inquiry Project<br>Online</td>
                        <td></td>
                        <td class="about-table-active">the Big Data Age Online</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><h4>6PM</h4></td>
                        <td></td>
                        <td></td>
                        <td class="about-table-active">Software Quality and Testing</td>
                        <td></td>
                        <td class="about-table-active">Creating Web</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td><h4>7PM</h4></td>
                        <td></td>
                        <td></td>
                        <td class="about-table-active">Data Management for the Big Data Age</td>
                        <td></td>
                        <td class="about-table-active">Application</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <footer>
        <?php
            include('footer.inc')
        ?>
    </footer>
    <script src="scripts/enhancements.js"></script>
</body>
</html>