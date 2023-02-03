<template>
	<view  :style="{padding:'0 '+prConfig+'px'}">
		
		
		
		<view class="index-product-wrapper" :class="bgStyle===0?'':'borderRadius15'"
			:style="{ marginTop: mbConfig*2 + 'rpx', background: themeColor }" v-if="tempArr.length">
			<view class="hd">
				<view class="left">
					<!-- <image :src="imgUrl" class="icon" v-if="imgUrl"></image> -->
					<image :src="icon" class="icon"></image>
					<view class="name">{{title}}</view>
				</view>
			</view>
			<!-- 单列 -->
			<block v-if="itemStyle == 0">
				<view class="list-box listA" :class="tempArr.length > 0 ? 'fadeIn on' : ''">
					<view class="item" :class="conStyle?'borderRadius15':''" v-for="(item, index) in tempArr"
						:key="index" @click="goDetail(item)">
						<view class="pictrue">
							<span class="pictrue_log pictrue_log_class" :style="'background-color:'+labelColor"
								v-if="item.activity && item.activity.type === '1'">秒杀</span>
							<span class="pictrue_log pictrue_log_class" :style="'background-color:'+labelColor"
								v-if="item.activity && item.activity.type === '2'">砍价</span>
							<span class="pictrue_log pictrue_log_class" :style="'background-color:'+labelColor"
								v-if="item.activity && item.activity.type === '3'">拼团</span>
							<image :src="item.image" mode="aspectFill"></image>
						</view>
						<view class="text-info"
							style="display: flex; flex-direction: column; justify-content: space-between;">
							<view>
								<view class="title line2" v-if="titleShow">{{ item.store_name }}</view>
							</view>
							<view class="price" >
								<view v-if="priceShow">
									{{ item.price }}小豆/套
								</view>
							</view>
							
							<button class="buy bnts" form-type="submit">
								立即兑换
							</button>
							<u-line-progress :percentage="30" activeColor="#F58325"></u-line-progress>
						</view>
					</view>
				</view>
			</block>
			<!-- 两列 -->
			<block v-if="itemStyle == 1">
				<view class="list-box listC" :class="tempArr.length > 0 ? 'fadeIn on' : ''">
					<view class="item" :class="conStyle?'borderRadius15':''" v-for="(item, index) in tempArr"
						:key="index" @click="goDetail(item)">
						<view class="pictrue">
							<span class="pictrue_log pictrue_log_class" :style="'background-color:'+labelColor"
								v-if="item.activity && item.activity.type === '1'">秒杀</span>
							<span class="pictrue_log pictrue_log_class" :style="'background-color:'+labelColor"
								v-if="item.activity && item.activity.type === '2'">砍价</span>
							<span class="pictrue_log pictrue_log_class" :style="'background-color:'+labelColor"
								v-if="item.activity && item.activity.type === '3'">拼团</span>
							<image :src="item.image" mode="aspectFill"></image>
						</view>
						<view class="text-info">
							<view class="title line1" v-if="titleShow">{{ item.store_name }}</view>
							<view class="old-price" v-if="opriceShow">
								<text>¥</text>
								{{ item.ot_price }}
							</view>
							<view class="price" :style="'color:'+fontColor">
								<view v-if="priceShow">
									{{ item.price }}
									<text>小豆</text>
								</view>
								<view class="txt" :style="'border:1px solid '+labelColor+';color:'+labelColor"
									:class="priceShow?'':'on'" v-if="item.checkCoupon && couponShow">券</view>
							</view>
						</view>
					</view>
				</view>
			</block>
			<!-- 三列 -->
			<block v-if="itemStyle == 2">
				<view class="list-box listB" :class="tempArr.length > 0 ? 'fadeIn on' : ''">
					<view class="item" :class="conStyle?'borderRadius15':''" v-for="(item, index) in tempArr"
						:key="index" @click="goDetail(item)">
						<view class="pictrue">
							<span class="pictrue_log pictrue_log_class" :style="'background-color:'+labelColor"
								v-if="item.activity && item.activity.type === '1'">秒杀</span>
							<span class="pictrue_log pictrue_log_class" :style="'background-color:'+labelColor"
								v-if="item.activity && item.activity.type === '2'">砍价</span>
							<span class="pictrue_log pictrue_log_class" :style="'background-color:'+labelColor"
								v-if="item.activity && item.activity.type === '3'">拼团</span>
							<image :src="item.image" mode="aspectFill"></image>
						</view>
						<view class="text-info"
							style="display: flex; flex-direction: column; justify-content: space-between;">
							<view>
								<view class="title line1" v-if="titleShow">{{ item.store_name }}</view>
								<view class="old-price" v-if="opriceShow">
									<text>¥</text>
									{{ item.ot_price }}
								</view>
							</view>
							<view class="price" :style="'color:'+fontColor">
								<view v-if="priceShow">
									<text>￥</text>
									{{ item.price }}
								</view>
								<view class="txt" :style="'border:1px solid '+labelColor+';color:'+labelColor"
									:class="priceShow?'':'on'" v-if="item.checkCoupon && couponShow">券</view>
							</view>
						</view>
					</view>
				</view>
			</block>
		</view>
		<!-- 大图 -->
		<block v-if="itemStyle == 3 && tempArr.length" :style="{ marginTop: mbConfig + 'rpx' }">
			<view class="listBig" :class="bgStyle===0?'':'borderRadius15'" :style="{ background: themeColor }">
				<view class="itemBig" :class="conStyle?'borderRadius15':''" v-for="(item,index) in tempArr" :key="index"
					@click="goDetail(item)">
					<view class="img-box">
						<span class="pictrue_log_big pictrue_log_class" :style="'background-color:'+labelColor"
							v-if="item.activity && item.activity.type === '1'">秒杀</span>
						<span class="pictrue_log_big pictrue_log_class" :style="'background-color:'+labelColor"
							v-if="item.activity && item.activity.type === '2'">砍价</span>
						<span class="pictrue_log_big pictrue_log_class" :style="'background-color:'+labelColor"
							v-if="item.activity && item.activity.type === '3'">拼团</span>
						<image :src="item.recommend_image" mode="aspectFill" v-if="item.recommend_image"></image>
						<image :src="item.image" mode="aspectFill" v-else></image>
					</view>
					<view class="name line2"><span class="coupon"
							:style="'border:1px solid '+labelColor+';color:'+labelColor"
							v-if="item.checkCoupon && couponShow">券</span><span
							v-if="titleShow">{{item.store_name}}</span></view>
					<view class="price" :style="'color:'+fontColor"><span v-if="priceShow">￥<span
								class="num">{{item.price}}</span></span><span class="old-price"
							v-if="opriceShow">¥{{item.ot_price}}</span></view>
				</view>
			</view>
		</block>
	</view>
