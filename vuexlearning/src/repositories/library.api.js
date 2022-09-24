import axios from '@/plugins/axios';

export const searchBook = (payload) => axios.post('searchBook', payload)
export const BookPagination = (url,payload) => axios.get(`/${url}`, payload)
