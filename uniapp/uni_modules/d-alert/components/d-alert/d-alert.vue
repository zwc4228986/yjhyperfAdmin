<template>
	<view class="dAlert" v-show="show">
		<!--  -->
		<view class="wrapperAlert" @click="closeModal">
			<view class="wrapperAlertBox" @click.stop="" @touchmove.stop.prevent="">
				<!-- 第一版start==基础弹框 -->
				<!-- 第一版start==基础弹框 -->
				<!-- 第一版start==基础弹框 -->
				
				<!-- <view style="width: 100%;height: 50rpx;background-color: red;"></view>
				<view class="wrapperAlertBoxTitle" v-if="title">
					{{title}}
				</view>
				
				<view class="wrapperAlertBoxCenter">
					{{content}}
				</view>
				<view class="wrapperAlertBoxBit"></view>
				
				<view class="wrapperAlertBoxFooter">
					
					<view class="wrapperAlertBoxFooterBox"  v-if="showCancel" :style="cancelColor" @click.stop="clickBtn('cancel')">{{cancelText}}</view>
					<view class="wrapperAlertBoxFooterBit" v-if="showCancel"></view>
					<view class="wrapperAlertBoxFooterBox" :style="confirmColor" @click.stop="clickBtn('confirm')">{{confirmText}}</view>
				</view> -->
				<!-- 第一版end==基础弹框 -->
				<!-- 第一版end==基础弹框 -->
				<!-- 第一版end==基础弹框 -->
				
				
				
				
				
				<!-- 第二版start -->
				<!-- 第二版start -->
				<!-- 第二版start -->
				
				<view class="vueDAlertWrapper" style="border-radius: 20rpx;">
					<view style="width: 100%;height: 50rpx;"></view>
					<view class="vueDAlertWrapperTop" style="background: url('/static/icon_img/8001.png') no-repeat center center;background-size: 100% 100%;">
					<!-- 此图片为大礼包底图，建议放到oss上 -->
					<!-- <view class="vueDAlertWrapperTop" style="background: url('https://img.qq.vip/deng/8001.png') no-repeat center center;background-size: 100% 100%;"> -->
						<view style="width: 100%;height: 350rpx;"></view>
						<view class="vueDAlertWrapperTopPrice">
							<text class="text-price">
								{{price?price:'0'}}
							</text>
							<!-- <text class="vueDAlertWrapperTopPriceYuan">元</text> -->
						</view>
						
						<view class="vueDAlertWrapperTopPriceMsg">
							{{msg?msg:'限时专享红包'}}
						</view>
						
					</view>
					
					<view class="vueDAlertWrapperTime" v-if="time">
						{{time?time:''}}
					</view>
					<view style="width: 100%;height: 30rpx;" v-if="!time"></view>
					
					<view class="vueDAlertWrapperBtn" @click.stop="clickBtn('confirm')">
						立即领取
					</view>
					
					<view style="width: 100%;height: 60rpx;"></view>
					
					<view class="vueDAlertWrapperCha" @click.stop="clickBtn('cancel')">
						<image src="../../../../static/icon_img/delred.png" class="vueDAlertWrapperChaImg"></image>
					</view>
				</view>
				
				
				<!-- 第二版end -->
				<!-- 第二版end -->
				<!-- 第二版end -->
				
				
				
			</view>
		
		</view>
		<!--  -->
		<view class="maskHiddenmask" ></view>
		<!--  -->
	</view>
</template>


<!-- 更新时间：2022-06-11 19:00 -->
<!-- 最新插件地址： https://ext.dcloud.net.cn/publisher?id=117346 -->
<script>
	export default {
		computed: {
			show(){
				return this.$modalStore.state.show;
			},
			title(){
				return this.$modalStore.state.title;
			},
			price(){
				return this.$modalStore.state.price;
			},
			msg(){
				return this.$modalStore.state.msg;
			},
			time(){
				return this.$modalStore.state.time;
			},
			content(){
				return this.$modalStore.state.content;
			},
			showCancel(){
				return this.$modalStore.state.showCancel;
			},
			cancelText(){
				return this.$modalStore.state.cancelText;
			},
			cancelColor(){
				return "color:"+this.$modalStore.state.cancelColor;
			},
			confirmText(){
				return this.$modalStore.state.confirmText;
			},
			confirmColor(){
				return "color:"+this.$modalStore.state.confirmColor;
			}
		},
		props:{
		},
		data() {
			return {
			};
		},
		watch:{
			alertStatus(e){
				if (e==true) {
					this.alertStatus = true
				}
			}
		},
		methods:{
			closeModal(){
				this.$modalStore.commit('hideModal')
			},
			clickBtn(res){
				// console.log(this.$modalStore)
				// console.log(this.$modalStore.state)
				
				this.$modalStore.commit('success',res)
				this.$modalStore.commit('hideModal')
			},
			demo(){
				this.alertStatus = this.alertStatus==true?false:true
			}
		},
		beforeDestroy(){
			this.$modalStore.commit('hideModal')
		}
	}
