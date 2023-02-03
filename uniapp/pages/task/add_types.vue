<template>
	<view class="warp">
		<view class="container">
			<u-cell-group>
			    <u-cell v-for="item in data"  isLink @click="toAdd(item.id)">
			    	<view
			    	    slot="title"
			    	    class="u-slot-title"
			    	>
						<text class="title">{{item.title}}</text>
			    	</view>
					
					<view slot="label">
						<text class="desc">
							{{item.desc}}
						</text>
					</view>
			    </u-cell>
			</u-cell-group>
		</view>
		
		<u-popup :show="isShow" mode="center" :round="8" >
			<view class="popup-container">
				<view class="close">
					<!-- <text class="iconfont icon-guanbi"></text> -->
					<image class="close-btn" src="/static/images/task//add_types/guanbixiao.png" @click="handleClose"></image>
				</view>
				<view class="title">任务发布声明</view>
				<view class="intro" v-html="task_release_statement">
					<!-- <ul class="intro-ul"> -->
					<!-- 	<li >
							<view>1、</view>
							<view>
								<view>本平台严禁发布的任务类型包括但不限于：</view>
								<view>包含QQ、微信、群等私人联系方式；</view>
								<view>关注非认证微信公众号；</view>
								<view>代注册账号及微信解封任务；</view>
								<view>需用户支付超过1元及以上金额；</view>
								<view>虚拟货币挖矿、交易类；</view>
								<view>诱导用户虚假点击广告；</view>
								<view>积分墙、悬贫类网赚产品；</view>
								<view>黄赌毒等违法违规任务。</view>
							</view>
						</li>
						<li>
							<view>2、</view>
							<view>
								<view>同类任务发布上限为2个(特例任务除外)</view>
							</view>
						</li>
						<li>
							<view>3、</view>
							<view>
								<view>若存在违反平台规则的任务，一经发现立即 下架，且费用不予退还</view>
							</view>
						</li>
						<li>
							<view>4、</view>
							<view>
								<view>
									违反平台规则严重者，将被封号处理:其他规 则请查看《
									<u-link text="任务发布规则" fontSize="24rpx"></u-link>
									》，最终解释权归平台所有。
								</view>
							</view>
						</li> -->
					<!-- </ul> -->
				</view>
				<view class="bottom">
					<button class="btn" @click="handleClose"> 同意并继续 </button>
				</view>
			</view>
		</u-popup>
	</view>

	
</template>

<script>
	import {taskTypes} from '@/api/task.js'
	import {getConfig} from '@/api/config.js'

	export default {
		data() {
			return {
				data:[],
				isShow: true,
				task_release_statement:"",
			}
		},
		onLoad(){
				taskTypes({}).then(res=>{
					this.data = res;
				})
				this.getConfig();
		},
		methods: {
			getConfig(){
				getConfig('task_release_statement').then(res=>{
					this.task_release_statement = res;
				})
			},
			toAdd:function(type){
				uni.navigateTo({
					url:'/pages/task/add?task_types_id='+type
				})
			},
			handleClose() {
				this.isShow = false
			}
		}
	}
</script>

<style lang="scss">
.warp{
	.u-cell__body{
		padding: 15px 15px!important;
	}
	.title{
		font-size: 30rpx;
		font-weight: bold;
		padding: 10rpx 0;
	}
	.desc{
		color: #999;
		font-size: 22rpx;
		margin-top: 20rpx;
	}
	.container{
		background-color: white;
		border-radius: 20rpx;
		overflow: hidden;
	}
	
	.u-link {
		display: inline !important;
	}
	
	
	.popup-container {
		width: 601rpx;
		height: 850rpx;
		display: flex;
		flex-direction: column;
		align-items: center;
		
		.close {
			align-self: flex-end;
			width: 32rpx;
			height: 32rpx;
			margin-top: 22rpx;
			margin-right: 26rpx;
			&-btn {
				width: inherit;
				height: inherit;
			}
		}
		
		.title {
			position: relative;
			font-size: 30rpx;
			font-family: PingFang SC;
			font-weight: 500;
			color: #333333;
			&::after {
				content: '';
				position: absolute;
				bottom:  18rpx;
				left: 0;
				width: 103rpx;
				height: 18rpx;
				background: linear-gradient(90deg, #F58325 0%, rgba(245,131,37,0) 100%);
				opacity: 0.3;
				border-radius: 4rpx;
			}
		}
		
		.intro {
			margin-top: 44rpx;
			padding-left: 44rpx;
			padding-right: 34rpx;
			color: #666;
			font-size: 24rpx;
			width: 100%;
			&-ul {
				padding-left: 15rpx;
				> li {
					position: relative;
					
					display: flex;
					
					&::after {
						content: '';
						position: absolute;
						top: 16rpx;
						left: -16rpx;
						width: 8rpx;
						height: 8rpx;
						background-color: #ccc;
						border-radius: 50%;
					}
				}
			}
		}
		
		.bottom {
			position: absolute;
			bottom: 52rpx;
			.btn {
				display: flex;
				justify-content: center;
				align-items: center;
				width: 510rpx;
				height: 70rpx;
				background: linear-gradient(93deg, #F58426 0%, #F9AD53 100%);
				border-radius: 35rpx;
				color: #fff;
				font-size: 32rpx;
			}
		}
	}
}
</style>
