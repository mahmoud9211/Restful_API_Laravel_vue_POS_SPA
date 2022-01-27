<template>

<div>


    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">POS</h1>
      
    </div>



    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-7 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                
                </div>

   <!--  Category Wise Product -->

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All</a>
  </li>

  <li class="nav-item" v-for="category in categories" :key="category.id">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
     aria-controls="profile" aria-selected="false" @click="categorisedProducts(category.id)">{{category.name}}</a>
  </li>
 
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">



                <!-- Card Body -->
                <div class="card-body">
    <input type="text" v-model="filter" class="form-control" style="width: 560px;" placeholder="Search by product name">
           <br>
                    <div class="row">
         <div class="col-lg-3 col-md-3 col-sm-6 col-6 d-flex align-self-stretch" style="margin-bottom:10px;" v-for="product in search" :key="product.id">

   <div class="card " style="width: 8rem;">
  <img class="card-img-top" :src="product.image">
  <div class="card-body">

       <h6 class="card-title">{{ product.name }}</h6>
       <span class="badge badge-success" v-if="product.qty  > 0 ">Available </span> 
    <span class="badge badge-danger" v-else>Stock Out </span> 

  </div>
</div>

                        </div>
                    </div>
                </div>
                        </div>


    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                       <div class="card-body">

        <input type="text" v-model="itemSearch" class="form-control" style="width: 560px;" placeholder="Search by product name">
           <br>
                    <div class="row">
         <div class="col-lg-3 col-md-3 col-sm-6 col-6 d-flex align-self-stretch" style="margin-bottom:10px;" v-for="categoriesProduct in searchCategory" :key="categoriesProduct.id">

   <div class="card " style="width: 8rem;">
  <img class="card-img-top" :src="categoriesProduct.image">
  <div class="card-body">

       <h6 class="card-title">{{ categoriesProduct.name }}</h6>
       <span class="badge badge-success" v-if="categoriesProduct.qty  > 0 ">Available </span> 
    <span class="badge badge-danger" v-else>Stock Out </span> 

</div>
</div>

</div>
</div>




</div>
</div></div>
            </div>
</div>
        <!-- Pie Chart -->
        <div class="col-xl-5 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Expense Insert</h6>
                    <div class="dropdown no-arrow">
                 
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div>

                                      <div class="table-responsive" style="font-size: 12px;">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

          <tr>
            <td>product name</td>
            <td><input type="text" readonly="" style="width: 15px;" >
       <button  class="btn btn-sm btn-success">+</button>
   <button   class="btn btn-sm btn-danger" >-</button>

            </td>
            <td>60</td>
            <td>90</td>
   <td><a  class="btn btn-sm btn-primary"><font color="#ffffff">X</font></a></td>
          </tr>
                      
                       
                    </tbody>
                  </table>
                </div>



  <div class="card-footer">
            <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">Total Quantity:
  <strong>7</strong>
   </li>
     <li class="list-group-item d-flex justify-content-between align-items-center">Sub Total:
  <strong>90 $</strong>
   </li>

     <li class="list-group-item d-flex justify-content-between align-items-center">Vat:
  <strong>5 %</strong>
   </li>
     <li class="list-group-item d-flex justify-content-between align-items-center">Total :
  <strong>10 $</strong>
   </li> 
              
            </ul>   
            <br> 

        <form >
          <label>Customer Name</label>
          <select class="form-control" >
         <option>mahmoud </option>
                 
           </select>

           <label>Pay</label>
           <input type="text" class="form-control" required="" >

           <label>Due</label>
           <input type="text" class="form-control" required="" >

          <label>Pay By</label>
          <select class="form-control" v-model="payby">
                 <option value="HandCash">Hand Cash </option>
                 <option value="Cheaque">Cheaque </option>
                 <option value="GiftCard">Gift Card </option>
           </select>

           <br>
           <button type="submit" class="btn btn-success">Submit</button>

        </form>    



                </div>
             








                        
                    </div>
                   
                </div>
            </div>
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
          products:[],
          filter: '',
          itemSearch: '',
          categories: '',
          categoriesProducts:[]
      }
  },
  methods:{

      allProducts(){

          axios.get('/api/pos/products')
          .then(({data}) => (this.products = data))
      },

       allCategories(){

          axios.get('/api/category/get')
          .then(({data}) => (this.categories = data))
      },

      categorisedProducts(id)
      {
          axios.get('/api/pos/category/products/'+id)
          .then(({data}) => (this.categoriesProducts = data))
          .catch()
      }
     
     
  },
  created(){
     this.allProducts();
     this.allCategories();
  },computed:{
       search()
      {
         return this.products.filter(product => {

          return product.name.toLowerCase().match(this.filter.toLowerCase())
         });
      },
       searchCategory()
      {
         return this.categoriesProducts.filter(categoriesProduct => {

          return categoriesProduct.name.toLowerCase().match(this.itemSearch.toLowerCase())
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