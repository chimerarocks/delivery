@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Editando Cliente: {{ $client->user->name }}</h3>
		
		@include('errors._check')

		{{ Form::model($client, [
			'route' => ['admin.clients.update', $client->id], 
			'class' => 'form',
			'method' => 'put'
			]) 
		}}

		@include('admin.client._form')

		<div class="form-group">
			{{ Form::submit('Editar Cliente', ['class' => 'btn btn-primary']) }}
		</div>

		{{ Form::close() }}

	</div>
@endsection