<template>
	<view class="wrap">
		<view class="friends-box">
			<view class="item" v-for="item in data" @click="toChat(item)">
				<view class="avatar-box">
					<u-avatar :src="item.avatar"></u-avatar>
					<u-badge :absolute="true" :offset="[-5,-5]" max="99" :value="item.unReadNum"></u-badge>
				</view>
				<view class="card-box">
					<view class="title">
						<view class="nickname">
							{{item.nickname}}
						</view>
						<view class="time">
							<view>{{item.update_time_format}}</view>
						</view>
					</view>
					<view class="content">
						
						<view class="status">
							<view class="online" v-if="item.status>0">
								[在线] 
							</view>
							<view class="unonline" v-else>
								[离线]
							</view>
						</view>
					
						<view v-if="item.message_types=='text'">
								{{item.content}}
						</view>
						<view v-if="item.message_types=='image'">
								[图片消息]
						</view>
					
					</view>
				</view>
			</view>
		</view>
	</view>
</template>

<script>
	import {ChatSession} from '@/api/task.js'
	export default {
		data() {
			return {
				data:[],
			}
		},
		methods: {
			getChatSession(){
				ChatSession({}).then(res=>{
					this.data = res;
				})
			},
			toChat(item){
				console.log(item);
				uni.navigateTo({
					url:'/pages/customer/chat?receiver_id='+item.receiver_id+'&nickname='+item.nickname
				})
			}
		},
		computed: {
		    // data(){
		        // return this.$store.state.webSocket.people;
			// }
		        // return  :value="!((voltage>>7)&1)"
		},
		onShow(){
			
			this.getChatSession()
		}
	}
</script>

<style lang="scss" >
.wrap{
	// padding: 30rpx;
	.friends-box{
		background-color: white;
		.item{
			.avatar-box{
				position: relative;
			}
			padding: 12rpx 15rpx;
			display: flex;
			align-items: center;
			.card-box{
				flex: 1;
				margin-left: 20rpx;
				.title{
					display: flex;
					justify-content: space-between;
					.time{
						color: #8f959e;
						font-size: 22rpx;
					}
					.nickname{
						font-weight: 600;
						font-size: 28rpx;
					}
				}
				.content{
					.status{
						.online{
							color: #8bc34a;
							
						}
						margin-right: 10rpx;
					}
					  display: flex;
					    line-height: 18px;
					    color: #8f959e;
					    margin-top: 3px;
					    font-weight: 300;
					    overflow: hidden;
					    white-space: nowrap;
					    text-overflow: ellipsis;
					margin-top: 10rpx;
					color: #8f959e;
					font-size: 24rpx
				}
			}
		}
	}
}
</style>
