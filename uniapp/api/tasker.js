import request from "@/utils/request.js";



/**
 * 添加任务
 * 
 */
export function taskerLists(data) {
	return request.post('/tasker/task/lists',data,{
		URL:2
	});
}

/**
 * 添加任务
 * 
 */
export function taskerLog(data) {
	return request.post('/tasker/task/log',data,{
		URL:2
	});
}

/**
 * 添加任务
 * 
 */
export function getTaskStatics(data) {
	return request.post('/tasker/user/task-statisc',data,{
		URL:2
	});
}

/**
 * 添加任务
 * 
 */
export function taskerTaskReceiveDetail(data) {
	return request.post('/tasker/task-receive/detail',data,{
		URL:2
	});
}
/**
 * 添加任务
 * 
 */
export function taskerTaskReceiveAudit(data) {
	return request.post('/tasker/task-receive/audit',data,{
		URL:2
	});
}

/**
 * 添加任务
 * 
 */
export function taskerUserInfo(data) {
	return request.post('/api/task/task/getTaskDetail',data,{
		URL:2
	});
}


/**
 * 添加任务
 * 
 */
export function taskerAdd(data) {
	return request.post('/tasker/task/add',data,{
		URL:2
	});
	
}

/**
 * 添加任务
 * 
 */
export function taskerDelete(data) {
	return request.post('/tasker/task/delete',data,{
		URL:2
	});
	
}
/**
 * 添加任务
 * 
 */
export function taskerShelf(data) {
	return request.post('/tasker/task/shelf',data,{
		URL:2
	});
	
}

/**
 * 添加任务
 * 
 */
export function taskerTop(data) {
	return request.post('/tasker/task/top',data,{
		URL:2
	});
	
}
export function taskerRefresh(data) {
	return request.post('/tasker/task/refresh',data,{
		URL:2
	});
	
}

/**
 * 添加任务
 * 
 */
export function taskerReceiveLists(data) {
	return request.post('/tasker/task-receive/lists',data,{
		URL:2
	});
}


/**
 * 添加任务
 * 
 */
export function taskerEdit(data) {
	return request.post('/tasker/task/edit',data,{
		URL:2
	});
	
}

/**
 * 添加任务
 * 
 */
export function taskerDetail(data) {
	return request.post('/tasker/task/detail',data,{
		URL:2
	});
	
}


export function taskerChangePrice(data) {
	return request.post('/tasker/task/changePrice',data,{
		URL:2
	});
	
}

export function taskerChangeNumber(data) {
	return request.post('/tasker/task/changeNumber',data,{
		URL:2
	});
	
}



/**
 * 添加任务
 * 
 */
export function taskerTypes(data={}) {
	return request.post('/api/task/tasker/types',data,{
		URL:2
	});
	
}

/**
 * 添加任务
 * 
 */
export function taskerPay(data={}) {
	return request.post('/tasker/task/pay/task',data,{
		URL:2
	});
	
}
/**
 * 添加任务
 * 
 */
export function taskerPayRefresh(data={}) {
	return request.post('/tasker/task/pay/refresh',data,{
		URL:2
	});
	
}

/**
 * 添加任务
 * 
 */
export function taskerPayTop(data={}) {
	return request.post('/tasker/task/pay/top',data,{
		URL:2
	});
	
}
