<template>
	<view class="wrap">
		
			<form @submit="formSubmit">
				<view class='personal-data'>
					<!-- <view class="wrapper">
						<view class="title">管理我的账号</view>
						<view class="wrapList">
							<view class="item acea-row row-between-wrapper" :class="item.uid === userInfo.uid ? 'on' : ''" v-for="(item,index) in switchUserInfo"
							 :key="index" @click='switchAccounts(index)'>
								<view class="picTxt acea-row row-between-wrapper">
									<view class="pictrue" @click.stop='uploadpic' v-if='item.uid === userInfo.uid'>
										<image :src='item.avatar'></image>
										<image src='../../../static/images/alter.png' class="alter"></image>
									</view>
									<view class="pictrue" v-else>
										<image :src='item.avatar'></image>
									</view>
									<view class="text">
										<view class="name line1">{{ item.nickname }}</view>
										<view class="phone" v-if="item.phone && item.user_type !='h5'">绑定手机号：{{ item.phone }}</view>
										<view class="phone" v-else-if="item.phone && item.user_type =='h5'">账号：{{ item.phone }}</view>
										<view class="phone" v-else>暂未绑定手机号</view>
									</view>
								</view>
								<view class="currentBnt acea-row row-center-wrapper font-color" v-if='item.uid === userInfo.uid'>
									当前账号
								</view>
								<view class="bnt font-color acea-row row-center-wrapper" v-else>
									使用账号
								</view>
							</view>
						</view>
					</view> -->
					<view class="list-box">
						<view class='avatar-box'>
							<text class="avatar-text">头像</text>
							<view class="avatar-content">
								<view class="avatar-img" @click.stop='uploadpic'>
									<image :src="userInfo.avatar"></image>
								</view>
								<view class="avatar-tip">点击添加或更改头像</view>
							</view>
						</view>
						
						<view class='list'>
							<!-- 	<view class='item acea-row row-between-wrapper'>
								<view>头像</view>
								<view class="avatar-box" @click.stop='uploadpic'>
									<image :src="userInfo.avatar"></image>
								</view>
							</view> -->
							<text class="list-title">基本资料</text>
							<view class="item acea-row row-between-wrapper">
								<view>昵称</view>
								<view class='input'><input type='text' name='nickname' :value='userInfo.nickname'></input>
								</view>
							</view>
							<view class="item acea-row row-between-wrapper">
								<view>手机号码</view>
								<navigator url="/pages/users/user_phone/index" hover-class="none"
									class="input acea-row row-between-wrapper" v-if="!userInfo.phone">
									<view>点击绑定手机号</view>
									
								</navigator>
								<view class='input acea-row row-between-wrapper' v-else>
									<input type='text' disabled='true' name='phone' :value='userInfo.phone'
										class='id'></input>
								</view>
								<text v-if="!userInfo.phone" class="iconfont icon-xiangyou"></text>
								<text  v-else class='iconfont icon-suozi'></text>
							</view>
							<view class="item acea-row row-between-wrapper" @click="gotoBindUp">
								<view>绑定上级</view>
								<navigator url="/pages/users/user_bindUp/index" hover-class="none"
									class="input acea-row row-between-wrapper">
									<view>点击绑定</view>
									<text class="iconfont icon-xiangyou"></text>
								</navigator>
							</view>
							<view class="item acea-row row-between-wrapper">
								<view>ID号</view>
								<view class='input acea-row row-between-wrapper'>
									<input type='text' :value='userInfo.uid' disabled='true' class='id'></input>
									<text class='iconfont icon-suozi'></text>
								</view>
							</view>
							<!-- #ifdef MP -->
							<view class='item acea-row row-between-wrapper'>
								<view>权限设置</view>
								<view class="input acea-row row-between-wrapper" @click="Setting">
									<view>点击管理</view>
									<text class="iconfont icon-xiangyou"></text>
								</view>
							</view>
							<!-- #endif -->
							<!-- #ifdef H5 -->
							<view class="item acea-row row-between-wrapper"
								v-if="userInfo.phone && !this.$wechat.isWeixin()">
								<view>密码</view>
								<navigator url="/pages/users/user_pwd_edit/index" hover-class="none" class="input">
									点击修改密码<text style="float: right;" class="iconfont icon-xiangyou"></text>
								</navigator>
							</view>
							<!-- #endif -->
							<view class="item acea-row row-between-wrapper" v-if="userInfo.phone">
								<view>更换手机号码</view>
								<navigator url="/pages/users/user_phone/index?type=1" hover-class="none" class="input">
									点击更换手机号码<text style="float: right;" class="iconfont icon-xiangyou"></text>
								</navigator>
							</view>
							<!-- #ifdef APP-PLUS -->
							<view class="item acea-row row-between-wrapper" v-if="userInfo.phone">
								<view>密码</view>
								<navigator url="/pages/users/user_pwd_edit/index" hover-class="none" class="input">
									点击修改密码<text style="float: right;" class="iconfont icon-xiangyou"></text>
								</navigator>
							</view>
							<view class="item acea-row row-between-wrapper" @click="initData">
								<view>缓存大小</view>
								<view class="input">
									{{fileSizeString}}<text class="iconfont icon-xiangyou"></text>
								</view>
							</view>
							<view class="item acea-row row-between-wrapper" @click="updateApp">
								<view>当前版本</view>
								<view class="input">
									{{version}}<text class="iconfont icon-xiangyou"></text>
								</view>
							</view>
							<!-- #endif -->
							<view class="item acea-row row-between-wrapper">
								<view>地址管理</view>
								<navigator url="/pages/users/user_address_list/index" hover-class="none"
									class="input acea-row row-between-wrapper">
									<view>点击前往</view>
									<text class="iconfont icon-xiangyou"></text>
								</navigator>
							</view>
						</view>
		
						<view class="list-down">
							<view class='item acea-row row-between-wrapper'>
								<view>姓名</view>
								<view class='input acea-row row-between-wrapper'>
									<input placeholder="请填写姓名" type='text' name='nickname'
										:value='userInfo.nickname'></input>
									<text class="iconfont icon-xiangyou"></text>
								</view>
							</view>
							<view class='item acea-row row-between-wrapper'>
								<view>性别</view>
								<view class='input acea-row row-between-wrapper'>
									<view style="display: flex;">
										<!-- <input type="radio" name='sex' value='男' checked="checked"></input>
										<input type="radio" name='sex' value='女'></input> -->
										<radio-group :value='userInfo.sex'>
											<radio value="0"  checked="checked" style="margin-right: 38rpx;">男</radio>
											<radio value="1">女</radio>
										</radio-group>
									</view>
									<text class="iconfont icon-xiangyou"></text>
								</view>
							</view>
						<!-- 	<view class='item acea-row row-between-wrapper'>
								<view>出生日月</view>
								<view class='input acea-row row-between-wrapper'><input type='text' name='nickname'
										:value='userInfo.nickname'></input>
									<text class="iconfont icon-xiangyou"></text>
								</view>
							</view> -->
						</view>
		
		
					</view>
		
					<view class="bottom-btn-group">
						<button class='modifyBtn bg-color' formType="submit">保&nbsp;&nbsp;存</button>
						<button class='logoutBtn'  @click="outLogin" formType="submit">退出登录</button>
					</view>
					
					<!-- #ifdef APP-PLUS -->
					<app-update ref="appUpdate" :force="true" :tabbar="false" :getVer='true' @isNew="isNew"></app-update>
					<!-- #endif -->
				</view>
			</form>
			<!-- #ifdef MP -->
			<!-- <authorize @onLoadFun="onLoadFun" :isAuto="isAuto" :isShowAuth="isShowAuth" @authColse="authColse"></authorize> -->
			<!-- #endif -->
			<canvas canvas-id="canvas" v-if="canvasStatus"
				:style="{width: canvasWidth + 'px', height: canvasHeight + 'px',position: 'absolute',left:'-100000px',top:'-100000px'}"></canvas>
		
	</view>
