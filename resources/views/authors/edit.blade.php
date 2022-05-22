<x-form-errors />

<form action="" method="POST">
    <input name="name" placeholder="name" value="{{ $author->name }}" required>
    <textarea name="biography" placeholder="biography">{{ $author->biography }}</textarea>
    <input type="submit">
    @csrf
</form>

<form action="/admin/authors/{{ $author->id }}/delete" method="POST">
    <input type="submit" value="Delete">
    @csrf
</form>
