<template>
	<view class="warp">
		<view class="header">
			<u-search :showAction="false" placeholder="日照香炉生紫烟" v-model="keyword"></u-search>
		</view>
		<view class="nav-box">
			<u-tabs :list="list1" :scrollable="false" @click="click"></u-tabs>
			<u-list @scrolltolower="scrolltolower">
				<u-list-item v-for="(item, index) in indexList" :key="index">
					<u-cell :title="`列表长度-${index + 1}`">
						{{item}}
					</u-cell>
				</u-list-item>
			</u-list>
		</view>
		<tabBar :dataConfig="tabBar.default" :pagePath="'/pages/task/index'"
			@click.native="bindEdit('tabBar', 'default')"></tabBar>
	</view>
</template>

<script>
	// import tabBar from "./tabBar";
	import tabBar from "@/pages/index/visualization/components/tabBar.vue";
	import {
		getShare
	} from "@/api/public.js";
	
	export default {
		data() {
			return {
				tabBarList: {title: "图片建议宽度81*81px", list: [{
					name: "首页",
					},
					{name: "我的"}]},
				indexList: [1, 2, 3],
				list1: [{
					name: '急速赚',
					sonName: '商家发布',
				}, {
					name: '任务赚',
					sonName: '商家发布',
				}, {
					name: '游戏赚',
					sonName: '商家发布',
				}, {
					name: '转发赚',
					sonName: '商家发布',
				}, ],
				isDiy: uni.getStorageSync('is_diy'),
				shareInfo: {}
			}
		},
		components: {
			tabBar
		},
		onShow() {
			uni.$on('is_diy', (data) => {
				this.isDiy = data
			})
			this.setOpenShare();
		},
		onHide() {
			// this.isDiy = -1
		},
		methods: {
			// 微信分享；
			setOpenShare: function() {
				let that = this;
				getShare().then((res) => {
					let data = res.data;
					this.shareInfo = data;
					// #ifdef H5
					let url = location.href;
					if (this.$store.state.app.uid) {
						url =
							url.indexOf("?") === -1 ?
							url + "?spread=" + this.$store.state.app.uid :
							url + "&spread=" + this.$store.state.app.uid;
					}
					if (that.$wechat.isWeixin()) {
						let configAppMessage = {
							desc: data.synopsis,
							title: data.title,
							link: url,
							imgUrl: data.img,
						};
						that.$wechat.wechatEvevt(
							["updateAppMessageShareData", "updateTimelineShareData"],
							configAppMessage
						);
					}
					// #endif
				});
			},
		},
		// #ifdef MP
		//发送给朋友
		onShareAppMessage(res) {
			// 此处的distSource为分享者的部分信息，需要传递给其他人
			let that = this;
			return {
				title: this.shareInfo.title,
				path: "/pages/index/index",
				imageUrl: this.shareInfo.img,
			};
		},
		//分享到朋友圈
		onShareTimeline() {
			return {
				title: this.shareInfo.title,
				imageUrl: this.shareInfo.img,
			};
		},
		// #endif
	}
</script>

<style lang="scss" scoped>
	.header {
		padding: 20rpx;
		background: $app-color;
	}
</style>
