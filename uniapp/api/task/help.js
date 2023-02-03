import request from "@/utils/request.js";


/**
 * 添加任务
 * 
 */
export function apiTaskHelpLists(data={}) {
	return request.post('/task/help/lists',data,{
		URL:2
	});
}

/**
 * 添加任务
 * 
 */
export function apiTaskHelpDetail(data={}) {
	return request.post('/task/help/detail',data,{
		URL:2
	});
}