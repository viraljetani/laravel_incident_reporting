@extends('layouts.master')

@section('template_title')
	Location of Incidents
@endsection

@section('content')
    <div class="container-fluid mt-4">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-900">Location Of Incidents</h1>
            </div>
            
			<div class="col-lg-12 p-5">

                <div id="app">
                    {!! $chart->container() !!}
                </div>
            </div>
            
            
    </div>
                <script>
                    var app = new Vue({
                        el: '#app',
                    });
                    
                </script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
                {!! $chart->script() !!}
                
                
           
            

@endsection

@section('footer_scripts')

@endsection
