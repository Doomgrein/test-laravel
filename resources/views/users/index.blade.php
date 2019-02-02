@extends ('layouts.layout')

@section ('content')

    <div class="container">
        <div class="panel-body">
            <table class="table table-striped task-table" border="1">

                <!-- Заголовок таблицы -->
                <thead>
                <tr style="background: lightgoldenrodyellow">
                    <th>Пользователь</th>
                    <th>Имя пользователя</th>
                    <th>Телефон</th>
                    <th>Список статей пользователя</th>
                </tr>
                </thead>

                <!-- Тело таблицы -->
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <!-- Имя задачи -->
                        <td class="table-text">
                            <div>{{ $user->nickname }}</div>
                        </td>

                        <td class="table-text">
                            <div>{{ $user->first_name }}</div>
                        </td>

                        <td class="table-text">
                            <div>{{ $user->phone }}</div>
                        </td>

                        <td class="table-text">
                            <div>{{ $user->articles()->pluck('theme')->implode(', ') }}</div>
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
        <div class="panel-body">
            <div class="container">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="box-body col-md-6">
                            <div class="my-profile">
                                <h2 class="heading">Мой профиль</h2>
                                <div class="profile">
                                    <div class="avatar">
                                        <img src="images/{{ $user->avatar }}" alt="Аватар" class="avatar__pic">
                                    </div>
                                    <div class="information">
                                        <div class="nickname">{{ $user->nickname }}</div>
                                        <div class="user-name">
                                            <span class="name">{{ $user->first_name }}<br></span>
                                            <span class="surname">{{ $user->second_name }}</span>
                                        </div>
                                        <a href='tel:+11111111' class="phone">{{ $user->phone }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{ Form::open(['route' => 'users.store', 'files' => true]) }}
                        <div class="box-body col-md-6">
                            <div class='edit-profile'>
                                <h2 class="heading"> Создать новый профиль: </h2>
                                <form class='form' id='form' method='POST' enctype='multipart/form-data'>
                                    <ul class="form__list">
                                        <li class="form__item">
                                            <label class='form__label' for="nickname">Никнейм:</label>
                                            <input class='form__input' id='nickname' type="text" name="nickname">
                                        </li>
                                        <li class="form__item">
                                            <label class='form__label' for="name">Имя:</label>
                                            <input class='form__input' id='name' type="text" name="first_name">
                                        </li>
                                        <li class="form__item">
                                            <label class='form__label' for="surname">Фамилия:</label>
                                            <input class='form__input' id='surname' type="text" name="second_name">
                                        </li>
                                        <li class="form__item">
                                            <label class='form__label' for="avatar">Аватар:</label>
                                            <input class='form__input' id='avatar' type="file" name="avatar" value='@csrf'>
                                        </li>
                                        <li class="form__item">
                                            <label class='form__label' for="articles">Статьи:</label>
                                            @foreach ($articles as $article)
                                                <ul>
                                                    <li>
                                                        <input id="articles" type="checkbox" name="articles[]" value="{{ $article->id }}">
                                                        <label class=""> {{ ucfirst($article->theme) }}</label>
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </li>
                                        <li class="form__item">
                                            <label class='form__label' for="phone">Телефон:</label>
                                            <input class='form__input' id='phone' type="text" name="phone">
                                        </li>
                                        <li class="form__item">
                                            <div class="form__label"><b> Пол: </b></div>
                                            <label class='form__inline-label' for="male">Мужской</label>
                                            <input class='form__inline-input' name='sex' id='male' type="radio" value="male">
                                            <label class='form__inline-label' for="female">Женский</label>
                                            <input class='form__inline-input' name='sex' id='female' type="radio" value="female">
                                        </li>
                                        <li class="form__item">
                                            <label class='form__inline-label' for="showPhone">Я согласен получать email-рассылку:</label>
                                            <input class='form__inline-input' id='showPhone' type="checkbox" name="sendmail_status" value="active">
                                        </li>
                                        <li class="form__item">
                                            <button class='form__button' type="submit">Отправить</button>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection