<template>
  <sc-page-header :title="id ? '商品编辑' : '商品新增'"></sc-page-header>

  <el-main>
    <el-header class="header-tabs">
      <el-tabs type="card" v-model="currentTab" @on-click="onhangeTab">
        <el-tab-pane label="基本信息" name="0"></el-tab-pane>
        <!-- <el-tab-pane label="规格库存" name="1"></el-tab-pane> -->
        <el-tab-pane label="商品详情" name="2"></el-tab-pane>
        <!-- <el-tab-pane label="物流设置" name="3"></el-tab-pane> -->
        <!-- <el-tab-pane label="营销设置" name="4"></el-tab-pane> -->
        <!-- <el-tab-pane label="其他设置" name="5"></el-tab-pane> -->
        <el-tab-pane label="下载资源" name="5"></el-tab-pane>
      </el-tabs>
    </el-header>
    <!--		<el-alert title="注意: 因为keep-alive只接受组件name,导致多路由共用组件时,关闭或刷新一个标签导致其他同一组件的页面缓存失效,后续还在寻找完美的解决方案.建议在列表页使用dialog或者drawer形式" type="error" style="margin-bottom: 15px;"></el-alert>-->
    <el-card shadow="never">
      <el-form ref="form" label-width="100px">
        <div v-show="currentTab === '0'">
          <el-form-item label="商品类型">
            <div
              class="virtual"
              :class="
                formValidate.types == item.types
                  ? 'virtual_boder'
                  : 'virtual_boder2'
              "
              v-for="(item, index) in virtual"
              :key="index"
              @click="virtualbtn(item.types, item.is_virtual)"
            >
              <div class="virtual_top">{{ item.tit }}</div>
              <div class="virtual_bottom">({{ item.tit2 }})</div>
              <div
                v-if="formValidate.types == item.types"
                class="virtual_san"
              ></div>
              <div v-if="formValidate.types == item.types" class="virtual_dui">
                ✓
              </div>
            </div>
          </el-form-item>
          <el-form-item label="商品分类">
            <el-tree-select
              v-model="formValidate.product_category_id"
              multiple
              :data="productCategoryTree"
            >
            </el-tree-select>
          </el-form-item>
          <el-form-item label="商品名称">
            <el-input
              v-model="formValidate.name"
              placeholder="请输入商品名称"
            ></el-input>
          </el-form-item>
          <!-- <el-form-item label="单位">
            <el-input
              v-model="formValidate.unit_name"
              placeholder="请输入单位"
            ></el-input>
          </el-form-item> -->
          <el-form-item label="商品轮播图">
            <yjUploadMultiple
              :limit="3"
              draggable
              v-model="formValidate.image_ids"
              tip="最多上传3个文件,单个文件不要超过10M,请上传图像格式文件"
            >
            </yjUploadMultiple>
          </el-form-item>
          <el-form-item label="售价">
            <el-input-number
              v-model="formValidate.price"
              placeholder="售价"
            ></el-input-number>
          </el-form-item>
          <el-form-item label="商品状态">
            <el-radio-group v-model="formValidate.status" class="ml-4">
              <el-radio :label="1" size="large">上架</el-radio>
              <el-radio :label="0" size="large">下架</el-radio>
            </el-radio-group>
          </el-form-item>
        </div>
        <!-- <div v-show="currentTab === '1'">
          <el-form-item label="商品规格">
            <el-radio-group v-model="formValidate.spec_type" class="ml-4">
              <el-radio :label="0" size="large">单规格</el-radio>
              <el-radio :label="1" size="large">多规格</el-radio>
            </el-radio-group>
          </el-form-item>
          <div v-if="formValidate.spec_type === 1" class="multiple_attr">
            <el-descriptions
              :column="1"
              :size="size"
              :style="blockMargin"
              border
            >
              <template v-for="(attr, index) in attrs" v-bind:key="index">
                <el-descriptions-item :width="10" label="规格名">
                  <div style="display: flex; justify-content: space-between">
                    <el-input
                      style="width: 200px"
                      size="small"
                      v-model="attr.title"
                    ></el-input>

                    <el-button type="danger" @click="deleteAttr(index)"
                      >删除</el-button
                    >
                  </div>
                </el-descriptions-item>

                <el-descriptions-item :width="10" label="规格值">
                  <yjTags label="添加规格值" v-model="attr.values"> </yjTags>
                </el-descriptions-item>
              </template>
            </el-descriptions>

            <div class="margin-top-bottom">
              <el-button @click="addAttr()">添加规格</el-button>
            </div>
            <el-table
              :data="attrData"
              :span-method="arraySpanMethod"
              border
              style="width: 100%"
            >
              <template v-for="(attr, index) in attrs" v-bind:key="index">
                <el-table-column
                  prop="id"
                  v-if="attr.title != ''"
                  :label="attr.title"
                >
                  <template #default="scope">
                    {{ scope.row.attr[index] }}
                  </template>
                </el-table-column>
              </template>
              <el-table-column label="图片"> </el-table-column>
              <el-table-column label="售价">
                <template #default="scope">
                  <el-input
                    v-model="scope.row.price"
                    placeholder="请输入商品编号"
                  ></el-input>
                </template>
              </el-table-column>
              <el-table-column label="成本价">
                <template #default="scope">
                  <el-input
                    v-model="scope.row.cost"
                    placeholder="请输入成本价"
                  ></el-input>
                </template>
              </el-table-column>
              <el-table-column label="原价">
                <template #default="scope">
                  <el-input
                    v-model="scope.row.ot_price"
                    placeholder="请输入原价"
                  ></el-input>
                </template>
              </el-table-column>
              <el-table-column label="库存">
                <template #default="scope">
                  <el-input
                    v-model="scope.row.stock"
                    placeholder="请输入库存"
                  ></el-input>
                </template>
              </el-table-column>
              <el-table-column label="产品编号">
                <template #default="scope">
                  <el-input
                    v-model="scope.row.bar_code"
                    placeholder="请输入产品编号"
                  ></el-input>
                </template>
              </el-table-column>
              <el-table-column label="重量(KG)">
                <template #default="scope">
                  <el-input
                    v-model="scope.row.weight"
                    placeholder="请输入重量"
                  ></el-input>
                </template>
              </el-table-column>
              <el-table-column label="体积(m³)">
                <template #default="scope">
                  <el-input
                    v-model="scope.row.volume"
                    placeholder="请输入体积"
                  ></el-input>
                </template>
              </el-table-column>
            </el-table>
          </div>

          <div v-if="formValidate.spec_type === 0">
            <el-form-item label="售价">
              <el-input-number
                v-model="oneFormValidate[0].price"
                placeholder="售价"
              ></el-input-number>
            </el-form-item>
            <el-form-item label="成本价">
              <el-input-number
                v-model="oneFormValidate[0].cost"
                placeholder="成本价"
              ></el-input-number>
            </el-form-item>
            <el-form-item label="原价">
              <el-input-number
                v-model="oneFormValidate[0].ot_price"
                placeholder="原价"
              ></el-input-number>
            </el-form-item>
            <el-form-item label="库存">
              <el-input-number
                v-model="oneFormValidate[0].stock"
                :min="0"
                :max="99999999"
                placeholder="库存"
              ></el-input-number>
            </el-form-item>
            <el-form-item label="商品编号">
              <el-input
                v-model="oneFormValidate[0].bar_code"
                placeholder="请输入商品编号"
              ></el-input>
            </el-form-item>
            <el-form-item label="重量（KG）">
              <el-input-number
                v-model="oneFormValidate[0].weight"
                :min="0"
                :max="99999999"
                placeholder="库存"
              ></el-input-number>
            </el-form-item>
            <el-form-item label="体积(m³)">
              <el-input-number
                v-model="oneFormValidate[0].volume"
                :min="0"
                :max="99999999"
                placeholder="库存"
              ></el-input-number>
            </el-form-item>
           </div> 
        </div> -->
        <div v-show="currentTab === '2'">
          <scEditor v-model="formValidate.description"> </scEditor>
        </div>
        <div v-show="currentTab === '5'">
          <el-form ref="form" label-width="100px">
            <el-form-item label="七牛云">
              <yj-file v-model="formValidate.resource_id"></yj-file>
            </el-form-item>
            <el-form-item label="百度网盘">
              <el-input
                type="textarea"
                placeholder=""
                v-model="formValidate.baidu_url"
              >
              </el-input>
            </el-form-item>
            <el-form-item label="百度密码">
              <el-input placeholder="" v-model="formValidate.baidu_code">
              </el-input>
            </el-form-item>
          </el-form>
        </div>
        <!-- <div v-show="currentTab === '3'">
          <el-form-item label="运费设置">
            <el-radio-group v-model="formValidate.freight" class="ml-4">
              <el-radio :label="2" size="large">固定邮费</el-radio>
              <el-radio :label="3" size="large">运费模板</el-radio>
            </el-radio-group>
          </el-form-item>
          <el-form-item label="邮费" v-if="formValidate.freight == 2">
            <el-input-number
              v-model="formValidate.postage"
              :min="0"
              label="请输入运费金额"
            ></el-input-number>
          </el-form-item>

          <el-form-item label="" v-if="formValidate.freight == 3">
            <el-select v-model="formValidate.temp_id">
              <el-option
                v-for="(item, index) in shippingTemplateLists"
                v-bind:key="index"
                :value="item.id"
                :label="item.name"
              >
              </el-option>
            </el-select>
          </el-form-item>
        </div> -->
        <el-button type="primary" @click="onSubmit">保存</el-button>
      </el-form>
    </el-card>
  </el-main>
