<template>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">

        <div class="container-fluid">
            <router-link class="navbar-brand" :to="{ name:'home' }">Boolpress</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon hamb"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <router-link class="nav-link active" aria-current="page" :to="{ name:'postIndex' }">Visualizza tutti i post</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link active" aria-current="page" :to="{ name:'about' }">Chi siamo</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link active" aria-current="page" :to="{ name:'contact' }">Contact</router-link>
                    </li>

                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page"  href="http://127.0.0.1:8000/login">Accedi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page"  href="http://127.0.0.1:8000/register">Registrati</a>

                    </li>

                </ul>
            </div>
        </div>
    </nav>

</template>

<script>
export default {
    name: 'HeaderPost',
}
</script>

<style>

</style>

