<template>
	<view :style="colorStyle">
		<view class='searchGood'>
			<view class='search acea-row row-between-wrapper'>
				<view class='input acea-row row-between-wrapper'>
					<text class='iconfont icon-sousuo'></text>
					<input type='text' v-model='searchValue' @confirm="inputConfirm" focus placeholder='点击搜索商品'
						placeholder-class='placeholder' @input="setValue"></input>
				</view>
				<view class='bnt' @tap='searchBut'>搜索</view>
			</view>
			<template v-if="history.length">
				<view class='title acea-row row-between-wrapper'>
					<view class="search_title">搜索历史</view>
					<view class="iconfont icon-shanchu" @click="clear"></view>
				</view>
				<view class='list acea-row'>
					<block v-for="(item,index) in history" :key="index">
						<view class='item history-item line1' @tap='setHotSearchValue(item.keyword)'
							v-if="item.keyword">{{item.keyword}}</view>
					</block>
				</view>
			</template>
			<view class='title search_title'>热门搜索</view>
			<view class='list acea-row'>
				<block v-for="(item,index) in hotSearchList" :key="index">
					<view class='item line1' @tap='setHotSearchValue(item.val)' v-if="item.val">{{item.val}}</view>
				</block>
			</view>
			<view class='line' v-if='bastList.length'></view>
			<goodList :bastList="bastList" v-if="bastList.length > 0"></goodList>
			<view class='loadingicon acea-row row-center-wrapper' v-if="bastList.length > 0">
				<text class='loading iconfont icon-jiazai' :hidden='loading==false'></text>{{loadTitle}}
			</view>
		</view>
		<view class='noCommodity'>
			<view class='pictrue' v-if="bastList.length == 0">
				<image :src="`${image_url}/static/images/noSearch.png`"></image>
			</view>
			<recommend :hostProduct='hostProduct' v-if="bastList.length == 0 && page > 1"></recommend>
		</view>
	</view>
</template>

<script>
	import { IMAGE_URL } from "@/config/app.js";

	import {
		getSearchKeyword,
		getProductslist,
		getProductHot
	} from '@/api/store.js';
	import {
		searchList,
		clearSearch
	} from '@/api/api.js';
	import goodList from '@/components/goodList';
	import recommend from '@/components/recommend';
	import colors from "@/mixins/color";
	export default {
		components: {
			goodList,
			recommend
		},
		mixins: [colors],
		data() {
			return {
				image_url:IMAGE_URL,
				hostProduct: [],
				searchValue: '',
				focus: true,
				bastList: [],
				hotSearchList: [],
				first: 0,
				limit: 8,
				page: 1,
				loading: false,
				loadend: false,
				loadTitle: '加载更多',
				hotPage: 1,
				isScroll: true,
				history: []
			};
		},
		onShow: function() {
			// this.getRoutineHotSearch();
			this.getHostProduct();
			this.searchList();
			try {
				this.hotSearchList = uni.getStorageSync('hotList');
			} catch (err) {}
		},
		onReachBottom: function() {
			if (this.bastList.length > 0) {
				this.getProductList();
			} else {
				this.getHostProduct();
			}

		},
		methods: {
			searchList() {
				searchList({
					page: 1,
					limit: 10
				}).then(res => {
					this.history = res.data;
				});
			},
			clear() {
				let that = this;
				clearSearch().then(res => {
					uni.showToast({
						title: res.msg,
						success() {
							that.history = [];
						}
					});
				});
			},
			inputConfirm: function(event) {
				if (event.detail.value) {
					uni.hideKeyboard();
					this.setHotSearchValue(event.detail.value);
				}
			},
			getRoutineHotSearch: function() {
				let that = this;
				getSearchKeyword().then(res => {
					that.$set(that, 'hotSearchList', res.data);
				});
			},
			getProductList: function() {
				let that = this;
				if (that.loadend) return;
				if (that.loading) return;
				that.loading = true;
				that.loadTitle = '';
				getProductslist({
					keyword: that.searchValue.trim(),
					page: that.page,
					limit: that.limit
				}).then(res => {
					let list = res.data,
						loadend = list.length < that.limit;
					that.bastList = that.$util.SplitArray(list, that.bastList);
					that.$set(that, 'bastList', that.bastList);
					that.loading = false;
					that.loadend = loadend;
					that.loadTitle = loadend ? "人家是有底线的~" : "加载更多";
					that.page = that.page + 1;
				}).catch(err => {
					that.loading = false,
						that.loadTitle = '加载更多'
				});
			},
			getHostProduct: function() {
				let that = this;
				if (!this.isScroll) return
				getProductHot(that.hotPage, that.limit).then(res => {
					that.isScroll = res.data.length >= that.limit
					that.hostProduct = that.hostProduct.concat(res.data)
					that.hotPage += 1;
				});
			},
			setHotSearchValue: function(event) {
				this.$set(this, 'searchValue', event);
				this.page = 1;
				this.loadend = false;
				this.$set(this, 'bastList', []);
				this.getProductList();
			},
			setValue: function(event) {
				this.$set(this, 'searchValue', event.detail.value);
			},
			searchBut: function() {
				let that = this;
				if (!that.searchValue.trim()) return this.$util.Tips({
					title: '请输入要搜索的商品'
				});
				that.focus = false;
				// if (that.searchValue.length > 0) {
				that.page = 1;
				that.loadend = false;
				that.$set(that, 'bastList', []);
				uni.showLoading({
					title: '正在搜索中'
				});
				that.getProductList();
				uni.hideLoading();
				// } else {
				// 	return this.$util.Tips({
				// 		title: '请输入要搜索的商品',
				// 		icon: 'none',
				// 		duration: 1000,
				// 		mask: true,
				// 	});
				// }
			}
		}
	}
