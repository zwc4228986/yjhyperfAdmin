<template>
	<view class="wrap">
		<view class="header bg-box">
			<view class="task-info">
					<view class="image">
						<u-image  width="70px" height="70px" :src="taskDetail.image.full_path"></u-image>
					</view>
					<view class="mid">
							<view class="title">
								{{taskDetail.product_name}} {{taskDetail.title}}
							</view>
							<view class="desc">
								{{taskDetail.desc}} 
							</view>
							<view class="mid-info">
								<view class="price">
									<u-text color="#EA3C3C" bold size="30rpx"  mode="price" :text="taskDetail.one_price"></u-text>
								</view>
								<view class="tag">
									<u-tag
									 shape="circle"
									 borderColor="#FF7800"
									 color="#FF7800"
									 bgcolor="#FF7800" 
									 text="下载管理"   plain size="mini" ></u-tag>
								</view>
							</view>
					</view>
					<view class="left">
						<view class="left-box">
						<!-- 	<view class="op">
								<u-button :custom-style="{color:'#fff',height:'50rpx'}" size="small" color="#FF7800" shape="circle"  text="分享"></u-button>
							</view> -->
							<view class="stock">
								剩余{{taskDetail.stock|0}}份数
							</view>
						</view>
					</view>
			</view>
			<view class="taskData">
				<view class="item">
					<view class="label">
						剩余单数: 
					</view>
					<view class="value">
						{{taskDetail.finishNum||0}}单
					</view>
				
				<!-- 09-17 没有对字段 -->
				</view>
				<view class="item">
					<view class="label">
						任务限时:
					</view>
					<view class="value">
						{{taskDetail.stock}}小时
					</view>
				</view>
				<view class="item">
					<view class="label">
						审核时长:
					</view>
					<view class="value">
						{{taskDetail.submit_cycle}}小时
					</view>
				</view>
				<view class="item">
					<view class="label">
						{{taskDetail.audit_cycle}}
					</view>
					<view class="value">
						人已领取
					</view>
				</view>
			</view>
		</view>
		<view class="common-box" @click="toTasks">
			<view class="common-header">
				<view class="title">
					用户信息
				</view>
				<view class="">
				</view>
			</view>
			<view class="user-box">
				<view class="image">
					<u-avatar size="50" :src="taskReceiveDetail.user.avatar" shape="circle"></u-avatar>
				</view>
				<view class="user-info">
					<view class="nickname">
						{{taskReceiveDetail.user.nickname}}
					</view>
					<view class="user-task-info">
						<view class="task-rate">
							用户ID：{{taskReceiveDetail.user_id}}
						</view>
					</view>
				</view>
			</view>
		</view>
		
		<view class="common-box">
			<view class="common-header">
				<view class="title">
					任务需知
				</view>
				<view class="">
				</view>
			</view>
			<view class="common-content">
				{{taskDetail.info}}
			</view>
		</view>
		
		
		<view  class="common-box">
			<u-steps
				direction="column"
			>
				<u-steps-item height="100%" v-for="(task_step,index) in taskDetail.task_steps">
					<view class="disabled" v-if="taskDetail.isReceive==false" @click="tipsToReceiveTask()">
					</view>
					
					<view class="steps-circle" slot="icon">{{index+1}}</view>
					<view slot="desc">
						<view class="top">
							<view class="steps-desc common-content" >
								<view class="steps-title">步骤{{index+1}}</view>
								<view v-for="(item) in task_step.task_steps_rules">
									<view class="textarea" v-if="item.type == 'textarea'">
											{{item.value}}
									</view>
									<view v-if="item.field == 'url'"  class="url">
										<yj-link  :href="item.value" :text="item.value"></yj-link>
										<view class="url-op">
											<yj-button
											@click="openLink(item.value)"
											:customStyle="{width:'150rpx',height:'50rpx'}"
											fontSize='12'
											shape="circle" 
											bg="#FF7800" 
											color="#fff" 
											text="点击跳转"
											>
											</yj-button>
											<view style="width: 20rpx;"></view>
											<yj-button
												@click="copy(item.value)"
											 	fontSize='12'
												:customStyle="{
												width:'150rpx',
												height:'50rpx',
												border:'1px soild #FF7800'}"  
											 shape="circle" 
											  color="#FF7800" 
											  text="复制">
											</yj-button>
											
										</view>
									</view>
									<view v-if="item.field == 'code'"  class="url">
										<text>{{item.value}}</text>
										<view class="url-op" 	@click="copy(item.value)">
										<yj-button
										 	fontSize='12'
											:customStyle="{
											width:'150rpx',
											height:'50rpx',
											border:'1px soild #FF7800'}"  
										 shape="circle" 
										  color="#fff" 
										  text="复制">
										</yj-button>
										</view>
									</view>
									
									<view v-if="item.field == 'picture'"  class="picture">
										<view class="tip">
											说明图
										</view>
										<yj-image radius="4" width="250"  :imageId="item.value"></yj-image>
									</view>
									<view v-if="item.field == 'screenshot'"  class="screenshot">
										<view class="tip">
											说明图
										</view>
										<yj-image radius="4" width="150"  :imageId="item.value"></yj-image>
										<view style="flex-basis: 20rpx;">
										</view>
										<yj-upload :delete="false" uploadText="添加图片" :imageId="item.submit"   @input="taskReceive($event,item.id)"></yj-upload>
									</view>
													
								</view>
							</view>
						</view>
						
						
					</view>
				</u-steps-item>

			</u-steps>
		</view>


	<u-modal :show="PassShow" title="确认审核同意吗？"  @confirm="onAudit(100)" @cancel="PassShow=false" :showCancelButton="true"></u-modal>
	<u-modal :show="RefundShow" title="确认审核拒绝吗？"  @confirm="onAudit(5)" @cancel="RefundShow=false" :showCancelButton="true">
		<view class="slot-content">
				<u-input placeholder="请输入拒绝理由" v-model="reason"></u-input>
		</view>
	</u-modal>
	<view style="height: 65px;"></view>
	<view class="footer">
		<view class="left">
				<u-icon name="chat-fill" size="40" @click="toChat"></u-icon>
		</view>
		<view class="right"  v-if="taskDetail.isReceive==false">
			<u-button  color="#FF7800"  label="uView" @click="receive" shape="circle"  text="领取任务">
			</u-button>
		</view>
		<view class="right"  v-else>
				<template v-if="taskReceiveDetail.status==0">
				<!-- 	<view class="cancel-button" @click.stop="taskReceiveLog()">
						<u-button  color="#000" :plain="true"   shape="circle"  text="审核详情">
						</u-button>
					</view> -->
					<view class="commit-button">
						<yj-button 
						  bg="#FF7800" 
						 color="#fff" 
						  shape="circle" 
						  >
						   等待提交
						</yj-button>
					</view>
				</template>
				<template v-if="taskReceiveDetail.status==100">
				<!-- 	<view class="cancel-button" @click.stop="taskReceiveLog()">
						<u-button  color="#000" :plain="true"   shape="circle"  text="审核详情">
						</u-button>
					</view> -->
					<view class="commit-button">
						<view class="cancel-button">
							<yj-button   bg="#FF7800" 
						 color="#fff" 
						  shape="circle"  text="已通过" >
							</yj-button>
						</view>
					</view>
				</template>
				<template  v-if="taskReceiveDetail.status==10">
					<view class="cancel-button" @click="RefundShow=true">
						<u-button  color="#FF7800" :plain="true"   shape="circle"  text="拒绝" >
						</u-button>
					</view>
					<view class="commit-button" @click="PassShow=true">
						<yj-button 
						 bg="#FF7800" 
						 color="#fff" 
						  shape="circle" 
						  >
						   通过
						</yj-button>
					</view>
				</template>	
				<template  v-if="taskReceiveDetail.status==5">
					<view class="cancel-button">
						<u-button  color="#FF7800" :plain="true"   shape="circle"  text="待补缴" >
						</u-button>
					</view>
				</template>	
			
		</view>
	</view>
	</view>
	
