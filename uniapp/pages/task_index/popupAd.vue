<template>
	<view class="popup" v-if="isShow">
		<view class="container">
			<view class="container-video">
				<video :muted="true" :vslide-gesture="true" :show-mute-btn="true" :page-gesture="true" :src="url"></video>
			</view>
			<view class="container-text">
				<view class="container-text-top">
					<text>{{desc}}</text>
				</view>
				<view @click="handleClose" class="container-text-btn">开始体验</view>
				<!-- :value="index.toString()" :checked="item.is_default ? true : false" -->
				<label class="radio" @click="changeShow()">
				    <radio  :checked="is_show"/>不再显示
				</label>
			</view>
			
			<view class="container-btn" @click="handleClose">
				<text class="iconfont icon-guanbi2"></text>
			</view>
		</view>
	</view>

</template>

<script>
	import {getTaskHomeVideo} from '@/api/config.js'
	export default {
		name: 'popupAd',
		data() {
			return {
				is_show:false,
				url:"",
				desc:"",
				isShow: false
			}
		},
		mounted(){
			if(!this.$Cache.has('homeTaskVideoShow')){
				getTaskHomeVideo().then(res=>{
					this.url=res.home_task_video.full_path;
					this.desc=res.home_task_desc;
					this.isShow = true;
					
				})
			}
			
		},
		methods: {
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
				width: 640rpx;
				height: 246rpx;
				// background: #fff;
				padding: 40rpx 20rpx;
				
				background: url('#{$app-url}/static/images/index/bottom-popup.png') no-repeat;
				background-size: 100% auto;
				// 图片没有放齐
				transform: translate(12rpx, 0);
				display: flex;
				flex-direction: column;
				align-items: center;
				
				&-top {
					width: 472rpx;
					
					text {
						font-size: 22rpx;
						font-family: PingFang SC;
						font-weight: 500;
						color: #333333;
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