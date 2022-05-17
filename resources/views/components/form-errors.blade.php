@php
	$bags = $errors->getBags();
	$bag = $bags ? $bags['default']->all() : [];
@endphp
@foreach($bag as $error)
	{{ $error }}<br>
@endforeach
