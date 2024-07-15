<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include('header.inc')
    ?>
    <title>Enhancement</title>
</head>
<body>
    <?php
        include('menu.inc')
    ?>

    <div class="enhancement-description">
        <section>
            <h4>Enhancement 1</h4>
            <p>
                I wanted to display the company's location on the company introduction page on index.html. While looking for the appropriate tag to achieve this, I came across the 'iframe' tag.
                The 'iframe' tag specifies an inline frame. An inline frame is used to embed another document within the current HTML document. By using this tag, you can display another webpage within the page you're looking on.
                To use a map, you can go to Google Maps, click on 'Share,' then select 'Embed a map' to copy the provided iframe tag and paste it into your HTML to display the map on your page.
            </p>
            <p> Go to <a href="index.php#enhancement1">enhancement 1</a></p> 
            <p>Reference</p>
            <P>[1] GOOGLE. 2023. Embedding a map. https://developers.google.com/maps/documentation/embed/embedding-map</P>
            <P>[2] JAMIE JUVILER. 2023. How to Embed Google Map in HTML [Step-By-Step Guide]. https://blog.hubspot.com/website/how-to-embed-google-map-in-html</P>  
        </section>
        <section>
            <h4>Enhancement 2</h4>
            <p>
                I wanted to add more decoration to the application page as it appeared too simple. 
                So I added an animation to the title section. To create the animation, I divided the timeframes in CSS and added size of width for each step. 
                Among the attributes in .apply-animation-word, some significant include overflow, white-space, and animation. Overflow hides objects that exceed the defined layout size. 
                White-space with "nowrap" ensures that only one object appears per line. 
                Finally, animation triggers predefined keyframes and allows for a slow start with "ease-in-out". This animation continues until the user closes it.
            </p>
            <p>Go to <a href="apply.php#apply-animation">enhancement 2</a></p>  
            <p>Reference</p>
            <p>[3] W3SCHOOLS. CSS Animations. https://www.w3schools.com/css/css3_animations.asp.</p>
        </section>
    </div>
    <footer>
        <?php
            include('footer.inc')
        ?>
    </footer>
</body>
</html>
