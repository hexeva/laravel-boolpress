<template>
    <header>
        <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
            <div class="container-fluid">
                <span class="navbar-brand">Boolpress</span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li v-for="(link,index) in navLinks" :key="index" class="nav-item">
                            <router-link class="nav-link" :to="{name:link.name}">{{link.label}}</router-link>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>  
    </header>
</template>

<script>
export default {
    name:'Header',
    data:function(){
        return {
            navLinks : [
                {
                    name:'home',
                    label:'Home'
                },
                 {
                    name:'about',
                    label:'About'
                },
                {
                    name:'blog',
                    label:'Blog'
                },
                {
                    name:'contacts',
                    label:'Contacts'
                },
            ],
        };
    },
}
</script>