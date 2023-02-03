// +----------------------------------------------------------------------
// | CRMEB [ CRMEB赋能开发者，助力企业发展 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016~2021 https://www.crmeb.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed CRMEB并不是自由软件，未经许可不能去掉CRMEB相关版权
// +----------------------------------------------------------------------
// | Author: CRMEB Team <admin@crmeb.com>
// +----------------------------------------------------------------------

import {
	HTTP_REQUEST_URL,
	HTTP_REQUEST_URL2,
	HTTP_REQUEST_URL3,
	HEADER,
	TOKENNAME
} from '@/config/app';
import {
	toLogin,
	checkLogin
} from '../libs/login';
import store from '../store';


/**
 * 发送请求
 */
function baseRequest(url, method, data, {
	noAuth = false,
	noVerify = false,
	URL = 1,
}) {
	
	let Url = URL==1?HTTP_REQUEST_URL+'/api/':HTTP_REQUEST_URL2,
		header = HEADER;
	if(URL == 3){
		Url = HTTP_REQUEST_URL3;
	}	
	console.log(Url + url);
	
	if (!noAuth) {
		//登录过期自动登录
		if (!store.state.app.token && !checkLogin()) {
			toLogin();
			return Promise.reject({
				msg: '未登录'
			});
		}
	}
	if (store.state.app.token) header[TOKENNAME] = 'Bearer ' + store.state.app.token;
	
	return new Promise((reslove, reject) => {
		uni.request({
			url: Url + url,
			method: method || 'GET',
			header: header,
			data: data || {},
			success: (res) => {
				
				if (noVerify)
					reslove(res.data, res);
				else if (res.data.status == 0){
					reslove(res.data.data, res);
				}
				else if (res.data.status == 200){
					reslove(res.data, res);
				}else if ([410000, 410001, 410002].indexOf(res.data.status) !== -1) {
					toLogin();
					reject(res.data);
				} else if (res.data.status == 410010) {
					uni.showModal({
						title: '提示',
						content: res.data.msg,
						showCancel: false,
						confirmText: '我知道了'
					});
				}  else if(res.data.status == 1000) {
					uni.showModal({
						title: '提示',
						content: res.data.message,
						showCancel: false,
						confirmText: '我知道了'
					});
				}else
					reject(res.data.msg || '系统错误');
			},
			fail: (msg) => {
				let data = {
					mag: '请求失败',
					status: 1 //1没网
				}
				// #ifdef APP-PLUS
				reject(data);
				// #endif
				// #ifndef APP-PLUS
				reject('请求失败');
				// #endif
			}
		})
	});
}

const request = {};

['options', 'get', 'post', 'put', 'head', 'delete', 'trace', 'connect'].forEach((method) => {
	request[method] = (api, data, opt) => baseRequest(api, method, data, opt || {})
});



export default request;
