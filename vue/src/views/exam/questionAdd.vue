<template>
	<el-drawer title="添加题库" v-model="drawer" size="100%"  @closed="$emit('closed')">
		<el-container >
			<el-main style="padding:0 20px 20px 20px">
				<el-form ref="form" :model="form" :rules="rules" label-width="100px" label-position="top">
					<sc-title title="标题"></sc-title>
							<el-form-item label="" prop="name">
								<el-input type="textarea" v-model="form.title" placeholder="请输入中文描述标题"></el-input>
							</el-form-item>
					<sc-title title="题目选项"></sc-title>
					<el-form-item prop="column" style="width: 100%">
						<sc-form-table v-model="form.detail" :addTemplate="addTemplate" drag-sort placeholder="暂无数据">
							<el-table-column prop="label"  width="auto" label="选项文字">
								<template #default="scope">
									<el-input v-model="scope.row.title" placeholder="请输入名称"></el-input>
								</template>
							</el-table-column>
							<el-table-column  prop="fixed"  label="题目分数"  width="auto">
								<template #default="scope">
									<el-input v-model="scope.row.score" placeholder="请输入宽度"></el-input>
								</template>
							</el-table-column>
						</sc-form-table>
					</el-form-item>
				</el-form>
			</el-main>
			<el-footer>
				<div style="display: flex;align-items: center;justify-content: center">
					<el-button size="large" type="primary"  @click="onSubmit()"> 保 存 </el-button>
				</div>
			</el-footer>
		</el-container>
	</el-drawer>

</template>
<script>
export default {
	emits: ['success', 'closed'],
	data() {
		return {
			ruleForm:[],
			form:{
				detail:[],
			},
			rules:[],
			// 显示抽屉
			drawer: false,
			orderParams: {},
			orderData: {},
			addTemplate: {
				id:0,
				title: '',
				score: '1',
			},
		};
	},

	methods: {
		onZip() {
			this.$HTTP().params(this.orderParams).post('admin/order/order/zip').then(res => {
				window.location.href = 'https://fcbbg.feiguonet.com' + res;
			})
		},
		async show(orderParams) {
			console.log(orderParams);
			this.drawer = true;
			this.orderParams = orderParams;
			this.addDefaultColumn();
		},
		addDefaultColumn(){
			if(this.form.detail.length==0)
			this.form.detail.push(this.addTemplate);
		},
		getInfo() {
			this.$HTTP().params(this.orderParams).post("/admin/order/order/detail").then(res => {
				this.orderData = res;
			})
		},
		handleClose() {
			this.drawer = false;
		},

		getMenu() {
			this.$API.menu.tree().then((res) => {
				this.menus = res.data;
			});
		},

		getSystemInfo() {
			this.$API.table.getSystemInfo().then((res) => {
				this.sysinfo = res.data;
			});
		},

		// 请求字典列表
		getDictType() {
			this.$API.dictType.getTypeList().then((res) => {
				this.dict = res.data;
			});
		},

		// 请求表字段
		getTableColumns() {
			this.$API.generate
				.getTableColumns({table_id: this.record.id})
				.then((res) => {
					this.columns = res.data;
				});
		},

		// 提交数据
		onSubmit() {
			this.$refs.form.validate(async (valid) => {
				if (valid) {
					this.form.columns = this.columns;
					this.saveLoading = true;
					let res = await this.$HTTP().params(this.form).post('admin/question/question/add');
					this.$emit("success");
					// this.saveLoading = false;
					// if (res.success) {
					// 	this.$emit("confirm");
					// 	this.record = null;
					this.$message.success('添加成功');
					// 	this.drawer = false;
					// } else {
					// 	this.$alert(res.message, "提示", {type: "error"});
					// }
				}
			});
		},



		// 选择模块处理
		hanldeChangeModule(val) {
			this.form.module_name = val;
		},
	},
};
</script>
<style>
.el-descriptions{
	margin-top: 20px;
}
</style>
<style scoped lang="scss">
.container {
	padding: 0 0 0px 10px;
	height: 100%;
	display: flex;
	justify-content: center;
	flex-direction: column;

	.container-box {
		//width: 96%;

		height: calc(100% - 50px);
		overflow-x: hidden;
	}

	.container-end {
		height: 50px;
		display: flex;
		justify-content: center;
	}
}

</style>
