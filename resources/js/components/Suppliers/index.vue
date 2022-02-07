<template>

<div>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Suppliers</h1>
                  <router-link to="/suppliers/create" class="btn btn-info"> Add Suppliers </router-link>

    <input type="email" class="form-control" v-model="filter" id="search" placeholder="search by name">

                  <br>
                  <br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Suppliers List</h6>
                        </div>
                        <div class="card-body">
                           <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
   <th>Name</th>
    <th>Photo</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Action</th>
    </tr>
  </thead>
  <tbody v-if="suppliers && suppliers.data.length > 0">


<tr  v-for="(supplier,index) in search" :key="supplier.id">
    <td> {{index +1}} </td>
    <td>{{supplier.name}}</td>
    <td><img :src="supplier.image == null ? '/uploads/suppliers/noimg.png' : supplier.image " id="emp-img"></td>
    <td>{{supplier.phone}}</td>
    <td>{{supplier.email}}</td>
    <td><router-link :to="{name:'editSuppliers', params:{id:supplier.id}}" class="btn btn-sm btn-info"><font color="white"> Edit </font></router-link>
     <a @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger"> Delete </a>
     </td>
</tr>
  </tbody>

   <tbody v-else>
  <td align="center" colspan="5">No record found.</td>

  </tbody>
</table>
     <pagination :data="suppliers" @pagination-change-page="allSuppliers"></pagination>

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
          suppliers:[

          ],
          filter : ''
      }
  },
  methods:{

      allSuppliers(page=1){

          axios.get('/api/suppliers?page='+page)
          .then(({data}) => (this.suppliers = data))
      },
      deleteSupplier(id){

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

    axios.delete('/api/suppliers/' +id)
    .then(()=>{
     this.suppliers.data = this.suppliers.data.filter(supplier =>{
        return supplier.id != id
      })
    })
    .catch(() => {
      
      this.$router.push({name:'suppliers'})

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
     this.allSuppliers();
  },computed:{
       search()
      {
         return this.suppliers.data.filter(supplier => {

          return supplier.name.toLowerCase().match(this.filter.toLowerCase())
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