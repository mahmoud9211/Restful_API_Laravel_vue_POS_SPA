<template>

<div>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Products</h1>
                  <router-link to="/products/create" class="btn btn-info"> Add Products </router-link>

    <input type="email" class="form-control" v-model="filter" id="search" placeholder="search by name">

                  <br>
                  <br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Products List</h6>
                        </div>
                        <div class="card-body">
                           <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
   <th>Name</th>
    <th>Photo</th>
    <th>Code</th>
    <th>Category</th>
    <th>Purchase Price ($)</th>
    <th>Selling Price ($)</th>
     <th>Profit(%)</th>
    <th>Action</th>
    </tr>
  </thead>
  <tbody>


<tr  v-for="(product,index) in products" :key="product.id">
    <td> {{index +1}} </td>
     <td> {{product.name}} </td>
    <td><img :src="product.image" id="emp-img"></td>
    <td>{{product.code}}</td>

     <td>{{product.category.name}}</td>
     <td>{{product.purchase_price}}</td>
     <td>{{product.selling_price}}</td>
      <td>{{product.profit_percentage}}</td>
    <td><router-link :to="{name:'editProducts', params:{id:product.id}}" class="btn btn-sm btn-info"><font color="white"> Edit </font></router-link>
     <a @click="deleteProduct(product.id)" class="btn btn-sm btn-danger"> Delete </a>
     </td>
</tr>
  </tbody>
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
          products:[

          ],
          filter : ''
      }
  },
  methods:{

      allProducts(){

          axios.get('/api/products')
          .then(({data}) => (this.products = data))
      },
      deleteProduct(id){

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

    axios.delete('/api/products/' +id)
    .then(()=>{
     this.products = this.products.filter(product =>{
        return product.id != id
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
     this.allProducts();
  },computed:{
       search()
      {
         return this.products.filter(product => {

          return product.name.toLowerCase().match(this.filter.toLowerCase())
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