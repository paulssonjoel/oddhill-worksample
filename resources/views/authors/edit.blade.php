<x-form-errors />

<form action="" method="POST">
	<input name="name" placeholder="name" value="{{ $author->name }}">
	<textarea name="biography" placeholder="biography">{{ $author->biography }}</textarea>
	<input type="submit">
	@csrf
</form>

<form action="/authors/{{ $author->id }}/delete" method="POST">
	<input type="submit" value="Delete">
	@csrf
</form>