
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
          <h1 class="h4 text-gray-900 mb-4">Suppliers Update</h1>
      </div>
      <form class="user" @submit.prevent="updateSupplier" enctype="multipart/form-data">
          <div class="form-row">
              <div class="col-md-6">
          <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="exampleFirstName"
                      placeholder="Full Name" v-model="form.name" >

     <small class="text-danger" v-if="errors.name"> {{errors.name[0]}} </small>

              </div>
              </div>
             <div class="col-md-6">
          <div class="form-group">
              <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                  placeholder="Email Address" v-model="form.email" >

                  <small class="text-danger" v-if="errors.email"> {{errors.email[0]}} </small>


          </div>
             </div>
          </div>


           <div class="form-row">
              <div class="col-md-6">
          <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="exampleFirstName"
                      placeholder="Address" v-model="form.address" >

                      <small class="text-danger" v-if="errors.address"> {{errors.address[0]}} </small>
              </div>
              </div>
             <div class="col-md-6">
          <div class="form-group">
              <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                  placeholder="Phone" v-model="form.phone" >

                  <small class="text-danger" v-if="errors.phone"> {{errors.phone[0]}} </small>


          </div>
             </div>
          </div>


            <div class="form-row">
              <div class="col-md-6">
          <div class="form-group">
  
<input class="form-control" accept="image/*" type="file" @change="fileSelected"  id="formFileMultiple" >


<small class="text-danger" v-if="errors.image"> {{errors.image[0]}} </small>


              </div>
              </div>

  <div class="col-md-6">
          <div class="form-group">

        <img :src="form.image == null ? '/uploads/suppliers/noimg.png' : form.image" style="height: 40px; width: 40px;">

     
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
              email: '',
              phone: '' ,
              image: '',
              newimage: ''
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
            
            this.form.newimage = event.target.result

            console.log(event.target.result)

         };

         reader.readAsDataURL(file);
      },
    updateSupplier()
    {
        let id = this.$route.params.id
        axios.patch('/api/suppliers/'+id,this.form)
        .then(()=> {
            Toastermsg.successmsg('Updated Successfully')
            this.$router.push({name:'suppliers'})
        })
        .catch(error =>this.errors = error.response.data.errors)

    }


  }, created(){
      let id = this.$route.params.id
      axios.get('/api/suppliers/'+id)
      .then(({data})=> (this.form = data))
      .catch( console.log('error'))

  }
  
}
</script>

