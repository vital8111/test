<dialog id="add">
    <form enctype="multipart/form-data" action="/article/add" method="POST">
        <?php include "form.php"?>
    </form>
</dialog>
<dialog id="modify">
    <form enctype="multipart/form-data" action="/article/modify/" method="POST">
        <?php include "form.php"?>
    </form>
</dialog>

<script type = text/javascript>
    var dialog = document.querySelector('dialog');
    function add(){
        dialog.showModal();
    };
    function modify(event){
        //console.log(event.srcElement.parentNode.parentNode.childNodes[7].value);
        dialog.showModal();
        var req = new XMLHttpRequest();
        var url = "/article/show/"+event.srcElement.parentNode.parentNode.childNodes[7].value;
        req.open("GET", url, true);
        req.send(null);
        req.onreadystatechange = function(){
            console.log(req.readyState)
            if (req.readyState == 4) {
            var response = req.responseText;
        }
            console.log(response);};
    };
    function del(){

    }
    document.querySelector('#close').onclick = function() {
        dialog.close();
    };
</script>

<h1>All articles</h1>
<button id="add" type="button" class="btn btn-success" onclick="add();">Добавить</button>
<hr>
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