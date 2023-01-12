<template>
  <el-container>
	  <el-header class="header-tabs">
		  <el-tabs type="card" >
			  <el-tab-pane label="出售中的商品"  name="0"></el-tab-pane>
			  <el-tab-pane label="仓库中的商品" name="1"></el-tab-pane>
			  <el-tab-pane label="已经售罄的商品" name="2"></el-tab-pane>
			  <el-tab-pane label="警戒库存商品" name="3"></el-tab-pane>
			  <el-tab-pane label="回收站的商品" name="4"></el-tab-pane>
		  </el-tabs>
	  </el-header>

	  <el-header>
		  <div class="left-panel">
			  <div class="yj-filter">
				  <div class="yj-filter-item">
					  <div class="yj-filter-label">
						商品分类
					  </div>
					  <div class="yj-filter-value">
						  <el-tree-select  v-model="formParams.cate_id"  :data="productCategoryTree" >
						  </el-tree-select>
					  </div>
				  </div>

			  </div>
		  </div>
		  <div class="right-panel">
			  <el-input v-model="formParams.keywords" placeholder="搜索商品名称" clearable></el-input>
			  <el-tooltip class="item" effect="dark" content="搜索" placement="top">
				  <el-button type="primary" icon="el-icon-search" @click="handlerSearch"></el-button>
			  </el-tooltip>
		  </div>
	  </el-header>
    <el-header>
      <div class="left-panel">
        <el-button type="primary" icon="el-icon-plus" @click="onAdd()"> 添加商品 </el-button>
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
              <!-- <el-button type="text" @click="onReport(scope.row, scope.$index)">
                查看报告
              </el-button> -->
              <el-button type="text" @click="onEdit(scope.row, scope.$index)">
                编辑
              </el-button>
              <el-button
                type="text"
                @click="handleDelete(scope.row, scope.$index)"
              >
                删除
              </el-button>
            </template>
          </el-table-column>
        </template>
      </yjTableTree>
    </el-main>
  </el-container>
  <report ref="report"></report>
</template>
<script>
import Report from "@/views/ExamTest/report";
export default {
  name: "product:product",
  components: {
    Report,
  },
  data() {
    return {
      yjCode: "productReply",
      formParams: {
		  cate_id:"",
		  keywords:'',
	  },
      tableData: [],
      selection: [],
	  productCategoryTree:[],
      formConfig: {},
    };
  },
	 watch: {
			formParams: {
				handler() {
					this.refresh();
					// this.$refs.yjTable.upData(this.queryParams)
				},
				deep: true,
			},

			immediate: true,
	},
  async created() {
    this.formConfig = await this.$HTTP().post(`/form/${this.yjCode}/config`);
	this.getProductCategory();
  },
  methods: {
	refresh() {
		  this.$refs.yjTable.upData(this.formParams);
	},
	async getProductCategory() {
		 this.productCategoryTree =await this.$HTTP().post('/admin/product/category/tree');
	},
    onReport(data) {
      this.$refs.report.show(data);
    },
    onEdit({ id }) {
		this.$router.push({
			path: '/product/add',
			query:{
				'id':id,
			}
		})
    },
    onAdd() {
		this.$router.push({
				path: '/product/add',
		})
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
      console.log();
      this.$confirm("此操作会将数据物理删除？", "提示", {
        confirmButtonText: "确定",
        cancelButtonText: "取消",
        type: "warning",
      }).then(() => {
        this.$HTTP()
          .params({ id })
          .post("admin/task/task-help/del")
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
