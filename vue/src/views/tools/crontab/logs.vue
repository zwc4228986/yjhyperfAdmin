<!--
 * @Descripttion: 系统计划任务配置
 * @version: 1.0
 * @Author: sakuya
 * @Date: 2021年7月7日09:28:32
 * @LastEditors:
 * @LastEditTime:
-->

<template>
  <el-container>
    <el-main style="padding: 0 20px">
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

  <el-drawer
    title="日志"
    v-model="logsVisible"
    :size="500"
    direction="rtl"
    destroy-on-close
  >
    <el-main style="padding: 0 20px 20px 20px">
      <pre
        style="
          font-size: 12px;
          color: #999;
          padding: 20px;
          background: #333;
          font-family: consolas;
          line-height: 1.5;
          overflow: auto;
        "
        >{{ demoLog }}</pre
      >
    </el-main>
  </el-drawer>
</template>


<script setup>
import http from "@/utils/request";
import {
  ref,
  reactive,
  h,
  render,
  toRefs,
  createVNode,
  resolveComponent,
  defineComponent,
  onBeforeMount,
  onMounted,
} from "vue";

const props = defineProps({
  crontab_id: { type: Number },
});

const state = reactive({
  yjCode: "crontab/logs",
  formParams: {
    keyword: "",
    crontab_id: props.crontab_id,
  },
  tableData: [],
  selection: [],
  formConfig: {},
});

// var formConfig = reactive({});

const yjCode = ref("crontab/log");

const getLists = () => {
  http()
    .params({
      crontab_id: props.crontab_id,
    })
    .post("admin/crontab/log/lists")
    .then((res) => []);
};

onMounted(async () => {
  //   getLists();
  state.formConfig = await http().post(`/form/${yjCode.value}/config`);
});

const { formConfig, formParams } = toRefs(state);
</script>
<style>
</style>