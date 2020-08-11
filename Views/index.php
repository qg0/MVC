<div class="page-header">
    <a class="btn btn-default pull-right" href="/?controller=author&action=add"><i class="fa fa-plus"></i> Add Author</a>
    <a class="btn btn-default" href="/?controller=book&action=add"><i class="fa fa-plus"></i> Add Book</a>
    <h1>Books</h1>
</div>

<table class="table">
    <caption>Books with authors</caption>
    <?php foreach($books_with_authors as $book): ?>
        <tr>
            <td><?= $book['authors']?></td>
            <td><?= $book['book_name']?></td>
            <td class="text-right"><a class="" href="/?controller=book&action=edit&id=<?=$book['book_id']?>"><i class="fa fa-pencil"></i></a></td>
        </tr>
    <?php endforeach; ?>
</table>

<table class="table">
    <caption>Books</caption>

    <?php foreach($books as $book): ?>
        <tr>
            <td><?= $book['name']?></td>
            <td class="text-right">
                <a class="text-danger" href="/?controller=book&action=delete&id=<?=$book['id']?>"><i class="fa fa-times"></i></a>
                <a class="" href="/?controller=book&action=edit&id=<?=$book['id']?>"><i class="fa fa-pencil"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<form action="/?controller=author&action=coauthors" method="post">
<table class="table">
    <caption>Authors</caption>
    <?php foreach($authors as $author): ?>
        <tr>
            <td><a href="/?controller=author&action=books&id=<?= $author['id']?>"><?= $author['name']?></a></td>
            <td><input type="checkbox" name="authors[]" value="<?= $author['id']?>"></td>
            <td class="text-right"><a class="" href="/?controller=author&action=edit&id=<?=$author['id']?>"><i class="fa fa-pencil"></i></a></td>
        </tr>
    <?php endforeach; ?>
</table>
    <input type="submit" value="Find by co-authors" class="btn btn-success">
</form>