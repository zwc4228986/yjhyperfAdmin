<template>
	<el-tag
		v-for="(tag,index) in dynamicTags"
		:key="tag"
		class="mx-1"
		closable
		:disable-transitions="false"
		@close="handleClose(index)"
	>
		{{ tag }}
	</el-tag>
	<el-input
		v-if="inputVisible"
		ref="InputRef"
		v-model="inputValue"
		class="ml-1 w-20"
		size="small"
		@keyup.enter="handleInputConfirm"
		@blur="handleInputConfirm"
	>
	</el-input>
	<el-button v-else class="button-new-tag" :class="{'ml-1':dynamicTags.length>0}" size="small" @click="showInput">
		{{ label }}
	</el-button>
</template>

<!--<script setup>-->


<!--import { ref, nextTick ,watch} from 'vue'-->


<!--const inputValue = ref('')-->
<!--const modelValue = ref('111111')-->
<!--const dynamicTags = ref(['Tag 1', 'Tag 2', 'Tag 3'])-->
<!--const inputVisible = ref(false)-->
<!--const InputRef = ref('')-->

<!--const handleClose = (tag) => {-->
<!--	dynamicTags.value.splice(dynamicTags.value.indexOf(tag), 1)-->
<!--}-->





<!--</script>-->

<script>

import config from "@/config/upload";
import  { ElInput,ElTag,ElButton } from 'element-plus'

export default {
	props: {
		modelValue: { type: String, default: "" },
		label: { type: String, default: "添加标签" },
	},
	computed:{
		style() {
			return {width:'100px',height:'100px'};
		},
	},
	components: {
		ElInput,ElTag,ElButton
	},
	data() {
		return {
			dynamicTags:[],
			inputVisible:false,
			inputValue:'',
			loading: false,
			fileIsImg: true,
			img: "",
			tempImg: "",
			cropperDialogVisible: false,
			cropperImg: "",
			cropperUploadFile: null,
			fileSelectDialogVisible: false,
		};
	},

	watch: {
		modelValue(value){
			this.dynamicTags = JSON.parse(value);
		},
		dynamicTags(value) {
			this.$emit("update:modelValue",JSON.stringify(value));
		},
	},
	async mounted() {

		if(this.modelValue && this.modelValue.length>0){
			console.log('modelValue',this.modelValue);

			this.dynamicTags = JSON.parse(this.modelValue);
		}
		// this.img = await getFilePath(this.modelValue);
	},
	methods: {
		handleClose(index){
			this.dynamicTags.splice(index,1)
			this.$emit("update:modelValue",JSON.stringify(this.dynamicTags));
		},
		showInput(){
			this.inputVisible = true
			this.$nextTick(() => {
				this.$refs.InputRef.input.focus()
			})
		},
		handleInputConfirm(){
			if (this.inputValue) {
				this.dynamicTags.push(this.inputValue)
				this.$emit("update:modelValue",JSON.stringify(this.dynamicTags));
			}
			this.inputVisible = false
			this.inputValue = ''
		},
		showfileSelect() {
			this.fileSelectDialogVisible = true;
		},
		fileSelectSubmit(val) {
			this.img = val;
			this.fileSelectDialogVisible = false;
		},
		cropperSave() {
			var uploadFile = this.$refs.upload.uploadFiles[0].raw;
			this.$refs.cropper.getCropFile(
				(file) => {
					this.cropperUploadFile = file;
					this.$refs.upload.submit();
				},
				uploadFile.name,
				uploadFile.type
			);
			this.cropperDialogVisible = false;
		},
		isImg(fileUrl) {
			var strRegex = "(.jpg|.png|.gif|.jpeg)$";
			var re = new RegExp(strRegex);
			if (re.test(fileUrl.toLowerCase())) {
				this.fileIsImg = true;
			} else {
				this.fileIsImg = false;
			}
		},
		change(file) {
			if (this.cropper && file.status == "ready") {
				this.isImg(file.name);
				if (!this.fileIsImg) {
					this.$notify.warning({
						title: "上传文件警告",
						message: "选择的文件非图像类文件",
					});
					return false;
				}
				this.cropperDialogVisible = true;
				this.cropperImg = URL.createObjectURL(file.raw);
			}
		},
		before(file) {
			file = this.cropper ? this.cropperUploadFile : file;
			const maxSize = file.size / 1024 / 1024 < this.maxSize;
			if (!maxSize) {
				this.$message.warning(
					`上传文件大小不能超过 ${this.maxSize}MB!`
				);
				return false;
			}
			this.isImg(file.name);
			this.tempImg = URL.createObjectURL(file);
			this.loading = true;
		},
		success(res) {

			this.loading = false;
			this.tempImg = "";
			var os = this.onSuccess(res);
			// if (os != undefined && os == false) {
			// 	return false;
			// }
			// var response = config.parseData(res);
			// if (response.code != config.successCode) {
			// 	this.$message.warning(response.msg || "上传文件未知错误");
			// } else {
			// 	this.img = response.src;
			// }
			this.$emit("update:modelValue", res.id);

		},
		error(err) {
			console.log(err);
			this.$notify.error({
				title: "上传文件错误",
				message: err,
			});
			this.loading = false;
			this.tempImg = "";
			this.img = "";
		},
		del() {
			this.img = "";
		},
		request(param) {

			var apiObj = config.apiObj;
			console.log(apiObj);
			if (this.apiObj) {
				apiObj = this.apiObj;
			}
			const data = new FormData();
			var file = this.cropper ? this.cropperUploadFile : param.file;
			data.append("file", file);
			console.log(data);
			apiObj.params(data).post()
				.then((res) => {
					param.onSuccess(res);
				})
				.catch((err) => {
					console.log(err);
					param.onError(err);
				});
		},
	},
};
</script>


<style   scoped>
.ml-1 {
	margin-left: 1rem;
}
.w-20{
	width: 80px;
}
</style>
