
<template>

<div> 
 <div class="row justify-content-center">

            <div class="col-xl-11 col-lg-12 col-md-9">
   <div class="card o-hidden border-0 shadow-lg my-5">
<div class="card-body p-0">
<!-- Nested Row within Card Body -->
<div class="row"> 
<div class="col-lg-12">
  <div class="p-5">
      <div class="text-center">
          <h1 class="h4 text-gray-900 mb-4">Search For Orders</h1>
      </div>
      <form class="user" @submit.prevent="dateSearch" >
          <div class="form-row">
              <div class="col-md-12">
          <div class="form-group">
                  <input type="date" class="form-control form-control-user" id="exampleFirstName"
                       v-model="date" >
              <small class="text-danger" v-if="errors.date"> {{errors.date[0]}} </small>



              </div>
              </div>
     
          </div>


          <button type="submit" class="btn btn-primary btn-user btn-block">
              Search
          </button>
         
          
      </form>
      <hr>
   
     
  </div>
</div>
</div>
</div>
</div>

  </div>
 </div>






                    <div class="card shadow mb-4" v-if="show">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"> Orders</h6>
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
                    <div v-else> </div>












</div> 

</template>

<script>
 export default {
  created(){

    if(!User.LoggedIn()){

     this.$router.push({name: 'login'})

    }



  },

    data(){
    return {
     date: '',
     show: false,
     orders: [],
     errors :{}

    }
  },

  methods:{

      dateSearch(){
          let data = {date:this.date}
          axios.post('/api/order/search',data)
          .then(({data})=>{
              (this.orders = data)
               this.isValid();
          })
          .catch(error=> this.errors=error.response.data.errors)
         
      },
      isValid(){
          if (this.orders.length < 1)
          {
              this.show = false;
              Toastermsg.errormsg('No orders in that date');
          }else
          {
              this.show = true
          }
      }
    

  } 


  }
   
</script>