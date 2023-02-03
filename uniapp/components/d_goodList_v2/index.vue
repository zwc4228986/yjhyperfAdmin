<template>
	<view class="goodsList">
		<view class="item" v-for="(item,index) in tempArr" :key='index' @click="goDetail(item)">
			<view class="pictrue">
				<span class="pictrue_log pictrue_log_class" v-if="item.activity && item.activity.type === '1'">秒杀</span>
				<span class="pictrue_log pictrue_log_class" v-if="item.activity && item.activity.type === '2'">砍价</span>
				<span class="pictrue_log pictrue_log_class" v-if="item.activity && item.activity.type === '3'">拼团</span>
				<image :src="item.recommend_image"  v-if="item.recommend_image" ></image>
				<image :src="item.image"   v-else></image>
			</view>
			<view class="text line1">{{item.store_name}}</view>
			<view class="bottom acea-row row-between-wrapper">
				<view class="sales acea-row row-middle">
					<view class="sales-desc line1">日销量 {{item.sales}}</view>
					<view class="money font-color">{{item.price}}<text>小豆</text></view>
				</view>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		name: 'd_goodList_v2',
		props: {
			dataConfig: {
				type: Object,
				default: () => {}
			},
			tempArr: {
				type: Array,
				default: []
			},
			isLogin: {
				type: Boolean,
				default: false
			}
		},
		data() {
			return {};
		},
		created() {},
		mounted() {},
		methods: {
			goDetail(item) {
				this.$emit('detail', item);
			},
			goCartDuo(item) {
				this.$emit('gocartduo', item);
			},
			goCartDan(item, index) {
				this.$emit('gocartdan', item, index);
			},
			CartNumDes(index, item) {
				this.$emit('ChangeCartNumDan', false, index, item);
			},
			CartNumAdd(index, item) {
				this.$emit('ChangeCartNumDan', true, index, item);
			}
		}
	};
</script>

<style lang="scss">
	.goodsList {
		margin-top: 20rpx;
		padding: 20rpx 20rpx 0 20rpx;
		column-count: 2;
		column-gap: 20rpx;
		flex-wrap: wrap;
		justify-content: space-between;
		background: #F9F9F9;
		.item {
			width: 342rpx;
			height: auto;
			box-sizing: border-box;
			margin-bottom: 18rpx;
			border-radius: 10rpx;
			background: #fff;
			
			.pictrue {
				width: 100%;
				height: 300rpx;
				position: relative;
				overflow: hidden;
				image {
					width: 100%;
					height: 100%;
					border-radius: 10rpx 10rpx 0 0;
				}
			}

			.text {
				font-size: 28rpx;
				font-family: PingFang SC;
				font-weight: 500;
				font-weight: bold;
				color: #333333;
				margin: 15rpx 20rpx;
			}

			.bottom {
				margin: 0 20rpx 20rpx 20rpx;
				color: #D4220B;
				.sales {
					font-size: 22rpx;
					margin-bottom: 24rpx;
					
					&-desc {
						margin-bottom: 12rpx;
					}

					.money {
						font-size: 30rpx;
						font-weight: bold;
						font-family: DIN;
						margin-right: 18rpx;

						text {
							font-size: 26rpx;
						}
					}
				}

				.cart {
					height: 56rpx;

					.pictrue {
						color: var(--view-theme);
						font-size: 46rpx;
						width: 50rpx;
						height: 50rpx;
						text-align: center;
						line-height: 50rpx;
					}

					.num {
						font-size: 30rpx;
						color: #282828;
						font-weight: bold;
						width: 80rpx;
						text-align: center;
					}
				}

				.bnt {
					padding: 0 30rpx;
					height: 56rpx;
					line-height: 56rpx;
					background: var(--view-theme);
					border-radius: 42rpx;
					font-size: 26rpx;
					color: #fff;
					position: relative;

					&.end {
						background: rgba(203, 203, 203, 1);
					}

					.num {
						background-color: var(--view-priceColor);
						min-width: 12rpx;
						color: #fff;
						border-radius: 15px;
						position: absolute;
						right: -14rpx;
						top: -15rpx;
						font-size: 22rpx;
						padding: 0 10rpx;
						height: 34rpx;
						line-height: 34rpx;
					}
				}
			}
		}
	}
	.sales-desc{
		width: ;
	}
</style>
