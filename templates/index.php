<dialog id="add">
    <form enctype="multipart/form-data" action="/article/add" method="POST" name="send">
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Заголовок статьи">
        </div>
        <div class="form-group">
            <label for="text">Текст</label>
            <textarea class="form-control" id="text" name="text" rows="5" placeholder="Текст статьи"></textarea>
        </div>
        <div class="form-group">
            <label class="btn btn-success">
                Выбрать Изображение<input type="file" name="image" class="form-control-file" id="image" hidden>
            </label>
        </div>
        <button id="send" type="button" class="btn btn-success" onclick='addsend();'>Отправить</button>
        <button id="close" type="button" class="btn btn-danger">Отмена</button>
    </form>
</dialog>
<dialog id="modify">
    <form enctype="multipart/form-data" action="/article/modify/" method="POST" name="mod">
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" name="title" id="title_mod" placeholder="Заголовок статьи">
        </div>
        <div class="form-group">
            <label for="text">Текст</label>
            <textarea class="form-control" id="text_mod" name="text" rows="5" placeholder="Текст статьи"></textarea>
        </div>
        <div class="form-group">
            <label class="btn btn-success">
                Выбрать Изображение<input type="file" name="image" class="form-control-file" id="image_mod" hidden>
            </label>
            <input type="hidden" name="id" id="id_mod">
        </div>
        <button id="send" type="button" class="btn btn-success" onclick='modifysend();'>Отправить</button>
        <button id="close_mod" type="button" class="btn btn-danger">Отмена</button>
    </form>
</dialog>

<script type = text/javascript>
    function addsend() {
        var formData = new FormData(document.forms.send);
        var req = new XMLHttpRequest();
        var url = "/article/add/";
        req.open("POST", url, true);
        req.send(formData);
        req.onreadystatechange = function()
        {
            if (req.readyState == 4)
            {
                result = req.responseText;
                alert(result);
                var req2 = new XMLHttpRequest();
                var url = "/article/all/";
                req2.open("GET", url, true);
                req2.send(null);
                req2.onreadystatechange = function()
                {
                    if (req2.readyState == 4)
                    {
                        var art = req2.responseText;
                        var div = document.getElementById("articles");
                        div.innerHTML=art;
                        document.getElementById("add").close();
                    };
                }
            }
        }
    }
    function modifysend() {
        var formData = new FormData(document.forms.mod);
        var req = new XMLHttpRequest();
        var url = "/article/modify/"+document.getElementById("id_mod").value;
        req.open("POST", url, true);
        req.send(formData);
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
        }
    }
</script>