<template>
	<view class="wrap">

		<u-form labelWidth="auto" labelPosition="top" :model="formData" :rules="rules" ref="form1">
			<view class="box">
				<u-form-item required label="产品/APP名称" prop="userInfo.name" borderBottom ref="item1">
					<u-input placeholder="请输入产品名称" v-model="formData.product_name" border="none"></u-input>
				</u-form-item>
				<u-form-item required label="任务名称" prop="userInfo.name" borderBottom ref="item1">
					<u-input placeholder="请输入任务名称" v-model="formData.title" border="none"></u-input>
				</u-form-item>
				<u-form-item required label="任务亮点描述" prop="userInfo.name" borderBottom ref="item1">
					<u-input placeholder="请输入任务亮点描述" v-model="formData.desc" border="none"></u-input>
				</u-form-item>
			</view>

			<view class="box">
				<u-form-item required label="任务需知" prop="userInfo.name" borderBottom ref="item1">
					<u-input placeholder="请输入与任务相关的提醒信息" v-model="formData.notice" border="none"></u-input>
				</u-form-item>

			</view>
			<view class="box">
				<u-form-item required label="任务步骤" prop="userInfo.name" ref="item1">
					<view class="step-box">
						<view class="step-box-item" v-for="(item,index) in task_steps">
							<view class="step-box-item-header">
								<view class="index">
									{{index+1}}
								</view>
								<view class="title">
									{{item.title}}
								</view>
								<view class="op">
									<u-button @click="deleteStep(index)" size="small" text="删除"></u-button>
								</view>
							</view>
							<view class="step-box-item-mid">

								<view class="step-box-item-box" v-for="(v,k) in item.task_steps_rules">
									<view class="label">
										{{v.title}}
									</view>
									<view class="value">
										<u-textarea v-if="v.type=='textarea'" v-model="v.value" :placeholder="v.desc">
										</u-textarea>
										<u-input v-if="v.type == 'input' || v.type == 'url'" v-model="v.value" :placeholder="v.desc">
										</u-input>
										<template v-if="v.type == 'picture' || v.type == 'screenshot'">
												
												<yj-upload
												:imageId="v.value"
												 v-model="v.value" 
												 ></yj-upload>
												 
										</template>
									</view>
								</view>
								<!-- <view class="step-box-item-box">
											<view class="label">
												请输入网址
											</view>
											<view class="value">
												<u-input v-model="value1" placeholder="请输入内容" ></u-input>
											</view>
										</view> -->
							</view>
						</view>
					</view>

					<view class="add-step">
						<yj-button size="mini" :customStyle="{width:'100px'}" class="add-step-button" bg="#F58426"
							color="#fff" shape="circle" text="+添加步骤" @click="typesShow=true"></yj-button>
					</view>
				</u-form-item>
			</view>
			<!-- <view class="box">
				<u-form-item label="文字信息" prop="userInfo.name" borderBottom>
					<u-input placeholder="如:提交手机号或用户昵称" v-model="formData.info" border="none"></u-input>
				</u-form-item>
			</view> -->
		</u-form>
		<view class="footer">
			<u-button text="下一步" :customStyle="{width:'80%'}" color="#F58426" shape="circle" @click="submit"></u-button>
		</view>
		<u-action-sheet @ :actions="list" :title="title" @close="typesShow=false" @select="selectTypes" cancelText="取消"
			:show="typesShow">
		</u-action-sheet>
	</view>
</template>

