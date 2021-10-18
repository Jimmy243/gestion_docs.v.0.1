const vue = new Vue({
  el: '#app',
  data(){
    return {
      personnel: '',
      tabDepartment: [],
      tabPronvinces: [
        "Bubanza",
        "Bujumbura",
        "Bujumbura Mairie",
        "Bururi",
        "Cankuzo",
        "Cibitoke",
        "Gitega",
        "Karuzi",
        "Kayanza",
        "Kirundo",
        "Makamba",
        "Muramvya",
        "Muyinga",
        "Mwaro",
        "Ngozi",
        "Rumonge",
        "Rutana",
        "Ruyigi",
      ],
      message_error: ''
    }
  },
  mounted(){
    this.getOnePersonnel()
    this.getDepartment()
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
      if (response.error) Swal.fire("Erreur de la recuperation de donnees de ce personnel!", error, "error");
      else if(response.login) document.location.assign("/login");
      else if(response.auth) Swal.fire("Erreur de l'authentification!", response.auth, "error");
      else {
        this.personnel = response;
        if(!this.personnel.NameD) this.personnel.IdD = 'selected'
      }
    },
    getDepartment() {
      $.ajax({
        type: "GET",
        url: "/department/get",
        dataType: "JSON",
        success: this.getDepartmentResult,
        error: function (req, err) {
          console.log("message: " + err);
        },
      });
    },
    getDepartmentResult(response) {
      if (response.error || response.auth) console.log(response);
      else if(response.login) document.location.assign("/login");
      else this.tabDepartment = response;
    },
    valider(){
      const formData = new FormData(document.getElementById('setformp'))
      // formData.forEach((value,key) => console.log(`${key} : ${value}`));
      $.ajax({
        type: "POST",
        url: `/personnel/edit/${this.personnel.Id}`,
        data: formData,
        contentType : false,
        processData : false,
        success: this.validerResult,
        error: function (req, err) {
          console.log("message: " + err);
        },
      }); 
    },
    validerResult(response){ 
      let error = ""
      if (response.error){
        if(!Array.isArray(response.error)) error = response.error
        else error = response.error[0]
        Swal.fire("Erreur de modification!", error, "error");
      }
      else if (response.login) document.location.assign("/login");
      else if (response.auth) Swal.fire("Erreur de l'authentification!", response.auth, "error");
      else if (response.message){
        this.getOnePersonnel()
        Swal.fire("Modification reussi!", response.message, "success");
      } 
    }
  }
})
