<template>

<div>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Employees</h1>
                  <router-link to="/employees/create" class="btn btn-info"> Add Employees </router-link>

    <input type="email" class="form-control" v-model="filter" id="search" placeholder="search by name">

                  <br>
                  <br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Employees List</h6>
                        </div>
                        <div class="card-body">
                           <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
   <th>Name</th>
    <th>Photo</th>
    <th>Phone</th>
    <th>Joining Date</th>
    <th>Salary</th>
    <th>Action</th>
    </tr>
  </thead>
  <tbody>


<tr  v-for="(employee,index) in search" :key="employee.id">
    <td> {{index +1}} </td>
    <td>{{employee.name}}</td>
    <td><img :src="employee.image == null ? '/uploads/employees/noimg.png' : employee.image " id="emp-img"></td>
    <td>{{employee.phone}}</td>
    <td>{{employee.joining_date}}</td>
    <td>{{employee.salary}}</td>
    <td><router-link :to="{name:'editEmployees', params:{id:employee.id}}" class="btn btn-sm btn-info"><font color="white"> Edit </font></router-link>
     <a @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger"> Delete </a>
     </td>
</tr>
  </tbody>
     <pagination :data="employees" @pagination-change-page="allEmployees"></pagination>

</table>
                        </div>
                    </div>
</div>
    
</template>

<script>
export default {

     created(){

    if(!User.LoggedIn()){

     this.$router.push({name: 'login'})

    }



  },data(){
      return{
          employees:[

          ],
          filter : ''
      }
  },
  methods:{

      allEmployees(page = 1){

          axios.get('/api/employees?page='+page)
          .then(({data}) => (this.employees = data))
      },
      deleteEmployee(id){

        Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {

    axios.delete('/api/employees/' +id)
    .then(()=>{
     this.employees = this.employees.filter(employee =>{
        return employee.id != id
      })
    })
    .catch(() => {
      
      this.$router.push({name:'employees'})

    })

    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})


      }
     
  },
  created(){
     this.allEmployees();
  },computed:{
       search()
      {
         return this.employees.filter(employee => {

          return employee.name.toLowerCase().match(this.filter.toLowerCase())
         });
      }
  }


    
}
</script>

<style>
#emp-img{
    width:40px;
    height:50px;
}
#search{
  width: 300px;
  float: right;
}
</style>