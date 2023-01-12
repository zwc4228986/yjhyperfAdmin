<template>
  <el-switch
    v-model="value"
    :disabled="disabled"
    :active-value="activeValue"
    :loading="loading"
    :inactive-value="inactiveValue"
    :before-change="onSwitchChange"
    :change="change"
  ></el-switch>
</template>
<script>
import {
  defineComponent,
  reactive,
  toRefs,
  ref,
  onMounted,
  defineEmits,
  toRaw,
  computed,
} from "vue";
import http from "@/utils/request";

export default defineComponent({
  name: "YjSwitch",
  props: {
    params: { type: Object, default: () => {} },
    data: { type: Object, default: () => {} },
  },

  setup(props, { emit }) {
    let { params, data } = toRaw(props);

    // let params = props.params;
    // let data = props.data;

    const state = reactive({
      url: params.url,
      loading: false,
      value: data[params.prop],
    });
    // console.log(state.value);
    // const emits = defineEmits(["success"]);

    let activeValue = ref(params?.attributes?.activeValue ?? 1);
    let inactiveValue = ref(params?.attributes?.inactiveValue ?? 0);

    const disabled = computed(() => {
      return !params.url;
    });
    const change = () => {
      emit("success");
    };
    const onSwitchChange = async () => {
      state.loading = true;
      let result = await http()
        .params({
          id: data.id,
          field: params.prop,
          value:
            state.value === activeValue.value
              ? inactiveValue.value
              : activeValue.value,
        })
        .post(params.url)
        .catch(() => {});
      state.loading = false;
      emit("success");
      return result;
    };

    return {
      change,
      disabled,
      onSwitchChange,
      inactiveValue,
      activeValue,
      ...toRefs(state),
    };
  },
});
</script>
<style scoped>
</style>
