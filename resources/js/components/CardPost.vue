<template>
    <div class="card">
        <img class="card-img-top" :src="post.image" :alt="post.title">
        <div class="card-body d-flex flex-column">
            <h4 class="card-title text-black">{{ post.title }}</h4>
            <p class="card-text text-black">{{ getExcerpt(post.content) }}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Pubblicato da: {{ post.user.name }}</li>
            <li class="list-group-item">Categoria: {{ post.category.name }}</li>
            <li class="list-group-item">Post creato il: {{ $luxon(post.created_at, "dd-MM-yyyy") }}</li>

            <li v-show="post.created_at != post.updated_at" class="list-group-item">Post modificato il: {{ $luxon(post.updated_at, "dd-MM-yyyy") }}</li>

        </ul>
        <div class="card-body d-flex">

            <router-link :to="{name: 'postShow', params: {slug: post.slug}}" class="btn btn-primary w-100 mt-auto">Visualizza post</router-link>

        </div>
    </div>
</template>

<script>
export default {
    name: 'CardPost',
    data() {
        return {
            excerptMaxLength: 70,
        }
    },
    props: {
        'post': Object,
        },
    methods: {
        getExcerpt(content) {
            if(content.length > this.excerptMaxLength) {
                return content.substring(0, this.excerptMaxLength) + '...';
            } else {
                return content;
            }

        }
    }
}
</script>

<style>

</style>
