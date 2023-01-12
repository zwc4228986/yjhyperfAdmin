<template>
  <div class="yj-search">
    <div class="left-panel">
      <search :fields="props.searchConfig.fields"></search>
    </div>

    <!-- <el-divider direction="vertical" />
		<div class="right-panel">
				<el-button
					type="primary"
					icon="el-icon-search"
					@click="onAdd()"
				>
				搜索
				</el-button> -->
    <!-- </div> -->
  </div>
</template>

<script setup>
import { defineProps, toRef, toRefs, provide } from "vue";

import search from "./index";

const props = defineProps({
  searchConfig: { type: Object, default: () => {} },
  modelValue: { type: Object, default: () => {} },
});

provide("formParams", props.modelValue);
</script>

<style scoped lang="scss">
.yj-search {
  :deep(.el-divider--vertical) {
    height: 80%;
  }
  :deep(.el-row) {
    padding: 10px 0;
  }
  display: flex;
  padding: 20px;
  background-color: #fff;
  justify-content: space-between;
  align-items: center;
  .left-panel {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .right-panel {
    justify-content: flex-end;
    display: flex;
    align-items: center;
  }
  :deep(.yj-col) {
    display: flex;
    margin-bottom: 10px;
    .label {
      flex-basis: 80px;
      display: flex;
      align-items: center;
      font-size: 14px;
      color: #666;
    }
    .slot {
      flex: 1;
      display: flex;
      align-items: center;
    }
  }
}
</style>
