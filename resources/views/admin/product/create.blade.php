@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Novo Produto</h3>
		
		@include('errors._check')

		{{ Form::open(['route' => 'admin.products.store', 'class' => 'form']) }}

		@include('admin.product._form')

		<div class="form-group">
			{{ Form::submit('Create Produto', ['class' => 'btn btn-primary']) }}
		</div>

		{{ Form::close() }}

	</div>
@endsection