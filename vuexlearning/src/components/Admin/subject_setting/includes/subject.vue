<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="subject"
            class="elevation-1"
            hide-default-footer
            :loading="loading"
        >
            <template v-slot:top>
                <v-toolbar
                flat
                >
                    <v-toolbar-title>Subject Course</v-toolbar-title>
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
                        :items='subject'
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
            <template v-slot:item.actions="{ item }">
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
                    <!-- <v-icon
                        small
                        color="green"
                        @click="edit(item.id)"
                    >mdi-pencil</v-icon>
                    </v-btn> -->
                    
                </v-list-item>
                </v-list>
            </v-menu>
            </template>
        </v-data-table>
    </div>
</template>
<script>
    import axios from '@/plugins/axios'
    export default {
        components : {

        },
        data(){
            return {
                headers: [
                    { text : 'Course ID', value: 'subject_id', sortable: false},
                    { text : 'Course Name', value: 'subject'},
                    { text : 'Course Description', value: 'description'}
                ],
                subject: [],
                loading: false,
                search: '',
                dialog: false
            }
        },
        watch : {
            "search": {
                handler(val){
                    this.searchSubject(val)
                },
                deep: true,
            }
        },
        mounted() {
            this.searchSubject();
        },
        methods: {
            searchSubject(key) {
                axios.post('searchSubject', {searchkey:key}).then((response) => {
                this.subject = response.data 
                this.loading = false
                }).catch((errors) => {
                console.log(errors)
                });
            },
        },

    }
</script>