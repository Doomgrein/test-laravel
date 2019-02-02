@extends ('layouts.layout')

@section ('content')

    <div class="container">
        <div class="panel-body">
            <table class="table table-striped task-table" border="1">

                <!-- Заголовок таблицы -->
                <thead>
                <tr style="background: lightgoldenrodyellow">
                    <th>Статья</th>
                    <th>Текст статьи</th>
                    <th>Авторы</th>
                </tr>
                </thead>

                <!-- Тело таблицы -->
                <tbody>
                @forelse($articles as $article)
                    <tr>
                        <!-- Имя задачи -->
                        <td class="table-text">
                            <div>{{ $article->theme }}</div>
                        </td>

                        <td class="table-text">
                            <div>{{ $article->text }}</div>
                        </td>

                        <td class="table-text">
                            <div>{{ $article->users()->pluck('nickname')->implode(', ') }}</div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td class="table-text">
                            <div>Данные отсутствуют</div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>

        <div class="row">
            <div class="panel panel-default">
                <div class="box-body">
                    <div class='edit-profile'>
                        <h2 class="heading"> Создать статью: </h2>
                        <form class='form' id='form' method='POST' enctype='multipart/form-data'>
                            <ul class="form__list">
                                <li class="form__item">
                                    <label class='form__label' for="users">Авторы:</label>
                                    <select class="form__label" name="user_id" id="users">
                                        <option value="0" disable="true" selected="true"> Выберите автора </option>
                                    </select>
                                </li>
                                <li class="form__item">
                                    <label class='form__label' for="nickname">Тема:</label>
                                    <input class='form__input' id='nickname' type="text">
                                </li>
                                <li class="form__item">
                                    <label class='form__label' for="name">Текст:</label>
                                    <input class='form__input' id='name' type="text">
                                </li>
                                <li class="form__item">
                                    <button class='form__button' type="submit">Отправить</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection