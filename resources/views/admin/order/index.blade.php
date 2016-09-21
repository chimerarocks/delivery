@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Pedidos</h3>

		<br><br>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Total</th>
					<th>Data</th>
					<th>Itens</th>
					<th>Entregador</th>
					<th>Situação</th>
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
				@forelse($orders as $order)
				<tr>
					<td>#{{$order->id}}</td>
					<td>{{$order->total}}</td>
					<td>{{$order->created_at}}</td>
					<td>
						<ul>
						@foreach($order->items as $item)
							<li>{{$item->product->name}}</li>
						@endforeach
						</ul>
					</td>
					<td>
						@if($order->deliveryman)
							{{$order->deliveryman->name}}
						@else
							--
						@endif
					</td>
					<td>{{$order->status}}</td>
					<td>
						<a href="{{ route('admin.orders.edit', ['id' => $order->id]) }}" 
						class="btn btn-default">
							Editar
						</a>
					</td>
				</tr>
				@empty
				<tr>
					<td>Nenhum produto registrado</td>
					<td></td>
					<td></td>
				</tr>
				@endforelse
			</tbody>
		</table>
	
		{{ $orders->render() }}

	</div>
@endsection