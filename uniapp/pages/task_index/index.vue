<template>
  <view class="warp">
    <!-- 顶部导航 -->
    <!-- <page-meta background-text-style="#000000"><navigation-bar background-color="#FF9742" :title="titleText" /></page-meta> -->
    <!-- 搜索 -->
	<view class="header-box">
		<!-- #ifdef APP-PLUS -->
			<view class="status-bar"></view>
		<!-- #endif -->
			<view class="header">
				<view class="address-icon">
				  <!--   <u-icon name="chat" size="30px"></u-icon> -->
				  <image src="/static/images/task//zuobiao.png" ></image>
				   <!-- <u-image customStyle="margin-right: 14rpx" width="24rpx" height="24rpx" src="/static/images/task/自助推广@2x.png"></u-image> -->
				  {{address}}
				</view>
			  <u-search @input="search" :showAction="false" placeholder="搜索"></u-search>
			  <view class="chat-icon" @click="toChat">
			  <!--   <u-icon name="chat" size="30px"></u-icon> -->
			  <image src="/static/images/task/mail.png" ></image>
			   <!-- <u-image customStyle="margin-right: 14rpx" width="24rpx" height="24rpx" src="/static/images/task/自助推广@2x.png"></u-image> -->
			  <!-- <u-badge :absolute="true" :offset="[0, 0]" max="99" :value="unReadNum"></u-badge> -->
			</view>
		</view>
	</view>
	
	<!-- #ifdef APP-PLUS -->
	<view class="status-bar"></view>
	<!-- #endif -->
	
    <view style="height: 54px;"></view>
    <!-- 官方推荐 -->
    <view class="recommend-box">
		
      <view class="recommend-title"><view class="icon"><image src="@/static/images/zan.png"></image></view>官方推荐</view>
      <view class="recommend-detail ">
        <swiper class="swiper" circular :current="current" :indicator-dots="true"  :autoplay="false" :interval="5000" :duration="500">
          <swiper-item v-for="(item, index) in taskRecommentLists" :key="index">
            <view class="task-item" @click="toDetail(item.id)">
              <view class="image"><u-image width="60px" height="60px" :src="item.image.full_path"></u-image></view>
              <view class="mid">
                <view class="title">{{ item.product_name }} {{ item.title }}</view>
                <view class="desc">{{ item.desc }}</view>
                <view class="mid-info">
					<image src="/static/images/task/zan.png"></image>
					官方推荐原因：{{ item.recomment_reason }}
				</view>
              </view>
              <view class="left">
                <view class="left-box">
                  <view class="recommend-detail-change" @click.stop="changeCurrent(0)">
                    <u-icon size="14" name="reload"></u-icon>
                    <view style="margin-left: 5rpx;">换一个</view>
                  </view>
                  <view class="price"><u-text color="#E0171C" bold size="30rpx" :text="item.one_price+'小豆'"></u-text></view>
                </view>
              </view>
            </view>
          </swiper-item>
        </swiper>
      </view>
    </view>
	
	<!-- 热榜 -->
	<view class="hot-wrapper">
		<view class="hot-box">
				<image class="hot-img" src="/static/images/task/hot.png"></image>
				<text class="hot-desc">热榜</text>
				<!-- 内容区 -->
				<view class="hot-content">
					<swiper style="" :autoplay="true" interval="2500" :duration="1000"
						vertical="true" circular="true">
						<block v-for="(item,index) in hotLists" :key='index'>
							<swiper-item catchtouchmove='catchTouchMove'>
								<image alt="error"></image>
								{{item.user.nickname}} {{item.create_time_format}}完成任务, 获得
								<text class="bean">{{(item.task_price*10).toFixed(0)}}小豆</text>
								<!-- <text class="iconfont icon-xiangyou"></text> -->
							</swiper-item>
						</block>
					</swiper>
				</view>
		</view>
	</view>

	<view class="nav-box">
      <!-- 任务模块 -->
      <u-sticky offset-top="54" bgColor="transparent">
        <view class="yj-tabs-box"><yj-tabs :list="list1" :scrollable="false" :isLine="false" :itemStyle="{height:'208rpx'}" @click="changeTabs"></yj-tabs></view>
      </u-sticky>
      <view style="height: 30rpx;"></view>
      <!-- 筛选条件 -->
      <view class="sort-box">
        <view v-if="taskListsParams.types===1" class="audit-policy">
          <view class="title">
            <u-image customStyle="margin-right: 14rpx" width="24rpx" height="24rpx" src="/static/images/task/z.png"></u-image>
            <text>极速榜单审核规则</text>
          </view>
          <view class="content">
			{{task_fast_rule}}
		  </view>
        </view>
        <u-tabs
          :list="tabs"
          lineHeight="0"
          @click="changeSort"
          :inactiveStyle="{
            color: '#999999'
          }"
          :activeStyle="{
            color: '#303133',
            fontWeight: 'bold',
            transform: 'scale(1.05)'
          }"
          itemStyle="font-size: 24rpx;height:30px;margin:10rpx 0 0;"
        ></u-tabs>
        <u-tabs
          :list="types"
          keyName="title"
          lineHeight="0"
          @click="changeTypes"
          :inactiveStyle="{
            padding: '0 32rpx',
            borderRadius: '24rpx',
            boxShadow: '0px 0px 10px 0px rgba(153,153,153,0.2)'
          }"
          :activeStyle="{
            color: '#F59245',
            padding: '0 32rpx',
            borderRadius: '24rpx',
            boxShadow: '0px 0px 10px 0px rgba(245, 146, 69,0.2)'
          }"
          itemStyle="font-size: 24rpx;height:48rpx;line-height: 48rpx;margin:10rpx 0 30rpx;"
        ></u-tabs>
      </view>


      <!-- 	<view class="types-box">
				<view class="item" :class="{active:''===taskListsParams.task_types}" @click="changeTaskTypes('')">
					全部
				</view>
				<view class="item" :class="{active:item.id===taskListsParams.task_types}"  v-for="item in types" @click="changeTaskTypes(item.id)">
					{{item.title}}
				</view>
			</view> -->
      <!-- 任务内容 -->
      <view class="task-warp">
        <view class="task-box">
          <u-empty v-if="taskLists.length == 0" mode="list" icon=""></u-empty>
          <view class="task-item" v-for="(item, index) in taskLists" :key="index" @click="toDetail(item.id)">
            <view class="top" v-if="item.top_time > 0">
              <u-image width="80rpx" height="38rpx" :src="`${IMAGE_URL}/static/images/task/zhiding.png`"></u-image>
            </view>
            <view class="content">
              <view class="image">
                <u-image width="120rpx" height="120rpx" :src="item.image.full_path"></u-image>
              </view>
              <view class="mid">
                <view class="title">
                  <view class="title-text">
                    {{ item.product_name }} {{ item.title }}
                  </view>
                  <!-- <u-image v-if="true" customStyle="margin-left:22rpx;" width="103rpx" height="28rpx" :src="IMAGE_URL+'/static/images/task/huiyuan.png'"></u-image> -->
                </view>
                <view class="desc">{{ item.desc }}</view>
                <view class="mid-info">
                  <view class="price"><u-text color="#EA3C3C" bold size="28rpx" :text="item.beans+'小豆'"></u-text></view>
                  <view class="tag"><u-tag borderColor="#F58527" color="#F58527" bgcolor="#ffffff" shape="circle" :text="item.task_types.title" plain size="mini"></u-tag></view>
                </view>
              </view>
              <view class="left">
                <view class="left-box">
                  <view class="op"><u-button :custom-style="{ color: '#ffffff', height: '50rpx' }" size="small" color="linear-gradient(-32deg, #F58325, #FF9640)" shape="circle" text="马上赚"></u-button></view>
                </view>
              </view>
            </view>
            <view class="content-bottom">
              <text>剩余单数：{{ item.stock }}单</text>
              <text>{{ item.finish }}人已赚取</text>
            </view>
          </view>
        </view>
      </view>
    </view>
    <view style="height:50px"></view>
	<popupAd></popupAd>
   <tabBar v-if="!is_diy" :pagePath="'/pages/user/index'"></tabBar>
   <view class="foot" v-else-if="is_diy && newData.status && newData.status.status">
   	<view class="page-footer" id="target" :style="{'background-color':newData.bgColor.color[0].item}">
   		<view class="foot-item" v-for="(item,index) in newData.menuList" :key="index" @click="goRouter(item)">
   			<block v-if="item.link == activeRouter">
   				<image :src="item.imgList[0]"></image>
   				<view class="txt" :style="{color:newData.activeTxtColor.color[0].item}">{{item.name}}</view>
   			</block>
   			<block v-else>
   				<image :src="item.imgList[1]"></image>
   				<view class="txt" :style="{color:newData.txtColor.color[0].item}">{{item.name}}</view>
   			</block>
   			<div class="count-num" v-if="item.link === '/pages/order_addcart/order_addcart' && cartNum > 0">
   				{{cartNum}}
   			</div>
   		</view>
   	</view>
   </view>
  </view>
