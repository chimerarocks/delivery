@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Editando Cupom: {{ $coupon->code }}</h3>
		
		@include('errors._check')

		{{ Form::model($coupon, [
			'route' => ['admin.coupons.update', $coupon->id], 
			'class' => 'form',
			'method' => 'put'
			]) 
		}}
		
		@include('admin.coupon._form')

		<div class="form-group">
			{{ Form::submit('Editar Cupom', ['class' => 'btn btn-primary']) }}
		</div>


		{{ Form::close() }}

	</div>
@endsection