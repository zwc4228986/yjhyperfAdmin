<template>
	
	<!-- 通栏布局 -->
	<template v-if="layout == 'header'">
		<header class="adminui-header">
			<div class="adminui-header-left">
				<div class="logo-bar">
					<img class="logo" src="img/logo.png" />
					<span>{{ $CONFIG.APP_NAME }}</span>
				</div>
				<ul v-if="!ismobile" class="nav">
					<li
						v-for="item in menu"
						:key="item"
						:class="pmenu.path == item.path ? 'active' : ''"
						@click="showMenu(item)"
					>
						<i :class="item.meta.icon || 'el-icon-menu'"></i>
						<span>{{ item.meta.title }}</span>
					</li>
				</ul>
			</div>
			<div class="adminui-header-right">
				<userbar></userbar>
			</div>
		</header>
		<section class="aminui-wrapper">
			<div
				v-if="!ismobile"
				:class="
					menuIsCollapse ? 'aminui-side isCollapse' : 'aminui-side'
				"
			>
				<div v-if="!menuIsCollapse" class="adminui-side-top">
					<h2>{{ pmenu.meta.title }}</h2>
				</div>
				<div class="adminui-side-scroll">
					<el-scrollbar>
						<el-menu
							:default-active="active"
							router
							:collapse="menuIsCollapse"
						>
							<NavMenu :navMenus="nextMenu"></NavMenu>
						</el-menu>
					</el-scrollbar>
				</div>
			</div>
			<Side-m v-if="ismobile"></Side-m>
			<div class="aminui-body el-container">
				<Topbar v-if="!ismobile"></Topbar>
				<Tags v-if="!ismobile && layoutTags"></Tags>
				<div class="adminui-main" id="adminui-main">
					<router-view v-slot="{ Component }">
						<keep-alive
							:include="this.$store.state.keepAlive.keepLiveRoute"
						>
							<component
								:is="Component"
								:key="$route.fullPath"
								v-if="$store.state.keepAlive.routeShow"
							/>
						</keep-alive>
					</router-view>
					<iframe-view></iframe-view>
				</div>
			</div>
		</section>
	</template>

	<!-- 经典布局 -->
	<template v-else-if="layout == 'menu'">
		<!-- <header class="adminui-header">
			<div class="adminui-header-left">
				<div class="logo-bar">
					<img class="logo" src="img/logo.png" />
					<span>{{ $CONFIG.APP_NAME }}</span>
				</div>
			</div>
			<div class="adminui-header-right">
				<userbar></userbar>
			</div>
		</header> -->
		<section class="aminui-wrapper">
		
			<div
				v-if="!ismobile"
				:class="
					menuIsCollapse ? 'aminui-side isCollapse' : 'aminui-side'
				"
			>
				<div class="adminui-side-scroll">
					<el-dropdown @command="switchPlatment">
						<div class="platment">
							任务平台
						</div>
						<template #dropdown>
							<el-dropdown-menu>
								<el-dropdown-item command="task">任务系统</el-dropdown-item>
								<el-dropdown-item command="shop">商城系统</el-dropdown-item>
							</el-dropdown-menu>
						</template>
					</el-dropdown>
					<el-scrollbar>
						<el-menu
							:default-active="active"
							router
							:collapse="menuIsCollapse"
						>
							<NavMenu :navMenus="menu"></NavMenu>
						</el-menu>
					</el-scrollbar>
				</div>
			</div>
			<Side-m v-if="ismobile"></Side-m>
			<div class="aminui-body el-container">
				<Topbar v-if="!ismobile"></Topbar>
				<Tags v-if="!ismobile && layoutTags"></Tags>
				<div class="adminui-main" id="adminui-main">
					<router-view v-slot="{ Component }">
						<keep-alive
							:include="this.$store.state.keepAlive.keepLiveRoute"
						>
							<component
								:is="Component"
								:key="$route.fullPath"
								v-if="$store.state.keepAlive.routeShow"
							/>
						</keep-alive>
					</router-view>
					<iframe-view></iframe-view>
				</div>
			</div>
		</section>
	</template>

		<!-- 经典布局 -->
		<template v-else-if="layout == 'menu1'">
		<header class="adminui-header">
			<div class="adminui-header-left">
				<div class="logo-bar">
					<img class="logo" src="img/logo.png" />
					<span>{{ $CONFIG.APP_NAME }}</span>
				</div>
			</div>
			<div class="adminui-header-right">
				<userbar></userbar>
			</div>
		</header>
		<section class="aminui-wrapper">
			<div
				v-if="!ismobile"
				:class="
					menuIsCollapse ? 'aminui-side isCollapse' : 'aminui-side'
				"
			>
				<div class="adminui-side-scroll">
					<el-scrollbar>
						<el-menu
							:default-active="active"
							router
							:collapse="menuIsCollapse"
						>
							<NavMenu :navMenus="menu"></NavMenu>
						</el-menu>
					</el-scrollbar>
				</div>
			</div>
			<Side-m v-if="ismobile"></Side-m>
			<div class="aminui-body el-container">
				<Topbar v-if="!ismobile"></Topbar>
				<Tags v-if="!ismobile && layoutTags"></Tags>
				<div class="adminui-main" id="adminui-main">
					<router-view v-slot="{ Component }">
						<keep-alive
							:include="this.$store.state.keepAlive.keepLiveRoute"
						>
							<component
								:is="Component"
								:key="$route.fullPath"
								v-if="$store.state.keepAlive.routeShow"
							/>
						</keep-alive>
					</router-view>
					<iframe-view></iframe-view>
				</div>
			</div>
		</section>
	</template>
	<!-- 功能坞布局 -->
	<template v-else-if="layout == 'dock'">
		<header class="adminui-header">
			<div class="adminui-header-left">
				<div class="logo-bar">
					<img class="logo" src="img/logo.png" />
					<span>{{ $CONFIG.APP_NAME }}</span>
				</div>
			</div>
			<div class="adminui-header-right">
				<div v-if="!ismobile" class="adminui-header-menu">
					<el-menu mode="horizontal" :default-active="active" router>
						<NavMenu :navMenus="menu"></NavMenu>
					</el-menu>
				</div>
				<Side-m v-if="ismobile"></Side-m>
				<userbar></userbar>
			</div>
		</header>
		<section class="aminui-wrapper">
			<div class="aminui-body el-container">
				<div class="adminui-main" id="adminui-main">
					<router-view v-slot="{ Component }">
						<keep-alive
							:include="this.$store.state.keepAlive.keepLiveRoute"
						>
							<component
								:is="Component"
								:key="$route.fullPath"
								v-if="$store.state.keepAlive.routeShow"
							/>
						</keep-alive>
					</router-view>
					<iframe-view></iframe-view>
				</div>
			</div>
		</section>
	</template>

	<template v-else>
	<section class="aminui-wrapper">
		<div v-if="!ismobile" class="aminui-side-split">
			<div class="adminui-side-split-scroll">
				<el-scrollbar>
					<ul>
						<template v-for="item in menu">
							<li
								:key="item"
								v-if="item.position == 'top'"
								:class="pmenu.name == item.name ? 'active' : ''"
								@click="showMenu(item)"
							>
								<el-icon><component :is="item.meta.icon || el-icon-menu" /></el-icon>
								<p>{{ item.meta.title }}</p>
							</li>
						</template>
					</ul>
				</el-scrollbar>
			</div>
			<div class="adminui-side-split-scroll">
				<el-scrollbar>
					<ul>
						<template v-for="item in menu">
						<li
							:key="item"
							v-if="item.position == 'bottom'"
							:class="pmenu.name == item.name ? 'active' : ''"
							@click="showMenu(item)"
						>
							<el-icon><component :is="item.meta.icon || el-icon-menu" /></el-icon>
							<p>{{ item.meta.title }}</p>
						</li>
						</template>
					</ul>
				</el-scrollbar>
			</div>
		</div>
		<div
			v-if="!ismobile"
			:class="menuIsCollapse ? 'aminui-side isCollapse' : 'aminui-side'"
		>
			<div v-if="!menuIsCollapse" class="adminui-side-top">
				<h2>{{ pmenu.meta.title }}</h2>
			</div>
			<div class="adminui-side-scroll">
				<el-scrollbar>
					<el-menu
						:default-active="active"
						router
						:collapse="menuIsCollapse"
					>
						<NavMenu :navMenus="nextMenu"></NavMenu>
					</el-menu>
				</el-scrollbar>
			</div>
		</div>
		<Side-m v-if="ismobile"></Side-m>
		<div class="aminui-body el-container">
			<Topbar>
				<userbar></userbar>
			</Topbar>
			<Tags v-if="!ismobile && layoutTags"></Tags>
			<div class="adminui-main" id="adminui-main">
				<router-view v-slot="{ Component }">
					<keep-alive
						:include="this.$store.state.keepAlive.keepLiveRoute"
					>
						<component
							:is="Component"
							:key="$route.fullPath"
							v-if="$store.state.keepAlive.routeShow"
						/>
					</keep-alive>
				</router-view>
				<iframe-view></iframe-view>
			</div>
		</div>
	</section>
	</template>
	<div class="layout-setting" @click="openSetting">
		<el-icon>
			<el-icon-brush/>
		</el-icon>
	</div>

	<el-drawer
		title="布局实时演示"
		v-model="settingDialog"
		:size="400"
		append-to-body
		destroy-on-close
	>
		<setting></setting>
	</el-drawer>
