@extends('layouts.master')

@section('template_title')
	All Posts
@endsection

{{-- @section('template_fastload_css')

@endsection --}}

@section('content')

			<div class="col-md-10 offset-md-1 col-xs-10 offset-xs-1">

                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                @if(isset($posts))
                <div class="m-md-3 p-md-3 m-xs-2 p-xs-2 d-flex">
                    <h2 class="text-dark mr-auto p-2"> {{ $posts->total() }} Reported Incidents  @role('admin') <a href="{{route('posts.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Import New </a> @endrole 
                        
                    </h2>
                    <div class="p-2">{{ $posts->links() }}</div>
                </div>
                    @foreach($posts as $key => $post)
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                              <h6 class="m-0 font-weight-bold text-primary"> {{$post->postType->name}} <small> <span class="float-right d-inline-block dateTime font-weight-normal text-muted"> &nbsp;{{Carbon\Carbon::parse($post->post_date)->format('l jS F Y')}} - {{$post->post_time}} </span>   </small> </h6>
                            </div>
                            <div class="card-body p-4">
                                    
                                    <p class="excerpt">{{$post->details}}</p>
                                    <hr>
                                    {!! $post->responsible ? "<p class='small'>Who is Responsible: $post->responsible </p>" : '' !!}
                                    {!! "<p class='small'>Male / Female Perpetrators: $post->male_perpetrators / $post->female_perpetrators </p>" !!}
                                    {!! "<p class='small'>Victims: $post->victims [Male:$post->male_victims Female:$post->female_victims] </p>" !!}
                                    {!! $post->where_happened ? "<p class='small'>Where Incident happened?: $post->where_happened </p>" : '' !!}
                                    {!! $post->weapons_used ? "<p class='small'>Weapons Used: $post->weapons_used </p>" : '' !!}
                                    <hr />
                                    <p class="post-location text-muted float-left"><small>{{$post->location}}</small> <br>
                                    <i class="fa fa-map-pin"></i> {{$post->district->name}}</p>
                                    <a href="{{ route('posts.show',$post)}}" class="float-right pt-3">See more details about this Incident</a>
                            </div>
                        </div>
                    @endforeach
                @endif
                
            </div>
            <div class="d-flex justify-content-center w-100">{{ $posts->links() }}</div>

@endsection

@section('footer_scripts')

@endsection
