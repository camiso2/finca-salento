@extends('layouts.dashboard')

@section('content')
<script src="{{ asset('js/listbedrooms.js') }}" defer></script>
<div class="container body">
    <div class="main_container">
        @include('dashboard.sections.menu')
        @include('dashboard.sections.header')
        @include('dashboard.sections.subheader')
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph">

                    <div class="row x_title">
                        <div class="col-md-6">
                            <h3>Habitaciones Registradas <small>todas !</small></h3>
                        </div>

                        <!--<div class="col-md-6">
                            <div id="reportrange" class="pull-right"
                                style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                            </div>
                        </div>-->
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div style="overflow-x:auto;">

                            <div id="listBedrooms">
                                <listbedrooms-component>
                            </div>
                            <!-- end project list -->
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>Cargando...
            </div>

        </div>
        <br />
        <!-- footer content -->
        @include('dashboard.sections.footer')
        <!-- /footer content -->
    </div>
    <!-- /page content -->

</div>

</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>

<script src="js/bootstrap.min.js"></script>
<script src="js/chartjs/chart.min.js"></script>
<!-- bootstrap progress js -->
<script src="js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="js/icheck/icheck.min.js"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="js/moment.min.js"></script>
<script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>

<script src="js/custom.js"></script>



<script>
    NProgress.done();
</script>
<!-- /datepicker -->
<!-- /footer content -->

@endsection
