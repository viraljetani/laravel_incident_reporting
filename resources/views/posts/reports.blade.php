@extends('layouts.app')

@section('template_title')
	Reports
@endsection

{{-- @section('template_fastload_css')

@endsection --}}

@section('content')
            <div class="col-12 p-4 ">
                <br><h1>Incident Reports</h1>
            </div>
			<div class="col-md-6 p-5">

                <div id="app">
                    {!! $chart->container() !!}
                </div>
            </div>
            <div class="col-md-6 p-5"> 
                <div id="app2">
                    {!! $chart2->container() !!}
                </div>
            </div>
            <div class="col-md-6 p-5">
                <div id="app3">
                    {!! $chart3->container() !!}
                </div>

            </div>
                <script>
                    var app = new Vue({
                        el: '#app',
                    });
                    var app2 = new Vue({
                        el: '#app2',
                    });
                    var app3 = new Vue({
                        el: '#app3',
                    });
                </script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
                {!! $chart->script() !!}
                {!! $chart2->script() !!}
                {!! $chart3->script() !!}
                
           
            

@endsection

@section('footer_scripts')

@endsection
