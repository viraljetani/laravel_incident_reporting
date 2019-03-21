@extends('layouts.app')

@section('template_title')
	Reports
@endsection

{{-- @section('template_fastload_css')

@endsection --}}

@section('content')

			<div class="col-md-10 offset-md-1 col-xs-10 offset-xs-1">

                <div id="app">
                    {!! $chart->container() !!}
                </div>
                
                <script>
                    var app = new Vue({
                        el: '#app',
                    });
                </script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
                {!! $chart->script() !!}
                
            </div>
            

@endsection

@section('footer_scripts')

@endsection
