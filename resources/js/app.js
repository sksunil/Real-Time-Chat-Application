require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import VueChatScroll from 'vue-chat-scroll'
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'

Vue.use(VueChatScroll)
Vue.use(Toaster, {timeout: 5000})
Vue.component('message', require('./components/message.vue'));

const app = new Vue({
    el: '#app',
    data: {
        message: '',
        chat: {
            message: [],
            user:[],
            color:[],
            time:[]
        },
        typing:'',
        numberOfUsers: 0
    },
    watch:{
        message(){
            Echo.private('chat')
                .whisper('typing',{
                    name: this.message
                })
        }
    },
    mounted() {
        this.getOldMessages();
        Echo.private('chat')
            .listen('ChatEvent',(e) => {
            this.chat.message.push(e.message);
            this.chat.color.push('warning');
            this.chat.user.push(e.user);
            this.chat.time.push(this.getTime());
        axios.post('/saveToSession',{
            chat : this.chat
        })
            .then(response => {
            console.log(response);
    })
    .catch(error =>{
            console.log(error);
    });
           })
           .listenForWhisper('typing',(e) => {
               if(e.name != ''){
                   this.typing ='typing...'
                } else {
              this.typing =''
             }
        });
        Echo.join('chat')
            .here((users) => {
            this.numberOfUsers = users.length;
           })
             .joining((user) => {
            this.numberOfUsers += 1;
            this.$toaster.success(user.name + ' is joined the chat room.')

    })
            .leaving((user) => {
            this.numberOfUsers -=1;
            this.$toaster.error(user.name + ' is leaved the chat room.')
    });

    },
    methods: {
        send() {
            if (this.message.length != 0) {
                this.chat.message.push(this.message);
                this.chat.user.push('you');
                this.chat.time.push(this.getTime());
                this.chat.color.push('success');
                axios.post('/send',{
                    message : this.message,
                    chat : this.chat
                })
                    .then(response => {
                        console.log(response);
                        this.message = '';
                })
                .catch(error =>{
                    console.log(error);
                });
            }
        },

        getTime(){
            let time = new Date();
            return time.getHours() + ':' + time.getMinutes();
        },
        getOldMessages(){
            axios.post('/getOldMessages')
                .then(response => {
                    console.log(response);
                    if(response.data != ''){
                        this.chat = response.data;
                    }
            })
            .catch(error => {
                console.log(error);
            })
        },
        deleteSession(){
            axios.post('/deleteSession')
                .then(response => {
                this.$toaster.success('Chat messages removed successfully.');

        })
        }
    }
});
