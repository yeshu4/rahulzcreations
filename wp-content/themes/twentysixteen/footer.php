<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

</div>
<section class="our-clients">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Our Clients</h2>
            </div>   
        </div>   
    </div>   

    <div class="container">
        
            <?php /*echo do_shortcode('[slick-slider]');*/ ?>  
            <?php echo do_shortcode("[slick-carousel-slider  slidestoshow='5' slidestoscroll='1' dots='false']  "); ?> 
        
    </div>
</section>
<section class="our-blog">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Blog & Posts</h2>
                <h3>Latest Blogs & Posts</h3>

            </div>   
        </div>   
    </div>   

    <div class="container">
        
            <?php /*echo do_shortcode('[slick-slider]');*/ ?>  
           
            <?php echo do_shortcode("[recent_blog_post limit='3' grid='3' show_date='false' show_author='false']  "); ?> 
        
    </div>
</section>
<section class="about-us">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
            <h3>Contact Us</h3>
            <h2>Got an Idea? Let's Work.</h2>
            <p> <b>Address: </b> Gayathri Heights, #204, 2nd floor,     
                  Jubilee Enclave, Hyderabad,Telangana 
                  500081</p>
                  <ul class="footer-social">
                    <li> <a target="_blank" href="https://facebook.com/"> <i
                                class="fa fa-facebook-f"></i> </a></li>
                    <li> <a target="_blank" href="https://twitter.com/"> <i class="fa fa-twitter"></i>
                        </a></li>
                    <li> <a target="_blank" href="https://www.youtube.com/"> <i
                                class="fa fa-youtube"></i> </a></li>
                    <li> <a target="_blank" href="https://www.pinterest.com/"> <i
                                class="fa fa-pinterest"></i> </a></li>
                    <li> <a target="_blank" href="https://www.instagram.com/"> <i
                                class="fa fa-instagram"></i> </a></li>
                </ul>
           </div>
           <div class="col-md-7">
       
           <?php if( function_exists("wd_form_maker") ) { wd_form_maker(6, "embedded"); } ?>
           </div>
        </div>
        
   </div>
<section>

<!-- open footer tag-->

<footer>
<div class="container" style="color:#000; padding-top:50px; padding-bottom:50px;    border-top: 1px solid rgba(0, 0, 0, 0.29);">
    <div class="row fs-5">

        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
            <div class="about-company">
                <h3 class="title-bar">About Company</h3>
                <!-- <img src="<?php bloginfo('template_url') ?>/uploads/2020/02/Logo-footer.png" alt=""> -->
                <!-- <img src="<?php echo get_template_directory_uri(); ?>/uploads/2020/02/Logo-footer.png" alt=""> -->
                <img src="<?php bloginfo('template_url') ?>/images/Logo-footer.png" alt="">
               
                
                 <address><b>EMail:</b>fireflydevelopmentstudios@gmail.com   </br>    
                <b>Phone:  </b>   +91-7842851751, +91-7993609722</br> 
                <b>Address:</b> Gayathri Heights, #204, 2nd floor,     
                  Jubilee Enclave, Hyderabad,Telangana 
                  500081</address> 
               
               


            </div>

        </div>

        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
            <h3 class="title-bar">Company:</h3>
            <ul class="main-footer-box">
                <li><a href="#">Home</a> </li>
                <li><a href="#">About US</a> </li>
                <li><a href="">Portfolio</a> </li>
                <li><a href="#">Contact US</a></li>
                <li><a href="#">Terms & Conditions</a></li>
                <li><a href="#">Disclaimer</a> </li>

            </ul>
        </div>
        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">

            <h3 class="title-bar">Company:</h3>
            <ul class="main-footer-box">
                <li><a href="#">Home</a> </li>
                <li><a href="#">About US</a> </li>
                <li><a href="">Portfolio</a> </li>
                <li><a href="#">Contact US</a></li>
                <li><a href="#">Terms & Conditions</a></li>
                <li><a href="#">Disclaimer</a> </li>

            </ul>
</div>
<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">

<h3 class="title-bar">Company:</h3>
<ul class="main-footer-box">
    <li><a href="#">Home</a> </li>
    <li><a href="#">About US</a> </li>
    <li><a href="">Portfolio</a> </li>
    <li><a href="#">Contact US</a></li>
    <li><a href="#">Terms & Conditions</a></li>
    <li><a href="#">Disclaimer</a> </li>

</ul>
</div>
        </div>

    </div>
</div>


<div class="footer-2">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <p>Copyright © 2019 Rahul'z Creations Design Studios. All Rights Reserved.</p>
            </div>
            <div class="col-md-4">
            <ul class="footer-social">
                    <li> <a target="_blank" href="https://facebook.com/"> <i
                                class="fa fa-facebook-f"></i> </a></li>
                    <li> <a target="_blank" href="https://twitter.com/"> <i class="fa fa-twitter"></i>
                        </a></li>
                    <li> <a target="_blank" href="https://www.youtube.com/"> <i
                                class="fa fa-youtube"></i> </a></li>
                    <li> <a target="_blank" href="https://www.pinterest.com/"> <i
                                class="fa fa-pinterest"></i> </a></li>
                    <li> <a target="_blank" href="https://www.instagram.com/"> <i
                                class="fa fa-instagram"></i> </a></li>
                </ul>
            
            
            
            
            </div>
            <div class="col-md-4">
            <p>All screenshots, logos, graphics & images © their respective owners</p>
</div>
        </div>
    </div>
</div>
</footer>

  

<!-- close footer tag-->
</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
