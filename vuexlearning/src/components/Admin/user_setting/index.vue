<template>
    <div>
        <v-card
        max-height="80%"
        min-height="80%"
        v-if="$is_admin()"
        >
          <!-- <v-data-table
                :headers="headers"
                :items="students"
                sort-by="calories"
                class="elevation-1"
            >
            </v-data-table> -->
             <v-tabs
              v-model="tab"
              background-color="transparent"
              color="basil"
              grow
            >
              <v-tab
                v-for="item in items"
                :key="item"
              >
                {{ item }}
              </v-tab>
            </v-tabs>
            <v-card>
                <!-- students  -->
                <v-tabs-items v-model="tab">
                    <v-tab-item>
                        <Student />
                    </v-tab-item>
                    <v-tab-item>
                        <Instructor />
                    </v-tab-item>
                </v-tabs-items>
                <!-- instructor -->
               
            </v-card>
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
import Student from './includes/student.vue'
import Instructor from './includes/instructor.vue'
import error from '@/assets/images/404-pages.jpg'
export default {
    components : {
        Student,
        Instructor
    },
    data(){
        return {
            error,
            tab: null,
            items: [
              'Students', 'Instructors/Non-Teaching',
            ],
        }
    }

}
</script>