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
             <button class="btn btn-sm" @click.prevent="addToCart(product.id)" >
  <img class="card-img-top" :src="product.image">
  <div class="card-body" >
       <h6 class="card-title">{{ product.name }}</h6>
             
       <span class="badge badge-success" v-if="product.qty  > 0 ">Available </span> 
    <span class="badge badge-danger" v-else>Stock Out </span> 

  </div>
               </button>

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

          <tr v-for="cart in carts" :key="cart.id">
            <td>{{cart.product.name}}</td>
            <td><input type="text" readonly="" style="width: 25px;" :value="cart.qty" >
       <button  class="btn btn-sm btn-success" @click.prevent="increment(cart.id)">+</button>
   <button  class="btn btn-sm btn-danger" @click.prevent="decrement(cart.id)" v-if="cart.qty >= 2" >-</button>
   <button  class="btn btn-sm btn-danger" @click.prevent="decrement(cart.id)" v-else disabled>-</button>

            </td>
            <td >{{cart.price}}</td>
            <td>{{cart.sub_total}}</td>
   <td><a @click="removePro(cart.id)"  class="btn btn-sm btn-primary"><font color="#ffffff">X</font></a></td>
          </tr>
                      
                       
                    </tbody>
                  </table>
                </div>



  <div class="card-footer">
            <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">Total Quantity:
  <strong>{{ quantity }}</strong>
   </li>
     <li class="list-group-item d-flex justify-content-between align-items-center">Sub Total:
  <strong>{{subTotal}} $</strong>
   </li>

     <li class="list-group-item d-flex justify-content-between align-items-center">Vat:
  <strong>10 %</strong>
   </li>
     <li class="list-group-item d-flex justify-content-between align-items-center">Total :
  <strong> {{subTotal + (subTotal*0.1)}} $</strong>
   </li> 
              
            </ul>   
            <br> 

        <form @submit.prevent="orderDone">
          <label>Customer Name</label>
          <select class="form-control" v-model="customer_id" >
            <option value="" disabled selected> Choose </option>
         <option  :value="customer.id" v-for="customer in customers" :key="customer.id">{{customer.name}}</option>
                 
           </select>

           <label>Pay</label>
           <input type="text" class="form-control" required="" v-model="pay" >

           <label>Due</label>
           <input type="text" class="form-control" required="" v-model="due" >

          <label>Pay By</label>
          <select class="form-control" v-model="payment_method">
                 <option value="HandCash">Cash </option>
                 <option value="visa-master">Visa/MasterCard </option>
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
          categoriesProducts:[],
          customers: '',
          carts: [],
          customer_id: '',
          pay: '',
          due: '',
          payment_method: ''
          
      }
  },
    created(){
     this.allProducts();
     this.allCategories();
     this.allCustomers();
      this.getCartContent();
     Reload.$on('AfterAdd',()=>{
       this.getCartContent();
     })



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
      },
      allCustomers()
      {
        axios.get('/api/customer/get')
        .then(({data}) => this.customers = data)
      },
      addToCart(id)
      {
        axios.get('/api/cart/add/'+id)
        .then(()=>{
          Reload.$emit('AfterAdd');
          Toastermsg.successmsg('Added To Cart')

        })

    
      },
      getCartContent()
      {
        axios.get('/api/cart/get')
        .then(({data}) => this.carts = data)
      },
      removePro(id)
      {
        axios.get('/api/cart/remove/'+id)
        .then(()=>{
        Reload.$emit('AfterAdd');
        }) 
      },
      increment(id)
      {
        axios.get('/api/cart/increment/'+id)
         .then(()=>{
        Reload.$emit('AfterAdd');
        }) 
      },
       decrement(id)
      {
        axios.get('/api/cart/decrement/'+id)
         .then(()=>{
        Reload.$emit('AfterAdd');
        }) 
      },
      orderDone()
      {
        let total = this.subTotal + (this.subTotal*0.1);
        var data = {quantity:this.quantity,subTotal:this.subTotal,customer_id:this.customer_id,
        due:this.due,pay:this.pay,payment_method:this.payment_method,total:total};

        axios.post('/api/order/done',data)
        .then(()=>{
          Toastermsg.successmsg('Order Done')
          this.$router.push({name:'home'})
        })

      }
 

     
     
  },
computed:{
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
      } ,
      quantity()
      {
       let sum = 0;
       for(let i = 0; i < this.carts.length ; i++){
         sum += (parseFloat(this.carts[i].qty));
       }
       return sum;
      },

      subTotal()
      {
        let sum = 0;
        for(let i = 0; i < this.carts.length ; i++)
        {
          sum += (parseFloat(this.carts[i].sub_total));
        }
        return sum;
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