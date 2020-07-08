@php /** \App\Models\BlogCategory $item */ @endphp

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if($item->is_published)
                    Опубликовано
                @else
                    Не опубликовано
                @endif
            </div>
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
                            <label for="comment">Текст комментария</label>
                            <textarea name="comment" value="{{ $item->comment }}"
                                      id="comment"
                                      class="form-control"
                                      rows="6">{{ old('comment', $item->comment) }}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input name="name" value="{{ $item->name }}"
                                   id="name"
                                   type="text"
                                   class="form-control"
                                   minlength="3"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" value="{{ $item->email }}"
                                   id="email"
                                   type="text"
                                   class="form-control">
                        </div>
                        <div class="form-check">
                            <input name="is_published"
                                   type="hidden"
                                   value="0">

                            <input name="is_published"
                                   type="checkbox"
                                   class="form-check-input"
                                   value="1"
                                   @if($item->is_published)
                                   checked="checked"
                                @endif
                            >
                            <label class="form-check-label" for="is_published">Опубликованно</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