</template>

<script>
	import {
		getUserInfo,
		userEdit,
		getLogout
	} from '@/api/user.js';
	import {
		switchH5Login
	} from '@/api/api.js';
	import {
		toLogin
	} from '@/libs/login.js';
	import {
		mapGetters
	} from "vuex";
	import dayjs from "@/plugin/dayjs/dayjs.min.js";
	// #ifdef MP
	import authorize from '@/components/Authorize';
	// #endif
	import colors from '@/mixins/color.js';
import { login } from '../../../api/public';
	export default {
		components: {
			// #ifdef MP
			authorize
			// #endif
		},
		mixins: [colors],
		data() {
			return {
				userInfo: {},
				loginType: 'h5', //app.globalData.loginType
				userIndex: 0,
				switchUserInfo: [],
				isAuto: false, //没有授权的不会自动授权
				isShowAuth: false, //是否隐藏授权
				canvasWidth: "",
				canvasHeight: "",
				canvasStatus: false,
				fileSizeString: '',
				version: ''
			};
		},
		computed: mapGetters(['isLogin']),
		watch: {
			isLogin: {
				handler: function(newV, oldV) {
					if (newV) {
						this.getUserInfo();
					}
				},
				deep: true
			}
		},
		onLoad() {
			if (this.isLogin) {
				this.getUserInfo();
				// #ifdef APP-PLUS
				this.formatSize()
				// 获取版本号
				plus.runtime.getProperty(plus.runtime.appid, (inf) => {
					console.log(inf.version)
					this.version = inf.version;
				});
				// #endif 
			} else {
				toLogin();
			}
		},
		methods: {
			isNew() {
				this.$util.Tips({
					title: '当前为最新版本'
				});
			},

			updateApp() {
				this.$refs.appUpdate.update(); //调用子组件 检查更新
			},
			formatSize() {
				let that = this;
				plus.cache.calculate(function(size) {
					let sizeCache = parseInt(size);
					if (sizeCache == 0) {
						that.fileSizeString = "0B";
					} else if (sizeCache < 1024) {
						that.fileSizeString = sizeCache + "B";
					} else if (sizeCache < 1048576) {
						that.fileSizeString = (sizeCache / 1024).toFixed(2) + "KB";
					} else if (sizeCache < 1073741824) {
						that.fileSizeString = (sizeCache / 1048576).toFixed(2) + "MB";
					} else {
						that.fileSizeString = (sizeCache / 1073741824).toFixed(2) + "GB";
					}
				});
			},

			initData() {
				uni.showModal({
					title: '清楚缓存',
					content: '确定清楚本地缓存数据吗?',
					success: (res) => {
						if (res.confirm) {
							this.clearCache()
							this.formatSize()
						} else if (res.cancel) {
							return that.$util.Tips({
								title: '已取消'
							});
						}
					}
				});
			},
			clearCache() {
				let that = this;
				let os = plus.os.name;
				if (os == 'Android') {
					let main = plus.android.runtimeMainActivity();
					let sdRoot = main.getCacheDir();
					let files = plus.android.invoke(sdRoot, "listFiles");
					let len = files.length;
					for (let i = 0; i < len; i++) {
						let filePath = '' + files[i]; // 没有找到合适的方法获取路径，这样写可以转成文件路径  
						plus.io.resolveLocalFileSystemURL(filePath, function(entry) {
							if (entry.isDirectory) {
								entry.removeRecursively(function(entry) { //递归删除其下的所有文件及子目录  
									uni.showToast({
										title: '缓存清理完成',
										duration: 2000
									});
									that.formatSize(); // 重新计算缓存  
								}, function(e) {
									console.log(e.message)
								});
							} else {
								entry.remove();
							}
						}, function(e) {
							console.log('文件路径读取失败')
						});
					}
				} else { // ios暂时未找到清理缓存的方法，以下是官方提供的方法，但是无效，会报错  
					plus.cache.clear(function() {
						uni.showToast({
							title: '缓存清理完成',
							duration: 2000
						});
						that.formatSize();
					});
				}
			},
			/**
			 * 授权回调
			 */
			onLoadFun: function() {
				this.getUserInfo();
			},
			// 授权关闭
			authColse: function(e) {
				this.isShowAuth = e
			},
			/**
			 * 小程序设置
			 */
			Setting: function() {
				uni.openSetting({
					success: function(res) {}
				});
			},
			switchAccounts: function(index) {
				let userInfo = this.switchUserInfo[index],
					that = this;
				that.userIndex = index;
				if (that.switchUserInfo.length <= 1) return true;
				if (userInfo === undefined) return that.$util.Tips({
					title: '切换的账号不存在'
				});
				if (userInfo.user_type === 'h5') {
					uni.showLoading({
						title: '正在切换中'
					});
					switchH5Login().then(res => {
						uni.hideLoading();
						that.$store.commit("LOGIN", {
							'token': res.data.token,
							'time': this.$Cache.strTotime(res.data.expires_time) - this.$Cache.time()
						});
						that.getUserInfo();

					}).catch(err => {
						uni.hideLoading();
						return that.$util.Tips({
							title: err
						});
					})
				} else {
					that.$store.commit("LOGOUT");
					uni.showLoading({
						title: '正在切换中'
					});
					toLogin();
				}
			},
			/**
			 * 退出登录
			 * 
			 */
			outLogin: function() {
				let that = this;
				if (that.loginType == 'h5') {
					uni.showModal({
						title: '提示',
						content: '确认退出登录?',
						success: function(res) {
							if (res.confirm) {
								getLogout()
									.then(res => {
										// uni.clearStorage()
										that.$store.commit("LOGOUT");
										uni.reLaunch({
											url: '/pages/index/index'
										})
									})
									.catch(err => {});
							} else if (res.cancel) {
								console.log('用户点击取消');
							}
						}
					});
				}
			},
			/**
			 * 获取用户详情
			 */
			getUserInfo: function() {
				let that = this;
				getUserInfo().then(res => {
					that.$set(that, 'userInfo', res.data);
					let switchUserInfo = res.data.switchUserInfo || [];
					for (let i = 0; i < switchUserInfo.length; i++) {
						if (switchUserInfo[i].uid == that.userInfo.uid) that.userIndex = i;
						// 切割h5用户；user_type状态：h5、routine（小程序）、wechat（公众号）；注：只有h5未注册手机号时，h5才可和小程序或是公众号数据想通；
						//#ifdef H5
						if (
							!that.$wechat.isWeixin() &&
							switchUserInfo[i].user_type != "h5" &&
							switchUserInfo[i].phone === ""
						)
							switchUserInfo.splice(i, 1);
						//#endif
					}
					that.$set(that, "switchUserInfo", switchUserInfo);
				});
			},
			/**
			 * 上传文件
			 * 
			 */
			uploadpic: function() {
				let that = this;
				this.canvasStatus = true
				that.$util.uploadImageChange('upload/image', (res) => {
					let userInfo = that.switchUserInfo[that.userIndex];
					if (userInfo !== undefined) {
						that.userInfo.avatar = res.data.url;
					}
					that.switchUserInfo[that.userIndex] = userInfo;
					that.$set(that, 'switchUserInfo', that.switchUserInfo);
					this.canvasStatus = false
				}, (res) => {
					this.canvasStatus = false
				}, (res) => {
					this.canvasWidth = res.w
					this.canvasHeight = res.h
				});
			},

			/**
			 * 提交修改
			 */
			formSubmit: function(e) {
				let that = this,
					value = e.detail.value,
					userInfo = that.switchUserInfo[that.userIndex];
				if (!value.nickname) return that.$util.Tips({
					title: '用户姓名不能为空'
				});
				value.avatar = this.userInfo.avatar;
				value.sex = this.userInfo.sex;
				userEdit(value).then(res => {
					return that.$util.Tips({
						title: res.msg,
						icon: 'success'
					}, {
						tab: 3,
						url: 1
					});
				}).catch(msg => {
					return that.$util.Tips({
						title: msg || '保存失败，您并没有修改'
					}, {
						tab: 3,
						url: 1
					});
				});
			},
			/** 跳转绑定上级 */
			gotoBindUp() {
				uni.navigateTo({
					url: '/pages/users/user_bind_up/index',
					fail(err) {
						console.log(err)
					}
				})
			}
		}
	}
