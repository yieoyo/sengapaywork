<?php 
namespace App\Model; 
use Eloquent;
/**
 * HowItWork Model
 */
 
class HowItWork extends Eloquent  {

	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
 
	protected $table = 'how_it_works';
	
	/**
	 * Function for  bind AdminHowItWorkDescription model   
	 *
	 * @param null 
	 *
	 * return query
	 */	
 
	 public function description(){
		 return $this->hasMany('App\Model\HowItWorkDescription','parent_id');
	 }//end description()
 
	 /**
	* hasMany  function for bind HowItWorkDescription model 
	*
	* @param null
	* 
	* @return query
	*/
	
	public function accordingLanguage()
    {
		$currentLanguageId	=	Session::get('currentLanguageId');
        return $this->hasMany('HowItWorkDescription','parent_id')->select('name','parent_id')->where('language_id' , $currentLanguageId);
		
    } //end accordingLanguage()
	
	/**
	 * function for find result form database function
	 *
	 * @param $limit 	
	 * @param $fields 	as fields which need to select
	 * 
	 * @return array
	 */	
	public static function getResult($fields = array(),$limit = 2){
	
		$currentLanguageId	=	Session::get('currentLanguageId');
		
		$HowItWorkResult		=	 HowItWork::with('accordingLanguage')->select($fields)->where('is_active',1)->take($limit)->orderBy('updated_at','DESC')->get()->toArray();
	
		$response	=	array();
		foreach($HowItWorkResult as $key => $result){
			if (isset($result['according_language']) && (is_array($result))) {
				if(isset($result['according_language'][0]) && !empty($result['according_language'][0])){ 
					$currentLanguageData	=	$result['according_language'][0];
					$response[$key]			=	$currentLanguageData;
					unset($result['according_language']);
				}
			}
		}
		return $response;
		
	} //end getResult()
	
	/**
	 * get_how_it_detail
	 *
	 * @var string
	 */
	public function get_how_it_detail() {
        $result = HowItWork::where('is_active',IS_ACTIVE)->orderBy('id','ASC')->get()->toArray();
		return $result;
    }// end get_how_it_detail()
		
}// end HowItWork class
