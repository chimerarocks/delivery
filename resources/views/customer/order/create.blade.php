@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Novo Pedido</h3>
		
		@include('errors._check')

		{{ Form::open(['class' => 'form']) }}

		<div class="form-group">
			<label>Total:</label>
			<p id="total"></p>
			<a href="#" class="btn btn-default">Novo Item</a>
		</div>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Produto</th>
					<th>Quantidade</th>
				</tr>
			</thead>
			<tbody>
				<td>
					<select name="items[0][product_id]" class="form-control">
						@foreach($products as $p)
							<option value="{{$p->id}}" data-price="{{$p->price}}">
								{{ $p->name }} --- {{ $p->price }}
							</option>
						@endforeach
					</select>
				</td>
				<td>
					{!! Form::text('items[0][qtd]', 1, ['class' => 'form-control']) !!}
				</td>
			</tbody>
		</table>

		<div class="form-group">
			{{ Form::submit('Criar Pedido', ['class' => 'btn btn-primary']) }}
		</div>

		{{ Form::close() }}

	</div>
@endsection