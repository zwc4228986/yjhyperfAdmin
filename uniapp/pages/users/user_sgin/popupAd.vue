<template>
	<view class="popup" v-show="isShow">
		<view class="container">
			<view class="icon">
				<image  :src="`${IMAGE_URL}/static/images/sign_success.png`"></image>
			</view>
			<view class="container-text">
				<view class="today_beans">获得<text>{{today}}</text>小豆</view>
				<view  class="container-text-top">
					明天签到可得<text>{{tomorrow}}</text>小豆
				</view>
				<view @click="handleClose" class="container-text-btn">知道了</view>
			</view>
			
			<view class="container-btn" @click="handleClose">
				<text class="iconfont icon-guanbi2"></text>
			</view>
		</view>
	</view>

</template>

<script>
			import { IMAGE_URL } from "@/config/app.js";
	import {getTaskHomeVideo} from '@/api/config.js'
	export default {
		name: 'popupAd',
		data() {
			return {
				today:0,
				tomorrow:0,
				IMAGE_URL:IMAGE_URL,
				is_show:false,
				url:"",
				desc:"",
				isShow: false
			}
		},
		mounted(){
			// if(!this.$Cache.has('homeTaskVideoShow')){
			// 	getTaskHomeVideo().then(res=>{
			// 		this.url=res.home_task_video.full_path;
			// 		this.desc=res.home_task_desc;
			// 		this.isShow = true;
					
			// 	})
			// }
		},
		methods: {
			show(today,tomorrow){
				this.today=today;
				this.tomorrow = tomorrow;
				this.isShow = true;
			},
			changeShow(){
				this.is_show = this.is_show?false:true;
			},
			handleClose() {
				if(this.is_show){
					this.$Cache.set('homeTaskVideoShow',true)
				}
				this.isShow = false
			}
		}
	}
</script>

<style lang="scss" >

	.radio{
		display:flex;
		align-items: center;
		margin-top: 10rpx;
		font-size: 24rpx;
		color:#999;
	}

	.popup {
		position: fixed;
		left: 0;
		right: 0;
		top: 0;
		height: 100vh;
		background-color: rgba(0,0,0,0.6);
		z-index: 9998;
		
		.container {
			.icon{
				image{
					width: 382rpx;
					height: 219rpx;
				}
				position: absolute;
				top:0;
			}
			position: fixed;
			width: 100%;
			height: 660rpx;
			top: 50%;
			left: 50%;
			transform: translate(-50%,-50%);
			background: transparent;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			
			&-video {
				
				width: 520rpx;
				height: 313rpx;
				video {
					width: 520rpx;
					height: 313rpx;
					border-radius: 30rpx 30rpx 0 0;
				}
			}
			
			&-text {
				.today_beans{
					font-weight: bold;
					font-size: 20px;
					margin-top:30px;
					text{
						font-weight: bold;
						color: #EF8134;
						font-size: 26px;
						padding: 0 10rpx;
					}
				}
				width: 640rpx;
				height: 346rpx;
				
				background: #fff;
				padding: 40rpx 20rpx;
				border-radius: 20rpx;
				// background: url('#{$app-url}/static/images/index/bottom-popup.png') no-repeat;
				// background-size: 100% auto;
				// 图片没有放齐
				// transform: translate(12rpx, 0);
				display: flex;
				flex-direction: column;
				align-items: center;
				
				&-top {
					width: 472rpx;
					color: #8C8C8C;
					margin-top: 5px;
					text-align: center;
					font-size: 24rpx;
					text {
						padding: 0 10rpx;
						font-family: PingFang SC;
						font-weight: 500;
						color: #EF8134;
					}
				}
				
				&-btn {
					display: flex;
					justify-content: center;
					align-items: center;
					width: 228rpx;
					height: 60rpx;
					background: linear-gradient(93deg, #F58426 0%, #F9AD53 100%);
					border-radius: 30rpx;
					color: #fff;
					margin-top: 30rpx;
				}
			}
			
			&-btn {
				margin-top: 40rpx;
				.iconfont {
					font-size: 58rpx;
					color: #fff;
					
				}
			}
		}
	}
</style>