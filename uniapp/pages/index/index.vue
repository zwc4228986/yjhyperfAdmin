<template>
	<view>
		<diy v-if="isDiy"></diy>
		<ourLoading isFullScreen active @loadSuccess="loadSuccess" text="loading..."  />
		<ad-interstitial ref="ad" adpid="1216003411" :loadnext="true" v-slot:default="{loading, error}" @load="onadload" @close="onadclose" @error="onaderror">
		   
		</ad-interstitial>
	</view>
</template>

<script>
	import diy from './diy'
	import {getShare} from "@/api/public.js";
	export default {
		data() {
			return {
				isDiy: false,
				shareInfo:{}
			}
		},
		components: {
			diy
		},
		onShow() {
			this.setOpenShare();
		},
		onHide() {
			// this.isDiy = -1
		},
		methods: {
				loadSuccess(){
					this.isDiy = true;
				},
				onadload(e) {
				  this.$refs.ad.show();
			    },
			    onadclose(e) {
					 console.log("onadclose",e);
			    },
			    onaderror(e) {
			      // 广告加载失败
			      console.log("onaderror: ", e.detail);
			    },
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

<style>

</style>
