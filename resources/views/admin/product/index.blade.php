@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Produtos</h3>

		<a href="{{ route('admin.products.create') }}" class="btn btn-default">Novo Produto</a>

		<br><br>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Nome</th>
					<th>Categoria</th>
					<th>Preço</th>
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
				@forelse($products as $product)
				<tr>
					<td>{{$product->id}}</td>
					<td>{{$product->name}}</td>
					<td>{{$product->category->name}}</td>
					<td>{{$product->price}}</td>
					<td>
						<a href="{{ route('admin.products.edit', ['id' => $product->id]) }}" 
						class="btn btn-default">
							Editar
						</a>
						<a href="{{ route('admin.products.destroy', ['id' => $product->id]) }}" 
						class="btn btn-default">
							Remover
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
	
		{{ $products->render() }}

	</div>
@endsection