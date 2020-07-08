<template>
    <div class="comment-form">
        <h4>Оставьте комментарий</h4>
        <form class="form-contact comment_form">
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
                                  placeholder="Текст комментария">
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" @submit.prevent="sendComment"
                        class="button button-contactForm"
                >
                    Отправить комментарий
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: 'test',
        methods: {
            sendComment: function () {
                console.log(1);
            }
        }
    }
</script>
