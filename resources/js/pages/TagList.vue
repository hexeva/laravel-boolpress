<template>
    <div class="container">
        <h1 class="text-center">Related Tags</h1>
        <div class="my-5">
            <h2>Tag: {{tag.name}}</h2>
        </div>
        <h2 class="text-center">Related Posts:</h2>
        <div>
            <ul class="list-group">
                <li>
                    <router-link v-for="post in tag.posts" :key="post.id" 
                    class="list-group-item list-group-item-action list-group-item-success" :to="{ name: 'post_details', params: { slug: post.slug } }">{{post.title}}</router-link>   
                </li>
            </ul>
        </div>

    </div>
</template>

<script>
export default {
    name:'TagList',
    data:function(){
        return {
            tag: false,
        }
    },
    methods:{
        getTags(){
            axios.get('/api/tags/' + this.$route.params.slug)
            .then((response) => {
                this.tag = response.data.results;
            });
        }
    },
    // end methods
    created:function(){
        this.getTags();
    }
}
</script>