import * as Icons from '@element-plus/icons-vue';
import toLine from "@/utils/lib/toLine";
var icons = [];
for(let i in Icons){
	icons.push(`el-icon-${toLine(i)}`);
}

export default {
	icons: [{
		name: '默认',
		icons: icons
	},
		{
			name: '扩展',
			icons: [
				'sc-icon-vue',
				'sc-icon-code',
				'sc-icon-wechat',
				'sc-icon-bug-fill',
				'sc-icon-bug-line',
				'sc-icon-file-word',
				'sc-icon-file-excel',
				'sc-icon-file-ppt'
			]
		}
	]
}
