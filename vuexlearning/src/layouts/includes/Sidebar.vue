<template>
  <v-navigation-drawer
    :value="drawer"
    :clipped="$vuetify.breakpoint.lgAndUp"
    app
    style="top:8px !important;min-height:100vh !important;"
  >

      <v-img 
        contain
         :src="require('@/assets/images/logos/logo.svg')"
        size="1"
        max-height="100"
        max-width="200"
        class="mx-auto"
      />
 
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
                <v-icon
                class="left"
                >{{ child.icon }}</v-icon>
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
          
          icon: 'mdi mdi-database',
          'icon-alt': 'mdi mdi-database',
          text: 'Registrar',
          model: false,
          children: [
             { icon: 'mdi mdi-notebook-multiple', text: 'Admission', url:'/registrar/admission' },
             { icon: 'mdi mdi-google-classroom', text: 'Programs', url:'/registrar/programs'},
             { icon: 'mdi mdi-chart-bar', text: 'Grades Record', url:'/registrar/grades'},
             { icon: 'mdi mdi-clipboard-multiple', text: 'Transcripts', url:'/registrar/transcripts' },
          ],
        },
        {
          
          icon: 'mdi mdi-account-tie',
          'icon-alt': 'mdi mdi-account-tie',
          text: 'Instructor',
          model: false,
          children: [
            // { icon: 'mdi mdi-account-edit', text: 'User Settings' , url:'/user' },

            { icon: 'mdi mdi-book-open-variant', text: 'Class Record', url:'/instructor/class_record' },
            { icon: 'mdi mdi-book-open-page-variant', text: 'Subjects', url:'/instructor/subject' },
            { icon: 'mdi mdi-notebook-multiple', text: 'Examination PDFs', url:'/instructor/examination' },
            { icon: 'mdi mdi-message-processing', text: 'Messages', url:'/instructor/messages' },
          ],
        },
        {
          
          icon: 'mdi mdi-notebook-multiple',
          'icon-alt': 'mdi mdi-notebook-multiple',
          text: 'Librarian',
          model: false,
          children: [
            // { icon: 'mdi mdi-account-edit', text: 'User Settings' , url:'/user' },
             { icon: 'mdi mdi-book-open-variant', text: 'Book Record', url:'/library/book_record' },
             { icon: 'mdi mdi-book-check-outline', text: 'Borrowed', url:'/library/borrowed'},
             { icon: 'mdi-sticker-remove', text: 'Overdue', url:'/library/overdue' },
          ],
        },
        {
          
          icon: 'mdi mdi-text-box-multiple',
          'icon-alt': 'mdi mdi-text-box-multiple',
          text: 'Subject',
          model: false,
          children: [
            // { icon: 'mdi mdi-account-edit', text: 'User Settings' , url:'/user' },
             { icon: 'mdi mdi-book-open-variant', text: 'Subject Details' , url:'/subject/details'  },
            //  { icon: 'mdi mdi-book-check-outline', text: 'Subject Referrences'},
          ],
        },
        {
          
          icon: 'mdi mdi-account-star',
          'icon-alt': 'mdi mdi-account-star',
          text: 'Executive',
          model: false,
          children: [
            // { icon: 'mdi mdi-account-edit', text: 'User Settings' , url:'/user' },
            { icon: 'mdi mdi-book-check', text: 'For Approval', url:'/executive/approval' },
            { icon: 'mdi mdi-account-tie-voice', text: 'Post Announcement', url:'/executive/announcement'},
            { icon: 'mdi mdi-message-processing', text: 'Messages', url:'/executive/messages'},
          ],
        },
        {
          
          icon: 'mdi mdi-account-group-outline',
          'icon-alt': 'mdi mdi-account-group-outline',
          text: 'Student',
          model: false,
          children: [
            // { icon: 'mdi mdi-account-edit', text: 'User Settings' , url:'/user' },
            { icon: 'mdi mdi-book-check', text: 'Class', url:'/student/class' },
            { icon: 'mdi mdi-account-tie-voice', text: 'Submissions', url:'/student/submission'},
            { icon: 'mdi mdi-chart-bar', text: 'Grades', url:'/student/grade'},
            { icon: 'mdi mdi-message-processing', text: 'Messages', url:'/student/messages'},
          ],
        },
        {
          
          icon: 'mdi mdi-account-tie',
          'icon-alt': 'mdi mdi-account-tie',
          text: 'Admin',
          model: false,
          children: [
            // { icon: 'mdi mdi-account-edit', text: 'User Settings' , url:'/user' },

            { icon: 'mdi mdi-account-cog-outline', text: 'User Settings' ,  url:'/admin/user_setting' },
            { icon: 'mdi mdi-notebook-multiple', text: 'Subject Settings', url:'/admin/subject_setting' },
            { icon: 'mdi mdi-message-processing', text: 'Class Setting', url: '/admin/class_setting' },
            { icon: 'mdi mdi-message-processing', text: 'Messages', url: '/admin/messages' },
          ],
        },
        { icon: 'mdi mdi-alert-rhombus', text: 'Announcements', url: '/announcement' },
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
        let instructor_accepts = ['Dashboard', 'Instructor','Announcements']
        let registrar_accepts = ['Dashboard', 'Registrar','Announcements']
        let librarian_accepts = ['Dashboard', 'Librarian','Announcements']
        let executive_accepts = ['Dashboard', 'Executive','Announcements']
        let student_accepts = ['Dashboard', 'Student','Announcements']
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
        if(this.$is_executive()){
          return executive_accepts.includes(item)
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
.left {
  padding-left: 1em;
}
</style>








 
