# 插件名称：d-alert 更新时间：2022.06.11



## 使用步骤 仅3步（完成流程-已亲测）

### 【一】复制图片素材：

````
1.复制图片目录到【根目录】：
'@/uni_modules/d-swiper-type/components/d-swiper-type/pages/static'

````


### 【二】根目录下的main.js文件增加这几行到第10行左右（放在中间代码就行）：
````

// 	----------------------------------弹框start

import Vuex from 'vuex'
import store from './store'
Vue.prototype.$store = store

import initModal from "@/store/myAlert.js";
initModal(Vue);


// 	----------------------------------弹框end

````


### 【三】完整使用代码（其实也就简单几行代码就能行了）：


````
使用方法：

1.页面中使用组件


<template>
	<view>
		
		<view style="width: 100%;height: 300rpx;" @click="_open_tan">
			打开弹框
		</view>
		
		
		<dAlert ></dAlert>
		
	</view>
</template>

<script>
	import dAlert from '@/uni_modules/d-alert/components/d-alert/d-alert.vue'
	
	export default {
		components: {
			"dAlert": dAlert,
		},
		
		onLoad() {
			
			this._open_tan()
		},
		methods: {
			
			//	打开弹框
			_open_tan() {
				console.log('____open___')
				this.$showModal({
				  content: '这是一个自定义弹框',
				  showCancel:false,
				  price:199,
				  msg:'限时活动',
				  time:'限时时间：2022.06.11——2022.10.01',
				  success(res) {
				    if (res.confirm) {
				      console.log('用户点击确定-领取成功')
				    } else if (res.cancel) {
				      console.log('用户点击取消')
				    }
				  }
				})
			},
			 
			// 
		}
	}
</script>



【可直接运行查看】完整demo案例，
/uni_modules/d-alert/components/d-alert/demo

````

