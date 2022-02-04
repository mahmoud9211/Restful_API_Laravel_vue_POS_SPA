
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
          <h1 class="h4 text-gray-900 mb-4">Profile Update</h1>
      </div>
      <form class="user" @submit.prevent="updateProfile">
          <div class="form-row">
              <div class="col-md-6">
          <div class="form-group">
              <label> Name </label>
                  <input type="text" class="form-control form-control-user" id="exampleFirstName"
                      placeholder="Full Name" v-model="form.name" >

     <small class="text-danger" v-if="errors.name"> {{errors.name[0]}} </small>

              </div>
              </div>
             <div class="col-md-6">
          <div class="form-group">
                            <label> Email </label>

              <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                  placeholder="Phone" v-model="form.email" >

                  <small class="text-danger" v-if="errors.email"> {{errors.email[0]}} </small>


          </div>
             </div>
          </div>


           <div class="form-row">
              <div class="col-md-6">
          <div class="form-group">
                            <label> Phone </label>

                  <input type="text" class="form-control form-control-user" id="exampleFirstName"
                      placeholder="Phone" v-model="form.phone" >

                      <small class="text-danger" v-if="errors.phone"> {{errors.phone[0]}} </small>
              </div>
              </div>

                    <div class="col-md-6">
          <div class="form-group">
                            <label> Address </label>

                  <input type="text" class="form-control form-control-user" id="exampleFirstName"
                      placeholder="Address" v-model="form.address" >

                      <small class="text-danger" v-if="errors.address"> {{errors.address[0]}} </small>
              </div>
              </div>
    
          </div>



            <div class="form-row">
              <div class="col-md-6">
          <div class="form-group">
                            <label> Birth Date </label>

                  <input type="date" class="form-control form-control-user" id="exampleFirstName"
                      placeholder="Address" v-model="form.birth_date" >

                      <small class="text-danger" v-if="errors.birth_date"> {{errors.birth_date[0]}} </small>
              </div>
              </div>

           
    
          </div>

            <div class="form-row">

         <div class="col-md-6">
          <div class="form-group">
                <input class="form-control" accept="image/*" type="file" @change="fileSelected"  id="formFileMultiple" >


<small class="text-danger" v-if="errors.photo"> {{errors.photo[0]}} </small>

              </div>
              </div>


           <div class="col-md-6">
          <div class="form-group">

        <img :src="form.photo == null ? '/uploads/employees/noimg.png' : form.photo" style="height: 40px; width: 40px;">

     
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
              name: '' ,
              address: '' ,
              phone: '',
              email: '',
              photo: '',
              birth_date: '',
              newphoto: ''
          
          },
          errors:{

          }
      }
  },methods:{

         fileSelected(event)
      {
         let file = event.target.files[0];
         let reader = new FileReader();

         reader.onload = event => {
            
            this.form.newphoto = event.target.result

            console.log(event.target.result)

         };

         reader.readAsDataURL(file);
      },


    updateProfile()
    {
             let token = localStorage.getItem('token');
     axios.post('/api/auth/profile/update'+token,this.form)
        .then(()=> {
            Toastermsg.successmsg('Updated Successfully')
            this.$router.push({name:'profile'})
        })
        .catch(error =>this.errors = error.response.data.errors)

    }


  }, created(){
     let token = localStorage.getItem('token');
      axios.get('/api/auth/profile/edit'+token)
      .then(({data})=> (this.form = data))
      .catch( console.log('error'))

  }
  
}
</script>

