<template>
    <div class="manager-sidebar">
        <a style="font-size:250%;
           padding-top:6px;
           background-color:#00ff9d;
           color:#000
           border:0"
           href="#"
        > .P
        </a>
        <router-link :to="{ name:'manager-dash' }">
            <i class="fas fa-home"></i>
        </router-link>
        <router-link :to="{ name:'manager-employees' }">
            <i class="fas fa-users"></i>
        </router-link>
        <a href="#"> <i class="fas fa-clock"></i> </a>
        <router-link :to="{ name:'manager-me-settings' }" >
            <i class="fas fa-cogs"></i>
        </router-link>
    </div>
</template>

<script>
export default {
    name: 'Sidebar',
    mounted () {
        this.resizeIcons()
        window.onresize = () => {
            this.resizeIcons()
        }
    },
    methods: {
        resizeIcons () {
            const icons = document.querySelectorAll('.manager-sidebar a')
            icons.forEach(function (icon) {
                icon.style.height = icon.offsetWidth + 'px'
            })
        }
    }
}
</script>

<style scoped>
.manager-sidebar {
    background-color: rgb(0, 0, 0);
    position: fixed;
    float: left;
    height: 100%;
    width:70px;
}
.manager-sidebar a {
    padding-top: 20px;
    text-align: center;
    justify-content: center;
    color: #ffffff;
    text-decoration: none;
    font-size: 140%;
    width: 100%;
    float:left;
    max-width: 100%;
}
.manager-sidebar a i {
    font-size: 200%;
    width: 100%;
    height: 100%;
    float:left;
    max-width: 100%;
}
.manager-sidebar a:hover {
    transition: 0.5s;
    text-decoration: none;
    color: #fff;
    background-color: rgb(68, 68, 68)
}
</style>
