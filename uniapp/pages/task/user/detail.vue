<template>
	<view class="wrap">
		<u-alert v-if="taskDetail.status<=1" :show-icon="true" :title="taskDetail.status_format" type = "warning" effect="dark" :description = "description"></u-alert>
		<view class="header bg-box">
			<view class="task-info">
					<view class="image">
						<u-image  width="50px" height="50px" :src="taskDetail.image.full_path"></u-image>
					</view>
					<view class="mid">
							<view class="title">
								{{taskDetail.product_name}} {{taskDetail.title}}
							</view>
							<view class="mid-info">
								<view class="task-start-time">
									2020-05-05发布
								</view>
								<view class="task-end-time">
									2020-05-27到期
								</view>
							</view>
							<view class="mid-detail"> 
							<u-text size="24rpx" color="#787878" suffixIcon="arrow-right" iconStyle="font-size: 26rpx" text="任务页面">
							</u-text>
							</view>
					</view>
			</view>
			<view class="taskData">
				<view class="item">
					剩余{{taskDetail.stock}}/{{taskDetail.total_stock}}份
				</view>
				<view class="item">
					{{taskDetail.submit_cycle|0}}小时内提交
				</view>
				<view class="item">
					{{taskDetail.audit_cycle|0}}小时内审核
				</view>
			</view>
		</view>
		<view class="common-box">
			<view class="common-header">
				<view class="title">
					任务统计
				</view>
			</view>
			<view class="common-content statistics-box">
			<!-- 	<view class="item" @click="toReceveLists(1)">
					<view class="value">{{taskDetail.statistics}}</view>
					<view class="lable">待复审</view>
				</view> -->
				<view class="item" @click="toReceveLists(1)">
					<view class="value">{{taskDetail.statistics.auditing}}</view>
					<view class="lable">待审核</view>
				</view>
				<view class="item" @click="toReceveLists(1)">
					<view class="value">{{taskDetail.statistics.barge}}</view>
					<view class="lable">已驳回</view>
				</view>
				<view class="item" @click="toReceveLists(1)">
					<view class="value">{{taskDetail.statistics.success}}</view>
					<view class="lable">已通过</view>
				</view>
				<view class="item" @click="toReceveLists(1)">
					<view class="value">{{taskDetail.statistics.appeal}}</view>
					<view class="lable">申诉中</view>
				</view>
				<view class="item" @click="toReceveLists(1)">
					<view class="value">{{taskDetail.statistics.wait_submit}}</view>
					<view class="lable">待提交</view>
				</view>
				<view class="item" @click="toReceveLists(1)">
					<view class="value">{{taskDetail.statistics.delete}}</view>
					<view class="lable">已放弃</view>
				</view>
				<view class="item">
					<view class="value">{{taskDetail.view}}</view>
					<view class="lable">浏览量</view>
				</view>
				
			</view>
		</view>
		
	<view class="common-box">
		<view class="common-header">
			<view class="title">
				任务操作
			</view>
		</view>
		<view class="common-content">
			<u-grid
			           :border="false"
			           @click="op"
									 col="4"
			       >
			           <u-grid-item
			                   v-for="(baseListItem,baseListIndex) in baseList"
			                   :key="baseListIndex"
			           >
							<uni-icons style="padding-top: 30rpx;" custom-prefix="iconfont" :type="baseListItem.name" size="28"></uni-icons>
			        
			               <text class="grid-text">{{baseListItem.title}}</text>
			           </u-grid-item>
			 </u-grid>
		</view>
	</view>
	
	<!-- 	<view class="common-box">
			<view class="common-header">
				<view class="title">
					任务操作日志
				</view>
			</view>
			<view class="common-content">
					<u-steps :dot="true" activeColor="#fcc62f" current="0" direction="column">
						<u-steps-item title="创建任务" desc="10:30">
						</u-steps-item>
						
					</u-steps>
			</view>
		</view> -->
		<u-modal :show="deleteShow" @cancel="deleteShow=false" :showCancelButton="true" title="删除任务" content='确认删除吗？' @confirm="deleteTask(false)"></u-modal>
	</view>
	
	
	
</template>

