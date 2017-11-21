        <footer id="footer_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="copy-right">
                            <div class="col-md-5">
                                <img src="img/footer-logo.png">
                            </div>
                            <div class="col-md-7">
                                <ul> 
                                    <li><a href="#">ផ្តល់ព័ត៌មាន និងផ្សាយពាណិជ្ជកម្ម: 016 757 168 / 011 977 123</a></li>
                                   
                                </ul>

                                <p class="alright">© 2016 រក្សាសិទ្ធិគ្រប់យ៉ាងដោយ</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <p class="develop">Developed by: <span>Keila Daily</span></p>
                    </div>
                </div>
            </div>
        </footer>
        <center style="position:fixed;bottom:0; margin:0; padding:0" id="hidden_pc"><a href="https://www.facebook.com/ballkhmer.tv/"  target="_blank"><img src="img/ads/ballkhmer-footer.png"></a></center>

        <!-- Return to Top -->
        <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>

       <script src="js/plugins.js"></script>
        <script src="js/custom.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="js/min/main.min.js"></script>
        <script type="text/javascript" src="js/jquery.sudoSlider.min.js"></script>
        <script type="text/javascript" src="js/global.js"></script>
        <script src="plugins/responsive_menu/js/main.js"></script>  
       

        <script>
           /* $(window).scroll(function() {
                if ($(this).scrollTop() > 1){   
                    $('#image_logo').addClass("hidden");
                    $('#image_logo_small').removeClass("hidden");
                }
                else{
                     $('#image_logo').removeClass("hidden");
                     $('#image_logo_small').addClass("hidden");
                }
            });
        */

            //===== Scroll to Top ==== 
                $(window).scroll(function() {
                    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
                        $('#return-to-top').fadeIn(200);    // Fade in the arrow
                    } else {
                        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
                    }
                });
                $('#return-to-top').click(function() {      // When arrow is clicked
                    $('body,html').animate({
                        scrollTop : 0                       // Scroll to top of body
                    }, 500);
                });
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-83022496-1', 'auto');
  ga('send', 'pageview');

</script>
        
        
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50bee8c15741ef8d"></script>

    </body>
</html>
