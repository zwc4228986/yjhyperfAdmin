<template>
	<view :style="colorStyle">

		<view class="uni-tabbar acea-row row-around row-middle" v-if="isShow && tabbar.length && !isIframe">

			<view class="uni-tabbar_item" v-for="(item,index) in tabbar" :key="index" @tap="changeTab(item)">
				<view class="uni-tabbar_icon">
					<image v-if="item.link == pagePath" mode="aspectFit" :src="item.imgList[0]"></image>
					<image v-else mode="aspectFit" :src="item.imgList[1]"></image>
				</view>
				<view class="uni-tabbar_label" :class="{'active': item.link == pagePath}">
					{{item.name}}
				</view>
			</view>
		</view>
		<view class="uni-tabbar acea-row row-around row-middle" v-if="isIframe && tabbar.length">
			<view class="uni-tabbar_item" v-for="(item,index) in tabbar" :key="index" @tap="changeTab(item)">
				<view class="uni-tabbar_icon">
					<image v-if="item.link == pagePath" mode="aspectFit" :src="item.imgList[0]"></image>
					<image v-else mode="aspectFit" :src="item.imgList[1]"></image>
				</view>
				<view class="uni-tabbar_label" :class="{'active': item.link == pagePath}">
					{{item.name}}
				</view>
			</view>
		</view>
		<view v-if="isIframe && !tabbar.length" class="empty-img uni-tabbar acea-row row-around row-middle">暂无数据，请设置
		</view>
	</view>
</template>

<script>
	let app = getApp();
	import {
		getDiy
	} from '@/api/api.js';
	import {
		goPage
	} from '@/libs/order.js'
	import colors from '@/mixins/color.js';
	export default {
		name: 'tabBar',
		props: {
			pagePath: null,
			dataConfig: {
				type: Object,
				default: () => {}
			},
		},
		watch: {
			dataConfig: {
				immediate: true,
				handler(nVal, oVal) {
					if (nVal) {
						this.isShow = nVal.isShow.val;
					}
				}
			}
		},
		mixins: [colors],
		data() {
			return {
				name: this.$options.name,
				page: '/pages/index/index',
				tabbar: [],
				isShow: true, //true前台显示
				isIframe: app.globalData.isIframe //true后台显示
			};
		},
		mounted() {
			this.tabbar = [
				{
					"name": "首页",
					"imgList": [
						"https://demo43.wuht.net/uploads/attach/2021/09/20210923/7cc53da175d489201baf5fb968f07020.png",
						"https://demo43.wuht.net/uploads/attach/2021/09/20210923/d4d37b9507941d1820f5b8e8717fe9a4.png"
					],
					"link": "/pages/task/index"
				},
				{
					"name": "分类",
					"imgList": [
						"https://demo43.wuht.net/uploads/attach/2021/09/20210923/689f3aec1d74938a2b08d734b140d4b6.png",
						"https://demo43.wuht.net/uploads/attach/2021/09/20210923/ea73bf4744d29cfd8686146f3a9fbc38.png"
					],
					"link": "/pages/goods_cate/goods_cate"
				},
				{
					"name": "首页",
					"imgList": [
						"https://demo43.wuht.net/uploads/attach/2021/09/20210923/7cc53da175d489201baf5fb968f07020.png",
						"https://demo43.wuht.net/uploads/attach/2021/09/20210923/d4d37b9507941d1820f5b8e8717fe9a4.png"
					],
					"link": "/pages/task/index"
				},
				{
					"name": "分类",
					"imgList": [
						"https://demo43.wuht.net/uploads/attach/2021/09/20210923/689f3aec1d74938a2b08d734b140d4b6.png",
						"https://demo43.wuht.net/uploads/attach/2021/09/20210923/ea73bf4744d29cfd8686146f3a9fbc38.png"
					],
					"link": "/pages/goods_cate/goods_cate"
				},
				{
					"name": "首页",
					"imgList": [
						"https://demo43.wuht.net/uploads/attach/2021/09/20210923/7cc53da175d489201baf5fb968f07020.png",
						"https://demo43.wuht.net/uploads/attach/2021/09/20210923/d4d37b9507941d1820f5b8e8717fe9a4.png"
					],
					"link": "/pages/task/index"
				},
				{
					"name": "分类",
					"imgList": [
						"https://demo43.wuht.net/uploads/attach/2021/09/20210923/689f3aec1d74938a2b08d734b140d4b6.png",
						"https://demo43.wuht.net/uploads/attach/2021/09/20210923/ea73bf4744d29cfd8686146f3a9fbc38.png"
					],
					"link": "/pages/goods_cate/goods_cate"
				},
				{
					"name": "我的",
					"imgList": [
						"https://demo43.wuht.net/uploads/attach/2021/09/20210923/a7751c561e9e94eac5052d0bf66bf557.png",
						"https://demo43.wuht.net/uploads/attach/2021/09/20210923/f4f53885ed5b42b6f031b051b46f5b74.png"
					],
					"link": "/pages/task/user/index"
				}
			];
		},
		methods: {
			getDiyData() {
				getDiy().then(res => {
					const {
						list
					} = res.data.tabBar.default.tabBarList;
					this.$Cache.set('TAB_BAR', list)
					this.tabbar = list;
				}).catch(err => {
					uni.showToast({
						title: err,
						icon: 'none'
					});
				});
			},
			changeTab(item) {
				// goPage().then(res => {
					this.page = item.link;
					// 这里使用reLaunch关闭所有的页面，打开新的栏目页面
					uni.redirectTo({
						url: this.page,
						fail: () => {
							uni.navigateTo({
								url: this.page
							})
						}
					});
				// })
			},
		}
	}
</script>

<style lang="scss" scoped>
	.borderShow {
		position: fixed;
	}

	.borderShow .uni-tabbar::after {
		content: ' ';
		position: absolute;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		border: 1px dashed #007AFF;
		box-sizing: border-box;
	}

	.uni-tabbar {
		position: fixed;
		bottom: 0;
		left: 0;
		z-index: 999;
		width: 100%;
		height: 98rpx;
		height: calc(98rpx+ constant(safe-area-inset-bottom)); ///兼容 IOS<11.2/
		height: calc(98rpx + env(safe-area-inset-bottom)); ///兼容 IOS>11.2/
		padding-bottom: calc(constant(safe-area-inset-bottom)); ///兼容 IOS<11.2/
		padding-bottom: calc(env(safe-area-inset-bottom)); ///兼容 IOS>11.2/
		box-sizing: border-box;
		border-top: solid 1rpx #F3F3F3;
		background-color: #fff;
		box-shadow: 0px 0px 17rpx 1rpx rgba(206, 206, 206, 0.32);
		display: flex;
		flex-wrap: nowrap;

		.uni-tabbar_item {
			width: 100%;
			font-size: 20rpx;
			text-align: center;
		}

		.uni-tabbar_icon {
			height: 50rpx;
			width: 50rpx;
			text-align: center;
			margin: 0 auto;

			image {
				width: 100%;
				height: 100%;
			}
		}

		.uni-tabbar_label {
			font-size: 24rpx;
			color: rgb(40, 40, 40);

			&.active {
				color: var(--view-theme);
			}
		}
	}
</style>
