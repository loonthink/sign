<template>
    <div id="index">
        <span class="demonstration">默认</span>
        <el-date-picker
            v-model="date"
            type="date"
            placeholder="选择日期">
        </el-date-picker>
         <el-time-picker
            v-model="startTime"
            :picker-options="{
                selectableRange: '08:00:00 - 10:30:00'
            }"
            default-value = "08:00:00"
            placeholder="任意时间点">
        </el-time-picker>
        <el-time-picker
            arrow-control
            v-model="endTime"
            :picker-options="{
                selectableRange: '17:30:00 - 20:30:00'
            }"
            default-value=""
            placeholder="任意时间点">
        </el-time-picker>
        <el-button type="primary" @click=startTime>保存</el-button>
    </div>
</template>

<script>
  import { testSession } from '@/api/http';

  export default {
    data() {
        return {
            onDuty:{
                date: date,
                startTime: new Date(2018, 9, 10, 8, 50),
                endTime: new Date(2018, 9, 10, 17, 30),
            },
            offDuty: {

            },
            form: {
                aa:999,
                bb:888
            },
            user: {
                name: ''
            }
        }
    },
    mounted() {
        var self = this;
        testSession(self.form).then((res) => {
            self.user.name = res.msg.username;
            if(res.code == 1) {
                self.$router.push('/')
            }
        });
    },
    methods: {
        startTime() {
            
        }
    }
  }
</script>
