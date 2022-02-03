
<div id='btn-floating-w' >

    <div class="panel panel-default animated"  id="panel-wt" data-wow-delay=".1s">
        <div class="panel-heading tit-wt">
            <h1 class="panel-title tit-wt" ><span id="out_panel-wt">&times;&nbsp;&nbsp;&nbsp;</span></h1>
        </div>
        <div class="panel-body" onclick="whatsapp_message()">
            <div class="row">
                <div class="col-xs-2 img-wt">
                    <img src="/images/whatsapp.png"  class="img-resposive">
                </div>
                <div class="col-xs-8 " >
                    <p>servicio al cliente</p>
                    <p class="chat-wt">Asesor !</p>
                </div>
            </div>
        </div>
    </div>
    <a onclick="whatsapp_message()">
    <button type="button" class="btn btn-success but_wt" id="but_wt"   >
        <i class="fa fa-whatsapp" aria-hidden="true"></i> <span >&nbsp;&nbsp;Tienes Preguntas ? Habla Con Nosotros ! </span>
    </button>
    </a>
    <script type="text/javascript">

        $(document).ready(function(){
            $("#but_wt").hover(function(){
            if (screen.width>950) {
                $('#panel-wt').show();
            }
            }, function(){
                //$("#prueba").css("background-color", "#C3C3C3");
            });

            $("#but_wt").on( "click", function() {
                $('#panel-wt').toggle();


            });
            $("#out_panel-wt").on( "click", function() {
                $('#panel-wt').hide();
            });
        });

    </script>

</div>
