<template>
    <div class="container">
        <div class="card my-5">
            <h5 class="card-header">Details</h5>
            <div class="card-body">
                <h3 class="card-title">{{post.title}}</h3>
                <div v-if="post.category">
                    <h5 class="card-title"> Category: {{post.category.name}}</h5>
                </div>
                <p class="card-text">{{post.content}}</p>
                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'PostDetails',
    // data
    data:function(){
        return {
            post: false,

        }
    },
    // end data
    // methods
    methods:{
        getPost() {
            axios.get('/api/posts/' + this.$route.params.slug)
            .then((response) => {
            // se trova il post con quello slug allora lo stampo  verificando se success è true  
            if(response.data.success){
                this.post = response.data.results;

            }else{
                // altrimenti reindirizzo l'utente alla pagina errore
                this.$router.push({name:'not-found'});
            }       
                
            });
        },
    },
    // end methods
    created:function(){
        this.getPost();
    }
}
</script>

<style lang="scss" scoped>
   
</style>