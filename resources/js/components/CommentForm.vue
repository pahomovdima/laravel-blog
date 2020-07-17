<template>
    <div class="comment-form">
        <h4>Оставьте комментарий</h4>
        <form @submit.prevent="sendComment"
              class="form-contact comment_form"
        >
            <input type="hidden" name="_token"
                   v-model="fields._token" value="csrf">
            <div class="row">
                <div class="col-12">
                    <p class="margin-bottom">
                        Ваш адрес email не будет опубликован. Обязательные поля помечены *
                    </p>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <textarea class="form-control w-100" name="comment"
                                  v-model="fields.comment"
                                  cols="30" rows="9"
                                  placeholder="Текст комментария">
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="button button-contactForm">
                    Отправить комментарий
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['csrf'],
        data() {
            return {
                fields: {}
            }
        },
        /*mounted() {
            axios.get('/api/user').then(res => {
                console.log(res);
            }).catch(error => {
                console.log(error);
            })
        },*/
        methods: {
            sendComment: function () {
                axios.post('/api/comment', this.fields).then(response => {
                    this.fields = {};
                }).catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>
