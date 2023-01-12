<template>
  <el-container>
    <el-header>
      <div class="left-panel">
        <el-button
          type="primary"
          icon="el-icon-plus"
          v-if="addAuth"
          @click="onAdd()"
        >
        </el-button>
      </div>
      <div class="right-panel">
        <div class="right-panel-search">
          <el-input
            v-model="formParams.keyword"
            placeholder="关键词"
            clearable
          ></el-input>
          <el-button
            type="primary"
            icon="el-icon-search"
            @click="upsearch"
          ></el-button>
        </div>
      </div>
    </el-header>
    <el-main class="nopadding">
      <yjTableTree ref="yjTable" :params="formParams" :formConfig="formConfig">
        <template v-slot:op>
          <el-table-column
            v-if="deleteAuth || editAuth"
            label="操作"
            fixed="right"
            align="right"
            width="auto"
          >
            <template #default="scope">
              <el-button
                type="text"
                v-if="editAuth"
                @click="onEdit(scope.row, scope.$index)"
              >
                编辑
              </el-button>
              <el-button
                type="text"
                v-if="editAuth"
                @click="setMenuRoles(scope.row, scope.$index)"
              >
                菜单权限
              </el-button>
              <el-button
                type="text"
                v-if="deleteAuth"
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
  <MenuPage ref="Menu"></MenuPage>
</template>
<script>
import MenuPage from "./menu";
export default {
  name: "setting:code",
  components: {
    MenuPage,
  },
  data() {
    return {
      yjCode: "",
      formParams: {
        keyword: "",
      },
      tableData: [],
      selection: [],
      formConfig: {},
    };
  },
  computed: {
    addAuth() {
      console.log(this.formConfig, "formConfig");
      return this.formConfig?.auths?.add ?? false;
    },
    editAuth() {
      return this.formConfig?.auths?.edit ?? false;
    },
    deleteAuth() {
      return this.formConfig?.auths?.delete ?? false;
    },
  },
  watch: {
    formParams: {
      handler() {
        this.$refs.yjTable.upData();
        // this.$refs.yjTable.upData(this.queryParams)
      },
      deep: true,
    },
    immediate: true,
  },
  async created() {
    this.yjCode = this.$route.path.slice(1);

    this.formConfig = await this.$HTTP().post(`/form/${this.yjCode}/config`);
  },
  methods: {
    setMenuRoles(rolesData) {
      this.$refs.Menu.show(rolesData);
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