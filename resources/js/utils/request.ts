import axios, { AxiosInstance } from "axios";

import { ElMessage } from "element-plus";
let language = "en";

const $axios: AxiosInstance = axios.create({
    baseURL: `http://127.0.0.1:8000/api/`,
    timeout: 10000,
    headers: {
        "x-localization": language,
    },
});

// response pre-processing
$axios.interceptors.response.use(
    (response) => {
        return response.data;
    },
    (error) => {
        //Need to check user authorization
        let message = error.response.data.message;
        if (error.response.data && error.response.data.errors) {
            console.log(error.response.data.errors);
            for (let field of Object.keys(error.response.data.errors)) {
                ElMessage.error(error.response.data.errors[field][0]);
            }
        } else if (error.response.data && error.response.data.error) {
            ElMessage.error(error.response.data.error);
        } else {
            ElMessage.error(error.response.data.message);
        }
        // @ts-ignore
        return Promise.reject(error);
    }
);
export default $axios;
