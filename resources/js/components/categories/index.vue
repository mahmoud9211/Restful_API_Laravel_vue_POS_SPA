<template>

<div>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Categories</h1>
                  <router-link to="/categories/create" class="btn btn-info"> Add Categories </router-link>
    <input type="text" class="form-control" v-model="filter" id="search" placeholder="search by name">


                  <br>
                  <br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">categories List</h6>
                        </div>
                        <div class="card-body">
                           <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
   <th>Name</th>
    <th>Action</th>
    </tr>
  </thead>
  <tbody v-if="categories && categories.data.length > 0">


<tr  v-for="(category,index) in search" :key="category.id">
  <td>{{index + 1}} </td>
    <td>{{category.name}}</td>
  
    <td><router-link :to="{name:'editCategories', params:{id:category.id}}" class="btn btn-sm btn-info"><font color="white"> Edit </font></router-link>
     <a @click="deleteCategory(category.id)" class="btn btn-sm btn-danger"> Delete </a>
     </td>
</tr>
  </tbody>
  <tbody v-else>
<tr>
  <td align="center" colspan="3">No record found.</td>
</tr>
</tbody>

</table>

          <pagination :data="categories" @pagination-change-page="allCategories"></pagination>



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
          categories:[],
          filter : ''
      }
  },  mounted(){
     this.allCategories();
  },
  methods:{

      allCategories(page = 1){

          axios.get('/api/categories?page=' +page)
              .then(({data}) => 
                  (this.categories = data)
              
          )

          
      },
      deleteCategory(id){

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

    axios.delete('/api/categories/' +id)
    .then(()=>{
     this.categories.data = this.categories.data.filter(category =>{
        return category.id != id
      })
    })
    .catch(() => {
      
      this.$router.push({name:'categories'})

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
computed:{
       search()
      {
         return this.categories.data.filter(category => {

          return category.name.toLowerCase().match(this.filter.toLowerCase())
         });
      }
  }


    
}
</script>
