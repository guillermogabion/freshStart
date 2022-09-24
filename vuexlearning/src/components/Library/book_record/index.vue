<template>

    <div>
      <v-card 
      height="979px"
      class="scroll"
      >
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
          color="#f0c808"
          dark
          class="mb-2"
          >
          <v-icon>
            mdi-plus
          </v-icon>
          </v-btn>
        </v-card-actions>
        <v-row class="ma-1">
          <v-col v-for="item in book" :key="item.id"
            cols="16" :lg="2" :sm="8" :md="2" :xs="10"
            >
          <v-card
          class="mx-auto"
          max-width="280"
          max-height="310"
          min-height="340"
          >
            <v-responsive class="image-container" height="10%">
            <div
            class="image-padding"
            >
            <v-img
                contain
                :alt="item.photo"
                :src="item.photo"
                class="image-padding"
                padding-left="2em" 
                max-height="150"
                max-width="200"
              ></v-img>
            </div>
            </v-responsive>
            <v-card-title>
              {{item.book_name}}
            </v-card-title>
            <v-card-text class="description">
              Description : {{item.description}}
              Available : {{ item.stock }}
            </v-card-text>
        </v-card>
          </v-col>
        </v-row>

      </v-card>

    </div>





    <!-- <v-data-table
      :headers="headers"
      :items="book"
      class="elevation-1"
      hide-default-footer
      :items-per-page="itemsPerPage"
      :loading="loading"
      :page.sync="page"
      @page-count="pageCount = $event"
      :server-items-length="total_book"
      @pagination="fetchBookData"
    >
      <template v-slot:top
      class="text-field-style"
      >
        <v-toolbar
          flat
        >
        Book Record
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
            v-model="search"
            :items='book'
            class="field"
            ></v-text-field>
        </v-toolbar>
      </template> -->
      <!-- <template v-slot:item.actions="{ item }">
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
      </template> -->
      <!-- <div class="text-center pt-2">
        <v-pagination
        v-model="page"
        :total-visible="7"
        :length="pageCount"
        ></v-pagination>
        </div>

        
    </v-data-table> -->
  </template>
  
<script>
    // import { searchBook } from ''
    // import {searchBook, BookPagination} from '@/repositories/library.api'
    import axios from '@/plugins/axios';
    export default {
      data: () => ({
        dialog: false,
        dialogDelete: false,
        // headers: [
        //   { text: 'Calories', value: 'calories' },
        //   { text: 'Fat (g)', value: 'fat' },
        //   { text: 'Carbs (g)', value: 'carbs' },
        //   { text: 'Protein (g)', value: 'protein' },
        //   { text: 'Actions', value: 'actions', sortable: false },
        // ],
        book: [],
        search : '',
        pageCount: 0,
        itemsPerPage:null,
        total_book:0,
        page:1,
        current_page:0,
        loading: false,
      }),
  
      
  
      watch: {
        "search": {
            handler(val) {
              this.indexBook(val)
            },
            deep: true,
          },
      },
  
      created () {
        this.getAll()
      },
  
      methods: {
       getAll(){
         axios.get('book').then((response)=> {
           this.book = response.data
         })
       }
  
      
      },
    }
  </script>

  <style lang="scss">
  @import '@/scss/library.scss';
 .image-padding {
  padding-left: 3.5em; 
  padding-top: 1em;
}

  </style>