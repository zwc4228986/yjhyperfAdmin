const NAME = 'fcSelect';
import { inject } from "vue";
export default {
    name: NAME,
    functional: true,
    props: {
        options: {
            type: Object,
            required: true,
        },
        vModel:{
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
        const options = ctx.options;
        return <ElSelect clearable  vModel={this.searchParams[ctx.vModel]}>{(Array.isArray(options) ? options : []).map((props, index) => {
            return <ElOption value={props.value} label={props.label}></ElOption> 
        })}</ElSelect>;
    }
}