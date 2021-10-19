const vue = new Vue({
    el:"#app",
    data(){
        return {
            tabFacture:[],
            facture:"",
            IdF:"",
            Motif:"",
        }
    },
    mounted(){
     this.getFacture()
    },
    methods:{
        getFacture(){
            $.ajax({
                type: "GET",
                url: "/factures_traitement/get",
                contentType: "application/json", 
                // dataType: "JSON",
                success: this.getFactureResult,
                error: function(req, err){ console.log('message: ' + err); }
            });

        },
        getFactureResult(response){ 
            //    console.log(response);
            if (response.error) {
                console.log(response.error);
              } else {
                console.log(response);  
                this.tabFacture = response;
              }
        },
        setTraitement(id){
            this.facture = this.tabFacture.find(element=>element.IdF==id)   
        },
    //    setFacture_traitee

    setFactureTrait(IdF) {
        const facture_traitee = {
          IdF:this.IdF,
          Motif: this.Motif,
        };
        // console.log(facture_traitee);
        $.ajax({
          type: "POST",
          url: "/facture_traitee/set",
          data: JSON.stringify(facture_traitee),
        //   dataType: "JSON",
          contentType: "application/json",
          success: this.setFactureTraitResult,
          error: function (req, err) {
            console.log("message: " + err);
          },
        });
      },
      setFactureTraitResult(response){
          if(response.error){
           console.log(response.error)
          }else{
           console.log(response)
          }

      } 

    }
})