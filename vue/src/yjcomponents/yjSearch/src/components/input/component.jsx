const NAME = 'fcInput';
import { inject } from "vue";
export default {
    name: NAME,
    functional: true,
    props: {
        vModel:{
            type: String,
            required: true,
        },
        label:{
            type: String,
            required: true,
        }
    },
    setup() {
        const searchParams = inject("formParams")
        return {
          searchParams
        } 
    },
    render(ctx) {
        return <ElInput clearable vModel={this.searchParams[ctx.vModel]} placeholder={'请输入'+ctx.label}></ElInput>;
    }
}