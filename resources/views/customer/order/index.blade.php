@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Meus Pedidos</h3>

		<a href="{{ route('customer.orders.create') }}" class="btn btn-default">Novo Pedido</a>

		<br><br>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Total</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				@forelse($orders as $order)
				<tr>
					<td>{{$order->id}}</td>
					<td>{{$order->total}}</td>
					<td>{{$order->status}}</td>
				</tr>
				@empty
				<tr>
					<td>Nenhum pedido registrado</td>
					<td></td>
					<td></td>
				</tr>
				@endforelse
			</tbody>
		</table>
	
		{{ $orders->render() }}

	</div>
@endsection