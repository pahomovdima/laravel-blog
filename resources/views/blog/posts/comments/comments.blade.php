<div class="comments-area">
    <h4>{{ count($comments) }} Комментариев</h4>

    @foreach ($comments as $comment)
    <div class="comment-list">
        <div class="single-comment justify-content-between d-flex">
            <div class="user justify-content-between d-flex">
                <div class="desc">
                    <p class="comment">
                        {{ $comment->comment }}
                    </p>

                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <h5>
                                <a href="#">{{ $comment->name }}</a>
                            </h5>
                            <span class="date">
                                {{ \Carbon\Carbon::parse($comment->created_at)->format('d M Y H:i') }}
                            </span>
                        </div>

                        <div class="reply-btn">
                            <a href="#" class="btn-reply text-uppercase">ответить</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
