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
      console.log(JSON.stringify({email: this.email, password: this.password, souvenez_vous: this.souvenez_vous}));
      $.ajax({
        type: "POST",
        url: "/login/set",
        data: JSON.stringify({email: this.email, password: this.password, souvenez_vous: this.souvenez_vous}),
        dataType: "JSON",
        contentType: "application/json",
        success: this.validerresult,
        error: function(req, err){ console.log('message: ' + err); }
      });
    },
    validerresult(response){
      if(response.error){
        console.log(response.error);
      }else document.location.assign('/')
    }
  }
})

