<template>
    <div>
      <v-data-table
        :headers="headers"
        :items="instructor"
        class="elevation-1"
        hide-default-footer
        :items-per-page="itemsPerPage"
        :loading="loading"
        :page.sync="page"
        @page-count="pageCount = $event"
        :server-items-length="total_instructor"
        @pagination="fetchInstructorData"
      >
        <template v-slot:top>
            <v-toolbar
            flat
            >
                <v-toolbar-title>Instructor Record</v-toolbar-title>
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
                    :items='instructor'
                    ></v-text-field>
               
            </v-toolbar>
        </template>
        <template v-slot:item.actions="{ item }">
            <v-icon
            small
            @click="deleteItem(item)"
            >
            mdi-eye
            </v-icon>
            <v-icon
            small
            class="mr-2"
            @click="editItem(item)"
            >
            mdi-pencil
            </v-icon>
            <v-icon
            small
            @click="deleteItem(item)"
            >
            mdi-delete
            </v-icon>
        </template>
      </v-data-table>
      <div class="text-center pt-2">
        <v-pagination
        v-model="page"
        :total-visible="7"
        :length="pageCount"
        ></v-pagination>
        </div>
    </div>
    </template>
    
    <script>
    import {InstructorPagination, searchInstructor } from '@/repositories/registrar.api'
      export default {
        data: () => ({
          dialog: false,
          dialogDelete: false,
          headers: [
            {
              text: 'ID Number',
              align: 'start',
              sortable: false,
              value: 'idnumber',
            },
            { text: 'Name', value: 'lastname', align: 'start', sortable: false  },
            { text: '', value: 'firstname', sortable: false },
            { text: 'Gender', value: 'gender' },
            { text: 'Course/Program', value: 'course' },
            { text: 'Year', value: 'year' },
            { text: 'Address', value: 'address' },
            { text: 'Contact', value: 'contact' },
            { text: 'Actions', value: 'actions', sortable: false },
          ],
          instructor: [],
          search : '',
          pageCount: 0,
          itemsPerPage:null,
          total_instructor:0,
          page:1,
          current_page:0,
          loading: false,
          
        }),
        watch: {
           "search": {
            handler(val) {
              this.indexInstructor(val)
            },
            deep: true,
          },
        },
    
       
    
        methods: {
          searchUser(key) {
            if (this.timer) {
              clearTimeout(this.timer);
              this.timer = null;
            }
            this.timer = setTimeout(() => {
              searchInstructor({searchkey:key}).then((response) => {
                this.instructor = response.data 
              }).catch((errors) => {
                console.log(errors)
              });
            },800);
          },
          
           set_data_fromServer(data) {
                this.instructor = data.data
                this.total_instructor = data.total
                this.itemsPerPage = data.per_page
                this.pageCount = data.last_page
            },
             fetchInstructorData(page){
                this.current_page = page.page
                this.indexInstructor()
            },
            indexInstructor() {
              this.url = 'instructor/pagination?page='+this.current_page+ '&keyword=' +this.search
              this.loading = true
              if (this.timer) {
                clearTimeout(this.timer);
                this.timer = null;
              }
              this.timer = setTimeout(() => { 
                InstructorPagination(this.url).then(({data}) => {
                  console.log(this.url,"index")
                  this.set_data_fromServer(data)
                  this.loading = false
                })
              }, 800);
            },
        },
      }
    </script>