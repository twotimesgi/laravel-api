<template>
    <main class="py-4 container text-white">
        <div class="mt-3 d-flex justify-content-between align-items-center">
            <h1 class="text-white">4 Post random</h1>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4">

            <div class="col mb-4 d-flex" v-for="post in posts" :key="post.id">
                <card-post :post="post"/>
            </div>

        </div>

    </main>
</template>

<script>
import Axios from 'axios';
import CardPost from '../components/CardPost.vue';

export default {
    name: 'ContainerPost',
    data() {
        return {
            posts: [],

            baseApiUrl: 'http://localhost:8000/api/v1/posts?home',

        }
    },
    components: {
        CardPost
    },
    created() {
        this.getData(this.baseApiUrl)
    },
    methods: {
        getData(url) {

            if(url) {
                Axios.get(url)
                    .then(res => {
                        this.posts = res.data.response.data;
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
</style>
