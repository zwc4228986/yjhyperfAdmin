
const state = {
	unReadNum:1,
	people:[],
}
const mutations = {
	unReadNum(state,val){
		state.unReadNum = val;
	},
	people(state,val){
		
		state.people = val;
		
	},
	sendPeople(state,val){
		console.log(state.people,val);
		var unReadNum = 0;
		state.people.every((e,key)=>{
			if(e.receiver_id == val.sender_id){
				state.people[key].unReadNum += 1;
				state.people[key].message_types = val.types;
				state.people[key].content = val.content;
				state.people[key].update_time = val.update_time;
				state.people[key].update_time_format = val.update_time_format;
				console.log(key);
			}
			unReadNum += e.unReadNum;
			return true;
		})
		state.unReadNum =unReadNum;
	},
	clearPeopleUnReadNum(state,val){
		var unReadNum = 0;
		state.people.every((e,key)=>{
			if(val == e.receiver_id){
				state.people[key].unReadNum = 0;
			}else{
				unReadNum += e.unReadNum;
			}
			return true;
		});
		state.unReadNum =unReadNum;
	}
}
		
export default {
	namespaced: true,
	state,
	mutations
};