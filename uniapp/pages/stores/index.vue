<template>
	<view :style="colorStyle">
		<view class="sys-head" :style="{height:sysHeight}"></view> 
		<view style="height:48px;position: relative;">
			<view id="home" class="home acea-row row-center-wrapper">
				<view class="iconfont icon-fanhui2" @tap="returns()"></view>
				<!-- #ifdef MP -->
				<view class="line"></view>
				<view class="iconfont icon-shouye8" @click="goHome()"></view>
				<!-- #endif -->
			</view>
		</view>
		
		<!-- <homeList :navH="navH" :returnShow="true" :currentPage="false" :sysHeight="sysHeight" >
		</homeList> -->
		<view class="circle-header">
			<u-image :src="circle_detail.icon.path_format" radius="10" width="100px" height="80px"></u-image>
			<view class="right">
				<view class="circle-header-title">{{circle_detail.name}}</view>
				<view class="circle-header-info">{{circle_detail.info}}</view>
				<view class="circle-header-bottom">
					<view @click="setCollect" class="item skeleton-rect">
						<view class="iconfont icon-shoucang1" style="color: red;"  v-if="circle_detail.is_collect"></view>
						<view class="iconfont icon-shoucang" v-else></view>
						<!-- <view class="p_center">收藏</view> -->
					</view>
				</view>
			</view>
		</view>
		
		<view class='productList'>
			<!-- -->
			<view class="circle">

			</view>
			<view class="longTab acea-row row-middle">
				<scroll-view scroll-x="true" style="white-space: nowrap; display: flex;height:44rpx;"
					scroll-with-animation :scroll-left="tabLeft" show-scrollbar="true">
					<view class="longItem" :style='"width:"+isWidth+"px"' :class="index===navActive?'click':''"
						v-for="(item,index) in categoryList" :key="index" @click="tapNav(index,item)">
						{{item.name}}
					</view>
				</scroll-view>
			</view>
			<view class='nav acea-row row-middle'>
				<view class='item' :class='nows ? "font-color":""' @click='set_where(4)'>新品</view>
				<view class='item' @click='set_where(2)'>
					抖币排序
					<image v-if="price==1" src='../../static/images/up.png'></image>
					<image v-else-if="price==2" src='../../static/images/down.png'></image>
					<image v-else src='../../static/images/horn.png'></image>
				</view>
				<view class='item' @click='set_where(3)'>
					销量排序
					<image v-if="stock==1" src='../../static/images/up.png'></image>
					<image v-else-if="stock==2" src='../../static/images/down.png'></image>
					<image v-else src='../../static/images/horn.png'></image>
				</view>
			</view>
			<view class='list acea-row row-between-wrapper' :class='is_switch==true?"":"on"'>
				<view class='item' :class='is_switch==true?"":"on"' hover-class='none'
					v-for="(item,index) in productList" :key="index" @click="godDetail(item)">
					<view class='pictrue' :class='is_switch==true?"":"on"'>
						<image :src='item.image.path_format' mode="aspectFill" :class='is_switch==true?"":"on"'></image>
						<span class="pictrue_log_class" :class="is_switch === true ? 'pictrue_log_big' : 'pictrue_log'"
							v-if="item.activity && item.activity.type === '1'">秒杀</span>
						<span class="pictrue_log_class" :class="is_switch === true ? 'pictrue_log_big' : 'pictrue_log'"
							v-if="item.activity && item.activity.type === '2'">砍价</span>
						<span class="pictrue_log_class" :class="is_switch === true ? 'pictrue_log_big' : 'pictrue_log'"
							v-if="item.activity && item.activity.type === '3'">拼团</span>
					</view>
					<view class='text' :class='is_switch==true?"":"on"'>
						<view class='name line1'>{{item.name}}</view>
						<view class='money font-color' :class='is_switch==true?"":"on"'><text
								class='num'>{{item.price}}</text>抖币</view>
						<view class='vip acea-row row-between-wrapper' :class='is_switch==true?"":"on"'>
							<view class='vip-money' v-if="item.vip_price && item.vip_price > 0">￥{{item.vip_price}}
								<image src='../../static/images/vip.png'></image>
							</view>
							<view>已售{{item.sales}}{{item.unit_name || '件'}}</view>
						</view>
						
					</view>
				</view>
				<view class='loadingicon acea-row row-center-wrapper' v-if='productList.length > 0'>
					<text class='loading iconfont icon-jiazai' :hidden='loading==false'></text>{{loadTitle}}
				</view>
			</view>
		</view>
		<view class='noCommodity' v-if="productList.length==0 && where.page > 1">
			<view class='pictrue'>
				<image :src="`${image_url}/static/images/noShopper.png`"></image>
			</view>
			<recommend :hostProduct="hostProduct"></recommend>
		</view>
		<!-- #ifndef MP -->
		<home></home>
		<!-- #endif -->

		<tabBar v-if="!is_diy" :pagePath="'/pages/user/index'"></tabBar>
		<view class="foot" v-else-if="is_diy && newData.status && newData.status.status">
			<view class="page-footer" id="target" :style="{'background-color':newData.bgColor.color[0].item}">
				<view class="foot-item" v-for="(item,index) in newData.menuList" :key="index" @click="goRouter(item)">
					<block v-if="item.link == activeRouter">
						<image :src="item.imgList[0]"></image>
						<view class="txt" :style="{color:newData.activeTxtColor.color[0].item}">{{item.name}}</view>
					</block>
					<block v-else>
						<image :src="item.imgList[1]"></image>
						<view class="txt" :style="{color:newData.txtColor.color[0].item}">{{item.name}}</view>
					</block>
					<div class="count-num" v-if="item.link === '/pages/order_addcart/order_addcart' && cartNum > 0">
						{{cartNum}}
					</div>
				</view>
			</view>
		</view>

	</view>
