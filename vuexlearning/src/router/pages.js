import Dashboard from '@/components/dashboard/index.vue'
// registrar 
import Registrar_Admission from '@/components/Registrar/admission/index.vue'
import Registrar_Programs from '@/components/Registrar/programs/index.vue'
import Registrar_Students from '@/components/Registrar/students/index.vue'
import Registrar_Instructors from '@/components/Registrar/instructors/index.vue'
import Registrar_Grades from '@/components/Registrar/grades/index.vue'
import Registrar_Transcripts from '@/components/Registrar/transcripts/index.vue'
// instructor
import Instructor_ClassRecord from '@/components/Instructor/class_record/index.vue'
import Instructor_Examination from '@/components/Instructor/examination/index.vue'
import Instructor_Messages from '@/components/Instructor/messages/index.vue'
import Instructor_Subject from '@/components/Instructor/subject/index.vue'


import Users from '@/components/user/index.vue'

export default [{

        path: '/',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            authOnly: true,
            title: 'Skills - MyApp'
        }

    },

    // Instructors


    // registrar
    {
        path: '/registrar/admission',
        name: 'admission',
        component: Registrar_Admission,
        meta: { authOnly: true }
    },
    {
        path: '/registrar/programs',
        name: 'programs',
        component: Registrar_Programs,
        meta: { authOnly: true }
    },
    {
        path: '/registrar/students',
        name: 'students',
        component: Registrar_Students,
        meta: { authOnly: true }
    },
    {
        path: '/registrar/instructors',
        name: 'instructors',
        component: Registrar_Instructors,
        meta: { authOnly: true }
    },
    {
        path: '/registrar/grades',
        name: 'grades',
        component: Registrar_Grades,
        meta: { authOnly: true }
    },
    {
        path: '/registrar/transcripts',
        name: 'transcripts',
        component: Registrar_Transcripts,
        meta: { authOnly: true }
    },
// instructor 
    {
        path: '/instructor/class_record',
        name: 'class_record',
        component: Instructor_ClassRecord,
        meta: { authOnly: true }
    },
    {
        path: '/instructor/subject',
        name: 'subject',
        component: Instructor_Subject,
        meta: { authOnly: true }
    },
    {
        path: '/instructor/examination',
        name: 'subject',
        component: Instructor_Examination,
        meta: { authOnly: true }
    },
    {
        path: '/instructor/messages',
        name: 'messages',
        component: Instructor_Messages,
        meta: { authOnly: true }
    },

// librarian
    
    {
        path: '/user',
        name: 'user',
        component: Users,
        meta: { authOnly: true }

    }

]

