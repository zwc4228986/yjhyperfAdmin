import request from "@/utils/request.js";



/**
 * 添加任务
 * 
 */
export function userInfo(data) {
	return request.post('/user/user/detail',data,{
		URL:2
	});
}

export function getInviteDetail(data) {
	return request.post('/user/user/invite-detail',data,{
		URL:2
	});
}

export function getBindDetail(data) {
	return request.post('/user/user/bind-detail',data,{
		URL:2
	});
}

export function bind(code) {
	return request.post('/user/user/bind',{code},{
		URL:2
	});
}



