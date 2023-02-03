<template>
	<view>
		<form @submit="goPay" :style="colorStyle">
			<view class="payment-top acea-row row-column" style="justify-content: center;padding-left: 20rpx;" >
				<span class="name">剩余置顶次数</span>
				<view class="pic">
					<span class="pic-font">{{ userinfo.top_num || 0 }}</span>
				</view>
			</view>
			<view class="payment">
			<!-- 	<view class="nav acea-row row-around row-middle">
					<view class="item" :class="active==index?'on':''" v-for="(item,index) in navRecharge" :key="index" @click="navRecharges(index)">{{item}}</view>
				</view> -->
				<view class='tip picList' >
					<view class="pic-box pic-box-color acea-row row-center-wrapper row-column" :class="activePic == index ? 'pic-box-color-active' : ''"
					 v-for="(item, index) in picList" :key="index" @click="picCharge(index, item)" v-if="item.price">
						<view class="pic-number">{{ item.num }}次</view>
						<view class="pic-number-pic">
							{{ item.price }}<span class="pic-number"> 元</span>
						</view>
						<view class="mc">{{(item.price/item.num).toFixed(2)}}元/次</view>
					</view>
					<button class='but bg-color' formType="submit">立即购买</button>
					<view class="tips-box">
						<view class="tips mt-30">置顶规则说明：</view>
						<view v-html="task_top_desc">
						</view>
						<!-- <view class="tips-samll" v-for="item in rechargeAttention" :key="item">
							{{ item }}
						</view> -->
					</view>
				</view>
			
				
			</view>
		</form>
		<!-- #ifdef MP -->
		<!-- <authorize @onLoadFun="onLoadFun" :isAuto="isAuto" :isShowAuth="isShowAuth" @authColse="authColse"></authorize> -->
		<!-- #endif -->
		<!-- #ifndef MP -->
		<home></home>
		<!-- #endif -->
	</view>
</template>

