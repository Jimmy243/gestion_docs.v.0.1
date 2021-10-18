const vue = new Vue({
  el: '#app',
  data(){
    return {
      personnel: ''
    }
  },
  mounted(){
    this.getPersonnel()
  },
  methods:{ 
    getPersonnel(){
      $.ajax({
        type: "GET",
        url: "/personnel/get/"+personelId,
        dataType: "json",
        contentType: "application/json",
        success: this.getPersonnelResult,
        error: function(req, err){ console.log('message: ' + err); }
      });
    },
    getPersonnelResult(response){ console.log(response);
      if(response.error) document.location.assign('/login')
      else if (response.login) document.location.assign('/login')
      else if (response.auth){

      }
      else this.personnel = response
    }
  }
})

