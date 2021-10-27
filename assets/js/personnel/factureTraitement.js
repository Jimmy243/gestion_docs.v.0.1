const vue = new Vue({
  el: "#app",
  data() {
    return {
      tabFacture: {
        treated: [],
        notTreated: [],
      },
      facture: "",
      Motif: "",
    }
  },
  mounted() {
    this.getFacture();
  },
  methods: {
    getFacture() {
      $.ajax({
        type: "GET",
        url: "/factures_traitement/get",
        contentType: "application/json",
        success: this.getFactureResult,
        error: function (req, err) {
          console.log("message: " + err);
        },
      });
    },
    getFactureResult(response) {
      if (response.error) {
        console.log(response.error)
      } else {
        this.tabFacture.treated = response.invoice.treated;
        this.tabFacture.notTreated = response.invoice.notTreated;
      }
    },
    setTraitement(id) { $('#tab1').tab('show')
      this.facture = this.tabFacture.notTreated.find(
        (element) => element.IdF == id
      );
    },
    //    setFacture_traitee

    setFactureTrait(IdF) {
      const facture_traitee = {
        IdF: IdF,
        Motif: this.Motif,
      };

      $.ajax({
        type: "POST",
        url: "/traitement_facture/set",
        data: JSON.stringify(facture_traitee),
        contentType: "application/json",
        success: this.setFactureTraitResult,
        error: function (req, err) {
          console.log("message: " + err);
        },
      });
    },
    setFactureTraitResult(response) { console.log(response);
      if (response.error)
        Swal.fire("Erreur de traitement!", response.error, "error");
      else if (response.login) document.location.assign("/login");
      else if (response.auth)
        Swal.fire("Erreur de l'authentification!", response.auth, "error");
      else if (response.message) {
        Swal.fire("Traitement reussi!", response.message, "succèss");
        this.getFacture()
        $('#tab2').tab('show')
        this.Motif = ""
        this.facture = ''
      }
    },
  },
});
