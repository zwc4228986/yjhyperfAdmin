<template>
	<el-drawer title="订单信息" v-model="drawer" size="80%">
		<div class="container setMenuRoles">
			<div class="container-box">
				<el-descriptions title="基本信息"  :border="true" >
					<el-descriptions-item :label="orderData.user_type_format">{{ orderData.name }}</el-descriptions-item>
					<el-descriptions-item label="联系电话">{{ orderData.tel }}</el-descriptions-item>
					<el-descriptions-item label="房屋面积">{{ orderData.house_area }}</el-descriptions-item>
					<el-descriptions-item label="挂牌总价">
						{{ orderData.house_listing_price }}
					</el-descriptions-item>
					<el-descriptions-item label="产权年限">{{ orderData.house_years }}</el-descriptions-item>
					<el-descriptions-item label="业态类型">
						<el-tag size="small">{{ orderData.house_type_format }}</el-tag>
					</el-descriptions-item>
					<el-descriptions-item label="拍摄类型">
						<el-tag size="small">{{ orderData.photo_type_format }}</el-tag>
					</el-descriptions-item>
<!--					<el-descriptions-item label="装修情况">-->
<!--						<el-tag size="small">{{ orderData.house_renovation }}</el-tag>-->
<!--					</el-descriptions-item>-->
				</el-descriptions>

				<el-descriptions title="增值服务"  :border="true" >
					<el-descriptions-item label="是否将系统默认的AI机器人配音升级为真人配音">{{ orderData.is_real_person_format  }}
					</el-descriptions-item>
					<el-descriptions-item label="是否做同步户型图跟踪">{{ orderData.is_sysc ? '是' : '否' }}</el-descriptions-item>
					<el-descriptions-item label="是否追加平台广告">{{orderData.is_ad_format}}</el-descriptions-item>
					<el-descriptions-item label="是否加急">{{ orderData.is_accelerate ? '是' : '否' }}</el-descriptions-item>

				</el-descriptions>

				<el-descriptions title="卖点"  :border="true" >
					<el-descriptions-item :label="item.maidian.name" v-for="item in orderData.order_maidian" :key="item.index">{{ item.nums }}
					</el-descriptions-item>

				</el-descriptions>

				<el-descriptions  :border="true" :title="item.maidian.name" v-for="item in orderData.order_maidian_desc"
								 :key="item.index" direction="vertical">
					<el-descriptions-item label="描述">
						{{ item.desc }}
					</el-descriptions-item>
					<el-descriptions-item label="图片" v-if="item.images_format.length>0">
						{{ item.image }}
						<el-image
							v-for="vv in item.images_format"
							:key="vv.index"
							style="width: 100px; height: 100px"
							:src="vv.full_path"
							:preview-src-list="[vv.full_path]"
							:initial-index="4"
							fit="cover"
						>
						</el-image>
					</el-descriptions-item>
					<el-descriptions-item label="视频" v-if="item.vedio_format.length>0">
						<yjVideo
							style="height: 120px;"
							v-for="vv in item.vedio_format"
							:src="vv.full_path"
							:key="vv.id"
						>
						</yjVideo>
					</el-descriptions-item>
				</el-descriptions>
			</div>
			<div class="container-end">
				<el-button type="primary" size="large" @click="onZip()">一键打包下载资源</el-button>
				<el-button type="primary" size="large" @click="onExcel()">导出EXCEL</el-button>
			</div>

		</div>

	</el-drawer>
</template>
<script>
export default {
	emits: ["confirm"],
	data() {
		return {
			// 显示抽屉
			drawer: false,
			orderParams: {},
			orderData: {},
		};
	},

	methods: {
		onZip() {
			this.$HTTP().params(this.orderParams).post('admin/order/order/zip').then(res => {
				window.location.href = 'https://fcbbg.feiguonet.com' + res;
			})
		},
		onExcel(){
			this.$HTTP().params(this.orderParams).post('export/order/run').then(res => {
				window.location.href = 'https://fcbbg.feiguonet.com' + res;
			})
		},
		async show(orderParams) {
			console.log(orderParams);
			this.drawer = true;
			this.orderParams = orderParams;
			// this.activeName = "config";
			// this.setFormValue();

			// await this.getTableColumns();
			// await this.getSystemInfo();
			await this.getInfo();
			// await this.getDictType();
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
		handleSubmit() {
			this.$refs.form.validate(async (valid) => {
				if (valid) {
					this.form.columns = this.columns;
					this.saveLoading = true;
					let res = await this.$API.generate.update(this.form);
					this.saveLoading = false;
					if (res.success) {
						this.$emit("confirm");
						this.record = null;
						this.$message.success(res.message);
						this.drawer = false;
					} else {
						this.$alert(res.message, "提示", {type: "error"});
					}
				}
			});
		},

		// 为form赋值
		setFormValue() {
			this.form.id = this.record.id;
			this.form.table_name = this.record.table_name;
			this.form.table_comment = this.record.table_comment;
			this.form.module_name = this.record.module_name;
			this.form.menu_name = this.record.menu_name;
			this.form.belong_menu_id = this.record.belong_menu_id;
			this.form.package_name = this.record.package_name;
			this.form.remark = this.record.remark;
			this.form.type = this.record.type;
			this.form.generate_type = this.record.generate_type;

			if (this.form.type == "single") {
				this.form.options = {};
			}

			if (this.form.type == "tree") {
				this.form.options = this.record.options;
			}
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
