<template>
	<view class='productSort copy-data' :style="{height:pageHeight}">
		<!-- #ifdef APP-PLUS || MP -->
		<!-- <view class="sys-head" :style="{height:sysHeight}"></view> -->
		<!-- #endif -->

		<view class='header acea-row row-center-wrapper'>
			<view class='acea-row row-between-wrapper input'>
				<text class='iconfont icon-sousuo'></text>
				<input type='text' placeholder="搜索名称" @confirm="searchSubmitValue" confirm-type='search'
					name="search" placeholder-class='placeholder'></input>
			</view>
		</view>

		<view class="scroll-box">
			<view class='aside'>
				<scroll-view scroll-y="true" scroll-with-animation='true' style="height: calc(100% - 100rpx)">
					<view class='item acea-row row-center-wrapper' :class='index==navActive?"on":""'
						v-for="(item,index) in productList" :key="index" @click='tap(index,"b"+index)'>
						<text>{{(item.name)}}</text>
					</view>
					<!-- #ifdef APP-PLUS -->
					<view class="item" v-if="newData.status && newData.status.status"></view>
					<!-- #endif -->
				</scroll-view>
			</view>
			<view class='conter'>
				<scroll-view scroll-y="true" :scroll-into-view="toView" @scroll="scroll" scroll-with-animation='true'
					style="height: 100%;" class="conterScroll">
					<block v-for="(item,index) in productList" :key="index">
						<view class='listw' :id="'b'+index">
							<view class='title acea-row row-center-wrapper'>
								<view class='line'></view>
								<view class='name'>{{(item.name)}}</view>
								<view class='line'></view>
							</view>
							<view class='list acea-row'>
								<block v-for="(itemn,indexn) in item.circle" :key="indexn" >
									<div  @click="goCircle(itemn)"
										class='item acea-row row-column row-middle'>
										<view class='picture'>
											<image :src='itemn.icon.path_format' v-if="itemn.icon.path_format"></image>
											<image src="/static/images/sort-img.png" v-else></image>
										</view>
										<view class='name line1'>{{(itemn.name)}}</view>
									</div>
								</block>
							</view>
						</view>
					</block>
					<view :style='"height:"+(height-300)+"rpx;"' v-if="number<15"></view>
				</scroll-view>
			</view>
		</view>
	</view>
</template>

<script>
	let sysHeight = uni.getSystemInfoSync().statusBarHeight + 'px';
	
	import {
		getCircleTree
	} from '@/api/circle.js';
	import {
		mapState,
		mapGetters
	} from "vuex"
	import {
		getNavigation
	} from '@/api/public.js'
	const app = getApp();
	export default {
		components: {
		},
		data() {
			return {
				navlist: [],
				productList: [],
				navActive: 0,
				number: "",
				is_diy: uni.getStorageSync('is_diy'),
				height: 0,
				hightArr: [],
				toView: "",
				tabbarH: 0,
				footH: 0,
				windowHeight: 0,
				newData: {},
				activeRouter: '',
				pageHeight: '100%',
				sysHeight: sysHeight,
				// #ifdef APP-PLUS
				pageHeight: app.globalData.windowHeight,
				// #endif
				lock: false
			}
		},
		computed: {
			...mapState({
				cartNum: state => state.indexData.cartNum
			})
		},
		mounted() {
			let that = this
			// #ifdef H5
			uni.getSystemInfo({
				success: function(res) {
					that.pageHeight = res.windowHeight + 'px'
				}
			});
			// #endif
			let routes = getCurrentPages();
			let curRoute = routes[routes.length - 1].route
			this.activeRouter = '/' + curRoute
			this.getCircleTree();

		},
		methods: {
			goCircle(item){
				uni.navigateTo({
					url:"/pages/stores/index?circle_id="+item.id
				})
			},
			getNav() {
				getNavigation().then(res => {
					this.newData = res.data
				})
			},
			goRouter(item) {
				var pages = getCurrentPages();
				var page = (pages[pages.length - 1]).$page.fullPath;
				if (item.link == page) return
				uni.switchTab({
					url: item.link,
					fail(err) {
						uni.redirectTo({
							url: item.link
						})
					}
				})
			},
			footHeight(data) {
				this.footH = data
				
			},
			infoScroll: function() {
				let that = this;
				let len = that.productList.length;
				this.number = that.productList[len - 1].children.length;
				//设置商品列表高度
				uni.getSystemInfo({
					success: function(res) {
						that.height = (res.windowHeight) * (750 / res.windowWidth) - 98;
					},
				});
				let height = 0;
				let hightArr = [];
				for (let i = 0; i < len; i++) {
					//获取元素所在位置
					let query = uni.createSelectorQuery().in(this);
					let idView = "#b" + i;
					query.select(idView).boundingClientRect();
					query.exec(function(res) {
						let top = res[0].top;
						hightArr.push(top);
						that.hightArr = hightArr
					});
				};
			},
			tap: function(index, id) {
				this.toView = id;
				this.navActive = index;
				this.$set(this, 'lock', true);
			},
			getCircleTree: function() {
				let that = this;
				getCircleTree().then(res => {
					that.productList = res;
					// that.$nextTick(res => {
					// 	that.infoScroll();
					// })
					
				})
			},
			scroll: function(e) {
				let scrollTop = e.detail.scrollTop;
				let scrollArr = this.hightArr;
				if (this.lock) {
					this.$set(this, 'lock', false);
					return;
				}
				for (let i = 0; i < scrollArr.length; i++) {
					if (scrollTop >= 0 && scrollTop < scrollArr[1] - scrollArr[0]) {
						this.navActive = 0
					} else if (scrollTop >= scrollArr[i] - scrollArr[0] && scrollTop < scrollArr[i + 1] - scrollArr[
							0]) {
						this.navActive = i
					} else if (scrollTop >= scrollArr[scrollArr.length - 1] - scrollArr[0]) {
						this.navActive = scrollArr.length - 1
					}
				}
			}
		}
	}
