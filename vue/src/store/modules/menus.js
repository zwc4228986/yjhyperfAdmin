import config from "@/config";
import http from "@/utils/request";
import tool from "@/utils/tool";
const collect = require('collect.js');
export default {
	state: {
		list: null,
	},
	mutations: {
		SET_MENU_LIST(state, value) {
			state.list = value;
		},
	},
	actions: {
		async getMenus({ commit, state }) {
			if(state.list == null){
				await http().post("/admin/menu/auth").then((data) => {
					commit("SET_MENU_LIST", data);
				});
			}

			return state.list;
		},
		async resetMenus({ commit, state }) {
			await http().post("/admin/menu/auth").then((data) => {
					commit("SET_MENU_LIST", data);
			});
			return state.list;
		}
	},
};
