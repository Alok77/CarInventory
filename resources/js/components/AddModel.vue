<template>
<div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">
          <div class="modal-body">
            <slot name="body">
            <h2>Create Car Model</h2>
            <div class="container-fluif">
            <p v-if="Errors.length">
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="error in Errors">{{ error }}</li>
    </ul>
    </p>

      <button @click="hide1()" style="position:absolute; top:0; right:0;">X</button>
<div class="fan-col1">

 <div class="form-group">
<label class="col-md-10 col-md-offset-1">Manufacturer</label>
<div class="col-md-10 col-md-offset-1">
<select v-model="SelectCategory" required>
<option disabled value="">Please Select One</option>
<option v-for="service in Services" :value="service.id">{{service.Name}}</option>
</select>
</div></div>

 <div class="form-group">
<label class="col-md-10 col-md-offset-1">Car Model Name</label>
<div class="col-md-10 col-md-offset-1">
<input type="text"  v-validate="'required'" style="width:80%;"   v-model="name" placeholder="Model Name" required/>
</div></div>

 <div class="form-group">
<label class="col-md-10 col-md-offset-1">Car Color</label>
<div class="col-md-10 col-md-offset-1">
<input type="text"  v-validate="'required'" style="width:80%;"   v-model="color" placeholder="Car Color" required/>
</div></div>

 <div class="form-group">
<label class="col-md-10 col-md-offset-1">Car Manufacture year</label>
<div class="col-md-10 col-md-offset-1">
<input type="text"  v-validate="'required'" style="width:80%;"   v-model="year" placeholder="Manufacture year" required/>
</div></div>

 <div class="form-group">
<label class="col-md-10 col-md-offset-1">Car Registration Number</label>
<div class="col-md-10 col-md-offset-1">
<input type="text"  v-validate="'required'" style="width:80%;"   v-model="registernumber" placeholder="Car Registration Number" required/>
</div></div>

 <div class="form-group">
<label class="col-md-10 col-md-offset-1">Car count</label>
<div class="col-md-10 col-md-offset-1">
<input type="text"  v-validate="'required'" style="width:80%;"   v-model="count" placeholder="Number of Car count" required/>
</div></div>

<div class="form-group">
<label class="col-md-10 col-md-offset-1">note/description</label>
<div class="col-md-10 col-md-offset-1">
<input type="text"  v-validate="'required'" style="width:80%;"   v-model="note" placeholder="Note" required/>
</div></div>


<div class="form-group">
<label class="col-md-10 col-md-offset-1">Other File</label>
<div class="col-md-10 col-md-offset-1">
<input type="file" id="files" ref="files" v-on:change="onAudioUpload" class="form-control" multiple="multiple"  enctype="multipart/form-data"/>
</div></div>

<div class="form-group">
<div class="col-md-12 col-md-offset-1">
<button class="btn btn-success" v-on:click="submit1()">Create</button>
</div></div>

</div></div>
            </slot>
          </div>
 <div class="modal-footer">
            <slot name="footer">
              <label for="default" value="C" align="right" class="round-buttons1 btn-success" @click="hide1()">Close</label>
            </slot>
          </div>
</div></div></div>
</template>
<script>
import Vue from 'vue';
import VeeValidate from 'vee-validate';
 import VueNoty from 'vuejs-noty'

Vue.use(VeeValidate);
 import 'vuejs-noty/dist/vuejs-noty.css'
import axios from 'axios';
Vue.use(VeeValidate);
export default {
  data () {
    return { name: '',Errors: [],Services: '', color: '',SelectCategory: '',note: '',count: '',registernumber: '',year: '',image: '',files: []}
    },
    created: function(){
    this.ManufactureList();
    },
    methods: {

          onAudioUpload(){
          let uploadedFiles = this.$refs.files.files;
          this.files = uploadedFiles;
           },

    submit1(){
    this.Errors = [];
 if (!this.name || !this.files) {
        this.Errors.push('Please Fill All the required Field.');
      }else {
      if (!this.name) {
        this.Errors.push('Car Model Name required.');
      }
      if (!this.color) {
        this.Errors.push('Car Color required.');
      }
      if (!this.SelectCategory) {
        this.Errors.push('Select Manufacturer... required.');
      }
      if (!this.registernumber) {
        this.Errors.push('Car Registration Number required.');
      }
      if (!this.year) {
        this.Errors.push('Manufacture year required.');
      }
      if (!this.note) {
        this.Errors.push('Note required.');
      }
      if (!this.count) {
        this.Errors.push('count required.');
      }
      if (!this.files) {
        this.Errors.push('Image required.');
      } else {
      let url = 'http://127.0.0.1:8000/api/CreateCarModel';
      let formData = new FormData();
      formData.append('name', this.name);
      //formData.append('image', this.image);
      formData.append('count', this.count);
      formData.append('note', this.note);
      formData.append('year', this.year);
      formData.append('register', this.registernumber);
      formData.append('color', this.color);
      formData.append('Manufacture_id', this.SelectCategory);
      for( var i = 0; i < this.files.length; i++ ){
          let file = this.files[i];
console.log(file);
          formData.append('files[' + i + ']', file);
        }

      axios.post(url, formData).then((response) => {
console.log(response.data);
this.$parent.showmodalCar = false;
this.$noty.warning('Car Model Has Been Added Succesfully', {
  killer: true,
  timeout: 600,
  layout: 'topRight'
});
});
      }}
    },
   ManufactureList(){
    let url = 'http://127.0.0.1:8000/api/ManufacturerList';
    axios.get(url).then((response) => {
console.log(response.data);
this.Services = response.data;
});
   },
    hide1(){
     this.$parent.showmodalCar = false;
    },
    show(){

    },

    },
    }
</script>