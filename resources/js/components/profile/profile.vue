  

<template>
  
  <div>

 <div class="row">
   
 </div>



    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4" style="margin-top:20px;"> User Profile </h1>
                  </div>

       

<div class="row">
            <div class="col-lg-8 mb-8" style="margin-left:10px;margin-bottom:10px;">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Personal Information </h6>
                </div>
                <div class="table-responsive">
                   
        <ul class="list-group">
          <li class="list-group-item"><b>Name :</b> {{users.name}}  </li>
          <li class="list-group-item"><b>Phone :</b> {{users.phone}} </li>
          <li class="list-group-item"><b>Email :</b>  {{users.email}}</li>
          <li class="list-group-item"><b>Address :</b> {{users.address}}  </li>
          <li class="list-group-item"><b>Age :</b> {{users.birth_date}} </li>
        </ul>

                  
                </div>
                <div class="card-footer"></div>
              </div>
            </div>


             <div class="col-lg-3 mb-3" >
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Photo </h6>
                </div>
                <div class="table-responsive">
                   
               <img :src="users.photo == null ? '/uploads/employees/noimg.png' : users.photo " style="width:200px;height:200px;">
                  
                </div>
                <div class="card-footer"></div>
              </div>
            </div>




          </div>




                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</template>



<script type="text/javascript">
  
  export default {
 created(){

   if(!User.LoggedIn()){

     this.$router.push({name: 'login'})

    }
    },

    data(){
    return {
       
      errors:{},
      users:{},
      
    }
  },
  created(){
   this.user();
  },

  methods:{
    user()
    {
   let token = localStorage.getItem('token');
    axios.post('/api/auth/profile'+token)
   .then(({data}) => (this.users= data))
 
    }
   
  } 


  }
   
</script>