<script>
	// import {
	// 	getUserInfo,
	// 	rechargeRoutine,
	// 	rechargeWechat,
	// 	getRechargeApi
	// } from '@/api/user.js';
	import {taskerPayTop} from '@/api/tasker.js'
	import {
		userInfo
	} from '@/api/user2.js';
	import {
		getSettlesTaskTop
	} from '@/api/task/settles.js'
	import {
		toLogin
	} from '@/libs/login.js';
	import { getConfig } from '@/api/config';
	import {
		mapGetters
	} from "vuex";
	// #ifdef MP
	import authorize from '@/components/Authorize';
	// #endif
	import home from '@/components/home';
	import colors from "@/mixins/color";
	export default {
		components: {
			// #ifdef MP
			authorize,
			// #endif
			home
		},
		mixins:[colors],
		data() {
			let that = this;
			return {
				task_top_desc:"",
				payType:'weixin',
				now_money: 0,
				navRecharge: ['账户充值', '佣金转入'],
				active: 0,
				number: '',
				userinfo: {
					refresh_num:0,
				},
				placeholder: "0.00",
				from: '',
				isAuto: false, //没有授权的不会自动授权
				isShowAuth: false, //是否隐藏授权
				picList: [],
				activePic: 0,
				money: "",
				numberPic:'',
				rechar_id:0,
				rechargeAttention:[
					'1.使用置顶后，任务将在首页列表和任务大厅优先展示。排 序为后来居上：任务置顶后排在第一位，后面有人置顶，会 被挤到第二位、后面再有人置顶，会到第三位、第四位.... 如此循环',
					'2.单次置顶有效期为24小时，过了置顶有效期任务排序恢复 正常',
				]
			};
		},
		computed: mapGetters(['isLogin']),
		watch:{
			isLogin:{
				handler:function(newV,oldV){
					if(newV){
						this.getUserInfo();
						this.getRecharge();
					}
				},
				deep:true
			}
		},
		onLoad(options) {
			// #ifdef H5
			this.from = this.$wechat.isWeixin() ? "weixin" : "weixinh5"
			// #endif
			if (this.isLogin) {
				this.getUserInfo();
				this.getSettlesTaskRefresh();
			} else {
				toLogin();
			}
			getConfig(["task_top_desc"]).then((res)=>{
				this.task_top_desc = res.task_top_desc
			})
		},
		methods: {
			getSettlesTaskRefresh(){
				getSettlesTaskTop().then(res=>{
					this.picList = res;
					this.rechar_id = res[0].id;
				})
			},
			/**
			 * 选择金额
			 */
			picCharge(idx, item) {
				this.activePic = idx;
				if (item === undefined) {
					this.rechar_id = 0;
					this.numberPic = "";
				} else {
					this.money = "";
					this.rechar_id = item.id;
					this.numberPic = item.price;
				}
			},

			/**
			 * 充值额度选择
			 */
			getRecharge() {
				getRechargeApi()
					.then(res => {
						this.picList = res.data.recharge_quota;
						if (this.picList[0]) {
							this.rechar_id = this.picList[0].id;
							this.numberPic = this.picList[0].price;
						}
						this.rechargeAttention = res.data.recharge_attention || [];
					})
					.catch(res => {
						this.$util.Tips({
							title: res
						})
					});
			},


			onLoadFun: function() {
				this.getUserInfo();
				this.getRecharge();
			},
			// 授权关闭
			authColse: function(e) {
				this.isShowAuth = e
			},
			navRecharges: function(index) {
				this.active = index;
			},
			/**
			 * 获取用户信息
			 */
			getUserInfo: function() {
				let that = this;
				userInfo().then(res => {
					that.$set(that, 'userinfo', res);
				})
			},
			goPay() {
				let paytype = this.payType;
				taskerPayTop({
					top_id:this.rechar_id,
					paytype: this.payType,
					// #ifdef MP 
					'from': 'routine',
					// #endif
					// #ifdef H5
					'from': this.$wechat.isWeixin() ? 'weixin' : 'weixinh5',
					// #endif
					// #ifdef H5
					quitUrl: location.port ? location.protocol + '//' + location.hostname + ':' + location
						.port +
						'/pages/users/order_details/index?order_id=' + this.order_id : location.protocol +
						'//' + location.hostname +
						'/pages/users/order_details/index?order_id=' + this.order_id
					// #endif
					// #ifdef APP-PLUS
					quitUrl: '/pages/users/order_details/index?order_id=' + this.order_id
					// #endif
				}).then(res => {
					let jsConfig = res;
					let that = this;
					console.log(jsConfig)
					switch (paytype) {
						case 'weixin':
							// #ifdef MP
							uni.requestPayment({
								timeStamp: jsConfig.timeStamp,
								nonceStr: jsConfig.nonceStr,
								package: jsConfig.package,
								signType: jsConfig.signType,
								paySign: jsConfig.paySign,
								success: function(res) {
									uni.hideLoading();
									that.getUserInfo();
								},
								fail: function(e) {
									uni.hideLoading();
									return that.$util.Tips({
										title: '取消支付'
									}, () => {
										that.$emit('onChangeFun', {
											action: 'pay_fail'
										});
									});
								},
								complete: function(e) {
									console.log(e);
									uni.hideLoading();
									if (e.errMsg == 'requestPayment:cancel') return that.$util
										.Tips({
											title: '取消支付'
										}, () => {
											that.$emit('onChangeFun', {
												action: 'pay_fail'
											});
										});
								},
							});
							// #endif
							// #ifdef H5
							let data = res.data;
							if (data.status == "WECHAT_H5_PAY") {
								uni.hideLoading();
								location.replace(data.result.jsConfig.mweb_url);
								return that.$util.Tips({
									title: "支付成功",
									icon: 'success'
								}, () => {
									that.$emit('onChangeFun', {
										action: 'pay_complete'
									});
								});
							} else {
								that.$wechat.pay(data.result.jsConfig)
									.then(() => {
										return that.$util.Tips({
											title: "支付成功",
											icon: 'success'
										}, () => {
											that.$emit('onChangeFun', {
												action: 'pay_complete'
											});
										});
									})
									.catch(()=> {
										return that.$util.Tips({
											title: '支付失败'
										}, () => {
											that.$emit('onChangeFun', {
												action: 'pay_fail'
											});
										});
									});
							}
							// #endif
							// #ifdef APP-PLUS
							uni.requestPayment({
								provider: 'wxpay',
								orderInfo: jsConfig,
								success: (e) => {
									let url = '/pages/order_pay_status/index?order_id=' + orderId +
										'&msg=支付成功';
									uni.showToast({
										title: "支付成功"
									})
									setTimeout(res => {
										that.$emit('onChangeFun', {
											action: 'pay_complete'
										});
									}, 2000)
								},
								fail: (e) => {
									uni.showModal({
										content: "支付失败",
										showCancel: false,
										success: function(res) {
											if (res.confirm) {
												that.$emit('onChangeFun', {
													action: 'pay_fail'
												});
											} else if (res.cancel) {}
										}
									})
								},
								complete: () => {
									uni.hideLoading();
								},
							});
							// #endif
							break;
						case 'yue':
							uni.hideLoading();
							return that.$util.Tips({
								title: res.msg,
								icon: 'success'
							}, () => {
								that.$emit('onChangeFun', {
									action: 'pay_complete'
								});
							});
							break;
						case 'offline':
							uni.hideLoading();
							return that.$util.Tips({
								title: res.msg,
								icon: 'success'
							}, () => {
								that.$emit('onChangeFun', {
									action: 'pay_complete'
								});
							});
							break;
						case 'friend':
							uni.hideLoading();
							return that.$util.Tips({
								title: res.msg,
								icon: 'success'
							}, () => {
								that.$emit('onChangeFun', {
									action: 'pay_complete'
								});
							});
							break;
						case 'alipay':
							uni.hideLoading();
							//#ifdef H5
							if (this.$wechat.isWeixin()) {
								uni.redirectTo({
									url: `/pages/users/alipay_invoke/index?id=${res.data.result.order_id}&pay_key=${res.data.result.pay_key}`
								});
							} else {
								uni.hideLoading();
								that.formContent = res.data.result.jsConfig;
								that.$nextTick(() => {
									document.getElementById('alipaysubmit').submit();
								});
							}
							//#endif
							// #ifdef MP
							uni.navigateTo({
								url: `/pages/users/alipay_invoke/index?id=${res.data.result.order_id}&link=${res.data.result.jsConfig.qrCode}`
							});
							// #endif
							// #ifdef APP-PLUS
							uni.requestPayment({
								provider: 'alipay',
								orderInfo: jsConfig,
								success: (e) => {
									uni.showToast({
										title: "支付成功"
									})
									setTimeout(res => {
										that.$emit('onChangeFun', {
											action: 'pay_complete'
										});
									}, 2000)
				
								},
								fail: (e) => {
									uni.showModal({
										content: "支付失败",
										showCancel: false,
										success: function(res) {
											if (res.confirm) {
												that.$emit('onChangeFun', {
													action: 'pay_fail'
												});
											} else if (res.cancel) {}
										}
									})
								},
								complete: () => {
									uni.hideLoading();
								},
							});
							// #endif
							break;
					}
				}).catch(err => {
					uni.hideLoading();
					return this.$util.Tips({
						title: err
					}, () => {
						that.$emit('onChangeFun', {
							action: 'pay_fail'
						});
					});
				})
				// this.pay_close = true;
			},
			/*
			 * 用户充值
			 */
			submitSub: function(e) {
				let that = this
				let value = e.detail.value.number;
				// 转入余额
				if (that.active) {
					if (parseFloat(value) < 0 || parseFloat(value) == NaN || value == undefined || value == "") {
						return that.$util.Tips({
							title: '请输入金额'
						});
					}
					uni.showModal({
						title: '转入余额',
						content: '转入余额后无法再次转出，确认是否转入余额',
						success(res) {
							if (res.confirm) {
								// #ifdef MP || APP-PLUS
								rechargeRoutine({
									price: parseFloat(value),
									type: 1
								})
								// #endif
								// #ifdef H5
								rechargeWechat({
										price: parseFloat(value),
										from: that.from,
										type: 1
									})
									
									// #endif
									.then(res => {
										// that.$set(that, 'userinfo.now_money', that.$util.$h.Add(value, that.userinfo.now_money))
										return that.$util.Tips({
											title: '转入成功',
											icon: 'success'
										}, {
											tab: 5,
											url: '/pages/users/user_money/index'
										});
									}).catch(err => {
										return that.$util.Tips({
											title: err
										})
									});
							} else if (res.cancel) {
								return that.$util.Tips({
									title: '已取消'
								});
							}
						},
					})
				} else {
					uni.showLoading({
						title: '正在支付',
					})
					// #ifdef MP || APP-PLUS
					let money = parseFloat(this.money);
					if( this.rechar_id == 0){
						if(Number.isNaN(money)){
							return that.$util.Tips({title: '充值金额必须为数字'});
						}
						if(money <= 0){
							return that.$util.Tips({title: '充值金额不能为0'});
						}
					}else{
						money = this.numberPic
					}
					
					rechargeRoutine({
						price: money,
						type: 0,
						rechar_id: this.rechar_id
					}).then(res => {
						uni.hideLoading();
						let jsConfig = res.data;
						uni.requestPayment({
							// #ifdef MP
							timeStamp: jsConfig.timestamp,
							nonceStr: jsConfig.nonceStr,
							package: jsConfig.package,
							signType: jsConfig.signType,
							paySign: jsConfig.paySign,
							// #endif
							// #ifdef APP-PLUS
							provider: 'wxpay',
							orderInfo: jsConfig,
							// #endif
							success: function(res) {
								that.$set(that, 'userinfo.now_money', that.$util.$h.Add(value, that.userinfo.now_money));
								return that.$util.Tips({
									title: '支付成功',
									icon: 'success'
								}, {
									tab: 5,
									url: '/pages/users/user_money/index'
								});
							},
							fail: function() {
								return that.$util.Tips({
									title: '支付失败'
								});
							},
							complete: function(res) {
								if (res.errMsg == 'requestPayment:cancel') return that.$util.Tips({
									title: '取消支付'
								});
							}
						})
					}).catch(err => {
						uni.hideLoading();
						return that.$util.Tips({
							title: err
						})
					});
					// #endif
					// #ifdef H5 
					rechargeWechat({
						price: that.rechar_id == 0 ? that.money : that.numberPic,
						from: that.from,
						rechar_id: that.rechar_id
					}).then(res => {
						let data = res.data;
						if (data.type == "weixinh5") {
							location.replace(data.data.mweb_url);
							return that.$util.Tips({
								title: '支付成功',
								icon: 'success'
							}, {
								tab: 5,
								url: '/pages/users/user_money/index'
							});
						} else {
							that.$wechat.pay(data.data)
								.finally(() => {
									that.$set(that, 'userinfo.now_money', that.$util.$h.Add(value, that.userinfo.now_money));
									return that.$util.Tips({
										title: '支付成功',
										icon: 'success'
									}, {
										tab: 5,
										url: '/pages/users/user_money/index'
									});
								})
								.catch(function() {
									return that.$util.Tips({
										title: '支付失败'
									});
								});
						}
					}).catch(err=>{
						uni.hideLoading();
						return that.$util.Tips({
							title: err
						})
					})
					// #endif
				}
			}
		}
	}
