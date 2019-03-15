@extends('layouts.app')

@section('template_title')
	All Events
@endsection

{{-- @section('template_fastload_css')

@endsection --}}

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
				<div class="card">
					<div class="card-header">

						Create an Event

					</div>
					<div class="card-body">

                        <!-- if there are creation errors, they will show here -->
                        {{ HTML::ul($errors->all()) }}
                        
                        {{ Form::open(array('url' => 'events')) }}
                        
                            <div class="form-group">
                                {{ Form::label('title', 'Title') }}
                                {{ Form::text('title', Input::old('title'), array('class' => 'form-control','required'=>'required')) }}
                            </div>
                        
                            <div class="form-group">
                                {{ Form::label('description', 'Description') }}
                                {{ Form::textarea('description', Input::old('description'), array('class' => 'form-control')) }}
                            </div>
                        
                            {{ Form::submit('Create an Event', array('class' => 'btn btn-primary')) }}
                        
                        {{ Form::close() }}

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('footer_scripts')

@endsection
