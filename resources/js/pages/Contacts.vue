<template>
    <div class="container">
        <h1>Contact us</h1>
        <h3 v-if="success">Email inviata correttamente. Grazie per averci contattato</h3>

        <form>
             <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input v-model="email" type="email" class="form-control" id="email">
            </div>
            <!-- error -->
            <div v-if="errors.email">
                 <p v-for="(error, index) in errors.email" :key="index">{{ error }}</p>
            </div>
            <!-- end error -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input v-model="name" type="text" class="form-control" id="name">
            </div>
            <!-- error -->
            <div v-if="errors.name">
                <p v-for="(error, index) in errors.name" :key="index">{{ error }}</p>
             </div>
            <!-- end error -->
            <textarea v-model="message" class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
            <!-- error -->
            <div v-if="errors.message">
                <p v-for="(error, index) in errors.message" :key="index">{{ error }}</p>
            </div>
            <!-- end error -->
            <!-- click.prevent lo utilizzo per evitare di refreshare la pagina -->
            <button @click.prevent="sendMessage()" type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</template>

<script>
export default {
    name:'Contacts',
    data:function(){
        return {
            email: '',
            name: '',
            message: '',
            success: false,
            errors: {}
            
        }
    },
    // methods
    methods:{
        sendMessage: function() {
            axios.post('/api/leads/store', {
                // con il metodo post NON dobbiamo passare i dati con params 
                email: this.email,
                name: this.name,
                message: this.message
            })
            .then((response) => {
                console.log(response);
                if(response.data.success) {
                    // Se Tutto ok
                    this.name = '';
                    this.email = '';
                    this.message = '';
                    this.success = true;
                    this.errors = {};
                } else {
                    // Ci sono errori di validazione
                    this.success = false;
                    this.errors = response.data.errors;
                }
            });
        }
    }
}
</script>