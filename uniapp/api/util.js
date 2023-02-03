import request from "@/utils/request.js";



/**
 * 添加任务
 * 
 */
export function getAddressCityName(lat,lng) {
	return request.post('/util/address/analytic',{lat,lng},{
		URL:2
	});
}
