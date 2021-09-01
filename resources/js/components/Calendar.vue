<template>
  <div class="container mt-5">
    <div class="row">
      <div>
        <h2 class="mb-3 text-center">To Do Calendar</h2>
        <date-picker v-model="date" :config="options"></date-picker>
      </div>
    </div>
  </div>
</template>
 
<script>
  import datePicker from 'vue-bootstrap-datetimepicker';
  import 'bootstrap/dist/css/bootstrap.css';
  import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';

  
  export default {    
    data () {
      return {
        date: new Date(),
        options: {
            format: 'DD/MM/YYYY',
            useCurrent: false       
        }
      }
    },
    components: {
      datePicker
    }
  }
</script>