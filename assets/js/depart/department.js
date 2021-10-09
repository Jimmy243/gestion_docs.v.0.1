const vue = new Vue({
    el:"#dapp",
    data(){
        return {
            tab: []
        }
    },
    computed: {
        getDepartment(){
            return this.tab;
        }
    },
    mounted(){
        $.ajax({
            type:"GET",
            url:'/department/get',
            success: function(donnees){
                this.tab = donnees;
                console.log(this.tab);
            }
        })
    }
})