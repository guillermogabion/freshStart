import axios from '@/plugins/axios';

export const StudentPagination = (url,payload) => axios.get(`/${url}`, payload)
export const searchStudent = (payload) => axios.post('searchStudent', payload)
export const InstructorPagination = (url,payload) => axios.get(`/${url}`, payload)
export const searchInstructor = (payload) => axios.post('searchInstructor', payload)
export const GenerateID = () => axios.get('number')
export const AddNew = (payload) => axios.post('new-enrollee', payload)
export const Show = (id) => axios.get('show/' + id)
export const SaveUpdate = (id, payload)=>axios.post(`edit-profile/${id}`, payload)
export const SaveUpdateNoPic = (id, payload)=>axios.post(`edit-profile-nopic/${id}`, payload)


