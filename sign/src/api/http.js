import axios from 'axios';

export function login(params) {
    return axios.get('http://localhost/project/sign/login.php',{
        param: params
    }).then((res) => {
        console.log(res)
        return Promise.resolve(res.data);
    })
}