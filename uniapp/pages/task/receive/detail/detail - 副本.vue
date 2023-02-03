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
							<view class="mid-info">
								<view class="price">
									<u-text color="#E0171C" bold size="32rpx"  mode="price" :text="taskDetail.one_price"></u-text>
								</view>
								<view class="tag">
									<u-tag
									 borderColor="#D1D1D1"
									 color="#787878"
									 bgcolor="#D1D1D1" 
									 text="下载管理" plain size="mini" ></u-tag>
								</view>
							</view>
					</view>
					<view class="left">
						<view class="left-box">
							<!--<view class="op">
								<u-button :custom-style="{color:'#000',height:'50rpx'}" size="small" color="#FCC704" shape="circle"  text="分享"></u-button>
							</view>-->
							
							<view class="stock">
								剩余{{taskDetail.stock|0}}份数
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
		
		
		<view class="common-box"  v-for="(task_step,index) in taskDetail.task_steps">
			<view class="disabled" v-if="taskDetail.isReceive==false" @click="tipsToReceiveTask()">
				
			</view>
			<view class="common-header">
				<view class="title">
					步骤{{index+1}}
				</view>
				<view class=""></view>
			</view>
			<view class="common-content">
				<block v-for="(item) in task_step.task_steps_rules">
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
							bg="#FCC704" 
							color="#000" 
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
								border:'1px soild #000'}"  
							 shape="circle" 
							  color="#000" 
							  text="复制">
							</yj-button>
							
						</view>
					</view>
					<view v-if="item.field == 'code'"  class="url">
					<!-- 	<yj-link color="#FCC704"  :href="item.value" :text="item.value" @click="click">
							
						</yj-link> -->
						<text>{{item.value}}</text>
						<view class="url-op" 	@click="copy(item.value)">
						<yj-button
						 	fontSize='12'
							:customStyle="{
							width:'150rpx',
							height:'50rpx',
							border:'1px soild #000'}"  
						 shape="circle" 
						  color="#000" 
						  text="复制">
							
						</yj-button>
						</view>
					</view>
					<view v-if="item.field == 'picture'"  class="picture">
						<view class="tip">
							说明图
						</view>
						<yj-image radius="4" width="300"  :imageId="item.value"></yj-image>
					</view>
					
					<view v-if="item.field == 'screenshot'"  class="screenshot">
						<view class="tip">
							说明图
						</view>
						<yj-image radius="4" width="150"  :imageId="item.value"></yj-image>
						<view style="flex-basis: 20rpx;">
						</view>
						<yj-upload uploadText="添加图片" :imageId="item.submit"   @input="taskReceive($event,item.id)"></yj-upload>
					</view>
				</block>
			</view>
		</view>
		<u-modal :show="PassShow" title="确认审核同意吗？"  @confirm="onAudit(100)" @cancel="PassShow=false" :showCancelButton="true"></u-modal>
		<u-modal :show="RefundShow" title="确认审核拒绝吗？"  @confirm="onAudit(5)" @cancel="RefundShow=false" :showCancelButton="true"></u-modal>
		<view style="height: 65px;"></view>
		<view class="footer">
			<view class="left">
					<u-icon name="chat-fill" size="40" @click="toChat"></u-icon>
			</view>
			<view class="right"  v-if="taskDetail.isReceive==false">
				<u-button  color="#FCC704"  label="uView" @click="receive" shape="circle"  text="领取任务">
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
							  bg="#FCC704" 
							 color="#000" 
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
								<yj-button   bg="#FCC704" 
							 color="#000" 
							  shape="circle"  text="已通过" >
								</yj-button>
							</view>
						</view>
					</template>
					<template  v-if="taskReceiveDetail.status==10">
						<view class="cancel-button" @click="RefundShow=true">
							<u-button  color="#000" :plain="true"   shape="circle"  text="拒绝" >
							</u-button>
						</view>
						<view class="commit-button" @click="PassShow=true">
							<yj-button 
							  bg="#FCC704" 
							 color="#000" 
							  shape="circle" 
							  >
							   通过
							</yj-button>
						</view>
					</template>	
				
			</view>
		</view>
	</view>
	
</template>

<script>
	import {taskerTaskReceiveDetail,taskerTaskReceiveAudit} from '@/api/tasker.js'
	export default {
		data() {
			return {
				taskReceiveDetail:{},
				taskDetail:{
					receive:{
						cancel_timestamp:200,
					},
					image:{
						full_path:""
					},
					isReceive:false,
					user:{},
					product_name:"",
				},
				PassShow:false,
				RefundShow:false,
				task_receive_id:0,
			}
		},
		onLoad(options){
			this.task_receive_id = options.task_receive_id;
			this.getDetail();
		},
		methods: {
			taskReceiveLog(){
				uni.$u.toast('审核中');
			},
			onAudit(Auditstatus){
					taskerTaskReceiveAudit({task_receive_id:this.task_receive_id,status:Auditstatus}).then(res=>{
							uni.showToast({
							  title: '审核成功'
							})
							this.PassShow=false;
							this.RefundShow=false;
							this.getDetail();
					})
					
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
		padding: 20rpx;
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
					color:#787878;
					font-size: 22rpx;
				}
				.mid-info{
					flex-direction: column;
					margin-top: 6rpx;
					display: flex;
					.tag{
						margin-top: 12rpx;
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
.op-wrap{
	margin-top: 20rpx;
	// padding: 10rpx 0rpx;
	.op-box{
		display: flex;
		.item{
			flex: 1;
			padding: 10rpx;
			.op{
				height: 60rpx;
				border: 1px solid #000;
				border-radius: 30rpx;
				display: flex;
				justify-content: center;
				align-items: center;
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
		margin-top: 20rpx;
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
