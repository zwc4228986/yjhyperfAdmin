<template>
	<el-container>
		<el-aside width="220px" v-loading="showRolesloading">
			<el-container>
				<el-main class="nopadding">
					<el-tree
						ref="roles"
						class="menu"
						node-key="id"
						node-label="name"
						:data="roles"
						:current-node-key="0"
						:highlight-current="true"
						:expand-on-click-node="false"
						:filter-node-method="rolesFilterNode"
						@node-click="rolesClick"
					>
						<template #default="{ data }">
							  <span class="custom-tree-node">
								<span>{{ data.name }}</span>
							  </span>
						</template>
					</el-tree>
				</el-main>
			</el-container>
		</el-aside>
		<el-container>
			<!--			<el-header>-->
			<!--				<div class="left-panel">-->
			<!--				</div>-->
			<!--				<div class="right-panel">-->
			<!--					<div class="right-panel-search">-->
			<!--						<el-input v-model="queryParams.username" placeholder="搜索用户名" clearable></el-input>-->

			<!--						<el-tooltip class="item" effect="dark" content="搜索" placement="top">-->
			<!--							<el-button type="primary" icon="el-icon-search" @click="handlerSearch"></el-button>-->
			<!--						</el-tooltip>-->

			<!--						<el-tooltip class="item" effect="dark" content="清空条件" placement="top">-->
			<!--							<el-button icon="el-icon-refresh" @click="resetSearch"></el-button>-->
			<!--						</el-tooltip>-->
			<!--					</div>-->
			<!--				</div>-->
			<!--			</el-header>-->
			<el-main class="nopadding">
				<el-row style="height: 100%"  >
					<el-col style="
						height: 100%;
						display: flex;
						align-items: center;
						justify-content: center;
					  " :span="8">
						<iframe
							class="iframe-box"
							:src="imgUrl"
							frameborder="0"
							ref="iframe"
						></iframe>
					</el-col>
					<el-col :span="16">
						<el-container>
							<el-header>
								<div class="left-panel">

								</div>
								<div class="right-panel">
									<div class="right-panel-search">
										<el-input v-model="queryParams.username" placeholder="搜索用户名" clearable></el-input>

										<el-tooltip class="item" effect="dark" content="搜索" placement="top">
											<el-button type="primary" icon="el-icon-search" @click="handlerSearch"></el-button>
										</el-tooltip>

										<el-tooltip class="item" effect="dark" content="清空条件" placement="top">
											<el-button icon="el-icon-refresh" @click="resetSearch"></el-button>
										</el-tooltip>
									</div>
								</div>
							</el-header>
							<el-main class="nopadding" >
								<yjTable3
									ref="yjTable"
									:params="formParams"
									yjCode="diy"
								>
									<template 	v-slot:op>
										<el-table-column
											label="操作"
											fixed="right"
											align="right"
											width="200"
										>
											<template #default="scope">

												<el-button type="text" @click="onEdit(scope.row, scope.$index)">
													编辑
												</el-button>
												<el-button type="text" @click="handleDelete(scope.row, scope.$index)">
													删除
												</el-button>
												<el-button type="text" @click="handleDelete(scope.row, scope.$index)">
													预览
												</el-button>
												<el-button type="text" @click="handleDelete(scope.row, scope.$index)">
													设置首页
												</el-button>
											</template>
										</el-table-column>
									</template>
								</yjTable3>
							</el-main>
						</el-container>
					</el-col>
				</el-row>
			</el-main>
		</el-container>
	</el-container>

	<save-dialog v-if="dialog.save" ref="saveDialog" @success="handleSuccess" @closed="dialog.save=false"></save-dialog>
	<homepage-dialog v-if="dialog.homepage" ref="homepageDialog" @success="handleSuccess" @closed="dialog.homepage=false"></homepage-dialog>

</template>

<script>
// import saveDialog from './save'
// import homepageDialog from './setHomepage'