</script>

<style lang="scss">
	page {
		background-color: #fff !important;
	}

	.noCommodity {
		border-top-width: 0;
	}
	.search_title{
		background: url('#{$app-url}/static/images/goods_search_title_bg.png') no-repeat;
		background-size: 100rpx 50%;
		background-position: bottom left;
	}
	.searchGood .search {
		padding: 10rpx 0rpx 10px 30rpx;
		background-color: #F58325;
	}

	.searchGood .search .input {
		width: 598rpx;
		background: rgba(255, 255, 255, 0.3);
		border-radius: 33rpx;
		padding: 0 35rpx;
		box-sizing: border-box;
		height: 66rpx;
	}

	.searchGood .search .input input {
		width: 472rpx;
		font-size: 28rpx;
	}

	.searchGood .search .input .placeholder {
		color: #fff;
	}

	.searchGood .search .input .iconfont {
		color: #fff;
		font-size: 35rpx;
	}

	.searchGood .search .bnt {
		width: 120rpx;
		text-align: center;
		height: 66rpx;
		line-height: 66rpx;
		font-size: 28rpx;
		color: #fff;
	}

	.searchGood .title {
		font-size: 28rpx;
		color: #333333;
		margin: 50rpx 30rpx 25rpx 30rpx;
	}

	.searchGood .title .iconfont {
		font-size: 28rpx;
	}

	.searchGood .list {
		padding-left: 10rpx;
	}

	.searchGood .list .item {
		font-size: 26rpx;
		color: #F58325;
		padding: 0 30rpx;
		height: 50rpx;
		border-radius: 30rpx;
		line-height: 50rpx;
		border: 1rpx solid #F58325;
		
		margin: 0 0 20rpx 20rpx;
	}

	.searchGood .list .item.history-item {
		height: 50rpx;
		color: #666666;
		border: none;
		border-radius: 25rpx;
		background-color: #F4F4F2;
		line-height: 50rpx;
	}

	.searchGood .line {
		border-bottom: 1rpx solid #eee;
		margin: 20rpx 30rpx 0 30rpx;
	}
</style>
