
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
          <h1 class="h4 text-gray-900 mb-4">Add Products</h1>
      </div>
      <form class="user" @submit.prevent="addProduct" enctype="multipart/form-data">
          <div class="form-row">
              <div class="col-md-6">
          <div class="form-group">
              <label> Product Name </label>
                  <input type="text" class="form-control form-control-user" id="exampleFirstName"
                      placeholder="Full Name" v-model="form.name" >

     <small class="text-danger" v-if="errors.name"> {{errors.name[0]}} </small>

              </div>
              </div>
             <div class="col-md-6">
          <div class="form-group">
               <label> Product Code </label>
              <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                  placeholder="Product Code" v-model="form.code" >

                  <small class="text-danger" v-if="errors.code"> {{errors.code[0]}} </small>


          </div>
             </div>
          </div>


 <div class="form-row">
              <div class="col-md-6">
                  
                   <div class="form-group">
    <label for="exampleFormControlSelect1">Category</label>
    <select class="form-select" aria-label="Default select example" v-model="form.category_id">
  <option selected disabled value="">Select Category</option>
        <option :value="category.id" :key="category.id" v-for="category in categories"  >{{category.name}}</option>

    </select>
  </div>

      <small class="text-danger" v-if="errors.category_id"> {{errors.category_id[0]}} </small>
              
              </div>



                 <div class="col-md-6">
                  
                   <div class="form-group">
    <label for="exampleFormControlSelect1">Supplier</label>
      <select class="form-select" aria-label="Default select example" v-model="form.supplier_id">
  <option selected disabled value="">Select Supplier</option>

          <option :value="supplier.id" :key="supplier.id" v-for="supplier in suppliers" >{{supplier.name}}</option>

    </select>
  </div>

      <small class="text-danger" v-if="errors.supplier_id"> {{errors.supplier_id[0]}} </small>
              
              </div>
           

          </div>






           <div class="form-row">
              <div class="col-md-6">
          <div class="form-group">
              <label> Purchase price </label>
                  <input type="text" class="form-control form-control-user" id="exampleFirstName"
                      placeholder="purchase price" v-model="form.purchase_price" >

                      <small class="text-danger" v-if="errors.purchase_price"> {{errors.purchase_price[0]}} </small>
              </div>
              </div>
             <div class="col-md-6">
          <div class="form-group">
                          <label> Selling price </label>
              <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                  placeholder="Selling Price" v-model="form.selling_price" >

                  <small class="text-danger" v-if="errors.selling_price"> {{errors.selling_price[0]}} </small>


          </div>
             </div>
          </div>

           <div class="form-row">
              <div class="col-md-6">
          <div class="form-group">
                      <label> Purchase Date </label>
                  <input type="text" placeholder="Purchase Date" class="form-control form-control-user" onfocus="(this.type='date')"
                  v-model="form.purchase_date" id="date">

                  <small class="text-danger" v-if="errors.purchase_date"> {{errors.purchase_date[0]}} </small>
              </div>
              </div>
             <div class="col-md-6">
          <div class="form-group">
              <label> Product Quantity </label>
              <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                  placeholder="Quantity" v-model="form.qty">

                  <small class="text-danger" v-if="errors.qty"> {{errors.qty[0]}} </small>


          </div>
             </div>
          </div>

        

            <div class="form-row">
              <div class="col-md-6">
          <div class="form-group">
<input class="form-control" accept="image/*" type="file" @change="fileSelected"  id="formFileMultiple" required >


<small class="text-danger" v-if="errors.image"> {{errors.image[0]}} </small> 


              </div>
              </div>

  <div class="col-md-6">
          <div class="form-group">

        <img :src="form.image" style="height: 40px; width: 40px;">
        <small> Product Image </small>
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
              name: null,
              code: null,
              qty: null,
              purchase_price: null,
              selling_price: null,
              purchase_date: null,
              category_id: '',
              supplier_id: '',
              image: null
          },
          errors:{

          },
          categories:{

          },
          suppliers:{

          }
      }
  },methods:{

      fileSelected(event)
      {
         let file = event.target.files[0];
         let reader = new FileReader();

         reader.onload = event => {
            
            this.form.image = event.target.result

            console.log(event.target.result)

         };

         reader.readAsDataURL(file);
      },
      addProduct()
      {
          axios.post('/api/products',this.form)
       .then(() =>{ 
         Toastermsg.successmsg('Added Successfully')
        this.$router.push({ name: 'products'})
       })
          .catch(error => this.errors = error.response.data.errors)
      }


  },created(){
      axios.get('/api/category/get')
      .then(({data}) => this.categories = data)

      axios.get('/api/supplier/get')
      .then(({data}) => this.suppliers = data)
  }
  
}
</script>