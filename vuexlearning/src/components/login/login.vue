<template>
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
              <!-- <v-text-field
                v-model="email"                   
                color="purple darken-2"
                label="Email"
                type="email"
                required
                class="login-page-text-field"
              ></v-text-field> -->
              <!-- <v-text-field
                v-model="password"          
                color="blue darken-2"
                label="Password"
                type="password"
                required
                class="login-page-text-field"
              ></v-text-field> -->
              <v-text-field
                v-model="email"
                outlined
                label="Email"
                placeholder="john@example.com"
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
                <a
                  href="javascript:void(0)"
                  class="mt-1"
                >
                  Forgot Password?
                </a>
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
              >
                Login
              </v-btn>
               
              <v-spacer></v-spacer>
            </v-card-actions>
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
                class="mt-1"
                @click="dialog = true"
              >
                Register
              </v-btn>
              
              <v-spacer></v-spacer>
            </v-card-actions>
           
        <Register :dialog="dialog" @close="close()" />
        <Test :dialog="dialog1" @close="close()" />

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
</template>





<script>
import Register from './dialogs/register.vue'
import Test from './dialogs/test.vue'
import logo from '@/assets/images/logo.png'
import { login } from "@/repositories/user.api";
import { mdiEyeOutline, mdiEyeOffOutline } from '@mdi/js'
    
export default {
   components : {
      Register,
      Test
   },
    data(){
        return {
            timeout: 1400,
            dialog: false,
            dialog1: false,
            logo,
            email: '',
            password: '',
            snackbar:false,
            isPasswordVisible: false,
            icons: {
              mdiEyeOutline,
              mdiEyeOffOutline,
            },
     
        }
    },
    
    methods: {
      Login() {
          
                const login_data = {
                    email: this.email,
                    password: this.password
                }
              
                  login(login_data).then(({data}) => {
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
            close() {
              this.dialog = false;
              this.dialog1 = false;
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

