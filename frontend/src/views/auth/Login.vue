<template>
    <div class="login full-height">
        <div class="row text-left full-height float-left full-width">
            <div class="login-left full-height col-md-6 float-left">
                <h1 style="text">
                    Bem-vindo ao
                    <br />Sistema .Ponto
                </h1>
                <hr>
                <h2 id="form-title">Faça seu login</h2>
                <hr>
                <form>
                    <div class="form-group">
                        <label for="email">Endereço de email</label>
                        <input type="email" class="form-control" id="email" />
                    </div>

                    <div class="form-group">
                        <label for="pass">Senha</label>
                        <input type="password" class="form-control" id="pass" />
                    </div>
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </form>
            </div>

            <div class="login-right p-5 col-md-6 float-left full-wifth">
                <img src="../../assets/img/office.svg" alt="IMG">
                <!-- <div class="form-group">
                    <label for="email">Endereço de email</label>
                    <input type="email" class="form-control" id="email">
                </div>

                <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" class="form-control" id="pass">
                </div>-->

                <!-- <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>-->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Login'
}
</script>

<style scoped>
#form-title {
    font-size: 140%;
}
.login-left {
    padding-left:10%;
    padding-right: 20%;
    padding-top: 10%;
}
.login-right img {
    margin-top: 10%;
    width: 70%;
}
.login-left {
    background-color:#2c2c2c;
}
.login-left {
    color:#00ff9d;
}
.login {
    border: blue 2px solid;
}
</style>
