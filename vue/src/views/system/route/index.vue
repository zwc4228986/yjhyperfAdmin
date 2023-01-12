<template>
  <el-container>
        <el-header>
          <div class="left-panel">

          </div>
			<div class="right-panel">
				<div class="right-panel-search">
				<el-input v-model="queryParams.username" placeholder="搜索用户名" clearable></el-input>
				<el-tooltip class="item" effect="dark" content="搜索" placement="top">
					<el-button type="primary" icon="el-icon-search" @click="handlerSearch"></el-button>
				</el-tooltip>
				<el-tooltip class="item" effect="dark" content="清空条件" placement="top">
					<el-button icon="el-icon-refresh" @click="resetSearch"></el-button>
				</el-tooltip>
				</div>
			</div>
        </el-header>
        <el-main class="nopadding">
          <yjTable
            ref="table"
            :apiObj="apiObj"
			:params="queryParams"
            :column="column"
            :showRecycle="true"
            @selection-change="selectionChange"
            @switch-data="switchData"
            stripe
            remoteSort
            remoteFilter
          >
            <el-table-column type="selection" width="50"></el-table-column>

            <el-table-column
              label="描述"
              prop="description"
              width="130"
            ></el-table-column>
			  <el-table-column
				  label="权限标识"
				  prop="route"
				  width="130"
			  ></el-table-column>
			  <el-table-column
				  label="路由"
				  prop="path"
				  width="130"
			  ></el-table-column>
 			  <el-table-column
				  label="类名"
				  prop="class_name"
				  width="250"
			  ></el-table-column>
			  <el-table-column
				  label="方法名"
				  prop="method_name"
				  width="100"
			  ></el-table-column>

            <!-- 正常数据操作按钮 -->
            <el-table-column label="操作" fixed="right" align="right" width="130" v-if="!isRecycle">
              <template #default="scope">

                <el-button
                  type="text"
                  size="small"
                  @click="show(scope.row, scope.$index)"
                >删除
				</el-button>


              </template>
            </el-table-column>

            <!-- 回收站操作按钮 -->
            <el-table-column label="操作" fixed="right" align="right" width="130" v-else>
              <template #default="scope">

                <el-button
                  type="text"
                  size="small"
                  v-auth="['system:user:recovery']"
                  @click="recovery(scope.row.id)"
                >恢复</el-button>

                <el-button
                  type="text"
                  size="small"
                  v-auth="['system:user:realDelete']"
                  @click="deletes(scope.row.id)"
                >删除</el-button>

              </template>
            </el-table-column>

          </yjTable>
        </el-main>
    </el-container>

  <MenuPage  ref="Menu" ></MenuPage>

</template>

