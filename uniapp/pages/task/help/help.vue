<template>
	<view class="container">
		
		<view class="content">
			<view class="help-box" v-for="item in task_help_lists" :key="item.id">
				<view class="help-box-title">{{item.title}}</view>
				<view class="help-box-content">
					<view class="item" v-for="v in item['task_help']">
						<view class="item-content" @click="toDetail(v.id,v.title)">
							<text>{{v.title}}</text>
							<uni-icons type="right"></uni-icons>
						</view>
					</view>
				</view>
			</view>
		</view>

		
		<view class="contact">
			<image src="/static/images/task/help/contact.png" />
		</view>
		
<!-- 		  <u-collapse
		    @change="change"
		    @close="close"
		    @open="open"
		  >
		    <u-collapse-item
			 v-for="item in task_help_lists"
		      :title="item.title"
		      :name="item.title"
		    >
		      <text class="u-collapse-content">{{item.content}}</text>
		    </u-collapse-item>
		  </u-collapse> -->
	</view>
</template>

<script>
	import {apiTaskHelpLists} from "@/api/task/help.js"
	export default {
		data() {
			return {
				task_help_lists:[],
			};
		},
		onLoad(){
			this.getLists();
		},
		methods:{
			toDetail(id,title){
				uni.navigateTo({
					url:'/pages/task/help/detail?id='+id+'&title='+title,
				})
			},
			getLists(){
				apiTaskHelpLists({}).then(res=>{
					this.task_help_lists =res;
				})
			}
		}
	}
</script>

<style lang="scss">
	page{
		background-color: #F58325;
	}
</style>

<style lang="scss" scoped>
	.container {
		position: relative;
		border-radius: 20rpx 20rpx 0 0;
		padding-top: 20rpx;
		padding-bottom: 20rpx;
		background-color: #fff;
		height:100vh;
		
		.content {
			.help-box {
				background-color: #F7F7F7;
				padding-bottom: 28rpx;
				
				&:last-child {
					padding-bottom: 0;
				}
			
				&-title {
					padding-left: 32rpx;
					padding-top: 30rpx;
					position: relative;
					background-color: #fff;
					height: 62rpx;
					font-size: 28rpx;
					font-family: PingFang SC;
					font-weight: bold;
					color: #333333;
					&::after {
						content: '';
						position: absolute;
						top: 54rpx;
						left: 32rpx;
						width: 104rpx;
						height: 18rpx;
						background: url("#{$app-url}/static/images/task/help/title.png");
					}
				}
			
				&-content {
					background: #fff;
					// padding: 24rpx 34rpx 24rpx 32rpx;
					
					.item {
						display: flex;
						justify-content: space-between;
						// margin: 24rpx 34rpx 24rpx 32rpx;;
						padding: 0 34rpx 0 32rpx;
						
						
						
						&-content {
							width: 100%;
							display: flex;
							justify-content: space-between;
							padding: 24rpx 0 24rpx 0;
							border-bottom: 1rpx solid #ccc;			
						}
						
						&:last-child {
							.item-content {
								border: none;
							}
						}
					}
				}
			
				
			}
				
		}
		
		.contact {
			margin-top: 64rpx;
			display: flex;
			justify-content: center;
			height: 75rpx;
			image {
				height: inherit;
				width: 408rpx;
			}
		}
	}
</style>