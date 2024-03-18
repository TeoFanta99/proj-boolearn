<script>
import axios from 'axios';
export default {
    name: "Home",
    data(){
        return{
            teachers:[],
        }
    },
    mounted(){
        axios.get("http://127.0.0.1:8000/api/v1/teachers")
  .then((res) => {
    const data = res.data;
    console.log(data);
    if (data.status === "success") {
      this.teachers = data.teachers; // Utilizza 'teachers' anziché 'tags'
    }
  })
  .catch((err) => {
    console.log(err);
  });
    }
}
</script>

<template>

    <div v-for="teacher in teachers" :key="teacher.id">
        <span>{{ teacher.name }}</span>
    </div>
</template>
