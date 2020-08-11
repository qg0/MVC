<div class="page-header">
    <a class="btn btn-default pull-right" href="/"><i class="fa fa-home"></i> Home</a>
    <h1>Add Book</h1>
</div>

<form action="" method="post" enctype="multipart/form-data">
    <input type="text" name="name" required>
    <?php foreach ($authors as $author): ?>
        <input
            <?php if (in_array($author['id'], $checked_author_ids)): ?> checked <?php endif ?>
                type="checkbox"
                name="authors[]"
                value="<?=$author['id']?>"
        >
        <?=$author['name']?>
    <?php endforeach; ?>
    <input type="submit" value="Add" class="btn btn-success">
</form>
