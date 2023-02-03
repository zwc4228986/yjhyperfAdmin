<template>
	<u-popup :show="isShow" mode="center" closeable @close="isShow = false">
		<scroll-view scroll-y="true" class="wrap">
			<view class="title">
				活动规则
			</view>
			<view class="tips">如有任何疑问，烦请联系平台官方客服</view>
			
			<view class="content-box">
				<view class="box-title">【特别提示】</view>
				<view class="content">
					与完成活动任务、领取活动奖励以及与用户账号异常/违规等相关的条款 。用户参与本活动即视为已充分阅读、理解本活动规则，并自愿受活动规则的约束。
				</view>
			</view>
			
			<view class="content-box">
				<view class="box-title">【详细规则】</view>
				<view class="content">
					<ul>
						<li>1、活动门槛与活动奖励</li>
						<li>1.1、活动门槛  。为感谢广大用户的支持和热爱，小目标联合商家为用户提供免费领取商品的福利，用户通过在24小时内将商品所需小豆砍为0小豆的方式获得免费领取商品资格，暂时不支持用户支付则余金额进行购买。</li>
						<li>1、活动门槛与活动奖励</li>
						<li>1.1、活动门槛  。为感谢广大用户的支持和热爱，小目标联合商家为用户提供免费领取商品的福利，用户通过在24小时内将商品所需小豆砍为0小豆的方式获得免费领取商品资格，暂时不支持用户支付则余金额进行购买。</li>
						<li>1、活动门槛与活动奖励</li>
						<li>1.1、活动门槛  。为感谢广大用户的支持和热爱，小目标联合商家为用户提供免费领取商品的福利，用户通过在24小时内将商品所需小豆砍为0小豆的方式获得免费领取商品资格，暂时不支持用户支付则余金额进行购买。</li>
						<li>1、活动门槛与活动奖励</li>
						<li>1.1、活动门槛  。为感谢广大用户的支持和热爱，小目标联合商家为用户提供免费领取商品的福利，用户通过在24小时内将商品所需小豆砍为0小豆的方式获得免费领取商品资格，暂时不支持用户支付则余金额进行购买。</li>
					</ul>
				</view>
			</view>
			
		</scroll-view>
	</u-popup>
</template>

<script>
	export default {
		 data() {
			return {
				isShow:false
			}
		},
		methods: {
			show(){
				this.isShow = true;
			}
			
	    }
	}
</script>

<style lang="scss" scoped>
	.wrap {
		width: 600rpx;
		height: 850rpx;
		margin: 0 auto;
		padding: 54rpx 40rpx 48rpx 40rpx;
		// display: flex;
		// flex-direction: column;
		// align-items: center;
		
		.title {
			// margin: 0 auto;
			text-align: center;
			font-size: 30rpx;
			font-family: PingFang SC;
			font-weight: bold;
			color: #333333;
		}
		
		.tips {
			display: flex;
			justify-content: center;
			align-items: center;
			margin: 0 auto;
			margin-top: 36rpx;
			width: 518rpx;
			height: 46rpx;
			background: linear-gradient(93deg, #F58426 0%, #F9AD53 100%);
			border-radius: 23rpx;
			font-size: 24rpx;
			font-family: PingFang SC;
			font-weight: 500;
			color: #FFFFFF;
		}
	
		.content-box {
			margin-top: 34rpx;
			.box-title {
				font-size: 28rpx;
				font-family: PingFang SC;
				font-weight: bold;
				color: #333333;
			}
			
			.content {
				margin-top: 30rpx;
				font-size: 24rpx;
				font-family: PingFang SC;
				font-weight: 500;
				color: #666666;
				
				li {
					margin-top: 20rpx;
				}
			}
		}
	}
</style>