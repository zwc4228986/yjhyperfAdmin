<template>
	<el-drawer title="菜单权限" v-model="drawer" size="80%">
		<div class="container">
			<block v-for="(item,index) in menuLists" :key="item.id">
				<el-row :gutter="24" >
					<el-col :span="4">
						<el-checkbox
							v-model="checkAll"
							:indeterminate="isIndeterminate"
							@change="handleCheckAllChange"
						>{{ item.title }}</el-checkbox>
					</el-col>
					<el-col :span="20" :offset="0">
						<block v-for="vv in item.children" :key="vv.id">
							<el-row :gutter="24" >
								<el-col :span="4">
									<el-checkbox
										v-model="checkAll"
										:indeterminate="isIndeterminate"
										@change="handleCheckAllChange"
									>{{ vv.title }}</el-checkbox>
								</el-col>
								<el-col :span="20">
									<el-row :gutter="24" v-for="vvv in vv.children" :key="vvv.id">
										<el-col :span="4">
											<el-checkbox
												v-model="checkAll"
												:indeterminate="isIndeterminate"
												@change="handleCheckAllChange"
											>{{ vvv.title }}</el-checkbox>
										</el-col>
										<el-col :span="20">

										</el-col>
										<el-divider></el-divider>
									</el-row>
								</el-col>
							</el-row>
							<el-divider></el-divider>
						</block>
					</el-col>
				</el-row>
				<el-divider v-if="index !== menuLists.length-1"></el-divider>
			</block>
		</div>
	</el-drawer>
</template>
<script>
import http from "@/utils/request";

export default {
	emits: ["confirm"],
	data() {
		return {
			checkedCities:['Shanghai', 'Beijing'],
			isIndeterminate:false,
			checkAll:false,
			cities: ['Shanghai', 'Beijing', 'Guangzhou', 'Shenzhen'],
			// 显示抽屉
			drawer: true,
			orderParams:{},
			orderData:{},
			menuLists:[],
		};
	},
	methods: {
		async show() {
			this.drawer = true;
			this.getMenuLists();
		},
		getMenuLists(){
			http().post('admin/menu/lists').then(res=>{
				console.log(res);
				this.collect(res).transform(res=>{
					console.log(res);
				})

				this.menuLists = res;
			})
		},
		handleCheckAllChange(val){
			console.log(val);
			this.checkedCities= val ? this.cities : []
			this.isIndeterminate = false
		},
		handleCheckedCitiesChange:(value) => {
			const checkedCount = value.length
			this.checkAll = checkedCount === this.cities.length
			this.isIndeterminate = checkedCount > 0 && checkedCount < this.cities.length
		}
	},
};
</script>


<style scoped lang="scss" >
.container{
	padding: 0 20px;
}
</style>
