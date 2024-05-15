<?php
class CustomHelper {
	/* Function for get active language */
	public static function get_active_languages(){ 
		$response			=	DB::select("CALL GetAcitveLanguages(1)");
		return $response;
	}//end get_active_languages()
	
	public static function get_footer_text(){
		$slug	=	"naos-art";
		$lang			=	App::getLocale();
		$cmsPagesDetail	=	DB::select(DB::raw("SELECT * FROM cms_page_descriptions WHERE foreign_key = (select id from cms_pages WHERE cms_pages.slug = '$slug') AND language_id = (select id from languages WHERE languages.lang_code = '$lang')"));
		$result	=	array();
		if(!empty($cmsPagesDetail)){
			foreach($cmsPagesDetail as $cms){
				$key	=	$cms->source_col_name;
				$value	=	$cms->source_col_description;
				$result[$cms->source_col_name]	=		$cms->source_col_description;
			}
		}
		return $result;
	}
	
	public static function getBlock($slug=null){
		$lang			=	App::getLocale();
		$allBlocks = DB::select( DB::raw("SELECT description,(SELECT block FROM blocks WHERE id = block_descriptions.parent_id) as slug,(SELECT image FROM blocks WHERE id = block_descriptions.parent_id) as image FROM block_descriptions WHERE parent_id IN(SELECT id FROM blocks where page = '$slug') AND language_id = (select id from languages WHERE languages.lang_code = '$lang')"));
		
	
		$blocks = array();
		if(!empty($allBlocks)){
			foreach($allBlocks as $block){
				$blocks[$block->slug]['description'] = $block->description;
				$blocks[$block->slug]['image'] 		 = $block->image;
			}
		}
		return $blocks;
	}//end getBlock()
	
	public static function getSideMenuDetails(){
		$userId				=	Auth::user()->id;
		
		$userDetails = DB::table("users")->select('users.*')->where('id',$userId)->where('is_deleted',0)->where('is_active',1)->first();
		
		return $userDetails;
	}//end getBlock()
	
	public static function getHeaderMenus(){
		$userId				=	!empty(Auth::user()) ? Auth::user()->id:'';
		
		$HeaderMenuArray = array();
		if(!empty(Auth::user()) && (Auth::user()->user_role_id == 1)){
			$projectModules = DB::table('project_modules')->where('is_deleted',0)->where('is_active',1)->orderBy('created_at','ASC')->get();
			if(!empty($projectModules)){
				foreach($projectModules as $projectModule){
					$activeMainAction = 0;
					$projects = DB::table('projects')->where('project_module',$projectModule->id)->where('is_deleted',0)->orderBy('created_at','ASC')->get();
					$active_sub_action = 0;
					if(!empty($projects)){
						foreach($projects as &$project){
							$activeAction = 0;
							$subProjects = DB::table('sub_projects')->where('project_id',$project->id)->where('project_module',$projectModule->id)->where('is_deleted',0)->orderBy('created_at','ASC')->get();
							if(!empty($subProjects)){
								foreach($subProjects as &$subProject){
									$openUrl = Request::segment(2); 
									if($openUrl == $subProject->slug){
										$activeAction = 1;
										$active_sub_action = 1;
									}
								}
							}
							$project->activeAction = $activeAction;
							$project->SubProjects = $subProjects;
						}
						
					}
					if($active_sub_action == 1){
						$activeMainAction = 1;
					}
					
					$projectModule->activeMainAction	=	$activeMainAction;
					$projectModule->Projects			=	$projects;
					
					$HeaderMenuArray[]	=	$projectModule;
				}
				
			}
		}else{
			$cmsPages = DB::table('cms_pages')->where('is_deleted',0)->where('is_active',1)->select('id','page_name','slug')->orderBy('created_at','ASC')->get();
			
			$HeaderMenuArray	=	$cmsPages;
			
		}
		//pr($HeaderMenuArray); die;
		
		return $HeaderMenuArray;
	}//end getBlock()
	
	public static function getHeaderHomeMenus(){
		$userId				=	!empty(Auth::user()) ? Auth::user()->id:'';
		
		$homePageButton	=	DB::table('cms_pages')->where('is_deleted',0)->where('is_active',1)->select('id','page_name','slug')->where('project',1)->first();
		
		return $homePageButton;
	}//end getBlock()
	
	public static function getCurrentTimestamp(){
		$currentTime =  time() + (TIME_DIFFERENCE * 60);
		return $currentTime;
	}
	
	public static function getRelativeTime($time, $short = false){
		$SECOND = 1;
		$MINUTE = 60 * $SECOND;
		$HOUR = 60 * $MINUTE;
		$DAY = 24 * $HOUR;
		$MONTH = 30 * $DAY;
		$before = time() - $time;

		if ($before < 0)
		{
			return "not yet";
		}

		if ($short){
			if ($before < 1 * $MINUTE)
			{
				return ($before <5) ? "just now" : $before . " ago";
			}

			if ($before < 2 * $MINUTE)
			{
				return "1m ago";
			}

			if ($before < 45 * $MINUTE)
			{
				return floor($before / 60) . "m ago";
			}

			if ($before < 90 * $MINUTE)
			{
				return "1h ago";
			}

			if ($before < 24 * $HOUR)
			{

				return floor($before / 60 / 60). "h ago";
			}

			if ($before < 48 * $HOUR)
			{
				return "1d ago";
			}

			if ($before < 30 * $DAY)
			{
				return floor($before / 60 / 60 / 24) . "d ago";
			}


			if ($before < 12 * $MONTH)
			{
				$months = floor($before / 60 / 60 / 24 / 30);
				return $months <= 1 ? "1mo ago" : $months . "mo ago";
			}
			else
			{
				$years = floor  ($before / 60 / 60 / 24 / 30 / 12);
				return $years <= 1 ? "1y ago" : $years."y ago";
			}
		}

		if ($before < 1 * $MINUTE)
		{
			return ($before <= 1) ? "just now" : $before . " seconds ago";
		}

		if ($before < 2 * $MINUTE)
		{
			return "a minute ago";
		}

		if ($before < 45 * $MINUTE)
		{
			return floor($before / 60) . " minutes ago";
		}

		if ($before < 90 * $MINUTE)
		{
			return "an hour ago";
		}

		if ($before < 24 * $HOUR)
		{

			return (floor($before / 60 / 60) == 1 ? 'about an hour' : floor($before / 60 / 60).' hours'). " ago";
		}

		if ($before < 48 * $HOUR)
		{
			return "yesterday";
		}

		if ($before < 30 * $DAY)
		{
			return floor($before / 60 / 60 / 24) . " days ago";
		}

		if ($before < 12 * $MONTH)
		{

			$months = floor($before / 60 / 60 / 24 / 30);
			return $months <= 1 ? "one month ago" : $months . " months ago";
		}
		else
		{
			$years = floor  ($before / 60 / 60 / 24 / 30 / 12);
			return $years <= 1 ? "one year ago" : $years." years ago";
		}

		return $time;
	}

	
}