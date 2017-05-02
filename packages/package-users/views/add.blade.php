@extends('layouts.default')

@section('title') {{_('Create User')}} @endsection

@section('content')

	<div class="col">

		<div class="bg-light lter b-b wrapper-md">
			<div class="row">
				<div class="col-md-6">
					<h1 class="m-n font-thin h3 text-black">{{_('Users')}}</h1>
					<small class="text-muted">{{_('Create user')}}</small>
				</div>
			</div>
		</div>

		<div class="wrapper-md">
			<div class="panel panel-default">
				<div class="panel-body m-t-md">

					{!! Form::open() !!}

						@include ('package-users::includes.form')

						<div class="line line-dashed b-b line-lg"></div>

						<div class="col-sm-12 text-right">
							<a href="{{ action('\Packages\PackageUsersController@getList') }}" class="btn btn-default">{{_('Cancel')}}</a>
							<button type="submit" class="btn btn-primary">{{_('Create User')}}</button>
						</div>

					{!! Form::close() !!}

				</div>
			</div>
		</div>

	</div>

@endsection
