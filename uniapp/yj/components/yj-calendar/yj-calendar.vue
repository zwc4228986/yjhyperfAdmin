<template>
	<view>
		<u-calendar
			
		   :maxDate="maxDate"
		   :show="showCalendar" 
		   @confirm="confirm"
		   @close="showCalendar = false">
		</u-calendar>
		<view class="dateFormat"    @click="showCalendar=true">
			{{value}}
		</view>
	</view>
</template>

<script>
	import props from './props.js';
	/**
	 * Alert  警告提示
	 * @description 警告提示，展现需要关注的信息。
	 * @tutorial https://www.uviewui.com/components/alertTips.html
	 * 
	 * @property {String}			title       显示的文字 
	 * @property {String}			type        使用预设的颜色  （默认 'warning' ）
	 * @property {String}			description 辅助性文字，颜色比title浅一点，字号也小一点，可选  
	 * @property {Boolean}			closable    关闭按钮(默认为叉号icon图标)  （默认 false ）
	 * @property {Boolean}			showIcon    是否显示左边的辅助图标   （ 默认 false ）
	 * @property {String}			effect      多图时，图片缩放裁剪的模式  （默认 'light' ）
	 * @property {Boolean}			center		文字是否居中  （默认 false ）
	 * @property {String | Number}	fontSize    字体大小  （默认 14 ）
	 * @property {Object}			customStyle	定义需要用到的外部样式
	 * @event    {Function}        click       点击组件时触发
	 * @example  <u-alert :title="title"  type = "warning" :closable="closable" :description = "description"></u-alert>
	 */
	export default {
		name: 'yj-calendar',
		mixins: [uni.$u.mpMixin, uni.$u.mixin, props],
		data() {
			return {
				showCalendar: false
			}
		},
		computed: {
			iconColor() {
				return this.effect === 'light' ? this.type : '#fff'
			},
			// 不同主题对应不同的图标
			iconName() {
				switch (this.type) {
					case 'success':
						return 'checkmark-circle-fill';
						break;
					case 'error':
						return 'close-circle-fill';
						break;
					case 'warning':
						return 'error-circle-fill';
						break;
					case 'info':
						return 'info-circle-fill';
						break;
					case 'primary':
						return 'more-circle-fill';
						break;
					default: 
						return 'error-circle-fill';
				}
			}
		},
		methods: {
			// 点击内容
			clickHandler() {
				this.$emit('click')
			},
			// 点击关闭按钮
			closeHandler() {
				this.show = false
			},
			confirm(date){
				this.$emit('input', date[0])
				this.showCalendar = false
			}
		}
	}
</script>

<style lang="scss" scoped>
	.dateFormat{
		display: flex;
		justify-content: flex-end;
	}
</style>
