<template>
    <section>
        <div class="container">
            Io sono Il component Posts
        </div>
    </section>
</template>

<script>
export default {
    name: 'Posts',
    // data
    data: function(){
        return{
            posts:[]
        };
    },
    // end data

    // methods
    methods:{
        get_posts:function(){
            axios.get('/api/posts')
            .then((response) => {
                console.log(response);
                this.posts = response.data.results;
                
            });
        }
        
    },
    // end methods

    created:function(){
        this.get_posts();
    },
}

</script>

