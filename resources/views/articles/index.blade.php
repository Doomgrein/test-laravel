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
                    <th>Удаление</th>
                </tr>
                </thead>

                <!-- Тело таблицы -->
                <tbody>
                @forelse($articles as $article)
                    <tr>
                        <td class="table-text">
                            <div>{{ $article->theme }}</div>
                        </td>

                        <td class="table-text">
                            <div>{{ $article->text }}</div>
                        </td>

                        <td class="table-text">
                            <div>{{ $article->users()->pluck('nickname')->implode(', ') }}</div>
                        </td>

                        <td class="table-text">
                            <button type="button" class="delete" data-toggle="modal" data-target="#myModal{{ $article->id }}">
                                <i class="fa fa-remove"></i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal{{ $article->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Подтверждение</h4>
                                        </div>
                                        <div class="modal-body">
                                            Вы уверены?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                            <p></p>
                                            {{ Form::open(['route' => ['articles.destroy', $article->id], 'method' => 'delete']) }}
                                            <button type="submit" class="btn btn-primary">Да</button>
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="table-text" colspan="4">
                            <div>Создайте статью - она будет отображена в данной таблице</div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <!-- Сообщение об ошибках валидации -->
            <div class="box-body col-md-6">
                @include('errors')
            </div>
        </div>

        <a href="{{ route('users.index') }}" class="btn btn-primary" role="button">
            Перейти на страницу управления пользователями
        </a>

        {{ Form::open(['route' => 'articles.store']) }}
        <div class="panel-body">
            <div class="row">
                <div class="panel panel-default">
                    <div class="box-body col-md-6">
                        <div class='edit-profile'>
                            <h2 class="heading"> Создать статью: </h2>
                            <form class='form' id='form' method='POST' enctype='multipart/form-data'>
                                <ul>
                                    <li class="form__item">
                                        <label class='form__label' for="users">Авторы:</label>
                                        @foreach ($users as $user)
                                            <input id="users" type="checkbox" name="users[]" value="{{ $user->id }}">
                                            <label class=""> {{ ucfirst($user->nickname) }} <br> </label>
                                        @endforeach
                                    </li>
                                    <li class="form__item">
                                        <label class='form__label' for="theme">Тема:</label>
                                        <input class='form__input' id='theme' type="text" name="theme">
                                    </li>
                                    <li class="form__item">
                                        <label class='form__label' for="text">Текст:</label>
                                        <input class='form__input' id='text' type="text" name="text">
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
        {{ Form::close() }}

        <div>
            <h2>Статьи "в корзине" (мягко удалённые статьи)</h2>
            <table class="table table-striped task-table" border="1">

                <!-- Заголовок таблицы -->
                <thead>
                <tr style="background: lightgoldenrodyellow">
                    <th>Статья</th>
                    <th>Текст статьи</th>
                    <th>Авторы</th>
                    <th>Восстановление</th>
                </tr>
                </thead>

                <!-- Тело таблицы -->
                <tbody>
                @forelse($trashedArticles as $trashedArticle)
                    <tr>
                        <!-- Имя задачи -->
                        <td class="table-text">
                            <div>{{ $trashedArticle->theme }}</div>
                        </td>

                        <td class="table-text">
                            <div>{{ $trashedArticle->text }}</div>
                        </td>

                        <td class="table-text">
                            <div>{{ $trashedArticle->users()->pluck('nickname')->implode(', ') }}</div>
                        </td>

                        <td class="table-text">
                            <button type="button" class="delete" data-toggle="modal" data-target="#myModal{{ $trashedArticle->id }}">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal{{ $trashedArticle->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Подтверждение</h4>
                                        </div>
                                        <div class="modal-body">
                                            Вы уверены?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                            <p></p>
                                            {{ Form::open(['route' => ['articles.restore', $trashedArticle->id]]) }}
                                            <button type="submit" class="btn btn-primary">Да</button>
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="table-text" colspan="4">
                            <div>Данные отсутствуют</div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection