<template>
	<view  :style="{padding:'0 '+prConfig+'px',background:'#fff'}">
		
		<view class="navTabBox">
			<view class="longTab">
				<scroll-view scroll-x="true" style="white-space: nowrap; display: flex;" scroll-with-animation
					:scroll-left="tabLeft" show-scrollbar="true">
					<view :url="'/pages/goods_list/index?cid='+item.id+'&title='+item.cate_name" class="longItem"
						  :data-index="index" :class="index===tabClick?'click':''"
						v-for="(item,index) in tabTitle" :key="index" :id="'id'+index" @click="longClick(item,index)">
						{{item.cate_name}}
					</view>
					<view class="underlineBox" :style='"transform:translateX("+isLeft+"px);width:"+isWidth+"px"'>
						<view class="underline"></view>
					</view>
				</scroll-view>
			</view>
		</view>
		<view class='nav acea-row row-middle'>
			<view class='item' @click='set_where(1)'>
				综合排序
				<image v-if="time==1" src='../../../../static/images/up.png'></image>
				<image v-else-if="time==2" src='../../../../static/images/down.png'></image>
				<image v-else src='../../../../static/images/horn.png'></image>
			</view>
			<view class='item' @click='set_where(2)'>
				价格排序
				<image v-if="old_price==1" src='../../../../static/images/up.png'></image>
				<image v-else-if="old_price==2" src='../../../../static/images/down.png'></image>
				<image v-else src='../../../../static/images/horn.png'></image>
			</view>
			<view class='item' @click='set_where(3)'>
				完成度排序
				<image v-if="price==1" src='../../../../static/images/up.png'></image>
				<image v-else-if="price==2" src='../../../../static/images/down.png'></image>
				<image v-else src='../../../../static/images/horn.png'></image>
			</view>
		</view>
		<view class="index-product-wrapper" :class="bgStyle===0?'':'borderRadius15'"
			:style="{ marginTop: mbConfig*2 + 'rpx', background: themeColor }" v-if="tempArr.length">
			<!-- 单列 -->
				<view class="list-box listA" :class="tempArr.length > 0 ? 'fadeIn on' : ''">
				<uni-swipe-action style="width: 100%;">
				    <uni-swipe-action-item :right-options="options"  @click="bindClick"  v-for="(item, index) in tempArr">
						<view class="item" :class="conStyle?'borderRadius15':''"
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
										{{ item.price * 100}}小豆/套
									</view>
									<view class="old-price" >
										<text>¥</text>
										{{ item.ot_price }}
									</view>
								</view>
								
								
								<button class="buy bnts" v-if="item.rate==100" form-type="submit" @click.stop="buy(item)">
									立即兑换
								</button>
								<button class="buy bnts" style="background-color: #E73708;" v-else form-type="submit" @click.stop="toSwitch('/pages/stores/index')">
									更换
								</button>
								<view class="" style="display: flex;">
									<view style="flex:1">
									<u-line-progress :showText="true" :height="14" inactiveColor="#FDE6D3"  :percentage="item.rate" activeColor="linear-gradient(75deg, #F58325 0%, #F9A94B 100%)"></u-line-progress>
									</view>
									
									<view style="color: #999999;font-size: 20rpx;margin-left: 10rpx;"> 
										{{item.sales}}人领取
									</view>
								</view>
							</view>
						</view>
				    </uni-swipe-action-item>
				</uni-swipe-action>
				</view>
				<view class="tips">更多小目标，快去选择吧~</view>
			</view>
			<view v-else class="empty-mubiao">
				<view>您还没有小目标哦，快去添加吧~</view>
				<view class="gogo" @click="goSail">
					去逛逛
				</view>
			</view>
	</view>
</template>

