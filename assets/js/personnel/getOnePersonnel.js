const vue = new Vue({
    el: '#app',
    data(){
      return {
        personnel: '',
        tabDepartment: [],
        tabInvoice: [],
        tabDoc: []
      }
    },
    computed: {
      getInfoUser(){
        if(this.personnel.Gander == "Homme") return `Monsieur ${this.personnel.Fullname}`
        else if (this.personnel.Gander == "Femme") return `Madame ${this.personnel.Fullname}`
        else return this.personnel.Fullname
      },
      getInvoiceFilter(){
        return this.tabInvoice.map( element => {
          if(!element.Pourcentage) element.Pourcentage = 0
          return element
        })
      }
    },
    mounted(){
      this.getOnePersonnel()
      this.getDepartment()
      this.getPerformance()
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
      getPerformance(){
        $.ajax({
          type: "GET",
          url: "/invoice/get/"+idPersonnel,
          success: this.getPerformanceResult,
          error: function (req, err) {
            console.log("message: " + err);
          }
        });
      },
      getPerformanceResult(response){ console.log(response);
        if (response.error) Swal.fire("Erreur de recuperation de donnees", error, "error");
        else if(response.login) document.location.assign("/login");
        else if(response.auth) Swal.fire("Erreur de l'authentification!", response.auth, "error");
        else {
          this.tabInvoice = response.invoice
          this.tabDoc = response.doc
        }
      }
     
    }
  })
  