<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">CarInventory System</div>
                     <div v-if="showmodal">
                      <AddManufacturer></AddManufacturer>
                     </div>
                     <div v-if="showmodalCar">
                      <AddModel></AddModel>
                     </div>

                    <div class="card-body">
                      <button class="btn btn-success" @click="show()">AddManufacturer</button>          <button class="btn btn-success" @click="show1">AddModel</button>
                    </div>
                    
                    <div class="card-body">
                        <div class="col-md-12 col-sm-12">
                    <div v-for="data in data">
                    
                                <div class="col-md-3 col-sm-6">
                    <div style="background-color:silver">
              <div class="thumbnail">
               <div class="media-body "v-for="img in data.images">
               <img :src="'/images/'+img.image" height="130px">
               </div>
               <h2>{{data.manufacturer.Name}}</h2>
               {{data.ModelName}}
               <button class="btn btn-xs btn-default">Sold</button>
                 </div>
              </div><br>

              </div></div>
                    </div></div>
                    

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue';
import axios from 'axios';
 import AddManufacturer from './AddManufacturer.vue';
 import AddModel from './AddModel.vue';
    export default {
              data(){
 return { data: [], showmodal: false, showmodalCar : false, imagepath: "http://127.0.0.1:8000/public/images/"};
       },

created: function(){
    this.getdata();
},
methods: {
  getdata(){
  let url = 'http://127.0.0.1:8000/api/data';
  axios.get(url).then((response) => {
  console.log(response.data);
  this.data = response.data;
});
  },
  show(){
   this.showmodal = true;
  },
  show1 (){
  this.showmodalCar = true;
  },  

},
components:{
    
AddManufacturer,AddModel
},
        
    }
</script>
