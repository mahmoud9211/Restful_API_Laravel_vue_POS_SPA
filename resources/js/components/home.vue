<template>

<div>


    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Selling Amount (Today)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{todaysell}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Income Amount (Today)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{income}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Due Amount (Today)
                            </div>
                            <div class="row no-gutters align-items-center">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">${{due}}</div>

                                <div class="col-auto">
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Expenses</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{expense}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

   

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-12">

 

            <!-- Color System -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <router-link to="/pos" class="dlink">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            Point Of Sale
                        </div>
                    </div>
                    </router-link>
                </div>
                <div class="col-lg-6 mb-4">
                     <router-link to="/customers" class="dlink">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            Customers
                        </div>
                    </div>
                    </router-link>
                </div>
                <div class="col-lg-6 mb-4">
                    <router-link to="/products" class="dlink">
                    <div class="card bg-info text-white shadow">
                        <div class="card-body">
                            Products
                        </div>
                    </div>
                    </router-link>
                </div>
                <div class="col-lg-6 mb-4">
                    <router-link to="/suppliers" class="dlink">
                    <div class="card bg-warning text-white shadow">
                        <div class="card-body">
                            Suppliers
                       </div>
                    </div>
                     </router-link>
                </div>
                <div class="col-lg-6 mb-4">
                      <router-link to="/stock" class="dlink">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            Stock
                        </div>
                    </div>
                    </router-link>
                </div>
                <div class="col-lg-6 mb-4">
                     <router-link to="/orders" class="dlink">
                    <div class="card bg-secondary text-white shadow">
                        <div class="card-body">
                            Orders
                        </div>
                    </div>
                     </router-link>
                </div>
                <div class="col-lg-6 mb-4">
                    <router-link to="/categories" class="dlink">
                    <div class="card bg-light text-black shadow">
                        <div class="card-body">
                            Categories
                        </div>
                    </div>
                      </router-link>
                </div>
                <div class="col-lg-6 mb-4">
                     <router-link to="/employees" class="dlink">
                    <div class="card bg-dark text-white shadow">
                        <div class="card-body">
                            Employees
                        </div>
                    </div>
                     </router-link>
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


  }, data(){
  return{
    todaysell:'',
    income:'',
    due:'',
    expense:'',
    products:''
  }

 },
 mounted(){
 this.TodaySell();
 this.TodayIncome();
 this.TodayDue();
 this.TodayExpense();
 this.StockOut();
 },
  methods:{
     TodaySell(){
      axios.get('/api/today/sell')
        .then(({data}) => (this.todaysell = data))
        .catch()
     },
     TodayIncome(){
      axios.get('/api/today/income')
        .then(({data}) => (this.income = data))
        .catch()
     },
     TodayDue(){
      axios.get('/api/today/due')
        .then(({data}) => (this.due = data))
        .catch()
     },
     TodayExpense(){
      axios.get('/api/today/expense')
        .then(({data}) => (this.expense = data))
        .catch()
     },

     StockOut(){
      axios.get('/api/today/stockout')
        .then(({data}) => (this.products = data))
        .catch()
     },

   }

}

  </script>

  <style>
  .dlink{
      text-decoration:none;
      
  }

    .dlink:hover{
      text-decoration:none;
      
  }
  </style>


