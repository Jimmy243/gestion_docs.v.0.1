const vue = new Vue({
    el:"#app",
    data(){
        return {
          tabDepartment: [],
          setNameD: '',
          editNameD: '',
          editIdD: 0
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
          dataType: "JSON",
          success: this.getData,
          error: function(req, err){ console.log('message: ' + err); }
        })
      },
      getData(data){
        this.tabDepartment = data.error?[]:data
        console.log(data);
      },
      setDepartment(){
        $.ajax({
          type: "POST",
          url: "/department/set",
          data: JSON.stringify({NameD:this.setNameD}),
          contentType: 'application/json',
          dataType: "JSON",
          success: this.setDepartmentResult,
          error: function(req, err){ console.log('message: ' + err); }
        });
      },
      setDepartmentResult(response){
        $('#ajoutDepart').modal('hide')
        console.log(response);
        this.reloadData()
      },
      editDepartment(){
        if(!this.editNameD || !this.editIdD)
        return;

        $.ajax({
          type: "POST",
          url: "/department/edit",
          data: JSON.stringify({NameD:this.editNameD,IdD:this.editIdD}),
          contentType: 'application/json',
          dataType: "JSON",
          success: this.editDepartmentResult,
          error: function(req, err){ console.log('message: ' + err) }
        });
      },
      editDepartmentResult(response){
        console.log(response);
        this.reloadData()
      },
      getIdBForEdeting(id){
        const depart = this.tabDepartment.find( (element,index) => index === id)
        this.editNameD = depart && depart.NameD
        this.editIdD = depart && depart.IdD

        console.log(depart);
        this.editDepartment();
      },
      deleteDepartment(id){ 
        const depart = this.tabDepartment.find( (element,index) => index === id)
        $.ajax({
          type: "POST",
          url: "/department/delete",
          data: JSON.stringify({IdD:depart.IdD}),
          contentType: 'application/json',
          dataType: "JSON",
          success: this.deleteDepartmentResult,
          error: function(req, err){ console.log('message: ' + err) }
        });
      },
      deleteDepartmentResult(response){
        console.log(response);
        this.reloadData()
      }
    },
})
