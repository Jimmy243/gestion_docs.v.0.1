const vue = new Vue({
  el: "#app",
  data() {
    return {
      Fullname: "",
      Functions: "",
      DateB: "",
      Addresss: "",
      NumberM: "",
      States: 0,
      Gander: "Homme",
      Mobile: "",
      Email: "",
      IdD: "selected",
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
      message_error: [],
      password_login: "",
      email_login: "",
      isError: false,
      showAlert: false,
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
        dataType: "JSON",
        success: this.getPersonnelResult,
        error: function (req, err) {
          console.log("message: " + err);
        },
      });
    },
    getPersonnelResult(response) {
      if (response.error) {
        console.log(response.error);
      } else {
        this.tabPersonnel = response;
      }
    },
    setPersonnel() {
      const personnel = {
        Id:this.Id,
        Fullname: this.Fullname,
        Functions: this.Functions,
        DateB: this.DateB,
        Addresss: this.Addresss,
        States: this.tabPronvinces.find(
          (province, index) => index === this.States
        ),
        Gander: this.Gander,
        Mobile: this.Mobile,
        Email: this.Email,
        IdD: this.IdD === "selected" ? "" : this.IdD,
        NumberM: this.NumberM,
      };
      console.log(personnel);
      $.ajax({
        type: "POST",
        url: "/personnel/set",
        data: JSON.stringify(personnel),
        dataType: "JSON",
        contentType: "application/json",
        success: this.setPersonnelResult,
        error: function (req, err) {
          console.log("message: " + err);
        },
      });
    },
    setPersonnelResult(response) {
      this.message_error = [];
      if (response.error) {
        this.message_error = Array.isArray(response.error)
          ? response.error
          : [response.error];
        this.isError = true;
        $("#errorAlert").alert("show");
      } else if (response.login) document.location.assign("/login");
      else if (response.auth)
        Swal.fire("Erreur de l'authentification!", response.auth, "error");
      else{
        this.email_login = response.email;
        this.password_login = response.password;
        this.isError = false;
        this.getPersonnel();
        $("#successAlert").alert("show");
      }
      console.log(response);
      $("#ajoutPersonnel").modal("hide");
      this.showAlert = true;
    },
    closeAlert() {
      this.showAlert = false;
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
    
     // 
     deletePersonnel(id){
      Swal.fire({
        title: 'Es-tu sûr?',
        text: "Vous ne pourrez pas revenir en arrière!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, supprimez-le!'
      }).then((result) => this.isAccepts(result.isConfirmed,id))
    },
    isAccepts(result,id){
      if(!result) return 
      const pers = this.tabPersonnel.find( (element,index) => index === id)
      $.ajax({
        type: "POST",
        url: "/personnel/delete",
        data: JSON.stringify({Id:pers.Id}),
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
           'Votre fichier a été supprimé.',
           'success'
         )
        }
         console.log(response);
         this.reloadData()
       
    }

  },
});