</template>

<script>
	import {
		getProductslist,getCategoryList
	} from '@/api/store.js';
	export default {
		name: 'goodList',
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
				tabTitle: [],
				tabLeft: 0,
				isWidth: 0, //每个导航栏占位
				tabClick: 0, //导航栏被点击
				isLeft: 0, //导航栏下划线位置
				fixedTop: 0,
				isTop: 0,
				navHeight: 0,
				tempArr: [],
				icon:this.dataConfig.icon.url,
				bg:this.dataConfig.icon.bg,
				title:this.dataConfig.title.value,
				mbConfig: this.dataConfig.mbConfig.val,
				numConfig: this.dataConfig.numConfig.val,
				themeColor: this.dataConfig.themeColor.color[0].item,
				itemStyle: this.dataConfig.itemStyle.type,
				sortType: this.dataConfig.goodsSort.type,
				type: this.dataConfig.tabConfig.tabVal || 0,
				selectId: this.dataConfig.selectConfig.activeValue,
				productIds: this.dataConfig.goodsList.ids || [],
				opriceShow: this.dataConfig.opriceShow.val, //商品原价
				priceShow: this.dataConfig.priceShow.val, //商品价格
				titleShow: this.dataConfig.titleShow.val, //商品名称
				couponShow: this.dataConfig.couponShow.val, //商品优惠券
				prConfig: this.dataConfig.prConfig.val, //左右边距
				bgStyle: this.dataConfig.bgStyle.type, //背景样式
				conStyle: this.dataConfig.conStyle.type, //内容样式
				fontColor: this.dataConfig.fontColor.color[0].item,
				labelColor: this.dataConfig.labelColor.color[0].item
			};
		},
		created() {},
		mounted() {
			console.log('dataConfig',this.dataConfig);
			this.getAllCategory();
			this.productslist();
		},
		methods: {
			// 导航栏点击
			longClick(item, index) {
				if (this.tabTitle.length > 5) {
					this.tabLeft = (index - 2) * this.isWidth //设置下划线位置
				}
				this.tabClick = index //设置导航点击了哪一个
				this.isLeft = index * this.isWidth //设置下划线位置
				this.$emit('bindSortId', item.id)
			},
			// 获取导航
			getAllCategory: function() {
				let that = this;
				getCategoryList().then(res => {
					res.data.unshift({
						"id": -99,
						'cate_name': '全部'
					})
					that.tabTitle = res.data;
					setTimeout((e) => {
						const query = uni.createSelectorQuery().in(this);
						query.select('.navTabBox').boundingClientRect(data => {
							that.domOffsetTop = data.top
							that.navHeight = data.height
							that.$emit('bindHeight', data)
						}).exec();
					}, 200)
					// #ifdef MP || APP-PLUS
					this.isTop = (uni.getSystemInfoSync().statusBarHeight + 43) + 'px'
					// #endif
					// #ifdef H5 
					this.isTop = 0
					// #endif
				})
			},
			productslist() {
				let limit = this.$config.LIMIT;
				let data = {};
				if (this.type == 1) {
					data = {
						ids: this.productIds.join(','),
					};
				} else {
					data = {
						priceOrder: this.sortType == 2 ? 'desc' : '',
						salesOrder: this.sortType == 1 ? 'desc' : '',
						limit: this.numConfig
					};
				}
				getProductslist(data).then(res => {
					this.tempArr = res.data;
				});
			},
			goDetail(item) {
				this.$emit('detail', item);
			}
		}
	};
