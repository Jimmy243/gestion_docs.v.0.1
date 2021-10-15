const vue = new Vue({
    el: '#app',
    data(){
      return {
        tabPersonnel: ''
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
          this.tabPersonnel = response;
          if(!this.tabPersonnel.NameD) this.tabPersonnel.IdD = 'selected'
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
     
     
    }
  })
  