<template>
	<el-container>
		<el-aside width="300px" v-loading="menuloading">
			<el-container>
				<el-header>
					<el-input
						placeholder="输入关键字进行过滤"
						v-model="menuFilterText"
						clearable
					></el-input>
				</el-header>
				<el-main class="nopadding menus-contanier">
					<el-tree
						default-expand-all
						ref="menu"
						class="menu"
						node-key="id"
						:data="menuList"
						:props="menuProps"
						draggable
						highlight-current
						:expand-on-click-node="false"
						check-strictly
						show-checkbox
						:filter-node-method="menuFilterNode"
						@node-click="menuClick"
						@node-drop="nodeDrop"
					>
						<template #default="{ node, data }">
							<span class="custom-tree-node">
								<span class="label">
									{{ node.label }}
								</span>
								<el-icon class="do" :size="14" @click.stop="onAdd(node, data)"><el-icon-plus /></el-icon>

							</span>
						</template>
					</el-tree>
				</el-main>
				<el-footer style="height: 51px">
					<el-button
						type="primary"
						size="mini"
						icon="el-icon-plus"
						@click="onAdd()"
					></el-button>
					<el-button
						type="danger"
						size="mini"
						plain
						icon="el-icon-delete"
						@click="delMenu"
					></el-button>
				</el-footer>
			</el-container>
		</el-aside>
		<el-container>
			<el-main class="nopadding" style="padding: 20px" ref="main">
				<save ref="save" :menu="menuList"></save>
			</el-main>
		</el-container>
	</el-container>
</template>

<script>
let newMenuIndex = 1;
import save from "./save";

export default {
	name: "settingMenu",
	components: {
		save,
	},
	data() {
		return {
			menuloading: false,
			menuList: [],
			menuProps: {
				label: (data) => {
					return data.title;
				},
			},
			menuFilterText: "",
		};
	},
	watch: {
		menuFilterText(val) {
			this.$refs.menu.filter(val);
		},
	},
	mounted() {
		console.log('getMenu');
		this.getMenu();
	},
	methods: {
		//加载树数据
		async getMenu() {
			this.menuloading = true;
			var res = await this.$API.system.menu.list.get();
			this.menuloading = false;
			this.menuList = res;
		},
		//树点击
		menuClick(data, node) {
			var pid = node.level == 1 ? undefined : node.parent.data.id;
			this.$refs.save.setData(data, pid);
			this.$refs.main.$el.scrollTop = 0;
		},
		//树过滤
		menuFilterNode(value, data) {
			if (!value) return true;
			var targetText = data.meta.title;
			return targetText.indexOf(value) !== -1;
		},
		//树拖拽
		nodeDrop(draggingNode, dropNode, dropType) {
			console.log(draggingNode, dropNode, dropType)
			console.log(draggingNode.data.id, dropNode.data.id, dropType);
			this.$HTTP().params({menu_id:draggingNode.data.id,target_menu_id:dropNode.data.id,types:dropType}).post('/admin/menu/set-position').then(res=>{

			});
			this.$refs.save.setData({});
			this.$message(
				`拖拽对象：${draggingNode.data.meta.title}, 释放对象：${dropNode.data.meta.title}, 释放对象的位置：${dropType}`
			);
		},
		//增加
		async onAdd(node, data) {
			var newMenuName = "未命名" + newMenuIndex++;
			var newMenuData = {
				pid: data ? data.id : 0,
				name: newMenuName,
				path: "",
				component: "",
				title: newMenuName,
				type: "menu",
			};
			this.menuloading = true;
			var res = await this.$HTTP()
				.showSuccessInfo("添加成功")
				.params(newMenuData)
				.post("/admin/menu/add")
				.catch((res) => {
					this.getMenu();
				});

			this.menuloading = false;
			this.getMenu();
			// newMenuData.id = res.data
			// this.$refs.menu.append(newMenuData, node)
			// this.$refs.menu.setCurrentKey(newMenuData.id)
			// var pid = node ? node.data.id : 0
			// this.$refs.save.setData(newMenuData, pid)
		},
		//删除菜单
		async delMenu() {
			var CheckedNodes = this.$refs.menu.getCheckedNodes();
			if (CheckedNodes.length == 0) {
				this.$message.warning("请选择需要删除的项");
				return false;
			}
			var confirm = await this.$confirm(
				"确认删除已选择的菜单吗？",
				"提示",
				{
					type: "warning",
					confirmButtonText: "删除",
					confirmButtonClass: "el-button--danger",
				}
			).catch(() => {});
			if (confirm != "confirm") {
				return false;
			}

			this.menuloading = true;
			var reqData = {
				ids: CheckedNodes.map((item) => item.id),
			};
			var res = await this.$API.demo.post.post(reqData);
			this.menuloading = false;

			if (res.code == 200) {
				CheckedNodes.forEach((item) => {
					var node = this.$refs.menu.getNode(item);
					if (node.isCurrent) {
						this.$refs.save.setData({});
					}
					this.$refs.menu.remove(item);
				});
			} else {
				this.$message.warning(res.message);
			}
		},
	},
};
</script>

<style scoped>
.custom-tree-node {display: flex;flex: 1;align-items: center;justify-content: space-between;font-size: 14px;padding-right: 24px;height:100%;}
.custom-tree-node .label {display: flex;align-items: center;;height: 100%;}
.custom-tree-node .label .el-tag {margin-left: 5px;}

	;L.custom-tree-node .do i {margin-left:5px;color: #999;padding:5px;}
.custom-tree-node .do i:hover {color: #333;}

+.custom-tree-node:hover .do {display: inline-block;}

.menus-contanier ::v-deep(.el-tree-node__label) {
	width: 100%!important;
}
</style>
