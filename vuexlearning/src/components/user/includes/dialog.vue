<template>
    <v-dialog
    transition="dialog-top-transition"
    v-model="dialog"
    persistent
    width="29%"
    >
    <v-form
            ref="form"
            lazy-validation
            v-model="valid"
            class="padding"
        >
      <v-card>
             <v-toolbar
                color="Green"
                dark
                >
                Add New Enrollee 
             </v-toolbar>
            <div class="card-text-input">
                    <v-flex xs10>
                        <v-text-field
                            v-model = "payload.lastname"
                            label="Last Name"
                            required
                            :rules="lastnameRules"
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs10>
                        <v-text-field
                            v-model = "payload.firstname"
                            label="First Name"
                            required
                            :rules="firstnameRules"
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs10>
                        <v-text-field
                            v-model = "payload.guardian"
                            label="Guardian"
                            required
                            :rules="firstnameRules"
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs10>
                        <v-text-field
                            v-model = "payload.religion"
                            label="First Name"
                            required
                            :rules="firstnameRules"
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs10>
                        <v-text-field
                            v-model = "payload.civil_status"
                            label="First Name"
                            required
                            :rules="firstnameRules"
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs10>
                        <v-text-field
                            v-model = "payload.email"
                            label="Email"
                            required                           
                            :rules="emailRules"
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs10>
                        <v-text-field
                            v-model = "payload.phone"
                            label="Phone Number (Ex. 92564563)"
                            required
                            :counter="8"
                            :rules="phoneRules"
                            type="number"
                        ></v-text-field>
                    </v-flex>
                     <v-flex xs10>
                        <v-select dense v-model="types" :items="user_type" item-text="type"  item-value="number"
                            persistent-hint return-object prepend-icon="mdi-map" label="User Type">
                        </v-select> 
                        <span style="font-size: 10px;">password (Default password for New User)</span>   
                    </v-flex>
                </div>
        
        <v-card-actions>
            <v-spacer></v-spacer>
            <div class="card-text-button">
                <v-btn
                    color="#06aed5"
                    class="mb-2"
                    dark   
                    @click.prevent ="savenew()"  
                    :disabled="!valid"        
                >
                    Save
                </v-btn>
            </div>
            <div card-text-button>
                <v-btn
                    color="#06aed5"
                    class="mb-2"
                    dark
                    @click = "close()"
                >
                    Close
                </v-btn>
            </div>
            <v-spacer></v-spacer>
        </v-card-actions>
     </v-card>
    </v-form>
     <v-snackbar
    v-model="snackbar"
    :timeout="timeout"
    color="success"
    top 
    right
    >
      New User Added
    </v-snackbar>
    </v-dialog>
   
</template>
<script>
// import axios from '@/plugins/axios'
 import { addUsers } from '@/repositories/user.api'
 export default {
    data() {
        return {
            user_type:[
                {type: 'Client', number:'0', icon:'mdi-alert-circle'},
                {type: 'Administrator', number:'1', icon:'mdi-alert-circle'},
            ],
             payload: {
                lastname: '',
                firstname: '',
                email: '',
                phone: '',
                user_type: '',
            },
            snackbar: false,
            timeout: 1400,
            valid: true,
             firstnameRules: [
            v => !!v || 'First Name is required',
        
            ],
            lastnameRules: [
            v => !!v || 'Last Name is required',
         
            ],
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
            ],
             phoneRules: [
            v => !!v || 'Phone is required',
            v => (v && v.length <= 8) || 'Phone Number must be less than 9 characters',
            ],
            types: {type: 'Client', number:'0', icon:'mdi-alert-circle'},
           
        }
    },
    methods: {
        savenew(){
            // console.log(this.payload.user_type.number)
            this.payload.user_type = this.types.number
            // console.log(this.payload.user_type)
            addUsers(this.payload).then(({response}) => {
              console.log(response)
               this.$emit('reload')
               this.snackbar = true
               this.clearInput()
               this.reset()
            })
        },
        clearInput(){
            this.payload.lastname = ''
            this.payload.firstname = '' 
            this.payload.email = ''
            this.payload.phone = ''
            this.types = ''
        },
        close(){
             this.$emit('close')
        },
        reset(){
            this.$refs.form.resetValidation()
        },
    },
     props: {
        dialog:{
            required: true,
            type: Boolean,
            default: false
        },
        id:{
            type:Number,
        }
    },
  
 }
</script>

<style>
    .card-text{
        padding-top: 5%; 
        padding-left: 5%;
    }
    .card-text-item {
        font-size: 150%;
    }
    .card-text-input {
        padding-left: 15%;
    }
    .card-text-button {
        padding-right: 3%;
        padding-left: 3%;
    }
    
</style>