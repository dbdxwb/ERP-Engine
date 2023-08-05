<template>

    <div class="navbar">
        <div class="left-side">
            <a-space>
                <img
                    alt="logo"
                    src="//p3-armor.byteimg.com/tos-cn-i-49unhts6dw/dfdba5317c0c20ce20e64fac803d52bc.svg~tplv-49unhts6dw-image.image"
                />
                <a-typography-title
                    :style="{ margin: 0, fontSize: '18px' }"
                    :heading="5"
                >
                    {{ appInfo.name }}
                </a-typography-title>
            </a-space>
        </div>
        <div class="menu-side">
            <div class="menu-demo">
                <a-menu mode="horizontal" :selected-keys="[active_navbar]"
                >
                    <a-menu-item
                        v-for="(item, index) in navbar"
                        :key="index"
                        @click="target(item)"
                        :style="{fontSize: '16px'}"
                    >
                        {{ item.name }}
                    </a-menu-item>
                </a-menu>
            </div>
        </div>
        <ul class="right-side">
            <li>
                <a-popover title="消息通知" contentStyle="{ width: '300px' }">
                    <template v-slot:default>
                        <a-badge dot :count="notifyNum" :offset="[-4, 5]">
                            <a-button shape="round" type="text" :style="{ fontSize: '20px' }">
                                <icon-notification/>
                            </a-button>
                        </a-badge>
                    </template>
                    <template v-slot:content>
                        <div v-if="notify.length">
                            <a-list maxHeight="300">
                                <a-list-item v-for="item in notify">
                                    <a-badge :count="item.read ? 0 : 1" dot :offset="[8, 0]">{{
                                            item.message
                                        }}
                                    </a-badge>
                                </a-list-item>
                            </a-list>
                            <div class="mt-2 flex gap-2 justify-end">
                                <a-link @click="readNotify">一键已读</a-link>
                                <a-link @click="delNotify">清空消息</a-link>
                            </div>
                        </div>
                        <a-empty v-else description="暂无通知消息"/>
                    </template>
                </a-popover>
            </li>
            <li>
                <a-button type="text" shape="round" :style="{ fontSize: '20px' }" @click="toggleDarkMode">
                    <template v-if="darkMode === 'light'">
                        <icon-sun-fill/>
                    </template>
                    <template v-else>
                        <icon-moon-fill/>
                    </template>
                </a-button>
            </li>
            <li>
                <a-dropdown>
                    <template v-slot:default>
                        <div class="flex items-center gap-2 px-2 cursor-pointer">
                            <a-avatar size="28" :src="userInfo.avatar">{{
                                    !userInfo.avatar && userInfo.avatar_text
                                }}
                            </a-avatar>
                            <div>
                                <div>{{ userInfo.showname }}</div>
                                <div v-if="userInfo.subname" class="text-gray-400">{{ userInfo.subname }}</div>
                            </div>
                        </div>
                    </template>
                    <template v-slot:content>
                        <a-doption @click="openFrontPage">前台首页</a-doption>
                        <a-doption @click="openUserProfile">修改资料</a-doption>
                        <a-doption @click="logout">退出登录</a-doption>
                    </template>
                </a-dropdown>
            </li>
        </ul>
    </div>
</template>

<script>
import {defineComponent} from 'vue';
import {router, moduleName} from '../../utils/router';
import {loginOut, getLocalUserInfo} from '../../utils/user';
import {event, menuNavigation} from '../../utils/event';
import {weather} from '../../utils/util';
import Route from "../route/Route.vue";

export default defineComponent({
    props: {
        menu: {
            type: Array,
            default: () => [],
        },
        navbar: {
            type: Array,
            default: () => [],
        },
        active_navbar: {
            type: String,
            default: 'index',
        },
        currentIndexs: {
            type: Array,
            default: () => [],
        },
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
        // 菜单点击
        target(e) {
            router.push(e.url || e.menu[0].menu[0].url);
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

<style scoped lang="less">
.navbar {
    display: flex;
    justify-content: space-between;
    height: 100%;
    background-color: var(--color-bg-2);
    border-bottom: 1px solid var(--color-border);
}

.left-side {
    display: flex;
    align-items: center;
    padding-left: 20px;
    width: 14rem;

}

.menu-side {
    display: flex;
    align-items: center;
    padding-right: 20px;
    width: 90rem;

}

.right-side {
    width: 18rem;
    display: flex;
    padding-right: 20px;
    list-style: none;

    :deep(.locale-select) {
        border-radius: 20px;
    }

    li {
        display: flex;
        align-items: center;
        //padding: 0 10px;
    }

    a {
        color: var(--color-text-1);
        text-decoration: none;
    }

    .nav-btn {
        border-color: rgb(var(--gray-2));
        color: rgb(var(--gray-8));
        font-size: 16px;
    }

    .trigger-btn,
    .ref-btn {
        position: absolute;
        bottom: 14px;
    }

    .trigger-btn {
        margin-left: 14px;
    }
}

.menu-demo {
    box-sizing: border-box;
    width: 100%;
    //padding: 40px;
    background-color: var(--color-neutral-2);
    font-size: 16px;
}
</style>

<style lang="less">
.message-popover {
    .arco-popover-content {
        margin-top: 0;
    }
}
</style>
