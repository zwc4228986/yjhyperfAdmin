import formCreate from "./src/core/index";
export default {
	install(app){
		app.component("formCreate", formCreate({}).$form(app));
	}
}