</template>

<script>
	import {taskDetail,taskReceive,taskReceiveCancel,taskReceiveSubmit,taskReceiveDetailSubmit} from '@/api/task.js'
	import {taskerTaskReceiveDetail,taskerTaskReceiveAudit} from '@/api/tasker.js'
	export default {
		data() {
			return {
				PassShow:false,
				RefundShow:false,
				task_receive_id:0,
				taskReceiveDetail:{},
				taskDetail:{
					stock:0,
					audit_cycle:0,
					submit_cycle:0,
					finishNum:0,
					receive:{
						cancel_timestamp:200,
					},
					image:{
						full_path:""
					},
					product_name:"",
					isReceive:false,
					user:{},
					product_name:"",
				},
				reason:'',
				is_view:false,
				task_id:0,
			}
		},
		onLoad(options){
			this.task_receive_id = options.task_receive_id || 0;
			this.getDetail();
		},
		methods: {
			taskReceiveLog(){
				uni.$u.toast('审核中');
			},
			onAudit(Auditstatus){
					taskerTaskReceiveAudit({task_receive_id:this.task_receive_id,status:Auditstatus,reason:this.reason}).then(res=>{
							uni.showToast({
							  title: '审核成功'
							})
							this.PassShow=false;
							this.RefundShow=false;
							this.getDetail();
					})
			},
			taskReceiveLog(){
				uni.$u.toast('审核中');
			},
			copy(value){
				uni.setClipboardData({
				  data: value,
				  success: () =>
				    uni.showToast({
				      title: '复制成功'
				    })
				})
			},
			openLink(href) {
				// #ifdef APP-PLUS
				plus.runtime.openURL(href)
				// #endif
				// #ifdef H5
				window.open(href)
				// #endif
				// #ifdef MP
				uni.setClipboardData({
					data: href,
					success: () => {
						uni.hideToast();
						this.$nextTick(() => {
							uni.$u.toast(this.mpTips);
						})
					}
				});
				// #endif
			},
			refresh(){
				this.getDetail();
			},
			report(){
				uni.navigateTo({
					url:'/pages/task/report/report?task_id='+this.task_id
				})
			},
			toUrl(url){
				uni.navigateTo({
					url:url
				})
			},
			taskReceive(value,id){
				taskReceiveDetailSubmit({
					task_receive_id:this.taskDetail.receive.id,
					task_steps_rules_id:id,
					value:value
				}).then(res=>{
					
				})
			},	
			taskReceiveSumbit(value,id){
				console.log(value,id);
				taskReceiveSubmit({
					task_receive_id:this.taskDetail.receive.id,
					task_steps_rules_id:id,
					value:value
				}).then(res=>{
					this.$util.Tips({
						title: '提交成功'
					},res=>{
						this.refresh();
					});
				})
			},
			cancelTask(check = false){
				taskReceiveCancel({taskReceiveid:this.taskDetail.receive.id,check:check}).then(res=>{
					console.log(res);
					this.taskLists = res.data;
				}).then(res=>{
					this.$util.Tips({
						title: '取消成功'
					},res=>{
						this.refresh();
					});
				})
			},
			getDetail(){
				taskerTaskReceiveDetail({task_receive_id:this.task_receive_id}).then(res=>{
					this.taskReceiveDetail = res;
					
					this.taskDetail = res.task;
				})
			},
			receive(){
				taskReceive({task_id:this.task_id}).then(res=>{
								this.$util.Tips({
									title: '领取成功'
								},res=>{
									this.refresh();
								});
				})
			},	
			tipsToReceiveTask(){
				this.$util.Tip('请先领取任务');
			},
			toTasks(){
				uni.navigateTo({
					url:'/pages/task/user/tasks?user_id='+this.taskDetail.user.uid
				})
			},
			toChat(){
			   	uni.navigateTo({
			   		url:'/pages/customer/chat?task_id='+this.task_id+'&receiver_id='+this.taskDetail.user.uid
			   	})
			}
		},
	}
