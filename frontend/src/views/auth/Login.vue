<template>
    <div>
        <form class="login">
            <div class="row p-5 text-left full-width float-left">
                <div class="login-left col-md-6">
                    <h1 style="text">
                        Bem-vindo ao
                        <br />Sistema Ponto
                    </h1>
                    <form>
                        <div class="form-group">
                            <label for="email">Endereço de email</label>
                            <input type="email" class="form-control" id="email" />
                        </div>

                        <div class="form-group">
                            <label for="pass">Password</label>
                            <input type="password" class="form-control" id="pass" />
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </form>
                </div>

                <div class="login-right col-md-6 mt-5">
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
        </form>
    </div>
</template>

<script>
export default {
    name: 'Login'
}
</script>

<style scoped>
</style>>
