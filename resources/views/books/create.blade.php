<x-form-errors />

<form action="" method="POST">
	<input name="title" placeholder="name">
	<input name="isbn" placeholder="isbn">

	<select name="author">
		@foreach($authors as $author)
			<option value="{{ $author->id }}">{{ $author->name }}</option>
		@endforeach
	</select>

	<textarea name="description" placeholder="description"></textarea>
	<input type="submit">
	@csrf
</form>
