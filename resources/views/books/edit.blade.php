<x-form-errors />

<form action="" method="POST">
	<input name="title" placeholder="name" value="{{ $book->title }}">
	<input name="isbn" placeholder="isbn" value="{{ $book->isbn }}">

	Select authors:
	@foreach($possibleAuthors as $author)
		{{ $author->name }}: <input type="checkbox" name="authors[]" value="{{ $author->id}}" @if($book->author_book->contains('author_id', $author->id)) checked="true" @endif>
	@endforeach

	<textarea name="description" placeholder="description" value="{{ $book->description }}"></textarea>
	<input type="submit">
	@csrf
</form>
