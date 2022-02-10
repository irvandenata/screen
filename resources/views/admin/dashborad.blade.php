@extends('layouts.admin')
@section('title', $title)
@push('style')

@endpush
    @section('content')
   <div class="content">
                    <div class="container-fluid">


                        <div class="row">


                            <div class="col-xl-4 col-md-6">
                        		<div class="card-box">


                        			<h4 class="header-title mt-0 m-b-30">Pengunjung Hari Ini</h4>

                                    <div class="widget-box-2">
                                        <div class="widget-detail-2">
                                            <span class="badge badge-success badge-pill pull-left m-t-20">32% <i class="mdi mdi-trending-up"></i> </span>
                                            <h2 class="mb-0"> 8451 </h2>
                                            <p class="text-muted m-b-25">Revenue today</p>
                                        </div>
                                        <div class="progress progress-bar-success-alt progress-sm mb-0">
                                            <div class="progress-bar progress-bar-success" role="progressbar"
                                                 aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: 77%;">
                                                <span class="sr-only">77% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                        		</div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                        		<div class="card-box">
                        			<h4 class="header-title mt-0 m-b-30">Jumlah Event</h4>
                                    <div class="widget-box-2">
                                        <div class="widget-detail-2">
                                            <span class="badge badge-success badge-pill pull-left m-t-20">32% <i class="mdi mdi-trending-up"></i> </span>
                                            <h2 class="mb-0"> 8451 </h2>
                                            <p class="text-muted m-b-25">Revenue today</p>
                                        </div>
                                        <div class="progress progress-bar-success-alt progress-sm mb-0">
                                            <div class="progress-bar progress-bar-success" role="progressbar"
                                                 aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: 77%;">
                                                <span class="sr-only">77% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                        		</div>
                            </div>
                             <div class="col-xl-4 col-md-6">
                        		<div class="card-box">
                        			<h4 class="header-title mt-0 m-b-30">Screen Aktif</h4>
                                    <div class="widget-box-2">
                                        <div class="widget-detail-2">

                                            <h2 class="mb-0">Screen XXX</h2>
                                            <p class="text-muted m-b-25">The Power Off</p>
                                        </div>
                                         <div class="progress progress-bar-success-alt progress-sm mb-0">
                                            <div class="progress-bar progress-bar-success" role="progressbar"
                                                 aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: 100%;">
                                                <span class="sr-only">77% Complete</span>
                                            </div>
                                        </div>

                                    </div>
                        		</div>
                            </div>


                        </div>
                        <!-- end row -->

                        <div class="row">
                         <!-- end col -->

                            <div class="col-xl-12">
                                <div class="card-box">

                                    <h4 class="header-title mt-0">Statistik Pengunjung</h4>
                                    <div id="morris-bar-example" style="height: 280px;"></div>
                                </div>
                            </div><!-- end col -->
<!-- end col -->

                        </div>
                        <!-- end row -->



                        <!-- end row -->

                    </div> <!-- container -->

                </div>
    @endsection


    @push('script')
            <script src="{{ asset('cms') }}/js/jquery.min.js"></script>
        <script src="{{ asset('cms') }}/js/popper.min.js"></script>
        <script src="{{ asset('cms') }}/js/bootstrap.min.js"></script>
        <script src="{{ asset('cms') }}/js/detect.js"></script>
        <script src="{{ asset('cms') }}/js/fastclick.js"></script>
        <script src="{{ asset('cms') }}/js/jquery.blockUI.js"></script>
        <script src="{{ asset('cms') }}/js/waves.js"></script>
        <script src="{{ asset('cms') }}/js/jquery.nicescroll.js"></script>
        <script src="{{ asset('cms') }}/js/jquery.slimscroll.js"></script>
        <script src="{{ asset('cms') }}/js/jquery.scrollTo.min.js"></script>

 <script src="{{ asset('cms') }}/plugins/jquery-knob/jquery.knob.js"></script>

        <!--Morris Chart-->
		<script src="{{ asset('cms') }}/plugins/morris/morris.min.js"></script>
		<script src="{{ asset('cms') }}/plugins/raphael/raphael-min.js"></script>

        <!-- Dashboard init -->
        {{-- <script src="{{ asset('cms') }}/pages/jquery.dashboard.js"></script> --}}

        <!-- App js -->
        <script src="{{ asset('cms') }}/js/jquery.core.js"></script>
        <script src="{{ asset('cms') }}/js/jquery.app.js"></script>

    @endpush

    @push('js')


        <script>


!function($) {


    var Dashboard1 = function() {
    	this.$realData = []
    };

    //creates Bar chart
    Dashboard1.prototype.createBarChart  = function(element, data, xkey, ykeys, labels, lineColors) {
        Morris.Bar({
            element: element,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            labels: labels,
            hideHover: 'auto',
            resize: true, //defaulted to true
            gridLineColor: '#2f3e47',
            barSizeRatio: 0.2,
            gridTextColor: '#98a6ad',
            barColors: lineColors
        });
    },


    Dashboard1.prototype.init = function() {
        //creating bar chart
        var $barData  = [
            { y: '2010', a: 75 },
            { y: '2011', a: 42 },
            { y: '2012', a: 75 },
            { y: '2013', a: 38 },
            { y: '2014', a: 19 },
            { y: '2015', a: 93 },
            { y: '2015', a: 93 },
            { y: '2015', a: 93 },
            { y: '2015', a: 93 },
            { y: '2015', a: 93 },
            { y: '2015', a: 93 },
            { y: '2015', a: 93 },
            { y: '2015', a: 93 },
            { y: '2015', a: 93 },
            { y: '2015', a: 93 },
            { y: '2015', a: 93 },
        ];
        this.createBarChart('morris-bar-example', $barData, 'y', ['a'], ['Statistics'], ['#188ae2']);

    },
    //init
    $.Dashboard1 = new Dashboard1, $.Dashboard1.Constructor = Dashboard1
}(window.jQuery),

//initializing
function($) {
    "use strict";
    $.Dashboard1.init();
}(window.jQuery);
        </script>

    @endpush
