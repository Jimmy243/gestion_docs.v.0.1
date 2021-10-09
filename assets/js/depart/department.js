const vue = new Vue({
    el:"#dapp",
    data(){
        return {
          tab: []
        }
    },
    computed: {
    },
    mounted(){
      $.ajax({
          type:"GET",
          url:'/department/get',
          success: this.getData
      })
    },
    methods:{
      getData(data){
        this.tab = data;
      }
    }
})
