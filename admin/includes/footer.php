</body>

<footer class="footer" id="footer" >
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-12 text-center">
							<p class="copyrights">
								<a href="index.html" class="text-muted">&copy; Copyrights 2021 SIMS</a>
							</p> 
						</div>
					</div>
				</div>
			</footer>
			


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="vendor/js/jquery/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> 
    <script src="vendor/js/bootstrap/bootstrap.min.js"></script>
    <script src="vendor/js/jquery/jquery.js"></script>
   
    <script>
    
        // $('#bar').click(function(){
        //     $(this).toggleClass('is-closed');
        //     $('#page-content-wrapper ,#sidebar-wrapper, #footer').toggleClass('toggled' );
        //     $('.topbar-img').toggleClass('logo-display');    
        // });

        // $(document).ready(function() {
        //     $('.sideNav').click(function() {
        //         $('a.active').removeClass("active");
        //         $(this).addClass("active");
        //     });
        // });
		

        
        $('#bar').click(function(){
            $(this).toggleClass('open');
            $('#page-content-wrapper ,#sidebar-wrapper, #footer').toggleClass('toggled' );
            $('.topbar-img').toggle();    
        });

        $(document).ready(function() {
            $('.sideNav').click(function() {
                $('a.active').removeClass("active");
                $(this).addClass("active");
            });
        });
                
    </script>

   
</html>
