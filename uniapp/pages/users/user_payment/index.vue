<template>
	<view>
		<form @submit="submitSub" :style="colorStyle">
			<view class="payment-top acea-row row-column row-center-wrapper">
				<span class="name">我的余额</span>
				<view class="pic">
					￥<span class="pic-font">{{ (userinfo.integral/10).toFixed(2)}}</span>
				</view>
			</view>
			<view class="payment order-submission ">
				<view class="nav acea-row row-around row-middle">
					<view class="item" :class="active==index?'on':''" v-for="(item,index) in navRecharge" :key="index" @click="navRecharges(index)">{{item}}</view>
				</view>
				<view class='tip picList' v-if='!active' >
					<view class="pic-box pic-box-color acea-row row-center-wrapper row-column" :class="activePic == index ? 'pic-box-color-active' : ''"
					 v-for="(item, index) in picList" :key="index" @click="picCharge(index, item)" v-if="item.price">
						<view class="pic-number-pic">
							{{ item.price }}<span class="pic-number"> 元</span>
						</view>
						<view class="pic-number">赠送：{{ item.give_money }} 元</view>
					</view>
					<view class="pic-box pic-box-color acea-row row-center-wrapper" :class="activePic == picList.length ? 'pic-box-color-active' : ''"
					 @click="picCharge(picList.length)">
						<input type="number" placeholder="其他" v-model="money" class="pic-box-money pic-number-pic" :class="activePic == picList.length ? 'pic-box-color-active' : ''" />
					</view>
					<view class="tips-box">
						<view class="tips mt-30">注意事项：</view>
						<view class="tips-samll" v-for="item in rechargeAttention" :key="item">
							{{ item }}
						</view>
					</view>

				</view>
				<view class="tip" v-else>
					<view class='input'><text>￥</text><input placeholder="0.00" type='number' placeholder-class='placeholder' :value="number" name="number"></input></view>
					<view class="tips-title">
						<view style="font-weight: bold; font-size: 26rpx;">提示：</view>
						<view style="margin-top: 10rpx;">当前可转入佣金为 <text class='font-color'>￥{{userinfo.commissionCount || 0}}</text>,冻结佣金为<text class='font-color'>￥{{userinfo.broken_commission}}</text></view>
					</view>
					<view class="tips-box">
						<view class="tips mt-30">注意事项：</view>
						<view class="tips-samll" v-for="item in rechargeAttention" :key="item">
							{{ item }}
						</view>
					</view>
				</view>
				<view class='wrapper'>
					<view class='item'>
						<view>支付方式</view>
						<view class='list'>
							<view class='payItem acea-row row-middle' :class='pay_active==index ?"on":""' @tap='payItem(index)' v-for="(item,index) in payMode"
							 :key='index' v-if="item.payStatus==1">
								<view class='name acea-row'>
									<view class='iconfont animated' :class='(item.icon) + " " + (animated==true&&pay_active==index ?"bounceIn":"")'></view>{{item.name}}
								</view>
								<view class='tip'>{{item.title}} <span v-if="item.value == 'yue'">{{item.number}}</span> </view>
							</view>
						</view>
					</view>
				</view> 
				<button class='but bg-color' formType="submit"> {{active ? '立即转入': '立即充值' }}</button>
			</view>
		</form>
	<!-- 	<payment :payMode="payMode" :pay_close="pay_close" :is-call="true" @onChangeFun="onChangeFun"
			:order_id="pay_order_id" :totalPrice="totalPrice"></payment> -->
		<!-- #ifdef MP -->
		<!-- <authorize @onLoadFun="onLoadFun" :isAuto="isAuto" :isShowAuth="isShowAuth" @authColse="authColse"></authorize> -->
		<!-- #endif -->
		<!-- #ifndef MP -->
		<home></home>
		<!-- #endif -->
	</view>
</template>

