<template>
	<view class="warp">
		<view class="common-box" >
			<view class="common-header">
				<view class="title">
					举报类型
				</view>
			</view>
			<view class="common-content">
				<view>
					 <u-radio-group
					    v-model="formData.types"
					    placement="column"
					  >
					    <u-radio
					      :customStyle="{marginBottom: '8px'}"
					      v-for="(item, index) in types"
					      :key="index"
					      :label="item.title"
					      :name="item.id"
					    >
					    </u-radio>
					  </u-radio-group>
				</view>
			</view>
		</view>
		
		<view class="common-box" >
			<view class="common-header">
				<view class="title">
					举报内容
				</view>
			</view>
			<view class="common-content">
				<u-textarea  v-model="formData.content" placeholder="请在这里详细说明您要举报的理由"   :height="100" >
					
				</u-textarea>
			</view>
			
		</view>
		
		<view class="common-box" >
			<view class="common-header">
				<view class="title">
					上传举报证据图片
				</view>
			</view>
			<view class="common-content">
				<yj-upload v-model="formData.image"></yj-upload>
			</view>
		</view>
		<view class="footer">
			<yj-button bg="#fcc62f" :customStyle="{width:'90%'}"   shape="circle"  text="提交" @click="submit"></yj-button>
		</view>
		
	</view>
</template>

<script>
	import {getTaskReportType,addTaskReport} from '@/api/task.js'
	export default {
		data() {
			return {
					types: [
				    ],
					formData:{
						types:0,
						content:"",
						image:0,
					}
			};
		},
		onLoad(){
			this.getTypes();
		},
		methods:{
			getTypes(){
				getTaskReportType({}).then(res=>{
					this.types = res;
				});
			},
			submit(){
				addTaskReport(this.formData).then(res=>{
					this.$util.Tips({title:'提交成功'},function(){
						uni.navigateBack({})
					})
				})
			}
		}
	}
</script>

<style lang="less">
.warp{
		padding: 20rpx;
}
.footer {
		position: fixed;
		bottom: 20rpx;
		left: 0;
		display: flex;
		width: 100%;
		justify-content: center;
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
	}
}
</style>
