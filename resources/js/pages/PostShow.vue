<template>
    <main class="py-4 container text-white">

        <page-404 v-if="is404" />
        <div v-else-if="post">
            <h1>{{ post.title }}</h1>
            <b>Autore: {{ post.user.name }}<br>
                <span v-if="post.category"> Categoria: {{ post.category.name }}</span>
            </b>
            <div class="my-2">
                <span v-for="tag in post.tags" :key="tag.id" class="tag">{{ tag.name }}</span>
            </div>
            <div class="my-2">
                <span>Post creato il: {{ $luxon(post.created_at, "dd-MM-yyyy") }}</span><br>
                <span>Ultima modifica: {{ $luxon(post.updated_at, "dd-MM-yyyy") }}</span>
            </div>
            <div class="my-2">
                <img :src="post.image_url" :alt="post.title" class="img-fluid">
            </div>
            <div class="my-2">
                <p>{{ post.content }}</p>
            </div>

        </div>
        </main>

</template>

<script>
import Axios from 'axios';
import Page404 from './Page404.vue';

export default {
    name: 'PostShow',
    props: ['slug'],
    data() {
        return {
            is404: false,
            post: null,
            baseApiUrl: 'http://localhost:8000/api/v1/posts',
        }
    },
    created() {
        this.getData(this.baseApiUrl + '/'+ this.slug)
    },
    components: {
        Page404
    },
    methods: {
        getData(url) {
            if(url) {
                Axios.get(url)
                .then(res => {
                    if(res.data.success) {
                        this.post = res.data.response.data;
                    } else {
                        this.is404 = true;
                    }
                })
                .catch(error => {
                    console.log(error);
                });
            }
        }
    }

}
</script>

<style>
.tag {
    background-color:salmon;
    padding: .3rem .6rem;
    margin: .5rem;
    border-radius: .7rem;
}
</style>
