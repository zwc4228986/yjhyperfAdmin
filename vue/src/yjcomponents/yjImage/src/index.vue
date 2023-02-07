<template>
  <el-image :src="src"></el-image>
</template>

<script setup>
import config from "@/config/upload";

import { defineComponent, defineProps, defineEmits } from "vue";

const props = defineProps({
  modelValue: Number,
});

const emit = defineEmits(["update:modelValue"]);
//    emit('update:modelValue', false)

//    const state = {
//         id:props.modelValue
//    }

const src =
  typeof props.modelValue === "number"
    ? config.getImagePath(props.modelValue)
    : props.modelValue;
</script>

<style scoped>
</style>