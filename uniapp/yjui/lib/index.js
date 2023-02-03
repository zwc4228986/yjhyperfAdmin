var disable = false;

const limit = ($second = 1) => {
	if (disable == true) {
		return true;
	}
	if (disable == false) {
		disable = true;
		setTimeout(res => {
			disable = false;
		}, $second * 1000)
		return false;
	}
	
}

const push = (url,time=0)=>{
	setTimeout(()=>{
		uni.redirectTo({
			url:url,
		})
	},time)
}

uni.limit = limit;
uni.push = push;

const install = (Vue) => {
	vue.prototype.limit = limit;
}

export default {
	install
}
