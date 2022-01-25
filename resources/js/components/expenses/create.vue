
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
          <h1 class="h4 text-gray-900 mb-4">Add Expenses</h1>
      </div>
      <form class="user" @submit.prevent="addExpenses" >
          <div class="form-row">
              <div class="col-md-12">
          <div class="form-group">
              <label> Expense Details </label>
                  <textarea  class="form-control form-control-user" id="exampleFirstName"
                       v-model="form.details" >  </textarea>

     <small class="text-danger" v-if="errors.details"> {{errors.details[0]}} </small>

              </div>
              </div>
     
          </div>

            <div class="form-row">
              <div class="col-md-12">
          <div class="form-group">
              <label> Amount ($) </label>
                  <input type="number" class="form-control form-control-user" id="exampleFirstName"
                       v-model="form.amount" >  

     <small class="text-danger" v-if="errors.amount"> {{errors.amount[0]}} </small>

              </div>
              </div>
     
          </div>


          <button type="submit" class="btn btn-primary btn-user btn-block">
              Add
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
      return{
          form:{
              details: null,
              amount: null
            
          },
          errors:{

          }
      }
  },methods:{

 
      addExpenses()
      {
          axios.post('/api/expenses',this.form)
       .then(() =>{ 
         Toastermsg.successmsg('Added Successfully')
        this.$router.push({ name: 'expenses'})
       })
          .catch(error => this.errors = error.response.data.errors)
      }


  }
  
}
</script>