</template>

<script>
	let app = getApp();
		let sysHeight = uni.getSystemInfoSync().statusBarHeight + 'px';
	let statusBarHeight = uni.getSystemInfoSync().statusBarHeight * 2 + 'rpx';
	import homeList from '@/components/homeList'
	import { IMAGE_URL } from "@/config/app.js";
	console.log(IMAGE_URL,'IMAGE_URL');
	import headerSearch from '@/pages/index/diy/components/headerSerch.vue'
	import home from '@/components/home';
	import {
		getNavigation,
	} from '@/api/public.js'
	import {
		getCategoryList,
		getProductslist,
		getProductHot
	} from '@/api/store.js';
	
	import {
		getCircleDetail,
		setCollect
	} from '@/api/circle.js'
	import recommend from '@/components/recommend';
	import {
		mapGetters
	} from "vuex";
	import {
		goShopDetail
	} from '@/libs/order.js'
	import colors from '@/mixins/color.js';
	export default {
		computed: mapGetters(['uid']),
		components: {
			recommend,
			home,
			headerSearch,
			homeList,
		},
		mixins:[colors],
		data() {
			return {
				sysHeight: sysHeight,
				navH:app.globalData.navHeight,
				is_diy: uni.getStorageSync('is_diy'),
				image_url:IMAGE_URL,
				categoryList: [],
				navActive: 0,
				categoryTitle: '',
				categoryErList: [],
				tabLeft: 0,
				isWidth: 0, //每个导航栏占位
				tabClick: 0, //导航栏被点击
				iSlong: true,
				productList: [],
				is_switch: true,
				newData: {},
				where: {
					sid: 0,
					keyword: '',
					priceOrder: '',
					salesOrder: '',
					news: 0,
					page: 1,
					limit: 20,
					product_category_pid: 0,
					product_category_id: 0,
				},
				price: 0,
				circle_id: 0,
				stock: 0,
				circle_detail:{},
				nows: false,
				loadend: false,
				loading: false,
				loadTitle: '加载更多',
				title: '',
				hostProduct: [],
				hotPage: 1,
				hotLimit: 10,
				  activeRouter:"",
				hotScroll: false
			};
		},
		onShow() {
		  uni.$on('is_diy', data => {
		    this.isDiy = data;
		  });
		},
		onLoad: function(options) {
			
			
			var that = this;
			uni.getSystemInfo({
				success(e) {
					that.isWidth = e.windowWidth / 5
				}
			});
			this.circle_id = options.circle_id
			this.getCircleDetail();
			this.getAllCategory();
			this.where.product_category_pid = options.cid || 0;
			this.$set(this.where, 'sid', options.sid || 0);
			this.title = options.title || '';
			this.$set(this.where, 'keyword', options.searchValue || '');
			this.$set(this.where, 'productId', options.productId || '');
			// this.get_product_list();
			
			if (this.is_diy) {
				if (uni.getStorageSync('FOOTER_BAR')) {
					uni.hideTabBar()
				}
				getNavigation().then(res => {
					this.newData = res.data
					if (this.newData.status && this.newData.status.status) {
						uni.hideTabBar()
					} else {
						uni.showTabBar()
					}
				})
				let routes = getCurrentPages(); // 获取当前打开过的页面路由数组
				let curRoute = routes[routes.length - 1].route //获取当前页面路由
				this.activeRouter = '/' + curRoute
			}
		},
		methods: {
			setCollect(){
				setCollect({circle_id:this.circle_id}).then(res=>{
					this.circle_detail.is_collect = !this.circle_detail.is_collect
				})
			},
			getCircleDetail(){
				getCircleDetail({id:this.circle_id}).then(res=>{
					this.circle_detail = res;
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
			goHome(){
				uni.switchTab({
					url:'/pages/index/index'
				})
			},
			// 后退
			returns() {
				// #ifdef H5
				return history.back();
				// #endif
				// #ifndef H5
				return uni.navigateBack({
					delta: 1,
				})
				// #endif
			},
			getAllCategory: function() {
				let that = this;
				getCategoryList({circle_id:this.circle_id,limit:-1}).then(res => {
					let data = res;
						data.unshift({
							'id': 0,
							'name': '全部'
						})
					that.categoryTitle = data[0].cate_name;
					that.where.product_category_pid = data[0].id;
					that.sid = 0;
					that.navActive = 0;
					that.tabClick = 0;
					that.categoryList = data;
					// that.categoryErList = res.data[0].children ? res.data[0].children : [];
					that.page = 1;
					that.loadend = false;
					that.tempArr = [];
					that.get_product_list();
				})
			},
			// 去详情页
			godDetail(item) {
				goShopDetail(item, this.uid).then(res => {
					uni.navigateTo({
						url: `/pages/goods_details/index?id=${item.id}`
					})
				})
			},
			Changswitch: function() {
				let that = this;
				that.is_switch = !that.is_switch
			},
			searchSubmit: function(e) {
				let that = this;
				that.$set(that.where, 'keyword', e.detail.value);
				that.loadend = false;
				that.$set(that.where, 'page', 1)
				this.get_product_list(true);
			},
			/**
			 * 获取我的推荐
			 */
			get_host_product: function() {
				let that = this;
				if (that.hotScroll) return
				getProductHot(
					that.hotPage,
					that.hotLimit,
				).then(res => {
					that.hotPage++
					that.hotScroll = res.data.length < that.hotLimit
					that.hostProduct = that.hostProduct.concat(res.data)
					// that.$set(that, 'hostProduct', res.data)
				});
			},

			tapNav(index, item) {
				let list = this.categoryList[index];
				this.navActive = index;
				this.categoryTitle = list.cate_name;
				this.categoryErList = item.children ? item.children : [];
				this.tabClick = 0;
				this.tabLeft = 0;
				this.where.product_category_pid = list.id;
				this.sid = 0;
			    this.$set(this.where, 'page', 1);
				this.loadend = false;
				this.tempArr = [];
				this.get_product_list(true);
			},
			//点击事件处理
			set_where: function(e) {
				switch (e) {
					case 1:
						// #ifdef H5
						return history.back();
						// #endif
						// #ifndef H5
						return uni.navigateBack({
							delta: 1,
						})
						// #endif
						break;
					case 2:
						if (this.price == 0) this.price = 1;
						else if (this.price == 1) this.price = 2;
						else if (this.price == 2) this.price = 0;
						this.stock = 0;
						break;
					case 3:
						if (this.stock == 0) this.stock = 1;
						else if (this.stock == 1) this.stock = 2;
						else if (this.stock == 2) this.stock = 0;
						this.price = 0
						break;
					case 4:
						this.nows = !this.nows;
						break;
				}
				this.loadend = false;
				this.$set(this.where, 'page', 1);
				this.get_product_list(true);
			},
			//设置where条件
			setWhere: function() {
				if (this.price == 0) this.where.priceOrder = '';
				else if (this.price == 1) this.where.priceOrder = 'asc';
				else if (this.price == 2) this.where.priceOrder = 'desc';
				if (this.stock == 0) this.where.salesOrder = '';
				else if (this.stock == 1) this.where.salesOrder = 'asc';
				else if (this.stock == 2) this.where.salesOrder = 'desc';
				this.where.news = this.nows ? 1 : 0;
			},
			//查找产品
			get_product_list: function(isPage) {
				let that = this;
				that.setWhere();
				if (that.loadend) return;
				if (that.loading) return;
				if (isPage === true) that.$set(that, 'productList', []);
				that.loading = true;
				that.loadTitle = '';
				getProductslist(that.where).then(res => {
					let list = res.data;
					let productList = that.$util.SplitArray(list, that.productList);
					let loadend = list.length < that.where.limit;
					that.loadend = loadend;
					that.loading = false;
					that.loadTitle = loadend ? '已全部加载' : '加载更多';
					that.$set(that, 'productList', productList);
					that.$set(that.where, 'page', that.where.page + 1);
					if (!that.productList.length) this.get_host_product();
				}).catch(err => {
					that.loading = false;
					that.loadTitle = '加载更多';
				});
			},
		},
		onPullDownRefresh() {

		},
		onReachBottom() {
			if (this.productList.length > 0) {
				this.get_product_list();
			} else {
				this.get_host_product();
			}
		}
	}
</script>
<style>
	page{
		background-image: linear-gradient( 80deg, #597D95 10%, #92837E 100%);
	}
</style>
<style scoped lang="scss">
	
		.productList{
			background-color: white;
			border-radius:20rpx;
			overflow: hidden;
			height: calc(100vh - 50px);
		}
		.home{
			.line{
				width: 1rpx;
				height: 34rpx;
				background: #B3B3B3;
			}
			.iconfont{
				    width: 58rpx;
				    text-align: center;
			}
			position: absolute;
			left: 10px;
			top: 0px;
			    color: #333;
			    width: 126rpx;
			    left: 15rpx;
			    height: 56rpx;
			    z-index: 99;
			    background: rgba(255, 255, 255, 0.3);
			    border: 1px solid rgba(0, 0, 0, 0.1);
			    border-radius: 40rpx;
			    font-size: 33rpx;
		}
		
		.circle-header{
			padding:0rpx 20rpx 20rpx 20rpx;
			display: flex;
			.right{
				display: flex;
				flex-direction: column;
				justify-content: space-between;
				margin-left: 20rpx;
				color: white;
				flex:1;
				.circle-header-title{
					font-size: 28rpx;
					font-weight: bold;
					
				}
				.circle-header-info{
					font-size: 24rpx;
					height: 2em;
				}
				.circle-header-bottom{
					display: flex;
					justify-content: flex-end;
				}
			}
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
	.longTab {
		width: 100%;
		height: 100rpx;
		z-index: 99;
		background-color: #fff;					
		.longItem {
			height: 44rpx;
			display: inline-block;
			line-height: 44rpx;
			text-align: center;
			font-size: 26rpx;
			overflow: hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
			color: #666;
			background-color: white;
			border-radius: 22rpx;
			margin-left: 12rpx;
			&.click {
				font-weight: bold;
				color: #F58325;
				font-size: 28rpx;
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
	
		.filter-box {
			.filter {
				display: flex;
				justify-content: space-between;
				padding: 0 24rpx;
				margin: 36rpx 0 26rpx 0;
				width: 100vw;
				
				&-btn {
					display: flex;
					justify-content: center;
					align-items: center;
					width: 163rpx;
					height: 48rpx;
					background: #FFFFFF;
					box-shadow: 0px 0px 10rpx 0px rgba(153,153,153,0.2);
					border-radius: 24rpx;
					color: #999999;
					font-size: 22rpx;
					
					.iconfont {
						font-size: 16rpx;
						color: #999;
						margin-left: 10rpx;
						opacity: 0.7;
					}
				}
		}
	}
	}
	
	
	.productList .search {
		width: 100%;
		height: 86rpx;
		padding-left: 23rpx;
		box-sizing: border-box;
		position: fixed;
		left: 0;
		top: 0;
		z-index: 9;
	}

	.productList .search .input {
		width: 640rpx;
		height: 60rpx;
		background-color: #fff;
		border-radius: 50rpx;
		padding: 0 20rpx;
		box-sizing: border-box;
	}

	.productList .search .input input {
		width: 548rpx;
		height: 100%;
		font-size: 26rpx;
	}

	.productList .search .input .placeholder {
		color: #999;
	}

	.productList .search .input .iconfont {
		font-size: 35rpx;
		color: #555;
	}

	.productList .search .icon-pailie,
	.productList .search .icon-tupianpailie {
		color: #fff;
		width: 62rpx;
		font-size: 40rpx;
		height: 86rpx;
		line-height: 86rpx;
	}

	.productList .nav {
		height: 86rpx;
		color: #454545;
		// position: fixed;
		left: 0;
		width: 100%;
		font-size: 28rpx;
		background-color: #fff;
		// margin-top: 86rpx;
		top: 0;
		z-index: 9;
		display: flex;
		justify-content: space-around;
	}

	.productList .nav .item {
		text-align: center;
		padding:10rpx 20rpx;
		background: #FFFFFF;
		color: #999999;
		box-shadow: 0px 0px 5px 0px rgba(153,153,153,0.2);
		border-radius: 12px;
	}

	.productList .nav .item.font-color {
		font-weight: bold;
	}

	.productList .nav .item image {
		width: 15rpx;
		height: 19rpx;
		margin-left: 10rpx;
	}

	.productList .list {
		padding: 0 20rpx;
		// margin-top: 172rpx;
	}

	.productList .list.on {
		background-color: #fff;
		border-top: 1px solid #f6f6f6;
	}

	.productList .list .item {
		width: 345rpx;
		margin-top: 20rpx;
		background-color: #fff;
		border-radius: 20rpx;
	}

	.productList .list .item.on {
		width: 100%;
		display: flex;
		border-bottom: 1rpx solid #f6f6f6;
		padding: 30rpx 0;
		margin: 0;
	}

	.productList .list .item .pictrue {
		position: relative;
		width: 345rpx;
		height: 345rpx;
	}

	.productList .list .item .pictrue.on {
		width: 180rpx;
		height: 180rpx;
	}

	.productList .list .item .pictrue image {
		width: 100%;
		height: 100%;
		border-radius: 20rpx 20rpx 0 0;
	}

	.productList .list .item .pictrue image.on {
		border-radius: 6rpx;
	}

	.productList .list .item .text {
		padding: 20rpx 17rpx 26rpx 17rpx;
		font-size: 30rpx;
		color: #222;
	}

	.productList .list .item .text.on {
		width: 508rpx;
		padding: 0 0 0 22rpx;
	}

	.productList .list .item .text .money {
		font-size: 26rpx;
		font-weight: bold;
		margin-top: 8rpx;
	}

	.productList .list .item .text .money.on {
		margin-top: 50rpx;
	}

	.productList .list .item .text .money .num {
		font-size: 34rpx;
	}

	.productList .list .item .text .vip {
		font-size: 22rpx;
		color: #aaa;
		margin-top: 7rpx;
	}

	.productList .list .item .text .vip.on {
		margin-top: 12rpx;
	}

	.productList .list .item .text .vip .vip-money {
		font-size: 24rpx;
		color: #282828;
		font-weight: bold;
	}

	.productList .list .item .text .vip .vip-money image {
		width: 46rpx;
		height: 21rpx;
		margin-left: 4rpx;
	}

	.noCommodity {
		background-color: #fff;
		padding-bottom: 30rpx;
	}
</style>
