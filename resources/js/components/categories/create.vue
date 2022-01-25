
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
          <h1 class="h4 text-gray-900 mb-4">Add Categories</h1>
      </div>
      <form class="user" @submit.prevent="addCategory" >
          <div class="form-row">
              <div class="col-md-12">
          <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="exampleFirstName"
                      placeholder="Category Name" v-model="form.name" >

     <small class="text-danger" v-if="errors.name"> {{errors.name[0]}} </small>

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
              name: null
            
          },
          errors:{

          }
      }
  },methods:{

 
      addCategory()
      {
          axios.post('/api/categories',this.form)
       .then(() =>{ 
         Toastermsg.successmsg('Added Successfully')
        this.$router.push({ name: 'categories'})
       })
          .catch(error => this.errors = error.response.data.errors)
      }


  }
  
}
</script>