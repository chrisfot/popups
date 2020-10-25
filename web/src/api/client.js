import axios from 'axios';
import router from '@/router';

/*
 * Create HTTP client instance with default configuration
 */

const client = axios.create({
    baseURL: 'http://localhost/popups/api/public',
    timeout: 10000, // 10s
    headers: {
        // 'Content-Type': 'application/json',
    }
});


/*
 * Response Interceptors
 * 1. Global response handling
 * 2. Error handling based on HTTP error codes
 */

const responseInterceptor = response => {
    if (response.status === 200) {
        // Return only the actual API response
        return response.data;
    }
    return response;
};

const errorInterceptor = error => {
    switch (error.response.status) {
        case 403:
            router.push('/forbidden');
            break;

        case 404:
            router.push('/404');
            break;

        case 500:
            router.push('/error');
            break;

        default:
            console.error(error.response.status, error.message);
    }
    return Promise.reject(error);
};

client.interceptors.response.use(responseInterceptor, errorInterceptor);

export default client;
