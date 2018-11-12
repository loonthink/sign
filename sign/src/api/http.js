import axios from 'axios';
import { conUrl } from './config'; 

/**
 * post 提交数据,需要使用qs.stringfy处理下数据
 * 不然会因为请求头导致跨域请求数据失败
 */
import qs from 'qs';

export function login(params) {
    return axios.post( conUrl, qs.stringify(params)).then((res) => {
        console.log(res)
        return Promise.resolve(res.data);
    })
}