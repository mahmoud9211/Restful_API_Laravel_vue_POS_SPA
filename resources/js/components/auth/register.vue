

<template>

<div> 

   <div class="card o-hidden border-0 shadow-lg my-5">
<div class="card-body p-0">
<!-- Nested Row within Card Body -->
<div class="row">
<div class="col-lg-12">
  <div class="p-5">
      <div class="text-center">
          <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
      </div>
      <form class="user" @submit.prevent="signup">
          <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="exampleFirstName"
                      placeholder="Name" v-model="form.name">
                      <small  class="text-danger" v-if="errors.name"> {{errors.name[0]}} </small>
              </div>
            
          <div class="form-group">
              <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                  placeholder="Email Address" v-model="form.email">

  <small  class="text-danger" v-if="errors.email"> {{errors.email[0]}} </small>

          </div>
          <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="password" class="form-control form-control-user"
                      id="exampleInputPassword" placeholder="Password" v-model="form.password">

              <small  class="text-danger" v-if="errors.password"> {{errors.password[0]}} </small>

              </div>
              <div class="col-sm-6">
                  <input type="password" class="form-control form-control-user"
                      id="exampleRepeatPassword" placeholder="Repeat Password" v-model="form.password_confirmation">

                      

              </div>
          </div>
          <button class="btn btn-primary btn-user btn-block">
              Register Account
          </button>
         
          
      </form>
      <hr>
   
      <div class="text-center">
          <router-link class="small" to="/login">Already have an account? Login!</router-link>
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

         if(User.LoggedIn()){

     this.$router.push({name: 'home'})

    }


    },data(){

         return{

            form:{
                name : null,
                email : null,
                password : null,
                confim_password : null

            },
            errors:{


            }

         }

    },methods:{

       signup(){

           axios.post('/api/auth/signup',this.form)
           .then(res => {
              User.responseAfterLogin(res)
         Toastermsg.successmsg('Signed up successfully')
         this.$router.push({name: 'home'})
           })  
            .catch(error =>{ this.errors = error.response.data.errors
       Toastermsg.errormsg('Something went wrong!')   
     })


       }

    }

}
</script>

<style>

</style>