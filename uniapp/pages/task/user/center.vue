<template>
  <view class="warp">
    <view class="user-header">
      <view class="task-info">
        <view class="image">
          <u-image width="50px" height="50px" :src="userInfo.avatar"></u-image>
        </view>
        <view class="mid">
          <view class="title">
            {{ userInfo.nickname }}
          </view>
          <view class="mid-info"> 余额 | {{ userInfo.now_money }} </view>
        </view>
		<view class="task-info-left">
			<yj-button
			  bg="#FF9640"
			  color="white"
			  :customStyle="{ width: '60%',height:'50rpx',marginLeft:'30rpx'}"
			  shape="circle"
			  text="提现"
			  @click="toPages('/pages/users/user_cash/index')"
			></yj-button>
			<yj-button
			  color="#FF9640"
			  :customStyle="{ width: '60%',height:'50rpx',marginLeft:'30rpx'}"
			  shape="circle"
			  text="充值"
			  @click="toPages('/pages/users/user_payment/index')"
			></yj-button>
		</view>
      </view>
    </view>
    <u-gap height="15" bgColor="#F7F7F7"></u-gap>
    <view class="header">
      <u-grid :border="false" @click="onGrid" col="4">
        <u-grid-item
          v-for="(baseListItem, baseListIndex) in baseList"
          :key="baseListIndex"
        >
          <uni-icons
            style="padding-top: 30rpx"
            color="#F58325"
            custom-prefix="iconfont"
            :type="baseListItem.name"
            size="30"
          ></uni-icons>
          <text class="grid-text">{{ baseListItem.title }}</text>
        </u-grid-item>
      </u-grid>
    </view>
    <view class="mid">
      <u-tabs
        :list="tabs"
        lineWidth="20"
        lineHeight="2"
        lineColor="#F58325"
        @click="changeTabs"
        :activeStyle="{
          background: 'white',
          color: '#303133',
          fontWeight: 'bold',
          transform: 'scale(1.05)',
        }"
        itemStyle="font-size: 24rpx;height:30px"
        :scrollable="true"
      ></u-tabs>
      <view class="task-warp">
        <view class="task-box">
		  <emptyPage v-if="taskLists.length == 0" title="暂无记录"></emptyPage>
          
		  <view
			v-else
            class="task-item"
            v-for="(item, index) in taskLists"
            :key="index"
            @click="toDetail(item.id)"
          >
            <view class="task-item-top">
              <view class="title">
                {{ item.product_name }} {{ item.title }}
              </view>
              <view class="status-box">
				  {{item.status_format}}
				  <view class="reason-box" v-if="item.status==-1 && item.reason">
				  	{{item.reason}}
				  </view>
                <!-- <statusBox :text="item.status_format"></statusBox> -->
              </view>
            </view>
            <view class="task-item-mid">
              <view class="task-start-time"> {{ item.create_date }}发布 </view>

              <view
                style="
                  background-color: #787878;
                  height: 10px;
                  width: 1px;
                  margin: 0 10rpx;
                "
              >
              </view>
              <view class="task-end-time">
                {{ item.end_time_format }}结束
              </view>
            </view>
            <view class="task-item-footer">
              <view class="left-box">
                <view class="stock"> 剩{{ item.stock }}单 </view>
                <view class="audit-stock"> 待审核{{item.unFinishNum}} </view>
                <view class="finish-stock"> 已完成{{item.finish}} </view>
              </view>
              <view class="price-box"> {{ item.price }}小豆 </view>
            </view>
          </view>
        </view>
      </view>
    </view>
	
    <u-gap height="40" color=""></u-gap>
    <view class="footer">
      <yj-button
        bg="#FF9640"
        color="white"
        :customStyle="{ width: '60%' }"
        shape="circle"
        text="发布新任务"
        @click="toPages('/pages/task/add_types')"
      ></yj-button>
    </view>
  </view>
</template>