<script>
	import {
		taskerDetail,
		taskerEdit,
		taskerAdd
	} from '@/api/tasker.js'
	export default {
		data() {
			return {
				task_id:0,
				task_steps: [],
				typesShow: false,
				list: [{
						name: '网页链接',
						types: 'url'
					},
					{
						name: '图文描述',
						types: 'picture'
					},
					{
						name: '提交截图',
						types: 'screenshot'
					},
					{
						name: '复制口令/邀请码',
						types: 'code'
					}
				],
				formData: {
					task_id:0,
					task_types_id: 0,
					product_name: "抖音",
					title: "抖音点赞",
					desc: "抖音描述",
					notice: "抖音点赞",
					info: "手机号码"
				}
			}
		},
		onLoad(options) {
			if(options.task_id){
				this.task_id = options.task_id;
				this.getDetail();
			}else{
				this.formData.task_types_id = options.task_types_id;
			}
		},
		methods: {
			submit: function() {
				if(this.task_id){
					this.formData.task_steps = this.task_steps;
					this.formData.task_id = this.task_id;
					const newObject = function(formData,keys){
						console.log(formData);
						let  newObject  = {};
						keys = keys.every((key)=>{
							newObject[key] = formData[`${key}`];
							return true;
						});
						return newObject;
					}
					console.log(newObject);
					taskerEdit(newObject(this.formData,[
						'task_id',
					'product_name',
					'desc',
					'title',
					'info',
					'notice','task_steps'])).then(res => {
						this.$util.Tips({'title':'编辑成功'},function(){
								uni.navigateTo({
									url:'/pages/task/user/center'
								})
						})
					});
				}else{
					this.formData.task_steps = this.task_steps;
					taskerAdd(this.formData).then(res => {
						uni.navigateTo({
							url: '/pages/task/add_step2?task_id=' + res.id
						})
					});
				}
			},
			getDetail(){
				taskerDetail({task_id:this.task_id}).then(res=>{
					this.formData = res;
					this.task_steps = res.task_steps
				})
			},
			selectTypes({
				types
			}) {
				this.addStep(types);
			},
			addStep: function(type) {
				console.log(type);
				let titles = {
					'url':'网站链接',
					'picture':'图文说明',
					'screenshot':'提交截图',
					'code':'任务说明',
				};
				let step = {
					id:0,
					title:titles[type],
					types:type,
					task_steps_rules: [],
				}
				
				step.task_steps_rules.push({
					'type': 'textarea',
					'title': '步骤说明',
					'desc': '请说明打开网页或复制口令的注意事项',
					'field': 'content',
					'value': "",
				})
				switch (type) {
					case 'url':
						step.task_steps_rules.push({
							'type': 'url',
							'title': '输入网址',
							'desc': '请在此处填写任务链接',
							'field': 'url',
							'value': "",
						})
						break;
					case 'picture':
						step.task_steps_rules.push({
							'type': 'picture',
							'title': '输入网址',
							'desc': '请在此处填写任务链接',
							'field': 'picture',
							'value': "", 
						})
						break;
					case 'screenshot':
						step.task_steps_rules.push({
							'type': 'screenshot',
							'title': '上传示意图',
							'desc': '',
							'field': 'screenshot',
							'value': "",
						})	
						break;
					case 'code':
							step.task_steps_rules.push({
								'type': 'input',
								'title': '请输入需要复制的内容',
								'desc': '请在此填写口令或邀请码',
								'field': 'code',
								'value': "",
							})
							break;
					default:
					
						break;
				}
				this.task_steps.push(step);
			},
			deleteStep: function(index) {
				this.task_steps.splice(index, 1);
			}
		}
	}
</script>

<style lang="scss">
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
		// display: flex;
		width: 100%;
		.step-box-item {
			padding-bottom: 20rpx;
		}

		.step-box-item-header {
			display: flex;
			width: 100%;
			justify-content: space-between;
			align-items: center;
			.title {
				flex: 1;
				padding: 15rpx;
				font-size: 28rpx;
				font-weight: bold;
			}
			.index {
				border: 1px solid #000;
				border-radius: 50%;
				height: 35rpx;
				width: 35rpx;
				font-size: 24rpx;
				display: flex;
				align-items: center;
				justify-content: center;
			}
		}

		.step-box-item-mid {
			padding-left: 50rpx;
			.step-box-item-box {
				font-size: 26rpx;
				.label {
					padding: 10rpx 0;
				}
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
		margin-top: 10rpx;
		display: flex;
		justify-content: center;
	}
</style>
