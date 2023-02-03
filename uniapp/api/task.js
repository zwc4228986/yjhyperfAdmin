import request from "@/utils/request.js";



/**
 * 添加任务
 * 
 */
export function taskLists(data) {
	return request.post('/api/task/task/lists',data,{
		URL:2
	});
}

/**
 * 添加任务
 * 
 */
export function taskHotLists(data) {
	return request.post('/api/task/task/hot',data,{
		URL:2
	});
}

/**
 * 添加任务
 * 
 */
export function taskRecommentLists(data) {
	return request.post('/api/task/task/recomment',data,{
		URL:2
	});
}


/**
 * 添加任务
 * 
 */
export function taskReceiveLists(data) {
	return request.post('/user/task/taskReceive/lists',data,{
		URL:2
	});
}

/**
 * 添加任务
 * 
 */
export function taskReceiveCancel(data) {
	return request.post('/user/task/taskReceive/cancel',data,{
		URL:2
	});
	
}

/**
 * 添加任务
 * 
 */
export function taskReceiveDetailSubmit(data) {
	return request.post('/user/task/taskReceive/submitDetail',data,{
		URL:2
	});
}


/**
 * 添加任务
 * 
 */
export function taskReceiveSubmit(data) {
	return request.post('/user/task/taskReceive/submit',data,{
		URL:2
	});
}

/**
 * 添加任务
 * 
 */
export function taskAdd(data) {
	return request.post('/user/task/task/add',data,{
		URL:2
	});
	
}

/**
 * 添加任务
 * 
 */
export function taskEdit(data) {
	return request.post('/user/task/task/edit',data,{
		URL:2
	});
	
}

/**
 * 添加任务
 * 
 */
export function taskDetail(data) {
	return request.post('/user/task/task/detail',data,{
		URL:2
	});
	
}


/**
 * 添加任务
 * 
 */
export function taskReceive(data) {
	return request.post('/user/task/task/receive',data,{
		URL:2
	});
}


/**
 * 添加任务
 * 
 */
export function taskTypes(data={}) {
	return request.post('/api/task/task/types',data,{
		URL:2
	});
	
}

/**
 * session
 * 
 */
export function ChatSession(data={}) {
	
	return request.post('/user/chat/chat-session/lists',data,{
		URL:2
	});
	
}

/**
 * 客服详情
 */
export function getChatRecord(data) {
	return request.post("/user/chat/chat-records/lists", data,{
		URL:2
	});
}


export function getTaskReportType(data) {
	return request.post("/api/task/task-report-types/lists", data,{
		URL:2
	});
}


/**
 * 添加任务
 * 
 */
export function addTaskReport(data) {
	return request.post('/user/task/task-report/add',data,{
		URL:2
	});
}
