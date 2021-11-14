const vue = new Vue({
  el: '#app',
  data(){
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
    this.getDocument();
  },
  methods:{
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
    }
  }
})