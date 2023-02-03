<template>
	<view class="wrap">
	
		<view class="common-box">
			<view class="common-header">
				<view class="title">
					当前任务数量情况
				</view>
			</view>
			<view class="common-content statistics-box">
				<view class="item">
					<view class="value">{{taskDetail.stock}}</view>
					<view class="lable">任务总量</view>
				</view>
				<view class="item">
					<view class="value">{{taskDetail.one_price}}</view>
					<view class="lable">任务单价</view>
				</view>
				<view class="item">
					<view class="value">{{(taskDetail.price)}}</view>
					<view class="lable">任务总价</view>
				</view>
			
			</view>
		</view>
		
	<view class="common-box">
		<view class="common-header">
			<view class="title">
				请输入新的任务单价
			</view>
		</view>
		<view class="common-content">
			<view class="price-box">
				<u-input
				  type="number"
				  :min="newTaskPrice"
				  placeholder="请输入新的任务单价"
				  border="surround"
				  v-model="newTaskPrice"
				></u-input>
			</view>
			<view class="common-content-box">
				<view class="item">
					 <view class="label">任务单价：</view>
					 <view class="value">{{newTaskPrice}}</view>
				</view>
				<view class="item">
					 <view class="label">任务总量：</view>
					 <view class="value">{{taskDetail.stock}}</view>
				</view>
				<view class="item">
					 <view class="label">任务总额：</view>
					 <view class="value">{{(taskDetail.stock*newTaskPrice).toFixed(2)}}</view>
				</view>
				<view class="item">
					 <view class="label">已付金额：</view>
					 <view class="value">{{(taskDetail.one_price*taskDetail.stock).toFixed(2)}}</view>
				</view>
				<view class="item">
					 <view class="label">需补差距：</view>
					 <view class="value">{{diffPrice}}</view>
				</view>
			</view>
		</view>
	</view>
	
	<view class="footer">
			<u-button text="确认修改" :customStyle="{width:'90%'}" color="#fcc62f" shape="circle" @click="submit"></u-button>
	</view>
	</view>
	
	
	
</template>

<script>
	import {taskerDetail,taskerChangePrice} from '@/api/tasker.js'
	export default {
		data() {
			return {
				baseList: [{
				                    name: 'photo',
				                    title: '修改任务',
									method:'edit',
				                    },
				                    {
				                        name: 'lock',
				                        title: '修改价格',
				                        method: 'changePrice'
				                    },
				                    {
				                        name: 'star',
				                        title: '修改数量'
				                    },
									{
									    name: 'star',
									    title: '立即支付'
									},
									{
									    name: 'star',
									    title: '删除任务'
									}
				],
				
				taskDetail:{
					image:{
						full_path:""
					},
					isReceive:false,
					user:{},
					product_name:"",
				},
				newTaskPrice:0,
				task_id:0,
			}
		},
		
		onLoad(options){
			this.task_id = options.task_id;
			this.getDetail();
		},
		computed:{
			diffPrice(){
				 return ((this.newTaskPrice - this.taskDetail.one_price)*this.taskDetail.stock).toFixed(2);
				
			},
		},
		methods: {
			op(e){
				this[`${this.baseList[e].method}`]();
			},
			edit(){
				uni.navigateTo({
					url:'/pages/task/add?task_id='+this.task_id
				})
			},
			getDetail(){
				taskerDetail({task_id:this.task_id}).then(res=>{
					this.newTaskPrice = res.task_price
					this.taskDetail = res;
				})
			},
			submit(){
				taskerChangePrice({task_id:this.task_id,one_price:this.newTaskPrice}).then(res=>{
					this.$util.Tips({'title':'修改成功'},function(){
							uni.navigateBack({
								
							})
					})
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
	.footer {
		display: flex;
		justify-content: center;
	}
.bg-box{
	background-color: white;
	border-radius: 20rpx;
	overflow: hidden;
	padding: 20rpx;
}
.common-content-box{
	margin-top: 10rpx;
	display: flex;
	flex-direction: column;
	.item{
		display: flex;
		justify-content: space-between;
		padding: 20rpx 0;
		
	}
}
.task-info{
			display: flex;
			justify-content: center;
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
	padding: 20rpx;
	margin-bottom: 30rpx;
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
				display: flex;
				
			}
		}
	
	}
}
.statistics-box{
	display: flex;
	flex-wrap: wrap;
	padding: 20rpx 0;
	.item{
		.value{
			font-weight: bold;
			font-size: 32rpx;
		}
		display: flex;
		flex: 1;
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
