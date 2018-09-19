@extends('schematic::layout')

@section('schematic::content')
	@if (session()->has('success'))
	    <div class="alert alert-success">
	        <ul>
	            <li>{!! session()->get('success') !!}</li>
	        </ul>
	    </div>
	@endif
	<div class="bonjour-panel">
		<div class="bonjour-panel-header">
			<h1>Schemas</h1>
		</div>
		<div class="bonjour-panel-content">
			<table class="table">
				<thead>
					<tr>
					@foreach ($fields as $field)
						@if ($field->hasFlag('sortable'))
							<th>
								<a href="?order={{ $field->getSortableField() }}&by={{ request('by') == 'asc' ? 'desc' : 'asc' }}"
								>{{ $field->getTitle() }}{!! request('order') == $field->getSortableField() ? (request('by') == 'asc' ? ' &uarr;' : '	&darr;') : '' !!}</a>
							</th>
						@else
							<th>{{ $field->getTitle() }}</th>
						@endif
					@endforeach
					</tr>
				</thead>
				<tbody>
					@foreach ($items as $item)
						<tr>
							@foreach ($fields as $field)
								<td>{!! $field->renderTableRow($item) !!}</td>
							@endforeach
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="bonjour-panel-pagination">
			{{ $items->links() }}
		</div>
		<div class="bonjour-panel-footer">
			<a href="{{ route('schematic::entry.insert', ['schema' => $schema->getSchema()]) }}">
				<button type="button" class="btn btn-primary">Insert</button>
			</a>
		</div>
	</div>
@endsection