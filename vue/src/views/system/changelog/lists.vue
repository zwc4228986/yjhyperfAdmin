<template>
	<el-container>
		<el-header>
			<div class="left-panel">
				<el-button
				type="primary"
				icon="el-icon-plus"
				@click="onAdd()"
				>
				添加
				</el-button>
			</div>
    </el-header>
		<el-main >
			
			<el-card class="box-card" style="overflow: auto;height: 100%;" :infinite-scroll-immediate="false" v-if="formConfig" v-infinite-scroll="load">
				<el-timeline  >
				<el-timeline-item v-for="(item,index) in tableData" v-bind:key="index" :timestamp="item.create_time_format" placement="top">
				<el-card class="box-card">
					<template #header>
						<div class="card-header">
							<h2>版本：{{item.version}}</h2>
							<div>
								<el-button type="primary" class="button" @click="onEdit(item)">edit</el-button>
								<el-button type="danger" class="button"  @click="handleDelete(item)">delete</el-button>
							</div>
							
						</div>
					</template>
					<div v-html="item.content"></div>
				</el-card>
				</el-timeline-item>

			</el-timeline>

		</el-card>
		</el-main>
	</el-container>
</template>
<script>
export default {
	name: "setting:code",
	data() {
		return {
			yjCode: "system/changelog",
			formParams: {
				keyword:"",
			},

			tableData: [
			
			],
			selection: [],
			formConfig: {

			},
			page:1,
		};
	},
	computed:{
		addAuth(){
			console.log(this.formConfig,'formConfig');
			return this.formConfig?.auths?.add ?? false; 
		},
		editAuth(){
			return this.formConfig?.auths?.edit ?? false; 
		},
		deleteAuth(){
			return this.formConfig?.auths?.delete ?? false; 
		}
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
		this.load();
	},
	methods: {
		load(){
		
			this.getLists();
		},	
		refresh(){
			this.tableData = [];
			this.page=1
			this.getLists();
		},
		getLists(){
			this.$HTTP().params({page:this.page,limit:10}).post(this.formConfig.routes.lists).then(res=>{
				this.tableData = this.tableData.concat(res.data);
				this.page++;
			});
		},
		onReport(data) {
			this.$refs.report.show(data);
		},
		onEdit({ id }) {
			this.$modalForm(
				this.$HTTP().params({ id }).post(`/form/${this.yjCode}/update`)
			).then((res) => {
				this.refresh()
			});
		},
		
		onAdd() {
			this.$modalForm(this.$HTTP().post(`/form/${this.yjCode}/update`)).then(
				(res) => {
					this.refresh()
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
						this.refresh()
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

<style>
.card-header{
	display: flex;
	justify-content: space-between;
}
</style>