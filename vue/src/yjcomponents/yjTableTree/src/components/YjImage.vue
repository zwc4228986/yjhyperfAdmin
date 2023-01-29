<template>
	{{value}}
</template>
<script>
import { defineComponent, reactive,toRefs,ref, onMounted,toRaw,watchEffec,watch} from "vue";
import {formatTimestamp} from "@/utils/date";

export default defineComponent({
	name: "YjText",
	props:{
		params: { type: Object,  default: () => {}},
		data: { type: Object,  default: () => {}},
	},
	setup(props){
		let {params,data} = toRaw(props);

		const state = reactive({
			value:"",
		});

		const deepGet = (obj, keys, defaultVal)=>{
			return (
				(!Array.isArray(keys)
				? keys.replace(/\[/g, '.').replace(/\]/g, '').split('.')
				: keys
				).reduce((o, k) => (o || {})[k], obj) || defaultVal
			);
		};

		const updateValue = (data)=>{
			let propValue = deepGet(data,params.prop,'-');
			if(params.format){
				propValue = formatTimestamp(propValue,true);
			}
			state.value = propValue;
		}
	
		watch(()=>props.data,(data)=>{
			updateValue(data);
		})

		updateValue(data);
		
		return {
			...toRefs(state)
		}
	}
});
</script>
<style scoped>

</style>
