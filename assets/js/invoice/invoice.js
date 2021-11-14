const vue = new Vue({
  el: '#app',
  data(){
    return {
      tabInvoice: [],
      tabDoc: [],
      next: 0,
      back: 0,
      currentNext: 0,
      currentBack: 0,
      tri: {
        by: "name_p",
        order: 'asc',
      },
      by: 'name_p'
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
        this.currentNext = this.next
        this.currentBack = this.back
        this.next = response.pagination.next || 0
        this.back = response.pagination.back || 0
        this.getTri()
      }
    },
    getInvoiceByPagination(pagination){
      if(pagination){
        let pagObj = {};
        if(pagination === 'next' && this.next != 0)
        {
          pagObj = {next: this.next}
        } else if(pagination === 'back' && this.back != 0){
          pagObj = { back: this.back }
        } else return this.getInvoice()
        $.ajax({
          type: "POST",
          url: "/invoice/get",
          data: JSON.stringify(pagObj),
          contentType: "application/json",
          success: this.getInvoiceResult,
          error: function (req, err) {
            console.log("message: " + err);
          }
        });

      }else  return this.getInvoice()
    },
    getTri(){
      if(this.by === this.tri.by) this.tri.order = this.tri.order === 'asc'?'desc':'asc'
      else this.tri = { by: this.by, order: 'asc' }
      this.tabInvoice.sort( (a,b) => {
      if(this.tri.by === 'name_p'){
        return this.tri.order === 'asc'? a.Fullname.localeCompare(b.Fullname):b.Fullname.localeCompare(a.Fullname)
       }else if(this.tri.by === 'depart'){
        return this.tri.order === 'asc'? a.NameD.localeCompare(b.NameD):b.NameD.localeCompare(a.NameD)
       }else if(this.tri.by === 'montant'){
        return this.tri.order === 'asc'? a.MontantF-b.MontantF:b.MontantF-a.MontantF
       }else if(this.tri.by === 'date_d'){
        return this.tri.order === 'asc'? a.DateEnreg.localeCompare(b.DateEnreg):b.DateEnreg.localeCompare(a.DateEnreg)
       }
      //  else if(this.tri.by === 'date_t'){
      //   return this.tri.order === 'asc'? a.DateT.localeCompare(b.DateT):b.DateT.localeCompare(a.DateT)
      //  }
      })
    },
    getIcon(tri){
      tri = tri || 'name_p'
      if(tri === this.tri.by){
        return this.tri.order === 'desc'?'↓':"↑"
      }else return ""
    }
  }
})