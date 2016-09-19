@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Categorias</h3>

		<a href="{{ route('admin.categories.create') }}" class="btn btn-default">Nova Categoria</a>

		<br><br>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Nome</th>
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
				@forelse($categories as $category)
				<tr>
					<td>{{$category->id}}</td>
					<td>{{$category->name}}</td>
					<td>
						<a href="{{ route('admin.categories.edit', ['id' => $category->id]) }}" 
						class="btn btn-default">
							Editar
						</a>
					</td>
				</tr>
				@empty
				<tr>
					<td>Nenhuma categoria registrada</td>
					<td></td>
					<td></td>
				</tr>
				@endforelse
			</tbody>
		</table>
	
		{{ $categories->render() }}

	</div>
@endsection