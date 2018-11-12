import axios from 'axios';
import { conUrl } from './config'; 

export function login(params) {
    return axios.get( conUrl, {
        param: params
    }).then((res) => {
        console.log(res)
        return Promise.resolve(res.data);
    })
}