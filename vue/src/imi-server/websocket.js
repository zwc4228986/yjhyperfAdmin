import socketInstance from "@/imi-server/socket-instance";
import {useRouter} from 'vue-router';
import tool from "@/utils/tool";

export default {
	install(app) {
		let token = tool.data.get("TOKEN");
		// console.log(token)
		if(token){
			this.initialize()
		}
		// console.log('websocket',router.currentRoute.value);
		//
		// console.log('websocket')
	},
	initialize(){
		let res = socketInstance.connect()
		console.log(res);
	}
}


