<template>
    <div id="index">
        <p>{{user.name}}</p>
        开始打卡
    </div>
</template>

<script>
  import { testSession } from '@/api/http';

  export default {
    data() {
        return {
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

    }
  }
</script>
