@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Editando Produto: {{ $product->name }}</h3>
		
		@include('errors._check')

		{{ Form::model($product, [
			'route' => ['admin.products.update', $product->id], 
			'class' => 'form',
			'method' => 'put'
			]) 
		}}

		@include('admin.product._form')

		<div class="form-group">
			{{ Form::submit('Editar Produto', ['class' => 'btn btn-primary']) }}
		</div>

		{{ Form::close() }}

	</div>
@endsection