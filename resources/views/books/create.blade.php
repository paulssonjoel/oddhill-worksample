<x-form-errors />

<form action="" method="POST">
	<input name="title" placeholder="name">
	<input name="isbn" placeholder="isbn">
	<textarea name="description" placeholder="description"></textarea>
	<input type="submit">
	@csrf
</form>
