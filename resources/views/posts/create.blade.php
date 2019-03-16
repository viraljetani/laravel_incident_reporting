@extends('layouts.app')

@section('template_title')
	Import Incidents
@endsection

{{-- @section('template_fastload_css')

@endsection --}}

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
				<div class="card">
					<div class="card-header">

						Import

					</div>
					<div class="card-body">

                        <!-- if there are creation errors, they will show here -->
                        {{ HTML::ul($errors->all()) }}
                        
                        {{ Form::open(['url' => 'posts','files' => true]) }}
                        
                            <div class="form-group">
                                {{ Form::label('excel_import', 'Upload Excel file') }}
                                {{ Form::file('file_import', Input::old('file_import'), array('class' => 'form-control','required'=>'required')) }}
                            </div>
                        
                            
                        
                            {{ Form::submit('Upload', array('class' => 'btn btn-primary')) }}
                        
                        {{ Form::close() }}

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('footer_scripts')

@endsection
