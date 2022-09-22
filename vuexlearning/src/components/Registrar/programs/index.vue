<template>
    <div>
        <v-card
        v-if="$is_registrar() || $is_admin()"
        >
        <v-data-table
            :headers="headers"
            :items="program"
            class="elevation-1"
            hide-default-footer
            :loading="loading"
        >
            <template v-slot:top>
                <v-toolbar
                flat
                >
                    <v-toolbar-title>Programs</v-toolbar-title>
                    <v-divider
                    class="mx-4"
                    inset
                    vertical
                    ></v-divider>
                    <v-spacer></v-spacer>
                        <v-text-field
                        label="Search"
                        filled
                        rounded
                        
                        dense
                        style="padding-top: 40px; padding-right: 10px;"
                        v-model="search"
                        :items='program'
                        ></v-text-field>
                    <v-btn
                    v-model="dialog"
                    dark
                    class="mt-3"
                  
                    >
                        <v-icon dark >
                        mdi-plus
                        </v-icon>
                    </v-btn>
                </v-toolbar>
            </template>
            <!-- <template v-slot:item.actions="{ item }">
            <v-menu offset-y>
                <template v-slot:activator="{ on, attrs }">
                <v-btn
                    icon
                    v-bind="attrs"
                    v-on="on"
                >
                    <v-icon>mdi-dots-vertical</v-icon>
                </v-btn>
                </template>
                <v-list>
                <v-list-item class="dd">
                    <v-btn icon>
                    <v-icon
                        small
                        color="green"
                        @click="edit(item.id)"
                    >mdi-pencil</v-icon>
                    </v-btn>
                    <v-btn icon> 
                    <v-icon
                        small
                        color="red"
                        @click="lock(item)"
                    >mdi-lock</v-icon>
                    </v-btn>
                    <v-btn icon> 
                    <v-icon
                        small
                        color="red"
                        @click="deleteItem(item)"
                    >mdi-delete</v-icon>
                    </v-btn>
                    <v-btn icon> 
                    <v-icon
                        small
                        color="blue"
                        @click="addBirthday(item)"
                    >mdi-star-circle</v-icon>
                    </v-btn>
                </v-list-item>
                </v-list>
            </v-menu>
            </template> -->
        </v-data-table>
    </v-card>
    <v-card
        elevation="0"
        v-else>
            <v-spacer></v-spacer>
            <v-img
                style="width: 90%; height: 50%;"
                :src="error"
            ></v-img>
            <v-spacer></v-spacer>
        </v-card>
    </div>
</template>
<script>
    import axios from '@/plugins/axios'
    import error from '@/assets/images/404-pages.jpg'
    export default {
        components : {

        },
        data(){
            return {
                headers: [
                    { text : 'Program ID', value: 'program_id', sortable: false},
                    { text : 'Program Name', value: 'program'},
                    { text : 'Program Description', value: 'description'}
                ],
                program: [],
                loading: false,
                search: '',
                dialog: false,
                error
            }
        },
        watch : {
            "search": {
                handler(val){
                    this.searchProgram(val)
                },
                deep: true,
            }
        },
        mounted() {
            this.searchProgram();2
        },
        methods: {
            searchProgram(key) {
                axios.post('searchProgram', {searchkey:key}).then((response) => {
                this.program = response.data 
                this.loading = false
                }).catch((errors) => {
                console.log(errors)
                });
               
            },
        },

    }
</script>