<script>
	import {
		getProductslist,getCategoryList,getMuBiaolist,postCartNum
	} from '@/api/store.js';
	import {
		postCartAdd
	} from '@/api/store';
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
				price: 0,
				old_price: 0,
				time: 1,
				options:[
						{
				            text: '删除',
				            style: {
				                backgroundColor: '#F58325'
				            }
				        }
				 ],
				tabTitle: [],
				tabLeft: 0,
				cid: 0,
				isWidth: 0, //每个导航栏占位
				tabClick: 0, //导航栏被点击
				isLeft: 0, //导航栏下划线位置
				fixedTop: 0,
				isTop: 0,
				navHeight: 0,
				tempArr: [],
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
			this.getAllCategory();
			this.productslist();
			console.log('refreshGoodsListson');
		    uni.$on("refreshGoodsLists",()=>{
				console.log('refreshGoodsListson');
				this.productslist()
			})
		},
		
		methods: {
			toSwitch:function(url){
				uni.switchTab({
					url:url
				})
			},
			buy:function(item){
				console.log(item);
				postCartAdd({
					cartNum:1,
					productId:item.id,
					new:1,
					uniqueId:"",
					virtual_type:item.virtual_type,
				}).then(res=>{
					uni.navigateTo({
						url:'/pages/users/order_confirm/index?new=1&cartId='+res.data.cartId
					})
				})
			},
			//点击事件处理
			set_where: function(e) {
				
				switch (e) {
					case 1:
						if (this.time == 0) this.time = 1;
						else if (this.time == 1) this.time = 2;
						else if (this.time == 2) this.time = 1;
						this.price = 0
						this.old_price = 0;
						break;
					case 2:
						if (this.old_price == 0) this.old_price = 1;
						else if (this.old_price == 1) this.old_price = 2;
						else if (this.old_price == 2) this.old_price = 1;
						this.price = 0
						this.time = 0;
						break;
					case 3:
						if (this.price == 0) this.price = 1;
						else if (this.price == 1) this.price = 2;
						else if (this.price == 2) this.price = 1;
						this.old_price = 0;
						this.time = 0;
						break;
				}
				this.loadend = false;
				this.productslist();
			},
			goSail(){
				uni.switchTab({
					url:'/pages/stores/index'
				})
			},
			bindClick(options){
				let product_id = this.tempArr[options.index].id;
				postCartNum({
					product_id
				}).then(res=>{
					this.productslist();
				})
				console.log(options);
			},
			// 导航栏点击
			longClick(item, index) {
				if (this.tabTitle.length > 5) {
					this.tabLeft = (index - 2) * this.isWidth //设置下划线位置
				}
				this.tabClick = index //设置导航点击了哪一个
				this.isLeft = index * this.isWidth //设置下划线位置
				this.cid = item.id
				this.productslist();
			},
			// 获取导航
			getAllCategory: function() {
				let that = this;
				getCategoryList().then(res => {
					res.data.unshift({
						"id": 0,
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
				// let limit = this.$config.LIMIT;
				let data = {};
				// if (this.type == 1) {
				// 	data = {
				// 		ids: this.productIds.join(','),
				// 	};
				// } else {
				// 
				// }
				let sort_direction = 'desc';
				let sort_key = '';
				if(this.time){
					sort_key = 'id';
					if(this.time==1){
						sort_direction="asc"
					}else{
						sort_direction="desc"
					}
				}
				if(this.price){
					sort_key = 'price';
					if(this.price==1){
						sort_direction="asc"
					}else{
						sort_direction="desc"
					}
				}
				if(this.old_price){
					sort_key = 'ot_price';
					if(this.old_price==1){
						sort_direction="asc"
					}else{
						sort_direction="desc"
					}
				}
				data = {
					    sort_direction:sort_direction,
						sort_key:sort_key,
						limit: 20,
						cid:this.cid,
				};
				getMuBiaolist(data).then(res => {
					this.tempArr = res.data;
				});
			},
			goDetail(item) {
				this.$emit('detail', item);
			}
		}
	};
</script>

<style lang="scss" scoped>
	.nav {
	  height: 86rpx;
	  color: #454545;
	  left: 0;
	  width: 100%;
	  font-size: 28rpx;
	  background-color: #fff;
	  top: 0;
	  z-index: 9;
	  display: flex;
	  justify-content: space-around;
	}
.nav .item {
	  text-align: center;
	  padding: 10rpx 20rpx;
	  background: #FFFFFF;
	  color: #999999;
	  box-shadow: 0px 0px 5px 0px rgba(153, 153, 153, 0.2);
	  border-radius: 12px;
	}
	.nav .item.font-color {
	  font-weight: bold;
	}
	 .nav .item image {
	  width: 15rpx;
	  height: 19rpx;
	  margin-left: 10rpx;
	}
	.tips{
		display: flex;
		justify-content: center;
		padding: 10rpx 10rpx 30rpx 10rpx;
		color: #666666;
	}
	.empty-mubiao{
		padding: 40rpx;
		display: flex;
		justify-content: center;
		flex-direction: column;
		 align-items: center;
		 font-weight: bold;
		 font-size: 24rpx;
		 color: #CCCCCC;
		.gogo{
				display: flex;
			    justify-content: center;
			    align-items: center;
			    width: 228rpx;
			    height: 60rpx;
			    background: linear-gradient(93deg, #F58426 0%, #F9AD53 100%);
			    border-radius: 30rpx;
			    color: #fff;
			    margin-top: 30rpx;
		}
	}
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
						margin-top: 80rpx;
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
			    right: 20rpx;
			    font-size: 22rpx;
			    padding: 6rpx 25rpx;
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
			padding:0 5rpx;
			.longItem {
				color:#666666;
				padding:0 10rpx;
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