export default {
	name: 'system:user',
	components: {
		// saveDialog,
		// homepageDialog
	},

	data() {
		return {
			formParams:{},
			formConfig:{},
			dialog: {
				save: false,
				homepage: false
			},
			column: [
				{ label: '用户ID', prop: 'id', width: '150', hide: true },
				{ label: '手机', prop: 'phone', width: '120', hide: true  },
				{ label: '最后登录时间', prop: 'login_time', width: '200', hide: true  },
				{ label: '最后登录IP', prop: 'login_ip', width: '180', hide: true  }
			],
			povpoerShow: false,
			dateRange:'',
			showRolesLoading: false,
			rolesFilterText: '',
			roles: [],
			imgUrl:'http://tt.com:8080/static/html/pc.html?type=iframeWindow',
			apiObj:  this.$HTTP().url('admin/system/admin/lists'),
			selection: [],
			queryParams: {
				username: undefined,
				roles_id: undefined,
				maxDate: undefined,
				minDate: undefined,
				status: undefined
			},
			isRecycle: false,
		}
	},
	watch: {
		rolesFilterText(val) {
			this.$refs.roles.filter(val);
		}
	},
	mounted() {
		this.roles = [
			{id: 0, name: '商城首页'},
			{id: 1, name: '商品分类'},
			{id: 2, name: '个人中心'},
		]
	},
	methods: {
		//添加
		add(){
			this.$modalForm(this.$HTTP().post('admin/system/admin/form')).then(res=>{
				this.$refs.table.upData()
			});
		},
		//编辑
		edit({id}){
			this.$modalForm(this.$HTTP().params({id}).post('admin/system/admin/form')).then(res=>{
				this.$refs.table.upData()
			});
		},
		//查看
		show(row){
			this.dialog.save = true
			this.$nextTick(() => {
				this.$refs.saveDialog.open('show').setData(row)
			})
		},
		//批量删除
		async batchDel(){
			await this.$confirm(`确定删除选中的 ${this.selection.length} 项吗？`, '提示', {
				type: 'warning'
			}).then(() => {
				const loading = this.$loading();
				let ids = []
				this.selection.map(item => ids.push(item.id))
				if (this.isRecycle) {
					this.$API.user.realDeletes(ids.join(',')).then()
				} else {
					this.$API.user.deletes(ids.join(',')).then()
				}
				this.$refs.table.upData(this.queryParams)
				loading.close();
				this.$message.success("操作成功")
			})
		},

		// 单个删除
		async deletes(id) {
			await this.$confirm(`确定删除该用户吗？`, '提示', {
				type: 'warning'
			}).then(() => {
				const loading = this.$loading();
				if (this.isRecycle) {
					this.$API.user.realDeletes(id).then(() => {
						this.$refs.table.upData(this.queryParams)
					})
				} else {
					this.$API.user.deletes(id).then(() => {
						this.$refs.table.upData(this.queryParams)
					})
				}
				loading.close();
				this.$message.success("操作成功")
			}).catch(()=>{})
		},

		// 恢复数据
		async recovery (id) {
			await this.$API.user.recoverys(id).then(res => {
				this.$message.success(res.message)
				this.$refs.table.upData(this.queryParams)
			})
		},

		//表格选择后回调事件
		selectionChange(selection){
			this.selection = selection;
		},
		//加载树数据
		async getRoles(){
			await this.$HTTP().post('admin/system/roles/lists').then(res => {
				res.data.unshift({id: 0, name: '全部'})
				this.roles = res.data
				this.showRolesloading = false
			})
		},
		//树过滤
		rolesFilterNode(value, data){
			if (!value) return true;
			return data.label.indexOf(value) !== -1;
		},
		//树点击事件
		rolesClick(data){
			console.log('rolesClick',data);
		},

		// 初始化用户密码
		initUserPassword (id) {
			this.$confirm('确定要将用户密码设置为：123456', '提示', {
				confirmButtonText: '确定',
				cancelButtonText: '取消',
				type: 'warning'
			}).then(() => {
				this.$API.user.initUserPassword(id).then(() => {
					this.$message.success('用户密码初始化成功')
				})
			})
		},

		// 导出用户
		exportExcel () {
			this.$API.user.exportExcel(this.queryParams).then(res => {
				this.$TOOL.download(res)
			})
		},

		// 设置用户首页
		setHomepage(row) {
			this.dialog.homepage = true
			this.$nextTick(() => {
				this.$refs.homepageDialog.open().setData(row)
			})
		},

		// 更新用户缓存
		clearCache(row) {
			this.$API.user.clearCache({id: row.id}).then(() => {
				this.$message.success('该用户缓存已清空')
			})
		},

		// 选择时间事件
		handleDateChange (values) {
			if (values !== null) {
				this.queryParams.minDate = values[0]
				this.queryParams.maxDate = values[1]
			}
		},

		//搜索
		handlerSearch(){
			this.$refs.table.upData(this.queryParams)
		},

		// 切换数据类型回调
		switchData(isRecycle) {
			this.isRecycle = isRecycle
		},

		// 用户状态更改
		handleStatus (val, row) {
			console.log('handleStatus');
			const status = row.status === '0' ? '0' : '1'
			const text = row.status === '0' ? '启用' : '停用'
			this.$confirm(`确认要${text} ${row.username} 用户吗？`, '提示', {
				type: 'warning',
				confirmButtonText: '确定',
				cancelButtonText: '取消'
			}).then(() => {
				this.$API.user.changeStatus({ id: row.id, status }).then(() => {
					this.$message.success(text + '成功')
				})
			}).catch(() => {
				row.status = row.status === '0' ? '1' : '0'
			})
		},

		resetSearch() {
			this.queryParams = {
				username: undefined,
				roles_id: undefined,
				maxDate: undefined,
				minDate: undefined,
				status: undefined
			}
			this.$refs.table.upData(this.queryParams)
		},

		//本地更新数据
		handleSuccess(){
			this.$refs.table.upData(this.queryParams)
		}
	}
}
</script>

<style scoped lang="scss">
:deep(.el-avatar--circle) {
	display: flex;
	justify-content: center;
	align-items: center;
}
.iframe-box {
	width: 100%;
	height: 100%;
	border-radius: 10px;
	border: 1px solid #eee;
}

</style>
