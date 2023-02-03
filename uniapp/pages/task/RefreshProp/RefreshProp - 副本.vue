<template>
	<view class="wrap">
		<view class="times-box">
			剩余刷新次数：0次
		</view>
		<!-- <view class="groupHeader-box">
			<view class="left">
				
			</view>
			<view class="mid">
				
			</view>
			<view class="op">
				
			</view>
		</view> -->
		<view class="pay-box">
			<view class="item">
				<view class="times">
					1000次
				</view>
				<view class="onePrice">
					￥0.6/次
				</view>
				<view class="totalPrice">
					￥600
				</view>
			</view>
			<view class="item">
				<view class="times">
					1000次
				</view>
				<view class="onePrice">
					￥0.6/次
				</view>
				<view class="totalPrice">
					￥600
				</view>
			</view>
			<view class="item">
				<view class="times">
					1000次
				</view>
				<view class="onePrice">
					￥0.6/次
				</view>
				<view class="totalPrice">
					￥600
				</view>
			</view>
			<view class="item">
				<view class="times">
					1000次
				</view>
				<view class="onePrice">
					￥0.6/次
				</view>
				<view class="totalPrice">
					￥600
				</view>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				
			}
		},
		methods: {
			
		}
	}
</script>

<style  lang="scss">
	page{
		background-color: #FFFFFF;
		
	}
	.wrap{
		padding: 30rpx;
		font-size:24rpx ;
	}
	.times-box{
		display: flex;
		justify-content: center;
	}
	.pay-box{
		display: flex;
		flex-wrap: wrap;
		.item{
			.onePrice{
				margin-top: 5rpx;
				font-weight: bold;
				font-size: 28rpx;
			}
			.totalPrice{
				font-size: 20rpx;
			}
			flex-basis: 30%;
			margin-left: 3%;
			background-color: #F7F7F7;
			margin-top: 20rpx;
			display: flex;
			flex-direction: column;
			align-items: center;
			padding: 30rpx 0;
		}
	}
	
</style>
