<template>
	<view>
		<!-- <web-view src="/hybrid/html/index.html"></web-view> -->
		<web-view :src="url1"></web-view>
	<!-- 	<ad-rewarded-video ref="adRewardedVideo" adpid="1507000689" :preload="false" :loadnext="false" :disabled="true"
		      v-slot:default="{loading, error}" @load="onadload" @close="onadclose" @error="onaderror">
		      <view class="ad-error" v-if="error">{{error}}</view>
		</ad-rewarded-video> -->
	</view>
</template>

<script>
	import store from '@/store';
	
	export default {
		data() {
			return {
				url1:'',
			}
		},
		onLoad(){
			// this.url1 = "http://192.168.0.139:7456?token="+store.state.app.token
			// this.url1 = "/hybrid/html/index.html?token="+store.state.app.token
			this.url1 = "https://hyperf.xiaomubiao.shopping?token="+store.state.app.token
		},
		
		onReady(){
			// this.RewardedVideoAd = wx.createRewardedVideoAd('1111');
			// console.log(this.RewardedVideoAd);
			// setTimeout(res=>{
			// 	this.RewardedVideoAd.load();
			// },1000);
		},
		methods: {
			// webview向外部发送消息
			handlePostMessage: function(data) {
				console.log("接收到消息");
			},
			 onadload(e) {
			      console.log('广告数据加载成功');
			    },
			    onadclose(e) {
			      const detail = e.detail
			      // 用户点击了【关闭广告】按钮
			      if (detail && detail.isEnded) {
			        // 正常播放结束
			        console.log("onadclose " + detail.isEnded);
			      } else {
			        // 播放中途退出
			        console.log("onadclose " + detail.isEnded);
			      }
			    },
			    onaderror(e) {
			      // 广告加载失败
			      console.log("onaderror: ", e.detail);
			    }
		}
	}
</script>

<style>

</style>
