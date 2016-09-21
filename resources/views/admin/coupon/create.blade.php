@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Novo Cupom</h3>
		
		@include('errors._check')

		{{ Form::open(['route' => 'admin.coupons.store', 'class' => 'form']) }}

		@include('admin.coupon._form')

		<div class="form-group">
			{{ Form::submit('Criar Cupom', ['class' => 'btn btn-primary']) }}
		</div>

		{{ Form::close() }}

	</div>
@endsection