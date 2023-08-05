import * as Vue from 'vue'
import App from './src/App.vue'
import ArcoVue from '@arco-design/web-vue'
import NProgress from 'nprogress'
import CScrollbar from 'c-scrollbar'

// import '@arco-design/web-vue/dist/arco.css'
// 引入自定义主题(注意这里要先安装后，才能导入，不然不生效)
import '@arco-themes/vue-taolu-publishing-platform/css/arco.css'
import 'nprogress/nprogress.css'
import './src/common.css'


import draggable from 'vuedraggable'
import JsonViewer from 'vue-json-viewer'
import ArcoVueIcon from '@arco-design/web-vue/es/icon'
import VueApexCharts from 'vue3-apexcharts'
import './src/utils/global'
// 路由
import NodeCreate from './src/components/route/Create.js'
import Route from './src/components/route/Route.vue'
import DataLayout from './src/components/route/Layout.vue'
import DataDialog from './src/components/route/Dialog'
// 公用
import RichText from './src/components/common/RichText.vue'
import Icon from './src/components/common/Icon.vue'
import ImagePreview from './src/components/common/ImagePreview'
// 列表
import DataTable from './src/components/table/DataTable'
import Tree from './src/components/table/Tree'
// 表单
import FormSubmit from './src/components/form/Form.vue'
import DataSelect from './src/components/form/Select'
import DataTreeSelect from './src/components/form/TreeSelect'
import DataCascader from './src/components/form/Cascader'
import DataFile from './src/components/form/File'
import DataFiles from './src/components/form/Files'
import DataImages from './src/components/form/Images'
import DataEditor from './src/components/form/Editor'
import DataChoice from './src/components/form/Choice'
import DataColor from './src/components/form/Color'
import DynamicData from './src/components/form/DynamicData'
import DataMap from './src/components/form/Map'

import './src/utils/window'

import {setup} from 'twind/shim'

import color from './color'
import Spec from "./src/components/form/Spec";

const colors = Object.fromEntries(Object.keys(color.light).map(key => {
    return [key, Object.fromEntries(color.light[key].map((val, index) => {
        return [index === 0 ? 50 : index * 100, val]
    }))]
}))

setup({
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                'blackgray': {
                    1: '#373739',
                    2: '#313132',
                    3: '#2a2a2b',
                    4: '#232324',
                    5: '#17171a',
                },
                ...colors,
            }
        },
    },
})


// 注册到全局
window.Vue = Vue
window.NProgress = NProgress

// 实例注册到全局
const app = window.vueApp = Vue.createApp(App)

app.use(ArcoVue)
app.use(ArcoVueIcon)
app.use(CScrollbar)

window.NProgress.configure({
    easing: 'ease',
    speed: 500,         // 递增进度条的速度
    showSpinner: false, // 是否显示加载ico
    trickleSpeed: 200,  // 自动递增间隔
    minimum: 0.3        // 初始化时的最小百分比
});

app.use(VueApexCharts)

// 链接组件
app.component('route', Route)
// 富文本显示组件
app.component('rich-text', RichText)
// json节点创建组件
app.component('node-create', NodeCreate)
// 图标组件
app.component('icon', Icon)
// 表单提交组件
app.component('app-form', FormSubmit)
// 表格展示组件
app.component('app-table', DataTable)
// 树形列表
app.component('widget-tree', Tree)
// 选择器
app.component('app-select', DataSelect)
// 树形选择器
app.component('app-tree-select', DataTreeSelect)
// 级联选择器
app.component('app-cascader', DataCascader)
// 文件上传
app.component('app-file', DataFile)
app.component('app-files', DataFiles)
app.component('app-images', DataImages)
// 编辑器
app.component('app-editor', DataEditor)
// 动态选择器
app.component('app-choice', DataChoice)
// 颜色选择器
app.component('app-color', DataColor)
// 地图选择器
app.component('app-map', DataMap)

// 动态数据
app.component('app-dynamic-data', DynamicData)
app.component('app-layout', DataLayout)
app.component('app-dialog', DataDialog)
app.component('app-image-preview', ImagePreview)

// 规格
app.component('app-spec', Spec)

// 拖动排序
app.component('draggable', draggable)

// json 查看器
app.component('json-viewer', JsonViewer)


app.mount('#dev-engine-static')

