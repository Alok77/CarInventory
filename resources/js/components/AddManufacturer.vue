<template>
<div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">
          <div class="modal-body">
            <slot name="body">
            <h2>Create Manufacturer</h2>
            <div class="container-fluif">
            <p v-if="Errors.length">
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="error in Errors">{{ error }}</li>
    </ul>
    </p>

      <button @click="hide()" style="position:absolute; top:0; right:0;">X</button>
<div class="fan-col1">
 <div class="form-group">
<label class="col-md-10 col-md-offset-1">Manufacturer Name</label>
<div class="col-md-10 col-md-offset-1">
<input type="text"  v-validate="'required'" style="width:80%;"   v-model="name" placeholder="Manufacturer Name" required/>
</div></div>


<div class="form-group">
<div class="col-md-12 col-md-offset-1">
<button class="btn btn-success" v-on:click="submit()">Create</button>
</div></div>

</div></div>
            </slot>
          </div>
 <div class="modal-footer">
            <slot name="footer">
              <label for="default" value="C" align="right" class="round-buttons1 btn-success" @click="hide()">Close</label>
            </slot>
          </div>
</div></div></div>
</template>
<script>
import Vue from 'vue';
import VeeValidate from 'vee-validate';
 import VueNoty from 'vuejs-noty';
  import 'vuejs-noty/dist/vuejs-noty.css'
import axios from 'axios';
Vue.use(VeeValidate);
export default {
  data () {
    return { name: '',Errors: [],}
    },
    methods: {
    submit(){

    this.Errors = [];
 if (!this.name ) {
        this.Errors.push('Please Fill All the required Field.');
      }else {
      let url = 'http://127.0.0.1:8000/api/CreateManufacturer';
      let formData = new FormData();
      formData.append('name', this.name);
      axios.post(url, formData).then((response) => {
console.log(response.data);
this.$parent.showmodal = false;

this.$noty.warning('Manufacturer Has Been Added Succesfully', {
  killer: true,
  timeout: 600,
  layout: 'topRight'
});
});


      }
    },
    hide(){
     this.$parent.showmodal = false;
    },
    show(){

    },

    },
    }
</script>