<template>
    <div class="flex flex-col lg:h-screen">
        <div class="flex-grow bg-gray-100 dark:bg-blackgray-2 overflow-y-auto app-scrollbar">
            <div class="p-4 pb-0 flex  items-center">
                <div class="flex-grow">
                    <a-breadcrumb>
                        <a-breadcrumb-item v-for="(item, index) in navList" :key="index">{{ item.name }}</a-breadcrumb-item>
                    </a-breadcrumb>
                </div>
                <template v-if="form">
                    <div class="flex-none flex gap-2">
                        <route type="back" v-if="back">
                            <a-button type="outline">返回</a-button>
                        </route>
                        <a-button type="primary" :html-type="submit ? 'button' : 'submit'" @click="submit" :loading="formLoading">{{ submitText }}</a-button>
                    </div>
                </template>
            </div>
            <slot></slot>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue';
import { router, moduleName } from '../../utils/router';
import { loginOut, getLocalUserInfo } from '../../utils/user';
import { event, menuNavigation } from '../../utils/event';
import { weather } from '../../utils/util';
import Route from "./Route.vue";

export default defineComponent({
    props: {
        title: {
            type: String,
        },
        form: {
            type: Boolean,
            default: false,
        },
        back: {
            type: Boolean,
            default: true,
        },
        save: {
            type: Boolean,
            default: true,
        },
        submit: {
            type: Function,
        },
        submitText: {
            type: String,
            default: '保存',
        },
        formLoading: {
            type: Boolean,
            default: false,
        },
    },
    components: {
        Route,
    },
    data() {
        return {
            appInfo: window.appConfig,
            darkMode: localStorage.getItem('darkMode') === 'dark' ? 'dark' : 'light',
            navList: [],
            userInfo: getLocalUserInfo(),
            notify: [],
            notifyNum: 0,
            weather: {},
        };
    },
    methods: {
        getNotify() {
            if (window.dataNotify) {
                this.notify = window.dataNotify.list;
                this.notifyNum = window.dataNotify.num;
            }
        },
        readNotify() {
            event.emit('app-notify-read');
        },
        delNotify() {
            event.emit('app-notify-del');
        },
        toggleDarkMode() {
            this.darkMode = this.darkMode === 'dark' ? 'light' : 'dark';
            event.emit('switch-dark', this.darkMode);
        },
        openFrontPage() {
            window.open('/');
        },
        openUserProfile() {
            router.dialog('/' + moduleName() + '/system/user/page/' + this.userInfo.user_id);
        },
        logout() {
            loginOut();
        },
    },
    created() {
        weather((res) => {
            this.weather = res;
        });
        event.add('app-notify', () => {
            this.getNotify();
        });
    },
    mounted() {
        menuNavigation.on((data) => {
            this.navList = data;
        });
        this.getNotify();
    },
});
</script>

<style>
/* Your styles here */
</style>
