<!-- 心灵保健 -->
<!-- 09-10 此处调整了部分结构 选中的class 为 'is-select' -->
<template>
  <view class="container">
	    <view class="header-line" :style="{ height: sysHeight }"> </view>
    <view class="header">
      <view class="back iconfont icon-fanhui" @click="back"></view>
      <view class="title">在线答题</view>
      <view></view>
    </view>

    <view class="mainBox radius relative">
      <view class="progress-box">
        <view class="progress">
          <view class="current">{{ num + 1 }}</view
          >/{{ DataList.length }}
        </view>
        <!-- 			 <u-line-progress
			   activeColor="#f2f2f2"
			   inactiveColor=""
			   :percentage="progress"
			   :showText="false"
			 ></u-line-progress> -->
      </view>

      <view
		v-if="DataList.length>0"
        class="animation-reverse shadow main-box"
        :class="animation"
        data-class="slide-rights"
      >
        <view class="bg-white header-box">
		  <view class="time-mid-box">
			  <view>
				  
			  </view>
			  <view class="time-mid-right-box">
				  <view style="padding: 0 10rpx;">
					 还剩:
				  </view>
			  	  <u-count-down  ref="countDown" @finish="finish" :time="time" format="ss秒"></u-count-down>		  
			  </view>
			 
          </view>
		  <view class="mentalTitle text-lg text-black text-bold">
            <text>{{ DataList[num].title || "" }}</text>
          </view>
        </view>

        <view class="options-box">
          <view
            class="mentalList is-select"
            v-bind:key="index"
            v-for="(item, index) in DataList[num].question_detail"
            v-bind:class="{ mentalListActive: result[num] == index,rightItem:item.score>0&&showRightItem==true}"
            @tap="Toggle(index)"
          >
            <!-- <u-line direction="col"></u-line> -->
            <view class="indexBox"
              ><text>{{ item.option }}</text></view
            >
            <view class="title" style="z-index: 10">
              {{ item.title || "" }}
            </view>
          </view>
        </view>
		
        <view class="options-bottom">
		
		
          <view class="options-btn"  v-if="showRightItem">
			  <yj-button
			   v-if="progress<100"
			   @click="nextPage()"
			   bg="#F58325" 
			   color="#fff" 
			   size='15'
			   bold
				shape="circle" 
				>
				下一题
			  </yj-button>
			  
			  <yj-button
				v-else
			   @click="back()"
			   bg="#F58325" 
			   color="#fff" 
			   size='15'
			   bold
			  	shape="circle" 
			  	>
			  	返回
			  </yj-button>
          </view>
        </view>
      </view>
    </view>
  </view>
</template>

<script>
// <template>
//   <view class="contaier" :style="{ minHeight: getHeight + 'px' }">
//     <!-- 	<view class="bannerBox">
// 			<image class="ggBox" mode="widthFix" src="http://cdn.zhoukaiwen.com/Banner3.jpg"></image>
// 		</view> -->
//     <!-- 答题主页面 -->
//     <view class="mainBox radius relative">
//       <view class="progress-box">
//         <view class="progress">
//           <view class="current">{{ num + 1 }}</view
//           >/{{ DataList.length }}
//         </view>
//         <u-line-progress
//           activeColor="#f2f2f2"
//           inactiveColor="white"
//           :percentage="progress"
//           :showText="false"
//         ></u-line-progress>
//       </view>
//       <!-- <view class="userHeard cu-avatar lg round" -->
//       <!-- style="background-image:url(http://cdn.zhoukaiwen.com/logo.png);"></view> -->

//       <view
//         class="animation-reverse shadow main-box"
//         :class="animation"
//         data-class="slide-rights"
//       >
//         <view class="bg-white header-box">
//           <view class="mentalTitle text-lg text-black text-bold">
//             <text>{{ DataList[num].title || "" }}</text>
//           </view>
//         </view>
//         <view class="options-box">
//           <view
//             class="mentalList"
//             v-bind:key="index"
//             v-for="(item, index) in DataList[num].question_detail"
//             v-bind:class="{ mentalListActive: result[num] == index }"
//             @tap="Toggle(index)"
//           >
//             <u-line direction="col"></u-line>
//             <view class="indexBox text-shadow">{{ item.option }}</view>
//             <view style="z-index: 10">
//               {{ item.title || "" }}
//             </view>
//           </view>
//         </view>
//       </view>

