<template>
    <div class="topbar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">.Ponto web</a>
            <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">Sistema .Ponto</span>
            </button> -->
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto">
                    <!-- <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li> -->
                </ul>
                <ul class="navbar-nav justify-content-end">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" href="#">Active</a>
                    </li> -->
                    <li class="nav-item dropdown dropleft justify-content-end">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            William
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" v-on:click="logout()" href="#">Logout</a>
                            <!-- <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a> -->
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
import AuthService from '../../services/AuthService'

export default {
    name: 'Topbar',
    data () {
        return {
            username: localStorage.getItem('access_token')
        }
    },
    methods: {
        logout () {
            AuthService.logout()
            this.$router.push({ name: 'login' })
        }
    }
}
</script>

<style>
.topbar {
    border-bottom: rgb(0, 0, 0) 2px solid;
    height: 70px;
    padding-left: 70px;
    position: fixed;
    float: left;
    width: 100%;
}
.topbar .navbar {
    height: 100%;
    float: left;
    width: 100%;
}
</style>
