import request from "@/utils/request.js";




export function user_circle(data) {
	return request.post('/api/circle/user',data,{
		URL:3
	});
}


export function getCircleDetail(data) {
	return request.post('/api/circle/detail',data,{
		URL:3
	});
}


export function setCollect(data) {
	return request.post('/api/circle/collect',data,{
		URL:3
	});
}



