import axios from '@/plugins/axios';

export const searchSubject = (url, payload) => axios.get(`/${url}`, payload)