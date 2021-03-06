<?php
class __BLOGROCK{
	static public $project;
	static public $layout;

	static function init(){
	  if(self::$project===null){
			self::$project = new blogrock_Init();
		}
		if(self::$layout===null){
			self::$layout = new blogrock_Layout_Helpers(self::$project->get_default_config());
		}
	}



	static function project(){
		if(self::$project===null){
			self::$project = new blogrock_Init();
			return self::$project;
		}else{
			return self::$project;
		}
  }
	static function layout(){
		return self::$project->obj_layout;
	}

	static function option($key_option){
		return self::$project->get_project_option($key_option);
	}

	/*
	 * Get Default Config Object
	 */
	static function config(){
		return self::$project->get_default_config();
	}




}