</script>

<style scoped lang="scss">

.wrap {
	background-color: #F58325;
	
	// width: 100vw;
	// height: 100vh;
	.personal-data {
		.list-box {
			background: #F7F7F7;
			border-radius: 20rpx 20rpx 0 0;
			overflow: hidden;
			.avatar-box {
				background-color: #fff;
				padding: 20rpx;
				
				.avatar-text {
					position: relative;
					font-size: 26rpx;
					font-family: PingFang SC;
					font-weight: bold;
					color: #666666;
					:after {
						content: '';
						position: absolute;
						left: 0;
						bottom: 0;
						width: 102rpx;
						height: 18rpx;
						background: url('#{$app-url}/static/images/bg-1.png') 100% 100% no-repeat;
					}
				}
				.avatar-content {
					
					margin-top: 20rpx;
					padding-left: 20rpx;
					.avatar-img {
						width: 100rpx;
						height: 100rpx;
						image {
							width: inherit;
							height: inherit;
							border-radius: 10rpx;
						}
					}
					.avatar-tip {
						margin-top: 20rpx;
						font-size: 20rpx;
						font-family: PingFang SC;
						font-weight: 500;
						color: #C2C2C2;
					}
					
				}
			}
		}	
	
		.list {
			background-color: #fff;
			margin-top: 20rpx;
			padding: 20rpx;
			
			.list-title {
				position: relative;
				font-size: 26rpx;
				font-family: PingFang SC;
				font-weight: bold;
				color: #666666;
				:after {
					content: '';
					position: absolute;
					left: 0;
					bottom: 0;
					width: 102rpx;
					height: 18rpx;
					background: url('#{$app-url}/static/images/users/user_info/bg-1.png') 100% 100% no-repeat;
				}
			}
			
			.item {
				display: flex;
				padding: 30rpx 0 30rpx 0;
				margin: 0 20rpx 0 20rpx;
				border-bottom: 1rpx solid rgba(204, 204, 204, 0.5);
				font-size: 22rpx;
				font-family: PingFang SC;
				font-weight: 500;
				color: #999999;
				text-align: left;
				> view:first-child {
					width: 260rpx;
					font-size: 24rpx;
					font-family: PingFang SC;
					font-weight: 500;
					color: #666666;
				}
				> view:nth-child(2) {
					flex: 1;
				}
				> navigator:nth-child(2) {
					flex: 1;
				}
			}
			
			
		}
		
		.list-down {
			margin-top: 20rpx;
			background-color: #fff;
			padding: 20rpx;
			.item {
				display: flex;
				padding: 30rpx 0 30rpx 0;
				margin: 0 20rpx 0 20rpx;
				border-bottom: 1rpx solid rgba(204, 204, 204, 0.5);
				font-size: 22rpx;
				font-family: PingFang SC;
				font-weight: 500;
				color: #999999;
				text-align: left;
				> view:first-child {
					width: 260rpx;
					font-size: 24rpx;
					font-family: PingFang SC;
					font-weight: 500;
					color: #666666;
				}
				> view:nth-child(2) {
					flex: 1;
				}
				> navigator:nth-child(2) {
					flex: 1;
				}
			}
			
		} 
	
	
		.bottom-btn-group {
			background-color: #fff;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			font-size: 36rpx;
			font-family: PingFang SC;
			font-weight: bold;
			
			.modifyBtn {
				width: 600rpx;
				height: 80rpx;
				line-height: 80rpx;
				color: #fff;
				background: linear-gradient(93deg, #F58426 0%, #F9AD53 100%);
				border-radius: 40rpx;
			}
			
			.logoutBtn {
				margin-top: 20rpx;
				width: 600rpx;
				height: 80rpx;
				line-height: 80rpx;
				color: #F58325;
				border: 1px solid #F58325;
				border-radius: 40rpx;
				
			}
		}

	}

}
</style>
