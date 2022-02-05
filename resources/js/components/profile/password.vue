
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
          <h1 class="h4 text-gray-900 mb-4">Password Update</h1>
      </div>
      <form class="user" @submit.prevent="updatePassword">
          <div class="form-row">
              <div class="col-md-6">
          <div class="form-group">
                  <input type="password" class="form-control form-control-user" id="exampleFirstName"
                      placeholder="Current Password" v-model="form.oldpassword" >

     <small class="text-danger" v-if="errors.oldpassword"> {{errors.oldpassword[0]}} </small>

              </div>
              </div>
             <div class="col-md-6">
          <div class="form-group">
              <input type="password" class="form-control form-control-user" id="exampleInputEmail"
                  placeholder="New Password" v-model="form.password" >

                  <small class="text-danger" v-if="errors.password"> {{errors.password[0]}} </small>


          </div>
             </div>
          </div>


           <div class="form-row">
              <div class="col-md-6">
          <div class="form-group">
                  <input type="password" class="form-control form-control-user" id="exampleFirstName"
                      placeholder="Re Type the new password" v-model="form.password_confirmation" >

              </div>
              </div>
    
          </div>


          <button type="submit" class="btn btn-primary btn-user btn-block">
              Update
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
              oldpassword: '' ,
              password: '' ,
              password_confirmation: '',
              error:''
             
          
          },
          errors:{

          }
      }
  },methods:{


    updatePassword()
    {
        let token = localStorage.getItem('token');
        axios.post('/api/auth/profile/password'+token,this.form)
       .then(response => {
         if(response.data.error){

           Toastermsg.errormsg('The current password is not correct')
         }
         
          else{

              Toastermsg.successmsg('Updated Successfully')
             localStorage.removeItem('token')
             localStorage.removeItem('user')
            this.$router.push({name:'login'})
          }
         
         })
          
        .catch(error =>{this.errors = error.response.data.errors
        })

    },
   


  }
  
}
</script>

