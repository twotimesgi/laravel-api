<template>
    <main class="py-4 container text-white">
        <div v-if="statusMessage" class="alert alert-success" role="alert">
            {{ statusMessage }}
        </div>
        <form @submit.prevent="sendMessage" action="api/v1/contact" method="post">
            <div class="form-group">

            <label for="name">Nome:</label>
            <input type="text" v-model="name" class="form-control" id="name" name="name" placeholder="Inserisci il nome">

            </div>
            <div class="form-group">

            <label for="email">Indirizzo e-mail</label>
            <input type="email" v-model="email" class="form-control" id="email" name="email" placeholder="Inserisci la mail">

            </div>
            <div class="form-group">

            <label for="message">Messaggio</label>
            <textarea class="form-control" id="message" name="message" v-model="message" rows="3"></textarea>

            </div>
            <button type="submit" class="btn btn-primary mt-3">Invia richiesta</button>
        </form>
  </main>
</template>

<script>
import Axios from 'axios'
export default {
    name: 'PageContact',
    data() {
        return {
            apiUrl: '/api/v1/contact',
            name: '',
            email: '',
            message: '',
            statusMessage: '',
        }
    },
    methods: {
        sendMessage() {
           Axios.post(this.apiUrl, {
                name: this.name,
                email: this.email,
                message: this.message,
            })
            .then(res => this.statusMessage = res.data.statusMessage)
        }
    }
}
</script>

<style>

</style>
