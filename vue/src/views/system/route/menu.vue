<template>
	<el-drawer  title="菜单权限" v-model="drawer" size="80%">
		<div class="container setMenuRoles">
			<div class="container-box">
			<block v-for="(item,index) in menuLists" :key="item.id">
			<el-row :gutter="24">
				<el-col :span="4">
					<el-checkbox
					v-model="item.checked"
					:indeterminate="isIndeterminate"
					@change="handleCheckAllChange"
				>{{ item.title }}{{item.checked}}</el-checkbox>
				</el-col>
				<el-col :span="20" :offset="0">
					<block v-for="(vv,childIndex) in item.children" :key="vv.id">
					<el-row :gutter="24" >
						<el-col :span="4">
							<el-checkbox
								v-model="vv.checked"
								:indeterminate="isIndeterminate"
								@change="handleCheckAllChange"
							>{{ vv.title }}</el-checkbox>
						</el-col>
						<el-col :span="20">
							<el-row :gutter="24" v-for="(vvv,threeIndex) in vv.children" :key="vvv.id">
								<el-col :span="4">
									<el-checkbox
										v-model="vvv.checked"
										:indeterminate="isIndeterminate"
										@change="handleCheckAllChange"
									>{{ vvv.title }}</el-checkbox>
								</el-col>
								<el-col :span="20">

								</el-col>
								<el-divider  v-if="threeIndex !== vv.children.length-1"></el-divider>
							</el-row>
						</el-col>
					</el-row>
					<el-divider  v-if="childIndex !== item.children.length-1"></el-divider>
					</block>
				</el-col>
			</el-row>

			<el-divider v-if="index !== menuLists.length-1"></el-divider>
			</block>
			</div>
			<div class="container-end">
				<el-button type="primary" size="large" @click="onSubmit()">保 存</el-button>
			</div>
		</div>
	</el-drawer>
</template>
<script>
import http from "@/utils/request";
import {extend} from "@/utils/common";

export default {
	emits: ["confirm"],
	data() {
		return {
			rolesData:{},
			checkedCities:['Shanghai', 'Beijing'],
			isIndeterminate:false,
			checkAll:false,
			cities: ['Shanghai', 'Beijing', 'Guangzhou', 'Shenzhen'],
			// 显示抽屉
			drawer: false,
			orderParams:{},
			orderData:{},
			menuLists:[],
		};
	},
	mounted() {
		// this.getMenuLists();
	},
	methods: {
		async show(rolesData) {
			this.rolesData = rolesData;
			this.drawer = true;
			this.getMenuLists();
		},
		getMenuLists(rolesData){
			http().params({role_id:this.rolesData.id}).post('admin/menu/roles').then(res=>{
				// this.collect(res).transform(res=>{
				// 	res.checked = true;
				// })
				this.menuLists = res;
			})
		},
		handleCheckAllChange(val){
			console.log(val);
			this.checkedCities= val ? this.cities : []
			this.isIndeterminate = false
		},
		onSubmit(){
			const checkedMenusId = this.getCheckedMenusId(this.menuLists)
			this.$HTTP().params({roles_id:this.rolesData.id,menus_id:checkedMenusId})
				.post('admin/system/roles/set-menus').then(res=>{
					console.log(res);
			})

		},
		getCheckedMenusId(menuLists){
			let checkedMenusId = this.collect([]);
			this.collect(menuLists).every(res=>{
					if(res.children){
						checkedMenusId = checkedMenusId.concat(this.getCheckedMenusId(res.children).all());
					}
					if(res.checked == true){
						checkedMenusId.push(res.id);
					}
					return true;
			});
			return checkedMenusId;
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
	padding: 0 0 0px 10px;
	height: 100%;
	display: flex;
	justify-content: center;
	flex-direction: column;

	.container-box{
		//width: 96%;

		height: calc(100% - 50px);
		overflow-x:hidden;
	}
	.container-end{
		height: 50px;
		display: flex;
		justify-content: center;
	}
}

</style>
