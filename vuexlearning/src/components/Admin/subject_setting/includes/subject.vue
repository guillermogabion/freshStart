<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="subject"
            class="elevation-1"
            hide-default-footer
            :loading="loading"
            :page.sync="page"
            @page-count="pageCount = $event"
            :server-items-length="total_subject"
            @pagination="fetchSubjectData"
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
                    @click="add_subject()"  
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
                    <v-icon
                        small
                        color="green"
                        @click="edit(item.id)"
                    >mdi-pencil</v-icon>
                    </v-btn>
                    
                </v-list-item>
                </v-list>
            </v-menu>
            </template>
        </v-data-table>
        <div class="text-center pt-2">
        <v-pagination
        v-model="page"
        :total-visible="7"
        :length="pageCount"
        ></v-pagination>
        </div>
        <AddSubject
        :dialog="dialog2"
        @close="close()"
        @reload="searchSubject()"
        />
    </div>
</template>
<script>
    // import axios from '@/plugins/axios'
    import { searchSubject } from '@/repositories/admin.api'
    import AddSubject from './dialogs/add.vue'
    export default {
        components : {
            AddSubject
        },
        data(){
            return {
                headers: [
                    { text : 'Course ID', value: 'subject_id', sortable: false},
                    { text : 'Course Name', value: 'subject'},
                    { text : 'Course Description', value: 'description'},
                    { text : 'Units', value: 'unit'}
                ],
                subject: [],
                search : '',
                pageCount: 0,
                itemsPerPage:null,
                total_subject:0,
                page:1,
                current_page:0,
                loading: false,
                dialog: false,
                dialog2: false,
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
            searchSubject() {
               this.url = 'subject/pagination?page='+this.current_page+'&keyword=' +this.search
               this.loading = true
               if (this.timer) {
                clearTimeout(this.timer);
                this.timer = null
               }
               this.timer = setTimeout(()=>{
                searchSubject(this.url).then(({data})=> {
                    console.log(this.url,"index")
                    this.set_data_fromServer(data)
                    this.loading = false
                })
                }, 800)
            },
            set_data_fromServer(data) {
                this.subject = data.data
                this.total_subject = data.total
                this.itemsPerPage = data.per_page
                this.pageCount = data.last_page
            },
            fetchSubjectData(page) {
                this.current_page = page.page
                this.searchSubject()
            },
            add_subject(){
                this.dialog2 = true
            },
            close(){
                this.dialog2 = false
            }
        },

    }
</script>