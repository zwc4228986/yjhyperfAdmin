<template>
	<view  class="menus-box ">
		<view v-if="isMany">
			<view class="swiper">
				<swiper :interval="interval" :duration="duration" :style="'height:'+(navHigh*2+30)+'rpx;'" @change='bannerfun'>
					<block>
						<swiper-item v-for="(item,indexw) in menuList" :key="indexw">
							<view class="nav acea-row" :id="'nav' + indexw">
								<view  class="item four"  v-for="(itemn,indexn) in item.list" :key="indexn" @click="menusTap()">
									<view class="pictrue skeleton-radius" :class="menuStyle?'':'on'">
										<image :src="itemn.img" mode="aspectFill"></image>
									</view>
									<view class="menu-txt">{{ itemn.name }}</view>
								</view>
							</view>
						</swiper-item>
					</block>
				</swiper>
			</view>
			<view class="dot acea-row row-center-wrapper" v-if="docConfig<2">
				<view class="dot-item" :class="{ 'line_dot-item': docConfig === 0,'': docConfig === 1}" :style="active==index?'background:'+ dotColor:''" v-for="(item,index) in menuList"></view>
			</view>
		</view>
		<view class="nav oneNav" v-else>
			<scroll-view scroll-x="true" style="white-space: nowrap; display: flex" show-scrollbar="false">
				<block v-for="(item, index) in menus" :key="index">
					<view class="item"  @click="menusTap(item.url_config)">
						<view class="pictrue skeleton-radius on" >
							<image :src="item.img" mode="aspectFill"></image>
						</view>
						<view class="menu-txt">{{ item.name }}</view>
					</view>
				</block>
			</scroll-view>
		</view>
	</view>
</template>

<script>
	export default {
		name: 'menus',
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
				interval: 3000,
				duration: 500,
				isMany:false,
				menus:  [
					{
						img:'http://150.158.155.57:9704/uploads/attach/2022/08/20220820/b76c1e866cf200c87dc42dc310977873.png',
						name:'签到',
						url_config:{
							type:'navigateTo',
							url:'/pages/users/user_sgin/index',
						}
					}
				],
				navHigh: 0,
				active: 0
			};
		},
		created() {},
		mounted() {
			// if (this.rowsNum === 0) {
			// 	if (this.number === 0) {
			// 		this.pageNum(6)
			// 	} else if (this.number === 1) {
			// 		this.pageNum(8)
			// 	} else {
			// 		this.pageNum(10)
			// 	}
			// } else if (this.rowsNum === 1) {
			// 	if (this.number === 0) {
			// 		this.pageNum(9)
			// 	} else if (this.number === 1) {
			// 		this.pageNum(12)
			// 	} else {
			// 		this.pageNum(15)
			// 	}
			// } else {
			// 	if (this.number === 0) {
			// 		this.pageNum(12)
			// 	} else if (this.number === 1) {
			// 		this.pageNum(16)
			// 	} else {
			// 		this.pageNum(20)
			// 	}
			// }
			// this.$nextTick(() => {
			// 	if (this.menuList.length&&this.isMany) {
			// 		let that = this
			// 		// #ifdef H5
			// 		that.menuHeight()
			// 		// #endif
			// 		// #ifndef H5
			// 		setTimeout(() => {
			// 			that.menuHeight()
			// 		},100)
			// 		// #endif
			// 	}
			// })
		},
		methods: {
			bannerfun(e) {
				this.active = e.detail.current;
			},
			menuHeight(){
				let that = this;
				const query = uni.createSelectorQuery().in(this);
				query.select('#nav0').boundingClientRect(data => {
					that.navHigh = data.height;
				}).exec();
			},
			pageNum(num) {
				let count = Math.ceil(this.menus.length / num);
				let goodArray = new Array();
				for (let i = 0; i < count; i++) {
					let list = this.menus.slice(i * num, i * num + num);
					if (list.length)
						goodArray.push({
							list: list
						});
				}
				this.$set(this, 'menuList', goodArray);
			},
			menusTap(urlConfig) {
				console.log(urlConfig);
				if(urlConfig.type == 'navigateTo'){
					uni.navigateTo({
						url: urlConfig.url
					})
				}
				// if (url.indexOf("http") != -1) {
				// 	// #ifdef H5
				// 	location.href = url
				// 	// #endif
				// 	// #ifdef MP || APP-PLUS
				// 	uni.navigateTo({
				// 		url: `/pages/annex/web_view/index?url=${url}`
				// 	});
				// 	// #endif
				// } else {
				// 	console.log(['/pages/stores/index'].indexOf(url));
				// 	if (['/pages/goods_cate/goods_cate','/pages/stores/index', '/pages/order_addcart/order_addcart', '/pages/user/index']
				// 		.indexOf(url) == -1) {
				// 		uni.navigateTo({
				// 			url: url
				// 		})
				// 	} else {
				// 		uni.reLaunch({
				// 			url: url
				// 		})
				// 	}
				// }
			}
		}
	};
</script>

<style lang="scss">
	.menus-box{
	}
	.dot {
		width: 100%;
		padding-bottom: 20rpx;
	
		.instruct {
			width: 50rpx;
			height: 36rpx;
			line-height: 36rpx;
			background-color: rgba(0, 0, 0, 0.8);
			color: #fff;
			border-radius: 16rpx;
			font-size: 24rpx;
			text-align: center;
		}
	
		.dot-item {
			width: 10rpx;
			height: 10rpx;
			background: rgba(0, 0, 0, .4);
			border-radius: 50%;
			margin: 0 4px;
	
			&.line_dot-item {
				width: 20rpx;
				height: 5rpx;
				border-radius: 3rpx;
			}
		}
	}
	.nav {
		&.oneNav{
			padding-bottom: 25rpx;
		}
		.item {
			margin-top: 30rpx;
			width: 160rpx;
			text-align: center;
			font-size: 24rpx;
			display: inline-block;

			.pictrue {
				width: 110rpx;
				height: 110rpx;
				margin: 0 auto;
				image {
					width: 100%;
					height: 100%;
					border-radius: 50%;
				}

				&.on {
					image {
						border-radius: 0;
					}
				}
			}

			.menu-txt {
				margin-top: 15rpx;
			}
		}
	}
	
	.swiper {
		margin-left: -20rpx;
		margin-right: -20rpx;
		z-index: 20;
		position: relative;
		overflow: hidden;
		.nav {
			.item {
				width: 33.3333%;

				&.four {
					width: 25%;
				}

				&.five {
					width: 20%;
				}
			}
		}

		swiper,
		.swiper-item {
			width: 100%;
			display: block;
		}
	}
</style>