<script>
	import {taskDetail,taskReceive} from '@/api/task.js'
	import {taskerDelete,taskerShelf,taskerTop,taskerRefresh} from '@/api/tasker.js'
	export default {
		data() {
			return {
				deleteShow:false,
				baseList: [{
				                    name: 'icon-icon_edit',
				                    title: '修改任务',
									method:'edit',
				                    },
				                    {
				                        name: 'icon-zhifu',
				                        title: '修改价格',
				                        method: 'changePrice'
				                    },
				                    {
				                        name: 'icon-shuliang',
				                        title: '修改数量',
										method: 'changeNumber'
				                    },
									{
									    name: 'icon-a-zhifuqianbaodaizhifu',
									    title: '立即支付',
										method:'pay'
									},
									{
									    name: 'icon-shanchu',
									    title: '删除任务',
										method: 'deleteTask'
									}
				],
				taskDetail:{
					image:{
						full_path:""
					},
					isReceive:false,
					user:{},
					statistics:{},
					product_name:"",
					submit_cycle:0,
				},
				task_id:0,
			}
		},
		watch:{
			'taskDetail.status':{
				handler(value){
					if(value==1){
						this.baseList = [
							{
							    name: 'icon-zhifu',
							    title: '审核中',
							},
						];
					}
					if(value == -1){
						this.baseList = [{
						                    name: 'icon-icon_edit',
						                    title: '恢复上架',
											method:'shelf',
						                    },
						                    {
						                        name: 'icon-zhifu',
						                        title: '修改价格',
						                        method: 'changePrice'
						                    },
						                    {
						                        name: 'icon-shuliang',
						                        title: '修改数量',
												method: 'changeNumber'
						                    },
											{
											    name: 'icon-a-zhifuqianbaodaizhifu',
											    title: '立即支付',
												method:'pay'
											},
											{
											    name: 'icon-shanchu',
											    title: '删除任务',
												method: 'deleteTask'
											}
						]
					}
					
					if(value==2){
						this.baseList = [
						                    {
						                        name: 'icon-zhifu',
						                        title: '修改价格',
						                        method: 'changePrice'
						                    },
						                    {
						                        name: 'icon-shuliang',
						                        title: '修改数量',
												method: 'changeNumber'
						                    },
											{
											    name: 'icon-shuliang',
											    title: '置顶',
												method: 'top'
											},
											{
											    name: 'icon-shuliang',
											    title: '刷新',
												method: 'refresh'
											},
						]
					}
				}
			},
			immediate:true
		},
		onLoad(options){
			this.task_id = options.task_id;
		},
		onShow(){
			this.getDetail();
		},
		methods: {
			toReceveLists(status){
				uni.navigateTo({
					url:'/pages/task/receive/lists/lists?status='+status+'&task_id='+this.task_id
				})
			},
			op(e){
				this[`${this.baseList[e].method}`]();
			},
			
			deleteTask(isShow=true){
				if(isShow){
					this.deleteShow = true;
				}else{
					//开始删除
					taskerDelete({task_id:this.task_id}).then(res=>{
						this.$util.Tips({title:'删除成功'},'/pages/task/user/center');
					});
				}
			},
			shelf(){
				let _this = this;
				taskerShelf({task_id:this.task_id}).then(res=>{
					this.$util.Tips({title:'上架成功'},function(){
						_this.getDetail();
					});
				});
			},
			top(){
				taskerTop({task_id:this.task_id}).then(res=>{
					this.$util.Tips({title:'置顶成功'},function(){
						_this.getDetail();
					});
				});
			},
			refresh(){
				taskerRefresh({task_id:this.task_id}).then(res=>{
					this.$util.Tips({title:'刷新成功'},function(){
						_this.getDetail();
					});
				});
			},
			edit(){
				uni.navigateTo({
					url:'/pages/task/add?task_id='+this.task_id
				})
			},
			pay(){
				uni.navigateTo({
					url:'/pages/task/order_confirm/index?task_id='+this.task_id
				})
			},
			changePrice(){
				uni.navigateTo({
					url:'/pages/task/changePrice?task_id='+this.task_id
				})
			},	
			changeNumber(){
				uni.navigateTo({
					url:'/pages/task/changeNumber?task_id='+this.task_id
				})
			},
			getDetail(){
				taskDetail({task_id:this.task_id}).then(res=>{
					this.taskDetail = res;
					
				})
			},
			receive(){
				taskReceive({task_id:this.task_id}).then(res=>{
						
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
	margin-top: 10rpx;
	background-color: white;
	border-radius: 20rpx;
	overflow: hidden;
	padding:20rpx;
}
.task-info{
			display: flex;
			align-items: center;
			.image{
				height: 100%;
				width: 120rpx;
				display: flex;
				align-items: center;
				justify-content: center;
			}
			.mid{
				padding: 20rpx;
				
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
					.task-end-time{
						margin-left: 20rpx;
					}
					margin-top: 10rpx;
					display: flex;
					font-size: 24rpx;
					color: #787878;
				}
				.mid-detail{
					display: flex;
					margin-top: 10rpx;
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
	display: flex;
	.item{
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		flex: 1;
		font-size: 24rpx;
		color: #787878;
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
	background-color: white;
	border-radius: 20rpx;
	overflow: hidden;
	padding: 30rpx;
	margin-top: 20rpx;
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
		.grid-text{
			font-size: 24rpx;
			margin-top: 10rpx;
		}
		.url{
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			.url-op{
				display: flex;
				
			}
		}
	
	}
}
.statistics-box{
	display: flex;
	flex-wrap: wrap;
	.item{
		.value{
			padding: 10rpx;
			font-weight: bold;
			font-size: 28rpx;
		}
		padding: 10rpx;
		flex-basis: 25%;
		display: flex;
		align-items: center;
		justify-content: center;
		flex-direction: column;
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
		}
	
	}
		
}
</style>
