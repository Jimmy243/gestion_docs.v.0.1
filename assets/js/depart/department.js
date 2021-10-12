const vue = new Vue({
    el:"#app",
    data(){
        return {
          tabDepartment: [],
          setNameD: '',
          editNameD: '',
          editIdD: 0,

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
        console.log(200);
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
        // this.editDepartment();
      },
      deleteDepartment(id){ 
  
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => this.isAccepts(result.isConfirmed,id))

       

        
      },
      isAccepts(result,id){
        if(!result) return 
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
       if(response.error){

       }else{
        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        )
       }
        console.log(response);
        this.reloadData()
      }
    },
})
