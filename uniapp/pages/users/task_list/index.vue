<template>
	<view class="warp">
		<view class="focus">
			<view class="focus-btn acea-row row-between-wrapper">
				<view class="name">
					我的关注
				</view>
				<image class="focus-img" src="../../../static/images/task_list-focus.png"></image>
			</view>
			<view class="img">
				<image :src="`${IMAGE_URL}/static/images/task_list-topBg.png`"></image>
			</view>
		</view> 
		<view class="header">
			<u-tabs badge class="tabs" :itemStyle="{height: '162rpx'}" :activeStyle="{color: '#F58325'}" :list="tabs" :scrollable="true" @click="changeTabs">
			</u-tabs>
		</view>
		<view class="mid">
			<view class="task-warp">
				<view class="task-box">
					<view class="task-item" v-for="(item, index) in taskLists" :key="index"
						@click="toDetail(item.task_id,item.id)">
						<view class="mid">
							<view class="title">
								{{item.task.product_name}} {{item.task.title}}
							</view>
							<view class="desc">
								{{item.task.desc}}
							</view>
							<view style="display: flex;align-items: center;">
								<view class="price">
									{{item.task.one_price}}小豆
								</view>
								<view class="tag">
									<u-tag borderColor="#F58527" color="#F58527" bgcolor="#ffffff" shape="circle"
										:text="item.task.task_types.title" plain size="mini"></u-tag>
								</view>
							</view>
						</view>
						<view class="left">
							<view class="left-box" v-if="item.status == 0">
								<view class="op" @click.stop="cancelTask(item.id)">
									<u-button :custom-style="{color:'#000',height:'50rpx'}" size="small" color="#FCC704"
										shape="circle" text="取消任务"></u-button>
								</view>
								<view class="endtime">
									<u-count-down :time="item.cancel_timestamp* 1000" format="HH时mm分ss秒"></u-count-down>
								</view>
							</view>
							<view v-else class="status-box">
								<statusBox :text="item.status_format"></statusBox>
							</view>
							<view class="reason-box" v-if="item.reason">
								{{item.reason}}
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
			IMAGE_URL
		} from "@/config/app.js";
	import statusBox from "@/components/status-box.vue"
	import {
		taskReceiveLists,
		taskReceiveCancel
	} from "@/api/task.js"

	export default {
		components: {
			statusBox
		},
		data() {
			return {
				IMAGE_URL:IMAGE_URL,
				tabs: [{
						status: 'all',
						name: '全部'
					}, {
						status: '0',
						name: '进行中',
						badge: {
							value: 5,
						}
					}, {
						status: '10',
						name: '待审核',
					}, {
						status: '100',
						name: '已成功',
					},
					{
						status: '-1',
						name: '未成功',
					},
					{
						status: '5',
						name: '可补交',
					},
				],
				taskLists: [],
				taskListsParams: {
					status: 'all',
					page: 1,
				},
			};
		},
		onLoad() {
			this.getLists();
		},
		methods: {
			changeTabs(e) {
				this.taskListsParams.status = e.status;
				this.taskListsParams.page = 1;
				this.getLists();
			},
			toDetail(id, task_receive_id) {
				uni.navigateTo({
					url: '/pages/task/detail?task_id=' + id + '&task_receive_id=' + task_receive_id
				})
			},

			toPages(url) {
				uni.navigateTo({
					url: url
				});
			},
			getLists() {
				taskReceiveLists(this.taskListsParams).then(res => {
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

	.task-warp {

		// margin-top: 20rpx;
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
				padding: 20rpx;

				.title {
					color: #333;
					font-size: 30rpx;
					font-weight: bold;

				}

				.desc {
					margin-top: 6rpx;
					color: #999999;
					font-size: 22rpx;
					margin-bottom: 20rpx;
				}

				.price {
					font-weight: bold;
					color: #EA3C3C;
					margin-right: 10rpx;
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
				align-items: center;
				flex-direction: column;

				.status-box {
					color: #787878;
					font-size: 22rpx;
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

			.reason-box {
				padding: 5rpx 10rpx;
				background: #F58325;
				color: #fff;
				font-size: 24rpx;
				margin-top: 20rpx;
				border-radius: 8rpx;
			}

		}

		.task-item {
			background-color: white;
			overflow: hidden;
			margin-top: 30rpx;
			padding: 20rpx;
		}
	}

	.warp {
		.focus {
			position: relative;

			.focus-btn {
				position: absolute;
				top: 70rpx;
				bottom: 0;
				right: 0;
				width: 148rpx;
				height: 50rpx;
				background: #FFFFFF;
				border-radius: 25rpx 0 0 25rpx;
				padding: 16rpx 20rpx;

				.name {
					height: 20rpx;
					line-height: 20rpx;
					font-size: 20rpx;
					font-weight: 400;
					color: #333333;
				}

				.focus-img {
					width: 25rpx;
					height: 23rpx;

					image {
						width: 100%;
						height: 100%;
					}
				}
			}

			.img {
				width: 750rpx;
				height: 204rpx;

				image {
					width: 100%;
					height: 100%;
				}
			}

		
		}

		.header {
			// background-color: white;
			overflow: hidden;
			border-radius: 20rpx 20rpx 0 0;
			transform: translateY(-20rpx);
			.tabs {
				overflow: hidden;
				border-radius: 20rpx 20rpx 0 0;
				
				.u-tabs {
					.u-tabs__wrapper {
						.u-tabs__wrapper__scroll-view-wrapper {
							.u-tabs__wrapper__scroll-view {
								.u-tabs__wrapper__nav {
									.u-tabs__wrapper__nav__item {
										display: flex;
										flex-direction: column-reverse;
										justify-content: center;
										.u-badge {
											background-color: transparent;
											color: #000000;
											font-size: 32rpx;
											font-family: DIN;
											font-weight: 400;
											height: 86rpx;
											line-height: 86rpx;
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
</style>
