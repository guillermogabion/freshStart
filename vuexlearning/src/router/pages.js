import Dashboard from '@/components/dashboard/index.vue'
// registrar 
import Registrar_Admission from '@/components/Registrar/admission/index.vue'
import Registrar_Programs from '@/components/Registrar/programs/index.vue'
import Registrar_Students from '@/components/Registrar/students/index.vue'
import Registrar_Instructors from '@/components/Registrar/instructors/index.vue'
import Registrar_Grades from '@/components/Registrar/grades/index.vue'
import Registrar_Transcripts from '@/components/Registrar/transcripts/index.vue'

import Registrar_Add from '@/components/Registrar/admission/includes/drawer/add-enrollee.vue'
// instructor
import Instructor_ClassRecord from '@/components/Instructor/class_record/index.vue'
import Instructor_Examination from '@/components/Instructor/examination/index.vue'
import Instructor_Messages from '@/components/Instructor/messages/index.vue'
import Instructor_Subject from '@/components/Instructor/subject/index.vue'
// librarian
import Library_BookRecord from '@/components/Library/book_record/index.vue'
import Library_Borrowed from '@/components/Library/borrowed/index.vue'
import Library_OverDue from '@/components/Library/overdue/index.vue'
// subject 
import Subject_Details from '@/components/Subject/details/index.vue'
// executive
import Executive_Approval from '@/components/Executive/approval/index.vue'
import Executive_Announcement from '@/components/Executive/announcement/index.vue'
import Executive_Messages from '@/components/Executive/messages/index.vue'
// student 
import Student_Class from '@/components/Student/class/index.vue'
import Student_Submission from '@/components/Student/submissions/index.vue'
import Student_Grades from '@/components/Student/grade/index.vue'
import Student_Messages from '@/components/Student/messages/index.vue'
// admin 
import Admin_StudentSetting from '@/components/Admin/student_setting/index.vue'
import Admin_InstructorSetting from '@/components/Admin/instructor_setting/index.vue'
import Admin_ClassSetting from '@/components/Admin/class_setting/index.vue'
import Admin_SubjectSetting from '@/components/Admin/subject_setting/index.vue'
import Admin_Messages from '@/components/Admin/messages/index.vue'

import Announcements from '@/components/Announcement/index.vue'
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

    {
        path: '/registrar/admission/add-enrollee',
        name: 'add-enrollee',
        component: Registrar_Add,
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
        path: '/library/book_record',
        name: 'book_record',
        component: Library_BookRecord,
        meta: { authOnly: true }
    },
    {
        path: '/library/borrowed',
        name: 'borrowed',
        component: Library_Borrowed,
        meta: { authOnly: true }
    },
    {
        path: '/library/overdue',
        name: 'overdue',
        component: Library_OverDue,
        meta: { authOnly: true }
    },
// subject 
    {
        path: '/subject/details',
        name: 'details',
        component: Subject_Details,
        meta: { authOnly: true }
    },
// executive
    {
        path: '/executive/approval',
        name: 'approval',
        component: Executive_Approval,
        meta: { authOnly: true }
    },
    {
        path: '/executive/announcement',
        name: 'announcement',
        component: Executive_Announcement,
        meta: { authOnly: true }
    },
    {
        path: '/executive/messages',
        name: 'messages',
        component: Executive_Messages,
        meta: { authOnly: true }
    },
// student 
    {
        path: '/student/class',
        name: 'class',
        component: Student_Class,
        meta: { authOnly: true }
    },
    {
        path: '/student/submission',
        name: 'submission',
        component: Student_Submission,
        meta: { authOnly: true }
    },
    {
        path: '/student/grade',
        name: 'grade',
        component: Student_Grades,
        meta: { authOnly: true }
    },
    {
        path: '/student/messages',
        name: 'messages',
        component: Student_Messages,
        meta: { authOnly: true }
    },

// Admin 
    {
        path: '/admin/class_setting',
        name: 'class_setting',
        component: Admin_ClassSetting,
        meta: { authOnly: true }
    },
    {
        path: '/admin/student_setting',
        name: 'student_setting',
        component: Admin_StudentSetting,
        meta: { authOnly: true }
    },
    {
        path: '/admin/instructor_setting',
        name: 'instructor_setting',
        component: Admin_InstructorSetting,
        meta: { authOnly: true }
    },
    {
        path: '/admin/subject_setting',
        name: 'subject_setting',
        component: Admin_SubjectSetting,
        meta: { authOnly: true }
    },
    {
        path: '/admin/messages',
        name: 'messages',
        component: Admin_Messages,
        meta: { authOnly: true }
    },


    
    {
        path: '/announcement',
        name: 'announcement',
        component: Announcements,
        meta: { authOnly: true }

    },
    {
        path: '/user',
        name: 'user',
        component: Users,
        meta: { authOnly: true }

    }

]

