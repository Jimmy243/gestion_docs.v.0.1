const vue = new Vue({
  el: '#app',
  data(){
    return {
      IdD: 0,
      tabDepartment: [],
      tabPersonnel: [],
    }
  },
  mounted(){
    this.reloadData();
    this.getPersonnel();
  },
  computed:{
    getPersonnelFilter(){
      if(this.IdD == 0) return this.tabPersonnel || []
      else return this.tabPersonnel.filter( element => element.IdD == this.IdD)
    }
  },
  methods:{
    getIdD(e){
      this.IdD = document.getElementById('IdD').value
      console.log(this.IdD);
    },
    reloadData() {
      $.ajax({
        type: "GET",
        url: "/department/get",
        dataType: "JSON",
        success: this.getData,
        error: function (req, err) {
          console.log("message: " + err);
        },
      }); 
    },
    getData(response) {
      if (response.error) console.log(data.error);
      else if (response.login) document.location.assign("/login");
      else if (response.auth) Swal.fire("Erreur de l'authentification!", response.auth, "error");
      else this.tabDepartment = response
    },
    getPersonnel() {
      $.ajax({
        type: "GET",
        url: "/personnel/get",
        contentType: "application/json",
        dataType: "JSON",
        success: this.getPersonnelResult,
        error: function (req, err) {
          console.log("message: " + err);
        },
      });
    },
    getPersonnelResult(response) {
      if (response.error) console.log(data.error);
      else if (response.login) document.location.assign("/login");
      else if (response.auth) Swal.fire("Erreur de l'authentification!", response.auth, "error");
      else this.tabPersonnel = response
      console.log(this.tabPersonnel);
    },
    valider(){
      const formData = new FormData(document.getElementById('setformf'))
      $.ajax({
        type: "POST",
        url: "/facture/set",
        data: formData,
        contentType : false,
        processData : false,
        success: this.validerResult,
        error: (req,err) => console.log(err)
      });
    },
    validerResult(response){ console.log(response)
      console.log(666);
      let error = ""
      if(response.error){
      if(!Array.isArray(response.error))
        error = response.error
      else error = response.error[0]
      Swal.fire("Erreur d'envoie !",error,"error");
      }else if(response.login){

      }else if(response.auth){

      }else{
        Swal.fire("Le facture a ete envoye avec succes !");
        document.getElementById('setformf').reset();
      }
    }
  }
})

