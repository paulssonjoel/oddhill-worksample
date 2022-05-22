<x-form-errors />

<form action="" method="POST">
    <input name="name" placeholder="name" required>
    <textarea name="biography" placeholder="biography"></textarea>
    <input type="submit">
    @csrf
</form>