</script>

<style lang="scss">
	page {
		width: 100%;
		height: 100%;
		background-color: #fff;
	}
	.bgcolor{
		background-color: var(--view-theme)
	}
	.payment {
		position: relative;
		top: -40rpx;
		width: 100%;
		background-color: #fff;
		border-radius: 10rpx;
		padding-top: 25rpx;
		border-top-right-radius: 39rpx;
		border-top-left-radius: 39rpx;
	}

	.payment .nav {
		height: 75rpx;
		line-height: 75rpx;
		padding: 0 100rpx;
	}

	.payment .nav .item {
		font-size: 30rpx;
		color: #333;
	}

	.payment .nav .item.on {
		font-weight: bold;
		border-bottom: 4rpx solid var(--view-theme);
	}

	.payment .input {
		display: flex;
		justify-content: center;
		border-bottom: 1px dashed #dddddd;
		margin: 60rpx auto 0 auto;
		padding-bottom: 40rpx;
		font-size: 50rpx;
		color: #333333;
		flex-wrap: nowrap;
		
	}

	.payment .input text {
		padding-left: 106rpx;
	}

	.payment .input input {
		padding-right: 106rpx;
		width: 300rpx;
		height: 94rpx;
		text-align: center;
		font-size: 70rpx;
	}

	.payment .placeholder {
		color: #d0d0d0;
		height: 100%;
		line-height: 94rpx;
	}

	.payment .tip {
		font-size: 26rpx;
		color: #888888;
		padding: 0 30rpx;
		margin-top: 25rpx;
	}

	.payment .but {
		color: #fff;
		font-size: 30rpx;
		width: 700rpx;
		height: 86rpx;
		border-radius: 50rpx;
		margin: 46rpx auto 0 auto;
		line-height: 86rpx;
	}

	.payment-top {
		width: 100%;
		height: 250rpx;
		background-color: var(--view-theme);
		.name {
			font-size: 14px;
			color: rgba(255, 255, 255, 0.8);
			margin-top: -38rpx;
			margin-bottom: 20rpx;
		}
		
		.pic {
			font-size: 32rpx;
			color: #fff;
		}

		.pic-font {
			font-size: 30px;
			color: #fff;
		}
	}

	.picList {
		display: flex;
		flex-wrap: wrap;
		margin: 30rpx 0;

		.pic-box {
			width: 32%;
			height: auto;
			border-radius: 20rpx;
			margin-top: 21rpx;
			padding: 20rpx 0;
			margin-right: 12rpx;

			&:nth-child(3n) {
				margin-right: 0;
			}
		}

		.pic-box-color {
			background-color: #f4f4f4;
			color: #656565;
		}

		.pic-number {
			font-size: 26rpx;
		}

		.pic-number-pic {
			font-size: 32rpx;
			margin-right: 10rpx;
			font-weight: bold;
			padding: 10rpx 0;
			text-align: center;
		}

		.pic-box-color-active {
			background-color: #FFF5E7 !important;
			color: #F58325 !important;
			
			overflow: hidden;
			
		}
		.mc{
			border-radius: 20rpx;
			padding:5rpx 25rpx;
			color: #000;
			
		}
		.pic-box-color-active{
			.mc{
				background-color: var(--view-theme) !important;
				color: white !important;
			}
		}
	}
	.tips-box{
		.tips {
		  font-size: 28rpx;
		  color: #333333;
		  font-weight: 800;
		  margin-bottom: 14rpx;
			margin-top: 20rpx;
		}
		.tips-samll {
		  font-size: 24rpx;
		  color: #666666;
		  margin-bottom: 14rpx;
		}
		.tip-box {
		  margin-top: 30rpx;
		}
	}
	.tips-title{
		margin-top: 20rpx;
		font-size: 24rpx;
		color: #333;
	}
</style>
