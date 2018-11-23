import axios from 'axios';
import { conUrl, sessionUrl, timeUrl, excelUrl } from './config'; 

// 携带cookie,否则不能添加
axios.defaults.withCredentials = true;

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

export function testSession(params) {
    return axios.post( sessionUrl, qs.stringify(params)).then((res) => {
        console.log(res)
        return Promise.resolve(res.data);
    })
}

export function saveTime(params) {
    console.log(params)
    return axios.post( timeUrl, qs.stringify(params)).then((res) => {
        console.log(res)
        return Promise.resolve(res.data);
    })
}

export function excel(params) {
    console.log(params)
    axios.post( excelUrl, qs.stringify(params)).then((res) => {
        console.log(res)
        // return Promise.resolve(res.data);
    })
}