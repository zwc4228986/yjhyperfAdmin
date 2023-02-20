<script setup>

import request from "@/utils/request";
import { reactive, ref } from 'vue'
import { MenuData } from './data'
console.log(MenuData)

const { menuList, handleAddMenu, addChildren ,handleDelMenu,menuIndex,menuSonIndex} = MenuData()

const menuData = reactive({})

const onSave = async () => {
    var data = await request().params({ data: menuList.value }).post('/api/wechat/menu/create')
    await request().post('/api/wechat/menu/get')

}

</script>
<template>
    <el-container>
        <el-header>
            {{ menuSonIndex }}
            <el-alert type="warning" title="配置微信公众号菜单，点击确认，保存菜单并发布至微信公众号" :closable="false" show-icon />
        </el-header>
        <el-main class="bg-white flex">
            <div class="oa-phone mr-[35px] ">
                <div class="oa-phone-content"></div>
                <div class="flex oa-phone-menu">
                    <div class="flex items-center justify-center oa-phone-menu-switch">
                        <i-all-application theme="outline" size="24" fill="#333" />
                    </div>
                    <template v-for="(menuItem, i) in menuList" :key="i">
                        <div class="relative flex-1" @click="menuIndex = i; menuSonIndex = 0 ">
                            <!-- 一级菜单 -->
                            <div class="flex items-center justify-center flex-1 text-sm oa-phone-menu-item relative"
                                :class="{ 'active-menu': menuIndex === i }">
                                {{ menuItem.name }}
                                <div @click.stop="addChildren(i)"
                                    class="add_son_menu absolute bottom-16 border bg-gray-50 w-24 flex justify-center h-10 items-center">
                                    <i-add-three theme="outline" size="24" fill="#333" />
                                </div>
                            </div>
                            <!-- 二级菜单 -->
                            <!-- <div class="oa-phone-menu-subitem">
                                    <div class="oa-phone-menu-subitem-title">
                                        <i-add-three theme="outline" size="24" fill="#333" />
                                    </div>
                                </div> -->
                            <div class="oa-phone-menu-subitem" v-show="menuItem.sub_button.length > 0">
                                <template v-for="(subItem, index2) in menuItem.sub_button" :key="index2">
                                    <div class="oa-phone-menu-subitem-title"
                                        @click.stop="menuIndex = i; menuSonIndex = (index2 + 1)">
                                        {{ subItem.name }}
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                    <!-- 新增菜单 -->
                    <template v-if="menuList.length <= 2">
                        <div class="flex items-center justify-center flex-1 h-full" @click="handleAddMenu">
                            <i-add-three theme="outline" size="24" fill="#333" />
                        </div>
                    </template>
                </div>
            </div>
            <template v-for="(menuData, attrIndex) in menuList" :key="attrIndex">
                <div class="mt-4 lg:mt-0 max-w-[400px]" v-show="attrIndex === menuIndex && menuSonIndex == 0">
                    <yjCloseWrap @close="handleDelMenu(attrIndex, 0)">
                        <div class="text-base oa-attr-title">菜单配置</div>
                        <el-form :model="form" label-width="120px">
                            <el-form-item label="菜单名称">
                                <el-input v-model="menuData.name" />
                            </el-form-item>
                            <el-form-item label="跳转链接">
                                <el-select v-model="menuData.type" placeholder="跳转链接">
                                    <el-option label="关键词" value="click" />
                                    <el-option label="小程序" value="miniprogram" />
                                    <el-option label="网页" value="view" />
                                </el-select>
                            </el-form-item>
                            <el-form-item label="网址" prop="url" v-if="menuData.type == 'view'">
                                <el-input v-model="menuData.url" />
                            </el-form-item>
                            <el-form-item label="关键词" prop="keyword" v-if="menuData.type == 'click'">
                                <el-input v-model="menuData.key" />
                            </el-form-item>
                            <template v-if="menuData.type == 'miniprogram'">
                                <!-- AppId -->
                                <el-form-item label="AppId" prop="appid">
                                    <el-input v-model="menuData.appid" />
                                </el-form-item>
                                <!-- 路径 -->
                                <el-form-item label="路径" prop="pagepath">
                                    <el-input v-model="menuData.pagepath" />
                                </el-form-item>
                            </template>
                        </el-form>
                    </yjCloseWrap>
                </div>

                <template v-for="(menuSonData, attrSonIndex) in menuData.sub_button" :key="attrSonIndex">
                    <yjCloseWrap @close="handleDelMenu(attrIndex, attrSonIndex + 1)">
                        <div class="mt-4 lg:mt-0 max-w-[400px]"  v-show="attrIndex === menuIndex && (attrSonIndex + 1) == menuSonIndex">
                            <div class="text-base oa-attr-title">菜单配置{{ attrSonIndex }}</div>
                            <el-form :model="form" label-width="120px">
                                <el-form-item label="菜单名称">
                                    <el-input v-model="menuSonData.name" />
                                </el-form-item>
                                <el-form-item label="跳转链接">
                                    <el-select v-model="menuSonData.type" placeholder="跳转链接">
                                        <el-option label="关键词" value="click" />
                                        <el-option label="小程序" value="miniprogram" />
                                        <el-option label="网页" value="view" />
                                    </el-select>
                                </el-form-item>
                                <el-form-item label="网址" prop="url" v-if="menuSonData.type == 'view'">
                                    <el-input v-model="menuSonData.url" />
                                </el-form-item>
                                <el-form-item label="关键词" prop="keyword" v-if="menuSonData.type == 'click'">
                                    <el-input v-model="menuSonData.key" />
                                </el-form-item>
                                <template v-if="menuSonData.type == 'miniprogram'">
                                    <!-- AppId -->
                                    <el-form-item label="AppId" prop="appid">
                                        <el-input v-model="menuSonData.appid" />
                                    </el-form-item>
                                    <!-- 路径 -->
                                    <el-form-item label="路径" prop="pagepath">
                                        <el-input v-model="menuSonData.pagepath" />
                                    </el-form-item>
                                </template>
                            </el-form>
                            </div>
                    </yjCloseWrap>
                </template>
            </template>
        </el-main>
        <el-footer>
            <el-button @click="onSave">保存</el-button>
        </el-footer>
</el-container>
</template>

<style lang="scss" scoped>
.oa-phone {
    width: 350px;
    height: 461px;
    border: 1px solid #e5e5ea;
    flex: none;

    &-content {
        height: 420px;
        border-bottom: 1px solid #e5e5ea;
    }

    &-menu {
        height: 40px;
        cursor: pointer;

        &-switch {
            width: 40px;
            height: 100%;
            border-right: 1px solid #e5e5ea;
        }

        // 一级菜单
        &-item {
            height: 100%;
            border-right: 1px solid #e5e5ea;
        }

        &-item:nth-child(4) {
            border-right: none;
        }

        .active-menu {
            position: relative;
        }

        .active-menu::after {
            content: '';
            width: 100%;
            height: 41px;
            top: -1px;
            position: absolute;
            border: 1px solid v-bind(themeColor);
        }

        // 二级菜单
        &-subitem {
            width: 98%;
            left: 2px;
            bottom: calc(100% + 46px);
            position: absolute;
            border: 1px solid #e5e5ea;
            border-top: none;

            &-title {
                height: 40px;
                line-height: 40px;
                text-align: center;
                border-top: 1px solid #e5e5ea;
            }
        }
    }
}
</style>

