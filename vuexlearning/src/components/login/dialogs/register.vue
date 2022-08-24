<template>
<v-dialog
    v-model="dialog"
    fullscreen
    hide-overlay
    transition="dialog-top-transition"
>
  <div class="login-page">
        <v-card
          class="mx-auto"
          max-width="380"
        >
            <v-list-item three-line>
              <v-list-item-content
              class="d-flex align-center justify-center py-7"
              >
                <v-img
                  :src="require('@/assets/images/logos/logo.svg')"
                  
                  max-height="130px"
                  max-width="150px"
                  alt="logo"
                ></v-img>
              </v-list-item-content>
            </v-list-item>
          

              <v-text-field
                v-model="payload.firstname"
                outlined
                label="First Name"
                placeholder="John"
                hide-details
                class="mb-3 px-3"
                v-validate="'required'"
                :error-messages="errors.collect('First Name')"
                data-vv-name="First Name" 
              >
              </v-text-field>
              <v-text-field
                v-model="payload.lastname"
                outlined
                label="Last Name"
                placeholder="Doe"
                hide-details
                class="mb-3 px-3"
                v-validate="'required'"
                :error-messages="errors.collect('Last Name')"
                data-vv-name="Last Name"
              ></v-text-field>
               <v-text-field
                v-model="payload.phone"
                outlined
                label="Phone"
                placeholder="+639525565345"
                hide-details
                class="mb-3 px-3"
                v-validate="'required|length:11'"
                :error-messages="errors.collect('Phone Number')"
                data-vv-name="Phone Number"
                maxlength="11"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                autocomplete="off"
              ></v-text-field>
              <v-text-field
                v-model="payload.email"
                outlined
                label="Email"
                placeholder="john@example.com"
                hide-details
                class="mb-3 px-3"
                v-validate="'required|email'"
                :error-messages="errors.collect('Email')"
                data-vv-name="Email"
              ></v-text-field>

              <v-text-field
                v-model="payload.password"
                outlined
                :type="isPasswordVisible ? 'text' : 'password'"
                label="Password"
                placeholder="············"
                :append-icon="isPasswordVisible ? icons.mdiEyeOffOutline : icons.mdiEyeOutline"
                hide-details
                @click:append="isPasswordVisible = !isPasswordVisible"
                 class="mb-3 px-3"
                 v-validate="'required|min:8'" 
                :error-messages="errors.collect('Password')"
                data-vv-name="Password"
              ></v-text-field>
              <v-card-actions>
                <v-spacer />
                <v-btn
                  :disabled="!valid"
                  color="success"
                  class="mr-4"
                  @click="register()"
                >
                  Register
                </v-btn>
                 <v-spacer />
              </v-card-actions>
        </v-card>
      
        <v-snackbar
          v-model="snackbar"
          :timeout="timeout"
          color="error"
          top 
          right
          >
          Error Credentials, Please try Again
        </v-snackbar>
  </div>
  </v-dialog>
</template>
<script>
    import logo from '@/assets/images/logo.png'
    // import { required, minLength, maxLength, between } from 'vuelidate'
    // import { Register } from "@/repositories/user.api";
    import { mdiEyeOutline, mdiEyeOffOutline } from '@mdi/js'
    import axios from '@/plugins/axios'
export default {
    data(){
        return {
            timeout: 1400,
            valid: true,
            logo,
            email: '',
            password: '',
            snackbar:false,
            isPasswordVisible: false,
            icons: {
              mdiEyeOutline,
              mdiEyeOffOutline,
            },
            payload: {
              firstname : '',
              lastname : '',
              phone : '',
              email : '',
              password : ''
            },
           
        }
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
    methods: {
      register(){

        this.$validator.validateAll().then(result => {
          if(result) {
            axios.post('UserRegistration', this.payload).then(({data}) => {
              console.log(data)
              // this.$store.commit('UPDATE_NEW', true)
              // this.dialog = true
              // this. clearInput();
              // this.closeUsersCreate()
            }).catch((error)=> {
              console.log(error)
              // this.dialog_alert = true
            });
          }
        });
      
       

        // this.$validator.validateAll().then(result => {
        //   if(result){
        //     let payload = this.payload
        //     Register(payload).then((res)=> {
        //        console.log(res)
        //        this.$emit('close')

        //     })
        //   }
        // });
        // let payload = this.payload
        // Register(payload).then((res)=> {
        //    console.log(res)
        //    this.$emit('close')

        // })
      }
       
    }
}



</script>

<style>
.login-page {

  padding-top : 10em;
}
.login-page-text-field{
  padding: 0.5em;
}
.login-page-text-button {
  padding-left: 3em;
  padding-right: 3em;
}
.login-page-title{
  padding-left: 6.5em;
}
.padding{
  padding-left: 10%;
  padding-right: 10%;
}



</style>

