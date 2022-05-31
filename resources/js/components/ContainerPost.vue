<template>
    <main class="py-4 container">
        <div class="mt-3 d-flex justify-content-between align-items-center">
            <h1 class="text-white">Posts</h1>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4">

            <div class="col mb-4 d-flex" v-for="post in posts" :key="post.id">
                <card-post :post="post"/>
            </div>

        </div>

        <div class="text-center mb-3 text-white">
            Pagina {{ nCurrentPage }} di {{ nLastPage }}
        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item" :class="{disabled: nCurrentPage == 1}" @click="getData(firstPageUrl)">
                <a class="page-link" tabindex="-1">Prima pagina</a>
                </li>
                <li class="page-item" :class="{disabled: !prevPageUrl}" @click="getData(prevPageUrl)">
                <a class="page-link" tabindex="-1">Precedente</a>
                </li>

                <li class="page-item">
                    <form @submit.prevent="getData(baseApiUrl + '/?page=' + nNewPage)">
                        <input class="form-control" type="text" placeholder="Pagina" v-model="nNewPage">
                    </form>
                </li>

                <!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li> -->
                <li class="page-item" :class="{disabled: !nextPageUrl}" @click="getData(nextPageUrl)">
                <a class="page-link">Prossima</a>
                </li>
                <li class="page-item" :class="{disabled: nCurrentPage == nLastPage}" @click="getData(lastPageUrl)">
                <a class="page-link">Ultima Pagina</a>
                </li>
            </ul>
        </nav>

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

            baseApiUrl: 'http://localhost:8000/api/posts',

            nNewPage: null,

            prevPageUrl: null,
            nextPageUrl: null,

            firstPageUrl: null,
            lastPageUrl: null,

            nCurrentPage: null,
            nLastPage: null,

            users: [],
        }
    },
    components: {
        CardPost
    },
    created() {
        this.getData(this.baseApiUrl)
        this.getUserName()
    },
    methods: {
        getUserName() {
            return Axios.get('http://localhost:8000/api/users/')
                .then(res => {
                    this.users = res.data.response;
                })
        },
        getData(url) {

            if(url) {
                Axios.get(url)
                    .then(res => {
                        this.posts = res.data.response.data;
                        this.prevPageUrl = res.data.response.prev_page_url;
                        this.nextPageUrl = res.data.response.next_page_url;

                        this.firstPageUrl = res.data.response.first_page_url;
                        this.lastPageUrl = res.data.response.last_page_url;

                        this.nCurrentPage = res.data.response.current_page;
                        this.nLastPage = res.data.response.last_page;


                        this.nNewPage = null;

                    })

                    .catch(error => {
                        console.log(error);
                    });
            }

        }
    }
}
</script>

<style scoped>
    .page-link {
        cursor: pointer;
    }
    .form-control {
        text-align: center;
        width: 100px;
    }
</style>
