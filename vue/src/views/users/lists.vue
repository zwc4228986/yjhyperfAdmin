<template>
	<el-container>
		<el-header class="header-tabs">
			<el-tabs type="card" >
				<el-tab-pane label="全部"  name=""></el-tab-pane>
				<el-tab-pane label="微信公众号" name="1"></el-tab-pane>
				<el-tab-pane label="微信小程序" name="2"></el-tab-pane>
				<el-tab-pane label="H5" name="3"></el-tab-pane>
				<el-tab-pane label="PC" name="4"></el-tab-pane>
				<el-tab-pane label="APP" name="4"></el-tab-pane>
			</el-tabs>
		</el-header>
		<el-header>
			<div class="left-panel">
				<div class="yj-filter">
					<div class="yj-filter-item">
						<div class="yj-filter-label">
							用户等级
						</div>
						<div class="yj-filter-value">
							<el-tree-select  v-model="formParams.cate_id"  :data="productCategoryTree" >
							</el-tree-select>
						</div>
					</div>
					<div class="yj-filter-item">
						<div class="yj-filter-label">
							用户分组
						</div>
						<div class="yj-filter-value">
							<el-tree-select  v-model="formParams.cate_id"  :data="productCategoryTree" >
							</el-tree-select>
						</div>
					</div>
					<div class="yj-filter-item">
						<div class="yj-filter-label">
							用户标签
						</div>
						<div class="yj-filter-value">
							<el-tree-select  v-model="formParams.cate_id"  :data="productCategoryTree" >
							</el-tree-select>
						</div>
					</div>
					<div class="yj-filter-item">
						<div class="yj-filter-label">
							是否是付费会员
						</div>
						<div class="yj-filter-value">
							<el-tree-select  v-model="formParams.cate_id"  :data="productCategoryTree" >
							</el-tree-select>
						</div>
					</div>
					<div class="yj-filter-item">
						<div class="yj-filter-label">
							性别
						</div>
						<div class="yj-filter-value">
							<el-tree-select  v-model="formParams.cate_id"  :data="productCategoryTree" >
							</el-tree-select>
						</div>
					</div>
					<div class="yj-filter-item">
						<div class="yj-filter-label">
							身份
						</div>
						<div class="yj-filter-value">
							<el-tree-select  v-model="formParams.cate_id"  :data="productCategoryTree" >
							</el-tree-select>
						</div>
					</div>

				</div>
			</div>
			<div class="right-panel">
				<el-input v-model="formParams.keywords" placeholder="搜索用户" clearable></el-input>
				<el-tooltip class="item" effect="dark" content="搜索" placement="top">
					<el-button type="primary" icon="el-icon-search" @click="handlerSearch"></el-button>
				</el-tooltip>
			</div>
		</el-header>
		<el-main class="nopadding">
			<yjTable
				ref="yjTable"
				:data="tableData"
				:apiObj="apiObj"
				:params="formParams"
			>
				<el-table-column type="selection" width="50"></el-table-column>
				<el-table-column
					label="ID"
					prop="id"
					width="150"
				></el-table-column>
				<el-table-column
					label="昵称"
					prop="nickname"
					width="150"
				></el-table-column>
				<el-table-column label="头像" width="100">
					<template #default="scope">
						<el-avatar  :src="scope.row.wx_icon" :size="50"></el-avatar>
					</template>
				</el-table-column>
				<el-table-column
					label="手机号码"
					prop="mobile"
					width="150"
				></el-table-column>
				<el-table-column
					label="openid"
					prop="openid"
					width="250"
				></el-table-column>

				<el-table-column
					label="注册时间"
					prop="create_time"
					width="150"
				></el-table-column>
				<!-- <el-table-column
					label="操作"
					fixed="right"
					align="right"
					width="180"
				>
					<template #default="scope">
						<el-button type="text" @click="onInfo(scope.row, scope.$index)">
							详情
						</el-button>
						<el-button type="text"  v-if="scope.row.order_change_detail" @click="onChange(scope.row, scope.$index)">
							修改意见
						</el-button>
						<el-button type="text" @click="onFinish(scope.row, scope.$index)">
							制作
						</el-button>
					</template>
				</el-table-column> -->
			</yjTable>
		</el-main>
	</el-container>
	<Info ref="info"></Info>

	<Change ref="change"></Change>
</template>
<script>
	import Info from './info'
	import Change from './change'
	export default {
		name: "setting:code",
		components: {
			Info,
			Change,
		},
		data() {
			return {
				formParams: {},
				apiObj: this.$HTTP().url("/admin/users/users/list"),
				tableData: [],
				selection: [],
			};
		},
		async created() {},
		methods: {
			onChange({order_change_detail}){
				this.$refs.change.show(order_change_detail)
			},
			onInfo({id}){
				 this.$refs.info.show({'order_id':id})
			},
			delete(){

			},
			onEdit({id}){
				this.$modalForm(
					this.$HTTP().params({id}).post("/admin/banner/create")
				).then((res) => {
					 this.$refs.yjTable.upData(this.formParams)
				});
			},
			onFinish({id}){
				this.$modalForm(
					this.$HTTP().params({order_id:id}).post("/admin/order/order/finish-form")
				).then((res) => {
					 this.$refs.yjTable.upData(this.formParams)
				});
			},
			onAdd(){
				this.$modalForm(
					this.$HTTP().post("/admin/banner/create")
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
