// +----------------------------------------------------------------------
// | CRMEB [ CRMEB赋能开发者，助力企业发展 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016~2021 https://www.crmeb.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed CRMEB并不是自由软件，未经许可不能去掉CRMEB相关版权
// +----------------------------------------------------------------------
// | Author: CRMEB Team <admin@crmeb.com>
// +----------------------------------------------------------------------

import Vue from 'vue'
import App from './App'
import store from './store'
import Cache from './utils/cache'
import util from 'utils/util'
import configs from './config/app.js'
import socket from './libs/new_chat.js'
import yjSocket from './libs/chat2.js'
import yjui from '@/yjui/lib'

import initModal from "@/store/myAlert.js";
console.log('initModel',initModal)
initModal(Vue)

Vue.prototype.$util = util;
Vue.prototype.$config = configs;
Vue.prototype.$Cache = Cache;
Vue.prototype.$eventHub = new Vue();
Vue.prototype.$socket = new socket();
Vue.prototype.$yjSocket = new yjSocket();
Vue.config.productionTip = false
import pageLoading from './components/pageLoading.vue'
import skeleton from './components/skeleton/index.vue'
import ourLoading from '@/components/our-loading/our-loading.vue'
import uView from '@/uni_modules/uview-ui'
Vue.use(uView)
Vue.component('skeleton', skeleton)
Vue.component('pageLoading',pageLoading)
Vue.component('ourLoading', ourLoading)

// #ifdef H5

import { parseQuery } from "./utils";
import Auth from './libs/wechat';
import { SPREAD } from './config/cache';
Vue.prototype.$wechat = Auth;
Vue.prototype.$BASE_URL = 'http:4399.com';

Vue.prototype.$store = store



// initModal(Vue);


let cookieName = "VCONSOLE",
	query = parseQuery(),
	urlSpread = query["spread"],
	vconsole = query[cookieName.toLowerCase()],
	md5Crmeb = "b14d1e9baeced9bb7525ab19ee35f2d2", //CRMEB MD5 加密开启vconsole模式
	md5UnCrmeb = "3dca2162c4e101b7656793a1af20295c"; //UN_CREMB MD5 加密关闭vconsole模式

if (urlSpread !== undefined) {
	var spread = Cache.get(SPREAD);
	urlSpread = parseInt(urlSpread);
	if (!Number.isNaN(urlSpread) && spread !== urlSpread) {
		Cache.set("spread", urlSpread || 0);
	} else if (spread === 0 || typeof spread !== "number") {
		Cache.set("spread", urlSpread || 0);
	}
}

if (vconsole !== undefined) {
  if (vconsole === md5UnCrmeb && Cache.has(cookieName))
	  Cache.clear(cookieName);
} else vconsole = Cache.get(cookieName);

import VConsole from './components/vconsole.min.js'

if (vconsole !== undefined && vconsole === md5Crmeb) {
	Cache.set(cookieName, md5Crmeb, 3600);
	let vConsole = new VConsole();
}
// let snsapiBase = 'snsapi_base';
// Auth.isWeixin() && Auth.oAuth(snsapiBase);

//全局路由前置守卫
// #endif

App.mpType = 'app'


const app = new Vue({
    ...App,
	store,
	Cache,
})
app.$mount();