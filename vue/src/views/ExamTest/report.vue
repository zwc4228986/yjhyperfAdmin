<template>
	<el-drawer title="预览" v-model="drawer" size="50%"  @closed="$emit('closed')">
		<iframe :src="url" width="100%" height="100%" frameborder="0" />
	</el-drawer>
</template>

<script>
export default {
	name: "report",
	emits: ['success', 'closed'],
	data() {
		return {
			data:{},
			drawer:false,

		};
	},
	computed:{
		url:function () {
			return this.data.url+'&is_show_report=1&random='+Math.random();
		}
	},
	methods: {
		async show(data) {
			this.drawer = true;
			this.data = data;
			console.log(this.data);
			// this.src = SettingMer.httpUrl + '/?random=' + Math.random() + '&id=' + this.id
		},
	}
}
</script>

<style scoped>

</style>
