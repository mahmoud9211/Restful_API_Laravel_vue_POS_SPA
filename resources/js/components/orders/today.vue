<template>

<div>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Orders</h1>


                  <br>
                  <br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Today's Orders</h6>
                        </div>
                        <div class="card-body">
                           <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
   <th>customer Name</th>
    <th>Total Amount ($)</th>
    <th>Payment Method</th>
    <th>Action</th>
    </tr>
  </thead>
  <tbody>


<tr  v-for="(order,index) in orders" :key="order.id">
    <td> {{index +1}} </td>
     <td> {{order.customer.name}} </td>
    <td>{{order.total}}</td>
     <td>{{order.payment_method}}</td>

    <td><router-link :to="{name:'orderDetails', params:{id:order.id}}" class="btn btn-sm btn-info"><font color="white"> View </font></router-link>
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
          orders:[

          ]
      }
  },
  methods:{

      allOrders(){

          axios.get('/api/orders/today')
          .then(({data}) => (this.orders = data))
      }
 
     
  },
  created(){
     this.allOrders();
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