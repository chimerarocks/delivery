@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Novo Pedido</h3>
		
		@include('errors._check')

		{{ Form::open(['route' => 'customer.orders.store','class' => 'form']) }}

		<div class="form-group">
			<label>Total:</label>
			<p id="total"></p>
			<a href="#" id="btnNewItem" class="btn btn-default">Novo Item</a>
		</div>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Produto</th>
					<th>Quantidade</th>
				</tr>
			</thead>
			<tbody>
				<tr>
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
				</tr>
			</tbody>
		</table>

		<div class="form-group">
			{{ Form::submit('Criar Pedido', ['class' => 'btn btn-primary']) }}
		</div>

		{{ Form::close() }}

	</div>
@endsection

@section('post-script')
	<script>
		calculateTotal()
		$('#btnNewItem').click(function() {
			var row = $('table tbody > tr:last'),
				newRow = row.clone(),
				length = $("table tbody tr").length

			newRow.find('td').each(function() {
				var td = $(this),
					input = td.find('input,select'),
					name = input.attr('name')
				input.attr('name', name.replace((length - 1) + "", length + ""))
			});

			newRow.find('input').val(1)
			newRow.insertAfter(row)
			calculateTotal()
		});

		$(document.body).on('click', 'select', function() {
			calculateTotal()
		})

		$(document.body).on('blur', 'input', function() {
			calculateTotal()
		})

		$(document.body).on('keyup', 'input', function() {
			calculateTotal()
		})

		function calculateTotal() {
			var total = 0,
				trLen = $('table tbody tr').length
				tr = null, 
				price = 0, 
				qtd = 0

			for (var i = 0; i < trLen; i++) {
				tr = $('table tbody tr').eq(i)
				price = tr.find(':selected').data('price')
				qtd = tr.find('input').val()
				total += price * qtd
			}

			$('#total').html(total)
		}
	</script>
@endsection