</template>

<script>
	import {
		getNavigation,
	} from '@/api/public.js'
import popupAd from './popupAd';
import { taskTypes } from '@/api/task.js';
import { getAddressCityName } from '@/api/util.js';
import tabBar from '@/pages/index/visualization/components/tabBar.vue';
import { getShare } from '@/api/public.js';
import { getConfig } from '@/api/config.js';
import { taskLists, taskRecommentLists,taskHotLists} from '@/api/task.js';
import {
	IMAGE_URL
} from "@/config/app.js";
export default {
  data() {
    return {
	  IMAGE_URL:IMAGE_URL,
      titleText: '悬赏大厅',
	  address:'全国',
      tabs: [
        {
          sort: '',
          name: '默认排序'
        },
        {
          sort: 'one_price',
          name: '高佣金'
        },
		{
		  sort: 'create_time',
		  name: '最新排序'
		}
      ],
      current: 0,
      taskListsParams: {
        task_types_id: 0,
        types: 1,
        page: 1,
        sort: '',
		title:'',
      },
      tabBar: {}, //导航
      taskLists: [],
      taskRecommentLists: [],
      tabBarList: {
        title: '图片建议宽度81*81px',
        list: [
          {
            name: '首页'
          },
          { name: '我的' }
        ]
      },
	  activeRouter:"",
      list1: [
        {
          types: 1,
          name: '极速赚',
          title: "悬赏大厅",
          img: IMAGE_URL+'/static/images/task/icon1.png',
        },
        {
          types: 2,
          name: '任务赚',
          title: "福利大厅",
          img:IMAGE_URL+'/static/images/task/icon2.png',
        },
        {
          types: 3,
          name: '游戏赚',
          title: "游戏大厅",
          img:IMAGE_URL+'/static/images/task/icon3.png',
        },
        {
          types: 4,
          name: '转发赚',
          title: "转发大厅",
          img:IMAGE_URL+'/static/images/task/icon4.png',
        }
      ],
	  newData: {},
	  hotLists:[],
      isDiy: true,
      shareInfo: {},
      types: [],
	  task_fast_rule:"",
	  is_diy: uni.getStorageSync('is_diy'),
    };
  },
  components: {
	popupAd,
    tabBar
  },
  onShow() {
	  
    uni.$on('is_diy', data => {
      this.isDiy = data;
    });
    this.setOpenShare();
	this.getTaskHot()
  },
  onLoad() {
    // uni.hideTabBar();
   if (this.is_diy) {
   	if (uni.getStorageSync('FOOTER_BAR')) {
   		uni.hideTabBar()
   	}
   	getNavigation().then(res => {
   		this.newData = res.data
   		if (this.newData.status && this.newData.status.status) {
   			uni.hideTabBar()
   		} else {
   			uni.showTabBar()
   		}
   	})
	let routes = getCurrentPages(); // 获取当前打开过的页面路由数组
	let curRoute = routes[routes.length - 1].route //获取当前页面路由
	this.activeRouter = '/' + curRoute
   }
   
	getConfig(["task_fast_rule"],(res)=>{
		thistask_fast_rule = res.task_fast_rule
	})
    this.getType();
    this.getTaskLists();
	this.getAddress();
    this.getTaskRecommentLists();
    setInterval(res => {
      this.changeCurrent();
    }, 5000);
  },
  computed: {
    unReadNum() {
      return this.$store.state.webSocket.unReadNum;
    }
    // return  :value="!((voltage>>7)&1)"
  },
  onHide() {
    // this.isDiy = -1
  },
  methods: {
	getAddress(){
		  if(this.$Cache.has('user_latitude') &&  this.$Cache.has('user_longitude')){
			  getAddressCityName(this.$Cache.get('user_latitude'),this.$Cache.get('user_longitude')).then(res=>{
					this.address = res?.addressComponent?.city ?? '全国';
			  })
		  }
		 
	},
	getTaskHot(){
		taskHotLists().then(res=>{
			this.hotLists = res;
		})
	},
    changeTaskTypes(task_types) {
      this.taskListsParams.task_types = task_types;
    },
    getType() {
      taskTypes().then(res => {
        this.types = res;
        this.types.unshift({
          id: 0,
          title: '全部'
        });
      });
    },
    changeCurrent() {
      if (this.current == this.taskRecommentLists.length - 1) {
        this.current = 0;
      } else {
        this.current = this.current + 1;
      }
    },
    changeTypes(e) {
      console.log(e);
      this.taskListsParams.task_types_id = e.id;
      this.getTaskLists();
    },
	search(keyword){
		console.log(keyword);
		this.taskListsParams.title = keyword;
		this.getTaskLists();
	},
    changeSort(e) {
      this.taskListsParams.sort = e.sort;
      this.getTaskLists();
    },
    changeTabs(e) {
      this.taskListsParams.types = e.types;
      this.titleText = e.title
      this.getTaskLists();
    },
    toChat() {
      uni.navigateTo({
        url: '/pages/chat/friends/friends'
      });
    },
    onReachBottom() {
      this.getTaskLists();
    },
    toDetail(id) {
      uni.navigateTo({
        url: '/pages/task/detail?task_id=' + id
      });
    },
    getTaskLists() {
      taskLists(this.taskListsParams).then(res => {
        console.log(res);
        this.taskLists = res.data;
      });
    },
    getTaskRecommentLists() {
      taskRecommentLists(this.taskListsParams).then(res => {
        console.log(res);
        this.taskRecommentLists = res.data;
      });
    },
    // 微信分享；
    setOpenShare: function() {
      let that = this;
      getShare().then(res => {
        let data = res.data;
        this.shareInfo = data;
        // #ifdef H5
        let url = location.href;
        if (this.$store.state.app.uid) {
          url = url.indexOf('?') === -1 ? url + '?spread=' + this.$store.state.app.uid : url + '&spread=' + this.$store.state.app.uid;
        }
        if (that.$wechat.isWeixin()) {
          let configAppMessage = {
            desc: data.synopsis,
            title: data.title,
            link: url,
            imgUrl: data.img
          };
          that.$wechat.wechatEvevt(['updateAppMessageShareData', 'updateTimelineShareData'], configAppMessage);
        }
        // #endif
      });
    }
  },

  // #ifdef MP
  //发送给朋友
  onShareAppMessage(res) {
    // 此处的distSource为分享者的部分信息，需要传递给其他人
    let that = this;
    return {
      title: this.shareInfo.title,
      path: '/pages/index/index',
      imageUrl: this.shareInfo.img
    };
  },
  //分享到朋友圈
  onShareTimeline() {
    return {
      title: this.shareInfo.title,
      imageUrl: this.shareInfo.img
    };
  }
  // #endif
};
</script>

