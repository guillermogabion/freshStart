<template>
<v-dialog
    v-model="dialog"
    fullscreen
    hide-overlay
    transition="dialog-top-transition"
>
<v-card
   
>
    <v-btn
            icon
            dark
          >
            <v-icon>mdi-close</v-icon>
          </v-btn>
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
            </v-list-item
            
            >
           
              <v-text-field
                v-model="idnumber"
                outlined
                label="ID Number"
                hide-details
                class="mb-3 px-3"
              ></v-text-field>
              <v-text-field
                v-model="password"
                outlined
                :type="isPasswordVisible ? 'text' : 'password'"
                label="Password"
                placeholder="············"
                :append-icon="isPasswordVisible ? icons.mdiEyeOffOutline : icons.mdiEyeOutline"
                hide-details
                @click:append="isPasswordVisible = !isPasswordVisible"
                 class="mb-3 px-3"
              ></v-text-field>
              <div class="d-flex align-center justify-space-between flex-wrap px-3">
                <v-checkbox
                  label="Remember Me"
                  hide-details
                  class="me-3 mt-1"
                >
                </v-checkbox>

                <!-- forgot link -->
                <v-btn
                small 
                text
                class="display"
                 @click="close()"
                >
                Login with Email
                </v-btn>
              </div>
            <v-card-actions>
              <v-spacer></v-spacer>
              <!-- <v-btn
                outlined  
                @click="Login()"
                color="primary"
              >
                Login
              </v-btn> -->
              <v-btn
                block
                color="primary"
                class="mt-6"
                @click = "Login()"
              >
                Login
              </v-btn>
               
              <v-spacer></v-spacer>
            </v-card-actions>
            <v-card-actions>
              <v-spacer></v-spacer>
             
              
              
              <v-spacer></v-spacer>
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
</v-card>
</v-dialog>
</template>
<script>
import logo from '@/assets/images/logo.png'
import { loginID } from "@/repositories/user.api";
import { mdiEyeOutline, mdiEyeOffOutline } from '@mdi/js'
export default {
    data() {
        return {
            timeout: 1400,
            idnumber: '',
            password: '',
            logo,
            snackbar:false,
            isPasswordVisible: false,
            icons: {
              mdiEyeOutline,
              mdiEyeOffOutline,
            },
        }
        
    },
    props : {
        dialog : {
            required: true,
            type : Boolean,
            default: false
        },
        id: {
            type:Number,
        }
    },
    methods: {
        Login() {
          
                const login_data = {
                    idnumber: this.idnumber,
                    password: this.password
                }
                  loginID(login_data).then(({data}) => {
                      // this.$store.commit('login', data)
                      localStorage.setItem('token', data.access_token)
                      this.$router.push({ name: "dashboard"});
                  }).catch((errors)=> {
                      console.log(errors)
                     this.snackbar = true
                     
                  })
                        
                    

                // if(this.email == '123@12.com' && this.password == '123'){
                //   this.$router.push({ name: "dashboard" });
                // }
              
            },
         close(){
        this.$emit('close')
      },
    },
}
</script>

<style>
.login-page {

  padding-top : 6em;
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