</template>

<script>
export default {
  name: "listCrud-detail",
  data() {
    return {
      virtual: [
        { tit: "普通商品", types: 0, tit2: "物流发货", is_virtual: 0 },
        { tit: "卡密/网盘", types: 1, tit2: "自动发货", is_virtual: 1 },
        { tit: "优惠卷", types: 2, tit2: "自动发货", is_virtual: 1 },
        { tit: "虚拟商品", types: 3, tit2: "虚拟发货", is_virtual: 1 },
      ],
      attr: [],
      store_product_attr_value: [],
      currentTab: "0",
      productCategoryTree: [],
      formValidate: {
        name: "",
        types: 3,
        info: "",
        description: "",
        baidu_url: "",
        baidu_code: "",
        is_show: 1,
        price: 1,
        product_category_id: [],
        image_ids: "",
      },
      oneFormValidate: [
        {
          pic: "",
          price: 0,
          cost: 0,
          ot_price: 0,
          stock: 0,
          bar_code: "",
          weight: 0,
          volume: 0,
          brokerage: 0,
          brokerage_two: 0,
          vip_price: 0,
          virtual_list: [],
          coupon_id: 0,
        },
      ],
      shippingTemplateLists: [],
      attrs: [
        {
          id: 0,
          title: "",
          values: [],
        },
      ],
      id: this.$route.query.id,
      input: "",
    };
  },
  computed: {
    attrData: function () {
      var len = 1;
      console.log(this.attrs);
      var attrsData = [];
      this.attrs.every((attr) => {
        if (attr.values.length) {
          // len = JSON.parse(attr.values).length*len;
          attrsData.push(JSON.parse(attr.values));
        }
        // attrsData[]
        return true;
      });
      attrsData = this.doExchange(attrsData);
      attrsData = attrsData.map((res, index) => {
        let data = {};
        data.attr = res.split("|");
        if (this.store_product_attr_value[index]) {
          data.id = this.store_product_attr_value[index].id;
          data.price = this.store_product_attr_value[index].price;
          data.bar_code = this.store_product_attr_value[index].bar_code;
          data.cost = this.store_product_attr_value[index].cost;
          data.brokerage_two =
            this.store_product_attr_value[index].brokerage_two;
          data.ot_price = this.store_product_attr_value[index].ot_price;
          data.brokerage = this.store_product_attr_value[index].brokerage;
          data.stock = this.store_product_attr_value[index].stock;
          data.volume = this.store_product_attr_value[index].volume;
          data.pic = this.store_product_attr_value[index].pic;
          data.weight = this.store_product_attr_value[index].weight;
          data.vip_price = this.store_product_attr_value[index].vip_price;
        } else {
          data.id = 0;
          data.price = 0;
          data.bar_code = "";
          data.cost = 0;
          data.brokerage_two = 0;
          data.ot_price = 0;
          data.brokerage = 0;
          data.stock = 0;
          data.volume = 0;
          data.pic = 0;
          data.weight = 0;
          data.vip_price = 0;
        }

        return data;
      });

      console.log(attrsData);
      // this.attrs.length
      return attrsData;
    },
  },
  created() {},
  async mounted() {
    await this.getProductCategory();
    // await this.getShippingTemplateLists();
    if (this.id) {
      await this.getProductDetail();
    }
    //修改tab名称
    // this.$store.commit("updateViewTagsTitle", this.id?`CURD编辑ID:${this.id}`:"CURD新增")
  },
  methods: {
    getProductDetail() {
      this.$HTTP()
        .params({ product_id: this.id })
        .post("/admin/product/detail")
        .then((res) => {
          let formValidate = {};
          // formValidate.slider_image = JSON.parse(res.slider_image).join(",");
          // formValidate.cate_id = res.cate_id
          //   .split(",")
          //   .map((item) => parseInt(item));
          // formValidate.store_name = res.store_name;
          // formValidate.description = res.store_product_description?.description;
          // formValidate.types = res.virtual_type;
          // formValidate.unit_name = res.unit_name;
          // formValidate.spec_type = res.spec_type;
          // formValidate.is_show = res.is_show;
          // formValidate.postage = res.postage;
          // formValidate.temp_id = res.temp_id;

          // this.store_product_attr_value = res.store_product_attr_value;
          // formValidate.oneFormValidate = res.store_product_attr_value;
          // this.attrs = res.store_product_attr.map((item) => {
          //   item.title = item.attr_name;
          //   item.values = JSON.stringify(item.attr_values.split(","));
          //   return item;
          // });
          // formValidate.freight = res.freight;
          formValidate = this.collect(res).only([
            "name",
            "image_ids",
            "price",
            "status",
          ]);
          formValidate.prepend(
            res.product_description.description,
            "description"
          );
          formValidate.prepend(res.product_resource.baidu_url, "baidu_url");
          formValidate.prepend(res.product_resource.baidu_code, "baidu_code");
          formValidate.prepend(3, "types");
          formValidate.prepend(res.product_resource?.file_id, "resource_id");
          formValidate.prepend(
            this.collect(res.product_category_rel)
              .transform((res) => {
                return parseInt(res.product_category_id);
              })
              .all(),
            "product_category_id"
          );
          console.log(formValidate);

          this.formValidate = formValidate.all();
        });
    },
    async getShippingTemplateLists() {
      this.shippingTemplateLists = await this.$HTTP()
        .params({ is_page: false })
        .post("/admin/shipping/shipping_templates/lists");
    },
    doExchange(arr) {
      var len = arr.length;
      // 当数组大于等于2个的时候
      if (len == 0) {
        return [];
      }
      if (len >= 2) {
        // 第一个数组的长度
        var len1 = arr[0].length;

        // 第二个数组的长度
        var len2 = arr[1].length;
        // 2个数组产生的组合数
        var lenBoth = len1 * len2;
        //  申明一个新数组,做数据暂存
        var items = new Array(lenBoth);
        // 申明新数组的索引
        var index = 0;
        // 2层嵌套循环,将组合放到新数组中
        for (var i = 0; i < len1; i++) {
          for (var j = 0; j < len2; j++) {
            items[index] = arr[0][i] + "|" + arr[1][j];
            index++;
          }
        }
        // 将新组合的数组并到原数组中
        var newArr = new Array(len - 1);
        for (i = 2; i < arr.length; i++) {
          newArr[i - 1] = arr[i];
        }
        newArr[0] = items;
        // 执行回调
        return this.doExchange(newArr);
      } else {
        return arr[0];
      }
    },
    onhangeTab(name) {
      this.currentTab = name;
    },
    deleteAttr(index) {
      this.attrs.splice(index, 1);
    },
    onSubmit() {
      // if (this.formValidate.spec_type == 0) {
      //   this.formValidate.attrData = this.oneFormValidate;
      // } else {
      //   this.formValidate.attrData = JSON.stringify(this.attrData);
      //   this.formValidate.attrs = JSON.stringify(this.attrs);
      // }
      if (this.id) {
        this.formValidate.id = this.id;
        this.$HTTP()
          .params(this.formValidate)
          .post("/admin/product/edit")
          .then((res) => {
            this.$message.success("编辑成功");
          });
      } else {
        this.$HTTP()
          .params(this.formValidate)
          .post("/admin/product/add")
          .then((res) => {
            this.$message.success("添加成功");
            setTimeout(() => {
              this.$router.push("/product/lists");
            }, 2000);
          });
      }
    },
    addAttr() {
      this.attrs.push({
        id: 0,
        title: "",
        values: [],
      });
    },
    virtualbtn(types, is_virtual) {
      this.formValidate.types = types;
      this.formValidate.is_virtual = is_virtual;
    },
    async getProductCategory() {
      this.productCategoryTree = await this.$HTTP().post(
        "/admin/product/category/tree"
      );
    },
    arraySpanMethod(row, column, rowIndex, columnIndex) {
      if (rowIndex % 2 === 0) {
        if (columnIndex === 0) {
          return [1, 2];
        } else if (columnIndex === 1) {
          return [0, 0];
        }
      }
    },
  },
};
</script>

