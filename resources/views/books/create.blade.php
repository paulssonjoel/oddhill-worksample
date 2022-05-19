<x-form-errors />

<form action="" method="POST">
	<input name="title" placeholder="name">
	<input name="isbn" placeholder="isbn">
	<textarea name="description" placeholder="description"></textarea>

	<br>

	Select authors:
	@foreach($authors as $author)
		{{ $author->name }}: <input type="checkbox" name="authors[]" value="{{ $author->id}}">
	@endforeach

	<br>

	<input type="submit">
	@csrf
</form>
