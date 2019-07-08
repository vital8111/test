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
</div>
<script type="application/javascript">
    function draw(element){
        var div = document.getElementById('articles');
        cont = document.createElement('article');
        cont.className="container";
        row1 = document.createElement('div');
        row1.className="row";
        row2 = document.createElement('div');
        row2.className="row";
        row3 = document.createElement('div');
        row3.className="row";
        btnModify=document.createElement('button');
        btnModify.className="btn btn-warning";
        btnModify.type="button";
        btnModify.onclick="modify(event)";
        btnModifyText=document.createTextNode('Изменить');
        btnDel=document.createElement('button');
        btnDel.className="btn btn-danger";
        btnDel.type="button";
        btnDel.onclick="del()";
        btnDelText=document.createTextNode('Удалить');
        btnModify.appendChild(btnModifyText);
        row1.appendChild(btnModify);
        btnDel.appendChild(btnDelText);
        row1.appendChild(btnDel);
        cont.appendChild(row1);
        h2=document.createElement('h2');
        h2Text=document.createTextNode(element.id+'.'+element.title);
        h2.appendChild(h2Text);
        row2.appendChild(h2);
        cont.appendChild(row2);
        cont.appendChild(row3);
        div.appendChild(cont);
    }
    var req = new XMLHttpRequest();
    var url = "/article/all/"
    req.open("GET", url, true);
    req.send(null);
    req.onreadystatechange = function()
    {
        if (req.readyState == 4) {
            var articles = JSON.parse(req.responseText);
            articles.forEach(function(element){draw(element);});
        }
    }
</script>