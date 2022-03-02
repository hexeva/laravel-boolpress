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
                        <!-- <div class="card-body">
                            <a href="#" class="card-link">Card link</a>
                        </div> -->
                    </div>
                </div>
                <!-- End Single post card -->
            </div>

            <nav>
                <ul class="pagination">
                    <!-- Previous link -->
                    <li class="page-item" >
                        <a class="page-link" href="#">Previous</a>
                    </li>

                    <!-- Pages link -->
                    <li >
                        <a class="page-link" href="#"></a>
                    </li>

                    <!-- Next link -->
                    <li class="page-item" >
                        <a class="page-link" href="#">Next</a>
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
            
        };
    },
    methods: {
        getPosts: function() {
            // Faremo la chiamata API per prenderci i post
            axios.get('/api/posts', {
                
            })
            .then((response) => {
                this.posts = response.data.results;
                
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
        this.getPosts();
    }
}
</script>

