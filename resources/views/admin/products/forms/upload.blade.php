@extends('admin.modal')

@section('content')

    <form id="upload">
        <input type="hidden" name="product_id" value="{{ $product_id }}">
        <div class="form-group">
            <label>Зображення</label>
            <input multiple accept="image/*" type="file" id="image" name="image" style="display: none">
            <label for="image" class="form-control form-control-sm">Виберіть фото</label>

            <small id="image-list" class="form-text text-muted"></small>
        </div>

        <div class="form-group">
            <label>Альтернативний текст</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset('img/uk.png') }}">
                            </span>
                        </div>
                        <input class="form-control form-control-sm" name="alt_uk">
                        <div class="feedback"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="{{ asset('img/ru.png') }}">
                            </span>
                        </div>
                        <input class="form-control form-control-sm" name="alt_ru">
                        <div class="feedback"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Пріоритет</label>
            <input class="form-control form-control-sm" name="priority" type="number" value="0">
            <div class="feedback"></div>
        </div>

        <div class="form-group" style="margin-bottom: 0">
            <button class="btn btn-primary btn-sm">Зберегти</button>
        </div>
    </form>

@endsection('content')

@section('script')

    <script>
        $(document).ready(function () {
            let files;
            $(document).on('change', '#image', function () {
                files = this.files;

                let text = '';
                for (let i = 0; i < files.length; i++) {
                    text += files[i].name + '<br>';
                }

                $('#image-list').html(text);
            });


            $(document).on('submit', '#upload', function (event) {
                event.stopPropagation(); // остановка всех текущих JS событий
                event.preventDefault();  // остановка дефолтного события для текущего элемента - клик для <a> тега

                // ничего не делаем если files пустой
                if (typeof files == 'undefined') return alert('Виберіть файли!');

                // создадим объект данных формы
                var data = new FormData();

                // заполняем объект данных файлами в подходящем для отправки формате
                $.each(files, function (key, value) {
                    data.append('images[]', value);
                });

                // добавим переменную для идентификации запроса
                data.append('alt_uk', $(this).find('[name="alt_uk"]').val());
                data.append('alt_ru', $(this).find('[name="alt_ru"]').val());
                data.append('priority', $(this).find('[name="priority"]').val());
                data.append('product_id', $(this).find('[name="product_id"]').val());

                // AJAX запрос
                $.ajax({
                    url: Data.imageUploadRoute,
                    type: 'POST', // важно!
                    data: data,
                    cache: false,
                    dataType: 'json',
                    // отключаем обработку передаваемых данных, пусть передаются как есть
                    processData: false,
                    // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
                    contentType: false,
                    success: function (response) {
                        Common.successHandler(response)
                    },
                    error: function (response) {
                        Common.errorHandler(response);
                    }

                });

            });
        });
    </script>

@endsection('script')