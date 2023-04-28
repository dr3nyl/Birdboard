<template>
  <div>
    <div class="card mb-4">
      <create-new-task :project="project.id" @task-created="fetchTasks"></create-new-task>
    </div>
    <task-list
        v-for="task in tasks"
        :key="task.id"
        :id="task.id"
        :body="task.body"
        :completed="task.completed"
        :project="project.id"
        @task-created="fetchTasks"
        >
    </task-list>
  </div>
</template>

<script>
import axios from 'axios';

export default {

    mounted() {
        this.fetchTasks();
    },

    props: {
        project: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            tasks: []
        }
    },

    methods: {
        fetchTasks() {
            axios.get('/api/tasks/' + this.project.id)
                .then(response => {
                    this.tasks = response.data.data
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}

</script>