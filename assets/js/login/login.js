const vue = new Vue({
  el: '#app',
  data(){
    return {
      souvenez_vous: false,
      password: '',
      email: ''
    }
  },
  methods:{
    valider(){
      console.log(this.souvenez_vous);
      console.log(this.password);
      console.log(this.email);
    }
  }
})