//       <!-- <u-line color="#dddddd"></u-line> -->

//       <!-- 	<view class="margin-top cu-progress radius striped active">
// 						<view class="bg-blue" :style="[{ width: loading ? progress + '%' : '' }]">{{ progress }}%</view>
// 					</view> -->

//       <!-- <view class="explainMain">本测试仅提供参考，不会作为最终依据</view> -->
//     </view>

//     <!-- 	<view class="explain">
// 			<view class="integral">您当前积分：{{currentPoints}}分</view>
// 			<view @click="goExplain">
// 				<u-icon name="question-circle-fill" size="30"></u-icon>
// 				答题规则说明
// 			</view>
// 		</view> -->

//     <!-- 遮罩层 -->
//     <!-- <u-mask :show="show">
// 			<view class="warp">
// 				<view class="rect" @tap.stop>
// 					<view class="closeBtn">
// 						<u-icon @click="closeMask" name="close-circle-fill" color="#ccc" size="58"></u-icon>
// 					</view>

// 					<view class="closeImg">
// 						<image mode="aspectFit" src="http://cdn.zhoukaiwen.com/answerTrophy.png"></image>
// 					</view>
// 					<view class="text-black text-bold text-center">恭喜您！完成答题！</view>
// 					<view class="text-center margin-tb-lg text-gray">{{showMessage}}</view>

// 					<view style="width: 350rpx; margin: 50rpx auto 0;">
// 						<button v-if="isShare != 1" @click="shareBtn" open-type="share"
// 							class="cu-btn round bg-blue shadow" style="width: 100%;">分享获得10个积分</button>
// 						<button v-if="isShare == 1" open-type="share" class="cu-btn round bg-blue shadow"
// 							style="width: 100%;">分享给好友</button>
// 					</view>
// 				</view>
// 			</view>
// 		</u-mask> -->
//   </view>
// </template>

