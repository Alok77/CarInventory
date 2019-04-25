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

                     <div v-if="detailmodal">
                     <div class="modal-mask">
                     <div class="modal-wrapper">
                     <div class="modal-container">
                     <div class="modal-body">
                       <slot name="body">
                       <h2>Details Car </h2>
                     <div class="container-fluid">
          
                       <button @click="hidedetail()" style="position:absolute; top:0; right:0;">X</button>
                      <div class="fan-col1">

                              <div v-for="data in detaildata">
                                  <div class="">
                                    <div style="background-color:silver">
                                      <div class="thumbnail">
                                        <div class="media-body "v-for="img in data.images">
                                           <img :src="'/images/'+img.image" height="130px">
                                         </div>
                                          <h2>{{data.manufacturer.Name}}</h2>
                                             <b>ModelName: {{data.ModelName}}</b><br>
                                             <b>Color : {{data.color}}</b><br>
                                             <b>count: {{data.count}}</b><br>
                                             <b>ManufactureYear:{{data.ManufactureYear}}</b><br>
                                             <button class="btn-danger">Sold</button><br>
                                             
                                         </div>
                                        </div><br>
                                       </div></div>
                               

                                   </div></div>
                         </slot>
                      </div>
                      <div class="modal-footer">
                        <slot name="footer">
                        <label for="default" value="C" align="right" class="round-buttons1 btn-success" @click="hidedetail()">Close</label>
                        </slot>
                        </div>
                       </div></div></div>
                      
                     </div>


                    <div class="card-body">
                      <button class="btn btn-success" @click="show()">AddManufacturer</button>          <button class="btn btn-success" @click="show1">AddModel</button>
                    </div>
                    
                    <div class="card-body">

  <div class="container">
  <h2>Car List</h2>
            
  <table class="table">
    <thead>
      <tr>
        <th>Manufacturer</th>
        <th>Model</th>
        <th>count</th>
        <th>Details</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="data in data">
        <td>{{data.manufacturer.Name}}</td>
        <td>{{data.ModelName}}</td>
        <td>{{data.count}}</td>
        <td><button class="btn-danger" @click="Details(data.id)">Details</button></td>
      </tr>
     
    </tbody>
  </table>
  </div>


                       </div>
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
 return { data: [], detailmodal: false,detaildata: '', showmodal: false, showmodalCar : false, imagepath: "http://127.0.0.1:8000/public/images/"};
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
  Details(id){
  this.detailmodal = true;
  let url = 'http://127.0.0.1:8000/api/data/'+id;
  axios.get(url).then((response) => {
  console.log(response.data);
  this.detaildata = response.data;
  });
  },
  hidedetail(){
   this.detailmodal = false;
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