<style lang="scss" scoped>
page {
  font-size: 28rpx;
  color: #333;
  background-color: white;
}
.header-box{
	position: fixed;
	top: 0;
	left: 0;
	  width: 100%;
	background: #FF9742;
	 z-index: 999;
}
.header {
 
  width: 100%;
  display: flex;
  padding: 20rpx;
  // height: calc(var(--status-bar-height) + 54px);
	height: 54px;
  .address-icon{
	  width:70px;
	  color: white;
	  image {
	  	width: 25rpx;
	  	height: 32rpx;
		margin-right: 10rpx;
	  }
	  display: flex;
	  align-items: center;
	  justify-content: center;
  }
  .chat-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    position: relative;
	image {
		width: 42rpx;
		height: 36rpx;
	}
  }
}
.nav-box {
  .yj-tabs-box{
    height: 208rpx;
    background: #FFFFFF;
    border-radius: 0px 0px 30rpx 30rpx;
    overflow: hidden;
  }
}
.types-box {
  padding: 0 30rpx;
  display: flex;
  font-size: 24rpx;
  margin-bottom: 20rpx;
  .item {
    padding: 8rpx 13rpx;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    border: 1px solid #888;
    border-radius: 30rpx;
    margin-left: 20rpx;
  }
  .item.active {
    border: none;
  }
}
.sort-box {
  background-color: #ffffff;
  margin-bottom: 30rpx;
  .audit-policy{
    padding: 30rpx 24rpx 0;
    .title{
      font-size: 30rpx;
      font-family: PangMenZhengDao;
      color: #F58325;
      font-weight: bold;
      display: flex;
      align-items: center;
    }
    .content{
      padding: 26rpx 16rpx 0;
      font-size: 22rpx;
      font-family: PingFang SC;
      font-weight: 500;
      color: #666666;
      line-height: 38rpx;
    }
  }
  .item {
    margin-right: 30rpx;
    position: relative;
  }
  .item.active::before {
    content: ' ';
    height: 2px;
    width: 30px;
    bottom: 0;
    position: absolute;
    background: '#FCC704';
  }
}

