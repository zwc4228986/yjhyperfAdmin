<template>
	<view :style="colorStyle">
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
	import tabBar from "@/pages/index/visualization/components/tabBar.vue"
	export default {
		computed: mapGetters(['isLogin', 'uid']),
		components: {
			goodsCate1,
			tabBar
		},
		mixins: [colors],
		data() {
			return {
				status: 0,
			}
		},
		onLoad() {
			this.classStyle();
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
			classStyle() {
				colorChange('category').then(res => {
					let status = res.data.status;
					this.category = status
					this.status = res.data.status
					if (status == 2) {
						if (this.isLogin) {
							this.$refs.classTwo.getCartNum();
							this.$refs.classTwo.getCartList(1);
						}
						this.$refs.classTwo.getAllCategory()
					}
					if (status == 3) {
						if (this.isLogin) {
							this.$refs.classThree.getCartNum();
							this.$refs.classThree.getCartList(1);
						}
						this.$refs.classThree.getAllCategory()
					}
					if (status == 2 || status == 3) {
						uni.hideTabBar()
					} else {
						if (!this.is_diy) {
							uni.hideTabBar()
						} else {}
						this.$refs.classOne.getNav();
					}
				})
			}
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
