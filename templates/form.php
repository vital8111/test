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
<button id="send" type="submit" class="btn btn-success">Отправить</button>
<button id="close" type="button" class="btn btn-danger">Отмена</button>