</template>

<script>
import SideM from "./components/sideM.vue";
import Topbar from "./components/topbar.vue";
import Tags from "./components/tags.vue";
import NavMenu from "./components/NavMenu.vue";
import userbar from "./components/userbar.vue";
import setting from "./components/setting.vue";
import iframeView from "./components/iframeView.vue";
import Store from "@/store";
export default {
	name: "index",
	components: {
		SideM,
		Topbar,
		Tags,
		NavMenu,
		userbar,
		setting,
		iframeView,
	},
	data() {
		return {
			settingDialog: false,
			menu: [],
			nextMenu: [],
			pmenu: {
				meta: {},
			},
			active: "",
		};
	},
	computed: {
		ismobile() {
			return this.$store.state.global.ismobile;
		},
		layout() {
			return this.$store.state.global.layout;
		},
		layoutTags() {
			return this.$store.state.global.layoutTags;
		},
		menuIsCollapse() {
			return this.$store.state.global.menuIsCollapse;
		},
	},
	async created() {
		this.onLayoutResize();
		window.addEventListener("resize", this.onLayoutResize);
		// var menu = this.$TOOL.data.get("MENU");
		let menu = await Store.dispatch("getMenus");
		this.menu = this.filterUrl(menu);
		this.showThis();
	},
	watch: {
		$route() {
			this.showThis();
		},
		layout: {
			handler(val) {
				document.body.setAttribute("data-layout", val);
			},
			immediate: true,
		},
		active(url,path) {
			// console.log('active',val,path);
			let urls = url.split("?");
			let query = {};
			if(urls.length==2){
				let arr = urls[1].split("&");
				this.$YJ.forEach(arr,res=>{
					console.log('active',res);
					var data = res.split("=");
					query[data[0]] = data[1];
				})
			}


				this.$router.push({
					path: url,
					query:query
				});
		},
	},
	methods: {
		openSetting() {
			this.settingDialog = true;
		},
		onLayoutResize() {
			const clientWidth = document.body.clientWidth;
			if (clientWidth < 992) {
				this.$store.commit("SET_ismobile", false);
			} else {
				this.$store.commit("SET_ismobile", false);
			}
		},
		//路由监听高亮
		showThis() {
			this.pmenu = this.$route.meta.breadcrumb
				? this.$route.meta.breadcrumb[0]
				: {};

			this.nextMenu = this.filterUrl(this.pmenu.children);
			this.$nextTick(() => {
				this.active = this.$route.meta.active || this.$route.fullPath;
			});

		},
		switchPlatment(e){
			console.log(e);
			if(e=='shop'){
				window.location.href="http://xmbshop.haishuju.vip/admin"
			}
		},
		//点击显示
		showMenu(route) {
			console.log(route);
			this.pmenu = route;
			this.nextMenu = this.filterUrl(route.children);
			if((!route.children || route.children.length == 0) && route.component){
				this.$router.push({path: route.path})
			}
			this.getRouteFirstChild(route);
		},
		getRouteFirstChild(route) {
			if(this.$YJ.has(route,'children') && this.$YJ.get(route,'children').length>0)
			{
				this.getRouteFirstChild(this.$YJ.get(route,'children')[0]);
			}else{
				this.$nextTick(() => {
					this.active = route.path;
				});
			}
			// if (route.children) {

				/*route = route.children[0].path;

				if(route.children){
					route = route.children[0].path;
				}*/

			// }
		},
		//转换外部链接的路由
		filterUrl(map) {
			var newMap = [];
			map &&
				map.forEach((item) => {
					item.meta = item.meta ? item.meta : {};
					//处理隐藏
					if (item.meta.hidden) {
						return false;
					}
					//处理http
					// if (item.meta.type == "iframe") {
					// 	item.path = `/i/${item.name}`;
					// }
					//递归循环
					if (item.children && item.children.length > 0) {
						item.children = this.filterUrl(item.children);
					}
					newMap.push(item);
				});
			return newMap;
		},
	},
};
</script>
<style>
.platment{
	width: 200px;
	display: flex;
	justify-content: center;
	align-items: center;
	font-weight: bold;
	height: 50px;
}
</style>