.task-warp {
  padding: 0 20rpx;
  .task-item {
    background-color: #ffffff;
    border-radius: 20rpx;
    display: flex;
    flex-direction: column;
    margin-bottom: 30rpx;
    padding: 30rpx 20rpx;
    position: relative;
    .content{
      width: 100%;
      align-items: center;
      display: flex;
      padding-bottom: 30rpx;
    }
    .content-bottom{
      display: flex;
      justify-content: space-between;
      position: relative;
      padding-top: 30rpx;
      font-size: 22rpx;
      &:after{
        position: absolute;
        content: '';
        height: 2rpx;
        width: 100%;
        top: 0;
        left: 0;
        background-color: #CCCCCC;
        opacity: 0.5;
      }
    }
    .image {
      height: 100%;
      width: 120rpx;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .top {
      position: absolute;
      right: 0;
      top: 0;
      display: flex;
    }
    .mid {
      flex: 10;
      padding: 0 20rpx;
      .title {
        color: #333;
        font-size: 28rpx;
        font-weight: bold;
        display: flex;
        align-items: center;
        .title-text{
          min-width: 0;
          overflow: hidden;
          white-space: nowrap;
          text-overflow: ellipsis;
        }
      }
      .desc {
        margin-top: 6rpx;
        color: #787878;
        font-size: 22rpx;
      }
      .mid-info {
        margin-top: 12rpx;
        display: flex;
        .tag {
          padding-left: 10px;
        }
      }
    }

	
    .left {
		flex:1;
	  width: 100%;
      display: flex;
	  justify-content: flex-end;
      .left-box {
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
        height: 110rpx;
      }
    }
  }
}

.recommend-box {
  padding: 10rpx 30rpx;
  background: #ffffff;
  position: relative;
  &:after{
    position: absolute;
    content: '';
    width: 100%;
    height: 200rpx;
    background-color: #FF9742;
    border-radius: 0 0 30rpx 30rpx;
    top: 0;
    left: 0;
  }
  .task-item {
    padding: 20rpx;
    align-items: center;
    display: flex;

    .image {
      height: 100%;
      width: 140rpx;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .mid {
      flex: 1;
      padding: 0 20rpx;
      .title {
        color: #333;
        font-size: 28rpx;
        font-weight: bold;
      }
      .desc {
        margin-top: 10rpx;
        color: #787878;
        font-size: 20rpx;
      }
      .mid-info {
        color: #f06267;
        margin-top: 12rpx;
        display: flex;
        font-size: 20rpx;
		image {
			width: 24rpx;
			height: 24rpx;
		}
        .tag {
          padding-left: 10px;
        }
      }
    }
    .left {
      display: flex;
      align-items: center;
      .left-box {
        display: flex;
        flex-direction: column;
        // justify-content: space-around;
        align-items: flex-end;
        height: 110rpx;
        .stock {
          color: #787878;
          font-size: 22rpx;
        }
      }
    }
  }
  .recommend-title {
	  .icon{
		  margin-right: 10rpx;
		  height: 25rpx;
		  width: 25rpx;
		  image{
			  width: 100%;
			  height: 100%;
		  }
	  }
	display: flex;
    font-weight: bold;
    margin-bottom: 20rpx;
    color: #ffffff;
    position: relative;
    z-index: 1;
  }
  .recommend-detail {
    position: relative;
    z-index: 1;
    background: #FEFDFB;
    box-shadow: 0px 2rpx 15rpx 1px rgba(95,47,7,0.1);
    border-radius: 18rpx;
    .swiper{
      height: 208rpx;
    }
    .recommend-detail-change {
      display: flex;
      color: #000;
      align-items: center;
      margin-bottom: 20rpx;
      font-size: 22rpx;
    }
  }
  .op {
    display: flex;
    // margin-top: 10rpx;
    justify-content: center;
  }
}

.hot-wrapper {
	padding: 0 20rpx;
	background-color: #fff;
	.hot-box {
		display: flex;
		justify-content: space-between;
		border-bottom: 1rpx solid rgba(204, 204, 204, 0.5);
		height: 30px;
			.hot-img {
				width: 20rpx;
				height: 30rpx;
				margin-right: 20rpx;
			}
			.hot-text {
				font-size: 32rpx;
				font-family: PangMenZhengDao;
				font-weight: bold;
				color: #0B8963;
				background: linear-gradient(-24deg, #FD565E 0%, #FCD895 100%);
				-webkit-background-clip: text;
				-webkit-text-fill-color: transparent;
			}
			.hot-content {
				display: flex;
				flex: 1;
				align-content: center;
				font-size: 22rpx;
				font-family: PingFang SC;
				font-weight: 500;
				color: #999999;
				image {
					width: 27rpx;
					height: 27rpx;
					border-radius: 50%;
				}
				.bean {
					color: #FF4A0D;
				}
				swiper{
					width: 100%;
					height: 20px;
				}
		}
		
		.right {
			color: #B5B5B5;
		}
	}
}

</style>