import { examQuestion,examSubmit } from "../../api/exam.js";
let sysHeight = uni.getSystemInfoSync().statusBarHeight + "px";
export default {
  data() {
    return {
	  sysHeight: sysHeight,
      result: [],
      show: false,
      getHeight: "",
      loading: false,
      animation: "",
      mentalListActive: true,
      noData: false,
      hasData: true,
      // 数据
      num: 0,
	  time:30 * 1000,
      DataList: [],
      setData: {
        // {
        // 	"surveyId": 1,
        // 	"chooses": [{
        // 			"serialNumber": 1,
        // 			"number": 1
        // 		}
        // 	]
        // }
      },
	  showRightItem:false,
      //进度条
      exam_id: 0,
      progress: 0,
      subject: 0,
      currentPoints: 0, //当前积分
      isShare: 3, //是否分享	0否 1是
      showMessage: "", //答题结果
    };
  },
  onShareAppMessage(res) {
    return {
      title: "我已完成答题，快来参与吧",
    };
  },
  onLoad(options) {
    this.exam_id = options.exam_id;
    this.subject = options.subject;
    const that = this;
    uni.getSystemInfo({
      success: function (res) {
        console.log(res);
        that.getHeight = res.windowHeight;
      },
    });
    setTimeout(function () {
      that.loading = true;
    }, 300);
    console.log("getData");
    this.getData();
  },
  watch: {
    progress(val) {
		console.log('val',val)
      if (this.progress == 100) {
        // this.noData = true;
        // this.hasData = false;
        // setTimeout(() => {
        // 	this.show = true;
        // }, 1300);
		this.submit();
      }
    },
  },
  methods: {
	  finish(){
		  this.Toggle(1);
	  },
	  submit(){
		  var result1 = [];
		  
		  this.DataList.map((res, i) => {
		    result1.push(res.question_detail[this.result[i]].id);
		  });
		  
		    examSubmit({
		      result: result1,
		      exam_id: 1,
		    })
		    .then((res) => {
		      uni.showToast({
		        title: "答题完成",
		      });
		  	setTimeout(()=>{
		  		uni.navigateBack()
		  	},2000)
		  	
		    })
		    .catch((res) => {
		      uni.push("/pages/exam/detail?exam_test_id=" + this.exam_id, 2000);
		    });
	  },
	  back(){
		uni.navigateBack({
		
		});  
	  },
    getData() {
      examQuestion({
        exam_id: 1,
        subject: this.subject,
      }).then((res) => {
        console.log(res.question);
        this.DataList = res.question;
      });
      // this.progress = 0;
    },
    turn(num) {
      if (uni.limit()) {
        return false;
      }
      if (this.num + num < 0 || this.num + num > this.DataList.length - 1) {
        return false;
      }
      setTimeout(() => {
        this.animation =
          num > 0 ? "animation-slide-left" : "animation-slide-right";
        setTimeout(() => {
          this.animation = "";
          this.num += num; //翻第二页
        }, 500);
      }, 300);
    },
    Toggle(index) {
      if (uni.limit()) {
        return false;
      }
      // this.result[this.num] = index;
      this.$set(this.result, this.num, index);
      console.log(this.num + 1);
      console.log("length:", this.DataList.length);
      this.progress = ((100 / this.DataList.length) * (this.num + 1)).toFixed(
        2
      ); //进度条
      if (this.progress < 100) {
		  setTimeout(()=>{
			  this.showRightItem = true;
		  },50)
      } else {
		  setTimeout(()=>{
		  			  this.showRightItem = true;
		  },50)
        // console.log("没有下一题了");
        // this.show = true;
      }
    },
	nextPage(){
		
		setTimeout(() => {
			// this.time = 31*1000;
		   this.$refs.countDown.reset();
		  this.showRightItem = false;
		  this.animation = "animation-slide-left";
		  setTimeout(() => {
		    this.mentalListActive = -1;
		    this.animation = "";
		    this.num++; //翻第二页
		  }, 500);
		}, 300);
	},
    // 弹窗消失
    closeMask() {
      this.show = false;
    },
    goExplain() {
      uni.navigateTo({
        url: "./explain",
      });
    },
  },
};
</script>

<style lang="scss" scoped>
.mainBox {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  // padding: 60rpx 40rpx 20rpx 40rpx;
  height: calc(100% - 0px);
}

.main-box {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;
  background: url("#{$app-url}/static/images/exam/index/02.png") no-repeat;
  background-size: 100% 100%;
  .options-bottom {
	  display: flex;
	  justify-content: center;
    // position: absolute;
    // display: inline-block;
    // bottom: 65rpx;
    margin-bottom: 65rpx;
    .options-btn {
      display: flex;
      justify-content: space-around;
      height: 66rpx;
	  width: 216rpx;
    
      .submit-btn {
        width: 494rpx;
      }
    }
  }
}
.progress-box {
  background-color: transparent;
  color: #fff;
  padding: 40rpx 40rpx 0 40rpx;
  .progress {
    color: white;
    .current {
      font-size: 40rpx;
      padding: 0 3rpx;
      font-weight: 500;
    }
    display: flex;
    padding-bottom: 10rpx;
    align-items: flex-end;
    justify-content: center;
  }
  /deep/.u-line-progress__background {
    background-color: transparent;
  }
}

.header-box {
  padding: 10rpx 40rpx;
  display: flex;
  flex-direction: column;
  align-items: center;
  .mentalTitle {
    width: 586rpx;
    height: 69rpx;
    font-size: 30rpx;
    font-family: PingFang SC;
    font-weight: 500;
    color: #333333;
    line-height: 40px;
    margin-top: 100rpx;
  }
}
.warp {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100%;
}

.rect {
  width: 480rpx;
  // height: 520rpx;
  border-radius: 20rpx;
  padding: 25rpx 25rpx 80rpx 25rpx;
  box-sizing: border-box;
  background-color: #fff;
}

.closeImg {
  width: 100%;
  height: 200rpx;
  margin: 10rpx auto 30rpx;

  image {
    height: 200rpx;
  }
}

.cu-bar .cu-avatar:first-child {
  margin-left: -11px;
}

.cu-bar {
  height: 90rpx !important;
}

