<template>
    <div id="index">
        <el-date-picker
            v-model="dutyTime.date"
            type="date"
            format="yyyy 年 MM 月 dd 日"
            value-format="yyyy-MM-dd"
            style="width:190px;"
            placeholder="Date">
        </el-date-picker>
         <el-time-picker
            arrow-control
            v-model="dutyTime.startTime"
            :picker-options="{
                selectableRange: '08:00:00 - 10:30:00'
            }"
            value-format="HH:mm:ss"
            style="width:190px;"
            placeholder="ON-TIME">
        </el-time-picker>
        <el-time-picker
            arrow-control
            v-model="dutyTime.endTime"
            :picker-options="{
                selectableRange: '15:30:00 - 22:30:00'
            }"
            value-format="HH:mm:ss"
            style="width:190px;"
            placeholder="OFF-TIME">
        </el-time-picker>
        <el-input
            placeholder="Reason"
            v-model="dutyTime.reason"
            @blur="clearTime"
            style="width:200px;"
            clearable>
        </el-input>
        <el-button type="primary" @click=startTime>PUNCH CARD</el-button>

        <div
            class="record"
        >
            <el-date-picker
            v-model="dutyTime.month"
            type="month"
            placeholder="选择月"
            value-format="yyyy-M"
            >
            </el-date-picker>
            <el-button type="primary" @click=showRecord>SHOWRECORD</el-button>
            <el-button type="primary" @click=monSummary>MONSUMMARY</el-button>
            <el-button type="primary" @click=excel>EXPORT</el-button>
        </div>

        <div 
            class="record"
            v-if="isShowRecord"
        
        >
            <el-table
                :data="tableData"
                stripe
                style="width: 100%">
                <el-table-column
                prop="date"
                label="DATE"
                width="180">
                </el-table-column>
                <el-table-column
                prop="startTime"
                label="ONDUTY"
                width="180">
                </el-table-column>
                <el-table-column
                prop="endTime"
                label="OFFDUTY">
                </el-table-column>
                <el-table-column
                prop="reason"
                label="OFFDUTY">
                </el-table-column>
                <el-table-column
                fixed="right"
                label="OPERATE"
                width="100">
                <template slot-scope="scope">
                    <el-button @click="handleClick(scope)" type="text" size="small">修改</el-button>
                    <el-button @click="deleteError(scope)" type="text" size="small">删除</el-button>
                </template>
                </el-table-column>
            </el-table>
        </div>

        <div 
            class="record"
            v-if="isShowSummary"
        >
            <el-table
                :data="summaryTable"
                stripe
                style="width: 100%">
                <el-table-column
                prop="overTime"
                label="overTime"
                width="180">
                </el-table-column>
                <el-table-column
                prop="meal_money"
                label="meal_money"
                width="180">
                </el-table-column>
            </el-table>
        </div>
    </div>
</template>

<script>
  import { testSession, saveTime, excel } from '@/api/http';

  export default {
    data() {
        return {
            constVal: {
                default_time: '2018-08-18 18:00:00',
                punch_card: 1,
                showRecode: 2,
                mon_summary: 3,
                deleteErro: 4
            },
            dutyTime:{
                id: '',
                date: '',
                startTime: '',
                endTime: '',
                action: false,
                month: '',
                reason: ''
            },
            isShowRecord: false,
            isShowSummary: false,
            month: 0,
            form: {
                aa:999,
                bb:888
            },
            user: {
                name: ''
            },
            tableData: [],
            summaryTable: []
        }
    },
    watch: {
        'dutyTime.endTime': function(newValue, oldValue) {
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
        checkDutyTime() {
            var self = this;
            if(!!self.dutyTime.date && ((!!self.dutyTime.startTime || !!self.dutyTime.endTime) || !!self.dutyTime.reason)) {
                return true;
            } else {
                return false;
            }
        },
        startTime() {
            var self = this;
            
            if(!self.checkDutyTime()) {
                self.msg('error','选项漏填');
                return false;
            };

            self.dutyTime.action = self.constVal.punch_card;

            saveTime(self.dutyTime).then((res) => {
                if(!!res.code) {
                    self.msg('success',res.msg);
                } else {
                    self.msg('error',res.msg);
                }
            })
        },
        msg(type,msg) {
            this.$notify({
            message: msg,
            type: type
            });
        },
        handleClick(scope) {
            this.dutyTime = scope.row;
        },
        deleteError(scope) {
            var self = this;
            self.dutyTime.id = scope.row.id;
            self.dutyTime.action = self.constVal.deleteErro;
            saveTime(self.dutyTime).then((res) => {
                if(!!res.code) {
                    self.msg('success',res.msg);
                    self.tableData = self.tableData.filter((item) => { return item.id!=scope.row.id });
                } else {
                    self.msg('error',res.msg);
                }
            })
        },
        showRecord() {
            var self = this;
            if(self.month != 0) {
                self.month = 0;
            }
            if(!self.pre_request('isShowRecord')) return;
            self.dutyTime.action = self.constVal.showRecode;
            saveTime(self.dutyTime).then((res) => {
                self.tableData = res.data;
            })
        },
        checkMonth() {
            if(!this.dutyTime.month) {
                this.msg('error', 'your month is null');
                return false;
            } else {
                return true;
            }
        },
        pre_request(actionType) {
            var self = this;
            if(!self.checkMonth()) return false;
            if(self.dutyTime.month != self.month) {
                self.month = self.dutyTime.month;
                if( actionType == 'isShowSummary' ) {
                    self.isShowSummary = true;
                    self.isShowRecord = false;
                } else {
                    self.isShowRecord = true;
                    self.isShowSummary = false;
                }
                return true;
            } else {
                self[actionType] = !self[actionType];
            }
        },
        monSummary() {
            var self = this;
            if(self.month != 0) {
                self.month = 0;
            }
            if(!self.pre_request('isShowSummary')) return;
            self.dutyTime.action = self.constVal.mon_summary;
            saveTime(self.dutyTime).then((res) => {
                self.summaryTable = res.data;
            })
        },
        clearTime(item) {
            if( !!this.dutyTime.reason ) {
                this.dutyTime.startTime = '';
                this.dutyTime.endTime = '';
            }
        },
        excel() {
            window.location = 'http://localhost:88/sign/datasPhp/signService/exportExcelService.php?month=11'
        }
    }
  }
</script>

<style>
    .record {
        width: 60%;
        margin: 50px auto;

    }
</style>

