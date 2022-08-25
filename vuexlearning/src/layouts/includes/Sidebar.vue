<template>
  <v-navigation-drawer
    :value="drawer"
    :clipped="$vuetify.breakpoint.lgAndUp"
    app
    style="min-height:100vh !important;"
  >
    <div style="padding-top: 10px;">
      <v-img 
        contain
         :src="require('@/assets/images/logos/logo.svg')"
        size="1"
        max-height="100"
        max-width="200"
        class="mx-auto"
      />
    </div>
    <v-list dense>
      <template v-for="item in items">
        <v-row
          v-if="item.heading"
          :key="item.heading"
          align="center"
        ></v-row>
        <template v-else-if="item.children">
          <v-list-group
            v-if="itemChecker(item.text)"
            :key="item.text"
            v-model="item.model"
            :prepend-icon="item.model ? item.icon : item['icon-alt']"
          >
            <template v-slot:activator>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title >
                    {{ item.text }}
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </template>
            <v-list-item
              v-for="(child, i) in item.children"
              :key="i"
              link :to="child.url"
            >
              <v-list-item-action v-if="child.icon">
                <v-icon>{{ child.icon }}</v-icon>
              </v-list-item-action>
              <v-list-item-content class="content">
                <v-list-item-title>
                  {{ child.text }}
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-group>
        </template>
        <template v-else>
          <v-list-item
            v-if="itemChecker(item.text)"
            :key="item.text"
            link :to="item.url"
          >
            <v-list-item-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>
                {{ item.text }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </template>
      </template>
    </v-list>
  </v-navigation-drawer>
</template>
<script>
  import logo from '@/assets/images/logo.png'
  export default {
    props: {
      source: String,
    },
    computed : {
      drawer() {
        return this.$store.state.sidebar
      }
    },
    data: () => ({
      logo,
      items: [
        { icon: 'mdi-view-dashboard', text: 'Dashboard' ,url:'/' },
      
      
        {
          
          icon: 'mdi mdi-account-tie',
          'icon-alt': 'mdi mdi-account-tie',
          text: 'Instructor',
          model: false,
          children: [
            // { icon: 'mdi mdi-account-edit', text: 'User Settings' , url:'/user' },

            { icon: 'mdi mdi-book-open-variant', text: 'Class Record' },
            { icon: 'mdi mdi-book-open-page-variant', text: 'Subjects' },
            { icon: 'mdi mdi-notebook-multiple', text: 'Examination PDFs' },
            { icon: 'mdi mdi-message-processing', text: 'Messages' },
          ],
        },
        {
          
          icon: 'mdi mdi-database',
          'icon-alt': 'mdi mdi-database',
          text: 'Registrar',
          model: false,
          children: [
             { icon: 'mdi mdi-notebook-multiple', text: 'Enrollment' },
             { icon: 'mdi mdi-book-open-variant', text: 'Classes'},
             { icon: 'mdi mdi-book-open-variant', text: 'Students' },
             { icon: 'mdi mdi-book-open-variant', text: 'Instructors' },
             { icon: 'mdi mdi-book-open-variant', text: 'Grades' },
             { icon: 'mdi mdi-book-open-variant', text: 'Transcripts' },
          ],
        },
        {
          
          icon: 'mdi mdi-notebook-multiple',
          'icon-alt': 'mdi mdi-notebook-multiple',
          text: 'Librarian',
          model: false,
          children: [
            // { icon: 'mdi mdi-account-edit', text: 'User Settings' , url:'/user' },
             { icon: 'mdi mdi-book-open-variant', text: 'Book Record' },
             { icon: 'mdi mdi-book-check-outline', text: 'Borrowed'},
             { icon: 'mdi mdi-book-open-variant', text: 'Overdue' },
          ],
        },
        {
          
          icon: 'mdi-settings',
          'icon-alt': 'mdi-settings',
          text: 'Subject',
          model: false,
          children: [
            { icon: 'mdi mdi-account-edit', text: 'User Settings' , url:'/user' },
          ],
        },
        {
          
          icon: 'mdi-settings',
          'icon-alt': 'mdi-settings',
          text: 'Student',
          model: false,
          children: [
            { icon: 'mdi mdi-account-edit', text: 'User Settings' , url:'/user' },
          ],
        },
        {
          
          icon: 'mdi-settings',
          'icon-alt': 'mdi-settings',
          text: 'Settings',
          model: false,
          children: [
            { icon: 'mdi mdi-account-edit', text: 'User Settings' , url:'/user' },
          ],
        },
      ],
      newOrderRecords:0
    }),
    watch: {
      '$store.getters.newOrderRecords'(newVal) {
        this.newOrderRecords = newVal
      }
    },
    methods:{
      itemChecker(item){
        let user_accepts = ['Dashboard','Settings1' ]
        let instructor_accepts = ['Dashboard', 'Instructor']
        let registrar_accepts = ['Dashboard', 'Registrar']
        let librarian_accepts = ['Dashboard', 'Librarian']
        let student_accepts = ['Dashboard', 'Student']
        if(this.$is_admin()){
          return true
        }
        if(this.$is_instructor()){
          return instructor_accepts.includes(item)
        }
        if(this.$is_registrar()){
          return registrar_accepts.includes(item)
        }
        if(this.$is_librarian()){
          return librarian_accepts.includes(item)
        }
        if(this.$is_student()){
          return student_accepts.includes(item)
        }
        else if( user_accepts.includes(item)){
          return true
        }
        else {
          return false
        }
      },
    }
  }
</script>

<style>
.content {
  padding-left: 2em;
}
</style>








 
