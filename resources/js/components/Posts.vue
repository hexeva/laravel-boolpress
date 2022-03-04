<template>
    <section>
        <div class="container">
            <h1>Tutti i Posts</h1>

            <div class="row row-cols-3">
                <!-- Single post card -->
                <div v-for="(post,index) in posts" :key="index" class="col">
                    <div class="card my-3">
                        <!-- <img src="..." class="card-img-top" alt="..."> -->
                        <div class="card-body">
                            <h5 class="card-title">{{post.title}}</h5>
                            <p class="card-text">{{contentLenght(post.content,50)}}</p>
                        </div>
                        <!-- <ul class="list-group list-group-flush">
                            <li class="list-group-item">An item</li>
                        </ul> -->
                        <div class="card-body">
                            <router-link class="card-link" :to="{name:'post_details',params :{slug: post.slug}}">Vai ai dettagli</router-link>
                        </div>
                    </div>
                </div>
                <!-- End Single post card -->
            </div>
            <!-- SEZIONE PAGINATION -->
            <nav>
                <ul class="pagination">
                    <!-- Previous link -->
                    <li  class="page-item" :class="{'disabled' : currentPage == 1}" >
                        <a @click="getPosts(currentPage - 1)" class="page-link" href="#">Previous</a>
                    </li>

                    <!-- Pages link -->
                    <!-- stampo i numeri delle pagine per quante sono in lastpage -->
                    <li v-for="element in lastPage" :key="element" class="page-item" :class="{ 'active': currentPage == element }">
                        <a @click="getPosts(element)" class="page-link" href="#">{{ element }}</a>
                    </li>


                    <!-- Next link -->
                    <li class="page-item" :class="{'disabled' : currentPage == lastPage}" >
                        <a @click="getPosts(currentPage + 1)" class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
</template>

<script>
export default {
    name: 'Posts',
    data: function() {
        return {
            posts: [],
            currentPage: 1,
            lastPage : false
            
        };
    },
    methods: {
        getPosts: function(pageNumber) {
            // Faremo la chiamata API per prenderci i post. Tra i params gli passo page (la prima pagina) che nel created lo considero di default come pagina 1
            axios.get('/api/posts',{
                params:{
                    page:pageNumber
                }
            }, {
                
            })
            .then((response) => {
                this.posts = response.data.results.data;
                this.currentPage = response.data.results.current_page;
                this.lastPage = response.data.results.last_page;

                
            });
        },
        // funzione per tagliare la lunghezza del testo
        contentLenght: function(text,lengthText){
            if(text.length > lengthText){
               return text.substr(0,lengthText) + '...'
            }else{
                return text;
            }
        },
        
    },
    created: function() {
        // nel created alla funzione getPosts gli passo anche come argomento la pagina 1 che è quella che voglio vedere di default al caricamento
        this.getPosts(1);
    }
}
</script>

