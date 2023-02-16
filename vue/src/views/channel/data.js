
// 菜单数据
import { ref } from 'vue'
const menuList  = ref([]);

export const MenuData = ()=>{

    const handleAddMenu = () => {
        menuList.value.push({
            name: '菜单名称',
            has_menu: false,
            type: 'view',
            url: '',
            appid: '',
            pagepath: '',
            sub_button: []
        })
    }

    return {
        handleAddMenu,
        menuList,
    }
}

