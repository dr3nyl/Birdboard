<template>
    <form @submit.prevent="submit">
        <input type="text" class="bg-card w-full text-default" v-model="body" @keyup.enter="createTask" placeholder="Add new task..">
    </form>
</template>

<script>

export default {

    props: ['project'],

    data() {
        return {
            body: ''
        }
    },

    methods: {
        createTask() {
            axios.post('/projects/' + this.project + '/tasks/', { body: this.body })
            .then(response => {
                this.body = ''
                this.$emit('task-created')
            })
            .catch(error => {
                console.log(error)
            })
      }
    },


}
</script>