<style scoped lang="scss">
.virtual_boder {
  border: 1px solid #1890ff;
}

.virtual_boder2 {
  border: 1px solid #e7e7e7;
}

.virtual_san {
  position: absolute;
  bottom: 0;
  right: 0;
  width: 0;
  height: 0;
  border-bottom: 26px solid #1890ff;
  border-left: 26px solid transparent;
}

.virtual_dui {
  position: absolute;
  bottom: -2px;
  right: 2px;
  color: #ffffff;
  font-family: system-ui;
}

.virtual {
  width: 120px;
  height: 60px;
  background: #ffffff;
  border-radius: 3px;
  float: left;
  text-align: center;
  padding-top: 8px;
  position: relative;
  cursor: pointer;
  line-height: 23px;
  .virtual_top {
    font-size: 14px;
    font-weight: 600;
    color: rgba(0, 0, 0, 0.85);
  }

  .virtual_bottom {
    font-size: 12px;
    font-weight: 400;
    color: #999999;
  }
}

.virtual:nth-child(2n) {
  margin: 0 12px;
}

.multiple_attr {
  padding-left: 30px;
}

.margin-top-bottom {
  margin-top: 20px;
  margin-bottom: 20px;
}

.header-tabs {
  margin-left: -10px;
  //display: flex;
  //justify-content: center;
}
.el-card {
  border-top: none;
}
</style>
