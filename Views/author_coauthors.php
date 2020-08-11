<div class="page-header">
    <a class="btn btn-default pull-right" href="/"><i class="fa fa-home"></i> Home</a>
    <h1>Co-author Books</h1>
</div>


<table class="table">
    <caption>Co-authors</caption>

    <?php foreach($authors as $author): ?>
        <tr>
            <td><?= $author['name']?></td>
            <td class="text-right">
                <a class="" href="/?controller=author&action=edit&id=<?=$author['id']?>"><i class="fa fa-pencil"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<table class="table">
    <caption>Books</caption>

    <?php foreach($books as $book): ?>
        <tr>
            <td><?= $book['book_name']?></td>
            <td class="text-right">
                <a class="" href="/?controller=book&action=edit&id=<?=$book['book_id']?>"><i class="fa fa-pencil"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>