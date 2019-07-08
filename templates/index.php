<script type="application/javascript">

</script>
<dialog id="add">
    <form enctype="multipart/form-data" action="/article/add" method="POST" name="send">
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
        req.onreadystatechange = function()
        {
            if (req.readyState == 4) {
                var article = JSON.parse(req.responseText);
                var image = document.getElementById('image');
                var title = document.getElementById('title');
                var text = document.getElementById('text');
                var id = document.getElementById('id');
                title.value=article.title;
                text.value=article.text;
                console.log(title);
            };
        }
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
<div id="articles">
    <div>Test</div>
</div>
<script type="application/javascript">
    var req = new XMLHttpRequest();
    var url = "/article/all/"
    req.open("GET", url, true);
    req.send(null);
    req.onreadystatechange = function()
    {
        if (req.readyState == 4) {
            var articles = JSON.parse(req.responseText);
            var div = document.getElementById('articles');
                articles.forEach(function(element){console.log(element);});
            console.log(articles);
        }
    }
</script>