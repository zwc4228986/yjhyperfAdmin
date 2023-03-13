<template>
	<view>
		<ad-rewarded-video ref="adRewardedVideo" adpid="1705716440" :preload="false" :loadnext="false" :disabled="true"
		      v-slot:default="{loading, error}" @load="onadload" @close="onadclose" @error="onaderror">
		      <view class="ad-error" v-if="error">{{error}}</view>
		</ad-rewarded-video>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				
			}
		},
		methods: {
			onaderror(e){
				
			},
			onadload(e){
				
			},
			onadclose(e) {
			        const detail = e.detail
			        // 用户点击了【关闭广告】按钮
			        if (detail && detail.isEnded) {
			          // 正常播放结束
			          console.log("onClose " + detail.isEnded);
					  // this.sign();
					  this.$emit('success');
					  
			        } else {
						
			          // 播放中途退出
			          console.log("onClose " + detail.isEnded);
			        }
			        //this.isLoading = true;
			        //this.$refs.adRewardedVideo.load();
			},
			show(){
				 this.$refs.adRewardedVideo.show();
			}
		}
	}
</script>

<style>

</style>
