<template>
    <el-form 
        ref="login" 
        :model="form" 
        style="width:500px;margin:200px auto;" 
        label-width="100px"
        label-position="left"
        :rules="loginRules"
        status-icon>
        <el-form-item label="用户名" prop="name">
            <el-input v-model="form.name" autocomplete="off"></el-input>
        </el-form-item>
        <el-form-item label="密码" prop="pass">
            <el-input type="password" v-model="form.pass" autocomplete="off"></el-input>
        </el-form-item>
        <el-form-item label="确认密码" prop="checkPass">
            <el-input type="password" v-model="form.checkPass" autocomplete="off"></el-input>
        </el-form-item>
        <el-form-item label="验证码" prop="checkCode">
            <el-input type="text" v-model="form.checkCode"></el-input>
            <img :src="checkCode" alt="" @click=updateCheckCode />
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="submitForm('login')">login</el-button>
            <el-button type="primary" @click="submitForm('register')">Register</el-button>
            <el-button type="info" @click="resetForm('login')">cancle</el-button>
        </el-form-item>
    </el-form>
</template>
<script>
  import { login } from '@/api/http';
  import { checkCode } from '@/api/config';

  export default {
    data() {
      var validatePass = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请输入密码'));
        } else {
          if (this.form.checkPass !== '') {
            this.$refs.login.validateField('checkPass');
          }
          callback();
        }
      };
      var validatePass2 = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请再次输入密码'));
        } else if (value !== this.form.pass) {
          callback(new Error('两次输入密码不一致!'));
        } else {
          callback();
        }
      };
      return {
        checkCode: checkCode,
        form: {
          name: '',
          pass: '',
          checkPass: '',
          checkCode: '',
          type: ''
        },
        loginRules: {
            name: [
                { required: true, message: '请输入活动名称', trigger: 'blur' },
                { min: 3, max: 5, message: '长度在 3 到 5 个字符', trigger: 'blur' }
            ],
            pass: [
                { validator: validatePass, trigger: 'blur' }
            ],
            checkPass: [
                { validator: validatePass2, trigger: 'blur' }
            ],
            checkCode: [
                { required: true, message: '请输入验证码', trigger: 'blur' }
            ]
        }
      }
    },
    methods: {
      submitForm(type) {
        var self = this;
        self.form.type = type;
        this.$refs.login.validate((valid) => {
          if (valid) {
            login(self.form).then((res) => {
                console.log(res)
                self.open(res);
            });
          } else {
            console.log('error submit!!');
            return false;
          }
        });
      },
      resetForm(formName) {
        this.$refs[formName].resetFields();
      },
      open(data) {
        var self = this;
        this.$alert( data.msg, '提示:', {
          confirmButtonText: '确定',
          callback: action => {
            if(data.code == 0) {
              self.$router.push('/index');
            }
          }
        });
      },
      updateCheckCode(e) {
        this.checkCode = this.checkCode + '?t='+ Math.random();
      }
    }
  }
</script>
