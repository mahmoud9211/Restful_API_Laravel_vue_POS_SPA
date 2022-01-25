<template>
    
    <div>

        <div class="card o-hidden border-0 shadow-lg my-5">
<div class="card-body p-0">
<!-- Nested Row within Card Body -->
<div class="row">
  <div class="col-lg-12">
      <div class="p-5">
          <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Forgot Password!</h1>
          </div>
          <form class="user">
              <div class="form-group">
                  <input type="email" class="form-control form-control-user"
                      id="exampleInputEmail" aria-describedby="emailHelp"
                      placeholder="Enter Email Address...">
              </div>
          
             
              <a href="index.html" class="btn btn-primary btn-user btn-block">
                  Send
              </a>
              <hr>
              
             
          </form>
          
          <div class="text-center">
              <router-link class="small" to="/login">Back To Login</router-link>
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


  }
}
</script>

<style>

</style>

