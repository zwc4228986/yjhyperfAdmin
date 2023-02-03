<template>
	<view class="warp">
		<view class="header">
				<view class="user-card">
					<view class="image">
						<u-avatar size="50" :src="userInfo.avatar"  shape="circle"></u-avatar>
					</view>
					<view class="user-info">
						<view class="nickname">
							{{userInfo.nickname}}
						</view>
					</view>
				</view>
			
					<view class="taskData">
						<view class="item">
							<view class="value">
								{{taskStatis.taskCount || 0}}
							</view>
							<view class="label">
								发布任务数
							</view>
						</view>
						<view class="item">
							<view class="value">
								{{taskStatis.taskOnlineCount || 0}}
							</view>
							<view class="label">
								在线任务数
							</view>
						</view>
						<view class="item">
							<view class="value">
								{{taskStatis.rate || 100}}%
							</view>
							<view class="label">
								审核通过率
							</view>
						</view>
				</view>
		</view>
		<view class="nav-box">
			<view  class="task-warp">
					<view class="task-box">
							<view class="task-item" v-for="(item, index) in taskLists"  :key="index" @click="toDetail(item.id)">
									<!-- <view class="image">
										<u-image  width="50px" height="50px" :src="item.image.full_path"></u-image>
									</view> -->
									<view class="mid">
										<view class="title">
											{{item.product_name}} {{item.title}}
											</view>
											<view class="desc">
												{{item.desc}}
											</view>
											<view class="mid-info">
												<view class="price">
													<u-text color="#E0171C" bold size="32rpx"  mode="price" :text="item.one_price"></u-text>
												</view>
												<view class="tag">
													<u-tag 
													 borderColor="#F58325"
													 color="#F58325"
													 bgcolor="#F58325" 
													 text="下载管理" plain size="mini" ></u-tag>
												</view>
											</view>
									</view>
									<view class="left">
										<view class="left-box">
											<view class="op">
												<u-button :custom-style="{color:'#fff',height:'50rpx'}" size="small" color="#F58325" shape="circle"  text="马上赚"></u-button>
											</view>
										</view>
									</view>
							</view>
					</view>
			</view>
		
		</view>
	</view>
</template>

<script>
	import tabBar from "@/pages/index/visualization/components/tabBar.vue";
	import {
		getShare
	} from "@/api/public.js";
	
	import {taskerUserInfo,taskerLists} from "@/api/tasker.js"
	import {taskLists} from "@/api/task.js"
	export default {
		data() {
			return {
				taskListsParams:{
					user_id:0,
					status:'all',
					types:1,
					page:1,
				},
				tabBar: {}, //导航
				taskLists:[
				],
				tabBarList: {title: "图片建议宽度81*81px", list: [{
					name: "首页",
					},
					{name: "我的"}]},
				indexList: [1, 2, 3],
				list1: [{
					name: '急速赚',
					sonName: '商家发布',
				}, {
					name: '任务赚',
					sonName: '商家发布',
				}, {
					name: '游戏赚',
					sonName: '商家发布',
				}, {
					name: '转发赚',
					sonName: '商家发布',
				}, ],
				userInfo:{},
				isDiy: true,
				shareInfo: {},
				taskStatis: {},
				user_id:0
			}
		},
		components: {
			tabBar
		},
		onShow() {
			uni.$on('is_diy', (data) => {
				this.isDiy = data
			})
			this.setOpenShare();
		},
		onLoad(options){
			this.user_id = options.user_id;
			this.taskListsParams.user_id = options.user_id;
			this.getTaskerUserInfo();
			this.getTaskLists()
		},
		onHide() {
			// this.isDiy = -1
		},
		methods: {
			getTaskerUserInfo(){
				taskerUserInfo({'user_id':this.user_id}).then(res=>{
					this.userInfo = res.userInfo;
					this.taskStatis = res.taskStatis;
				});
			},
			toChat(){
				uni.navigateTo({
					url:'/pages/chat/friends/friends'
				})
			},
			onReachBottom() {
				this.getTaskLists()
			},
			toDetail(id){
				uni.navigateTo({
					url:'/pages/task/detail?task_id='+id
				})
			},
			getTaskLists(){
				taskLists(this.taskListsParams).then(res=>{
					this.taskLists = res.data;
				})
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

<style lang="scss" scoped>
	page {
		font-size: 28rpx;
		color: white;
	}
	.taskData{
		margin-top: 30rpx;
		display: flex;
		.item{
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			flex: 1;
			.value{
				font-size: 32rpx;
				font-weight: bold;
				padding: 4rpx;
			}
			.label{
				font-size:22rpx;
				color: #666;
			}
			
		}
	}
	.warp{
		
	}
	.user-card{
		display: flex;
		align-items: center;
		.nickname{
			color: white;
			font-size: 40rpx;
			font-weight: bold;
			margin-left: 50rpx;
		}
	}
	.header {
		width: 100%;
		display: flex;
		overflow: hidden;
		background: #F58325;
		flex-direction: column;
		.chat-icon{
			display: flex;
			align-items: center;
			justify-content: center;
			width: 40px;
			position: relative;
		}
		.user-card{
			padding: 30rpx 30rpx 0 30rpx;
		}
		.taskData{
			padding: 30rpx 30rpx 30rpx 30rpx;
			background-color: white;
		}
		
	}
	.nav-box{
		padding-top: 20rpx;
	}
	.task-warp{
		// padding: 30rpx;
		.task-item{
			background-color: white;
			padding: 0 20rpx;
			margin-bottom: 20rpx;
			align-items: center;
			border-radius: 10rpx;
			display: flex;
			.image{
				height: 100%;
				width: 120rpx;
				display: flex;
				align-items: center;
				justify-content: center;
			}
			.mid{
				flex:1;
				padding: 20rpx;
				.title{
					color:#333;
					font-size: 28rpx;
					font-weight: bold;
					
				}
				.desc{
					margin-top: 6rpx;
					color:#787878;
					font-size: 22rpx;
				}
				.mid-info{
					margin-top: 12rpx;
					display: flex;
					.tag{
						padding-left: 10px;
					}
				}
				
			}
			.left{
				display: flex;
				align-items: center;
				.left-box{
					display: flex;
					flex-direction: column;
					justify-content: space-around;
					align-items: center;
					height: 110rpx;
					.stock{
						color:#787878;
						font-size: 22rpx;
					}
				}
			}
			
		}
	}
</style>
