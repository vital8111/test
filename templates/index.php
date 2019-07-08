<h1>All articles</h1>
<button id="add" type="button" class="btn btn-success">Добавить</button>
<hr>
<?php foreach($this->articles as $article):?>
    <article class="container">
        <div class="row">
            <button id="modify" type="button" class="btn btn-warning">Изменить</button>
            <button id="delete" type="button" class="btn btn-danger">Удалить</button>
        </div>
        <div class="row">
            <h2><?php echo $article->id.'.'.$article->title?></h2>
        </div>
        <div class="row">
            <div class="col-sm-9">
                <p><?php echo $article->text?></p>
                <p><?php echo $article->datetime?></p>
            </div>
            <div class="col-sm-3">
                <?php echo "<img src='/images/$article->image' class='img-fluid'>"?>
            </div>
        </div>
    </article>
    <hr>
<?php endforeach; ?>

<dialog>
    <?php include "form.php"?>
</dialog>

<script type = text/javascript>
    var dialog = document.querySelector('dialog');
    document.querySelector('#add').onclick = function() {
        dialog.showModal();
    };
    document.querySelector('#modify').onclick = function() {
        dialog.showModal();
    };
    document.querySelector('#close').onclick = function() {
        dialog.close();
    };
</script>