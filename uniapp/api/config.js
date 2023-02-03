import request from "@/utils/request.js";



/**
 * 添加任务
 * 
 */
export function getConfig(key) {
	return request.post('/api/config/get',{key},{
		URL:2
	});
}

/**
 * 添加任务
 * 
 */
export function getFile(key) {
	return request.post('/api/config/getFile',{key},{
		URL:2
	});
}

/**
 * 添加任务
 * 
 */
export function getHomeVideo() {
	return request.post('/api/config/home-video',{},{
		URL:2
	});
}

/**
 * 添加任务
 * 
 */
export function getTaskHomeVideo() {
	return request.post('/api/config/home-task-video',{},{
		URL:2
	});
}