</script>

<style lang="scss" scoped>
.wrap{
	
}
.bg-box{
	background-color: white;
	border-radius: 20rpx;
	overflow: hidden;
	padding: 20rpx;
}
.task-info{
			display: flex;
			align-items: center;
			.image{
				height: 100%;
				width: 140rpx;
				display: flex;
				align-items: center;
				justify-content: center;
			}
			.mid{
				flex: 1;
				padding:0 20rpx;
				.title{
					color:#333;
					font-size: 30rpx;
					font-weight: bold;
				}
				.desc{
					margin-top: 6rpx;
					color: #999999;
					font-size: 22rpx;
				}
				.mid-info{ 
					.price{
						margin-right: 10rpx;
					}
					margin-top: 6rpx;
					display: flex;
					align-items: center;
					.tag{
						display: flex;
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
.footer{
	display: flex;
	background-color: white;
	position: fixed;
	left: 0;
	bottom: 0;
	width: 100%;
	height: 60px;
	padding: 20rpx;
	z-index: 99999999;
	align-items: center;
	justify-content: center;
	.left{
		flex-basis: 50px;
	}
	.right{
		flex: 1;
		display: flex;
		.commit-button{
			padding: 0 5rpx;
			flex: 3;
		}
		.cancel-button{
				padding:  0 5rpx;
			flex: 1;
		}
	}
}
.taskData{
	margin: 30rpx auto 30rpx auto;
	display: flex;
	justify-content: space-between;
	box-sizing: border-box;
	padding-top: 30rpx;
	border-top: 1rpx solid rgba(204, 204, 204, 0.5);

	
	.item{
		box-sizing: border-box;
		padding: 0 30rpx; 
		border-right: 1rpx solid rgba(204, 204, 204, 0.5);
		display: flex;
		
		align-items: center;
		justify-content: center;
		
		.value{
			flex-wrap: nowrap;
			font-size: 22rpx;
			font-family: DIN;
			font-weight: bold;
			color: #666666;
		}
		.label{
			font-size: 20rpx;
			font-family: PingFang SC;
			font-weight: 500;
			color: #666666;
		}
		
		&:first-child {
			padding-left: 0;
		}
		&:last-child {
			border: none;
			padding-right: 0;
		}
		
	}
}
.op-wrap{
	margin-top: 20rpx;
	// padding: 10rpx 0rpx;
	.op-box{
		display: flex;
		justify-content: space-between;
		.item{
			
			.op{
				color:#F58325;
				height: 48rpx;
				width: 200rpx;
				display: flex;
				justify-content: center;
				align-items: center;
				
				image {
					width: inherit;
					height: inherit;
				}
			}
		}
		
	}
}
.common-box{
	position: relative;
	.disabled{
		position: absolute;
		width: 100%;
		height: 100%;
		z-index: 999;
	}
	
	background-color: white;
	border-radius: 20rpx;
	overflow: hidden;
	padding: 20rpx;
	margin-top: 30rpx;
	.common-header{
		display: flex;
		justify-content: space-between;
		align-items: center;
		.title{
			color:#333;
			font-size: 30rpx;
			font-weight: bold;
		}
	}
	.common-content{
		font-size: 24rpx;
		color: #787878;
		.url{
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			.url-op{
				margin-top: 30rpx;
				display: flex;
			}
		}
		.textarea{
			padding: 10rpx 0 30rpx 0;
			color: #333;
		}
		.picture,.screenshot{
			position: relative;
			display: flex;
			flex-wrap: wrap;
			align-items: flex-end;
			.tip{
				position: absolute;
				top:0;
				left:0;
				background-color: rgb(252, 199, 4);
				z-index: 999;
				padding: 10rpx;
				font-size: 24rpx;
				color: #000;
				border-radius: 5rpx;
				overflow: hidden;
			}
		}
		
	}

	/deep/.u-steps {
		.u-steps-item {
			.u-steps-item__line {
				background: #FFC596 !important;
			}
		}
	}

	.steps-circle {
		display: flex;
		justify-content: center;
		align-content: center;
		width: 46rpx;
		height: 46rpx;
		background: url('/static/images/task/detail/step.png') no-repeat;
		background-size: 100% 100%;
		
		font-size: 24rpx;
		font-family: Impact;
		font-weight: 400;
		color: #FFFFFF;
		line-height: 46rpx;
	}
	
	.top {
		display: flex;
		align-items: flex-star;
		.steps-title {
			flex-shrink: 0;
			font-size: 28rpx;
			font-family: PingFang SC;
			font-weight: bold;
			color: #282828;
			margin-right: 18rpx;
		}
		.steps-desc {
			flex: 1;
			font-size: 24rpx !important;
			font-family: PingFang SC;
			font-weight: 500;
			color: #666666;
		}
	}
}
.user-box{
	padding-top: 20rpx;
	display: flex;
	align-items: center;
	.nickname{
		font-size: 28rpx;
		font-weight: 700;
	}
	.user-info{
		margin-left:20rpx;
		
		.user-task-info {
			margin-top: 10rpx;
			display: flex;
			font-size: 24rpx;
			color:#787878;
			align-items: center;
		}
	
	}
		
}

	


</style>
