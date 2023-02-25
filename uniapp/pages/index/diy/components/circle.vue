<template>
	<view  class="circle menus-box borderRadius15">
		<view class="circle-header">
			<view>推荐资源分类</view>
		</view>
		
		<view class="circle-content" >
			<block v-for="(item, index) in menus" :key="index">
					<view class="item" @click="goCircle(item)">
						<u-image radius="10" width="100px" height="80px"></u-image>
						<view class="right">
							<view class="circle-content-title">{{item.name}}</view>
							<view class="circle-content-info">{{item.info}}</view>
							<view class="circle-content-bottom">200个资源</view>
						</view>
					</view>
			</block>
		</view>
	</view>
</template>

<script>
	export default {
		name: 'menus',
		props: {
			data: {
				type: Array,
				default: [],
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
				],
				navHigh: 0,
				active: 0
			};
		},
		watch:{
			data(val){
				this.menus = val;
			}
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
			goCircle(item){
				uni.navigateTo({
					url:"/pages/stores/index?circle_id="+item.id
				})
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
	
	.circle{
		padding: 20rpx;
		.circle-header{
			padding-bottom: 20rpx;
			font-weight: bold;
			font-size: 32rpx;
		}
		.circle-content .item{
			margin-bottom: 20rpx;
			display: flex;
			.right{
				display: flex;
				flex-direction: column;
				justify-content: space-between;
				margin-left: 20rpx;
				.circle-content-title{
					font-size: 28rpx;
					font-weight: bold;
				}
				.circle-content-info{
					font-size: 24rpx;
					height: 2em;
					color: #666;
				}
			}
		}
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
