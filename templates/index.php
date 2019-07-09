<script type="application/javascript">

</script>
<dialog id="add">
    <form enctype="multipart/form-data" action="/article/add" method="POST" name="send">
        <?php include "form.php"?>
    </form>
</dialog>
<dialog id="modify">
    <form enctype="multipart/form-data" action="/article/modify/" method="POST" name="mod">
        <?php include "form_modify.php"?>
    </form>
</dialog>

<script type = text/javascript>
    var dialog = document.querySelector('dialog');
    var dialogModify = document.getElementById('modify');
    function add(){
        dialog.showModal();
    };
    function modify(event){
        //console.log(event.srcElement.parentNode.parentNode.childNodes[3].value);
        dialogModify.showModal();
        var req = new XMLHttpRequest();
        var url = "/article/show/"+event.srcElement.parentNode.parentNode.childNodes[3].value;
        req.open("GET", url, true);
        req.send(null);
        req.onreadystatechange = function()
        {
            if (req.readyState == 4) {
                var article = JSON.parse(req.responseText);
                var image = document.getElementById('image_mod');
                var title = document.getElementById('title_mod');
                var text = document.getElementById('text_mod');
                var id = document.getElementById('id_mod');
                title.value=article.title;
                text.value=article.text;
                id.value=article.id;
                //console.log(title);
            };
        }
    };
    function del(id){
        var req = new XMLHttpRequest();
        var url = "/article/delete/"+id;
        req.open("GET", url, true);
        req.send(null);
        req.onreadystatechange = function()
        {
            if (req.readyState == 4)
            {
                result = req.responseText;
                alert(result);
                var req2 = new XMLHttpRequest();
                var url = "/article/all/"
                req2.open("GET", url, true);
                req2.send(null);
                req2.onreadystatechange = function()
                {
                    if (req2.readyState == 4)
                    {
                        var art = req2.responseText;
                        var div = document.getElementById("articles");
                        div.innerHTML=art;
                        document.getElementById("modify").close();
                    };
                }
            }
        }
    }
    document.querySelector('#close').onclick = function() {
        dialog.close();
    };
    document.querySelector('#close_mod').onclick = function() {
        dialogModify.close();
    };
</script>

<h1>All articles</h1>
<button id="add" type="button" class="btn btn-success" onclick="add();">Добавить</button>
<hr>
<div id="articles">
</div>
<script type="application/javascript">
    /*function draw(element){
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
    }*/
    var req = new XMLHttpRequest();
    var url = "/article/all/"
    req.open("GET", url, true);
    req.send(null);
    req.onreadystatechange = function()
    {
        if (req.readyState == 4) {
            var articles = req.responseText;
            var div = document.getElementById("articles");
            div.innerHTML=articles;
            /*btnsMod = document.getElementsByClassName("btn-modify");
            for (btnMod of btnsMod){
                console.log(btnMod);
                btnMod.onclick=function(){modify(event)};
            }*/
            //articles.forEach(function(element){draw(element);});
        }
    }
</script>