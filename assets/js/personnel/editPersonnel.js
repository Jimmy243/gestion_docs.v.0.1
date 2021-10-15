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
    getOnePersonnelResult(response){ console.log(response);
      if (response.error || response.auth) this.message_error = response.error
      else if(response.login) document.location.assign("/login");
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
    valider(){ console.log(JSON.stringify(this.personnel));
      $.ajax({
        type: "POST",
        url: `/personnel/edit/${this.personnel.Id}`,
        data: JSON.stringify(this.personnel),
        dataType: "JSON",
        contentType: "application/json",
        success: this.validerResult,
        error: function (req, err) {
          console.log("message: " + err);
        },
      }); 
    },
    validerResult(response){ console.log(response);
      if (response.error) Swal.fire("Erreur de modification!", response.error, "error");
      else if (response.login) document.location.assign("/login");
      else if (response.auth) Swal.fire("Erreur de l'authentification!", response.auth, "error");
      else if (response.message) Swal.fire("Modification reussi!", response.message, "success");
    }
  }
})