<script>
import { statusBox } from "@/components/status-box.vue";
import { taskerLists } from "@/api/tasker.js";
import { getUser } from "@/api/user.js";
import { emptyPage } from "@/components/emptyPage.vue";
export default {
  components: {
    emptyPage,
    statusBox,
  },
  data() {
    return {
      tabs: [
        {
          status: "all",
          name: "全部",
        },
        {
          status: "0",
          name: "待付款",
        },
        {
          status: "1",
          name: "审核中",
        },
        {
          status: "-1",
          name: "已驳回",
        },
        {
          status: "2",
          name: "进行中",
        },
        {
          status: "3",
          name: "结算中",
        },
        {
          status: "10",
          name: "已暂停",
        },
      ],
      taskLists: [],
      taskListsParams: {
        status: "all",
        page: 1,
      },
      userInfo: {},
      baseList: [
        {
          name: "icon-shuaxin",
          title: "刷新道具",
          url: "/pages/task/RefreshProp/RefreshProp",
        },
        {
          name: "icon-zhiding",
          title: "置顶道具",
          url: "/pages/task/RefreshProp/top",
        },
        {
          name: "icon-jilu",
          title: "刷新/置顶记录",
          url: "/pages/task/log/log",
        },
        {
          name: "icon-shouye",
          title: "邀友赚钱",
		  url:"/pages/users/user_spread_code/index",
        },
      ],
    };
  },
  onShow() {
    this.getTaskerLists();
    this.getUserInfo();
  },
  methods: {
    getUserInfo() {
      getUser().then((res) => {
        this.userInfo = res;
      });
    },
    onGrid: function (index) {
      this.toPages(this.baseList[index].url);
    },
    changeTabs({ status }) {
      this.taskListsParams.status = status;
      this.taskListsParams.page = 1;
      this.getTaskerLists();
    },
    toDetail(task_id) {
      console.log(task_id);
      uni.navigateTo({
        url: "/pages/task/user/detail?task_id=" + task_id,
      });
    },
    toChangePrice(task_id) {
      console.log(task_id);
      uni.navigateTo({
        url: "/pages/task/changePrice?task_id=" + task_id,
      });
    },
    toPages(url) {
      console.log(url);
      uni.navigateTo({
        url: url,
      });
    },
    getTaskerLists() {
      taskerLists(this.taskListsParams).then((res) => {
        console.log(res);
        this.taskLists = res.data;
      });
    },
  },
};
</script>

<style lang="scss">
.user-header {
  background-color: white;
}
.warp .header {
  background-color: white;
}
	.reason-box {
		padding: 5rpx 10rpx;
		background: #F58325;
		color: #fff;
		font-size: 24rpx;
		margin-top: 20rpx;
		border-radius: 8rpx;
	}
.task-info {
	.task-info-left{
		display: flex;
		justify-content: flex-end;
	}
  padding: 20rpx;
  display: flex;
  align-items: center;
  .image {
    border-radius: 50%;
    overflow: hidden;
    height: 50px;
    width: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .mid {
    padding: 20rpx;

    .title {
      color: #333;
      font-size: 30rpx;
      font-weight: bold;
    }
    .desc {
      margin-top: 6rpx;
      color: #787878;
      font-size: 22rpx;
    }
    .mid-info {
      .task-end-time {
        margin-left: 20rpx;
      }
      margin-top: 10rpx;
      display: flex;
      font-size: 24rpx;
      color: #999999;
    }
    .mid-detail {
      display: flex;
      margin-top: 10rpx;
    }
  }
  .left {
    display: flex;
    align-items: center;
    .left-box {
      display: flex;
      flex-direction: column;
      justify-content: space-around;
      align-items: center;
      height: 110rpx;
      .stock {
        color: #787878;
        font-size: 22rpx;
      }
    }
  }
}
.footer {
  position: fixed;
  bottom: 20rpx;
  left: 0;
  display: flex;
  width: 100%;
  justify-content: center;
}
.task-warp {
  // padding: 20rpx 0;
  .task-item {
    background-color: white;
    overflow: hidden;
    border-radius: 20rpx;
    margin-bottom: 20rpx;
    padding: 30rpx;
    .task-item-top {
      .title {
        font-weight: bold;
        font-size: 28rpx;
      }
      .status-box {
        // height: 24px;
        // color: white;
        // font-size: 24rpx;
        // justify-content: center;
        // align-items: center;
        //  display: flex;
        //  flex-basis: 80px;
        //  padding: 10rpx 10rpx;
        //  height: 24px;
        //  background: linear-gradient(250deg, #F9AC52 0%, #F58527 100%);
        //  border-radius: 12px;
      }
      display: flex;
      justify-content: space-between;
    }
    .task-item-mid {
      display: flex;
      font-size: 24rpx;
      color: #787878;
      margin-top: 10rpx;
      align-items: center;
    }
    .task-item-footer {
      display: flex;
      justify-content: space-between;
      color: #787878;
      .left-box {
        display: flex;
        font-size: 24rpx;
        flex-basis: 200px;
        justify-content: space-between;
        margin-top: 20rpx;
      }
    }
  }
}

.warp {
  .header {
    padding-bottom: 40rpx;
    border-radius: 20rpx;
    overflow: hidden;
  }
  .mid {
  }
}
.grid-text {
  color: #f58325;
  padding-top: 10rpx;
  font-size: 26rpx;
}
</style>
