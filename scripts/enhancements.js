/**
* Author: Chaeyeon Im
* Target: index.php, jobs.php
* Purpose: 
    - Create typing effect to write down on index.php.
    - Show slide picture automatically every five second when user get into the about.php.
*/

if(window.location.pathname.endsWith("/index.php")){ //Enhancement 1

    function init(){
        var content = "Welcome to No AI Solution";
        var text = document.getElementById("index-typing");
        var i = 0;
        var interval;

        function typing(){
            var pushtext = content[i++];
            text.innerHTML += pushtext;

            if (i >= content.length) { //Check end point of the text
                clearInterval(interval); // When typing completed, clear interval
                setTimeout(resumeTyping, 2000); // Pause for 2 second
            }
        }

        /*If this function isn't present, the typing animation restarts immediately after it finishes. 
        Therefore, the 2-second delay was introduced above, but the interval and content variables are not reset, causing undefined values to continue appearing. 
        To address this, both of these variables are reset, and the typing function is called again. */
        function resumeTyping() {
            i = 0; // Reset index
            text.textContent = ""; // Clear Content
            interval = setInterval(typing, 300); // Call typing function
        }

        interval = setInterval(typing, 300);
    }

    init();
    
}
else if(window.location.pathname.endsWith("/about.php")){ //Enhancement 2
    
    const imageSlide = document.getElementById("imageSlide");
    const numberImages = 6;

    function Slide(imgNumber){
        imageSlide.src = `images/${imgNumber +1}.jpg`; //Prevent duplicate images and zero index.
    }

    function getRandomNumber(){ //Generate Random Number
        const randomImage = Math.floor(Math.random()*numberImages);
        return randomImage;
    }

    function init(){
        const randomNumber = getRandomNumber();
        Slide(randomNumber);
    }
    
    init();
    setInterval(init, 5000); //Execute init function every 5 seconds.
}