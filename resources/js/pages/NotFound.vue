<template>
    <div class="container">
        <h2 class="text-center my-5">PAGINA NON TROVATA, TORNA ALLA HOMEPAGE:</h2>
        <div class="text-center">
            <router-link class="nav-link" :to="{name:'home'}">Torna alla HOMEPAGE</router-link>
        </div> 
    </div>
</template>

<script>
export default {
    name:'NotFound',
}
</script>