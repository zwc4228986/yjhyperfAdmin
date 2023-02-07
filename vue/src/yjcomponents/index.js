import yjImage from "./yjImage";
import YjTable2 from "./yjTable";
import YjTable3 from "./yjTable3";
import YjTableTree from "./yjTableTree";
import YjStatistic from "./yjStatistic";
import yjUploadMultiple from "./yjUploadMultiple";
import yjFormCreate from "./yjFormCreate";
import yjSearch from "./yjSearch";


const components = [
	yjImage,
	YjTable2,
	YjTable3,
	YjStatistic,
	yjUploadMultiple,
	YjTableTree,
	yjSearch,
	yjFormCreate
];

export default {
	install(app){
		components.map(item=>{
			app.use(item);
		});
	}
}
