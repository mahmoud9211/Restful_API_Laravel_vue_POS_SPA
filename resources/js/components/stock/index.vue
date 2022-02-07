<template>

<div>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Stock</h1>

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
    <th>Quantity</th>
    <th>Availability</th>
    <th>Action</th>
    </tr>
  </thead>
  <tbody v-if="products && products.data.length > 0">


<tr  v-for="(product,index) in search" :key="product.id">
    <td> {{index +1}} </td>
     <td> {{product.name}} </td>
    <td><img :src="product.image" id="emp-img"></td>
    <td>{{product.code}}</td>

     <td>{{product.category.name}}</td>
     <td>{{product.qty}}</td>
     <td v-if="product.qty > 0"> <span class="badge badge-success">Available </span> </td>
          <td v-else> <span class="badge badge-danger">Not Available </span> </td>

    <td><router-link :to="{name:'editStock', params:{id:product.id}}" class="btn btn-sm btn-info"><font color="white"> Edit </font></router-link>
     </td>
</tr>
  </tbody>

 <tbody v-else>
  <td align="center" colspan="5">No record found.</td>

  </tbody>
</table>
     <pagination :data="products" @pagination-change-page="allProducts"></pagination>
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

      allProducts(page=1){

          axios.get('/api/products?page='+page)
          .then(({data}) => (this.products = data))
      },
 
     
  },
  created(){
     this.allProducts();
  },computed:{
       search()
      {
         return this.products.data.filter(product => {

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