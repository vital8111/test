<h1>All articles</h1>
<hr>
<?php foreach($this->articles as $article):?>
    <article>
        <h1><?php echo $article->id.'.'.$article->title?></h1>
        <h2><?php echo $article->text?></h2>
        <h2><?php echo $article->datetime?></h2>
        <h2><?php echo "<img src='/images/$article->image'"?></h2>
    </article>
    <hr>
<?php endforeach; ?>