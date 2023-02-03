import request from "@/utils/request";
import config from "@/config";
import http from "@/utils/request";

//上传配置

export default {
	apiObj: request().url('api/utils/file/upload'), //上传请求API对象
	getImagePath :function(id) {
		return `${config.API_URL}/api/utils/file/${id}`
	},
	successCode: 200, //请求完成代码
	maxSize: 200, //最大文件大小 默认10MB
	parseData: function (res) {
		return {
			code: res.status, //分析状态字段结构
			src: res.data.src, //分析图片远程地址结构
			msg: res.message, //分析描述字段结构
		};
	},
};
