@extends('schematic::layout')

@section('schematic::content')
@if (session()->has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! session()->get('success') !!}</li>
        </ul>
    </div>
@endif
@if (session()->has('errors'))
    <div class="alert alert-success">
        <ul>
        	@foreach (session()->get('errors') as $error)
            <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="post">
	@csrf
	@foreach ($fields as $field)
		{!! $field->renderFormElement($item) !!}
	@endforeach
	<div>
		<button class="btn btn-success" type="submit" name="submit" value="store">Store</button>
		<button class="btn btn-success" type="submit" name="submit" value="apply">Apply</button>
		<a href="{{ route('schematic::table', ['schema' => $schema]) }}">
			<button class="btn btn-default" type="button">Back</button>
		</a>
	</div>
</form>
@endsection