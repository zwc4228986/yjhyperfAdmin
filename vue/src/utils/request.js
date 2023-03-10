import axios from "axios";
import { ElMessage, ElMessageBox, ElNotification } from "element-plus";
import sysConfig from "@/config";
import tool from "@/utils/tool";
import router from "@/router";

axios.defaults.baseURL = sysConfig.API_URL;

axios.defaults.timeout = sysConfig.TIMEOUT;

// HTTP request 拦截器
axios.interceptors.request.use(
	(config) => {
		let token = tool.data.get("TOKEN");
		if (token) {
			config.headers[sysConfig.TOKEN_NAME] =
				sysConfig.TOKEN_PREFIX + token;
		}
		if (!sysConfig.REQUEST_CACHE && config.method == "get") {
			config.params = config.params || new FormData();
			config.params["_"] = new Date().getTime();
		}
		Object.assign(config.headers, sysConfig.HEADERS);
		return config;
	},
	(error) => {
		return Promise.reject(error);
	}
);

// HTTP response 拦截器
axios.interceptors.response.use(
	(response) => {
		return response;
	},
	(error) => {
		if (error.response) {
			if (error.response.status == 404) {
				ElNotification.error({
					title: "请求错误",
					message: "Status:404，正在请求不存在的服务器记录！",
				});
			} else if (error.response.status == 500) {
				ElNotification.error({
					title: "请求错误",
					message:
						error.response.data.message ||
						"Status:500，服务器发生错误！",
				});
			} else if (error.response.status == 401) {
				ElMessageBox.confirm(
					"当前用户已被登出或无权限访问当前资源，请尝试重新登录后再操作。",
					"无权限访问",
					{
						type: "error",
						closeOnClickModal: false,
						center: true,
						confirmButtonText: "重新登录",
					}
				)
					.then(() => {
						router.replace({ path: "/login" });
					})
					.catch(() => {});
			} else {
				ElNotification.error({
					title: "请求错误",
					message:
						error.response.data.message ||
						`Status:${error.response.status}，未知错误！`,
				});
			}
		} else {
			ElNotification.error({
				title: "请求错误",
				message: "请求服务器无响应！",
			});
		}
		return Promise.reject(error.response);
	}
);

class http {
	config = {
		url: "",
		method: "post",
		params: new FormData(),
	};
	beforeSuccessCallback = [];
	axiosConfig = {};
	url(url) {
		url && (this.config.url = url);
		return this;
	}
	reflush(){
		this.config = {
			url: "",
			method: "post",
			params: new FormData(),
		}
		this.beforeSuccessCallback = [];
		return this;
	}
	axiosRequest() {
		return axios({
			method: this.config.method,
			url: this.config.url,
			data: this.config.params,
			...this.axiosConfig,
		})
			.then(({ data }) => {
				return Promise.resolve(data);
			})
			.catch((error) => {
				return Promise.reject(error);
			});
	}
	request() {
		return this.axiosRequest().then(({ status, data, message, code }) => {
			var isReject = false;
			// console.log(this.config.url,status,data,this.beforeSuccessCallback);
			switch (status) {
				case 0:
				case 200:
					return this.beforeSuccess().success(data);
				case 1000:
					ElMessage.error({
						message: message,
						type: "error",
					});
					
					break;
				case 40001:
					ElMessageBox.confirm(
						'您的登录信息已经过期',
						'登录过期',
						{
							confirmButtonText: '重新登录',
							type: 'warning',
							showCancelButton:false,
							callback:res=>{
								tool.data.remove("TOKEN");
								router.push('login');
							}
						}
						);
					break;
			}
			return Promise.reject({ message, data, status });
		});
	}
	post(url) {
		this.config.method = "post";
		this.url(url);
		return this.request();
	}
	params(params = new FormData()){
		this.config.params = params;
		return this;
	}
	addParams(params = new FormData()) {
		if(params instanceof FormData){
			for (const item of params.keys()) {
				this.config.params.append(item, params.get(item))
			}
		}else{
			console.log(this.config.params);
			for (const item of Object.keys(params)) {
				this.config.params.append(item, params[item])
			}
		}
		// this.config.params = Object.assign(this.config.params, params);
		// this.config.params.push
		return this;
	}
	get(url, params) {
		this.config.method = "get";
		this.config.url = url;
		this.params(params);
		return this.request();
	}
	beforeSuccess() {
		this.beforeSuccessCallback.forEach((fun) => {
	 		fun();
		});
		return this;
	}
	success(data) {
		return Promise.resolve(data);
	}
	showSuccessInfo(message) {
		this.beforeSuccessCallback.push(function () {
			ElMessage.success({
				message: message,
				type: "error",
			});
		});
		return this;
	}
}

export default function(){
	return (new http());
}

