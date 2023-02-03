import request from "@/utils/request.js";


/**
 * 添加任务
 * 
 */
export function getSettlesTaskRefresh(data={}) {
	return request.post('/api/settles/taskRefresh/lists',data,{
		URL:2
	});
}


/**
 * 添加任务
 * 
 */
export function getSettlesTaskTop(data={}) {
	return request.post('/api/settles/taskTop/lists',data,{
		URL:2
	});
}