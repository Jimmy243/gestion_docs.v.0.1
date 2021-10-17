const vue = new Vue({
  el: "#app",
  data() {
    return {
      tabDepartment: [],
      setNameD: "",
      editNameD: "",
      editIdD: 0,
    };
  },
  computed: {},
  mounted() {
    this.reloadData();
  },
  methods: {
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
    setDepartment() {
      $.ajax({
        type: "POST",
        url: "/department/set",
        data: JSON.stringify({ NameD: this.setNameD }),
        contentType: "application/json",
        dataType: "JSON",
        success: this.setDepartmentResult,
        error: function (req, err) {
          console.log("message: " + err);
        },
      });
    },
    setDepartmentResult(response) {
      $("#ajoutDepart").modal("hide");
      if (response.error) Swal.fire("Erreur d'ajout!", response.error, "error");
      else if (response.login) document.location.assign("/login");
      else if (response.auth) Swal.fire("Erreur de l'authentification!", response.auth, "error");
      else if (response.message) Swal.fire("Ajout reussi!", response.message, "success");
      this.reloadData();
    },
    editDepartment() {
      if (!this.editNameD || !this.editIdD) return;
      $.ajax({
        type: "POST",
        url: "/department/edit",
        data: JSON.stringify({ NameD: this.editNameD, IdD: this.editIdD }),
        contentType: "application/json",
        dataType: "JSON",
        success: this.editDepartmentResult,
        error: function (req, err) {
          console.log("message: " + err);
        },
      });
    },
    editDepartmentResult(response) { 
      $("#editDepart").modal("hide");
      if (response.error) Swal.fire("Erreur de modification!", response.error, "error");
      else if (response.login) document.location.assign("/login");
      else if (response.auth) Swal.fire("Erreur de l'authentification!", response.auth, "error");
      else if (response.message) Swal.fire("Modification reussi!", response.message, "success");
      this.reloadData();
    },
    getIdBForEdeting(id) { 
      const depart = this.tabDepartment.find((element, index) => index === id);
      this.editNameD = depart && depart.NameD;
      this.editIdD = depart && depart.IdD;
    },
    deleteDepartment(id) {
      Swal.fire({
        title: "Voulez-vous vraiment supprimer ce departement?",
        text: "Vous pouvez annuler si vous avez clique par erreur!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Oui, supprime-le!",
        cancelButtonText: "Annuler",
      }).then((result) => this.isAccepts(result.isConfirmed, id));
    },
    isAccepts(result, id) {
      if (!result) return;
      const depart = this.tabDepartment.find((element, index) => index === id);
      $.ajax({
        type: "POST",
        url: "/department/delete",
        data: JSON.stringify({ IdD: depart.IdD }),
        contentType: "application/json",
        dataType: "JSON",
        success: this.deleteDepartmentResult,
        error: function (req, err) {
          console.log("message: " + err);
        },
      });
    },
    deleteDepartmentResult(response) {
      if (response.error) Swal.fire("Erreur de suppression!", response.error, "error");
      else if (response.login) document.location.assign("/login");
      else if (response.auth) Swal.fire("Erreur de l'authentification!", response.auth, "error");
      else if (response.message) Swal.fire("Suppression reussi!", response.message, "success");
      this.reloadData();
    },
  },
});
