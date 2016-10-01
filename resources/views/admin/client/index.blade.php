@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Clientes</h3>

		<a href="{{ route('admin.clients.create') }}" class="btn btn-default">Novo Cliente</a>

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
				@forelse($clients as $client)
				<tr>
					<td>{{$client->id}}</td>
					<td>{{$client->user->name}}</td>
					<td>
						<a href="{{ route('admin.clients.edit', ['id' => $client->id]) }}" 
						class="btn btn-default">
							Editar
						</a>
					</td>
				</tr>
				@empty
				<tr>
					<td>Nenhum cliente registrado</td>
					<td></td>
					<td></td>
				</tr>
				@endforelse
			</tbody>
		</table>
	
		{{ $clients->render() }}

	</div>
@endsection