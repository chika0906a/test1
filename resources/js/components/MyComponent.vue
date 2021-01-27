<template>
    <div class="container">
      <p>{{msg}}</p>
      <hr>
      <ul>
          <li v-for="(generaluser,key) in generalusers">
            {{generaluser.name}}: {{generaluser.email}}
                [{{generaluser.gender}}] [{{generaluser.birthday}}]
          </li>
      </ul>
    </div>
</template>

<script>
const axios = require('axios');
export default {
  mounted () {
    axios.get('/hello/json')
         .then(response => {
              this.generalusers = response.data;
              this.msg = 'get data!';
         });
  },
  data:function(){
    return {
      msg:'wait...',
      name:'',
      generalusers:[],
    };
  },
  methods:{
    doAction:function(){
      this.msg='Hello, ' + this.name + '!!';
    }
  }
}
</script>