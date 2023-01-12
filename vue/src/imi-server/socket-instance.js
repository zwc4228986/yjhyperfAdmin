import WsSocket from './ws-socket'
import tool from "@/utils/tool";
import sysConfig from "@/config";

class SocketInstance {
	socket

	constructor() {
		this.socket = new WsSocket(
			()=>{
				let token = tool.data.get("TOKEN");
				if(token == null){
					// window.location.reload()
				}
				return `${sysConfig.WS_URL}?token=` + token
			}
		)
		this.RegisterEvents();
	}

	RegisterEvents(){
		// this.socket.RegisterEvent();
	}


	// 连接 WebSocket 服务
	connect() {
		 this.socket.connection()
	}



}

export default new SocketInstance();
