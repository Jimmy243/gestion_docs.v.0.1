const vue = new Vue({
  el: "#app",
  data() {
    return {
      tabDepartment: [],
      tabPersonnel: [],
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
    };
  },
  mounted() { 
    this.getPersonnel();
  },
  methods: {
    getPersonnel() {
      $.ajax({
        type: "GET",
        url: "/personnel/get",
        contentType: "application/json",
        success: this.getPersonnelResult,
        error: function (req, err) {
          console.log("message: " + err);
        },
      });
    },
    getPersonnelResult(response) { console.log(response);
      if (response.error) {
        console.log(response.error);
      } else {
        this.tabPersonnel = response;
      }
    },
    setPersonnel() { 
      const formData = new FormData(document.getElementById('setformp'))
      $.ajax({
        type: "POST",
        url: "/personnel/set",
        data: formData,
        contentType : false,
        processData : false,
        success: this.setPersonnelResult,
        error: function (req, err) {
          console.log("message: " + err);
        },
      });
    },
    setPersonnelResult(response) { 
      let error = ""
      if (response.error) {
        if(!Array.isArray(response.error)) error = response.error
        else error = response.error[0]
        Swal.fire("Erreur d'enregistrement!", error, "error");
      } else if (response.login) document.location.assign("/login");
      else if (response.auth)
        Swal.fire("Erreur de l'authentification!", response.auth, "error");
      else{ 
        Swal.fire("Enregistrement reussi!",`Les informations de connexion: <br>email: <span style="font-weight: bold;">${response.email}</span><br>password: <span style="font-weight: bold;">${response.password}</span>`, "success");
        this.getPersonnel();
        document.getElementById('setformp').reset()
      }
      $("#ajoutPersonnel").modal("hide");
    },
    getDepartment() {
      $.ajax({
        type: "GET",
        url: "/department/get",
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
    
    getDepartmentResult(response) {
      if (response.error || response.auth) console.log(response);
      else if(response.login) document.location.assign("/login");
      else this.tabDepartment = response;
    },
  
    deletePersonnel(id){
      Swal.fire({
        title: 'Es-tu sûr?',
        text: "Vous voulez vraiment supprimer ce personnel!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, supprimez-le!'
      }).then((result) => this.isAccepts(result.isConfirmed,id))
    },
    isAccepts(result,id){
      if(!result) return 
      $.ajax({
        type: "POST",
        url: `/personnel/delete/${id}`,
        data: JSON.stringify({Id:id}),
        contentType: 'application/json',
        dataType: "JSON",
        success: this.deletePersonnelResult,
        error: function(req, err){ console.log('message: ' + err) }
      });
    },
    deletePersonnelResult(response){
        if(response.error){
 
        }else{
         Swal.fire(
           'Supprimé!',
           'Le personnel a été supprimé.',
           'success'
         )
         this.getPersonnel()
        }
         console.log(response);
        
       
    }

  },

});
