import axios from 'axios';

const axiosInstance = axios.create({
  baseURL: import.meta.env.VUE_APP_API_BASE_URL || '/api',  // Используйте переменную окружения или /api по умолчанию
});

export default axiosInstance;