</script>
<style>
	page {
		height: 100%;
	}
</style>
<style scoped lang="scss">
	/deep/uni-scroll-view {
		padding-bottom: 0 !important;
	}

	.sys-title {
		z-index: 10;
		position: relative;
		height: 40px;
		line-height: 40px;
		font-size: 30rpx;
		color: #333;
		background-color: #fff;
		// #ifdef APP-PLUS
		text-align: center;
		// #endif
		// #ifdef MP
		text-align: left;
		padding-left: 30rpx;
		// #endif
	}

	.sys-head {
		background-color: #fff;
	}

	.productSort {
		display: flex;
		flex-direction: column;
		//#ifdef MP
		height: calc(100vh - var(--window-top)) !important;
		//#endif
		//#ifndef MP
		height: 100vh //#endif
	}

	.productSort .header {
		width: 100%;
		height: 96rpx;
		background-color: #fff;
		border-bottom: 1rpx solid #f5f5f5;
	}

	.productSort .header .input {
		width: 700rpx;
		height: 60rpx;
		background-color: #f5f5f5;
		border-radius: 50rpx;
		box-sizing: border-box;
		padding: 0 25rpx;
	}

	.productSort .header .input .iconfont {
		font-size: 35rpx;
		color: #555;
	}

	.productSort .header .input .placeholder {
		color: #999;
	}

	.productSort .header .input input {
		font-size: 26rpx;
		height: 100%;
		width: 597rpx;
	}

	.productSort .scroll-box {
		flex: 1;
		overflow: hidden;
		display: flex;
	}

	// #ifndef MP
	uni-scroll-view {
		padding-bottom: 100rpx;
	}

	// #endif

	.productSort .aside {
		width: 180rpx;
		height: 100%;
		overflow: hidden;
		background-color: #f7f7f7;
	}

	.productSort .aside .item {
		height: 100rpx;
		width: 100%;
		font-size: 26rpx;
		color: #424242;
		text-align: center;
	}

	.productSort .aside .item.on {
		background-color: #fff;
		border-left: 4rpx solid var(--view-theme);
		width: 100%;
		color: var(--view-theme);
		font-weight: bold;
	}

	.productSort .conter {
		flex: 1;
		height: 100%;
		overflow: hidden;
		padding: 0 14rpx;
		background-color: #fff;
		position: relative;
	}

	.productSort .conter .listw {
		padding-top: 20rpx;
	}

	.productSort .conter .listw .title {
		height: 90rpx;
	}

	.productSort .conter .listw .title .line {
		width: 100rpx;
		height: 2rpx;
		background-color: #f0f0f0;
	}

	.productSort .conter .listw .title .name {
		font-size: 28rpx;
		color: #333;
		margin: 0 30rpx;
		font-weight: bold;
	}

	.productSort .conter .list {
		flex-wrap: wrap;
	}

	.productSort .conter .list .item {
		width: 177rpx;
		margin-top: 26rpx;
	}

	.productSort .conter .list .item .picture {
		width: 120rpx;
		height: 120rpx;
		border-radius: 2%;
	}

	.productSort .conter .list .item .picture image {
		width: 100%;
		height: 100%;
		border-radius: 2%;
	}

	.productSort .conter .list .item .name {
		font-size: 24rpx;
		color: #333;
		height: 56rpx;
		line-height: 56rpx;
		width: 120rpx;
		text-align: center;
	}

	.page-footer {
		position: fixed;
		bottom: 0;
		z-index: 30;
		display: flex;
		align-items: center;
		justify-content: space-around;
		width: 100%;
		height: calc(98rpx+ constant(safe-area-inset-bottom)); ///兼容 IOS<11.2/
		height: calc(98rpx + env(safe-area-inset-bottom)); ///兼容 IOS>11.2/
		box-sizing: border-box;
		border-top: solid 1rpx #F3F3F3;
		background-color: #fff;
		box-shadow: 0px 0px 17rpx 1rpx rgba(206, 206, 206, 0.32);
		padding-bottom: constant(safe-area-inset-bottom); ///兼容 IOS<11.2/
		padding-bottom: env(safe-area-inset-bottom); ///兼容 IOS>11.2/

		.foot-item {
			display: flex;
			width: max-content;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			position: relative;

			.count-num {
				position: absolute;
				display: flex;
				justify-content: center;
				align-items: center;
				width: 40rpx;
				height: 40rpx;
				top: 0rpx;
				right: -15rpx;
				color: #fff;
				font-size: 20rpx;
				background-color: #FD502F;
				border-radius: 50%;
				padding: 4rpx;
			}
		}

		.foot-item image {
			height: 50rpx;
			width: 50rpx;
			text-align: center;
			margin: 0 auto;
		}

		.foot-item .txt {
			font-size: 24rpx;


			&.active {}
		}
	}
</style>
