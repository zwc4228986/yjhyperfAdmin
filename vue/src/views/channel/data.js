import { reactive, ref } from 'vue'




export const MenuData = ()=>{
    const menuList  = ref([]);
   const menuIndex = ref(0)
    const menuSonIndex = ref(0)

    const handleAddMenu = () => {
        menuList.value.push({
            name: '菜单名称',
            has_menu: false,
            type: 'view',
            url: '',
            key: '',
            appid: '',
            pagepath: '',
            sub_button: []
        })
    }

    const handleDelMenu = (index,sonIndex) => {
        if(sonIndex==0){
            menuList.value.splice(index, 1)
            if (index != 0) {
                menuIndex.value--
            }
            return
        }
        if(sonIndex>0){
            menuList.value[index].sub_button.splice(sonIndex-1, 1)
            menuSonIndex.value = 0
        }
    }

    const addChildren = (index)=>{
        console.log( menuList)
        menuList.value[index].sub_button.push({
            name: '菜单名称',
            has_menu: false,
            type: 'view',
            url: '',
            key: '',
            appid: '',
            pagepath: '',
            sub_button: []
        })
}

    return {
        handleDelMenu,
        addChildren,
        menuIndex,
        menuSonIndex,
        handleAddMenu,
        menuList,
    }
}

