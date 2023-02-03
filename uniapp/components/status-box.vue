<template>
	<view class="box-text" :style="{color:color,background:bg}">
		{{text}}
	</view>
</template>

<script>
	var data  = {
		"审核中":{
			'color':'#FFF',
			'bg':'linear-gradient(250deg, #A9E344 0%, #1E8C08 100%)',
		},
		"进行中":{
			'color':'#FFF',
			'bg':'linear-gradient(250deg, #4692E3 0%, #0079F6 100%)',
		},
		"已完成":{
			'color':'#FFF',
			'bg':'linear-gradient(250deg, #B199FF 0%, #722AD3 100%)',
		},
		"已驳回":{
			'color':'#FFF',
			'bg':'linear-gradient(250deg, #B199FF 0%, #722AD3 100%)',
		},
		"待补缴":{
			'color':'#000',
			'bg':'linear-gradient(250deg, #EBE13B 0%, #FFC809 100%)',
		},
	}
	export default {
		name:"status-box",
		props:{
			text: {
				type: String,
				default: '',
			},
		},
		computed: {
		    color(){
		        return data[this.text].color;
			},
			bg(){
		        return data[this.text].bg;
			}
		},
		data() {
			return {
				
			};
		}
	}
</script>

<style>
.box-text{
	padding: 10rpx 20rpx;
	border-radius: 24rpx;
}
</style>