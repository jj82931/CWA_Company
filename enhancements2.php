<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include('header.inc')
    ?>
    <title>Enhancement2</title>
</head>
<body>
    <?php
        include('menu.inc')
    ?>

    <div class="enhancement-description">
        <section>
            <h4>Enhancement 1</h4>
            <p>
                On the index page, to create a typing effect for a single phrase, I added two new span elements. One of them is defined in JavaScript as the content, and the other is created to achieve a typing effect using CSS animations by making a vertical bar blink. 
                This effect involves toggling the opacity between 0 and 1 to give the appearance of disappearing and appearing, thus simulating a real typing effect.
                In the JavaScript file, I used an interval to call the typing function for each character in the content variable. If the current indexing exceeds the length of the content, the typing effect is concluded. 
                After it finishes, there's a 2-second pause to display all the characters to the user. Without this pause, the typing function might be called immediately, preventing the user from seeing the complete text.
                Upon completion, the interval and content are reset, and the typing function is called again.
            </p>
            <p> Go to <a href="index.php">enhancement 1</a></p> 
            <p>Reference</p>
            <P>[1] W3SCHOOL. 2023. How TO - Typing Effect. https://www.w3schools.com/howto/howto_js_typewriter.asp</P>
        <section>
            <h4>Enhancement 2</h4>
            <p>
                Displays random images and changes to a new random image every 5 seconds. First, it obtains a random number through the 'getRandomNumber' function. 
                Then, it calls the 'Slide(randomNumber)' function to increment the 'imgNumber' by 1 based on the received random number and updates the 'src' value accordingly. 
                This ensures that consecutive duplicate images do not appear, and new images are displayed. Finally, it uses 'setInterval(init, 5000)' to automatically trigger these functions every 5 seconds, resulting in the automatic image changes.
            </p>
            <p>Go to <a href="about.php">enhancement 2</a></p>  
            <p>Reference</p>
            <p>N/A</p>
        </section>
    </div>
    <footer>
        <?php
            include('footer.inc')
        ?>
    </footer>
</body>
</html>