</script>

<style lang="scss">
	
	.listBig {
		padding: 1px 20rpx 20rpx 20rpx;

		.borderRadius15 {
			image {
				border-radius: 20rpx 20rpx 0 0;
			}
		}

		.itemBig {
			width: 100%;
			margin-top: 20rpx;
			background-color: #fff;
			padding-bottom: 15rpx;

			.img-box {
				width: 100%;
				height: 284rpx;
				position: relative;

				.pictrue_log_big {
					border-radius: 20rpx 0 20rpx 0;
				}

				image {
					width: 100%;
					height: 100%;
				}
			}

			.name {
				font-size: 28rpx;
				font-weight: bold;
				margin-top: 16rpx;
				padding: 0 8px;

				.coupon {
					display: inline-block;
					text-align: center;
					width: 32rpx;
					border-radius: 4rpx;
					font-size: 20rpx;
					font-weight: normal;
					margin-right: 10rpx;
				}
			}

			.price {
				color:#E73708;
				font-size: 36rpx;
				margin-top: 10rpx;
				padding: 0 8px;
				.num {
					font-size: 36rpx;
					margin-right: 10rpx;
				}
				.old-price {
					color: #aaa;
					font-weight: normal;
					text-decoration: line-through;
				}
			}
		}
	}

	.index-product-wrapper {
		.hd {
			padding:20rpx;
			display: flex;
			align-items: center;
			justify-content: space-between;
	
			.left {
				display: flex;
				align-items: center;
				width: 500rpx;
				.name{
					font-size: 32rpx;
					color:#EE8117;
					font-weight: 600;
				}
	
				.icon {
					width: 36rpx;
					height: 36rpx;
					margin-right: 12rpx;
				}
	
				.title {
					width: 134rpx;
					height: 33rpx;
				}
			}
	
			.more {
				font-size: 26rpx;
				color: #EE8117;
				.iconfont {
					margin-left: 6rpx;
					font-size: 25rpx;
				}
			}
		}
		.list-box {
			display: flex;
			flex-wrap: wrap;
			justify-content: space-between;
			padding: 20rpx 20rpx 0;

			.item {
				width: 345rpx;
				margin-bottom: 20rpx;
				background-color: #fff;
				overflow: hidden;
				position: relative;

				&.on {
					border-radius: 0;
				}

				.pictrue {
					width: 347rpx;
					height: 347rpx;
					border-radius: 10rpx;
					overflow: hidden;
				}

				.pictrue_log {
					width: 92rpx;
					height: 44rpx;
					font-size: 26rpx;
					line-height: 44rpx;
					border-radius: 0 0 20rpx 0 !important;
				}

				image {
					width: 100%;
					// height: 346rpx;
					height: 100%;
					display: block;
				}

				.text-info {
					padding: 10rpx 20rpx 0;
					.title {
						color: #222222;
					}
					.old-price {
						margin-top: 4rpx;
						font-size: 26rpx;
						color: #aaaaaa;
						text-decoration: line-through;

						text {
							margin-right: 2px;
							font-size: 20rpx;
						}
					}

					.price {
						display: flex;
						align-items: flex-end;
						font-size: 28rpx;
						color:#F58325;
						.txt {
							display: flex;
							align-items: center;
							justify-content: center;
							width: 28rpx;
							height: 28rpx;
							margin-left: 15rpx;
							margin-bottom: 10rpx;
							border-radius: 4rpx;
							font-size: 20rpx;
							font-weight: normal;

							&.on {
								margin-left: 0;
							}
						}
					}
				}
			}

			&.on {
				display: flex;
			}
			.bnts{
				position: absolute;
			    background-color: #F58325;
			    color: white;
			    border-radius: 20px;
			    bottom: 60rpx;
			    right: 0;
			    font-size: 22rpx;
			    padding: 10rpx 25rpx;
			}
			&.listA {
				.item {
					display: flex;
					width: 100%;

					.pictrue {
						width: 220rpx;
						height: 220rpx;
					}

					.text-info {
						// width: 490rpx;
						flex: 1
					}
				}
			}

			&.listC {
				.item {
					width: 48.5%;
				}

				.pictrue {
					width: 100%;
					height: 345rpx;
				}
			}

			&.listB {
				justify-content: inherit;

				.item {
					width: 31.6%;
					margin-right: 16rpx;

					.pictrue {
						width: 100%;
						height: 220rpx;
					}

					&:nth-child(3n) {
						margin-right: 0;
					}
				}
			}
		}
	}
	
	.navTabBox {
		width: 100%;
		color: rgba(255, 255, 255, 1);
		padding: 20rpx 0;
		&.isFixed {
			z-index: 45;
			position: fixed;
			left: 0;
			width: 100%;
			/* #ifdef H5 */
			padding-top: 20rpx;
			top: 0;
			/* #endif */
		}
		.longTab {
			width: 100%;
			.longItem {
				color:#666666;
				width: 50px;
				height: 50rpx;
				display: inline-block;
				line-height: 50rpx;
				text-align: center;
				font-size: 30rpx;
				overflow: hidden;
				text-overflow: ellipsis;
				white-space: nowrap;
				&.click {
					color:#F58325;
					font-weight: bold;
				}
			}
			.underlineBox {
				height: 3px;
				width: 20%;
				display: flex;
				align-content: center;
				justify-content: center;
				transition: .5s;
	
				.underline {
					width: 33rpx;
					height: 4rpx;
					background-color: white;
				}
			}
		}
	}
	
	.child-box {
		width: 100%;
		position: relative;
		background-color: #fff;
		box-shadow: 0 2px 5px 1px rgba(0, 0, 0, 0.02);
	
		.wrapper {
			display: flex;
			align-items: center;
			padding: 20rpx 0;
			background: #fff;
		}
	
		.child-item {
			flex-shrink: 0;
			width: 140rpx;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			margin-left: 10rpx;
	
			image {
				width: 90rpx;
				height: 90rpx;
				border-radius: 50%;
			}
	
			.txt {
				font-size: 24rpx;
				color: #282828;
				text-align: center;
				margin-top: 10rpx;
			}
	
			&.on {
				image {
					border: 1px solid $theme-color-opacity;
				}
	
				.txt {
					color: $theme-color;
				}
			}
		}
	}
</style>
