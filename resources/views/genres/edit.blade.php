<x-form-errors />

<form action="" method="POST">
    <input name="name" placeholder="name" value="{{ $genre->name }}" required>
    <input type="submit">
    @csrf
</form>

<form action="/admin/genres/{{ $genre->id }}/delete" method="POST">
    <input type="submit" value="Delete">
    @csrf
</form>
