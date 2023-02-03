<template>
	<view class="wrap">

		<u-form labelWidth="auto" labelPosition="left" :model="formData" ref="form1">
			<view class="box">
				<u-form-item required label="投放单价"  prop="userInfo.name" borderBottom ref="item1">
					<view class="tips" slot="left">
						最低0.5元
					</view>
					<u-input inputAlign="right" type="number" placeholder="请输入投放单价" v-model="formData.one_price" border="none"></u-input>
						<view style="font-size:22rpx;padding-left:10rpx;" slot="right">
							元
						</view>
				</u-form-item>
				<u-form-item required label="投放数量" prop="userInfo.name" borderBottom ref="item1">
					<view class="tips" slot="left">
						最低10单
					</view>
					<u-input inputAlign="right"  type="number"  placeholder="请输入投放数量" v-model="formData.stock" border="none"></u-input>
					<view style="font-size:22rpx;padding-left:10rpx;" slot="right">
						单
					</view>
				</u-form-item>
				<u-form-item required label="结束时间" prop="userInfo.name" borderBottom ref="item1">
					<yj-calendar v-model="formData.end_time" :maxDate="maxDate" :show="show" @confirm="confirm">
					</yj-calendar>
					<u-icon slot="right" name="arrow-right"></u-icon>
				</u-form-item>
				<u-form-item required label="提交限时" prop="userInfo.name" borderBottom ref="item1">
					<u-input inputAlign="right"  type="number"  placeholder="请输入提交限时" v-model="formData.submit_cycle" border="none">
					</u-input>
					<view style="font-size:22rpx;padding-left:10rpx;" slot="right">
						小时
					</view>
				</u-form-item>
				<u-form-item required label="审核周期" prop="userInfo.name" borderBottom ref="item1">
					<u-input inputAlign="right" type="number" placeholder="请输入审核周期" v-model="formData.audit_cycle" border="none">
					</u-input>
					<view style="font-size:22rpx;padding-left:10rpx;" slot="right">
						小时
					</view>
				</u-form-item>
			</view>
		</u-form>
		<view class="footer">
			<view class="price">
				合计：<view class="num">{{totalprice}}</view>
			</view>
			<u-button text="保存修改" :customStyle="{width:'30%'}" color="#F58527" shape="circle" @click="edit"></u-button>
		</view>
	</view>
</template>

<script>
	const d = new Date()
	const year = d.getFullYear()
	let month = d.getMonth() + 1
	month = month < 10 ? `0${month}` : month
	let date = d.getDate()
	let date_format = date < 10 ? `0${date}` : date
	import {
		taskEdit
	} from '@/api/task.js'
	export default {
		data() {
			return {
				steps: [

				],
				devices: [{
						text: '不限',
						value: '0',
					},
					{
						text: '苹果',
						value: '1',
					},
					{
						text: '安卓',
						value: '2',
					}
				],
				maxDate: `${year}-${month}-${date + 30}`,
				formData: {
					end_time: `${year}-${month}-${date_format}`,
					task_id: 0,
					one_price: 0.5,
					stock: 10,
					audit_cycle:12,
					submit_cycle:12,
				}

			}
		},
		computed:{
			totalprice:function(){
				return (this.formData.one_price*this.formData.stock).toFixed(2);
			}
		},
		onLoad(options) {
			this.formData.task_id = options.task_id;
		},
		methods: {
			edit: function() {
					
				taskEdit(this.formData).then(res => {
					this.$util.Tips({'title':'添加成功'},()=>{
							uni.redirectTo({
								url:'/pages/task/order_confirm/index?task_id='+this.formData.task_id
							})
					})
				});
			},
			addStep: function(type) {
				let step = {
					title: '网站链接',
					rules: [],
				}
				step.rules.push({
					'type': 'textarea',
					'title': '步骤说明',
					'desc': '请说明打开网页或复制口令的注意事项',
					'field': 'content',
					'value': "",
				})
				switch (type) {
					case 'url':
						step.rules.push({
							'type': 'input',
							'title': '输入网址',
							'desc': '请在此处填写任务链接',
							'field': 'url',
							'value': "",
						})
						break;
				}
				this.steps.push(step);
			},
			deleteStep: function(index) {
				this.steps.splice(index, 1);
			}
		}
	}
</script>

<style lang="scss">
	.footer{
		position: fixed;
		bottom: 0;
		width:100%;
		background: #FFFFFF;
		box-shadow: 0px 1px 9px 0px rgba(211,211,211,0.3);
		display: flex;
		align-items: center;
		padding: 20rpx 30rpx;
		.price{
			display: flex;
			flex: 1;
		}
		.price .num{
			color: #F58325;
		}
		.price .num::before{
			content: "￥";
		}
	}
	.tips{
		position: absolute;
		height: 18px;
		display: flex;
		align-items: center;
		justify-content: center;
		top: calc(50% - 9px);
		padding:0 10rpx;
		right:-90%;
		font-size: 18rpx;
		font-weight: 500;
		color: #999999;
		background: rgba(153,153,153,0.1);
	}
	.wrap {
	
	.box {
			background-color: white;
			padding: 20rpx 40rpx;
			border-radius: 20rpx;
			overflow: hidden;
			margin-bottom: 20rpx;
			padding-bottom: 30rpx;
		}
	}

	.step-box {
		.step-box-item-header {
			display: flex;
			width: 100%;
			justify-content: space-between;
			align-items: center;

			.index {
				border: 1px solid #000;
				border-radius: 50%;
				height: 40rpx;
				width: 40rpx;
				display: flex;
				align-items: center;
				justify-content: center;
			}
		}
	}

	.add-step {

		display: flex;
		justify-content: center;
		margin-top: 30rpx;

		.add-step-button {
			width: 100px;
		}
	}

	.footer {
		display: flex;
		justify-content: center;
	}
</style>