<script>
import MenuPage from './menu';
  export default {
    name: 'system:user',
    components: {
		MenuPage
    },
    data() {
      return {
        dialog: {
          save: false,
          homepage: false
        },
        column: [
          { label: '用户ID', prop: 'id', width: '150', hide: true },
          { label: '手机', prop: 'phone', width: '120', hide: true  },
          { label: '最后登录时间', prop: 'login_time', width: '200', hide: true  },
          { label: '最后登录IP', prop: 'login_ip', width : '180', hide: true  }
        ],
        povpoerShow: false,
        dateRange:'',
        showRolesLoading: false,
        rolesFilterText: '',
        roles: [],
		apiObj:  this.$HTTP().url('admin/system/route/lists'),
        selection: [],
        queryParams: {
          username: undefined,
          roles_id: undefined,
          maxDate: undefined,
          minDate: undefined,
          status: undefined
        },
        isRecycle: false,
      }
    },
    watch: {
      rolesFilterText(val) {
        this.$refs.roles.filter(val);
      }
    },
    mounted() {
      this.getRoles()
    },
    methods: {
	  setMenuRoles(rolesData){
			this.$refs.Menu.show(rolesData);
	  },
      //添加
      add(){
		  this.$modalForm(this.$HTTP().post('admin/system/roles/form')).then(res=>{
				  this.$refs.table.upData();
		  });
      },
      //编辑
      edit({id}){
		  this.$modalForm(this.$HTTP().params({id}).post('admin/system/roles/form')).then(res=>{
			  this.$refs.table.upData()
		  });
      },
      //查看
      show(row){
        this.dialog.save = true
        this.$nextTick(() => {
          this.$refs.saveDialog.open('show').setData(row)
        })
      },
      //批量删除
      async batchDel(){
        await this.$confirm(`确定删除选中的 ${this.selection.length} 项吗？`, '提示', {
          type: 'warning'
        }).then(() => {
          const loading = this.$loading();
          let ids = []
          this.selection.map(item => ids.push(item.id))
          if (this.isRecycle) {
            this.$API.user.realDeletes(ids.join(',')).then()
          } else {
            this.$API.user.deletes(ids.join(',')).then()
          }
          this.$refs.table.upData(this.queryParams)
          loading.close();
          this.$message.success("操作成功")
        })
      },

      // 单个删除
      async deletes(id) {
        await this.$confirm(`确定删除该用户吗？`, '提示', {
          type: 'warning'
        }).then(() => {
          const loading = this.$loading();
          if (this.isRecycle) {
            this.$API.user.realDeletes(id).then(() => {
              this.$refs.table.upData(this.queryParams)
            })
          } else {
            this.$API.user.deletes(id).then(() => {
              this.$refs.table.upData(this.queryParams)
            })
          }
          loading.close();
          this.$message.success("操作成功")
        }).catch(()=>{})
      },

      // 恢复数据
      async recovery (id) {
        await this.$API.user.recoverys(id).then(res => {
          this.$message.success(res.message)
          this.$refs.table.upData(this.queryParams)
        })
      },

      //表格选择后回调事件
      selectionChange(selection){
        this.selection = selection;
      },
      //加载树数据
      async getRoles(){
        await this.$HTTP().post('admin/system/roles/lists').then(res => {
          res.data.unshift({id: 0, name: '全部'})
          this.roles = res.data
          this.showRolesloading = false
        })
      },
      //树过滤
      rolesFilterNode(value, data){
        if (!value) return true;
        return data.label.indexOf(value) !== -1;
      },
      //树点击事件
      rolesClick(data){
		  console.log('rolesClick');
        if (this.queryParams.roles_id == data.id) {
          return
        }
        if (data.id === undefined) {
          this.queryParams.roles_id = data.id
        } else {
          let ids = [ data.id ]

          let filterNode = (nodes) => {
            nodes.map(item => {
              if (item.children && item.children.length > 0) {
                filterNode(item.children)
              } else {
                ids.push(item.id)
              }
            })
          }
          if (data.children && data.children.length > 0) {
            filterNode(data.children)
          }
          this.queryParams.roles_id = ids.join(',')
        }
        this.$refs.table.upData(this.queryParams)
      },

      // 初始化用户密码
      initUserPassword (id) {
        this.$confirm('确定要将用户密码设置为：123456', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
          this.$API.user.initUserPassword(id).then(() => {
            this.$message.success('用户密码初始化成功')
          })
        })
      },

      // 导出用户
      exportExcel () {
        this.$API.user.exportExcel(this.queryParams).then(res => {
          this.$TOOL.download(res)
        })
      },

      // 设置用户首页
      setHomepage(row) {
        this.dialog.homepage = true
        this.$nextTick(() => {
          this.$refs.homepageDialog.open().setData(row)
        })
      },

      // 更新用户缓存
      clearCache(row) {
        this.$API.user.clearCache({id: row.id}).then(() => {
          this.$message.success('该用户缓存已清空')
        })
      },

      // 选择时间事件
      handleDateChange (values) {
        if (values !== null) {
          this.queryParams.minDate = values[0]
          this.queryParams.maxDate = values[1]
        }
      },

      //搜索
      handlerSearch(){
        this.$refs.table.upData(this.queryParams)
      },

      // 切换数据类型回调
      switchData(isRecycle) {
        this.isRecycle = isRecycle
      },

      // 用户状态更改
      handleStatus (val, row) {
		  console.log('handleStatus');
        const status = row.status === '0' ? '0' : '1'
        const text = row.status === '0' ? '启用' : '停用'
        this.$confirm(`确认要${text} ${row.username} 用户吗？`, '提示', {
          type: 'warning',
          confirmButtonText: '确定',
          cancelButtonText: '取消'
        }).then(() => {
          this.$API.user.changeStatus({ id: row.id, status }).then(() => {
            this.$message.success(text + '成功')
          })
        }).catch(() => {
          row.status = row.status === '0' ? '1' : '0'
        })
      },

      resetSearch() {
        this.queryParams = {
          username: undefined,
          roles_id: undefined,
          maxDate: undefined,
          minDate: undefined,
          status: undefined
        }
        this.$refs.table.upData(this.queryParams)
      },

      //本地更新数据
      handleSuccess(){
        this.$refs.table.upData(this.queryParams)
      }
    }
  }
</script>

<style scoped lang="scss">
:deep(.el-avatar--circle) {
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