<script>
	import payment from '@/components/payment';
	import {
		getUserInfo,
		rechargeRoutine,
		rechargeWechat,
		getRechargeApi
	} from '@/api/user.js';
	import {
		toLogin
	} from '@/libs/login.js';
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
			home,
			payment
		},
		mixins:[colors],
		data() {
			let that = this;
			return {
				
				totalPrice:0,
				pay_close: false,
				payMode: [{
						name: '微信支付',
						icon: 'icon-weixinzhifu',
						value: 'weixin',
						title: '微信快捷支付',
						payStatus: true
					},
					{
						name: '支付宝支付',
						icon: 'icon-zhifubao',
						value: 'alipay',
						title: '支付宝支付',
						payStatus: true
					}
				],
				now_money: 0,
				navRecharge: ['账户充值'],
				active: 0,
				number: '',
				userinfo: {
					integral:0,
				},
				pay_order_id: '',
				placeholder: "0.00",
				from: '',
				isAuto: false, //没有授权的不会自动授权
				isShowAuth: false, //是否隐藏授权
				picList: [],
				activePic: 0,
				payType:"weixin",
				pay_active:0,
				money: "",
				numberPic:'',
				rechar_id:0,
				rechargeAttention:[]
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
				this.getRecharge();
			} else {
				toLogin();
			}
		},
		methods: {
			payItem: function(e) {
				let that = this;
				let pay_active = e;
				that.pay_active = pay_active;
				that.animated = true;
				that.payType = that.payMode[pay_active].value;
				// that.computedPrice();
				// setTimeout(function() {
				// 	that.car();
				// }, 500);
			},
			onChangeFun: function(e) {
				let opt = e;
				let action = opt.action || null;
				let value = opt.value != undefined ? opt.value : null;
				this.pay_close = false
				console.log(action);
				action && this[action] && this[action](value);
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
				getUserInfo().then(res => {
					that.$set(that, 'userinfo', res.data);
				})
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
											url: '/pages/users/user_integral/index'
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
						payType:that.payType,
						price: money,
						type: 0,
						rechar_id: this.rechar_id
					}).then(res => {
						uni.hideLoading();
						let jsConfig = res.data.data;
						if(that.payType == 'alipay'){
						uni.requestPayment({
							provider: 'alipay',
							orderInfo: jsConfig,
								success: function(res) {
									that.$set(that, 'userinfo.now_money', that.$util.$h.Add(value, that.userinfo.now_money));
									return that.$util.Tips({
										title: '支付成功',
										icon: 'success'
									}, {
										tab: 5,
										url: '/pages/users/user_integral/index'
									});
								},
								fail: function(e) {
									console.log(e);
									return that.$util.Tips({
										title: '支付失败'
									});
								},
							complete: () => {
								uni.hideLoading();
							},
						});
						}else{
						
						console.log(jsConfig)
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
									url: '/pages/users/user_integral/index'
								});
							},
							fail: function(e) {
								console.log(e);
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
							}
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
	.order-submission .wrapper {
		background-color: #fff;
	}
	
	.order-submission .wrapper .item {
		padding: 27rpx 30rpx;
		font-size: 30rpx;
		color: #282828;
	}
	
	.order-submission .wrapper .item .discount {
		font-size: 30rpx;
		color: #999;
	}
	
	.order-submission .wrapper .item .discount input {
		text-align: end;
	}
	
	.order-submission .wrapper .item .discount .iconfont {
		color: #515151;
		font-size: 30rpx;
		margin-left: 15rpx;
	}
	
	.order-submission .wrapper .item .discount .num {
		font-size: 32rpx;
		margin-right: 20rpx;
	}
	
	.order-submission .wrapper .item .shipping {
		font-size: 30rpx;
		color: #999;
		position: relative;
		padding-right: 58rpx;
	}
	
	.order-submission .wrapper .item .shipping .iconfont {
		font-size: 35rpx;
		color: #707070;
		position: absolute;
		right: 0;
		top: 50%;
		transform: translateY(-50%);
		margin-left: 30rpx;
	}
	
	.order-submission .wrapper .item textarea {
		background-color: #f9f9f9;
		width: 690rpx;
		height: 140rpx;
		border-radius: 3rpx;
		margin-top: 30rpx;
		padding: 25rpx 28rpx;
		box-sizing: border-box;
	}
	
	.order-submission .wrapper .item .placeholder {
		color: #ccc;
	}
	
	.order-submission .wrapper .item .list {
		margin-top: 35rpx;
	}
	
	.order-submission .wrapper .item .list .payItem {
		border: 1px solid #eee;
		border-radius: 6rpx;
		height: 86rpx;
		width: 100%;
		box-sizing: border-box;
		margin-top: 20rpx;
		font-size: 28rpx;
		color: #282828;
	}
	
	.order-submission .wrapper .item .list .payItem.on {
		border-color: #fc5445;
		color: #e93323;
	}
	
	.order-submission .wrapper .item .list .payItem .name {
		width: 50%;
		text-align: center;
		border-right: 1px solid #eee;
		padding-left: 80rpx;
	}
	
	.order-submission .wrapper .item .list .payItem .name .iconfont {
		width: 44rpx;
		height: 44rpx;
		border-radius: 50%;
		text-align: center;
		line-height: 44rpx;
		background-color: #fe960f;
		color: #fff;
		font-size: 30rpx;
		margin-right: 15rpx;
	}
	
	.order-submission .wrapper .item .list .payItem .name .iconfont.icon-weixin2 {
		background-color: #41b035;
	}
	
	.order-submission .wrapper .item .list .payItem .name .iconfont.icon-zhifubao {
		background-color: #1677FF;
	}
	
	.order-submission .wrapper .item .list .payItem .tip {
		width: 49%;
		text-align: center;
		font-size: 26rpx;
		color: #aaa;
	}
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
		top: -60rpx;
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
		align-items: center;
		justify-content: center;
		border-bottom: 1px dashed #dddddd;
		margin: 60rpx auto 0 auto;
		padding-bottom: 20rpx;
		font-size: 56rpx;
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
		height: 350rpx;
		background-color: var(--view-theme);

		.name {
			font-size: 26rpx;
			color: rgba(255, 255, 255, 0.8);
			margin-top: -38rpx;
			margin-bottom: 30rpx;
		}

		.pic {
			font-size: 32rpx;
			color: #fff;
		}

		.pic-font {
			font-size: 78rpx;
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
			font-size: 22rpx;
		}

		.pic-number-pic {
			font-size: 38rpx;
			margin-right: 10rpx;
			text-align: center;
		}

		.pic-box-color-active {
			background-color: var(--view-theme) !important;
			color: #fff !important;
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
		  color: #333333;
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
