@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Editando Pedido: {{ $order->id }}</h3>
		
		<h2>R$ {{ $order->total }}</h2>
		<h3>Cliente: {{ $order->client->user->name }}</h3>
		<h4>Data: {{ $order->created_at }}</h4>

		<p>
			<b>Entregar em:</b>
			{{ $order->client->address }} - {{ $order->client->city }} {{ $order->client->zipcode }} - {{ $order->client->state}}
		</p>


		@include('errors._check')

		{{ Form::model($order, [
			'route' => ['admin.orders.update', $order->id], 
			'class' => 'form',
			'method' => 'put'
			]) 
		}}

		<div class="form-group">
			{{ Form::label('Status', 'Situação:') }}
			{{ Form::select('status', $status_list, null, ['class' => 'form-control']) }}
		</div>

		<div class="form-group">
			{{ Form::label('Deliveryman', 'Entregador:') }}
			{{ Form::select('user_deliveryman_id', $deliverymen, null, ['class' => 'form-control']) }}
		</div>

		<div class="form-group">
			{{ Form::submit('Editar Pedido', ['class' => 'btn btn-primary']) }}
		</div>

		{{ Form::close() }}

	</div>
@endsection