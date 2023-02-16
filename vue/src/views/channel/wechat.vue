<script setup>
import { MenuData } from './data'
console.log(MenuData)

const {menuList,handleAddMenu} = MenuData()

</script>
<template>
	<el-container>
		<el-header>
            <el-alert
                type="warning"
                title="配置微信公众号菜单，点击确认，保存菜单并发布至微信公众号"
                :closable="false"
                show-icon
            />
		</el-header>
		<el-main class="bg-white">
			<div class="oa-phone mr-[35px]">
				<div class="oa-phone-content"></div>

					<div class="flex oa-phone-menu">
						<div class="flex items-center justify-center oa-phone-menu-switch">
							<i-all-application theme="outline" size="24" fill="#333"/>
						</div>
						<template v-for="(menuItem, i) in menuList" :key="i">
							<div class="relative flex-1" @click="menuIndex = i">
								<!-- 一级菜单 -->
								<div
									class="flex items-center justify-center flex-1 text-sm oa-phone-menu-item"
									:class="{ 'active-menu': menuIndex === i }"
								>
									{{ menuItem.name }}
								</div>
								<!-- 二级菜单 -->
								<div
									class="oa-phone-menu-subitem"
								>
										<div class="oa-phone-menu-subitem-title">
											<i-add-three theme="outline" size="24" fill="#333"/>
										</div>
								</div>
								<div
									class="oa-phone-menu-subitem"
									v-show="menuItem.sub_button.length && menuItem.has_menu"
								>
									<template v-for="(subItem, index2) in menuItem.sub_button" :key="index2">
										<div class="oa-phone-menu-subitem-title">
											{{ subItem.name }}
										</div>
									</template>
								</div>
							</div>
						</template>
						<!-- 新增菜单 -->
						<template v-if="menuList.length <= 2">
							<div class="flex items-center justify-center flex-1 h-full" @click="handleAddMenu">
								<i-add-three theme="outline" size="24" fill="#333"/>
							</div>
						</template>
					
				</div>

				<div class="mt-4 lg:mt-0 max-w-[400px]">
               			 11111
                </div>
    </div>
		</el-main>
	</el-container>
</template>

<style lang="scss" scoped>
.oa-phone {
    width: 260px;
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
            bottom: calc(100% + 10px);
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

