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
                        <td class="table-text" colspan="4">
                            <div>Данные отсутствуют</div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>

        {{ Form::open(['route' => 'articles.store', 'class' => 'form']) }}
        <div class="row">
            <div class="panel panel-default">
                <div class="box-body">
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
        {{ Form::close() }}
    </div>

@endsection