<template>
  <view class="main">
    <view class="header-line" :style="{ height: sysHeight }"> </view>
    <view class="header-line" style="height: 43px">	
		<uni-icons size="25" color="#fff" type="left" @click="back"></uni-icons> 
	</view>
    <view class="title"> 答题赢小豆 </view>
    <view class="mid-box">
      <view class="header-mid-box">
        <image src="/static/images/exam/01.png" />
      </view>
      <view class="content-box">
        <view class="content-box-title">有奖答题</view>
        <view class="content-box-desc">
          <view class="introduction">
            <view class="icon iconfont icon-jinbi_o"></view>
            <text>每日答题赢好礼，小豆每天赢不停！</text>
          </view>
          <view class="reward">
            <view>
              <view class="reward-box">
                <text class="top-text">{{exam_beans}}小豆</text>
                <text class="second-text">今天</text>
              </view>
              <view class="bottom-text">· 今日奖励 ·</view>
            </view>
            <view>
              <view class="reward-box">
                <text class="top-text">{{exam_beans}}小豆</text>
                <text class="second-text">明天</text>
              </view>
              <view class="bottom-text" style="color: #f8a950">明天</view>
            </view>
          </view>
        </view>
        <view class="content-box-btn">
			<!-- <yj-button
			@click="openLink(item.value)"
			:customStyle="{width:'150rpx',height:'50rpx'}"
			fontSize='12'
			shape="circle" 
			bg="#FCC704" 
			color="#000" 
			text="开始答题"
			>
			</yj-button> -->
			<u-button v-if="todayIsExam"  color="#F58325"  :plain="true"   shape="circle"  text="  明日再来">
			</u-button>
			<yj-button
				v-else
				@click="startExam()"
			  bg="#F58325" 
			 color="#fff" 
			 size='15'
			 bold
			  shape="circle" 
			  >
			   开始答题
			</yj-button>
			
        </view>
      </view>
    </view>
    <view> </view>
  </view>
</template>
<script>
	import {examToday } from "../../api/exam.js";
let sysHeight = uni.getSystemInfoSync().statusBarHeight + "px";
console.log(sysHeight);
export default {
  data() {
    return {
	  todayIsExam:false,
	  exam_beans:0,
	  
      sysHeight: sysHeight,
    };
  },
  onLoad(option) {
    let that = this
  },
  onShow(){
	this.getToday();  
  },
  methods: {
	getToday(){
		examToday().then(res=>{
			this.todayIsExam = res.todayIsExam;
			this.exam_beans = res.exam_beans+'~'+res.exam_beans_max;
		});
	},
    startExam() {
      uni.navigateTo({
        url: "/pages/exam/index",
      });
    },
	back(){
		uni.navigateBack({})
	}
  },
};
</script>
<style lang="scss">
.main {
  height: 100vh;
  background: url("#{$app-url}/static/images/exam/bg.png") no-repeat;
  background-size: 100% 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  .header-line {
    width: 100%;
  }
}
.title {
  // font-size: 80rpx;
  // font-weight: normal;
  // color: #FFFFFF;

  // line-height: 75px;
  // text-shadow: 0px 0px 3px #EDAD54;

  width: 478rpx;
  height: 87rpx;
  font-size: 80rpx;
  font-weight: normal;
  text-align: center;
  color: #ffffff;
  // line-height: 149rpx;
  text-shadow: 0px 0px 20rpx #edad54;
}
.mid-box {
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;
  margin-top: 230rpx;
  .header-mid-box {
    position: absolute;
    top: -146rpx;
    z-index: 2;
    height: 177rpx;
    width: 383rpx;
    image {
      width: inherit;
      height: inherit;
    }
  }
  .content-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: absolute;
    width: 680rpx;
    height: 687rpx;
    background: url("#{$app-url}/static/images/exam/02.png") no-repeat;
    background-size: 100% 100%;

    &-title {
      width: 338rpx;
      height: 38rpx;
      margin-top: 86rpx;
      font-size: 38rpx;
      font-weight: bold;
      text-align: center;
      color: #586ac6;
      line-height: 46rpx;
      background: url("#{$app-url}/static/images/exam/03.png") no-repeat;
      background-size: 100% 100%;
    }

    &-desc {
      margin-top: 54rpx;
      display: flex;
      flex-direction: column;
      align-items: center;

      .introduction {
        width: 540rpx;
        height: 58rpx;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #fff3dd;
        border-radius: 30px;
        text {
          font-size: 24rpx;
          font-family: PingFang SC;
          font-weight: 500;
          color: #666666;
        }
        .icon {
          color: #fccb5e;
          margin-right: 20rpx;
        }
      }

      .reward {
        margin-top: 45rpx;
        width: 100%;
        display: flex;
        justify-content: space-around;

        &-box {
          display: flex;
          flex-direction: column;
          align-items: center;
          height: 162rpx;
          width: 160rpx;
          background: url("#{$app-url}/static/images/exam/05.png") no-repeat;
          background-size: 100% 100%;

          .top-text {
            font-size: 22rpx;
            font-family: DIN;
            font-weight: 400;
            color: #ff2e44;
            line-height: 60rpx;
          }
          .second-text {
            font-size: 20rpx;
            // line-height: 22rpx;
            color: #fff;
            font-family: Adobe Heiti Std;
            font-weight: normal;
          }
        }

        .bottom-text {
          text-align: center;
          font-size: 20rpx;
          font-family: PingFang SC;
          font-weight: 800;
          color: #fd443f;
          line-height: 40rpx;
        }
      }
    }

    &-btn {
      width: 513rpx;
      height: 85rpx;
      margin-top: 86rpx;

      image {
        width: inherit;
        height: inherit;
      }
    }
  }
}
</style>