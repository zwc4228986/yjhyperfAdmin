import request from "@/utils/request.js";



/**
 * 添加任务
 * 
 */
export function getSignTaskLists(data) {
	return request.post('/api/sign/task/lists',data,{
		URL:3
	});
}

export function getSignList(data) {
	return request.post('/api/sign/lists',data,{
		URL:3
	});
}

export function toSign(data) {
	return request.post('/api/sign',data,{
		URL:3
	});
}


/**
 * 添加任务
 * 
 */
export function signTaskReceive(code) {
	return request.post('/user/sign/task/receive',{code},{
		URL:2
	});
}

export function signTaskDo(code) {
	return request.post('/user/sign/task/receive',{code},{
		URL:2
	});
}
