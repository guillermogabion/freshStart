<template>
  <div class="login-page">
      <v-btn
            icon
            dark
          >
            <v-icon>mdi-close</v-icon>
          </v-btn>
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
            
            <v-tabs
              v-model="tab"
              background-color="transparent"
              color="basil"
              grow
              class="padd"
            >
              <v-tab
                v-for="item in items"
                :key="item"
              >
                {{ item }}
              </v-tab>
            </v-tabs>
            <v-card>
              <v-tabs-items v-model="tab">
              <!-- email login  -->
                <v-tab-item>
                  <v-card
                  class="v-card-padding"
                  >
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
                      </div>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                    
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
                    
            
                  </v-card>
                </v-tab-item>
                <!-- ID login  -->
                <v-tab-item>
                  <v-card
                  class="v-card-padding"
                  >
                    <v-text-field
                      v-model="idnumber"
                      outlined
                      label="ID Number"
                      hide-details
                      class="mb-3 px-3"
                    ></v-text-field>
                    <v-text-field
                      v-model="passwordID"
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
                    </div>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    
                    <v-btn
                      block
                      color="primary"
                      class="mt-6"
                      @click = "LoginID()"
                    >
                      Login
                    </v-btn>
                  </v-card-actions>
                  </v-card>
                </v-tab-item>
              </v-tabs-items>
              <v-card-actions>
                <v-spacer></v-spacer>
              
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
            </v-card>
                  
        <Register :dialog="dialog" @close="close()" />
        <Test :dialog="dialog1" @close="close()" />
        <ID :dialog="dialog2" @close="close()" />

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
import ID from './dialogs/id.vue'
import Test from './dialogs/test.vue'
import logo from '@/assets/images/logo.png'
import { login } from "@/repositories/user.api";
import { loginID } from "@/repositories/user.api";
import { mdiEyeOutline, mdiEyeOffOutline } from '@mdi/js'
    
export default {
   components : {
      Register,
      Test,
      ID
   },
    data(){
        return {
            tab: null, 
            timeout: 1400,
            dialog: false,
            dialog1: false,
            dialog2: false,
            logo,
            email: '',
            password: '',
            passwordID: '',
            snackbar:false,
            isPasswordVisible: false,
            icons: {
              mdiEyeOutline,
              mdiEyeOffOutline,
            },
            items: [
              'Email', 'ID Number',
            ],
     
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
        },
        LoginID() {
          const login_data = {
            id_number: this.idnumber,
            password: this.passwordID
          }
          loginID(login_data).then(({data}) => {
            localStorage.setItem('token', data.access_token)
            this.$router.push({ name: "dashboard"});
          }).catch((errors)=> {
            console.log(errors)
            this.snackbar = true
          })
        },
        close() {
          this.dialog = false;
          this.dialog1 = false;
          this.dialog2 = false;
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
.display {
   min-width: 0;
}
.padd {
  padding-bottom: 1em;
}
.v-card-padding {
  padding-top: 1em;
}



</style>

