<template>
    <v-dialog
            v-model="dialog"
            persistent
            width="50%"
          >
          <v-card
          width="150%"
          >
            <v-card-title class="text-h5 grey lighten-2 mb-2">
               Edit Profile
            </v-card-title>
            <v-row no-gutters>
                <v-col>
                    <v-card
                    class="pa-3"
                    outlined
                    tile
                    width="auto"
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
                        />
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
                        />
                        <v-text-field
                        v-model="payload.contact"
                        outlined
                        label="Contact"
                        placeholder="+639267876542"
                        hide-details
                        class="mb-3 px-3"
                        v-validate="'required'"
                        :error-messages="errors.collect('Contact')"
                        data-vv-name="Contact" 
                        />
                        <v-text-field
                        v-model="payload.date_birth"
                        outlined
                        label="Date of Birth"
                        hide-details
                        class="mb-3 px-3"
                        v-validate="'required'"
                        :error-messages="errors.collect('Date of Birth')"
                        data-vv-name="Date of Birth" 
                        />
                        <v-text-field
                        v-model="payload.civil_status"
                        outlined
                        label="Status"
                        placeholder="+639267876542"
                        hide-details
                        class="mb-3 px-3"
                        v-validate="'required'"
                        :error-messages="errors.collect('Status')"
                        data-vv-name="Status" 
                        />
                        <v-text-field
                        v-model="payload.course"
                        outlined
                        label="Course"
                        placeholder="+639267876542"
                        hide-details
                        class="mb-3 px-3"
                        v-validate="'required'"
                        :error-messages="errors.collect('Course')"
                        data-vv-name="Course" 
                        />
                        <v-text-field
                        v-model="payload.address"
                        outlined
                        label="Address"
                        hide-details
                        class="mb-3 px-3"
                        v-validate="'required'"
                        :error-messages="errors.collect('Address')"
                        data-vv-name="Address" 
                        />
                        <v-text-field
                        v-model="payload.guardian"
                        outlined
                        label="Guardian"
                        placeholder="+639267876542"
                        hide-details
                        class="mb-3 px-3"
                        v-validate="'required'"
                        :error-messages="errors.collect('Guardian')"
                        data-vv-name="Guardian" 
                        />
                    </v-card>
                </v-col>
                <v-col>
                    <v-card
                    class="pa-2"
                    outlined
                    tile
                    >
                            <div class="js--image-preview" style="margin: auto; padding-left: 20%; ">
                                <v-img
                                    contain
                                    style="width: 250px; height: 200px;"
                                    :src="payload.photo || logo"
                                ></v-img>
                            </div>
                            <div class="upload-options" required style="padding-top: 5px; padding-bottom: 10%;">
                                <label>
                                    <input
                                        id="fileData"
                                        type="file"
                                        @change="onFileChange"
                                        style="padding-left: 20%;"
                                        class="custom-file-input"
                                    />
                                </label>
                            </div>
                        <v-text-field
                            v-model="payload.place_birth"
                            outlined
                            label="Place of Birth"
                            hide-details
                            class="mb-3 px-3"
                            v-validate="'required'"
                            :error-messages="errors.collect('Place of Birth')"
                            data-vv-name="Place of Birth" 
                        />
                        <v-text-field
                            v-model="payload.nationality"
                            outlined
                            label="Nationality"
                            hide-details
                            class="mb-3 px-3"
                            v-validate="'required'"
                            :error-messages="errors.collect('Nationality')"
                            data-vv-name="Nationality" 
                        />
                        <v-text-field
                            v-model="payload.year"
                            outlined
                            label="Year"
                            hide-details
                            class="mb-3 px-3"
                            v-validate="'required'"
                            :error-messages="errors.collect('Year')"
                            data-vv-name="Year" 
                        />
                        <v-text-field
                            v-model="payload.contact_guardian"
                            outlined
                            label="Guardian's Contact Number"
                            hide-details
                            class="mb-3 px-3"
                            v-validate="'required'"
                            :error-messages="errors.collect('Guardians Contact Number')"
                            data-vv-name="Guardian's Contact Number" 
                        />
                    </v-card>
                </v-col>
            </v-row>
            <v-card-actions>
                <v-btn
                color="primary"
                @click="editUser()"
                >
                    Update
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
import logo from '@/assets/images/profile.jpg'
import { Show, SaveUpdate, SaveUpdateNoPic } from '@/repositories/registrar.api'
export default {
    data(){
        return {
            payload : {
                id: '',
                firstname : '',
                photo: '',
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
                status: '',
            },
            logo
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
    watch:{
        id: function(val){
            if(val != 0){
                console.log(val, 'val')
                this.edit(val)
            }
        }
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
        edit(id) {
            Show(id).then(response=> {
                console.log(response.data)
                this.payload.id = response.data.id
                this.payload.firstname = response.data.firstname
                this.payload.lastname = response.data.lastname
                this.payload.email = response.data.email
                this.payload.contact = response.data.contact
                this.payload.gender = response.data.gender
                this.payload.nationality = response.data.nationality
                this.payload.civil_status = response.data.civil_status
                this.payload.date_birth = response.data.date_birth
                this.payload.place_birth = response.data.place_birth
                this.payload.course = response.data.course
                this.payload.year = response.data.year
                this.payload.guardian = response.data.guardian
                this.payload.contact_guardian = response.data.contact_guardian
                this.payload.address = response.data.address
                this.payload.photo = response.data.photo
            });
        },
        editUser(){
            const imageLabel = document.getElementById('fileData');

            if(imageLabel.value == ''){
                SaveUpdateNoPic(this.payload.id, this.payload).then(({response})=> {
                console.log(response)
                this.clear()
                })  
            }else{
                    SaveUpdate(this.payload.id, this.payload).then(({response})=> {
                    console.log(response)
                    this.clear()
                })
            }

            
        },
        clear(){
            this.payload.id = ""
            this.payload.firstname = ""
            this.payload.lastname = ""
            this.payload.email = ""
            this.payload.contact = ""
            this.payload.gender = ""
            this.payload.nationality = ""
            this.payload.civil_status = ""
            this.payload.date_birth = ""
            this.payload.place_birth = ""
            this.payload.course = ""
            this.payload.year = ""
            this.payload.guardian = ""
            this.payload.contact_guardian = ""
            this.payload.address = ""
            this.payload.photo = ""
            this.$emit('close')
        }
    },
}
</script>