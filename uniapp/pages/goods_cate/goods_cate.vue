<template>
	<view>
		<goodsCate1 ref="classOne"></goodsCate1>
	</view>
</template>



<script>
	import colors from "@/mixins/color";
	import goodsCate1 from './goods_cate1';


	import {
		colorChange
	} from '@/api/api.js';
	import {
		mapGetters
	} from 'vuex';
	
	export default {
		computed: mapGetters(['isLogin', 'uid']),
		components: {
			goodsCate1
		},
		mixins: [colors],
		data() {
			return {
				status: 0,
			}
		},
		onLoad() {
			
		},
		onReady() {

		},
		onShow() {
			if (this.status == 2 || this.status == 3) {
				uni.hideTabBar();
			} else if (this.status == 1) {
				this.$refs.classOne.getNav();
			}
		},
		methods: {
			
		},
		onReachBottom: function() {
			if (this.category == 2) {
				this.$refs.classTwo.productslist();
			}
			if (this.category == 3) {
				this.$refs.classThree.productslist();
			}
		}
	}
</script>
<style scoped lang="scss">
	/deep/.mask {
		z-index: 99;
	}
</style>
