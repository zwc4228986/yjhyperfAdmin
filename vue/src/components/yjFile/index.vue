<template>
  <div
    class="sc-upload"
    element-loading-background="rgba(0, 0, 0, 0.5)"
    :style="style"
  >
    <div v-if="img" class="sc-upload-file">
      <div class="mask">
        <span class="del" @click.stop="del">
          <el-icon :size="23">
            <Delete />
          </el-icon>
        </span>
      </div>
      <a :href="img" class="file" target="_blank">
        <el-icon :size="40">
          <document></document>
        </el-icon>
      </a>
    </div>
    <div v-else class="sc-upload-uploader" @click="showfileSelect()">
      <el-upload
        ref="upload"
        class="uploader"
        :disabled="fileSelect"
        :data="uploadParams"
        :auto-upload="!cropper"
        :on-change="change"
        :accept="accept"
        :action="newAction"
        :show-file-list="false"
        :before-upload="before"
        :on-success="success"
        :on-error="error"
        :on-progress="uploadProgress"
      >
        <slot>
          <div class="file-empty" v-if="loading">
            <el-progress
              :width="90"
              type="circle"
              :percentage="percentage"
            ></el-progress>
          </div>
          <div class="file-empty" v-else>
            <el-icon :size="30">
              <Plus></Plus>
            </el-icon>
            <h4 v-if="title">{{ title }}</h4>
          </div>
        </slot>
      </el-upload>
    </div>
  </div>
</template>

<script>
import { Setting, Plus, Document, Delete } from "@element-plus/icons-vue";
import getFilePath from "@/utils/lib/file";
import { defineAsyncComponent } from "vue";
import config from "@/config/upload";
import sysConfig from "@/config";
const scCropper = defineAsyncComponent(() => import("@/components/scCropper"));
const scFileSelect = defineAsyncComponent(() =>
  import("@/components/scFileSelect")
);

import { ElUpload, ElImage, ElIcon, ElMessage, ElProgress } from "element-plus";

export default {
  props: {
    height: { type: Number, default: 0 },
    width: { type: Number, default: 0 },
    modelValue: { type: String, default: "" },
    action: { type: String, default: "" },
    apiObj: { type: Object, default: () => {} },
    accept: { type: String, default: "yjVideo/*" },
    maxSize: { type: Number, default: config.maxSize },
    title: { type: String, default: "" },
    icon: { type: String, default: "el-icon-plus" },
    fileSelect: { type: Boolean, default: false },
    cropper: { type: Boolean, default: false },
    compress: { type: Number, default: 1 },
    aspectRatio: { type: Number, default: NaN },
    onSuccess: {
      type: Function,
      default: () => {
        return true;
      },
    },
  },
  computed: {
    style() {
      return { width: "100px", height: "100px" };
    },
    newAction() {
      return sysConfig.API_URL + "/api/utils/file/upload";
    },
  },
  components: {
    ElUpload,
    ElImage,
    Delete,
    scCropper,
    Plus,
    ElIcon,
    scFileSelect,
    Setting,
    ElProgress,
    Document,
  },
  data() {
    return {
      uploadParams:{
        'storage':'qiniu_file'
      },
      percentage: 0,
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
    async modelValue(value) {
      console.log(value);
      this.img = await getFilePath(value);
      this.$emit("update:modelValue", value);
    },
  },
  async mounted() {
    // this.isImg(this.modelValue);
    this.img = await getFilePath(this.modelValue);
  },
  methods: {
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
            title: "??????????????????",
            message: "?????????????????????????????????",
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
        ElMessage.warning(`?????????????????????????????? ${this.maxSize}MB!`);
        return false;
      }
      this.isImg(file.name);
      this.tempImg = URL.createObjectURL(file);
      this.loading = true;
    },
    uploadProgress(res, file) {
      console.log(file)
      this.percentage = file.percentage.toFixed(1);
    },
    success(res) {
      res = res.data;
      this.tempImg = "";
      var os = this.onSuccess(res);
      console.log(res.id);
      // if (os != undefined && os == false) {
      // 	return false;
      // }
      // var response = config.parseData(res);
      // if (response.code != config.successCode) {
      // 	this.$message.warning(response.msg || "????????????????????????");
      // } else {
      // 	this.img = response.src;
      // }
      this.img = res.src;
      this.$emit("update:modelValue", res.id);
      this.loading = false;
    },
    error(err) {
      console.log(err);
      this.$notify.error({
        title: "??????????????????",
        message: err,
      });
      this.loading = false;
      this.tempImg = "";
      this.img = "";
    },
    del() {
      this.img = "";
      this.$emit("update:modelValue", 0);
    },
    request(param) {
      var apiObj = config.apiObj;
      if (this.apiObj) {
        apiObj = this.apiObj;
      }
      const data = new FormData();
      var file = this.cropper ? this.cropperUploadFile : param.file;
      data.append("file", file);
      data.append("storage", 'qiniu_file');

      console.log(data);
      apiObj
        .params(data)
        .post()
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

<style>
.sc-upload + .sc-upload {
  margin-left: 10px;
}
</style>

<style scoped>
.el-form-item.is-error .sc-upload-uploader {
  border: 1px dashed #f56c6c;
}

.sc-upload {
  /*width: 120px;*/
  /*height: 120px;*/
  display: inline-block;
  vertical-align: top;
  box-sizing: border-box;
}

.sc-upload-file {
  position: relative;
  width: 100%;
  height: 100%;
}
.sc-upload-file .mask {
  display: none;
  position: absolute;
  top: 0px;
  right: 0px;
  line-height: 1;
  z-index: 1;
}
.sc-upload-file .mask span {
  display: inline-block;
  width: 25px;
  height: 25px;
  line-height: 23px;
  text-align: center;
  cursor: pointer;
  color: #fff;
}
.sc-upload-file .mask span i {
  font-size: 12px;
}
.sc-upload-file .mask .del {
  background: #f56c6c;
}
.sc-upload-file .image {
  width: 100%;
  height: 100%;
}
.sc-upload-file .image img {
  vertical-align: bottom;
}
.sc-upload-file .file {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  border: 1px solid #dcdfe6;
}
.sc-upload-file .file i {
  font-size: 30px;
  color: #409eff;
}
.sc-upload-file:hover .mask {
  display: inline-block;
}

.sc-upload-uploader {
  border: 1px dashed #d9d9d9;
  box-sizing: border-box;
  width: 100%;
  height: 100%;
}
.sc-upload-uploader:hover {
  border: 1px dashed #409eff;
}
.sc-upload-uploader .uploader {
  width: 100%;
  height: 100%;
}
.sc-upload-uploader:deep(.el-upload) {
  width: 100%;
  height: 100%;
}

.sc-upload-uploader .file-empty {
  width: 100%;
  height: 100%;
  line-height: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.sc-upload-uploader .file-empty i {
  font-size: 28px;
  color: #8c939d;
}
.sc-upload-uploader .file-empty h4 {
  font-size: 12px;
  font-weight: normal;
  color: #8c939d;
  margin-top: 10px;
}
</style>
