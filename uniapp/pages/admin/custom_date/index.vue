<template>
	<view>
		<uni-calendar range @change="change"></uni-calendar>
		<navigator class="back" open-type="navigateBack" hover-class="none">取消</navigator>
	</view>
</template>

<script>

	export default {
		components: {
		},
		data() {
			return {
				type: ''
			};
		},
		onLoad(options) {
			this.type = options.type;
		},
		methods: {
			change(e) {
				const {
					before,
					after
				} = e.range;
				if (before && after) {
					uni.navigateTo({
						url: `/pages/admin/statistics/index?type=${this.type}&before=${before}&after=${after}&time=date`
					});
				}
			}
		},
	}
</script>

<style lang="scss" scoped>
	.back {
		height: 86rpx;
		border: 1rpx solid #E93323;
		border-radius: 43rpx;
		margin: 60rpx 30rpx;
		font-size: 30rpx;
		line-height: 84rpx;
		text-align: center;
		color: #E93323;
	}
</style>
