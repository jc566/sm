<?php
/***
 * class objsolarModel 
 * author Arslan khan
 * created 02-10-2017
 * web address http://www.solar.co.uk
***/

// model class
class solarModel
 {
	
	
	/*-----------------------------------------------*/
	
	
	private $bottom_text = 0;
	private $top_text = 1;
	private $homeslider ='hil_homeslider'; 
	private $order_by_id_asc = 'ORDER BY id ASC';
	private $order_by_id_desc = 'ORDER BY id DESC';
	
	// public  
	public $user = 'tbl_user';
	public $booking = 'tbl_booking';
	public $driver = 'tbl_driver';
	  
 /*-----------------------------------------------*/
 	public $objClickModel; 
 	public $config;
 
    // Constructor
	 function  __construct(){
	 	//echo "here====";
	 	//session_start();
	 	//echo "user_idisss".$_SESSION['user']['user_id'];
	 	//echo "</br>";
	 	//$this->pre($_SESSION['user']);
	 	// do anything	
	 }
	 
   /*----------------------This block should not remove-----------------------------*/
   /*  function fetchDbConfig($confName) {
		$strQuery = "SELECT array FROM ".$this->setting." WHERE name = '".$confName."'";
		$strQueryExi = mysql_query($strQuery);
		if(mysql_num_rows($strQueryExi)){
			$row = mysql_fetch_assoc($strQueryExi);
				$arrayOut = unserialize($row['array']);
				foreach ($arrayOut as $key => $value) {
					if (is_array($value)) {
						foreach ($value as $skey => $sval) {
							$arrayOut[$key][$skey] = stripslashes($sval);
						}
					} else {
						$arrayOut[$key] = stripslashes($value);
					} 
				}
				return (is_array($arrayOut)) ? $arrayOut : false;
		}
		return false;
	}*/
	
	/***General Setting***/
	function getSetting(){
		//return $this->fetchDbConfig('config');
	}
   /*----------------------This block should not remove-----------------------------*/
   
   
   
   
  /*--------------------------------------------------------------------------------------------------------------------------------------------------------*/
  
	  /***Get Header Feature ***/
		public function getHeaderFeature(){
			$strQuery = "SELECT title,short_detail,image_name  FROM ".$this->header_feature."  WHERE status= '".ACTIVE."' ".$this->order_by_id_desc."";
			$strQueryExi = mysql_query($strQuery);
			$data = false;
			if(mysql_num_rows($strQueryExi) > 0 ){
				
				$data .= '<section class="three-columns">';
				$data .= '<div class="container">';
					while($row = mysql_fetch_assoc($strQueryExi)){
						$data .= '<div class="col-sm-4 col-xs-12 column">';
							$data .= '<img src="'.IMAGES.'/header_feature/'.$row['image_name'].'" width="74" height="84" alt="">';
							$data .= '<span class="title">'.$row['title'].'</span>';
							$data .= '<p>'.$row['short_detail'].'</p>';
						$data .= '</div>';
					}		
				$data .= '</div>';
				$data .= '</section>';
			}
			return $data;
		 }
  
	   /***Get Header Feature ***/
		  
	/***get CMS data***/
		public function getCms($id){
			$strQuery = "SELECT * FROM ".$this->cms."  WHERE id= '".$id."' AND status= '".ACTIVE."'";
			$strQueryExi = mysql_query($strQuery);
			$data = false;
			if(mysql_num_rows($strQueryExi) > 0){
				$row = mysql_fetch_assoc($strQueryExi);
				$data =  $row;
			}
			return $data;
		} 
		/***Get Header Feature ***/
		// aData array is optional
		// if no need than make it empty.
		 public function getPageBanner($type='',$aData=''){
			
		   		$data = false;
				// need and array 
				if(is_array($aData)){
					$row['title'] = $aData['title'];	
					$row['sub_title'] = $aData['sub_title'];
					$image = DOMAIN.'/images/img12.jpg';
				}else{
					
					$strQuery = "SELECT title,sub_title ,image_name  FROM ".$this->banner."  WHERE type ='".$type."'"; 
					$strQueryExi = mysql_query($strQuery);
					if(mysql_num_rows($strQueryExi) > 0 ){
							$row = mysql_fetch_assoc($strQueryExi);
							$image = IMAGES.'/banner/'.$row['image_name'];
					}	
				}
				$data .= '<div class="banner">';
					$data .= '<img src="'.$image.'" width="1500" height="176" alt="'.$row['title'].'">';
					$data .= '<div class="banner-caption">';
						$data .= '<div class="container">';
							$data .= '<h1>'.$row['title'].'</h1>';
							$data .= '<span class="sub-heading">'.$row['sub_title'].'</span>';
						$data .= '</div>';
					$data .= '</div>';
					$data .= '<a class="tell mobile" href="#">020 3642 1333</a>';
				$data .= '</div>';
				
			  return $data;
	   }
      
	  
		
	/**|||||||||||||||||||||||||||||||HomeiLearn||||||||||||||||||||||||||||||||||**/  
	  // home slider
	  public function getHomeSlider(){ 
			
	 		$strQuery = "SELECT title,title2,title_color AS color1,title2_color AS color2,sub_title,image_name   FROM ".$this->homeslider."  
			WHERE status= '".ACTIVE."' ".$this->order_by_id_desc." LIMIT 0,3";
			
			$strQueryExi = mysql_query($strQuery);
			$data = false;
			if(mysql_num_rows($strQueryExi) > 0 ){
				$data .= '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">';
					$data .= '<div class="carousel-inner" role="listbox">';
						$counter = 1;
						$list = array();
						while($row = mysql_fetch_assoc($strQueryExi)){
							$active = '';
							if($counter==1){
								$active = 'active';
							}
							$data .= '<div class="item '.$active.'">';
								$data .= '<img src="'.IMAGES.'/slider/'.$row['image_name'].'" width="1500" height="761" alt="image description" class="image-1">';
								$data .= '<img src="'.DOMAIN.'/images/'.$counter.'.png" alt="image description" class="image-2">';
								$data .= '<div class="carousel-caption">';
									$data .= '<div class="container">';
									$data .= '<h1 style="color:#'.$row['color1'].';">'.$row['title'].'</h1>';
									$data .= '<h2 style="color:#'.$row['color2'].';">'.$row['title2'].'</h2>';
										$data .= '<span class="sub-heading">'.$row['sub_title'].'</span>';
									$data .= '</div>';
								$data .= '</div>';
							$data .= '</div>';
							$list[]  =    $counter;
					   $counter++;
					 }		
			$data .= '</div>';
			$data .= '<ol class="carousel-indicators">';
				for($k=0;$k<sizeof($list);$k++){
					$active = '';
					if($k==0)  $active = 'active';
					$data .= '<li data-target="#carousel-example-generic" data-slide-to="'.($list[$k]-1).'" class="'.$active.'">'.$list[$k].'</li>';
				}
			$data .= '</ol>';
			$data .= '</div>';	
		 }
		   return $data;
	   }
	   
	   
	   // header text
	  public function getHeaderText(){
		   
	 	 	 $strQuery = "SELECT HT.sbs_title as title,HT.url,HT.sbs_color as color,HT.sbs_tcolor as tcolor,HT.sbs_type AS type 
			 FROM ".$this->header_text." AS HT 
			 WHERE sbs_status= '".ACTIVE."' ".$this->orderBy("HT.order_by",'ASC')."";  		
			 $strQueryExi = mysql_query($strQuery);
			$data = false;
			if(mysql_num_rows($strQueryExi) > 0 ){
				
				$counter = 1;
				$aHorizentole  = array();
				$aTop  = array();
				$aUrl = array();
				$aColor = array();
				$aTColor = array();
			
			  while($row = mysql_fetch_assoc($strQueryExi)){
					if($row['type']== $this->bottom_text){
						$aHorizentole[] = $row['title'];
					}else
					if($row['type']== $this->top_text){
						$aTop[] =  $row['title'];
						$aUrl[] =  $row['url'];
						$aColor[] =  $row['color'];
						$aTColor[] =  $row['tcolor'];
					}
				  $counter++;
			   } 		
			 }   
				//$guid = DOMAIN.'/?action=courses&amp;cat-id=';
				$data .='<div class="box-frame">';
				$data .='<div class="box-holder">';
								$data .='<div class="holder">';
								if($aTop[0] <> ""){
									
									$data .='<a class="traning"  href="'.$aUrl[0].'" style="background:#'.$aColor[0].';color:#'.$aTColor[0].';">
										<span>'.str_replace(" ","</br>",$aTop[0]).'</span>
									</a>';
								}
								$data .='</div>';
								$data .='<div class="holder">';
									if($aTop[1] <> ""){
										$data .='<a class="bussines" href="'.$aUrl[1].'" style="background:#'.$aColor[1].';color:#'.$aTColor[1].';">
											<span>'.str_replace(" ","</br>",$aTop[1]).'</span>
										</a>';
									}
									if($aTop[2] <> ""){
										$data .='<a class="accounting" href="'.$aUrl[2].'" style="background:#'.$aColor[2].'; color:#'.$aTColor[2].';">
											<span>'.str_replace(" ","</br>",$aTop[2]).'</span>
										</a>';
									}
									$data .='</div>';
									$data .='<div class="holder">';
									
									if($aTop[3] <> ""){
										$data .='<a class="view-more" href="'.$aUrl[3].'" style="background:#'.$aColor[3].';color:#'.$aTColor[3].';">
											<span> '.str_replace(" ","</br>",$aTop[3]).'</span>
										</a>';
									}
									if($aTop[4] <> ""){
										$data .='<a class="exam" href="'.$aUrl[4].'" style="background:#'.$aColor[4].';color:#'.$aTColor[4].';">
											<span>'.str_replace(" ","</br>",$aTop[4]).'</span>
										</a>';
									}
									
									if($aTop[5] <> ""){	
										$data .='<a class="computing" href="'.$aUrl[5].'" style="background:#'.$aColor[5].';color:#'.$aTColor[5].';">
											<span> '.str_replace(" ","</br>",$aTop[5]).'</span>
										</a>';
									}
									$data .='</div>';
								$data .='</div>';
							
							$data .='<ul class="skill-list">';
									if($aHorizentole[0] <> ""){	
										$data .='<li>';
											$data .='<img src="'.DOMAIN.'/images/icon-people.png" width="45" height="44">';
											$data .='<span>'.$aHorizentole[0].'</span>';
										$data .='</li>';
									}
									if($aHorizentole[1] <> ""){	
										$data .='<li>';
											$data .='<img src="'.DOMAIN.'/images/icon-pc.png" width="43" height="35">';
											$data .='<span>'.$aHorizentole[1].'</span>';
										$data .='</li>';
									}
									if($aHorizentole[2] <> ""){	
										$data .='<li>';
											$data .='<img src="'.DOMAIN.'/images/icon-responsive.png" width="49" height="37">';
											$data .='<span>'.$aHorizentole[2].'</span>';
										$data .='</li>';
									}
								$data .='</ul>';
								
				 $data .='</div>';
			   return $data;
	    }
		
		
		// popular courses
		public function getPopularCourses($pageType=''){
			
			$limit  = 3;
			if($pageType  == $this->course_detail){
				$limit  = 4;	
			}
			
		    $strQuery = "SELECT HC.id,HC.title AS title,HC.sub_title AS sub_title,HC.course_code,HC.rating,HC.basic_price AS price,HC.min_price,HC.max_price,
			HC.is_price_display AS is_display,HC.image_name1 as image_name,HC.image_name5 AS ac_logo,HCS.sbs_title AS sub_category
			FROM `".$this->course."` AS HC 
			INNER JOIN `".$this->course_subcategory."` AS HCS
			ON HC.sub_cat_id = HCS.Id WHERE HC.status = '".ACTIVE."' AND HC.featured='".FEATURED."' ORDER BY HC.Id DESC LIMIT 0,".$limit." ";
			
			$strQueryExi = mysql_query($strQuery);
			$data = false;
			
			if(mysql_num_rows($strQueryExi) > 0 ){
				
			
			 if($pageType  == $this->course_detail){  
				  $counter = 0;
				$data .= '<div class="popular-courses inner">';
				$data .= '<span class="title">Popular Course</span>';
				  
				  while($row = mysql_fetch_assoc($strQueryExi)){
					
					$id  = $row['id'];
					$price  = $row['price'];
					$min_price  = $row['min_price'];
					$max_price  = $row['max_price'];
					$is_display  = $row['is_display'];
					
					$priceStr = '';
					if($min_price <> 0 && $max_price <> 0){
						$priceStr = '<em>£'.$min_price.' &ndash; £'.$max_price.'</em>';
					}else
					if($min_price <> ""){
						//$priceStr = '£'.$price.' <em> / '.BASIC.'</em>'; 
						$priceStr = '£'.$price.'';   
					}
					
					$data .= '<div class="courses-detail">';
						$data .= '<img width="100" height="60" alt="" src="'.IMAGES.'/course/ '.$row['image_name'].'">';
						$data .= '<div class="course-text">';
						$data .= '<span>'.substr($row['title'],0,40).'</span>';
						if($is_display == true){
							$data .= $priceStr;
						}
						$data .= '<a href="'.DOMAIN.'/?action=course-detail&amp;id='.$id.'">read more</a>';
						$data .= '</div>';
					$data .= '</div>';
				  $counter ++;
				}
				$data .= '</div>';
				}else{ 
				 $counter = 0;
			     while($row = mysql_fetch_assoc($strQueryExi)){
					 
					$id  = $row['id'];
					$price  = $row['price'];
					$min_price  = $row['min_price'];
					$max_price  = $row['max_price'];
					$is_display  = $row['is_display'];
					
					$priceStr = '';
					if($min_price <> 0 && $max_price <> 0){
						$priceStr = '£'.$min_price.'~£'.$max_price.''; 
					}else
					if($min_price <> 0){
						//$priceStr = '£'.$price.' <em> / '.BASIC.'</em>';
						 $priceStr = '£'.$price.'';
					}
					 
					 // rating 
					$star_img = '';
					$rating  = $row['rating'];
					if($rating==1000){
						$rating = 10;
						$star_img = 'star-1';
					}else
					if($rating==2000){
						$star_img = 'star-2';
						$rating = 20;
					}else
					if($rating==3000){
						$star_img = 'star-3';
						$rating = 30;
					}else
					if($rating==4000){
						$star_img = 'star-4';
						$rating = 40;
					}else
					if($rating==5000){
						$star_img = 'star-5';
						$rating = 50;
					}
					$color='';
					if($counter == 2){
						$color = 'pink';
					}else
					  if($counter == 1) {
						$color = 'yellow';	  
					}
					  
					$data .= '<div class="col-md-3 col-sm-6 col-xs-12 column">';
						$data .= '<div class="img-holder">';
							$data .= '<img src="'.IMAGES.'/course/ '.$row['image_name'].'" width="302" height="221"  alt="image description">';
							if($row['ac_logo']<> ""){
								$data .= '<img src="'.IMAGES.'/course/ '.$row['ac_logo'].'" width="274" height="203" class="class">';
							}
							
							$data .= '</div>';
							$data .= '<div class="caption-holder '.$color.'">';
								$data .= '<a href="'.DOMAIN.'?action=course-detail&amp;id='.$id.'"><span>'.substr($row['title'],0,60).'</a></span>';
							$data .= '</div>';
						$data .= '<div class="text-holder">'; 
							$data .= '<span class="language">'.$row['sub_category'].'&nbsp;&nbsp;'.$row['course_code'].'</span>';
							$data .= '<div class="rating">';
								$data .= '<img src="'.DOMAIN.'/images/'.$star_img.'.png" width="89" height="14" alt="star">';
								$data .= '<span>'.$rating.'</span>';
							$data .= '</div>';
							if($is_display == true){
								$data .= '<div class="month">';
									$data .= $priceStr;
								$data .= '</div>';
							}
						$data .= '</div>';
					$data .= '</div>';
				  $counter ++;
				}
			  } // else end
		  }
		 return $data;
	  }
		
	 // getAcademicPartner
	
	  
		
		public function getCrousalModel($aData){ 
	        $data = false;
			if(is_array($aData)){
			  
			  if(count($aData) > 0){
				for($k = 0;$k<sizeof($aData['id']);$k++){				
					$data .= '<div class="modal fade" id="myModal-'.$aData['id'][$k].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
					$data .= '<div class="modal-dialog" role="document">';
					$data .= '<div class="modal-content">';
								$data .= '<div class="modal-header">';
									$data .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
									$data .= '<span aria-hidden="true">&times;</span></button>';
									$data .= '</div>';
									$data .= '<div class="modal-body">';
									$data .= '<div class="img-holder">';
									$data .= '	<img src="'.IMAGES.'/acadimic-partners/'.$aData['image'][$k].'" width="155" height="155" alt="image">';
									$data .= '	</div>';
									$data .= '	<strong>'.$aData['title'][$k].'</strong>';
									$data .=  $aData['desc'][$k];
									$data .= '</div>';
									$data .= '<div class="modal-footer">';
									if($aData['url'][$k]<>""){
										$data .= '<span>For further info, please visit</span><a href="'.$aData['url'][$k].'">'.$aData['url'][$k].'/</a>';
									}
									$data .= '</div>';
								$data .= '</div>';
						$data .= '</div>';
					$data .= '</div>';
				}			
			}
		}
		  return $data;
	  }

    // get testimonails
	  public function getTestimonials(){
			$data = false;
			
		   $strQuery = "SELECT title,sbs_title AS sub_title,sbs_user  AS user,sbs_designation AS work,image_name
			FROM ".$this->testimonial."  WHERE sbs_status= '".ACTIVE."' ".$this->orderBy('Id','DESC')."  LIMIT 0,10";
			$strQueryExi = mysql_query($strQuery);
			if(mysql_num_rows($strQueryExi) > 0){
			 
			 $aList  = array();
			 $data = '';
			 $data .= '<section class="testimonials">';
			 $data .= '<div class="container">';
				 $data .= '<div class="heading">';
					 $data .= '<span>Testimonial</span>';
				 $data .= '</div>';
			 $data .= '</div>';
			 $data .= '<div class="container">';
				 $data .= '<div class="row carousel-holder">';
					 $data .= '<div id="carousel-example-generic4" class="carousel slide" data-ride="carousel">';
						
					$data .= '<div class="carousel-inner" role="listbox">';
					
						$totalRecord = mysql_num_rows($strQueryExi);
						$noOfBlockPerRow  = 4;
						
						$totalRows  = $totalRecord / $noOfBlockPerRow;
						if($totalRecord%$noOfBlockPerRow !=0){
						  $totalRows  = $totalRows + 1;	
						}
						
						$blockCounter = 1;
						for($i = 1; $i<=$totalRows; $i++){ // generate row
							$active = '';
							 if($i==1){
							  $active  = 'active';	
							 }
							 
							 $data .= '<div class="item '.$active.' '.$i.'">';
							   $data .= '<div class="text-columns">';
							   $k=1;
							   while($row = mysql_fetch_assoc($strQueryExi)){	 	
							   $data .= '<div class="col-sm-3 col-xs-12 column col-'.$blockCounter.'">';
									$data .= '<div class="text-frame">';
										$data .= '<span class="title">'.$row['title'].'</span>';
										$data .= '<p>'.$row['sub_title'].'</p>';
									$data .= '</div>';
									$data .= '<div class="client-holder">'; 
										$data .= '<img src="'. IMAGES.'/testimonial/'.$row['image_name'].'" width="73" height="73" alt="image">';
										$data .= '<div class="name-holder">';
										$data .= '<span class="name">'.$row['user'].'</span>';
											$data .= '<em> '.$row['work'].'</em>';
										$data .= '</div>';
									$data .= '</div>';
								$data .= '</div>';
									
								if($blockCounter==$totalRecord){
									break;	
								}
								$blockCounter++;
								
								if($k==$noOfBlockPerRow){
									break;	
								}
								$aList[] = $k; // for navigation
								$k++;
							}
						   $data .= '</div>';	  
						 $data .= '</div>';
					}
				
					$data .= '</div>';
					
					$data .= '<ol class="carousel-indicators">';
					for($x=0;$x<sizeof($aList)-2;$x++){
					$active = '';
					if($x==0)  $active = 'active';
						$data .= '<li data-target="#carousel-example-generic4" data-slide-to="'.($aList[$x]-1).'" class="'.$active.'"></li>';
					}
					$data .= '</ol>';
				 $data .= '</div>';
				$data .= '</div>';
			$data .= '</div>';
		$data .= '</section>';
		   }
		return $data;
	  }
	 
	 // get home about us text
	   public function getHomeAboutContent(){
			
	 	   $strQuery = "SELECT * FROM ".$this->about_home." WHERE status= '".ACTIVE."' ".$this->orderBy('id','DESC')." ";  
			$strQueryExi = mysql_query($strQuery);
			$data = false;
				if(mysql_num_rows($strQueryExi) > 0 ){
				    $counter = 1;
					while($row = mysql_fetch_assoc($strQueryExi)){ 
						  
						$data .= '<section class="about">';
						$data .= '<div class="container">';
							$data .= '<div class="heading">';
							$data .= '<span>about us</span>';
							$data .= '</div>';
							$data .= '<div class="row">';
							$data .= '<div class="col-sm-4 col-xs-12">';
							$data .= $this->getMedia($row['display_mode'],$row['video_url'],$row['image_name']); // get media
							$data .= '<ul class="list">';
										$data .= '<li><a href="#">home</a></li>';
										$data .= '<li><a href="#">about</a></li>';
										$data .= '<li>video</li>';
									$data .= '</ul>';
									$data .= '<em>'.$row['short_detail'].'</em>';
								$data .= '</div>';
								
								$data .= '<div class="col-sm-4 col-xs-12 center2">';
								$data .= '<div class="center">';
										$data .= $row['description'];
									$data .= '</div>';
								$data .= '</div>';
									 
								$data .= '<div class="col-sm-4 col-xs-12">';
								$data .= '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
									$data .= '<div class="panel panel-default">';
										$data .= '<div class="panel-heading" role="tab" id="headingOne">';
											$data .= '<h4 class="panel-title">';
											$data .= '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">';
											$data .= $row['f_tab_title'];
											$data .= '</a>';
											$data .= '</h4>';
											$data .= '</div>';
											$data .= '<div id="collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">';
											$data .= '<div class="panel-body">';
												$data .= '<p>'.$row['f_tab_text'].'</p>';
												$data .= '</div>';
											$data .= '</div>';
										$data .= '</div>';
										$data .= '<div class="panel panel-default">';
											$data .= '<div class="panel-heading" role="tab" id="headingTwo">';
												$data .= '<h4 class="panel-title">';
											$data .= '<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">';
													$data .=  $row['s_tab_title'];
												$data .= '</a>';
												$data .= '</h4>';
											$data .= '</div>';
											$data .= '<div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">';
										$data .= '<div class="panel-body">';
											$data .= '<p>'.$row['s_tab_text'].'</p>';
										$data .= '</div>';
									$data .= '</div>';
								$data .= '</div>';
									$data .= '<div class="panel panel-default">';
									$data .= '<div class="panel-heading" role="tab" id="headingThree">';
									$data .= '<h4 class="panel-title">';
										$data .= '<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">';
											$data .= $row['t_tab_title'];
										$data .= '</a>';
										$data .= '</h4>';
									$data .= '</div>';
									$data .= '<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">';
									$data .= '<div class="panel-body">';
										$data .= '<p>'.$row['t_tab_text'].'</p>';
										$data .= '</div>';
									$data .= '</div>';
								$data .= '</div>';
							$data .= '</div>';
							$data .= '</div>';
									
							$data .= '</div>';
						$data .= '</div>';
					$data .= '</section>';	
				   $counter++;
			 	}		
			}
		    return $data;
	   }
	   
	   
		
	    // get latest news
	     public function getLatestNews(){
			
		  $strQuery = "SELECT title,small_description,news_image AS image_name,published_date
		    FROM ".$this->news." WHERE status= '".ACTIVE."' 
			AND (
			date(
				published_date) = '".date('Y-m-d')."' 
			OR date(
				published_date) < '".date('Y-m-d')."'
			)" .$this->orderBy('id','DESC')." LIMIT 0,2"; 
		   $strQueryExi = mysql_query($strQuery);
			$data = false;
			if(mysql_num_rows($strQueryExi) > 0 ){
			$counter = 0;
			$data .= '<div class="col-md-6 col-sm-12 right-col">';
				$data .= '<h2>UpComing Events</h2>';
				  while($row = mysql_fetch_assoc($strQueryExi)){ 
					$day  = date('d',strtotime($row['published_date']));
					$month  = date('m',strtotime($row['published_date']));
					$year  = date('Y',strtotime($row['published_date']));
					  
					 $data .= '<article class="post">';
						$data .= '<div class="post-holder">';
							$data .= '<div class="text-box">';
									$data .= '<time class="date" datetime="8-25-2015"><strong>'.$day.'</strong> <span>'.$month.' <br> '.$year.'</span></time>';
									$data .= '<span class="title">'.substr($row['title'],0,35).'</span>';
									$data .= '<p>'.substr($row['small_description'],0,65).'</p>';
								$data .= '</div>';
								$data .= '<div class="img-box">';
								$data .= '<img src="'. IMAGES.'/news/'.$row['image_name'].'" width="226" height="198" alt="image">';
								$data .= '<button type="button" class="button">read more</button>';
								$data .= '</div>';
							$data .= '</div>';
						$data .= '</article>';
				    $counter++;
				 } 
				$data .= '<article class="post last">';
				$data .= '<div class="post-holder">';
					$data .= '<div class="text-box">';
						$data .= '<p>Termporbus autem quibusdam et aut  officis debitis aut rerum.</p>';	
						$data .= '</div>';
						$data .= '<a class="more-news" href="#">more news</a>';
					$data .= '</div>';
				$data .= '</article>';
				$data .= '</div>';
			}
		    return $data;
	    }	
		
		
		// get menu
		/*public function getMenu($type=''){ 
		
		   $top_menu = 'HCC.in_top_menu  = '.ACTIVE.' AND ';
		   if($type == $this->menu_right){
			 $top_menu = '';   
		   }
			 
			$strQuery = "SELECT HCSC.Id AS id,HCC.sbs_title AS category,HCSC.sbs_title AS sub_category 
			FROM `".$this->course_category."` AS HCC
			INNER JOIN `".$this->course_subcategory."` AS HCSC 
			ON HCC.Id  = HCSC.cat_id 
			WHERE ".$top_menu." HCC.sbs_status='".ACTIVE."' 
			" .$this->orderBy('HCC.sbs_title','DESC')." LIMIT 0,7";

		    $strQueryExi = mysql_query($strQuery);
			$data = false;
			if(mysql_num_rows($strQueryExi) > 0 ){
			$counter = 0;
			      $aMenu = array();
					while($row = mysql_fetch_assoc($strQueryExi)){ 
						$aMenu[$row['category']][$row['id']] = $row['sub_category'];
						$counter++;
					} 
				   // get menu
					
				if($type == $this->menu_right){	
					 
				  $count  = 1;
				   foreach($aMenu as $category=>$child){
						$active = false;
						$in = '';
						if($count == 1){
						$active  = true;
						 $in = 'in'; 
						}
					  
					  $data .= '<div class="panel panel-default">';
						$data .= '<div class="panel-heading" role="tab" id="heading'.$count.'">';
							$data .= '<h4 class="panel-title">';
								$data .= '<a role="button" data-toggle="collapse" data-parent="#accordion" 
								href="#collapse'.$count.'" aria-expanded="'.$active.'" aria-controls="collapse'.$count.'">';
								 $data .= $category;
								$data .= '</a>';
								$data .= '</h4>';
							$data .= '</div>';
							$data .= '<div id="collapse'.$count.'" class="panel-collapse collapse '.$in.'" role="tabpanel" aria-labelledby="heading'.$count.'">';
							$data .= '<div class="panel-body">';
								$data .= '<ul class="course-list">';
								
								foreach($child as $id=>$subCategory){	
									$data .= '<li><a href="'.DOMAIN.'/?action=courses&amp;sub-cat='.$id.'">'.$subCategory.'</a></li>';
								}
								$data .= '</ul>';
								$data .= '</div>';
							$data .= '</div>';
						$data .= '</div>';
					 
				 	$count++;
				}  	 
			 
			 }else{
				   $count  = 1;
				   // seperate child
				   foreach($aMenu as $category=>$child){
					    // parent configration 
						// get childs
						$data .= '<li class="dropdown">';
						$data .= '<a class="dropdown-toggle" href="javascript:void(0);">'.$category.'</a>';
						$data .= '<ul class="menu-2">';
							// create child
							foreach($child as $id=>$subCategory){
								$data .= '<li><a href="'.DOMAIN.'/?action=courses&amp;sub-cat='.$id.'">'.$subCategory.'</a></li>';
							}
						$data .= '</ul>';
						$data .= '</li>';	
				      $count++;
					}   
				}
			}
		    return $data;
	    }	*/
		
		 public function getMenu($type=''){ 
		
		   $top_menu = 'HCC.in_top_menu  = '.ACTIVE.' AND ';
		   if($type == $this->menu_right){
			 $top_menu = '';   
		   }
			 
	       $strQuery = "SELECT HCSC.cat_id AS category_id,HCSC.Id AS id,HCC.sbs_title AS category,HCSC.sbs_title AS sub_category 
			FROM `".$this->course_category."` AS HCC
			INNER JOIN `".$this->course_subcategory."` AS HCSC 
			ON HCC.Id  = HCSC.cat_id 
			WHERE ".$top_menu." HCC.sbs_status='".ACTIVE."' 
			" .$this->orderBy('HCC.sbs_title','DESC')." LIMIT 0,7";

		    $strQueryExi = mysql_query($strQuery);
			$data = false;
			if(mysql_num_rows($strQueryExi) > 0 ){
			$counter = 0;
			      $aMenu = array();
				  	if($type == $this->menu_right){ 
						while($row = mysql_fetch_assoc($strQueryExi)){ 
							$aMenu[$row['category_id']] = $row['category'];
							$counter++;
						} 
						$aMenu = array_unique($aMenu);	
					}else{
						// for top menu
						while($row = mysql_fetch_assoc($strQueryExi)){ 
							$aMenu[$row['category']][$row['id']] = $row['sub_category'];
							$counter++;
						}
					} 
				   // get menu
				
				//die();
				if($type == $this->menu_right){	
					 
				  	//$count  = 1;
				  // foreach($aMenu as $id=>$catgory){
					 
						/*$active = false;
						$in = '';
						if($count == 1){
							$active  = true;
							$in = 'in'; 
						}
					  */
					   $data .= '<div class="panel panel-default">';
						$data .= '<div class="panel-heading" role="tab" id="heading">';
							$data .= '<h4 class="panel-title">';
								$data .= '<a role="button" data-toggle="collapse" data-parent="#accordion" 
								href="#collapse" aria-expanded="true" aria-controls="collapse">';
								 $data .= 'Search By Category'; //$category;
								$data .= '</a>';
								$data .= '</h4>';
							$data .= '</div>';
							$data .= '<div id="collapse" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading">';
							$data .= '<div class="panel-body">';
								$data .= '<ul class="course-list">';
								
								  foreach($aMenu as $id=>$catgory){
									$data .= '<li><a href="'.DOMAIN.'/?action=courses&amp;cat-id='.$id.'">'.$catgory.'</a></li>';
								  }
								$data .= '</ul>';
								$data .= '</div>';
							$data .= '</div>';
						$data .= '</div>';
					 
				 	//$count++;
				//}  	 
			 
			 }else{
				   $count  = 1;
				   // seperate child
				   foreach($aMenu as $category=>$child){
					    // parent configration 
						// get childs
						$data .= '<li class="dropdown">';
						$data .= '<a class="dropdown-toggle" href="javascript:void(0);">'.$category.'</a>';
						$data .= '<ul class="menu-2">';
							// create child
							foreach($child as $id=>$subCategory){
								$data .= '<li><a href="'.DOMAIN.'/?action=courses&amp;sub-cat='.$id.'">'.$subCategory.'</a></li>';
							}
						$data .= '</ul>';
						$data .= '</li>';	
				      $count++;
					}   
				}
			}
		    return $data;
	    }	
		
		/// get accrdations logo
		public function getAccridation($checked=''){
		    
			$strQuery = "SELECT A.Id AS id,A.sbs_title AS  title FROM ".$this->accredation."  as A  WHERE sbs_status='".ACTIVE."' 
			".$this->orderBy('A.Id','DESC').""; 
		    $strQueryExi = mysql_query($strQuery);
			$data = false;
			if(mysql_num_rows($strQueryExi) > 0 ){
				$counter = 1;
				while($row = mysql_fetch_assoc($strQueryExi)){ 
				    $data .= '<div class="check-box">';
						$data .= '<label>';
						$check = '';
						if(isset($checked) && $checked == $row['id']){
						 $check = 'checked="checked"';	
						}
							$data .= '<input type="checkbox" id="'.$counter.'" name="ac" value="'.$row['id'].'"  '.$check.' >';
							$data .= $row['title'];
						$data .= '	</label>';
					$data .= '</div>';
				   $counter++;
				}
				$data .= '<input type="hidden" id="total_accrdation" value="'.($counter-1).'">';
			}
			 return $data;
		 }
		
		// get cart
		public function getCart(){
		
			$strQuery = "SELECT HCART.id,HCART.course_id,HCART.selected_price AS user_course_price,HCART.quantity,HC.title AS course_name,HC.image_name1 AS image
						FROM `".$this->cart."` AS HCART INNER JOIN `".$this->course."` as HC ON HCART.course_id = HC.id 
						WHERE HCART.user_id = '".$this->getUser('user_id')."' AND 
						date(HCART.created_at ) = '".date('Y-m-d')."'  ".$this->orderBy('HCART.id','DESC').""; 
		    $strQueryExi = mysql_query($strQuery);
			$data = 0;
			if(mysql_num_rows($strQueryExi) > 0 ){
				$data = $strQueryExi;
			}
			
			return $data;
		}
		
		// upudate cart
		public function updateCart($aCartVal){
			
			for($k  = 0 ; $k <sizeof($aCartVal['id']); $k++){
			 	$id = $aCartVal['id'][$k];
				$quanity = $aCartVal['course_quanity'][$k];
				$unitPrice = $aCartVal['unit_price'][$k];
				$strQueryExi = mysql_query("UPDATE `".$this->cart."` SET  quantity ='".$quanity."'  WHERE id = '".$id."'");
			}	
		    $data = 0;
			if($strQueryExi !='' ){
				$data = true;
				$_SESSION['cart_updated'] = 'Cart Updated Sucessfully.';
				$_SESSION['cart_updated_class'] = 'success';
				
				$this->redirection(DOMAIN.'/cart-view/');
			}
		   return $data;
		}
		
		// confirmOrder
		public function confirmOrder($aOrderVal){
			
			$userId = $this->getUser('user_id');
			$orderNo  = substr(rand(),0,4);
			$strQuery = "INSERT INTO ".$this->order." (`order_no`,`user_id`,`status`,`grand_amount`,`payment_method`,`created_at`,`updated_at`)
			VALUES('".$orderNo."','".$userId."','".PENDING."','".$aOrderVal['grand_total']."','".$aOrderVal['payment_method']."',NOW(),NOW())";
			
			$strQueryExi = mysql_query($strQuery);
			$orderId  =  mysql_insert_id(); // order_id
			if($strQueryExi !=""){
			
				for($k= 0 ;$k <sizeof($aOrderVal['courseId']); $k++){ // make order detail
				
					$courseId =  $aOrderVal['courseId'][$k];
					$quantity =  $aOrderVal['quantity'][$k];
					$quantity =  $aOrderVal['quantity'][$k];
					$price =     $aOrderVal['userCoursePrice'][$k];
					$aUserCoursePackagePrice = explode("-",$aOrderVal['userCoursePackagePrice'][$k]);
					$package = $aUserCoursePackagePrice[1]; // pakage
					
					$strQ = "INSERT INTO ".$this->order_detail." (`order_id`,`user_id`,`course_id`,`quantity`,`price`,`package`,`created_at`,`updated_at`)
					VALUES('".$orderId."','".$userId."','".$courseId."','".$quantity."','".$price."','".$package."',NOW(),NOW())"; 
					mysql_query($strQ);	 
			   }  
			   
					$strQu = "INSERT INTO ".$this->order_address." (`order_id`, `email`, `first_name`, `last_name`, `company_name`, `post_code`, `country`, `city`, `state`, `street`, `phone`,`additional_information`,`created_at`)
					VALUES('".$orderId."',
					'".$aOrderVal['email_addres']."',
					'".$aOrderVal['first_name']."',
					'".$aOrderVal['last_name']."',
					'".$aOrderVal['company_name']."',
					'".$aOrderVal['post_code']."',
					'".$aOrderVal['country']."',
					'".$aOrderVal['city']."',
					'".$aOrderVal['state']."',
					'".$aOrderVal['street_address']."',
					'".$aOrderVal['phone_no']."',
					'".$aOrderVal['additional_information']."',
					NOW())"; 
					if(mysql_query($strQu) !=''){
						$this->flushUserCart(); // flush cart 
						$_SESSION['order_confrim_success'] = true;
						$_SESSION['user']['order_id'] = $orderId;
						$_SESSION['user']['grand_total'] = $aOrderVal['grand_total'];
						// check payment method
						if($aOrderVal['payment_method'] ==PAYPAL){ 
							$this->redirection(DOMAIN.'/paypal/'); // for paypal redirection	
						}else{
							$this->redirection(DOMAIN.'/confirmed-order/'); // for bank draft redirection
						}
						$data = true;	
					}	 
			  }
			//return $data;
		}
		
		//order update
		public function orderUpdate($aPaypal){
		
			// ACTIVE used for enable
			$strQuery = "UPDATE ".$this->order." SET is_payment_received='".PAYMENT_DONE."' WHERE id='".$aPaypal['updateOrderId']."' ";
			$strQueryExi = mysql_query($strQuery);
			$data = 0;
			if($strQueryExi !=''){
				$data = true;	
				$_SESSION['user']['grand_total'] ='';
				$this->redirection(DOMAIN.'/confirmed-order/');
			}
			//$this->pre($data);
			//return $data;
		}
		
		// cart total
		public function cartTotal(){
		
			$strQuery = "SELECT count( * ) AS total_cart FROM `".$this->cart."`
			 WHERE user_id ='".$this->getUser('user_id')."'  AND date(created_at ) = '".date('Y-m-d')."' ";
			$strQueryExi = mysql_query($strQuery);
			$data = 0;
			if(mysql_num_rows($strQueryExi) > 0){
			$row = mysql_fetch_assoc($strQueryExi);
				$data = $row['total_cart'];
			}
				//$this->pre($data);
			return $data;
		}
		
		
		
	    // get order Detail
		public function getOrderDetail($orderId){
		
		 $strQuery = "SELECT OD.id,OD.quantity AS quantity,OD.price AS price,OD.package AS package,HC.title AS course_name
						FROM `".$this->order_detail."` AS OD 
						INNER JOIN `".$this->course."` as HC ON OD.course_id = HC.id 
						WHERE OD.user_id = '".$this->getUser('user_id')."' AND 
						date(OD.created_at ) = '".date('Y-m-d')."' AND OD.order_id ='".$orderId."' ".$this->orderBy('OD.id','DESC').""; 
						//die();
		    $strQueryExi = mysql_query($strQuery);
			$data = 0;
			if($strQueryExi !=''){
				$data = $strQueryExi;
			}
			return $data;
		}
		
		 // get order Detail
		public function getOrder($orderId){
			$data = 2;
			if($orderId <> ""){
				 $strQuery = "SELECT  O.id,O.order_no AS order_no,
							O.created_at  AS order_date,O.payment_method AS payment_method,O.grand_amount as total FROM `".$this->order."` AS O
							WHERE O.user_id = '".$this->getUser('user_id')."' AND O.id ='".$orderId."' AND
							date(O.created_at) = '".date('Y-m-d')."' "; 
							//die();
				$strQueryExi = mysql_query($strQuery);
				$data = 0;
				if(mysql_num_rows($strQueryExi) > 0){
					$row = mysql_fetch_assoc($strQueryExi);
					$data = $row;
				}
				//$this->pre($data);
			}
			return $data;
		}
		
		// billing info
		
	
		
		// rating 
		
		// checkexist cart
		public function checkExistCart($aCart){
		
			$strQuery = "SELECT user_id,course_id  FROM ".$this->cart."  
			WHERE user_id = '".$aCart['user_id']."'  AND  course_id = '".$aCart['course_id']."' AND date(created_at ) = '".date('Y-m-d')."' ";
			$strQueryExi = mysql_query($strQuery);
			$data = false;
			if(mysql_num_rows($strQueryExi) > 0){
				$data =  true;
			}
			return $data;  
		}
		// remove selected cart
		public function removeCart($var=''){
		
			$strQuery = "DELETE  FROM ".$this->cart."  WHERE id = '".$var['cart_id']."'"; 
			$strQueryExi = mysql_query($strQuery);
			$data = false;
			if($strQueryExi!=''){
				$data =  true;
			}
			return $data;  
		}
		// flush user cart
		public function flushUserCart(){
		   
			$strQuery = "DELETE  FROM ".$this->cart."  WHERE user_id = '".$this->getUser('user_id')."' AND date(created_at ) = '".date('Y-m-d')."'"; 
			$strQueryExi = mysql_query($strQuery);
			$data = false;
			if($strQueryExi!=''){
				$data =  true;
			}
			return $data;  
		}
		
		// save cart
		public function saveCart($aCart){
			$data= false;
			if($this->checkExistCart($aCart) > 0){
				$_SESSION['cart_fail'] = 'This course already in cart.';
				$_SESSION['cart_fail_class'] = 'error';
				$this->redirection(DOMAIN.'/courses/');
				return 2;
			}
			
		  //$selected_price = explode("-",$aCart['user_choosed_price']);
		   $strQuery = "INSERT INTO ".$this->cart." (`user_id`, `course_id`,`selected_price`,`quantity`, `created_at`, `updated_at`)
			VALUES('".$aCart['user_id']."','".$aCart['course_id']."','".$aCart['user_choosed_price']."','".$aCart['quantity']."',NOW(),NOW())";
			$strQueryExi = mysql_query($strQuery);
			if($strQueryExi !=""){
				$_SESSION['cart_success'] = 'Selectecd Course added in cart.';
				$_SESSION['cart_suc_class'] = 'success';
				// get course title
				$_SESSION['latest-cart_course'] = $this->getColVal(
														array(
															'table'=>$this->course,
															'column'=> array('title'), // pass columns that you want and set row false
															'key'=>'id',
															'val'=>$aCart['course_id'],
															'row'=>false  // if set to true it will return whole row
														) 
												  );	
				
				$this->redirection(DOMAIN.'/cart-view/');
				$data = true;
			}
			return $data;
		} 
	/*******/
	 /**|||||||||||||||||||||||||||||||HomeiLearn||||||||||||||||||||||||||||||||||**/ 
	  
	/***check user exist***/
		function checkDuplication($table,$column,$value){
			
			if($table <> ""){
				$strQuery = "SELECT ".$column." FROM ".$table."  WHERE ".$column." = '".$value."'";
				$strQueryExi = mysql_query($strQuery);
				$data = false;
				if(mysql_num_rows($strQueryExi) > 0){
					$data =  true;
				}
				return $data;
			}
		} 
    
	/***register subscribers***/
	
	
	// user signup
	
	
	
	// qoute
	
	
	
	// logout
	 public function logout(){
			
		//unset($_SEESION);
		$_SESSION['user']['user_id']= '';
		$_SESSION['user']['user_name']= '';
		$_SESSION['user']['email']= '';
		//$_SESSION['user']['order_id'] = '';
		$this->redirection(admin_url);
		return true;
	}
	
	// file name. // field Name. // upload path.
	   public function uploadFile($aFile,$fieldName,$path,$counter,$file=''){ 
			$file_name = false;
			//	echo 'file is=='.$image = $aFile['image']['name'][0];
			//	echo "</br>";
			//echo 'file is=='.$aFile[$fieldName]["name"];
			
			
			if(!empty($file)){
				
				if(!empty($file)){
					$listImagePath= $path;
					$file_name = $file;
					$ext = pathinfo($file_name,PATHINFO_EXTENSION);
					$filename = basename($file_name,$ext);
					$renameFileName  =   $counter.'_'.time().'.'.$ext; 
					move_uploaded_file($file_tmp = $aFile[$fieldName]["tmp_name"][0],$listImagePath.$renameFileName);
					return $renameFileName;
				}	 
			}else
			if($aFile[$fieldName]["name"]<>""){
				//die('in else');
				$listImagePath= $path;
				$file_name = $aFile[$fieldName]["name"];
				$ext = pathinfo($file_name,PATHINFO_EXTENSION);
				$filename = basename($file_name,$ext);
				$renameFileName  =   $counter.'_'.time().'.'.$ext; 
				move_uploaded_file($file_tmp = $aFile[$fieldName]["tmp_name"],$listImagePath.$renameFileName);
				return $renameFileName;
			}	 
			$counter++;
			
		//	die('in function');
			/*$file_name = false;
			if($file <>""){
				$listImagePath= $path;
				$file_name = $file;
				$ext = pathinfo($file_name,PATHINFO_EXTENSION);
				$filename = basename($file_name,$ext);
				$renameFileName  =   $counter.'_'.time().'.'.$ext; 
				move_uploaded_file($file_tmp = $aFile[$fieldName]["tmp_name"],$listImagePath.$renameFileName);
				return $renameFileName;
			}	 
			$counter++;
			*/
			
		} 
		
	// add driver  	
	function addDriver($aRequest,$aFile){
		
		$data= false;
		$file  = $this->uploadFile($aFile,'image','uploads/driver/',1);
		$licenceFile  = $this->uploadFile($aFile,'driver_licence','uploads/driver/',2);
		if($file==''){
			echo '<script type="text/javascript">alert("file Failed to upload user profile.");</script>';	
			return 0;
		}
		
		if($licenceFile==''){
			echo '<script type="text/javascript">alert("Licence file Failed to upload");</script>';	
			return 0;
		}
		
		$strQuery = "INSERT INTO ".$this->driver." 
		(
			`driver_no`, 
			`driver_name`,
			`image`, 
			`driver_licence`,
			`id_card_no`,
			`vehicle_no`,
			`plate_no`, 
			`phone_no`, 
			`gender`
		 )
		VALUES(
			'".$aRequest['driver_no']."',
			'".$aRequest['driver_name']."',
			'".$file."',
			'".$licenceFile."',
			'".$aRequest['id_card_no']."',
			'".$aRequest['vehicle_no']."',
			'".$aRequest['plate_no']."',
			'".$aRequest['phone_no']."',
			'".$aRequest['gender']."'
		)";
		
		$strQueryExi = mysql_query($strQuery);
		if($strQueryExi !=""){
			$data = true;
			echo '<script type="text/javascript">alert("Driver Added Successfully");</script>';	
		}
		return $data;
	 }
    
	// upudate Driver
		public function updateDriver($aRequest,$aFile){
			
			$counter  = 0;
			$drverName = $aRequest['driver_name'][$counter];
			$driverNo = $aRequest['driver_no'][$counter];
			$driverIdCardNo = $aRequest['id_card_no'][$counter];
			$driverVehicleNo = $aRequest['vehicle_no'][$counter];
			$driverPalteNo = $aRequest['plate_no'][$counter];
			$driverPhoneNo = $aRequest['phone_no'][$counter];
			$driverGender = $aRequest['gender'][$counter];
			$driverId = $aRequest['id'][$counter];
			
			$image = $aFile['image']['name'][$counter];
			$imageHidden = $aRequest['image_hidden'][$counter];
			
			$driverLicence = $aFile['driver_licence']['name'][$counter];
			$driverLicenceHidden = $aRequest['driver_licence_hidden'][$counter];
			
			$data= false;
			
			if($aFile['image']['name'][$counter] <>""){
			  	$file  = $this->uploadFile($aFile,'image','uploads/driver/',0,$aFile['image']['name'][$counter]);
				if($file==''){
					echo '<script type="text/javascript">alert("file Failed to upload driver profile.");</script>';	
					return 0;
				}
				 
			}else
			{
				$file  = $imageHidden ;	
			}
			
			if($aFile['driver_licence']['name'][$counter] <>""){
			  	$licenceFile  = $this->uploadFile($aFile,'driver_licence','uploads/driver/',0,$aFile['driver_licence']['name'][$counter]);
				if($licenceFile==''){
					echo '<script type="text/javascript">alert("Licence file Failed to upload.");</script>';	
					return 0;
				}
				 
			}else
			{
				$licenceFile  = $driverLicenceHidden ;	
			}
			$strQueryExi = mysql_query("UPDATE 
				`".$this->driver."` 
				SET 
					driver_name ='".$drverName."',
					driver_no ='".$driverNo."',
					id_card_no ='".$driverIdCardNo."' , 
					image ='".$file."',
					driver_licence ='".$licenceFile."' ,
					vehicle_no ='".$driverVehicleNo."' , 
					plate_no ='".$driverPalteNo."' , 
					phone_no ='".$driverPhoneNo."' , 
					gender ='".$driverGender."' 
				 WHERE 
				id = '".$driverId."'");
			$data = 0;
			if($strQueryExi !='' ){
				$data = true;
				echo '<script type="text/javascript">alert("Driver information updated Successfully");</script>';		
			}
		   return $data;
		}
	
	
	public function deleteDriver($aVar){
		  
		  if(is_array($aVar)):
			$strQuery = "DELETE  FROM ".$this->driver."  WHERE id = '".$aVar['id']."'"; 
			$strQueryExi = mysql_query($strQuery);
			$data = false;
			if($strQueryExi!=''){
				$data =  true;
				echo '<script type="text/javascript">alert("Driver information removed Successfully");</script>';		
			}
		 endif;
			return $data;  
		}	
		
	
	// selc where date between 'dada' ad hkdhsdkh
	// user login
     public function userLogin($aUser){
	   global  $con;
	      $queryStr="SELECT U.id AS user_id,U.name AS user_name,U.email,U.password FROM ".$this->user." AS U  
		WHERE 
				U.email='".$aUser['email']."'  
			AND 
				U.password ='".$aUser['password']."' 
			AND 
				U.status ='".ACTIVE."'";
			
		$queryExi = mysqli_query($con,$queryStr);
		$data = 0;
		if(mysqli_num_rows($queryExi) > 0) {
			session_start();
			$user  = mysqli_fetch_assoc($queryExi);  
			$_SESSION['user']['user_id']= $user['user_id'];
			$_SESSION['user']['user_name']= $user['user_name'];
			$_SESSION['user']['email']= $user['email'];
			//echo "<br>";
			//$this->pre($_SESSION);
			
			
			$data = true;
		}
		return $data;
	}
	/*****Get Booking*****/
	public function getBooking($id=''){ 
	        
			$strQuery = "SELECT * FROM  
			  `".$this->booking."` AS B  ".$this->orderBy('B.id ','DESC')."  LIMIT 0,9";
			$strQueryExi = mysql_query($strQuery);
			$data = false;
			if(mysql_num_rows($strQueryExi) > 0 ){
				$aPending = array();
				$aConfirm = array();
				$aInProgress = array();
				$aData = array();
				while($row = mysql_fetch_assoc($strQueryExi)){
					$status = $row['booking_status'];
					if($status == PENDING){
						$aPending[] = $row;	
					}else
					if($status == CONFIRM){
						$aConfirm[] = $row;	
					}else
					if($status == IN_PROGRESS){
						$aInProgress[] = $row;	
					}
				}
				
				$aData['pending']  = $aPending; 
				$aData['confirm']  = $aConfirm; 
				$aData['in_progress']  = $aInProgress; 
				$data =  $aData;
			}
			//$this->pre($data);
			//die();
		  return $data;
	  }
	/*****Get Booking*****/
	
	/*****Get Drivers*****/
	public function getDriver($id=''){ 
	        
			 $strQuery = "SELECT * FROM  
			  `".$this->driver."` AS D ".$this->orderBy('D.id ','DESC')."  LIMIT 0,9";
			$strQueryExi = mysql_query($strQuery);
			$data = false;
			if(mysql_num_rows($strQueryExi) > 0 ){
				$aRows = array();
				$aData = array();
				while($row = mysql_fetch_assoc($strQueryExi)){
					$aRows[] = $row;	
				}
				$data =  $aRows;
			}
		 return $data;
	  }
	/*****Get Drivers*****/
	  
	  public function generateReport($aRequest){ 
	        
			$where  = 'WHERE 1=1';
			$and  = '';
			$between  ='';
			//$this->pre($aRequest);
			if(is_array($aRequest)){
				
				$between .= ' AND DATE(created_date) BETWEEN ';
				// from date
				$fromDate = date('Y-m-d');
				if(isset($aRequest['from_date']) && !empty($aRequest['from_date'])){
					$fromDate = date('Y-m-d',strtotime($aRequest['from_date']));
				}
				// to date
				$toDate = date('Y-m-d');
				if(isset($aRequest['to_date']) && !empty($aRequest['to_date'])){
					$toDate =   date('Y-m-d',strtotime($aRequest['to_date']));
				}
				$between .=   "'".$fromDate."'"  . ' AND '.   "'".$toDate."'";
				if(isset($aRequest['status']) && $aRequest['status'] <> ""){
					$and .= ' AND booking_status =  "'.$aRequest['status'].'"';
				}
			}
			
			$where .= $and ; 
		  	$strQuery = "SELECT * FROM  
			`".$this->booking."` AS B   ".$where."   ".$between."  ".$this->orderBy('B.id ','DESC')."  LIMIT 0,9";
			$strQueryExi = mysql_query($strQuery);
			$data = false;
			if(mysql_num_rows($strQueryExi) > 0 ){
			$aData = array();
				while($row = mysql_fetch_assoc($strQueryExi)){
					$aData[] = $row;	
				}
				$data =  $aData;
			}
			
			//$this->pre($data);
			//die();
		  return $data;
	  }
	
	
	
	
	public function getUser($var=''){
		
		$data = false;
		if(isset($var) && $var == 'user_id'){
			if(isset($_SESSION['user']['user_id']) && $_SESSION['user']['user_id'] <> ""){
			    $data = $_SESSION['user']['user_id']; 
			} 
		}else
		if(isset($var) && $var == 'user_name'){
			if(isset($_SESSION['user']['user_name']) && $_SESSION['user']['user_name'] <> ""){
				$data = $_SESSION['user']['user_name'];
			} 
		}else
		if(isset($var) && $var == 'email'){
			if(isset($_SESSION['user']['email']) && $_SESSION['user']['email'] <> ""){
				$data = $_SESSION['user']['email'];
			} 
		}else
		if(isset($var) && $var == 'order_id'){
			if(isset($_SESSION['user']['order_id']) && $_SESSION['user']['order_id'] <> ""){
				$data = $_SESSION['user']['order_id'];
			} 
		}
	   return $data;
	}
	
	
	// page access
	public function pageAccess($access=''){
		if(isset($access) && $access == true){
		   if(!isset($_SESSION['user']['user_id']) or $_SESSION['user']['user_id'] ==""){
			$this->redirection(admin_url); 
		   }
		}
	}
	
	// send email
	
		
		
	function contactEmail($aVal){
		
	  global $config;
	  if(is_array($aVal)){
	  
	    $html ='<html>';	
	    $html .='<p>Hi, Admin</p></br>';								
		$html .='<table width="700" cellpadding="0" cellspacing="0"  style="font-family:Arial, Helvetica, sans-serif; border:1px #000 solid; padding:10px;color:#fff;background:#F6B52A;">';
		$html .='<tr><td colspan="2" ><h2><strong>Contact form</strong></h2></td></tr>';
		$html .='<tr><td colspan="2" >&nbsp;</td></tr>';
		if($aVal['username']){							
			$html .='<tr><td ><strong>Name</strong> </td><td >'.$aVal['username'].' </td></tr>';
		}
		if($aVal['email']){								
			$html .='<tr><td ><strong>Email</strong> </td><td >'.$aVal['email'].' </td></tr>';
		}
		
		if($aVal['usermessage']){
			$html .='<tr><td ><strong>Message</strong> </td><td >'.$aVal['usermessage'].'  </td></tr>';
		}
			 
		$html .='</table>';
		$html .='</html> ';
		$email_message = $html;
		$email_subject = $aVal['subject'];      
		$headers = 'From: assignment.co.uk' . "\r\n" ;
		$headers .='Reply-To: '.$aVal['email'].' \r\n' ;
		$headers .='X-Mailer: PHP/' . phpversion();
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        $to  = $config['masterEmail'];
		if(@mail($to, $email_subject, $email_message, $headers))
		{
			echo  '<span style="color:green">You have submitted successful,our representative will contact you shortly.</span>';

		}
		else
		{
			echo   '<span style="color:red">Email sending Fail</span>';
		}
		
		}
		
	}
	
	
	
	function isExist($aData){
		if(is_array($aData)) {
			
			$columns = '*';
			if(is_array($aData['column'])){
				$columns = implode(",",$aData['column']);
			}
			$whereClause = '';
			if(is_array($aData['where'])){
			foreach($aData['where'] as $key=>$val){
				$whereClause.= $key.'='.$val.' AND ';
			}
				$whereClause = rtrim($whereClause,' AND ');
			}
			
			$strQuery = "SELECT ".$columns." FROM ".$aData['table']."  WHERE ".$whereClause." ";
			$strQueryExi = mysql_query($strQuery);
			$data = false;
			if(mysql_num_rows($strQueryExi) > 0){
				$data =  true;
			}
		}
		return $data;
	} 
	
	// wishlist
	function wish_list($aRequest){
		
		$isExist  = $this->isExist(
					array(
					'column'=>array('course_id'=>$aRequest['course_id'],'user_id'=>$this->getUser('user_id')),
					'table'=>$this->wish_list,
					'where'=>array(
						'course_id'=>$aRequest['course_id'],
						'user_id'=>$this->getUser('user_id')
						)
					)
				);
		
		if($isExist){
		   return 2;	
		}
		$course_id = $aRequest['course_id'];
		$data = false;
		$strQuery = "INSERT INTO ".$this->wish_list." ( `user_id`, `course_id`, `created_at`)
		VALUES('".$this->getUser('user_id')."','".$course_id."',NOW())";
		$strQueryExi = mysql_query($strQuery);
		if($strQueryExi !=""){
			$data = true;
		}
		return $data;
	 
	 }
	// utility  
	// upload file. 
	
	
	
	
	/*  ||||||||||||||||||||||||||||||||  **/
	// My general functions
	// get specific column or row 

    public function getColVal($aData){
		if(is_array($aData)){
		
			$chooseColumnsStr = '';
			if($aData['row'] == true){
				$chooseColumnsStr = '*';	
			}else
			if(is_array($aData['column']) && count($aData['column']) > 0){
				$chooseColumnsStr = implode(",",$aData['column']);
			}
			
			$queryStr="SELECT ".$chooseColumnsStr." FROM ".$aData['table']."  WHERE   ".$aData['key']." ='".$aData['val']."'";
			$queryExi = mysql_query($queryStr);
			$data = false;
				if(mysql_num_rows($queryExi) > 0) {
					$row  = mysql_fetch_assoc($queryExi);
					if(is_array($aData['column']) and $aData['row'] === true){
						$data = $row; // row retrun 
					}else
						if(count($aData['column']) > 1){
						for($k=0;$k<sizeof($aData['column']);$k++){
							$data[$aData['column'][$k]] = $row[$aData['column'][$k]];
						}
					}else
						$data = $row[$chooseColumnsStr];
				}
		   }
	   return $data;
	}
	
	 // general function for get detail
	 
	 // call method  getDetail function pass thiss array
		/*array('column' => array(
					'title', 
					'sub_title',
					'image_name1',
					'description'
				),
					'table'=> $objMagicMayoModel->product,
					'where'=> array(
						'status'=>ACTIVE,
						'id'=>$id
					)
		 )*/
	 
	 
	 
	   public function getDetail($aData){
			global $con;
			$data = false;
			if(is_array($aData)){
				
				$columns = '*';
				if(is_array($aData['column'])){
				 	$columns = implode(',',$aData['column']);	 // 
				}
				
				$whereClause = '';
				if(is_array($aData['where'])){
					
					foreach($aData['where'] as $key=>$val){
						$whereClause.= $key.'='.$val.' AND ';
					}
					$whereClause = rtrim($whereClause,' AND ');
				}
				
			    $strQuery = "SELECT ".$columns."  FROM ".$aData['table']."  WHERE ".$whereClause." ";
			    $strQueryExi = mysqli_query($con,$strQuery);
				if(mysqli_num_rows($strQueryExi) > 0 ){
					$data = mysqli_fetch_assoc($strQueryExi);
				}
		   }
			return $data;
	    }
	
	   
		
	
	
	
	/*  ||||||||||||||||||||||||||||||||  **/
	 
	
	 //function get keywords
	 
	
	 
  // function order by
  public function orderBy($colName,$order=''){
		$result = '';
		$orderBy = 'DESC';
		if($order <> ""){
			$orderBy = $order;	
		}
		if($colName <> "" ){
			$result  = ' ORDER BY '.$colName.' '.$orderBy.'';	
		}
	   return $result;	
	}
	
	
	 public function getSearch(){
		$result = '';
		$orderBy = 'DESC';
		if($order <> ""){
			$orderBy = $order;	
		}
		if($colName <> "" ){
			$result  = ' ORDER BY '.$colName.' '.$orderBy.'';	
		}
	   return $result;	
	}
	
	
	
	
  // function print_r 
   public function pre($aData){
		
		if(is_array($aData)){
		 echo '<pre>';
			print_r($aData);
		 echo '</pre>';	
		 echo "</br>";
		}
	}
	 // get media
	public  function getMedia($mode,$url='',$image='',$aParameter=''){
		$data  = '';
		if($mode=='video'){
			$height = '231';
			$width = '380';
			if(is_array($aParameter)){
			  $height = $aParameter['height'];
			  $width = $aParameter['width'];	
			}
			$aUrl = explode("=",$url);
			$videoId= $aUrl[1];
			$data .='<iframe width="'.$width.'" height="'.$height.'" src="https://www.youtube.com/embed/'.$videoId.'" frameborder="0" allowfullscreen></iframe>';
		}else
			$data .= '<img src="'.IMAGES.'/about-us/'.$image.'" width="380" height="231" alt="">'; 
		
		return $data;
	}
	
	
  // encode uri
	public function redirection($url){
			if($url <> ""){
				echo "<script type='text/javascript'>window.location='".$url."'</script>";
			}
	  }
	  // star html
	 public function star($pageType=''){
		$data = FALSE;
		$data  .= '<ul class="star-rating">';
			$data  .= '<li class="setted"><a href="#" title="Rate this 1 star out of 5" class="one-star">1</a></li>';
			$data  .= '<li><a href="#" title="Rate this 2 stars out of 5" class="two-stars">2</a></li>';
			$data  .= '<li><a href="#" title="Rate this 3 stars out of 5" class="three-stars">3</a></li>';
			$data  .= '<li><a href="#" title="Rate this 4 stars out of 5" class="four-stars">4</a></li>';
			$data  .= '<li><a href="#" title="Rate this 5 stars out of 5" class="five-stars">5</a></li>';
			$data  .= '<input type="hidden" id="rating" value="1">';
		$data  .= '</ul>';
		return $data;
	}
	 
	 /*************Pagintaion function****************/
	public  function pagination($query, $per_page = 10,$page = 1, $url = '?'){ 
	         
    	$query = "SELECT COUNT(*) as `num` FROM {$query}";
		$row = mysql_fetch_array(mysql_query($query));
    	$total = $row['num'];
        $adjacents = "2"; 

    	$page = ($page == 0 ? 1 : $page);  
    	$start = ($page - 1) * $per_page;								
		
    	$prev = $page - 1;							
    	$next = $page + 1;
        $lastpage = ceil($total/$per_page);
    	$lpm1 = $lastpage - 1;
    	
    	$pagination = "";
    	if($lastpage > 1)
    	{	
    		$pagination .= "<ul class='pagination'>";
                    $pagination .= "<li class='details'>Page $page of $lastpage</li>";
    		if ($lastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $lastpage; $counter++)
    			{
    				if ($counter == $page)
    					$pagination.= "<li><a class='current'>$counter</a></li>";
    				else
    					$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    			}
    		}
    		elseif($lastpage > 5 + ($adjacents * 2))
    		{
    			if($page < 1 + ($adjacents * 2))		
    			{
    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'>...</li>";
    				$pagination.= "<li><a href='{$url}page=$lpm1'>$lpm1</a></li>";
    				$pagination.= "<li><a href='{$url}page=$lastpage'>$lastpage</a></li>";		
    			}
    			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
    				$pagination.= "<li class='dot'>...</li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'>..</li>";
    				$pagination.= "<li><a href='{$url}page=$lpm1'>$lpm1</a></li>";
    				$pagination.= "<li><a href='{$url}page=$lastpage'>$lastpage</a></li>";		
    			}
    			else
    			{
    				$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
    				$pagination.= "<li class='dot'>..</li>";
    				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$pagination.= "<li><a href='{$url}page=$next'>Next</a></li>";
                $pagination.= "<li><a href='{$url}page=$lastpage'>Last</a></li>";
    		}else{
    			$pagination.= "<li><a class='current'>Next</a></li>";
                $pagination.= "<li><a class='current'>Last</a></li>";
            }
    		$pagination.= "</ul>\n";		
    	}
    
    
        return $pagination;
    } 
	 /*************Pagintaion function****************/
	 
	 
	 
	 
	 
/*---------------------------------------------------------------------------------------------------------------------------------------------------------*/
} // end of class 

$objSolarModel = new solarModel(); 
$config  = $objSolarModel->getSetting();
?>
