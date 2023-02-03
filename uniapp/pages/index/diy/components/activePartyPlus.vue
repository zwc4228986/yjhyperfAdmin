<template>
		<view class="wrap">
			<view class="left-wrap" @click="goto('/pages/game/index/index')">
				<view class="title">游戏试玩</view>
				<view class="desc">快乐享不停</view>
			</view>
			<view class="right-wrap">
				<view class="r-t-wrap" @click="goto('/pages/users/user_spread_user/index')">
					<view class="title" >邀请好友</view>
					<view class="desc">优惠有好礼</view>
				</view>
				<view class="r-b-wrap" @click="goto('/pages/activity/goods_bargain/index')">
					<view class="title">砍价</view>
					<view class="desc">呼唤好友来砍价</view>
				</view>
			</view>
		</view>
</template>

<script>
	export default {
		name: 'activePartyPlus',
		props: {
			dataConfig: {
				type: Object,
				default: () => {}
			},
			isSortType: {
				type: String | Number,
				default: 0
			}
		},
		data() {
			return {
				titleConfig: this.dataConfig.titleConfig.value,
				desConfig: this.dataConfig.desConfig.value,
				explosiveMoney: this.dataConfig.menuConfig.list,
				themeColor: this.dataConfig.themeColor.color[0].item,
				bgColor: this.dataConfig.bgColor.color,
				mbConfig: this.dataConfig.mbConfig.val,
				boxColor: this.dataConfig.boxColor.color[0].item
			};
		},
		created() {},
		methods: {
			goto(url){
				uni.navigateTo({
					url:url,
				})
			},
			goDetail(item) {
				let urls = item.info[2].value
				if (['/pages/goods_cate/goods_cate', '/pages/order_addcart/order_addcart', '/pages/user/index']
					.indexOf(urls) == -1) {
					uni.navigateTo({
						url: urls
					})
				} else {
					uni.switchTab({
						url: urls
					})
				}
			}
		}
	}
</script>

<style lang="scss">
	.wrap{
		background-color: #fff;
		display: flex;
		padding: 20rpx;
		height: 280rpx;
		justify-content: space-between;
		.left-wrap{
			padding:20px;
			flex: 10;
			background: url("#{$app-url}/static/images/main/activity-left.png") no-repeat;
			background-size:100% 100%;
			.title{
				font-size: 30rpx;
				font-weight: bold;
				color: #53340D;
			}
			.desc{
				font-size: 26rpx;
				font-weight: 500;
				color: #A68A82;
			}
		}
		.right-wrap{
			flex: 10;
			display: flex;
			flex-direction: column;
			justify-content: space-between;
			.title{
				color: #23565A;
				font-size: 28rpx;
				font-weight: bold;
				color: #23565A;
			}
			.desc{
				font-size: 22rpx;
				font-weight: 500;
				color: #6A7992;
			}
			.r-t-wrap{
				padding:20px;
				display: flex;
				flex-direction: column;
				align-items: flex-end;
				justify-content: center;
				height: 115rpx;
				width: calc(100% + 8px);
				background: url("#{$app-url}/static/images/main/activity-right-top.png") no-repeat;
				background-size:100% 100%;
				margin-left: -8px;
			}
			.r-b-wrap{
				display: flex;
				flex-direction: column;
				align-items: flex-end;
				justify-content: center;
				padding:20px;
				background: url("#{$app-url}/static/images/main/activity-right-bottom.png") no-repeat;
				background-size:100% 100%;
				height: 115rpx;
				background-position: 0px 0;
				width: calc(100% + 25px);
				margin-left: -25px;
			}
		}
	}
	page{
		background-color: white;
	}
</style>