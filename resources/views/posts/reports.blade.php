@extends('layouts.app')

@section('template_title')
	Reports
@endsection

{{-- @section('template_fastload_css')

@endsection --}}

@section('content')

			<div class="col-md-10 offset-md-1 col-xs-10 offset-xs-1">

                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h2 class="m-md-4 p-md-4 m-xs-2 p-xs-2">Reports </h2>
                @if(isset($posts))
                    @foreach($posts as $key => $post)
                        <article class="post-card m-md-4 p-md-4 m-xs-2 p-xs-2">
                            <p class="meta text-muted"><span class="author">Posted By <b>{{$post->cso_name}}</b></span> <span class="pull-right dateTime">{{Carbon\Carbon::parse($post->post_date)->diffForHumans()}} - {{$post->post_time}}</span></p>
                            <h3>{{$post->postType->name}}</h3>
                            <p class="excerpt">{{$post->details}}</p>
                            
                            <p class="post-location text-muted"><i class="fa fa-map-marker"></i> {{$post->location}} </p>
                            <p class="text-muted"><i class="fa fa-map-pin"></i> {{$post->district->name}}</p>
                        </article>
                    @endforeach
                @endif
                
            </div>
            <div class="col-xs-6 mx-auto">{{ $posts->links() }}</div>

@endsection

@section('footer_scripts')

@endsection
