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
                            <label for="title">Заголовок</label>
                            <input name="title" value="{{ old('title', $item->title) }}"
                                   id="title"
                                   type="text"
                                   class="form-control"
                                   minlength="3"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="slug">Идентификатор</label>
                            <input name="slug" value="{{ old('slug', $item->slug) }}"
                                   id="slug"
                                   type="text"
                                   class="form-control">
                        </div>

                        @if (!$item->isRoot())
                            <div class="form-group">
                                <label for="parent_id">Родитель</label>
                                <select name="parent_id" value="{{ old('parent_id', $item->parent_id) }}"
                                       id="parent_id"
                                       class="form-control"
                                       placeholder="Выберите категорию"
                                       required>
                                    @include('blog.admin.categories.includes._categories')
                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea name="description" value="{{ $item->description }}"
                                   id="description"
                                   class="form-control"
                                   rows="3">{{ old('description', $item->description) }}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
