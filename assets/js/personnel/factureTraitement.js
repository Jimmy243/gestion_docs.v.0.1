const vue = new Vue({
    el:"#app",
    data(){
        return {
            tabFacture:[],
            facture:""
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
        setFactureTrait(){
           

          
        }
    }
})