<template>

<div>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Expenses</h1>
                  <router-link to="/expenses/create" class="btn btn-info"> Add Expenses </router-link>
    <input type="text" class="form-control" v-model="filter" id="search" placeholder="search by name">


                  <br>
                  <br>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Expenses List</h6>
                        </div>
                        <div class="card-body">
                           <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
   <th>Amount($)</th>
    <th>Details</th>
    <th>Action</th>
    </tr>
  </thead>
  <tbody v-if="expenses && expenses.data.length > 0">


<tr  v-for="(expense,index) in search" :key="expense.id">
  <td>{{index + 1}} </td>
    <td>{{expense.amount}}</td>
     <td>{{expense.details}}</td>
  
    <td><router-link :to="{name:'editExpenses', params:{id:expense.id}}" class="btn btn-sm btn-info"><font color="white"> Edit </font></router-link>
     <a @click="deleteExpense(expense.id)" class="btn btn-sm btn-danger"> Delete </a>
     </td>
</tr>
  </tbody>
  <tbody v-else>
<tr>
  <td align="center" colspan="3">No record found.</td>
</tr>
</tbody>

</table>

          <pagination :data="expenses" @pagination-change-page="allExpenses"></pagination>



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
          expenses:[],
          filter : ''
      }
  },  mounted(){
     this.allExpenses();
  },
  methods:{

      allExpenses(page = 1){

          axios.get('/api/expenses?page=' +page)
              .then(({data}) => 
                  (this.expenses = data)
              
          )

          
      },
      deleteExpense(id){

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

    axios.delete('/api/expenses/' +id)
    .then(()=>{
     this.expenses.data = this.expenses.data.filter(expense =>{
        return expense.id != id
      })
    })
    .catch(() => {
      
      this.$router.push({name:'expenses'})

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
         return this.expenses.data.filter(expense => {

          return expense.details.toLowerCase().match(this.filter.toLowerCase())
         });
      }
  }


    
}
</script>
