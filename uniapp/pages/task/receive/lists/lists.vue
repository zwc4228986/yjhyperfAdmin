<template>
	<view class="warp">
		<view class="header">
			<u-tabs :list="tabs" :scrollable="true" @click="changeTabs"></u-tabs>
		</view>
		<view class="mid">
			<view class="task-warp">
				<view class="task-box">
					<view class="task-item" v-for="(item, index) in taskLists" :key="index" @click="toDetail(item.id)">
						<view class="image">
							<u-image width="50px" height="50px"
							 :src="item.user.avatar">
							 </u-image>
						</view>
						<view class="mid">
							<view class="title">
								{{item.task.product_name}} {{item.task.title}}
							</view>
							<view class="user-info">
								<view class="nickname">
									{{item.user.nickname}}
								</view>
								<view class="user-task-info">
									<view class="task-rate">
										用户ID：{{item.user_id}}
									</view>
								</view>
							</view>
							<view class="beans">
								
							</view>
						</view>
						<view class="left">
							<!-- 	<view class="left-box" v-if="item.status == 0">
											<view class="op" @click.stop="cancelTask(item.id)">
												<u-button :custom-style="{color:'#000',height:'50rpx'}" 
												size="small" color="#FCC704" shape="circle" 
												 text="取消任务" ></u-button>
											</view>
											<view class="endtime">
												<u-count-down :time="item.cancel_timestamp* 1000" format="HH时mm分ss秒"></u-count-down>
											</view>
										</view> -->
							<view class="create_time">
								{{item.create_time_format}}
							</view>
							<view class="status-box">
								{{item.status_format}}
								<view>
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
	import {
		taskReceiveLists,
		taskReceiveCancel
	} from "@/api/task.js"
	import {
		taskerReceiveLists
	} from "@/api/tasker.js"
	export default {
		data() {
			return {
				tabs: [{
						status: 'all',
						name: '全部'
					},
					{
						status: '10',
						name: '待审核',
					},
					{
						status: '5',
						name: '已驳回',
					},
					{
						status: '100',
						name: '已通过',
					},
					{
						status: '2',
						name: '申诉中',
					},
				],
				taskLists: [],
				taskListsParams: {
					task_id:0,
					status: 'all',
					page: 1,
				},
			};
		},
		onLoad(options) {
			this.taskListsParams.task_id = options.task_id;
			this.getLists();
		},
		methods: {
			changeTabs(e) {
				this.taskListsParams.status = e.status;
				this.taskListsParams.page = 1;
				this.getLists();
			},
			toDetail(id) {
				uni.navigateTo({
					url: '/pages/task/receive/detail/detail?task_receive_id=' + id
				})
			},

			toPages(url) {
				uni.navigateTo({
					url: url
				});
			},
			getLists() {
				taskerReceiveLists(this.taskListsParams).then(res => {
					console.log(res);
					this.taskLists = res.data;
				})
			},
			cancelTask(id) {
				taskReceiveCancel({
					taskReceiveid: id
				}).then(res => {
					console.log(res);
					this.taskLists = res.data;
				})
			},
		}
	}
</script>

<style lang="scss">
	.footer {
		position: fixed;
		bottom: 20rpx;
		left: 0;
		display: flex;
		width: 100%;
		justify-content: center;
	}
	.user-info{
		font-size: 24rpx;
	}
	.task-warp {
		padding: 20rpx 20rpx;

		.task-item {
			align-items: center;
			display: flex;

			.image {
				height: 100%;
				width: 120rpx;
				display: flex;
				align-items: center;
				justify-content: center;
			}

			.mid {
				flex: 1;
				padding: 10rpx;

				.title {
					color: #333;
					font-size: 30rpx;
					font-weight: bold;

				}

				.desc {
					margin-top: 6rpx;
					color: #787878;
					font-size: 22rpx;
				}

				.mid-info {
					margin-top: 12rpx;
					display: flex;

					.tag {
						padding-left: 10px;
					}
				}

			}

			.left {
				display: flex;
				height:120rpx;
				align-items: center;
				flex-direction:column;
				justify-content: space-between;
				.status-box {
					color: #787878;
					font-size: 22rpx;
				}
				.create_time{
					
				}
				.left-box {
					display: flex;
					flex-direction: column;
					justify-content: space-around;
					align-items: center;
					height: 110rpx;

					.endtime {
						color: #787878;
						font-size: 22rpx;
					}
				}
			}

		}

		.task-item {
			height: 160rpx;
			background-color: white;
			overflow: hidden;
			border-radius: 20rpx;
			margin-bottom: 30rpx;
			padding: 20rpx;
		}
	}

	.warp {
		.header {
			background-color: white;
			overflow: hidden;
		}
	}
</style>
