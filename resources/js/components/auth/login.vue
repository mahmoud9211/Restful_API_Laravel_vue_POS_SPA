

<template>
 
 <div>


<div class="card o-hidden border-0 shadow-lg my-5">
<div class="card-body p-0">
<!-- Nested Row within Card Body -->
<div class="row">
  <div class="col-lg-12">
      <div class="p-5">
          <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
          </div>
          <form class="user" @submit.prevent="login">
              <div class="form-group">
                  <input type="email" class="form-control form-control-user"
                      id="exampleInputEmail" aria-describedby="emailHelp"
                      placeholder="Enter Email Address..." v-model="form.email">

                      <small class="text-danger" v-if="errors.email"> {{errors.email[0]}} </small>
              </div>
              <div class="form-group">
                  <input type="password" class="form-control form-control-user"
                      id="exampleInputPassword" placeholder="Password" v-model="form.password">

      <small class="text-danger" v-if="errors.password"> {{errors.password[0]}} </small>

              </div>
              <div class="form-group">
                  <div class="custom-control custom-checkbox small">
                      <input type="checkbox" class="custom-control-input" id="customCheck">
                      <label class="custom-control-label" for="customCheck">Remember
                          Me</label>
                  </div>
              </div>
              <button  class="btn btn-primary btn-user btn-block">
                  Login
              </button>
              <hr>
              
             
          </form>
          <div class="text-center">
              <router-link class="small" to="/forget/password">Forgot Password?</router-link>
          </div>
          <div class="text-center">
              <router-link class="small" to="/register">Create an Account!</router-link>
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


  },

  data(){

   return{

    form:{

    email : null,
    password : null

    },
    errors:{

    }

   }

  },
  methods: {

    login(){

     axios.post('/api/auth/login',this.form)
     .then(res =>{
      User.responseAfterLogin(res)
      Toastermsg.successmsg('Signed in successfully')
      this.$router.push({name: 'home'})
     })
     .catch(error =>{ this.errors = error.response.data.errors
       Toastermsg.errormsg('Invalid Email Or Password')   
     })

    }

  }

}
</script>

<style>

</style>