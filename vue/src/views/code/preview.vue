<template>

	  <el-dialog
	    title="预览代码"
	    v-model="dialogVisible"
	    width="80%"
	    :before-close="handleDialogClose"
	  >
		  <el-container class="is-vertical" v-loading="loading">
				<el-header>
					  <div class="left-panel">
						<el-input v-model="dirname"></el-input>
					  </div>
					 <div>
						 <el-button type="priment" @click="create">一件生成</el-button>
					 </div>
				</el-header>
			  <el-main class="nopadding">
			<el-tabs v-model="type"   @tab-click="changeTabs">
			  <el-tab-pane
				v-for="(item, index) in previewCode"
				:key="index"
				:label="item.tab_name"
				:name="item.type"
			  >
			  </el-tab-pane>
			</el-tabs>
			  <Codemirror
				  v-model:value="code"
				  :options="cmOptions"
				  border
				  placeholder="test placeholder"
				  :height="400"
			  />
			  </el-main>
		  </el-container>
	  </el-dialog>
</template>
<script>
import maHighlight from "@/components/maHighlight";
export default {
	components: {
		maHighlight,
	},

	data() {
		return {
			code: "const a = 10",
			cmOptions: {
				// codemirror options
				tabSize: 4,
				mode: "text/javascript",
				theme: "base16-dark",
				lineNumbers: true,
				line: true,
				// more codemirror options, 更多 codemirror 的高级配置...
			},
			dirname:"",
			// modal
			dialogVisible: false,
			// 激活tab
			activeName: "controller",
			// 要预览的代码
			previewCode: [
				{
					tab_name:'Model层',
					type:'model',
				},
				{
					tab_name:'DAO层',
					type:'dao',
				}
			],
			table:'activity',
			type:'model',
			command:'create:model',
		};
	},
	watch:{
		dirname:function (value) {
			this.getCode();
		}
	},
	async created() {

	},
	methods: {
		getCode(){
			this.$HTTP().params({
				table:this.table,
				dirname:this.dirname,
				command: 'create:'+this.type
			}).post('admin/generator/generator/preview').then(res=>{
				this.code = res.content;
			})
		},
		create(){
			this.$HTTP().params({
				table:this.table,
				dirname:this.dirname,
				command: 'create:'+this.type,
				preview: false,
			}).post('admin/generator/generator/preview').then(res=>{
				this.code = res.content;
			})
		},
		// 显示modal
		async show(table) {
			this.table = table;
			this.dialogVisible = true;
			this.getCode();
			// await this.$API.generate.preview({ id }).then((res) => {
			// 	if (res.success) {
			// 		this.previewCode = res.data;
			// 		this.dialogVisible = true;
			// 	}
			// });
		},
		changeTabs(e){
			this.type = e.paneName;
			this.getCode();
		},
		// 表字段modal关闭
		handleDialogClose() {
			this.dialogVisible = false;
		},
	},
};
</script>
