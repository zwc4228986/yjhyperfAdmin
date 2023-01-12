<template>
	<el-main>
		<!-- <el-alert title="一个非常简单的组件, 目的就是省去重复写样式, 支持千分符/前后缀等." type="success" style="margin-bottom:20px;"></el-alert> -->
		<el-row :gutter="15">
			<el-col :lg="5" v-for="(item,key) in staticsData.infos" v-bind:key="key">
					<yjStatistic :title="item.title" :value="item.value"
								 :description="item.description"
								 :tag="item.tag"
								 :description_value="item.description_value"
								 :prefix="item.prefix"  
								 :suffix="item.suffix"
								 groupSeparator></yjStatistic>
			</el-col>
		</el-row>
	</el-main>
</template>
<script>
import { defineAsyncComponent } from "vue";
const work = defineAsyncComponent(() => import("./work"));
const widgets = defineAsyncComponent(() => import("./widgets"));

export default {
	name: "dashboard",
	components: {
		work,
		widgets,
	},
	data() {
		return {
			staticsData:{
				infos:[]
			},
			pageLoading: true,
			dashboard: "0",
		};
	},
	created() {
		this.getStatics();
	},
	mounted() {},
	methods: {
		getStatics(){
			this.$HTTP().post('/admin/statics/home_statics/home').then(res=>{
				this.staticsData = res;
			});
		},
		onMounted() {
			this.pageLoading = false;
		},
	},
};
</script>

<style scoped>
.welcome {
}
.welcome .logo {
	text-align: center;
}
.welcome .logo img {
	vertical-align: bottom;
	width: 100px;
	height: 100px;
	margin-bottom: 20px;
}
.welcome .logo h2 {
	font-size: 30px;
	font-weight: normal;
	display: flex;
	align-items: center;
	justify-content: center;
}

.tips {
	margin-top: 20px;
	padding: 0 40px;
}
.tips-item {
	display: flex;
	align-items: center;
	justify-content: center;
	padding: 7.5px 0;
}
.tips-item-icon {
	width: 40px;
	height: 40px;
	display: flex;
	align-items: center;
	justify-content: center;
	border-radius: 50%;
	font-size: 18px;
	margin-right: 20px;
	color: var(--el-color-primary);
	background: rgba(180, 180, 180, 0.1);
}
.tips-item-message {
	flex: 1;
	font-size: 14px;
}

.actions {
	text-align: center;
	margin: 40px 0 20px 0;
}
</style>

