const vue = new Vue({
  el: '#app',
  mounted(){
    this.getOnePersonnel()

  },
  data(){
    return {
      personnel: ''
    }
  },
  methods: {
    getOnePersonnel(){
      $.ajax({
        type: "GET",
        url: "/personnel/get/"+idPersonnel,
        dataType: "json",
        contentType: "application/json",
        success: this.getOnePersonnelResult,
        error: function(req, err){ console.log('message: ' + err); }
      });
    },
    getOnePersonnelResult(response){
      console.log(response);
      if(response.error){

      }else {
        this.personnel = response
      }
    }
  }
})