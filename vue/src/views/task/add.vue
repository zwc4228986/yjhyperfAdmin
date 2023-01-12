<template>
  <el-drawer title="添加任务" v-model="drawer" size="70%">
    <el-container>
      <el-main style="padding: 0 20px 20px 20px">
        <el-form
          ref="form"
          :model="form"
          :rules="rules"
          label-width="100px"
          label-position="top"
        >
          <el-form-item label="产品图标" prop="name">
            <yj-upload
              :imageId="form.image_id"
              v-model="form.image_id"
            ></yj-upload>
          </el-form-item>
          <el-form-item label="产品类型" prop="name">
            <el-select v-model="form.task_types_id" placeholder="">
              <el-option
                v-for="(item, index) in formTypes"
                :label="item.title"
                :value="item.id"
                v-bind:key="index"
              ></el-option>
            </el-select>
          </el-form-item>
          <el-form-item label="产品名称" prop="name">
            <el-input
              v-model="form.product_name"
              placeholder="产品名称"
            ></el-input>
          </el-form-item>
          <el-form-item label="任务名称" prop="name">
            <el-input v-model="form.title" placeholder="任务名称"></el-input>
          </el-form-item>
          <el-form-item label="任务描述" prop="name">
            <el-input v-model="form.desc" placeholder="任务描述"></el-input>
          </el-form-item>
          <el-form-item label="任务需知" prop="name">
            <el-input v-model="form.notice" placeholder="任务需知"></el-input>
          </el-form-item>
          <el-form-item label="任务审核周期" prop="name">
            <el-input-number
              v-model="form.audit_cycle"
              placeholder="任务审核周期"
            ></el-input-number>
          </el-form-item>
          <el-form-item label="任务提交周期" prop="name">
            <el-input-number
              v-model="form.submit_cycle"
              placeholder="任务提交周期"
            ></el-input-number>
          </el-form-item>
          <el-form-item label="投放单价" prop="name">
            <el-input
              v-model="form.one_price"
              placeholder="投放单价"
            ></el-input>
          </el-form-item>
          <el-form-item label="投放数量" prop="name">
            <el-input v-model="form.stock" placeholder="投放数量"></el-input>
          </el-form-item>
          <el-form-item label="结束时间" prop="name">
            <el-date-picker
              v-model="form.end_time"
              value-format="YYYY-MM-DD"
              placeholder="结束时间"
            ></el-date-picker>
          </el-form-item>
          <el-form-item label="任务步骤" prop="name">
            <div class="step-box">
              <div
                class="step-box-item"
                v-for="(item, index) in task_steps"
                v-bind:key="index"
              >
                <div class="step-box-item-header">
                  <div class="index">
                    {{ index + 1 }}
                  </div>
                  <div class="title">
                    {{ item.title }}
                  </div>
                  <div class="op">
                    <el-button @click="deleteStep(index)" size="small"
                      >删除</el-button
                    >
                  </div>
                </div>
                <div class="step-box-item-mid">
                  <div
                    class="step-box-item-box"
                    v-for="(v, k) in item.task_steps_rules"
                    v-bind:key="k"
                  >
                    <div class="label">
                      {{ v.title }}
                    </div>
                    <div class="value">
                      <el-input
                        type="textarea"
                        v-if="v.type == 'textarea'"
                        v-model="v.value"
                        :placeholder="v.desc"
                      >
                      </el-input>
                      <el-input
                        v-if="v.type == 'input' || v.type == 'url'"
                        v-model="v.value"
                        :placeholder="v.desc"
                      >
                      </el-input>
                      <template
                        v-if="v.type == 'picture' || v.type == 'screenshot'"
                      >
                        <yj-upload
                          :imageId="v.value"
                          v-model="v.value"
                        ></yj-upload>
                      </template>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </el-form-item>
          <div class="add-step">
            <el-dropdown @command="selectTypes">
              <el-button type="primary">
                添加步骤
                <el-icon class="el-icon--right"><arrow-down /> </el-icon>
              </el-button>
              <template #dropdown>
                <el-dropdown-menu>
                  <el-dropdown-item
                    v-for="(item, index) in list"
                    v-bind:key="index"
                    :command="item.types"
                    >{{ item.name }}</el-dropdown-item
                  >
                </el-dropdown-menu>
              </template>
            </el-dropdown>
          </div>
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
  emits: ["success", "closed", "reflush"],
  data() {
    return {
      task_steps: [],
      ruleForm: [],
      form: {
        task_id: 0,
        task_types_id: "",
        product_name: "",
        title: "",
        desc: "",
        image_id: 0,
        notice: "",
        info: "",
        submit_cycle: 0,
        audit_cycle: 0,
      },
      list: [
        {
          name: "网页链接",
          types: "url",
        },
        {
          name: "图文描述",
          types: "picture",
        },
        {
          name: "提交截图",
          types: "screenshot",
        },
        {
          name: "复制口令/邀请码",
          types: "code",
        },
      ],
      formTypes: [],
      rules: [],
      // 显示抽屉
      drawer: false,
      params: {},
      task_id: 0,
      orderData: {},
      addTemplate: {
        id: 0,
        title: "",
        score: "1",
      },
    };
  },
  methods: {
    closed() {},
    onZip() {
      this.$HTTP()
        .params(this.orderParams)
        .post("admin/order/order/zip")
        .then((res) => {
          window.location.href = "https://fcbbg.feiguonet.com" + res;
        });
    },
    selectTypes(types) {
      this.addStep(types);
    },
    addStep: function (type) {
      let titles = {
        url: "网站链接",
        picture: "图文说明",
        screenshot: "提交截图",
        code: "任务说明",
      };
      let step = {
        id: 0,
        title: titles[type],
        types: type,
        task_steps_rules: [],
      };

      step.task_steps_rules.push({
        type: "textarea",
        title: "步骤说明",
        desc: "请说明打开网页或复制口令的注意事项",
        field: "content",
        value: "",
      });

      switch (type) {
        case "url":
          step.task_steps_rules.push({
            type: "url",
            title: "输入网址",
            desc: "请在此处填写任务链接",
            field: "url",
            value: "",
          });
          break;
        case "picture":
          step.task_steps_rules.push({
            type: "picture",
            title: "请上传图片",
            desc: "请在此处填写任务链接",
            field: "picture",
            value: "",
          });
          break;
        case "screenshot":
          step.task_steps_rules.push({
            type: "screenshot",
            title: "上传示意图",
            desc: "",
            field: "screenshot",
            value: "",
          });
          break;
        case "code":
          step.task_steps_rules.push({
            type: "input",
            title: "请输入需要复制的内容",
            desc: "请在此填写口令或邀请码",
            field: "code",
            value: "",
          });
          break;
        default:
          break;
      }
      this.task_steps.push(step);
    },
    deleteStep: function (index) {
      this.task_steps.splice(index, 1);
    },
    getFormTypes() {
      this.$HTTP()
        .post("admin/task/type/lists")
        .then((res) => {
          this.formTypes = res.data;
        });
    },
    async show(id) {
      this.drawer = true;
      console.log(id);
      this.task_id = id;
      this.getFormTypes();
      if (id) {
        this.$HTTP()
          .params({ task_id: id })
          .post("admin/task/task/detail")
          .then((res) => {
            this.form = this.collect(res)
              .only([
                "id",
                "types",
                "product_name",
                "title",
                "image_id",
                "desc",
                "task_types_id",
                "notice",
                "submit_cycle",
                "audit_cycle",
                "one_price",
                "stock",
                "end_time_format",
              ])
              .pipe((item) => {
                return item.prepend(item.get("end_time_format"), "end_time");
              })
              .all();
            this.task_steps = res.task_steps;

            console.log(this.form);
          });
      } else {
        this.task_id = 0;
        this.form = {
          task_id: 0,
          task_types_id: "",
          product_name: "",
          title: "",
          image_id: 0,
          desc: "",
          notice: "",
          info: "",
        };
        this.task_steps = [];
      }
    },
    addDefaultColumn() {},
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
    getAction() {
      return this.form.id
        ? "admin/question/question/edit"
        : "admin/question/question/add";
    },
    // 提交数据
    async onSubmit() {
      this.saveLoading = true;
      this.form.task_steps = this.task_steps;
      if (this.task_id) {
        this.form.task_id = this.task_id;
        let res = await this.$HTTP()
          .params(this.form)
          .post("/admin/task/task/edit");
        this.$emit("reflush");
        this.$message.success("编辑成功");
      } else {
        let res = await this.$HTTP()
          .params(this.form)
          .post("/admin/task/task/add");
        this.$emit("reflush");
        this.$message.success("添加成功");
        this.drawer = false;
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
.step-box {
  // display: flex;
  width: 100%;
  .step-box-item {
    padding-bottom: 20rpx;
  }

  .step-box-item-header {
    display: flex;
    width: 100%;
    justify-content: space-between;
    align-items: center;
    .title {
      flex: 1;
      padding: 15rpx;
      font-size: 28rpx;
      font-weight: bold;
    }
    .index {
      border: 1px solid #000;
      border-radius: 50%;
      height: 20px;
      width: 20px;
      margin-right: 10px;
      font-size: 24rpx;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  }

  .step-box-item-mid {
    padding-left: 50rpx;

    .step-box-item-box {
      font-size: 26rpx;

      .label {
        padding: 10rpx 0;
      }
    }
  }
}

.add-step {
  display: flex;
  justify-content: center;
  margin-top: 30rpx;
  .add-step-button {
    width: 100px;
  }
}
</style>
