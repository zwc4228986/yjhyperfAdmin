<template>
	<el-container>
		
		<el-header>
			<div class="left-panel">
				<el-button type="primary" @click="onAdd()"> 添加 </el-button>
			</div>
		</el-header>
		<el-main class="nopadding">
			<yjTableTree ref="yjTable" :params="formParams" :formConfig="formConfig">
				<template v-slot:op>
					<el-table-column
						label="操作"
						fixed="right"
						align="right"
						width="auto"
					>
						<template #default="scope">
							<el-button type="text" @click="onAudit(scope.row, scope.$index)">
								审批
							</el-button>
						</template>
					</el-table-column>
				</template>
			</yjTableTree>
		</el-main>
		<el-dialog v-model="dialogFormVisible" title="审核">
			<el-form :model="form"   :rules="rules" ref="ruleFormRef">
				<el-form-item label="原因" prop="reason" >
					<el-input v-model="form.reason" autocomplete="off" />
				</el-form-item>
			</el-form>
			<template #footer>
				<span class="dialog-footer">
					<el-button @click="onAuditComfirm(-1)">拒绝</el-button>
					<el-button type="primary" @click="onAuditComfirm(1)">同意</el-button>
				</span>
			</template>
		</el-dialog>
	</el-container>
		
</template>
<script>
export default {
	name: "setting:code",
	components: {
	},
	data() {
		return {
			dialogFormVisible:false,
			form:{
				reason:'',
			},
			rules:{
				reason: [
					{ required: true, message: '请输入原因', trigger: 'blur' },
				],
			},
			yjCode: "",
			formParams: {},
			tableData: [],
			selection: [],
			formConfig: {},
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
		this.yjCode = this.$route.path.slice(1);
		this.formConfig = await this.$HTTP().post(`/form/${this.yjCode}/config`);
	},
	methods: {
		onAudit(data){
			console.log(data);
			this.form.id = data.id;
			this.dialogFormVisible = true;
		},
		async onAuditComfirm(status){
			this.form.status=status;
			this.$refs.ruleFormRef.validate(async (valid, fields)=>{
				console.log(valid, fields);
				if (valid) {
					 this.$HTTP().params(this.form).post(`/admin/${this.yjCode}/set-status`).then(res=>{
						this.dialogFormVisible = false;
					 });
				}
			})
		},
		onReport(data) {
			this.$refs.report.show(data);
		},
		onEdit({ id }) {
			this.$modalForm(
				this.$HTTP().params({ id }).post(`/form/${this.yjCode}/update`)
			).then((res) => {
				this.$refs.yjTable.upData(this.formParams);
			});
		},
		onAdd() {
			this.$modalForm(this.$HTTP().post(`/form/${this.yjCode}/update`)).then(
				(res) => {
					this.$refs.yjTable.upData(this.formParams);
				}
			);
		},
		success(res) {
			console.log(res);
			this.$HTTP()
				.post("/import/school", res)
				.then((res) => {});
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
		handleDelete({ id }) {
			this.$confirm("此操作会将数据物理删除？", "提示", {
				confirmButtonText: "确定",
				cancelButtonText: "取消",
				type: "warning",
			}).then(() => {
				this.$HTTP()
					.params({ id })
					.post(`admin/${this.yjCode}/del`)
					.then((res) => {
						this.$refs.yjTable.upData(this.formParams);
						this.$message.success("操作成功");
					});
			});
		},
		
		// 同步数据表
		handleSync(id) {
			this.$confirm("此操作会导致字段设置信息丢失，确定同步吗？", "提示", {
				confirmButtonText: "确定",
				cancelButtonText: "取消",
				type: "warning",
			}).then(() => {
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