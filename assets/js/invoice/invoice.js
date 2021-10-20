const vue = new Vue({
  el: '#app',
  data(){
    return {
      tabInvoice: [],
      tabDoc: []
    }
  },
  mounted(){
    this.getInvoice();
  },
  methods: {
    getInvoice(){
      $.ajax({
        type: "GET",
        url: "/invoice/get",
        success: this.getInvoiceResult,
        error: function (req, err) {
          console.log("message: " + err);
        }
      });
    },
    getInvoiceResult(response){
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