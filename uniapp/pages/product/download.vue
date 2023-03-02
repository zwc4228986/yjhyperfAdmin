<template>
	<view class="download-wrap">
	  <view class="download-info">
		<view class="image">
			<u-image width="200" height="160" :src="data.product.image.path_format"></u-image>
		</view>
		<view class="title">{{data.product.name}}</view>
		<view class="size"></view>
	  </view>
	  <view class="download-btn">
		  <!-- <view>预览</view> -->
		  <block v-for="(item,index) in data.product_resource" v-bind:key="index" >
			  <div v-if="item.type == 0">
				  <yj-button
					bg="#FF9640"
					color="white"
					:customStyle="{ width: '300rpx' }"
					shape="circle"
					text="复制下载链接"
					@click="goSign"
				  ></yj-button>
			  </div>
			  
			  <div v-if="item.type == 1" style="margin-top: 10rpx;">
			  				  <yj-button
			  					bg="#FF9640"
			  					color="white"
			  					:customStyle="{ width: '300rpx' }"
			  					shape="circle"
			  					text="百度云下载"
			  					@click="baidu"
			  				  ></yj-button>
			  </div>
			
			  <!-- <view>百度网盘</view> -->
		  </block>
			
	  </view>
	</view>
</template>

<script>
	import {orderDownloadDetail} from "@/api/order.js"
	
	export default {
		data() {
			return {
				data:{},
			}
		},
		onLoad(options){
			orderDownloadDetail({order_product_id:options.id}).then(res=>{
				this.data = res;
			})
		},
		onReady(){
			
		},
		methods: {
			baidu(){
				let netdiskShareInterface = requirePlugin('netdiskShare');
				let url = 'https://pan.baidu.com/s/1ULG6iaKKSLrpW7pmFE8x-g'; // 分享短链接，必填
				let sharecode = 'o32c'; // 提取码，选填
				let origin = '抖资源'; // 当前小程序名称，必填，如百度网盘
				let homePageUrl = '/pages/index/index'; // 当前小程序首页地址，选填，如/pages/index/index
				wx.navigateTo({
				    url: `plugin-private://wx8c873f830774d652/pages/outsite-chain/share-code/index?url=${url}&sharecode=${sharecode}&home=${homePageUrl}&origin=${origin}`
				});
				
			}
		}
	}
</script>

<style scoped lang="scss">
.download-wrap{
	padding-top: 40%;
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;
	.download-info{
		.title{
			color: #000;
			margin-top: 10rpx;
		}
		display: flex;
		justify-content: center;
		flex-direction: column;
		align-items: center;
	}
	.download-btn{
		margin-top: 100rpx;
	}
}
</style>
