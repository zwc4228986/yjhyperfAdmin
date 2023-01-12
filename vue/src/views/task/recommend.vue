<template>
	<el-container>
		<el-header>
			<div class="left-panel">
<!--				<el-button-->
<!--					type="primary"-->
<!--					@click="onAdd()"-->
<!--				>-->
<!--					添加-->
<!--				</el-button>-->
				<div>
					<el-radio-group v-model="formParams.status"  size="small">
						<el-radio-button label="all">全部</el-radio-button>
						<el-radio-button label="0">待付款</el-radio-button>
						<el-radio-button label="1">待审核</el-radio-button>
						<el-radio-button label="2">进行中</el-radio-button>
						<el-radio-button label="-1">已驳回</el-radio-button>
					</el-radio-group>
				</div>
			</div>

		</el-header>
		<el-main class="nopadding">
			<yjTable3
				ref="yjTable"
				:params="formParams"
				yjCode="task"
			>
				<template v-slot:nickname="row">
					{{row.row?.user?.nickname}}
<!--					<template #default="scope">-->
<!--						{{scope}}-->
<!--					</template>-->
				</template>

				<template 	v-slot:op>
					<el-table-column
						label="操作"
						fixed="right"
						align="right"
						width="auto"
					>
						<template #default="scope">
							<el-button >
								<el-button type="text" @click="onCancelRecomment(scope.row, scope.$index)">
									取消推荐
								</el-button>
							</el-button>


<!--							<el-button type="text" @click="onReport(scope.row, scope.$index)">-->
<!--								查看报告-->
<!--							</el-button>-->
<!--							<el-button type="text" @click="onEdit(scope.row, scope.$index)">-->
<!--								编辑-->
<!--							</el-button>-->
<!--							<el-button type="text" @click="handleDelete(scope.row, scope.$index)">-->
<!--								删除-->
<!--							</el-button>-->
						</template>
					</el-table-column>
				</template>

			</yjTable3>
		</el-main>
	</el-container>
	<report ref="report"></report>
</template>
<script>
	import { ElMessage, ElMessageBox } from 'element-plus'
	import Report from "@/views/ExamTest/report";
	export default {
		name: "setting:code",
		components: {
			Report
		},
		data() {
			return {
				yjCode:'exam_test',
				formParams: {
					status:"all",
					is_recomment:1,
				},
				tableData: [],
				selection: [],
				formConfig:{},
			};
		},
		watch:{
			formParams:{
				handler(){
					this.$refs.yjTable.upData()
					// this.$refs.yjTable.upData(this.queryParams)
				},
				deep:true,
			},

			immediate:true,
		},
		async created() {
			this.formConfig = await this.$HTTP().post(`/form/${this.yjCode}/config`);
		},
		methods: {
			delete(){

			},
			onCancelRecomment(row){
				this.$HTTP().params({
					task_id:row.id,
				}).post('/admin/task/task-recomment/cancel').then(res=>{
					this.refresh()
				})
			},
			refresh(){
				this.$refs.yjTable.upData(this.formParams)
			},

			onAudit(row){
					ElMessageBox.prompt('请输入审核理由', '审核', {
						confirmButtonText: '驳回',
						cancelButtonText: '通过',
					})
					.then(({ value }) => {
						this.$HTTP().params({
							task_id:row.id,
							status:-1,
							reason:value,
						}).post('/admin/task/task/audit').then(res=>{
							this.refresh()
						})
					})
					.catch(({value}) => {
						this.$HTTP().params({
							task_id:row.id,
							status:2,
							reason:'同意',
						}).post('/admin/task/task/audit').then(res=>{
							this.refresh()
						})
					})
			},
			onReport(data){
				this.$refs.report.show(data)
			},
			onEdit({id}){
				this.$modalForm(
					this.$HTTP().params({id}).post(`/form/${this.yjCode}/update`)
				).then((res) => {
					this.$refs.yjTable.upData(this.formParams)
				});
			},
			onAdd(){
				this.$modalForm(
					this.$HTTP().post(`/form/${this.yjCode}/update`)
				).then((res) => {
					 this.$refs.yjTable.upData(this.formParams)
				});
			},
			success(res){
				console.log(res);
				this.$HTTP().post('/import/school',res).then(res=>{

				});
			},
			//表格选择后回调事件
			selectionChange(selection) {
				this.selection = selection;
			},

			// 装载数据表后处理方法
			confirm() {
				this.handleSuccess();
			},

			// 批量生成
			async handleGenCodes() {
				console.log(this.$refs.preview);
				// let ids = this.selection.map((item) => item.id);
				// this.$message.info("代码生成下载中，请稍后");
				// this.generateCode(ids);
			},

			// 生成代码
			async generateCode(id) {
				this.$message.info("代码生成下载中，请稍后");
				await this.$API.generate.generate(id).then((res) => {
					if (res.message && !res.success) {
						this.$message.error(res.message);
					} else {
						this.$TOOL.download(res);
						this.$message.success("代码生成成功");
					}
				});
			},

			// 批量删除
			async handleDeleteBatch() {
				if (this.selection.length > 0) {
					let ids = this.selection.map((item) => item.id);
					await this.handleDelete(ids.join(","));
				} else {
					this.$message.error("请选择要删除的项");
				}
			},

			// 删除
			handleDelete({id}) {
				console.log();
				this.$confirm("此操作会将数据物理删除？", "提示", {
					confirmButtonText: "确定",
					cancelButtonText: "取消",
					type: "warning",
				}).then(() => {
					this.$HTTP().params({id}).post('admin/banner/delete').then((res) => {
						 this.$refs.table.upData(this.queryParams)
						this.$message.success("操作成功")
					});
				});
			},

			// 同步数据表
			handleSync(id) {
				this.$confirm(
					"此操作会导致字段设置信息丢失，确定同步吗？",
					"提示",
					{
						confirmButtonText: "确定",
						cancelButtonText: "取消",
						type: "warning",
					}
				).then(() => {
					this.$API.generate.sync(id).then((res) => {
						res.success && this.$message.success(res.message);
					});
				});
			},

			//搜索
			handlerSearch() {
				this.handleSuccess();
			},

			resetSearch() {
				this.queryParams = {
					table_name: undefined,
				};
				this.handleSuccess();
			},

			//本地更新数据
			handleSuccess() {
				this.$refs.table.upData(this.queryParams);
			},
		},
	};
</script>

<style></style>
