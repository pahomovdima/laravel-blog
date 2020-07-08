<div class="comment-form">
    <h4>Оставьте комментарий</h4>
    @include ('blog.posts.comments._result_messages')
    <form class="form-contact comment_form" method="post"
          action="{{ route('blog.comments.send') }}"
    >
        @csrf
        <div class="row">
            <div class="col-12">
                <p class="margin-bottom">
                    Ваш адрес email не будет опубликован. Обязательные поля помечены *
                </p>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <textarea class="form-control w-100" name="comment"
                              cols="30" rows="9"
                              placeholder="Текст комментария">{{ old('comment') }}</textarea>
                </div>
            </div>
            @if (!$userId)
                <div class="col-sm-6">
                    <div class="form-group">
                        <input class="form-control" name="name"
                               type="text" placeholder="Имя" value="{{ old('name') }}"
                        >
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input class="form-control" name="email"
                               type="email" placeholder="Email" value="{{ old('email') }}"
                        >
                    </div>
                </div>
            @endif
            <input type="hidden" name="post_id" value="{{ $item->id }}">
        </div>
        <div class="form-group">
            <button type="submit" class="button button-contactForm">Отправить комментарий</button>
        </div>
    </form>
</div>
