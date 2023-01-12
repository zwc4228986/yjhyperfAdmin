
import { defineComponent, ref,toRefs ,toRef,reactive,watch,inject,h,resolveComponent} from 'vue'

import SearchSelect from './components/select'
import SearchInput from './components/input'

const search = defineComponent({
  components:{SearchSelect,SearchInput},
  props:{
    fields:{ type: Object, default: ()=>{}},
  },
  setup (props) {
    const gutter = ref(20)
    const span = ref(8)
    const searchParams = inject("formParams")
    return {
      gutter,
      span,
      searchParams
    }
  },
  render(){
    console.log(this.$attrs,'attrs');
    return <el-row gutter={this.gutter}>
          {this.fields.map((item) => {
            return <el-col  span={this.span} class="yj-col">
              <div class="label">{item.label}</div>
              <div class="slot">
                 {
                    h(resolveComponent(item.type),item)
                 }
              </div>
            </el-col>
          })}
     </el-row>
  }
})

export default search


