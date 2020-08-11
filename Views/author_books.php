<div class="page-header">
    <a class="btn btn-default pull-right" href="/"><i class="fa fa-home"></i> Home</a>
    <h1>Author Books</h1>
</div>

<table class="table">
    <caption><?=$author['name']?></caption>

    <?php foreach($books as $book): ?>
        <tr>
            <td><?= $book['book_name']?></td>
            <td class="text-right">
                <a class="" href="/?controller=book&action=edit&id=<?=$book['book_id']?>"><i class="fa fa-pencil"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>