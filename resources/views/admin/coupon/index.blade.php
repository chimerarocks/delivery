@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Cupons</h3>

		<a href="{{ route('admin.coupons.create') }}" class="btn btn-default">Novo Cupom</a>

		<br><br>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Código</th>
					<th>Valor</th>
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
				@forelse($coupons as $coupon)
				<tr>
					<td>{{$coupon->id}}</td>
					<td>{{$coupon->code}}</td>
					<td>{{$coupon->value}}</td>
					<td>
						<a href="{{ route('admin.coupons.edit', ['id' => $coupon->id]) }}" 
						class="btn btn-default">
							Editar
						</a>
					</td>
				</tr>
				@empty
				<tr>
					<td>Nenhum cupom registrado</td>
					<td></td>
					<td></td>
				</tr>
				@endforelse
			</tbody>
		</table>
	
		{{ $coupons->render() }}

	</div>
@endsection