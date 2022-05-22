<x-form-errors />

<form action="" method="POST">
    <input name="title" placeholder="name" value="{{ $book->title }}">
    <input name="isbn" placeholder="isbn" value="{{ $book->isbn }}">

    <textarea name="description" placeholder="description">{{ $book->description }}</textarea>

    Select authors:
    @foreach ($possibleAuthors as $author)
        {{ $author->name }}:
        <input type="checkbox" name="authors[]" value="{{ $author->id }}"
            @if ($book->authors->contains('id', $author->id)) checked="true" @endif>
    @endforeach

    <br>

    Select genres:
    @foreach ($possibleGenres as $genre)
        {{ $genre->name }}: <input type="checkbox" name="genres[]" value="{{ $genre->id }}"
            @if ($book->genres->contains('id', $genre->id)) checked="true" @endif>
    @endforeach

    <input type="submit">
    @csrf
</form>

<form action="/admin/books/{{ $book->id }}/delete" method="POST">
    <input type="submit" value="Delete">
    @csrf
</form>