.explainMain {
  width: 100%;
  text-align: center;
  font-size: 24rpx;
  text-align: center;
  color: #999999;
  margin-top: 30rpx;
}
.time-mid-box{
	width: 100%;
	margin-top: 20px;
	display: flex;
	justify-content: space-between;
	color:#F58325 ;
	padding: 20rpx;
	.time-mid-right-box{
		font-size: 26rpx;
		display: flex;
	}
}
.userHeard {
  position: absolute;
  left: 50%;
  top: -50rpx;
  margin-left: -50rpx;
}

.is-select {
  .indexBox {
	background: #CCCCCC;
    text {
      color: #999999;
    }
  }
  .title {
    color: #999999;
  }
}

.mentalList {
  background-color: white;
  display: flex;
  width: 100%;
  height: 60rpx;
  // line-height: 78rpx;
  align-items: center;
  padding-right: 20rpx;
  // border-radius: 12rpx;
  margin: 30rpx 0;
  overflow: hidden;
  // border: 1px solid #dddddd;

  .indexBox {
	  
    margin-left: 46rpx;
    // z-index: 10;
    // display: flex;
    // width: 70rpx;
    // // height: 78rpx;
    // text-align: center;
    // align-items: center;
    // justify-content: center;
    // // line-height: 78rpx;
    // float: left;
    // // background-color: #dddddd;
    // margin-right: 15rpx;
    width: 24rpx;
    height: 24rpx;
    border-radius: 50%;
    text-align: center;
    line-height: 20rpx;
    text {
      font-size: 20rpx;
      font-family: PingFang SC;
      font-weight: 500;
      color: #999999;
    }
  }

  .title {
    margin-left: 10rpx;
    color: #999;
  }
}
.page-box__grid-item {
  display: flex;
  height: 50rpx;
  align-items: center;
  justify-content: center;
}
.mentalListActive::after {
  // content: "";
  // position: absolute;
  // left: 0;
  // top: 0;
  // width: 100%;
  // height: 100%;
  // background-color: #0081ff;
  // transform-origin: left;
  // animation: LeftToRight 0.5s;
  // animation-fill-mode: forwards;
}
.rightItem{
	background-color: #F58325!important;
	color: #fff!important;
	.title{
		color: #fff!important;
	}
	.indexBox {
		background: white;
	  text {
	    color: #999999;
	  }
	}
}
.mentalListActive {
  position: relative;
  width: 100%;
  color: white;
  .indexBox {
		color: #ffffff;
		background-color: #ffc376;
		text{
			 color: white;
		}
  }
  .title{
	  color: #666666;
  }

}

@keyframes LeftToRight {
  from {
    transform: scaleX(0);
  }
  to {
    transform: scaleY(1);
  }
}

.options-box {
  padding: 50rpx 50rpx;
  // background-color: #f2f2f2;
}
.contaier {
  background-color: #fbf2e5;
  background-image: url("#{$app-url}/static/images/exam/exam_bg.png");
  background-repeat: no-repeat;
  background-size: 100% 500px;
  .bannerBox {
    width: 750rpx;

    image {
      width: 750rpx;
    }
  }

  .explain {
    width: 750rpx;
    // position: absolute;
    bottom: 40rpx;
    font-size: 24rpx;
    margin: 10rpx 0 40rpx 0;
    text-align: center;
    color: #999999;

    .integral {
      font-size: 30rpx;
      margin-bottom: 15rpx;
      color: #333333;
    }
  }
}

.container {
  display: flex;
  flex-direction: column;
  height: 100vh;
  background: url("#{$app-url}/static/images/exam/index/01.png") no-repeat;
  background-size: 100% auto;
  background-color: #fbf2e5;

  .header {
    height: 43px;
    display: flex;
    justify-content: space-between;
	align-items: center;
	
    .back {
      margin-left: 18rpx;
      height: 38rpx;
      width: 20rpx;
      color: #fff;
    }

    .title {
      font-size: 34rpx;
      font-family: PingFang SC;
      font-weight: bold;
      color: #ffffff;
    }
  }

  .mainBox {
    // background: url('/static/images/exam/index/02.png') no-repeat;
    // background-size: 100% 100%;
  }
}
</style>
