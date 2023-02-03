// +----------------------------------------------------------------------
// | CRMEB [ CRMEB赋能开发者，助力企业发展 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016~2021 https://www.crmeb.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed CRMEB并不是自由软件，未经许可不能去掉CRMEB相关版权
// +----------------------------------------------------------------------
// | Author: CRMEB Team <admin@crmeb.com>
// +----------------------------------------------------------------------

import $store from "@/store";
import {
	HTTP_REQUEST_URL
} from "@/config/app.js";


import {
	getServerType
} from '@/api/api.js';
const Socket = function() {

	// this.ws.close(this.close.bind(this));
};

// const VUE_APP_WS_URL = 'wss://api.xiaomubiao.shopping';
const VUE_APP_WS_URL = 'wss://api.xiaomubiao.shopping/wss';
// const VUE_APP_WS_URL = 'ws://150.158.155.57:9702';

// #ifdef H5

function wss(wsSocketUrl) {
	let ishttps = document.location.protocol == 'https:';
	if (ishttps) {
		return wsSocketUrl.replace('ws:', 'wss:');
	} else {
		return wsSocketUrl.replace('wss:', 'ws:');
	}
}
// #endif

class WsSocket {
		config = {
			heartbeat: {
			  setInterval: null,
			  pingInterval: 20000,
			  pingTimeout: 60000,
			},
			reconnect: {
			  lockReconnect: false,
			  setTimeout: null, // 计时器对象
			  time: 5000, // 重连间隔时间
			  number: 1000, // 重连次数
			},
		}
		
		ws = null
		
		onSocketOpen(my) {
			console.log('链接成功');
			this.heartbeat();
			uni.$emit('socketOpen', my)
		}
		heartbeat(){
			clearInterval(this.config.heartbeat.setInterval);
			this.config.heartbeat.setInterval = setInterval(()=>{
				console.log('ping');
				this.sendEvent('ping');
			}, 10000);
		}
		clearhearbeat(){
			clearInterval(this.config.heartbeat.setInterval);
			this.config.heartbeat.setInterval = null;
		}
		init() {
			var that = this;
		}
		sendEvent(event,data={}){
			this.send({
				event:event,
				data:data
			})
		}
		send(data) {
		//判断连接是否断开
				if(!this.isConnect()){
					console.log('socket 通道异常，正在开启重连');
					setTimeout(()=>{
						//doSomething(这里写时间到之后需要去做的事情)
						this.reconnect();
						this.send(data);	//重新发送
					}, 200);
					return;
				}
			//判断连接是否断开
			console.log(this.ws.readyState);
			data.token = $store.state.app.token;
			let datas = JSON.stringify(data)
			console.log(datas);
			return this.ws.send({
				data: datas
			});
		}
			isConnect(){
					if (this.ws) {
						if (this.ws.readyState == this.ws.OPEN) {
							return true;
						}
					}
					return false;
				}
		onMessage(res) {
			console.log(res);
			const {
				event,
				content = {},
				data = {}
			} = JSON.parse(res.data);
			console.log(event,content,data);
			if(event == 'un_read_total_num'){
				$store.commit('webSocket/unReadNum',content);
				return false;
			}
			
			if(event == 'all_people'){
				$store.commit('webSocket/people',content);
			}
			
			if(event == 'PRIVATE_MESSAGE_RECEIVED'){
				$store.commit('webSocket/sendPeople',content);
			}
			
			if(event == 'navigateTo'){
				uni.navigateTo({
					url:data.url
				})
				return 
			}
			if(event == 'goHome'){
				uni.switchTab({
					url:'/pages/stores/index'
				})
				
				return
			}
		
			uni.$emit(event, content)
		}

		onClose() {
			console.log('连接断开了');
			this.closeConnect();
			this.clearhearbeat();
			this.reconnect();
		}
		onError(e) {
			uni.$emit("socket_error", e);
		}
		close() {
		
		}
		
		onStart(token, form_type='miniapp') {
			
			let wssUrl = `${VUE_APP_WS_URL}`

			this.ws = uni.connectSocket({
				url: wssUrl + '/user?type=user&token=' + token + '&form_type=' + form_type,
				method: 'GET',
				success: (res) => {}
			});
			console.log(this.ws);

			this.ws.onOpen(this.onSocketOpen.bind(this))
			this.ws.onError(this.onError.bind(this));
			this.ws.onMessage(this.onMessage.bind(this))
			this.ws.onClose(this.onClose.bind(this));
		}
		connect() {
			if (this.ws) {
				if (this.ws.readyState == this.ws.OPEN) {
					return false;
				}
			}
			if(this.config.reconnect.setTimeout){
				console.log(`网络连接已断开，正在尝试重新连接...`)
			}
			let token = $store.state.app.token;
			console.log(token);
			if(token == false){
				console.log(token);
				this.reconnect();
				return;
			}
			this.onStart(token);
		}
		reconnect() {
			
		    // 没连接上会一直重连，设置延迟避免请求过多
			if(this.config.reconnect.setTimeout==null){
				clearTimeout(this.config.reconnect.setTimeout)
				this.config.reconnect.setTimeout = setInterval(() => {
				  this.connect()
				  
				}, this.config.reconnect.time)
				this.connect()
			}
		}
		closeConnect(){
			clearInterval(this.config.reconnect.setTimeout);
			this.config.reconnect.setTimeout = null;
			uni.closeSocket();
		}
}

export default WsSocket;
