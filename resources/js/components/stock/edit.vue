
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
          <h1 class="h4 text-gray-900 mb-4">Stock Update</h1>
      </div>
      <form class="user" @submit.prevent="updateProduct" enctype="multipart/form-data">
        
          <div class="form-row">
              <div class="col-md-6">
          <div class="form-group">
              <label> Product Name </label>
                  <input type="text" class="form-control form-control-user" id="exampleFirstName"
                      placeholder="Full Name" v-model="form.name" readonly >


              </div>
              </div>
             <div class="col-md-6">
          <div class="form-group">
               <label> Product Code </label>
              <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                  placeholder="Product Code" v-model="form.code" readonly>



          </div>
             </div>
          </div>



           <div class="form-row">
              <div class="col-md-12">
          <div class="form-group">
              <label>Quantity</label>
                  <input type="number" class="form-control form-control-user" id="exampleFirstName"
                       v-model="form.qty" >

                      <small class="text-danger" v-if="errors.qty"> {{errors.qty[0]}} </small>
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
            qty:''
          },
          errors:{

          },
         
      }
  },methods:{

    
    updateProduct()
    {
        let id = this.$route.params.id
        axios.post('/api/quantity/update/'+id,this.form)
        .then(()=> {
            Toastermsg.successmsg('Updated Successfully')
            this.$router.push({name:'stock'})
        })
        .catch(error =>this.errors = error.response.data.errors)

    }


  }, created(){
      let id = this.$route.params.id
      axios.get('/api/products/'+id)
      .then(({data})=> (this.form = data))
      .catch( console.log('error'))

      

  }}
</script>

