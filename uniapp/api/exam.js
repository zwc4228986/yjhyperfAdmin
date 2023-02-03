import request from "@/utils/request.js";


/**
 * 添加任务
 * 
 */
export function examQuestion(data={}) {
	return request.post('/exam/question',data,{
		URL:2
	});
}
/**
 * 添加任务
 * 
 */
export function examToday(data={}) {
	return request.post('/exam/today',data,{
		URL:2
	});
}

/**
 * 添加任务
 * 
 */
export function examSubmit(data={}) {
	return request.post('/exam/submit',data,{
		URL:2
	});
}