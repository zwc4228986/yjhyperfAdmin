<template>
	<el-container class="full-height">
		<el-aside width="320px" class="aside-box">
			<el-container class="full-height" direction="vertical">
<!--				&lt;!&ndash; 搜索栏 &ndash;&gt;-->
				<el-header height="60px" class="header">
					<div class="from-search">
						<el-input
							v-model="input"
							prefix-icon="el-icon-search"
							placeholder="搜索聊天 / 好友 / 群组"
							size="small"
						/>
					</div>
<!--					&lt;!&ndash; 工具栏 &ndash;&gt;-->
					<div class="tools" >
						<el-button
							circle
							plain
							size="small"
							icon="el-icon-plus"
							@click="subMenu = !subMenu"
						/>
						<transition name="el-zoom-in-top">
							<div class="tools-menu" v-show="subMenu">
								<div class="menu-item" @click="triggerSubMenu(1)">
									创建群组
								</div>
								<div class="menu-item" @click="triggerSubMenu(2)">
									添加好友
								</div>
							</div>
						</transition>
					</div>
				</el-header>

<!--				&lt;!&ndash; 对话列表栏 &ndash;&gt;-->
				<el-scrollbar
					tag="section"
					ref="menusScrollbar"
					class="full-height"
					:native="false"
				>
					<el-main class="main">
						<p v-show="loadStatus == 2" class="empty-data">
							<i class="el-icon-loading" /> 数据加载中...
						</p>

<!--						<p v-show="loadStatus == 3 && talkNum == 0" class="empty-data">-->
<!--							暂无聊天消息-->
<!--						</p>-->

<!--						<p v-show="loadStatus == 3 && talkNum > 0" class="main-menu">-->
<!--							<span class="title">消息记录 ({{ talkNum }})</span>-->
<!--						</p>-->

<!--						&lt;!&ndash; <p v-show="loadStatus == 4" style="text-align:center;">数据加载失败，请点击重试！</p> &ndash;&gt;-->

<!--						&lt;!&ndash; 对话列表 &ndash;&gt;-->
<!--						<template v-if="loadStatus == 3">-->
<!--							<div-->
<!--								v-for="item in talkItems"-->
<!--								:key="item.index_name"-->
<!--								class="talk-item pointer"-->
<!--								:class="{ active: index_name == item.index_name }"-->
<!--								@click="clickTab(item.index_name)"-->
<!--								@contextmenu.prevent="talkItemsMenu(item, $event)"-->
<!--							>-->
<!--								<div class="avatar-box">-->
<!--                      <span v-show="!item.avatar">-->
<!--                        {{-->
<!--							  (item.remark_name-->
<!--									  ? item.remark_name-->
<!--									  : item.name-->
<!--							  ).substr(0, 1)-->
<!--						  }}-->
<!--                      </span>-->
<!--									<img-->
<!--										v-show="item.avatar"-->
<!--										:src="item.avatar"-->
<!--										:onerror="$store.state.detaultAvatar"-->
<!--									/>-->
<!--									<div-->
<!--										v-show="item.is_top == 0"-->
<!--										class="top-mask"-->
<!--										@click.stop="topChatItem(item)"-->
<!--									>-->
<!--										<i class="el-icon-top" />-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="card-box">-->
<!--									<div class="title">-->
<!--										<div class="card-name">-->
<!--											<p class="nickname">-->
<!--												{{-->
<!--													item.remark_name ? item.remark_name : item.name-->
<!--												}}-->
<!--											</p>-->
<!--											<div v-show="item.unread_num" class="larkc-tag">-->
<!--												{{ item.unread_num }}条未读-->
<!--											</div>-->
<!--											<div v-show="item.is_top" class="larkc-tag top">-->
<!--												TOP-->
<!--											</div>-->

<!--											<div v-show="item.is_robot" class="larkc-tag top">-->
<!--												BOT-->
<!--											</div>-->

<!--											<div-->
<!--												v-show="item.talk_type == 2"-->
<!--												class="larkc-tag group"-->
<!--											>-->
<!--												群组-->
<!--											</div>-->
<!--											<div-->
<!--												v-show="item.is_disturb"-->
<!--												class="larkc-tag disturb"-->
<!--											>-->
<!--												<i class="iconfont icon-xiaoximiandarao" />-->
<!--											</div>-->
<!--										</div>-->
<!--										<div class="card-time">-->
<!--											<u-time :value="item.updated_at" />-->
<!--										</div>-->
<!--									</div>-->
<!--									<div class="content">-->
<!--										<template-->
<!--											v-if="-->
<!--                            index_name != item.index_name && item.draft_text-->
<!--                          "-->
<!--										>-->
<!--											<span class="draft-color">[草稿]</span>-->
<!--											<span>{{ item.draft_text }}</span>-->
<!--										</template>-->
<!--										<template v-else>-->
<!--											<template v-if="item.is_robot == 0">-->
<!--                            <span-->
<!--								v-if="item.talk_type == 1"-->
<!--								:class="{ 'online-color': item.is_online == 1 }"-->
<!--							>-->
<!--                              [{{ item.is_online == 1 ? '在线' : '离线' }}]-->
<!--                            </span>-->
<!--												<span v-else>[群消息]</span>-->
<!--											</template>-->

<!--											<span>{{ item.msg_text }}</span>-->
<!--										</template>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!--						</template>-->
					</el-main>
				</el-scrollbar>
			</el-container>
		</el-aside>
	</el-container>
	{{loadStatus}}
</template>
<script>
import { mapGetters, mapState } from 'vuex'
export default {
	name: 'MessagePage',
	components: {

	},
	computed:{
		...mapGetters(['topItems', 'talkItems', 'unreadNum', 'talkNum']),
		...mapState({
			loadStatus: state => state.talk.loadStatus,
			talks: state => state.talk.items,
			// index_name: state => state.dialogue.index_name,
		}),
	},
	data() {
		return {
			subHeaderShadow: false,
			launchGroupShow: false,
			// 对话面板的传递参数
			params: {
				talk_type: 0,
				receiver_id: 0,
				nickname: '',
			},
			// 查询关键词
			input: '',
			// header 工具菜单
			subMenu: false,

			// 消息未读数计时器
			interval: null,
		}
	}
}
</script>

<style></style>

