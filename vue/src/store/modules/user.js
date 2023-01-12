import config from "@/config";
import http from "@/utils/request";
import tool from "@/utils/tool";
const collect = require('collect.js');
export default {
	state: {
		detail: null,
	},
	mutations: {
		SET_DETAIL(state, value) {
			state.detail = value;
		},
	},
	actions: {
		async updateUserDetail({ commit, state }) {
			await http().post("/admin/system/admin/detail").then((data) => {
					commit("SET_DETAIL", data);
			});
			return state.list;
		}
	},
};
