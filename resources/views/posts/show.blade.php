@extends('layouts.master')

@section('template_title')
    Post Details
@endsection

{{-- @section('template_fastload_css')

@endsection --}}

@section('content')

			<div class="col-md-10 offset-md-1 col-xs-10 offset-xs-1">

                @if(isset($post))
                    
                        <div class="card shadow mb-4 mt-4">
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
                                    {!! $post->impact ? "<p class='small'>Impact: $post->impact </p>" : '' !!}
                                    {!! $post->nature_of_response ? "<p class='small'>Nature of Response: $post->nature_of_response </p>" : '' !!}
                                    {!! $post->response_actions ? "<p class='small'>Response Actions: $post->response_actions </p>" : '' !!}
                                    {!! $post->responder_name ? "<p class='small'>Responder Name: $post->responder_name </p>" : '' !!}
                                    {!! $post->feedback_on_response ? "<p class='small'>Feedback on Response: $post->feedback_on_response </p>" : '' !!}
                                    {!! $post->additional_follow_up ? "<p class='small'>Additional Follow Up: $post->additional_follow_up </p>" : '' !!}
                                    <hr />
                                    <p class="post-location text-muted"><small>{{$post->location}}</small> <br>
                                    <i class="fa fa-map-pin"></i> {{$post->district->name}}</p>
                            </div>
                        </div>
                    
                @endif
                
            </div>

@endsection

@section('footer_scripts')

@endsection
