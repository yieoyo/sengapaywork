<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Config;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Model\BookedSession;
use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\Archive;
use OpenTok\ArchiveMode;
use OpenTok\ArchiveList;
use OpenTok\Role;
use DB;
/**
 * Language Controller
 *
 * Add your methods in the class below
 */

class CronController extends Controller{

    public function archives(){
		if(Config::get("Opentok.sandbox_mode") == 1){
				$api_key 	= Config::get("Opentok.sandbox_api_key");
				$api_secret = Config::get("Opentok.sandbox_api_secret");
			}else{
				$api_key 	= Config::get("Opentok.live_api_key");
				$api_secret = Config::get("Opentok.live_api_secret");
			}
			
			
			
			
			$completedSessions = DB::table("booked_sessions")->where("is_active",3)->select("video_session","id")->get();
			if(!empty($completedSessions)){
				$opentok	=	new OpenTok($api_key,$api_secret);
				$archiveList = $opentok->listArchives();
				foreach($completedSessions as $session){
					if(!empty($session) && !empty($archiveList)){
						// Get an array of OpenTok\Archive instances
						$archives = $archiveList->getItems();
						// Get the total number of Archives for this API Key
						//$totalCount = $archiveList->totalCount();
						foreach($archives as $archive){
							$archiveData = array();
							if($session->video_session == $archive->sessionId){
								$archiveData['id'] 			= $archive->id;
								$archiveData['status'] 		= $archive->status;
								$archiveData['name'] 		= $archive->name; 
								$archiveData['reason'] 		= $archive->reason;
								$archiveData['sessionId'] 	= $archive->sessionId;
								$archiveData['projectId'] 	= $archive->projectId;
								$archiveData['createdAt'] 	= $archive->createdAt;
								$archiveData['size'] 		= $archive->size;
								$archiveData['duration'] 	= $archive->duration;
								$archiveData['outputMode'] 	= $archive->outputMode;
								$archiveData['hasAudio'] 	= $archive->hasAudio;
								$archiveData['hasVideo'] 	= $archive->hasVideo;
								$archiveData['sha256sum'] 	= $archive->sha256sum;
								$archiveData['password'] 	= $archive->password;
								$archiveData['updatedAt'] 	= $archive->updatedAt;
								$archiveData['url'] 		= $archive->url;
								$archiveData['event'] 		= $archive->event;
								$archiveData['partnerId'] 	= $archive->partnerId;
								DB::table("booked_sessions")->where("id",$session->id)->update(array('archive_data'=>json_encode($archiveData)));
							}
						}
					}
				}
			}
			die;
			
	}

}// end
