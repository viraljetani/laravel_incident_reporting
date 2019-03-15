@extends('layouts.app')

@section('template_title')
	All Events
@endsection

{{-- @section('template_fastload_css')

@endsection --}}

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-11 offset-md-1 col-lg-9 offset-lg-1">
				<div class="card">
					<div class="card-header">

                        All Events
                        <a href="{{route('events.create')}}" class="btn btn-primary pull-right"> Add </a>

					</div>
					<div class="card-body">
                        <!-- will be used to show any messages -->
                        @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        @if(isset($events))
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    
                                    <td>Title</td>
                                    <td>Description</td>
                                    
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $key => $event)
                                <tr>
                                    
                                    <td>{{ $event->title }}</td>
                                    <td>{{ $event->description }}</td>
                                    
                                    <td>

                                        
                                        {{-- <a class="btn btn-small btn-success" href="{{ URL::to('events/' . $event->id) }}">Show</a> --}}

                                        <!-- edit this event (uses the edit method found at GET /events/{event}/edit -->
                                        <a class="btn btn-small btn-info d-inline-block " href="{{ URL::to('events/' . $event->id . '/edit') }}"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i></a>
                                        {{ Form::open(array('url' => 'events/' . $event->id, 'class' => 'd-inline-block')) }}
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
