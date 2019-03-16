@extends('layouts.app')

@section('template_title')
	All Posts
@endsection

{{-- @section('template_fastload_css')

@endsection --}}

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-11 offset-md-1 col-lg-9 offset-lg-1">
				<div class="card">
					<div class="card-header">

                        Incidents
                        <a href="{{route('posts.create')}}" class="btn btn-primary pull-right"> Import New </a>

					</div>
					<div class="card-body">
                        <!-- will be used to show any messages -->
                        @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        @if(isset($posts))
                        
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    
                                    <td>CSO Name</td>
                                    <td>Location</td>
                                    <td>District</td>
                                    <td>Date</td>
                                    <td>Time</td>
                                    <td>Incident Type</td>
                                    <td>Details</td>
                                    <td>Response Actions</td>
                                    <td>Responder Name</td>
                                    <td>Feedback On Response</td>
                                    <td>Additional Follow Up</td>
                                    
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $key => $post)
                                <tr>
                                    
                                    <td>{{$post->cso_name}}</td>
                                    <td>{{$post->location}}</td>
                                    <td>{{$post->district->name}}</td>
                                    <td>{{$post->post_date}}</td>
                                    <td>{{$post->post_time}}</td>
                                    <td>{{$post->postType->name}}</td>
                                    <td>{{$post->details}}</td>
                                    <td>{{$post->response_actions}}</td>
                                    <td>{{$post->responder_name}}</td>
                                    <td>{{$post->feedback_on_response}}</td>
                                    <td>{{$post->additional_follow_up}}</td>
                                    
                                    <td>

                                        
                                        {{-- <a class="btn btn-small btn-success" href="{{ URL::to('events/' . $event->id) }}">Show</a> --}}

                                        <!-- edit this event (uses the edit method found at GET /events/{event}/edit -->
                                        <a class="btn btn-small btn-info d-inline-block " href="{{ URL::to('events/' . $post->id . '/edit') }}"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i></a>
                                        {{ Form::open(array('url' => 'events/' . $post->id, 'class' => 'd-inline-block')) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            {{ Form::button('<i class="fa fa-fw fa-trash" aria-hidden="true"></i>', ['class' => 'btn btn-warning','type'=>'submit']) }}
                                        {{ Form::close() }}

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <p>No Events added on the platform.</p>
                        @endif

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('footer_scripts')

@endsection
