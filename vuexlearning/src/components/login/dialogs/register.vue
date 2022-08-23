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
          max-width="344"
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
            <v-form
            ref="form"
            v-model="valid"
            lazy-validation
            >

              <v-text-field
                v-model="payload.firstname"
                outlined
                label="First Name"
                placeholder="John"
                hide-details
                class="mb-3 px-3"
                :rules="firstnameRules"
              >
              </v-text-field>
              <v-text-field
                v-model="payload.lastname"
                outlined
                label="Last Name"
                placeholder="Doe"
                hide-details
                class="mb-3 px-3"
                :rules="lastnameRules"
              ></v-text-field>
               <v-text-field
                v-model="payload.phone"
                outlined
                label="Phone"
                placeholder="+639525565345"
                hide-details
                class="mb-3 px-3"
                :rules="phoneRules"
              ></v-text-field>
              <v-text-field
                v-model="payload.email"
                outlined
                label="Email"
                placeholder="john@example.com"
                hide-details
                class="mb-3 px-3"
                :rules="emailRules"
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
                 :rules="passwordRules"
              ></v-text-field>
              <v-btn
                :disabled="!valid"
                color="success"
                class="mr-4"
                @click="register()"
              >
                Register
              </v-btn>
            </v-form>
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
            firstnameRules: [
              v => !!v || 'First Name is required',
            ],
            lastnameRules: [
              v => !!v || 'Last Name is required',
            ],
            phoneRules: [
              v => (v && v.length == 11) || 'Number must be 11 characters',
            ],
            emailRules: [
              v => !!v || 'E-mail is required',
              v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
            ],
            passwordRules: [
              v => (v && v.length >= 8) || 'Password must be more than 8 characters',
            ],
     
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

        this.$refs.form.validate()
        // .then(result => {
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