</script>

<style lang="scss" scoped>
	.maskHiddenmask {
		z-index: 10000;
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #000;
		opacity: 0.9;
		transition: background-color .15s linear;
	}
	
	.wrapperAlert {
		z-index: 12000;
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		transition: background-color .15s linear;
		display: flex;
		align-items: center;
		justify-content: center;
		
		.wrapperAlertBox {
			width: 80%;
			// background-color: #fff;
			border-radius: 15rpx;
			// background-image: linear-gradient(-27deg,#fff,#762cd9);
			// background-image: linear-gradient(-27deg,#fff,pink);
			// background-image: linear-gradient(-27deg,#fff,pink);
			.wrapperAlertBoxTitle {
				width: 100%;
				height: 30rpx;
				display: flex;
				justify-content: center;
				align-items: center;
				color: #762cd9;
			}
			.wrapperAlertBoxCenter {
				width: 100%;
				height: 135rpx;
				display: flex;
				justify-content: center;
				align-items: center;
				color: #C0C0C0;
				color: red;
				
			}
			.wrapperAlertBoxBit {
				width: 100%;
				height: 1rpx;
				background-color: #f2f2f2;
			}
			
			.wrapperAlertBoxFooter {
				width: 100%;
				height: 100rpx;
				// background-color: red;
				display: flex;
				justify-content: space-around;
				align-items: center;
				.wrapperAlertBoxFooterBox {
					width: 290rpx;
					height: 115rpx;
					// background-color: #ccc;
					display: flex;
					justify-content: center;
					align-items: center;
				}
				.wrapperAlertBoxFooterBit {
					width:1rpx;
					height:40rpx;
					background:#f2f2f2;
				}
			}
			
		}
		
	
	
	}
</style>

<style lang="less">
	.vueDAlertWrapper {
		width: 100%;
		display: flex;
		flex-direction: column;
		align-items: center;
		
		.vueDAlertWrapperTop {
			width: 100%;
			// height: ;
			// position: relative;
			width: 602rpx;height: 708rpx;
			
			background-size: 602rpx 708rpx;
			// background-color: #fff;
			display: flex;
			flex-direction: column;
			align-items: center;
			
			.vueDAlertWrapperTopPrice {
				margin-top: 40rpx;
				display: flex;
				align-items: center;
				justify-content: center;
				
				width: 100%;
				height: 100rpx;
				font-size: 100rpx;
				font-family: MI LANTING;
				font-weight: 400;
				// line-height: 412rpx;
				// text-shadow: 0px 8rpx 0px rgba(167, 7, 46, 0.45);
				
				// background: linear-gradient(180deg, #FFFDC9 0%, #FFDB6D 100%);
				color: #FFFDC9;
				// -webkit-background-clip: text;
				// -webkit-text-fill-color: transparent;
				// backgrounsd-color: #FFDB6D;
				
				.vueDAlertWrapperTopPriceYuan {
					font-size: 30rpx;
					height: 30rpx;
				}
			}
			
			.vueDAlertWrapperTopPriceMsg {
				width: 100%;
				height: 50rpx;
				font-size: 29rpx;
				// font-family: MI LANTING;
				font-weight: 400;
				color: #FFFFFF;
				margin-top: 15rpx;
				// background-color: #000;
				
				display: flex;
				align-items: center;
				justify-content: center;
			}
		}
		
		.vueDAlertWrapperTime {
			width: 100%;
			height: 88rpx;
			font-size: 26rpx;
			font-family: MI LANTING;
			font-weight: 400;
			color: #FFFFFF;
			// background-color: red;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		
		.vueDAlertWrapperBtn {
			width: 436rpx;
			height: 80rpx;
			background: linear-gradient(180deg, #FFE8A6,  #FFE8A6, #FDC249);
			box-shadow: 0px 5px 24px 0px rgba(167, 7, 46, 0.45);
			border-radius: 40px;
			
			display: flex;
			align-items: center;
			justify-content: center;
			
			
			font-size: 38rpx;
			font-family: MI LANTING;
			font-weight: 500;
			color: #E9153E;
			
		}
		
		.vueDAlertWrapperCha {
			width: 150rpx;
			height: 56rpx;
			
			display: flex;
			align-items: center;
			justify-content: center;
			// background-color: #FDC249;
			
			.vueDAlertWrapperChaImg {
				width: 56rpx;
				height: 56rpx;
				background: #FFF;
				border-radius: 50%;
			}
		}
		
	}
</style>