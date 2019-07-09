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
<button id="send" type="button" class="btn btn-success" onclick='
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
'>Отправить</button>
<button id="close_mod" type="button" class="btn btn-danger">Отмена</button>