@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Editando Categoria: {{ $category->name }}</h3>
		
		@include('errors._check')

		{{ Form::model($category, [
			'route' => ['admin.categories.update', $category->id], 
			'class' => 'form',
			'method' => 'put'
			]) 
		}}

		<div class="form-group">
			{{ Form::submit('Editar Categoria', ['class' => 'btn btn-primary']) }}
		</div>

		@include('admin.category._form')

		{{ Form::close() }}

	</div>
@endsection