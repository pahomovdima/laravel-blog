@php /** \App\Models\BlogCategory $item */ @endphp

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">
                            Основные данные
                        </a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input name="name" value="{{ old('name', $item->name) }}"
                                   id="name"
                                   type="text"
                                   class="form-control"
                                   minlength="3"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" value="{{ old('email', $item->email) }}"
                                   id="email"
                                   type="text"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input name="password"
                                   id="password"
                                   type="password"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Подтверждение пароля</label>
                            <input name="password_confirmation"
                                   id="password_confirmation"
                                   type="password"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="parent_id">Группа</label>
                            <select name="group_id" value="{{ old('group_id', $item->group_id) }}"
                                   id="group_id"
                                   class="form-control"
                                   placeholder="Выберите группу"
                                   required>
                                @foreach ($userGroupList[0] as $userGroupOption)
                                    <option value="{{ $userGroupOption->id }}"
                                            @if ($userGroupOption->id == $item->group_id) selected @endif>
                                        {{ $userGroupOption->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
