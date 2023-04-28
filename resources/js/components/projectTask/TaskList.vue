<template>
    <div class="card mb-3">
        <form @submit.prevent="submit" >
            <div class="flex">
                <input 
                    type="text" 
                    :class="completed ? 'bg-card w-full text-gray-400 line-through' : 'bg-card w-full text-default' " 
                    v-model="body">
                <input type="checkbox" v-model="completed" @change="onChange()" >
            </div>
        </form>
    </div>
</template>

<script>
export default {

    props: ['id', 'body', 'completed', 'project'],

    methods: { 
        onChange() {
            
            axios.patch('/projects/' + this.project + '/tasks/' + this.id, 
                { body: this.body,
                  completed: this.completed },
                  
                {
                    headers: {
                        'Content-Type': 'application/json', // set the content type header
                    }
                })
                .then(response => {
                    console.log(response)
                    this.$emit('task-created')
                })
                .catch(error => {
                    console.log(error)
                })
        }
    },
}
</script>