<template>
	<view class="index-product-wrapper" :class="iSshowH?'on':''" :style="'margin-top:'+mbConfig*2+'rpx;'" v-show="!isSortType">
		<!-- <view class="nav-bd" :style="{justifyContent:titleConfig===0?'flex-start':titleConfig===1?'space-around':'flex-end'}">
			<view class="item" v-for="(item,index) in explosiveMoney" :index="index" @click="ProductNavTab(item.id,index)">
				<view class="txt" :style="{ 'color': index==ProductNavindex ? themeColor : '' }">{{item.name}}</view>
				<view class="label" :style="{ 'background': index==ProductNavindex ? themeColor : '','color': index==ProductNavindex ? '#fff' : '' }">{{item.label}}</view>
			</view>
		</view> -->
		<u-sticky :offset-top="h">
			  <u-tabs :list="explosiveMoney" @click="ProductNavTab"></u-tabs>
		</u-sticky>
		  
		
		<!-- 首发新品 -->
		<view class="list-box animated" :class='tempArr.length > 0?"fadeIn on":""'>
			<view class="item" v-for="(item,index) in tempArr" :key="index" @click="goDetail(item)">
				<view class="pictrue">
					<!-- <span class="pictrue_log pictrue_log_class" :style="'background-color:'+labelColor">新品</span> -->
					<image :src="item.image.path_format" mode="aspectFill"></image>
				</view>
				<view class="text-info">
					<view class="title line1">{{item.name}}</view>
					<view class="price" :style="{color:fontColor}">
						<view v-if="priceShow">
							{{item.price}}<text>抖币</text>
						</view>
						<view class="txt" :style="'border:1px solid '+labelColor+';color:'+labelColor" :class="priceShow?'':'on'" v-if="item.checkCoupon && couponShow">券</view>
					</view>
				</view>
			</view>
		</view>
	</view>
</template>

<script>
	import {
		getProductslist,
		getCircleCategoryList
	} from '@/api/store.js';
	let headHeight = uni.getSystemInfoSync().statusBarHeight * 2 + 160 + 'rpx';
	let statusBarHeight = uni.getSystemInfoSync().statusBarHeight * 2 + 'rpx';
	export default {
		name: 'promotionList',
		props: {
			dataConfig: {
				type: Object,
				default: () => {}
			},
			iSshowH: {
				type: Boolean,
				default: true
			},
			isSortType:{
				type: String | Number,
				default:0
			}
		},
		data() {
			return {
				h:headHeight,
				statusBarHeight:statusBarHeight,
				tabLeft:0,
				ProductNavindex: 0,
				tempArr:[],
				circle_category_id:0,
				explosiveMoney: [
					
				],
				numConfig: 10,
				// imgStyle: this.dataConfig.imgStyle.type,
				mbConfig: 0,
				themeColor: "#F68326",
				titleShow: true, //标题是否显示
				opriceShow: true, //原价是否显示
				priceShow: true, //价格是否显示
				couponShow: false,//优惠券标签是否显示
				titleConfig: 0, //标题位置
				fontColor:"#F68326" ,
				labelColor: "#F68326" ,
			};
		},
		created() {
			
			this.getCircleCategoryList();
			this.getProductslist();
		
		
		},
		methods: {
			getCircleCategoryList(){
				getCircleCategoryList({limit:-1}).then(res=>{
					res.unshift({
						'id': 0,
						'name': '推荐'
					})
					this.explosiveMoney = res;
				})
			},
			getProductslist(){
				
				getProductslist({limit:-1,circle_category_id:this.circle_category_id,is_hot:!this.circle_category_id}).then(res=>{
					this.tempArr = res;
				})
			},
			// 首发新品切换
			ProductNavTab(item) {
				this.circle_category_id = item.id;
				this.getProductslist();
			},
			goDetail(item) {
					uni.navigateTo({
						url: `/pages/goods_details/index?id=${item.id}`
					})
			},
		}
	}
</script>

<style lang="scss">
	.index-product-wrapper {
		padding: 30rpx 20rpx 0 20rpx;
		background-color: #fff;
		&.on {
			min-height: 1500rpx;
		}

		.nav-bd {
			display: flex;
			align-items: center;

			.item {
				display: flex;
				flex-direction: column;
				align-items: center;
				justify-content: center;
				width: 25%;
				
				&.on{
					border-radius: 0;
				}

				.txt {
					font-size: 32rpx;
					color: #282828;
				}

				.label {
					display: flex;
					align-items: center;
					justify-content: center;
					width: 124rpx;
					height: 32rpx;
					margin-top: 5rpx;
					font-size: 24rpx;
					color: #999;
					border-radius: 16rpx;
				}
			}
		}

		.list-box {
			display: flex;
			flex-wrap: wrap;
			justify-content: space-between;
			margin-top: 30rpx;

			.item {
				width: 345rpx;
				margin-bottom: 20rpx;
				background-color: #fff;
				border-radius: 20rpx;
				overflow: hidden;
				position: relative;

				.pictrue_log {
					width: 92rpx;
					height: 44rpx;
					font-size: 26rpx;
					line-height: 44rpx;
				}

				image {
					width: 100%;
					height: 346rpx;
					display: block;
				}

				.text-info {
					padding: 10rpx 20rpx 15rpx;

					.title {
						color: #222222;
					}

					.old-price {
						margin-top: 4rpx;
						font-size: 26rpx;
						color: #AAAAAA;
						text-decoration: line-through;

						text {
							margin-right: 2px;
							font-size: 20rpx;
						}
					}

					.price {
						display: flex;
						align-items: flex-end;
						font-size: 36rpx;
						font-weight: 550;

						text {
							padding-bottom: 4rpx;
							font-size: 26rpx;
							font-weight: normal;
						}

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
							&.on{
								margin-left: 0;
							}
						}
					}
				}
			}

			&.on {
				display: flex;
			}
		}
	}
</style>
