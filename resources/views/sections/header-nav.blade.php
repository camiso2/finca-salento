<!-- header-nav -->
<div class="header-nav">
    <div class="container">
        <div class="header-nav-bottom">
            <nav class="navbar navbar-default">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="/" class="hvr-bounce-to-bottom"><i class="fa fa-home"
                                    aria-hidden="true"></i>&nbsp;&nbsp;INICIO</a>
                        </li>
                        <li>
                            <a href="tel:{{ env('PHONE') }}" title="{{ env('PHONE') }}" class="hvr-bounce-to-bottom">
                                <i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;
                                COMUNÍCATE
                            </a>
                        </li>
                        {{-- <li><a href="news.html" class="hvr-bounce-to-bottom">SERVICIOS</a></li> --}}
                        <li><a href="services" class="hvr-bounce-to-bottom"><i class="fa fa-check-square-o"
                                    aria-hidden="true"></i>&nbsp;&nbsp;SERVICIOS</a></li>
                        <li><a href="contact" class="hvr-bounce-to-bottom"><i class="fa fa-map-signs"
                                    aria-hidden="true"></i>&nbsp;&nbsp;CONTÁCTENOS</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </div>
    </div>
</div>
<!-- script-for sticky-nav -->
<script>
    $(document).ready(function() {
							 var navoffeset=$(".header-nav").offset().top;
							 $(window).scroll(function(){
								var scrollpos=$(window).scrollTop();
								if(scrollpos >=navoffeset){
									$(".header-nav").addClass("fixed");
								}else{
									$(".header-nav").removeClass("fixed");
								}
							 });

						});
</script>
<!-- //script-for sticky-nav -->
<!-- //header-nav -->
