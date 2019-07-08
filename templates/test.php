<?php foreach($this->articles as $article):?>
    <article class="container">
        <div class="row">
            <button type="button" class="btn btn-warning" onclick="modify(event);">Изменить</button>
            <button type="button" class="btn btn-danger" onclick="del();">Удалить</button>
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
        <input type="hidden" name="id" value='<?php echo $article->id?>'>
    </article>
    <hr>
<?php endforeach; ?>