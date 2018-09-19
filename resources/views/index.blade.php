@extends('schematic::layout')

@section('schematic::content')
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($items as $item)
				<tr>
					<td>
						@include('schematic::partials.table.link', [
							'url' => route('schematic::table', ['schema' => $item]),
							'value' => ucfirst(str_replace('_', ' ', $item)),
						])
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection