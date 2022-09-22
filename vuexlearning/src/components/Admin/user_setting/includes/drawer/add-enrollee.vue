<template>
    <div>
   
        <v-card
        
        >
            <v-card-title class="text-h5 grey lighten-2 mb-2">
                Profile
            </v-card-title>

            <v-row no-gutters>
                <v-col>
                    <v-card
                    class="pa-2"
                    outlined
                    tile
                    >
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
                            v-model="payload.date_birth"
                            outlined
                            label="Date of Birth"
                            placeholder="12/12/12"
                            hide-details
                            class="mb-3 px-3"
                            v-validate="'required'"
                            :error-messages="errors.collect('Date of Birth')"
                            data-vv-name="Date of Birth"
                        ></v-text-field>
                        <v-text-field
                            v-model="payload.nationality"
                            outlined
                            label="Nationality"
                            placeholder="Ex. Filipino"
                            hide-details
                            class="mb-3 px-3"
                            v-validate="'required'"
                            :error-messages="errors.collect('Nationality')"
                            data-vv-name="Nationality"
                        ></v-text-field>
                        <v-text-field
                            v-model="payload.address"
                            outlined
                            label="Address"
                            hide-details
                            class="mb-3 px-3"
                            v-validate="'required'"
                            :error-messages="errors.collect('Address')"
                            data-vv-name="Address"
                        ></v-text-field>
                        <v-text-field
                            v-model="payload.contact"
                            outlined
                            label="Contact"
                            hide-details
                            class="mb-3 px-3"
                            v-validate="'required'"
                            :error-messages="errors.collect('Contact')"
                            data-vv-name="Contact"
                        ></v-text-field>
                        <v-select 
                            class="mb-1 px-3"
                            style="padding-bottom: 8px;"
                            v-model="types_status"               
                            hide-details 
                            :items="status" 
                            item-text="type"  
                            item-value="status_type"
                            persistent-hint
                            return-object
                            outlined 
                            label="Status"
                            v-validate="'required'"
                            :error-messages="errors.collect('Status')"
                            data-vv-name="Status"
                            />
                        <v-text-field
                            v-model="payload.guardian"
                            outlined
                            label="Parent/Guardian"
                            hide-details
                            class="mb-3 px-3"
                            v-validate="'required'"
                            :error-messages="errors.collect('Guardian')"
                            data-vv-name="Guardian"
                        ></v-text-field>
                    </v-card>
                </v-col>
                <v-col>
                    <v-card
                    class="pa-2"
                    outlined
                    tile
                    >
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
                            v-model="payload.place_birth"
                            outlined
                            label="Place of Birth"
                            hide-details
                            class="mb-3 px-3"
                            v-validate="'required'"
                            :error-messages="errors.collect('Place of Birth')"
                            data-vv-name="Place of Birth"
                        ></v-text-field>
                        <v-text-field
                            v-model="payload.email"
                            outlined
                            label="Email"
                            hide-details
                            class="mb-3 px-3"
                            v-validate="'required'"
                            :error-messages="errors.collect('Email')"
                            data-vv-name="Email"
                        ></v-text-field>
                        <v-select 
                            class="mb-1 px-3"
                            style="padding-bottom: 8px;"
                            v-model="types"               
                            hide-details 
                            :items="gender" 
                            item-text="type"  
                            item-value="gender_type"
                            persistent-hint
                            return-object
                            outlined 
                            label="Gender"
                            v-validate="'required'"
                            :error-messages="errors.collect('Gender')"
                            data-vv-name="Gender"
                             />
                        <v-text-field
                            v-model="payload.course"
                            outlined
                            label="Course/Program"
                            hide-details
                            class="mb-3 px-3"
                            v-validate="'required'"
                            :error-messages="errors.collect('Course')"
                            data-vv-name="Course"
                        ></v-text-field>
                        <v-text-field
                            v-model="payload.year"
                            outlined
                            label="Year"
                            hide-details
                            class="mb-3 px-3"
                            v-validate="'required'"
                            :error-messages="errors.collect('Year')"
                            data-vv-name="Year"
                        ></v-text-field>
                        <v-text-field
                            v-model="payload.contact_guardian"
                            outlined
                            label="Guardian Contact Number"
                            hide-details
                            class="mb-3 px-3"
                            v-validate="'required'"
                            :error-messages="errors.collect('Guardian')"
                            data-vv-name="Guardian"
                        ></v-text-field>
                        <!-- <v-text-field
                        v-model="payload.password"
                        outlined
                        :type="isPasswordVisible ? 'text' : 'password'"
                        :append-icon="isPasswordVisible ? icons.mdiEyeOffOutline : icons.mdiEyeOutline"
                        hide-details
                        @click:append="isPasswordVisible = !isPasswordVisible"
                        class="mb-3 px-3"
                        v-validate="'required|min:8'" 
                        :error-messages="errors.collect('Password')"
                        data-vv-name="Password"
                        ></v-text-field> -->
                    </v-card>

                </v-col>
                <v-col>
                    <v-card
                    class="pa-2 justify-center"
                    outlined
                    tile
                    >
                        <div class="js--image-preview" style="margin: auto; padding-left: 12%; ">
                            <v-img
                                
                                style="width: 300px; height: 300px;"
                                :src="payload.photo || logo"
                            ></v-img>
                        </div>
                        <div class="upload-options" required style="padding-top: 5px;">
                            <label>
                                <input
                                    id="fileData"
                                    type="file"
                                    @change="onFileChange"
                                    style="padding-left: 20%;"
                                />
                            </label>
                        </div>
                    
                    <v-text-field
                        v-model="id"
                        outlined
                        label="Id Number"
                        hide-details
                        readonly
                        class="mb-3 px-3 mt-6"
                        v-validate="'required'"
                        :error-messages="errors.collect('ID Number')"
                        data-vv-name="ID Number"
                        style="padding-top: 49px;"
                    ></v-text-field>
                        
                     
                    </v-card>

                </v-col>
            </v-row>
           
          
                
                
                

                <v-card-actions>
                  <v-spacer />
                  <v-btn
                    :disabled="!valid"
                    color="success"
                    class="mr-4"
                    @click="new_admission()"
                  >
                    Register
                  </v-btn>
                  <v-btn
                    :disabled="!valid"
                    color="success"
                    class="mr-4"
                    @click="generate()"
                  >
                   Generate ID
                  </v-btn>
                  <v-spacer />
                </v-card-actions>

            
        </v-card>
    </div>
</template>
<script>
    import { mdiEyeOutline, mdiEyeOffOutline } from '@mdi/js'
    import {GenerateID, AddNew} from '@/repositories/registrar.api.js'
    import logo from '@/assets/images/profile.jpg'

    export default {
        data(){
        return {
            isPasswordVisible: false,
            valid: true,
            types: '',
            types_status: '',
            id:'',
            logo,
            
            payload: {
                photo:'',
                firstname : '',
                lastname : '',
                email : '',
                password : "password",
                gender: '',
                date_birth: '',
                nationality: '',
                address: '',
                contact: '',
                guardian: '',
                place_birth: '',
                course: '',
                year: '',
                contact_guardian: '',
                },
            icons: {
                mdiEyeOutline,
                mdiEyeOffOutline,
                },
            gender :[
                {type: 'Male', gender_type: 'male', icon:'mdi-alert-circle'  },
                {type: 'Female', gender_type: 'female', icon:'mdi-alert-circle'  }
            ],
            status :[
                {type: 'Single', status_type: 'single', icon:'mdi-alert-circle'  },
                {type: 'Married', status_type: 'married', icon:'mdi-alert-circle'  },
                {type: 'Widowed', status_type: 'widowed', icon:'mdi-alert-circle'  }
            ],
        }
        
        },
        mounted() {
            this.generate()
        },
        methods: {
            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                this.createImg(files[0]);
            },
            createImg(file){
                // var image = new Image;
                var reader = new FileReader; 
                reader.onload = (e) => {
                    this.payload.photo = e.target.result;
                    };
                reader.readAsDataURL(file)
            },

            generate(){
                GenerateID().then(res=>{
                    console.log(res)
                    this.id = res.data
                })
            },
            new_admission(){
                this.payload.civil_status = this.types_status.status_type
                this.payload.gender = this.types.gender_type
                this.payload.id_number = this.id
                // let payload = this.payload
                this.$validator.validateAll().then(result=> {
                    if(result) {
                    AddNew(this.payload).then(({response})=>{
                        console.log(response)
                    })
                    }
                })

                
            }
        },
        
    }
</script>
<style>
    .width {
        width: 200%;
    }
</style>