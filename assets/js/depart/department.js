const vue = new Vue({
    el:"#dapp",
    data(){
        return {
          tab: [],
          name: 'amisi',
        }
    },
    computed: {
    },
    mounted(){
      this.reloadData()
    },
    methods:{
      reloadData(){
        $.ajax({
          type:"GET",
          url:'/department/get',
          success: this.getData
        })
      },
      getData(data){
        this.tab = data;
      },
      send(){
          $.ajax({
            type: "POST",
            url: "/department/set",
            data: JSON.stringify({NameD:this.name}),
            contentType: 'application/json',
            dataType: "JSON",
            success: this.returnData,
            error: function(req, err){ console.log('message: ' + err); }
          });
      },
      returnData(response){
        console.log(response);
        // this.tab.push()
      }
    },
})
