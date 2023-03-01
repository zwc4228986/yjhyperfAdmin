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
			  <yj-button
			    bg="#FF9640"
			    color="white"
			    :customStyle="{ width: '300rpx' }"
			    shape="circle"
			    text="复制下载链接"
			    @click="goSign"
			  ></yj-button>
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
