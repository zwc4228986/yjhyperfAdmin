  <template>
  <el-drawer
    title="添加运费模板"
    v-model="drawer"
    size="90%"
    @closed="$emit('closed')"
  >
    <el-container>
      <el-main style="padding: 0 20px 20px 20px">
        <el-form
          ref="form"
          :model="form"
          :rules="rules"
          label-width="100px"
          label-position="top"
        >
          <sc-title title="模板名称"></sc-title>
          <el-form-item label="" prop="name">
            <el-input
              v-model="form.name"
              placeholder="请输入中文描述标题"
            ></el-input>
          </el-form-item>
          <sc-title title="计件方式"></sc-title>
          <el-form-item label="" prop="name">
            <el-radio-group v-model="form.type" class="ml-4">
              <el-radio :label="1" size="large">按件数</el-radio>
              <el-radio :label="2" size="large">按重量</el-radio>
              <el-radio :label="3" size="large">按体积</el-radio>
            </el-radio-group>
          </el-form-item>
          <el-form-item prop="column" style="width: 100%">
            <sc-form-table
              v-model="form.shipping_templates_region"
              :addTemplate="addTemplate"
              placeholder="暂无数据"
            >
              <el-table-column prop="label" min-width="320" label="可配送区域">
                <template #default="scope">
                  <el-cascader-panel
                    v-model="scope.row.areas_ids"
                    multiple
                    :options="options"
                    :props="props"
                    clearable
                  />
                </template>
              </el-table-column>
              <el-table-column prop="fixed" label="首件(个)" width="200">
                <template #default="scope">
                  <el-input-number
                    v-model="scope.row.first"
                    placeholder="请输入宽度"
                  ></el-input-number>
                </template>
              </el-table-column>
              <el-table-column prop="fixed" label="起始价" width="200">
                <template #default="scope">
                  <el-input-number
                    v-model="scope.row.first_price"
                    placeholder="请输入宽度"
                  ></el-input-number>
                </template>
              </el-table-column>
              <el-table-column prop="fixed" label="续件(个)" width="200">
                <template #default="scope">
                  <el-input-number
                    v-model="scope.row.continue"
                    placeholder="请输入宽度"
                  ></el-input-number>
                </template>
              </el-table-column>
              <el-table-column prop="fixed" label="单价" width="200">
                <template #default="scope">
                  <el-input-number
                    v-model="scope.row.continue_price"
                    placeholder="请输入宽度"
                  ></el-input-number>
                </template>
              </el-table-column>
            </sc-form-table>
          </el-form-item>
        </el-form>
      </el-main>
      <el-footer>
        <div
          style="display: flex; align-items: center; justify-content: center"
        >
          <el-button size="large" type="primary" @click="onSubmit()">
            保 存
          </el-button>
        </div>
      </el-footer>
    </el-container>
  </el-drawer>
</template>
<script>
export default {
  emits: ["success", "closed"],
  data() {
    return {
      ruleForm: [],
      form: {
        name: "",
        type: 1,
        shipping_templates_region: [],
      },
      id: 0,
      rules: [],
      // 显示抽屉
      drawer: false,
      orderParams: {},
      orderData: {},
      props: {
        value: "id",
        label: "name",
        multiple: true,
        checkStrictly: false,
      },
      options: [],
      addTemplate: {
        id: 0,
        title: "",
        score: "1",
      },
    };
  },

  methods: {
    onZip() {
      this.$HTTP()
        .params(this.orderParams)
        .post("admin/order/order/zip")
        .then((res) => {
          window.location.href = "https://fcbbg.feiguonet.com" + res;
        });
    },
    async getCityLists() {
      await this.$HTTP()
        .post("/api/system/system_city/lists")
        .then((res) => {
          this.options = res;
        });
    },
    async show(id) {
      if (id) {
        this.id = id;

        this.getDetail();
      }
      await this.getCityLists();
      this.drawer = true;
      // this.orderParams = orderParams;
      // this.getCityLists();
      // this.addDefaultColumn();
    },
    getDetail() {
      let res = this.$HTTP()
        .params({ id: this.id })
        .post("admin/shipping/shipping_templates/detail")
        .then((res) => {
          this.form = res;
        });
    },
    addDefaultColumn() {
      if (this.form.detail.length == 0) this.form.detail.push(this.addTemplate);
    },
    getInfo() {
      this.$HTTP()
        .params(this.orderParams)
        .post("/admin/order/order/detail")
        .then((res) => {
          this.orderData = res;
        });
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
        .getTableColumns({ table_id: this.record.id })
        .then((res) => {
          this.columns = res.data;
        });
    },

    // 提交数据
    onSubmit() {
      this.$refs.form.validate(async (valid) => {
        if (valid) {
          this.saveLoading = true;
          if (this.id) {
            this.form.id = this.id;
            let res = await this.$HTTP()
              .params(this.form)
              .post("admin/shipping/shipping_templates/edit");
          } else {
            let res = await this.$HTTP()
              .params(this.form)
              .post("admin/shipping/shipping_templates/add");
          }

          this.$emit("success");
          // this.saveLoading = false;
          // if (res.success) {
          // 	this.$emit("confirm");
          // 	this.record = null;
          this.$message.success("添加成功");
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
.el-descriptions {
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
