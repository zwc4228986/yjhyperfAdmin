class WsSocket {
	connect = null
	config = {
		headerbeat:{
			setInterval: null,
			pingInterval: 20000,
			pingTimeout: 60000,
		},
		reconnect:{
			lockReconnect:false,
			setTimeout:null,
			time:5000,
			number:1000,
		}
	}
	// 最后心跳时间
	lastTime = 0

	onCallBacks = []
	defaultEvent = {
		onError: evt => {},
		onOpen: evt => {},
		onClose: evt => {},
	}

	constructor(urlCallBack,events){
		this.urlCallBack = urlCallBack;
		this.events = Object.assign({},this.defaultEvent,events);
		this.on('connect',data=>{
			console.log('connect',data);
			this.config.headerbeat.pingInterval = data.ping_interval * 1000;
			this.config.headerbeat.pingTimeout = data.ping_timeout * 1000;
			this.heartbeat();
		})
	}

	//注册事件
	RegisterEvent(eventName,eventCallback){
		this.onCallBacks[eventName] = eventCallback;
		return this;
	}

	on(event,callback){
		this.onCallBacks[event] = callback;
		return this;
	}

	/**
	 * 连接 Websocket
	 */
	connection(type=null) {
		if(type == 1){
			this.connect = null;
			console.log('正在重连');
		}
		this.connect == null && this.loadSocket()
	}
	reConnection(){
		if(this.config.reconnect.setInterval==null){
			this.config.reconnect.setInterval = setInterval(()=>{
				this.connection(1);
			},this.config.reconnect.time);
			this.connection(1);
		}
	}
	heartbeat(){
		console.log('heartbeat')
		clearInterval(this.config.headerbeat.setInterval);

		this.config.headerbeat.setInterval = setInterval(()=>{
			let t = new Date().getTime();
			this.ping();
		},this.config.headerbeat.pingInterval);
	}
	/**
	 * 加载 WebSocket
	 */
	loadSocket() {
		const url = this.urlCallBack()
		const connect = new WebSocket(url)
		console.log(connect);
		connect.onerror = this.onError.bind(this)
		connect.onopen = this.onOpen.bind(this)
		connect.onmessage = this.onMessage.bind(this)
		connect.onclose = this.onClose.bind(this)
		this.connect = connect

	}

	onError(message){
		console.log('onError',message)
	}

	onClose(message){
		console.log('onClose',message);
		clearInterval(this.config.headerbeat.setInterval);
		this.reConnection();
	}

	onOpen(evt){
		console.log('websocket-open',evt);
		if(this.config.reconnect.setInterval){
			console.log('重连成功');
			clearInterval(this.config.reconnect.setInterval);
			this.config.reconnect.setInterval = null;
		}
	}

	onMessage(evt){
		this.lastTime = new Date().getTime();
		let result = this.onParse(evt);
		if(Object.prototype.hasOwnProperty.call(this.onCallBacks, result.event))
		{
			console.log(result);
			this.onCallBacks[result.event](result.data,result.originData)
		}else{
			console.warn(`websocket 消息事件【${result.event}】未绑定`);
		}
		// if(this.onCallBacks.hasOwnProperty()){
		//
		// }
	}

	onParse(evt){
		const {event,content} =  JSON.parse(evt.data);
		return {
			event:event,
			data:content,
			originData:evt.data,
		}
	}

	ping(){
		console.log('websocket-open','ping');
		this.send({
			event:"heartbeat",
			content:"ping"
		})
	}

	send(message){
		this.connect.send(JSON.stringify(message))
	}

}
export default WsSocket
