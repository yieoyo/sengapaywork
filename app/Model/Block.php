<?php 
namespace App\Model; 
use Eloquent,App,DB;

/**
 * AdminBlock Model
 */
 
class Block extends Eloquent  {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
 
	protected $table = 'blocks';
	
	/**
	 * hasMany bind function for  AdminBlockDescription model 
	 *
	 * @param null
	 * 
	 * @return query
	 */	
	public function description() {
        return $this->hasMany('App\Model\BlockDescription','parent_id');
    }// end description()
	
	public function getBlock($slug){
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
	
}// end AdminBlock class
