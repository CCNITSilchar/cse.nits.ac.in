<?php
/*
Plugin Name: Spider FAQ
Plugin URI: http://web-dorado.com/products/wordpress-faq-plugin.html
Description: The Spider WordPress FAQ plugin is for creating an FAQ (Frequently Asked Questions) section for your website. Spider FAQ allows you to provide the users with a well-designed and informative FAQ section, which can facilitate you in managing various user inquiries by significantly decreasing their amount.
Version: 1.2
Author: http://web-dorado.com/
License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*/

add_action('wp_ajax_wpusers', 'wp_users');
add_action('wp_ajax_wp_like', 'wp_like');
add_action('wp_ajax_nopriv_wp_like','wp_like');
add_action('wp_ajax_wp_unlike', 'wp_unlike');
add_action('wp_ajax_nopriv_wp_unlike','wp_unlike');
add_action('wp_ajax_wp_hits', 'wp_hits');
add_action('wp_ajax_nopriv_wp_hits','wp_hits');
add_action('wp_ajax_wp_post_like','wp_post_like');
add_action('wp_ajax_nopriv_wp_post_like','wp_post_like');
add_action('wp_ajax_wp_post_unlike','wp_post_unlike');
add_action('wp_ajax_nopriv_wp_post_unlike','wp_post_unlike');
add_action('wp_ajax_wp_post_hits', 'wp_post_hits');
add_action('wp_ajax_nopriv_wp_post_hits','wp_post_hits');
add_action('wp_ajax_wp_expand_hits', 'wp_expand_hits');
add_action('wp_ajax_nopriv_wp_expand_hits','wp_expand_hits');
add_action('wp_ajax_wp_expand_post_hits', 'wp_expand_post_hits');
add_action('wp_ajax_nopriv_wp_expand_post_hits','wp_expand_post_hits');
add_action('wp_loaded','boot_session');


function boot_session() {
  if (!isset($_SESSION)) {
	session_start();
  }
}


function wp_expand_post_hits()
{  if (!isset($_SESSION)) {session_start();}
global $wpdb;
$or=" or";
$position="";
$i=0;
$request=esc_html($_REQUEST['faq_post_id']);
$post_tiv=esc_html($_REQUEST['post_tiv']);
$faq=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_faq  WHERE id='%d'",$request));
$categories=$faq->standcategory;
$category= explode(',', $categories);

if(!isset($_SESSION['expand_post_hits_valid_user'.$faq->id]))
{
for($i=1;$i<=count($category)-2;$i++)
 {
    $args = array(
	'posts_per_page'   => 100000000,
	'category'         => $category[$i]
	              );
	 $posts_array = get_posts( $args );
	 if (count($posts_array)!=0)
	 {
	   foreach($posts_array as $posts)
   {
		$true_false=0;    
        $post_id=$posts->ID;
          
 
  $post_right_contents=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."post_right_content ");
 foreach($post_right_contents as $post_right_content)
 {if($post_right_content->id==$post_id)$true_false=1;}
 if($true_false==0)
{
if($post_tiv==1)
              {
 $wpdb->insert( $wpdb->prefix . "post_right_content", 
    array( 'id' => $post_id,
		  'like' => 0,
          'unlike' => 0,
		  'hits' => 0),  
    array( '%d', '%d','%d','%d' )
              );
			  }
}
//$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'bwg_theme WHERE default_theme="%d"', 1));
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."post_right_content  WHERE id='%d'",$post_id ));
$hit=$rows->hits;
if(!isset($_SESSION['post_hits_valid_user'.$post_id]))
{
if($post_tiv==1)
              {$hit=$rows->hits+1;}
$wpdb->update( 
    $wpdb->prefix . "post_right_content",   
    array( 'hits' => $hit ),
    array( 'id' =>$post_id ),  
    array( '%d' ),  
    array( '%d' ) );
	}			
			$position=$position.$post_id.",".$hit.".";
	}				
    }	
  }
  if($post_tiv==1)
              {$_SESSION['expand_post_hits_valid_user'.$faq->id]=1;}
  }
else{
  for($i=1;$i<=count($category)-2;$i++)
 {
    $args = array(
	'posts_per_page'   => 100000000,
	'category'         => $category[$i]
	              );
	 $posts_array = get_posts( $args );
	 if (count($posts_array)!=0)
	 {
	   foreach($posts_array as $posts)
   {
		$true_false=0;    
        $post_id=$posts->ID;
          
 
  $post_right_contents=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."post_right_content ");
 foreach($post_right_contents as $post_right_content)
 {if($post_right_content->id==$post_id)$true_false=1;}
 if($true_false==0)
{
 $wpdb->insert( $wpdb->prefix . "post_right_content", 
    array( 'id' => $post_id,
		  'like' => 0,
          'unlike' => 0,
		  'hits' => 0),  
    array( '%d', '%d','%d','%d' )
              );
}
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."post_right_content  WHERE id='%d'",$post_id));

$hit=$rows->hits;			
			$position=$position.$post_id.",".$hit.".";
			}				
     }	
  }
  }
echo $position;
die();	
}
function wp_expand_hits()
{  if (!isset($_SESSION)) {session_start();}
global $wpdb;
$cat="";
$position="";
$or=" or";
$questions="";
$hits="";
$id="";
$request=esc_html($_REQUEST['faq_id']);
$tiv=esc_html($_REQUEST['tiv']);
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_faq  WHERE id='%d'",$request));
$categories=$rows->category;
$category= explode(',', $categories);
for($i=1;$i<=count($category)-2;$i++)
{if($i==count($category)-2)
$or="";
$position=$position." category=".$category[$i].$or;}
if($tiv==1)
{
if(!isset($_SESSION['expand_hits_valid_user'.$request]))
{
$questions = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."spider_faq_question WHERE ".$position ) ;
foreach($questions as $question)
{
if(!isset($_SESSION['hits_valid_user'.$question->id]))
{
$q_id=$question->id;
$hit=$question->hits+1;
$wpdb->update( 
    $wpdb->prefix . "spider_faq_question",   
    array( 'hits' => $hit ),
    array( 'id' =>$q_id ),  
    array( '%d' ),  
    array( '%d' ) );
	}	
}

$questions = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."spider_faq_question WHERE ".$position) ;
$_SESSION['expand_hits_valid_user'.$request]=1;
}
}
$questions = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."spider_faq_question WHERE ".$position) ;

foreach($questions as $question)
$hits=$hits.$question->id.",".$question->hits.".";
echo $hits;
die();	
}

function wp_hits()
{  if (!isset($_SESSION)) {session_start();}
global $wpdb;
$request=esc_html($_REQUEST['hits']);
$faq_hit_id=esc_html($_REQUEST['faq_hit_id']);
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_question  WHERE id='%d'",$request));
if(!isset($_SESSION['hits_valid_user'.$request]) && !isset($_SESSION['expand_hits_valid_user'.$faq_hit_id]))
{
$hit=$rows->hits+1;
$wpdb->update( 
    $wpdb->prefix . "spider_faq_question",   
    array( 'hits' => $hit ),
    array( 'id' =>$request ),  
    array( '%d' ),  
    array( '%d' ) );
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_question  WHERE id='%d'",$request));
$_SESSION['hits_valid_user'.$request]=1;
}
$edit_hit=$rows->hits;
echo "Hits: ".$edit_hit;
 die();	
}
function wp_post_hits()
{  if (!isset($_SESSION)) {session_start();}
global $wpdb;
$request=esc_html($_REQUEST['post_hits']);
$faq_hit_id=esc_html($_REQUEST['post_faq_id']);
$true_false=0;
 $post_right_contents=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."post_right_content ");
 foreach($post_right_contents as $post_right_content)
 {if($post_right_content->id==$request)$true_false=$true_false+1;}
 if($true_false==0)
{

 $wpdb->insert( $wpdb->prefix . "post_right_content", 
    array( 'id' => $request,
		  'like' => 0,
          'unlike' => 0,
		  'hits' => 0),  
    array( '%d', '%d','%d','%d' )
              );
}
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."post_right_content  WHERE id='%d'",$request));
if(!isset($_SESSION['post_hits_valid_user'.$request]) && !isset($_SESSION['expand_post_hits_valid_user'.$faq_hit_id]))
{
$hit=$rows->hits+1;
$wpdb->update( 
    $wpdb->prefix . "post_right_content",   
    array( 'hits' => $hit ),
    array( 'id' =>$request ),  
    array( '%d' ,  
     '%d' ) );
	$_SESSION['post_hits_valid_user'.$request]=1;
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."post_right_content  WHERE id='%d'",$request));
}
$edit_hit=$rows->hits;
echo "Hits: ".$edit_hit;
 die();	
}
function wp_post_like ()
{global $wpdb;
$theme_id=esc_html($_REQUEST['pltheme_id']);
$ikon_color=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_theme  WHERE id='%d'",$theme_id));
   if (!isset($_SESSION)) {session_start();}
$request=esc_html($_REQUEST['post_like']);

if(!isset($_SESSION['post_valid_user'.$request]))
 {

$like=$request;
$faq_id=esc_html($_REQUEST['post_show_hits']);
$faq_show_hits=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_faq  WHERE id='%d'",$faq_id)); 
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM  ".$wpdb->prefix."posts as A LEFT JOIN  ".$wpdb->prefix."post_right_content as B ON A.ID = B.id LEFT JOIN  ".$wpdb->prefix."users as C ON A.post_author = C.ID WHERE A.ID='%d'",$like));
if($ikon_color->ikncol==0){ $imgunlike='<img onclick="post_unlike('.$like.','.$faq_id.','.$theme_id.')" class="unlike_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_black.png">';
$imglike='<img onclick="post_like('.$like.','.$faq_id.','.$theme_id.')"  class="like_img"   src="'.plugins_url( '',__FILE__).'/upload/ikon/like_black.png">';}
 else { $imgunlike='<img onclick="post_unlike('.$like.','.$faq_id.','.$theme_id.')" class="unlike_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_white.png">';
  $imglike='<img onclick="post_like('.$like.','.$faq_id.','.$theme_id.')"  class="like_img"   src="'.plugins_url( '',__FILE__).'/upload/ikon/like_white.png">';}
 
 $true_false=0;
 $post_right_contents=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."post_right_content ");
 foreach($post_right_contents as $post_right_content)
 {if($post_right_content->id==$like)$true_false=$true_false+1;}
 if($true_false==0)
{

 $wpdb->insert( $wpdb->prefix . "post_right_content", 
    array( 'id' => $like,
		  'like' => 0,
          'unlike' => 0,
		  'hits' => 0),  
    array( '%d', '%d','%d','%d' )
              );
}
$likespan='<span class="sentences" style="width:50%;float:none;display:table-cell;" >Thank you for voting!</span>';
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM  ".$wpdb->prefix."posts as A LEFT JOIN  ".$wpdb->prefix."post_right_content as B ON A.ID = B.id LEFT JOIN  ".$wpdb->prefix."users as C ON A.post_author = C.ID WHERE A.ID='%d'",$like));
 $li_ke=$rows->like+1;
 $wpdb->update( 
    $wpdb->prefix . "post_right_content",   
    array( 'like' => $li_ke ),
    array( 'id' =>$like ),  
    array( '%d' ),  
    array( '%d' ) ) ; 
 $rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM  ".$wpdb->prefix."posts as A LEFT JOIN  ".$wpdb->prefix."post_right_content as B ON A.ID = B.id LEFT JOIN  ".$wpdb->prefix."users as C ON A.post_author = C.ID WHERE A.ID='%d'",$like));
 $inc_like=$li_ke;
 $unlike=$rows->unlike;
if($faq_show_hits->hits==1)
{$hits=$rows->hits;$hits_expression='Hits: ';$hitsspan='<br><span id="post_hits'.$like.'" style="margin-right:10px;float:right" >'.$hits_expression.$hits.'</span>';}else{$hitsspan="";}
 $like_hits_div=''.$likespan.'<span class="like_hits_span" style="width:50%;float:none;display:table-cell;"  ><span><span class="likeimg" >'.$imglike.$inc_like.'</span><span>'.$imgunlike.$unlike.'</span></span>'.$hitsspan.'</span>';
 $_SESSION['post_valid_user'.$like]=1;
}

elseif($_SESSION['post_valid_user'.$request]==1)
{
$like=$request;
$faq_id=esc_html($_REQUEST['post_show_hits']);
$faq_show_hits=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_faq  WHERE id='%d'",$faq_id));
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM  ".$wpdb->prefix."posts as A LEFT JOIN  ".$wpdb->prefix."post_right_content as B ON A.ID = B.id LEFT JOIN  ".$wpdb->prefix."users as C ON A.post_author = C.ID WHERE A.ID='%d'",$like));

$unlike=$rows->unlike;
if($faq_show_hits->hits==1)
{$hits=$rows->hits;$hits_expression='Hits: ';$hitsspan='<br><span id="post_hits'.$like.'" style="margin-right:10px;float:right;" >'.$hits_expression.$hits.'</span>';}else{$hitsspan="";}
if($ikon_color->ikncol==0){ $imgunlike='<img onclick="post_unlike('.$like.','.$faq_id.','.$theme_id.')" class="unlike_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_black.png">';
$imglike='<img onclick="post_like('.$like.','.$faq_id.','.$theme_id.')"  class="like_img"   src="'.plugins_url( '',__FILE__).'/upload/ikon/like_black.png">';}
 else { $imgunlike='<img onclick="post_unlike('.$like.','.$faq_id.','.$theme_id.')" class="unlike_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_white.png">';
  $imglike='<img onclick="post_like('.$like.','.$faq_id.','.$theme_id.')"  class="like_img"   src="'.plugins_url( '',__FILE__).'/upload/ikon/like_white.png">';}
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM  ".$wpdb->prefix."posts as A LEFT JOIN  ".$wpdb->prefix."post_right_content as B ON A.ID = B.id LEFT JOIN  ".$wpdb->prefix."users as C ON A.post_author = C.ID WHERE A.ID='%d'",$like));

$likespan='<span class="sentences" style="width:50%;float:none;display:table-cell;" >You already voted for this FAQ today!</span>';
 $inc_like=$rows->like ;
 $like_hits_div=''.$likespan.'<span class="like_hits_span" style="width:50%;float:none;display:table-cell;" ><span><span class="likeimg" >'.$imglike.$inc_like.'</span><span>'.$imgunlike.$unlike.'</span></span>'.$hitsspan.'</span>';
 }
 echo $like_hits_div;
 die();
}
function wp_post_unlike()
{  if (!isset($_SESSION)) {session_start();}
global $wpdb;
$theme_id=esc_html($_REQUEST['punltheme_id']);
$ikon_color=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_theme  WHERE id='%d'",$theme_id)); 
$request=esc_html($_REQUEST['post_like']);

if(!isset($_SESSION['post_valid_user'.$request]))
 {

$like=$request; 
$faq_id=esc_html($_REQUEST['post_show_hits']);
$faq_show_hits=$wpdb->get_row("SELECT * FROM ".$wpdb->prefix."spider_faq_faq  WHERE id='".$faq_id."' ");
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM  ".$wpdb->prefix."posts as A LEFT JOIN  ".$wpdb->prefix."post_right_content as B ON A.ID = B.id LEFT JOIN  ".$wpdb->prefix."users as C ON A.post_author = C.ID WHERE A.ID='%d'",$like));
if($ikon_color->ikncol==0){ $imgunlike='<img onclick="post_unlike('.$like.','.$faq_id.','.$theme_id.')" class="unlike_img" " src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_black.png">';
$imglike='<img onclick="post_like('.$like.','.$faq_id.','.$theme_id.')"  class="like_img"   src="'.plugins_url( '',__FILE__).'/upload/ikon/like_black.png">';}
 else { $imgunlike='<img onclick="post_unlike('.$like.','.$faq_id.','.$theme_id.')" class="unlike_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_white.png">';
  $imglike='<img onclick="post_like('.$like.','.$faq_id.','.$theme_id.')"  class="like_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/like_white.png">';} 
 
 $true_false=0;
 $post_right_contents=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."post_right_content ");
 foreach($post_right_contents as $post_right_content)
 {if($post_right_content->id==$like)$true_false=$true_false+1;}
 if($true_false==0)
{

 $wpdb->insert( $wpdb->prefix . "post_right_content", 
    array( 'id' => $like,
		  'like' => 0,
          'unlike' => 0,
		  'hits' => 0),  
    array( '%d', '%d','%d','%d' )
              );
}
$likespan='<span class="sentences" style="width:50%;float:none;display:table-cell;" >Thank you for voting!</span>';
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM  ".$wpdb->prefix."posts as A LEFT JOIN  ".$wpdb->prefix."post_right_content as B ON A.ID = B.id LEFT JOIN  ".$wpdb->prefix."users as C ON A.post_author = C.ID WHERE A.ID='%d'",$like));
 $li_ke=$rows->unlike+1;
 $wpdb->update( 
    $wpdb->prefix . "post_right_content",   
    array( 'unlike' => $li_ke ),
    array( 'id' =>$like ),  
    array( '%d' ),  
    array( '%d' ) ) ; 
 $rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM  ".$wpdb->prefix."posts as A LEFT JOIN  ".$wpdb->prefix."post_right_content as B ON A.ID = B.id LEFT JOIN  ".$wpdb->prefix."users as C ON A.post_author = C.ID WHERE A.ID='%d'",$like));
 $inc_unlike=$li_ke;
 $inc_like=$rows->like;
if($faq_show_hits->hits==1)
{$hits=$rows->hits;$hits_expression='Hits: ';$hitsspan='<br><span id="post_hits'.$like.'" style="margin-right:10px;float:right;" >'.$hits_expression.$hits.'</span>';}else{$hitsspan="";}
 $like_hits_div=''.$likespan.'<span class="like_hits_span" style="width:50%;float:none;display:table-cell;" ><span><span class="likeimg" >'.$imglike.$inc_like.'</span><span>'.$imgunlike.$inc_unlike.'</span></span>'.$hitsspan.'</span>';
 $_SESSION['post_valid_user'.$like]=1;
}

elseif($_SESSION['post_valid_user'.$request]==1)
{
$like=$request;
$faq_id=esc_html($_REQUEST['post_show_hits']);
$faq_show_hits=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_faq  WHERE id='%d'",$faq_id));
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM  ".$wpdb->prefix."posts as A LEFT JOIN  ".$wpdb->prefix."post_right_content as B ON A.ID = B.id LEFT JOIN  ".$wpdb->prefix."users as C ON A.post_author = C.ID WHERE A.ID='%d'",$like));

$inc_like=$rows->like;
if($faq_show_hits->hits==1)
{$hits=$rows->hits;$hits_expression='Hits: ';$hitsspan='<br><span id="post_hits'.$like.'" style="margin-right:10px;float:right;" >'.$hits_expression.$hits.'</span>';}else{$hitsspan="";}
if($ikon_color->ikncol==0){ $imgunlike='<img onclick="post_unlike('.$like.','.$faq_id.','.$theme_id.')" class="unlike_img" src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_black.png">';
$imglike='<img onclick="post_like('.$like.','.$faq_id.','.$theme_id.')" class="like_img"   src="'.plugins_url( '',__FILE__).'/upload/ikon/like_black.png">';}
 else { $imgunlike='<img onclick="post_unlike('.$like.','.$faq_id.','.$theme_id.')" class="unlike_img"   src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_white.png">';
  $imglike='<img onclick="post_like('.$like.','.$faq_id.','.$theme_id.')" class="like_img"   src="'.plugins_url( '',__FILE__).'/upload/ikon/like_white.png">';}
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM  ".$wpdb->prefix."posts as A LEFT JOIN  ".$wpdb->prefix."post_right_content as B ON A.ID = B.id LEFT JOIN  ".$wpdb->prefix."users as C ON A.post_author = C.ID WHERE A.ID='%d'",$like));

$likespan='<span class="sentences" style="width:50%;float:none;display:table-cell;" >You already voted for this FAQ today!</span>';
 $inc_unlike=$rows->unlike ;
 $like_hits_div=''.$likespan.'<span class="like_hits_span" style="width:50%;float:none;display:table-cell;" ><span><span class="likeimg" >'.$imglike.$inc_like.'</span><span>'.$imgunlike.$inc_unlike.'</span></span>'.$hitsspan.'</span>';
 }
 echo $like_hits_div;
 die();
}
function wp_like ()
{   if (!isset($_SESSION)) {session_start();}
global $wpdb;
$request=esc_html($_REQUEST['like']);
$theme_id=esc_html($_REQUEST['ltheme_id']);
$ikon_color=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_theme  WHERE id='%d'",$theme_id));
if(!isset($_SESSION['valid_user'.$request]))
 {
$like=$request;
$faq_id=esc_html($_REQUEST['show_hits']);
$faq_show_hits=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_faq  WHERE id='%d'",$faq_id));
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_question  WHERE id='%d'",$like));
$unlike=$rows->unlike;
if($faq_show_hits->hits==1)
{$hits=$rows->hits;$hits_expression='Hits: ';$hitsspan='<br><span id="hits'.$rows->id.'" style="margin-right:10px;float:right;" >'.$hits_expression.$hits.'</span>';}else{$hitsspan="";}
if($ikon_color->ikncol==0){ $imgunlike='<img onclick="unlike('.$rows->id.','.$faq_id.','.$theme_id.')" class="unlike_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_black.png">';
$imglike='<img onclick="like('.$rows->id.','.$faq_id.','.$theme_id.')"  class="like_img"   src="'.plugins_url( '',__FILE__).'/upload/ikon/like_black.png">';}
 else { $imgunlike='<img onclick="unlike('.$rows->id.','.$faq_id.','.$theme_id.')" class="unlike_img" src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_white.png">';
  $imglike='<img onclick="like('.$rows->id.','.$faq_id.','.$theme_id.')"  class="like_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/like_white.png">';}
 $rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_question  WHERE id='%d'",$like));
$likespan='<span class="sentences" style="width:50%;float:none;display:table-cell;" >Thank you for voting!</span>';
 $li_ke=$rows->like+1;
  
 $wpdb->update( 
    $wpdb->prefix . "spider_faq_question",   
    array( 'like' => $li_ke ),
    array( 'id' =>$like ),  
    array( '%d' ),  
    array( '%d' ) ) ; 
 $rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_question  WHERE id='%d'",$like)); 
 $inc_like=$rows->like ;
                                                                                          
$like_hits_div=''.$likespan.'<span class="like_hits_span" style="width:50%;float:none;display:table-cell;" ><span><span class="likeimg" >'.$imglike.$inc_like.'</span><span>'.$imgunlike.$unlike.'</span></span>'.$hitsspan.'</span>';
 $_SESSION['valid_user'.$like]=1;
}

elseif($_SESSION['valid_user'.$request]==1)
{
$like=$request;
$faq_id=esc_html($_REQUEST['show_hits']);
$faq_show_hits=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_faq  WHERE id='%d'",$faq_id));
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_question  WHERE id='%d'",$like));
$unlike=$rows->unlike;
if($faq_show_hits->hits==1)
{$hits=$rows->hits;$hits_expression='Hits: ';$hitsspan='<br><span id="hits'.$rows->id.'" style="margin-right:10px;float:right;" >'.$hits_expression.$hits.'</span>';}else{$hitsspan="";}
if($ikon_color->ikncol==0){$imgunlike='<img onclick="unlike('.$rows->id.','.$faq_id.','.$theme_id.')" class="unlike_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_black.png">';
$imglike='<img onclick="like('.$rows->id.','.$faq_id.','.$theme_id.')"  class="like_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/like_black.png">';}
 else { $imgunlike='<img onclick="unlike('.$rows->id.','.$faq_id.','.$theme_id.')" class="unlike_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_white.png">';
  $imglike='<img onclick="like('.$rows->id.','.$faq_id.','.$theme_id.')"  class="like_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/like_white.png">';}
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_question  WHERE id='%d'",$like)); 

$likespan='<span class="sentences" style="width:50%;float:none;display:table-cell;" >You already voted for this FAQ today!</span>';

 $inc_like=$rows->like ;
 $like_hits_div=''.$likespan.'<span class="like_hits_span" style="width:50%;float:none;display:table-cell;" ><span><span class="likeimg" >'.$imglike.$inc_like.'</span><span>'.$imgunlike.$unlike.'</span></span>'.$hitsspan.'</span>';
 }
 echo $like_hits_div;
 die();
}

function wp_unlike ()
{   if (!isset($_SESSION)) {session_start();}
global $wpdb;
$request=esc_html($_REQUEST['unlike']);
$theme_id=esc_html($_REQUEST['unltheme_id']);
$ikon_color=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_theme  WHERE id='%d'",$theme_id));
if(!isset($_SESSION['valid_user'.$request]))
 { 
$like=$request;
$faq_id=esc_html($_REQUEST['show_hits']);
$faq_show_hits=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_faq  WHERE id='%d'",$faq_id));
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_question  WHERE id='%d'",$like));
$like=$rows->like;
if($faq_show_hits->hits==1)
{$hits=$rows->hits;$hits_expression='Hits: ';$hitsspan='<br><span id="hits'.$rows->id.'" style="margin-right:10px;float:right;" >'.$hits_expression.$hits.'</span>';}else{$hitsspan="";}
 if($ikon_color->ikncol==0){$imgunlike='<img onclick="unlike('.$rows->id.','.$faq_id.','.$theme_id.')" class="unlike_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_black.png">';
$imglike='<img onclick="like('.$rows->id.','.$faq_id.','.$theme_id.')"  class="like_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/like_black.png">';}
 else { $imgunlike='<img onclick="unlike('.$rows->id.','.$faq_id.','.$theme_id.')" class="unlike_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_white.png">';
  $imglike='<img onclick="like('.$rows->id.','.$faq_id.','.$theme_id.')" class="like_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/like_white.png">';}
 $like=$request;
 $likespan='<span class="sentences" style="width:50%;float:none;display:table-cell;" >Thank you for voting!</span>';
 $rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_question  WHERE id='%d'",$like));

 $li_ke=$rows->unlike+1;
  
 $wpdb->update( 
    $wpdb->prefix . "spider_faq_question",   
    array( 'unlike' => $li_ke ),
    array( 'id' =>$like ),  
    array( '%d' ),  
    array( '%d' ) ) ; 
 $rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_question  WHERE id='%d'",$like)); 
 $inc_unlike=$rows->unlike ;
 $inc_like=$rows->like ;
 $like_hits_div=''.$likespan.'<span class="like_hits_span" style="width:50%;float:none;display:table-cell;" ><span><span class="likeimg" >'.$imglike.$inc_like.'</span><span>'.$imgunlike.$inc_unlike.'</span></span>'.$hitsspan.'</span>';

 $_SESSION['valid_user'.$like]=1;
}

elseif($_SESSION['valid_user'.$request]==1)
{
 $like=$request;
$faq_id=esc_html($_REQUEST['show_hits']);
$faq_show_hits=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_faq  WHERE id='%d'",$faq_id));
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_question  WHERE id='%d'",$like));
$like=$rows->like;
if($faq_show_hits->hits==1)
{$hits=$rows->hits;$hits_expression='Hits: ';$hitsspan='<br><span id="hits'.$rows->id.'" style="margin-right:10px;float:right;" >'.$hits_expression.$hits.'</span>';}else{$hitsspan="";}
 if($ikon_color->ikncol==0){$imgunlike='<img onclick="unlike('.$rows->id.','.$faq_id.','.$theme_id.')" class="unlike_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_black.png">';
$imglike='<img onclick="like('.$rows->id.','.$faq_id.','.$theme_id.')"  class="like_img"   src="'.plugins_url( '',__FILE__).'/upload/ikon/like_black.png">';}
 else { $imgunlike='<img onclick="unlike('.$rows->id.','.$faq_id.','.$theme_id.')" class="unlike_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_white.png">';
  $imglike='<img onclick="like('.$rows->id.','.$faq_id.','.$theme_id.')"  class="like_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/like_white.png">';}
 $like=$request;
 
$rows=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_question  WHERE id='%d'",$like)); 
 $inc_unlike=$rows->unlike ;
  $inc_like=$rows->like ;
 $likespan='<span class="sentences" style="width:50%;float:none;display:table-cell;" >You already voted for this FAQ today!</span>';
 $like_hits_div=''.$likespan.'<span class="like_hits_span" style="width:50%;float:none;display:table-cell;" ><span><span class="likeimg" >'.$imglike.$inc_like.'</span><span>'.$imgunlike.$inc_unlike.'</span></span>'.$hitsspan.'</span>';

}
 echo $like_hits_div;
 die();
}

function wp_users()
{global $wpdb;
$faq_wp_user="";
$filter_search='';

if(!isset($_POST["filter_search"])or esc_html($_POST["filter_search"])=="" && !isset($_POST["filter_group"]) or esc_html($_POST["filter_group"])=="")

    {    
 if(isset($_POST["order_column"]) &&  esc_html($_POST["order_column"])=='name')
    {
	if (esc_html($_POST["order_asc_desc"])=='ASC')$orderby=" ASC"; if(esc_html($_POST["order_asc_desc"])=="DESC") $orderby=" DESC";     
		 $faq_wp_users=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities'  ORDER BY display_name ".$orderby." ");   
    }        
if(isset($_POST["order_column"]) && esc_html($_POST["order_column"])=="username" )
    { 
	if (esc_html($_POST["order_asc_desc"])=='ASC')$orderby=" ASC"; if(esc_html($_POST["order_asc_desc"])=="DESC") $orderby=" DESC";     
		 $faq_wp_users=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities'  ORDER BY user_nicename ".$orderby." "); 	
	}
if(isset($_POST["order_column"]) && esc_html($_POST["order_column"])=="groups" )
    {	if (esc_html($_POST["order_asc_desc"])=='ASC')$orderby=" ASC"; if(esc_html($_POST["order_asc_desc"])=="DESC") $orderby=" DESC";   

		 $faq_wp_users=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities'  ORDER BY meta_value ".$orderby." "); 	
	}
if( !isset($_POST["order_column"]) or esc_html($_POST["order_column"])==""  )
   {
    $faq_wp_users=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities'  ORDER BY ID "); 	
   }
   }  

if(isset($_POST["filter_search"])&& esc_html($_POST["filter_search"])!="")
{
$filter_search=$_POST["filter_search"];  
 if(isset($_POST["order_column"]) &&  esc_html($_POST["order_column"])=='name')
    {if (esc_html($_POST["order_asc_desc"])=='ASC')$orderby=" ASC"; if(esc_html($_POST["order_asc_desc"])=="DESC") $orderby=" DESC";	    
		 $faq_wp_users=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities' AND A.display_name LIKE '%".$filter_search."%' ORDER BY display_name ".$orderby." "); 	
    }        
if(isset($_POST["order_column"]) && esc_html($_POST["order_column"])=="username" )
    {if (esc_html($_POST["order_asc_desc"])=='ASC')$orderby=" ASC"; if(esc_html($_POST["order_asc_desc"])=="DESC") $orderby=" DESC";
		 $faq_wp_users=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities' AND A.display_name LIKE '%".$filter_search."%' ORDER BY user_nicename ".$orderby." "); 	
	}
if(isset($_POST["order_column"]) && esc_html($_POST["order_column"])=="groups" )
    {if (esc_html($_POST["order_asc_desc"])=='ASC')$orderby=" ASC"; if(esc_html($_POST["order_asc_desc"])=="DESC") $orderby=" DESC";
		 $faq_wp_users=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities' AND A.display_name LIKE '%".$filter_search."%' ORDER BY meta_value ".$orderby." "); 	
	}
if( !isset($_POST["order_column"]) or esc_html($_POST["order_column"])==""  )
   {
    $faq_wp_users=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities' AND A.display_name LIKE '%".$filter_search."%' ORDER BY ID "); 	
   }
}

if(isset($_POST["filter_group"])&& esc_html($_POST["filter_group"])!="")

  { $_POST["filter_group"]=stripslashes($_POST["filter_group"]);

   if($_POST["filter_group"]==2)
   {
   if(isset($_POST["order_column"]) &&  esc_html($_POST["order_column"])=='name')
    { if (esc_html($_POST["order_asc_desc"])=='ASC')$orderby=" ASC"; if(esc_html($_POST["order_asc_desc"])=="DESC") $orderby=" DESC";	    
         $faq_wp_users_filter_group=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities'   ORDER BY display_name ".$orderby."  ");	
    }        
 if(isset($_POST["order_column"]) && esc_html($_POST["order_column"])=="username" )
    {if (esc_html($_POST["order_asc_desc"])=='ASC')$orderby=" ASC"; if(esc_html($_POST["order_asc_desc"])=="DESC") $orderby=" DESC";
         $faq_wp_users_filter_group=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities'   ORDER BY user_nicename ".$orderby." ");
	}
 if(isset($_POST["order_column"]) && esc_html($_POST["order_column"])=="groups" )
    { if (esc_html($_POST["order_asc_desc"])=='ASC')$orderby=" ASC"; if(esc_html($_POST["order_asc_desc"])=="DESC") $orderby=" DESC";
         $faq_wp_users_filter_group=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities'   ORDER BY meta_value ".$orderby."  ");
	}
if(!isset($_POST["order_column"]) or esc_html($_POST["order_column"])==""  )
   {
    $faq_wp_users_filter_group=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities'   ORDER BY ID ");
   }  
   }
  else
  {
 if(isset($_POST["order_column"]) &&  esc_html($_POST["order_column"])=='name')
    {if (esc_html($_POST["order_asc_desc"])=='ASC')$orderby=" ASC"; if(esc_html($_POST["order_asc_desc"])=="DESC") $orderby=" DESC";	    
         $faq_wp_users_filter_group=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities' AND B.meta_value='".$_POST["filter_group"]."'  ORDER BY display_name ".$orderby."  ");	
    }        
 if(isset($_POST["order_column"]) && esc_html($_POST["order_column"])=="username" )
    {if (esc_html($_POST["order_asc_desc"])=='ASC')$orderby=" ASC"; if(esc_html($_POST["order_asc_desc"])=="DESC") $orderby=" DESC";
         $faq_wp_users_filter_group=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities' AND B.meta_value='".$_POST["filter_group"]."'  ORDER BY user_nicename ".$orderby."  ");
	}
 if(isset($_POST["order_column"]) && esc_html($_POST["order_column"])=="groups" )
    {if (esc_html($_POST["order_asc_desc"])=='ASC')$orderby=" ASC"; if(esc_html($_POST["order_asc_desc"])=="DESC") $orderby=" DESC";
         $faq_wp_users_filter_group=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities' AND B.meta_value='".$_POST["filter_group"]."'  ORDER BY meta_value  ".$orderby." ");
	}
if(!isset($_POST["order_column"]) or esc_html($_POST["order_column"])==""  )
   {
    $faq_wp_users_filter_group=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities' AND B.meta_value='".$_POST["filter_group"]."'  ORDER BY ID ");
   }
   }
  }
  if(isset($_POST["filter_group"]) && esc_html($_POST["filter_group"])!="" && isset($_POST["filter_search"])&& esc_html($_POST["filter_search"])!="")
  
  {
   if(esc_html($_POST["filter_group"])==2)
   {
   
   if(isset($_POST["order_column"]) &&  esc_html($_POST["order_column"])=='name')
    {if (esc_html($_POST["order_asc_desc"])=='ASC')$orderby=" ASC"; if(esc_html($_POST["order_asc_desc"])=="DESC") $orderby=" DESC";	    
         $faq_wp_users_filter_group=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities'  AND A.display_name LIKE '%".$filter_search."%'  ORDER BY display_name ".$orderby."  ");	
    }
  if(isset($_POST["order_column"]) && esc_html($_POST["order_column"])=="username" )
    {if (esc_html($_POST["order_asc_desc"])=='ASC')$orderby=" ASC"; if(esc_html($_POST["order_asc_desc"])=="DESC") $orderby=" DESC";
         $faq_wp_users_filter_group=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities'  AND A.display_name LIKE '%".$filter_search."%'  ORDER BY user_nicename ".$orderby."  ");
	}
 if(isset($_POST["order_column"]) && esc_html($_POST["order_column"])=="groups" )
    {if (esc_html($_POST["order_asc_desc"])=='ASC')$orderby=" ASC"; if(esc_html($_POST["order_asc_desc"])=="DESC") $orderby=" DESC";
         $faq_wp_users_filter_group=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities'  AND A.display_name LIKE '%".$filter_search."%'  ORDER BY meta_value ".$orderby."  ");
	}
if(!isset($_POST["order_column"]) or esc_html($_POST["order_column"])=="" )
   {
          $faq_wp_users_filter_group=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities'  AND A.display_name LIKE '%".$filter_search."%'  ORDER BY ID ");
   }
   
   }
   
   else{
    if(isset($_POST["order_column"]) &&  esc_html($_POST["order_column"])=='name')
    { if (esc_html($_POST["order_asc_desc"])=='ASC')$orderby=" ASC"; if(esc_html($_POST["order_asc_desc"])=="DESC") $orderby=" DESC";	    
         $faq_wp_users_filter_group=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities' AND B.meta_value='".$_POST["filter_group"]."' AND A.display_name LIKE '%".$filter_search."%'  ORDER BY display_name  ".$orderby."  ");	
    }
  if(isset($_POST["order_column"]) && esc_html($_POST["order_column"])=="username" )
    { if (esc_html($_POST["order_asc_desc"])=='ASC')$orderby=" ASC"; if(esc_html($_POST["order_asc_desc"])=="DESC") $orderby=" DESC";
         $faq_wp_users_filter_group=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities' AND B.meta_value='".$_POST["filter_group"]."' AND A.display_name LIKE '%".$filter_search."%'  ORDER BY user_nicename  ".$orderby."  ");
	}
 if(isset($_POST["order_column"]) && esc_html($_POST["order_column"])=="groups" )
    { if (esc_html($_POST["order_asc_desc"])=='ASC')$orderby=" ASC"; if(esc_html($_POST["order_asc_desc"])=="DESC") $orderby=" DESC";
         $faq_wp_users_filter_group=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities' AND B.meta_value='".$_POST["filter_group"]."' AND A.display_name LIKE '%".$filter_search."%'  ORDER BY meta_value ".$orderby."   ");
	}
if(!isset($_POST["order_column"]) or esc_html($_POST["order_column"])=="" )
   {
          $faq_wp_users_filter_group=$wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."users as A LEFT JOIN  ".$wpdb->prefix."usermeta as B ON A.ID = B.user_id WHERE B.meta_key ='".$wpdb->prefix."capabilities' AND B.meta_value='".$_POST["filter_group"]."' AND A.display_name LIKE '%".$filter_search."%'  ORDER BY ID ");
   }
   }
  }

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( '',__FILE__) ?>/js/template.css" >
<?php wp_print_scripts('jquery') ?>

</head>
<body class="contentpane">
<script>
function displayVals()
{
  var singleValues = jQuery( "#filter_group_id1" ).val();
   document.getElementById("name_group").value=singleValues;
   document.forms["adminForm"].submit();
}
 function clearsearch()
{
document.getElementById("filter_search").value="";
//document.forms["adminForm"].submit();
}
function order_by_name()
{

document.getElementById("order_column").value="name";
if(document.getElementById("order_asc_desc").value=="ASC")document.getElementById("order_asc_desc").value="DESC";
else document.getElementById("order_asc_desc").value="ASC";
document.forms["adminForm"].submit();
}
function order_by_user_name()
{
document.getElementById("order_column").value="username";
if(document.getElementById("order_asc_desc").value=="ASC")document.getElementById("order_asc_desc").value="DESC";
else document.getElementById("order_asc_desc").value="ASC";
document.forms["adminForm"].submit();
}
function order_by_groups()
{
document.getElementById("order_column").value="groups";
if(document.getElementById("order_asc_desc").value=="DESC")document.getElementById("order_asc_desc").value="ASC";
else document.getElementById("order_asc_desc").value="DESC";
document.forms["adminForm"].submit();
}

function  add_user(m)
{  
window.parent.document.getElementById("user_name").value=m;
window.parent.tb_remove();
}
</script>		
<div id="system-message-container">
</div>
		<form action="" method="post" name="adminForm" id="adminForm">
<fieldset class="filter">
	<div class="left">
			<input type="text" style="font-size: 15px;" name="filter_search" id="filter_search" value="<?php echo $filter_search?>" size="40" title="Search in name" />
			<button type="submit">Search</button>
			<button type="button" onclick="clearsearch()">Clear</button>
	</div>
		<div class="right">
			<ol>
				<li>
					<label for="filter_group_id">
						Filter User Group					</label>
					<select id="filter_group_id1" name="filter_group_id" onchange="displayVals()" >
						<option value="2" <?php  if(isset($_POST["filter_group"])&& $_POST["filter_group"]=='2') echo 'selected="selected"'; ?>  >Show All Groups </option>
						<option value='a:1:{s:10:"subscriber";b:1;}' <?php  if(isset($_POST["filter_group"])&& $_POST["filter_group"]=='a:1:{s:10:"subscriber";b:1;}') echo 'selected="selected"'; ?> >Subscriber</option>
						<option value='a:1:{s:13:"administrator";b:1;}'<?php  if(isset($_POST["filter_group"])&& $_POST["filter_group"]=='a:1:{s:13:"administrator";b:1;}') echo 'selected="selected"'; ?> >Administrator</option>
						<option value='a:1:{s:6:"editor";b:1;}'<?php  if(isset($_POST["filter_group"])&& $_POST["filter_group"]=='a:1:{s:6:"editor";b:1;}') echo 'selected="selected"'; ?> >Editor</option>
						<option value='a:1:{s:6:"author";b:1;}'<?php  if(isset($_POST["filter_group"])&& $_POST["filter_group"]=='a:1:{s:6:"author";b:1;}') echo 'selected="selected"'; ?> >Author</option>
						<option value='a:1:{s:11:"contributor";b:1;}'<?php  if(isset($_POST["filter_group"])&& $_POST["filter_group"]=='a:1:{s:11:"contributor";b:1;}') echo 'selected="selected"'; ?> >Contributor</option>
				    </select>
				</li>
			</ol>
		</div>
</fieldset>

	<table class="adminlist">
		<thead>
			<tr>
				<th class="left">
					<a href="#" onclick="order_by_name()" title="Click to sort by this column">Name<img id="sortimg"  <?php if( isset($_POST['order_column']) and esc_html($_POST["order_column"])=="name"){if(isset($_POST["order_asc_desc"])&& esc_html($_POST["order_asc_desc"])=="DESC" && esc_html($_POST["order_column"])=="name" ) {?> src="<?php echo plugins_url( '',__FILE__) ?>/images/sort_desc.png"  <?php } else{?> src="<?php echo plugins_url( '',__FILE__) ?>/images/sort_asc.png" <?php }} else echo 'src=""'?>  alt=""  /></a>				</th>
				<th class="nowrap" width="25%">
					<a href="#" onclick="order_by_user_name()" title="Click to sort by this column">User Name<img id="sortimg"  <?php if(isset($_POST['order_column']) and esc_html($_POST["order_column"])=="username"){if(isset($_POST["order_asc_desc"])&& esc_html($_POST["order_asc_desc"])=="DESC" && esc_html($_POST["order_column"])=="username") {?> src="<?php echo plugins_url( '',__FILE__) ?>/images/sort_desc.png"  <?php } else{?> src="<?php echo plugins_url( '',__FILE__) ?>/images/sort_asc.png" <?php }} else echo 'src=""'?> alt=""  /></a>				</th>
				<th class="nowrap" width="25%">
					<a href="#" onclick="order_by_groups()" title="Click to sort by this column">User Groups<img id="sortimg"  <?php if(isset($_POST['order_column']) and esc_html($_POST["order_column"])=="groups"){if(isset($_POST["order_asc_desc"])&& esc_html($_POST["order_asc_desc"])=="DESC" && esc_html($_POST["order_column"])=="groups") {?> src="<?php echo plugins_url( '',__FILE__) ?>/images/sort_desc.png"  <?php } else{?> src="<?php echo plugins_url( '',__FILE__) ?>/images/sort_asc.png" <?php }} else echo 'src=""'?> alt=""  /></a>				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="15">
					</td>
			</tr>
		</tfoot>
		<?php
		
		
		if(isset($_POST["filter_group"])&& esc_html($_POST["filter_group"])!=""  )
			{
		foreach($faq_wp_users_filter_group as $faq_wp_user_filter_group)
		{
		?>
		<tbody>
			<tr class="row0">
				<td>
					<a class="pointer" onclick="add_user('<?php echo $faq_wp_user_filter_group->display_name; ?>')" id="add_user"  >
					<?php echo $faq_wp_user_filter_group->display_name; ?>
					</a>
				</td>
				<td align="center">
		           <?php echo $faq_wp_user_filter_group->user_nicename;?>			
                </td>
				<td align="left">
		           <?php $pieces=$faq_wp_user_filter_group->meta_value;  $piec= explode('"', $pieces);  echo ucfirst($piec[1])  ;?>
			   </td>
		    </tr>
				
	   </tbody>
				
		
		<?php
           }
		   }
		   else
		   {
         foreach($faq_wp_users as $faq_wp_user)
       {
		?>
		
		<tbody>
			<tr class="row0">
				<td>
					<a class="pointer" onclick="add_user('<?php echo $faq_wp_user->display_name; ?>')" id="add_user" >
					<?php echo $faq_wp_user->display_name; ?>
					</a>
				</td>
				<td align="center">
		             <?php echo $faq_wp_user->user_nicename;?>			
                </td>
				<td align="left">
		             <?php $pieces=$faq_wp_user->meta_value;  $piec= explode('"', $pieces);  echo ucfirst($piec[1])  ; ?>
			    </td>
			</tr>				
	    </tbody>
				<?php
				}
				}
				?>
	</table>
	<div>
		<input type="hidden" id="name_group"  name="filter_group" value='<?php if(isset($_POST['filter_group'])) echo esc_html($_POST["filter_group"]);?>' />
		<input type="hidden" name="order_column"  id="order_column" value="<?php if(isset($_POST['order_column'])) echo esc_html($_POST['order_column']);  ?>" />
	    <input type="hidden" name="order_asc_desc"  id="order_asc_desc" value="<?php if(isset($_POST['order_asc_desc'])) echo esc_html($_POST['order_asc_desc']); else echo "asc"; ?>" />
    </div>
		</form>
	</body>
</html>
<?php
die();
}
$many_faqs=0;
add_action( 'init', 'FAQ_language_load' );

function FAQ_language_load() {
	 load_plugin_textdomain('faq', false, basename( dirname( __FILE__ ) ) . '/Languages' );	
}

function Spider_FAQ_shotrcode($atts)
 {
     extract(shortcode_atts(array(
	      'id' => 'no Spider FAQ'
     ), $atts)); 
	 
	 ob_start();
	 front_end_Spider_FAQ($id); 	 
	 return ob_get_clean();
}

add_shortcode('Spider_FAQ', 'Spider_FAQ_shotrcode');




 function   front_end_Spider_FAQ($id) {
    global $wpdb;  
	$all_faq_ids=$wpdb->get_col("SELECT id FROM ".$wpdb->prefix."spider_faq_faq");
	$b=false;
	foreach($all_faq_ids as $all_faq_id) {
	  if($all_faq_id==$id)
	  $b=true;
    }
	if(!$b)
	  return "";	
				
	$Spider_Faq_front_end="";

	$faq=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_faq WHERE id='%d'",$id));// var_dump($faq);
		
	$faq_ids=$wpdb->get_col("SELECT id FROM ".$wpdb->prefix."spider_faq_faq");
		
		
	$cats_id=explode(',',$faq->category);
	$cats_id= array_slice($cats_id,1, count($cats_id)-2); 
		
	foreach($cats_id as $id) {
	  $cats[]=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_category WHERE published='1' AND id='%d'",$id));
	
	}
	
	$standcats_id=explode(',',$faq->standcategory);
	$standcats_id= array_slice($standcats_id,1, count($standcats_id)-2); 
		
	foreach($standcats_id as $id) {
		$standcats[]=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."terms WHERE term_id='%d'",$id));	
	}	
	
	$s=0;
	if ($faq->standcat==0) {
	    if($cats) { 
			foreach($cats as $cat)  { 
                if($cat!= NULL) {			
					$rows1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_question WHERE published='1' AND category='%d' ORDER BY `ordering`",$cat->id));	
					$rows[$cat->id] = $rows1;
					$s+=count($rows[$cat->id]);	
				}
				else
				 $rows = NULL;
			}
		}
		$standcats = NULL;		
	}
	else{ 
		if($standcats) { //var_dump($standcats);
			foreach($standcats as $cat) {
				if($cat!=null) {			
				  $args = array(
				  'numberposts'     => 5000,
				  'offset'          => 0,
				  'category'        => $cat->term_id,
				  'post_type'       => 'post',
				  'post_status'     => 'publish' );
				  $rows[$cat->term_id] = get_posts($args);
				  $s+=count($rows[$cat->term_id]);	
				}
			}
		}
		$cats = NULL;
	}
	
	$stls=$wpdb->get_row("SELECT * FROM ".$wpdb->prefix."spider_faq_theme WHERE `default`=22");
	
		
	return front_end_faq ($rows,$cats,$standcats,$stls,$faq,$s);		
 }

	
	add_action( 'wp_enqueue_scripts', 'faq_add_my_stylesheet' );

    /**
     * Enqueue plugin style-file
     */
    function Spider_Faq_featured_plugins_styles() {
		  wp_enqueue_style('Featured_Plugins', plugins_url('elements/featured_plugins.css', __FILE__));
	}
	 
    function faq_add_my_stylesheet() {
        // Respects SSL, Style.css is relative to the current file
		
        wp_register_style( 'faq-style', plugins_url('elements/style.css', __FILE__) );
             wp_enqueue_style( 'faq-style' );
	
 wp_enqueue_script( 'jquery' );
 

		
		 	 wp_register_script( 'jquery.scrollTo', plugins_url('elements/jquery.scrollTo.js', __FILE__) );
        wp_enqueue_script( 'jquery.scrollTo' );
		
	
	
        wp_register_script( 'loewy_blog', plugins_url('elements/loewy_blog.js', __FILE__) );
             wp_enqueue_script( 'loewy_blog' );
			 
			 
		
    }

		
function front_end_faq($rows,$cats,$standcats,$stl,$faq,$s) {
if (!isset($_SESSION)) {
	session_start();
  }
  $atts=""; 
?>
<script>
  var ajax_url = "<?php echo add_query_arg(array('action' => ''), admin_url('admin-ajax.php'));  ?>"
</script>
<?php

global $wpdb;
global $many_faqs; 
 if($faq->standcat==0) {
	if (isset($_POST["reset".$faq->id])) {
	  if (esc_html($_POST['search'.$faq->id])!="") {
	    $_POST['search'.$faq->id]="";
	  }

	}
	else {
	  if (isset($_POST["submit".$faq->id]))	{
	    if($cats) {
	      if(esc_html($_POST['search'.$faq->id])=="Search...")
	        $_POST['search'.$faq->id]="";
	      foreach($cats as $cat) {	
			  $rows1 = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."spider_faq_question WHERE published='1' AND category=".$cat->id." AND (title LIKE '%".esc_html($_POST['search'.$faq->id])."%' OR article LIKE '%".esc_html($_POST['search'.$faq->id])."%')" );				
			  $rows[$cat->id] = $rows1;
		    }
		}
	  }
	  else {

	  }
    }
 }
 else { 
  if (isset($_POST["reset".$faq->id])) {
   if (esc_html($_POST['search'.$faq->id])!="") {
     $_POST['search'.$faq->id]="";
   }
  }
  if(isset($_POST['search'.$faq->id]) and esc_html($_POST['search'.$faq->id])=="Search...")
  $_POST['search'.$faq->id]="";
  else {
	if (isset($_POST['search'.$faq->id]) and esc_html($_POST["search".$faq->id])!="") {
	  $k=0;
	  if($standcats) { 
		  foreach($standcats as $cat)  {		
			$args = array(
				'numberposts'     => 5000,
				'offset'          => 0,
				'category'        => $cat->term_id,
				'post_type'       => 'post',
				'post_status'     => 'publish' );
			  
			$rows[$cat->term_id] = get_posts($args);
			for ($i=0;$i<count($rows[$cat->term_id]);$i++) {		
			  if(stripos($rows[$cat->term_id][$i]->post_title, $_POST['search'.$faq->id]) !== FALSE || stripos($rows[$cat->term_id][$i]->post_content, $_POST['search'.$faq->id]) !== FALSE) {		
				$rows1[$cat->term_id][$k]=$rows[$cat->term_id][$i];
				$k++;		
			  }
			  else
			    $rows1 =null;			
			}   
			$k=0;
		  }
		  $rows=$rows1;							
		}
	 }
  }
}


if ($stl->ctpadding)
{
$cattpadding=explode(' ',$stl->ctpadding);
foreach($cattpadding as $padding)
{
if($padding=="")
break;
$ctpadding[]=$padding.'px';
}
$stl->ctpadding=implode(' ',$ctpadding);
}

if ($stl->ctmargin)
{
$cattmargin=explode(' ',$stl->ctmargin);
foreach($cattmargin as $margin)
{
if($margin=="")
break;
$ctmargin[]=$margin.'px';
}
$stl->ctmargin=implode(' ',$ctmargin);
}


if ($stl->cdmargin)
{
$catdmargin=explode(' ',$stl->cdmargin);
foreach($catdmargin as $margin)
{
if($margin=="")
break;
$cdmargin[]=$margin.'px';
}
$stl->cdmargin=implode(' ',$cdmargin);
}


if ($stl->cdpadding)
{
$catdpadding=explode(' ',$stl->cdpadding);
foreach($catdpadding as $padding)
{
if($padding=="")
break;
$cdpadding[]=$padding.'px';
}
$stl->cdpadding=implode(' ',$cdpadding);
}

if ($stl->amargin)
{
$ansmargin=explode(' ',$stl->amargin);
foreach($ansmargin as $margin)
{
if($margin=="")
break;
$amargin[]=$margin.'px';
}
$stl->amargin=implode(' ',$amargin);
}

if ($stl->amarginimage)
{
$ansmarginimage=explode(' ',$stl->amarginimage);
foreach($ansmarginimage as $margin)
{
if($margin=="")
break;
$amarginimage[]=$margin.'px';
}
$stl->amarginimage=implode(' ',$amarginimage);
}

if ($stl->amarginimage2)
{
$ansmarginimage2=explode(' ',$stl->amarginimage2);
foreach($ansmarginimage2 as $margin)
{
if($margin=="")
break;
$amarginimage2[]=$margin.'px';
}
$stl->amarginimage2=implode(' ',$amarginimage2);
}

if ($stl->expcolmargin)
{
$ecmargin=explode(' ',$stl->expcolmargin);
foreach($ecmargin as $margin)
{
if($margin=="")
break;
$expcolmargin[]=$margin.'px';
}
$stl->expcolmargin=implode(' ',$expcolmargin);
}

if ($stl->sformmargin)
{
$sfmargin=explode(' ',$stl->sformmargin);
foreach($sfmargin as $margin)
{
if($margin=="")
break;
$sformmargin[]=$margin.'px';
}
$stl->sformmargin=implode(' ',$sformmargin);
}
if($faq->standcat==0){
if($faq->expand=='1')
{
?>
<script>

jQuery(window).load(function(){expand_hits(1,<?php echo $faq->id ?>,<?php echo $stl->id ?>,'<?php echo $stl->tbgcolor ?>','<?php echo $stl->tbghovercolor ?>'); iiiiiiiiiii=<?php echo $many_faqs ?>; jQuery('.post_exp')[0].click();  faq_changeexp<?php echo $faq->id ?>();}) 

</script>
<?php
}
}
else
{
if($faq->expand=='1')
{
?>
<script>

jQuery(window).load(function(){expand_post_hits(1,<?php echo $faq->id ?>,<?php echo $stl->id ?>,'<?php echo $stl->tbgcolor ?>','<?php echo $stl->tbghovercolor ?>'); iiiiiiiiiii=<?php echo $many_faqs ?>; jQuery('.post_exp')[0].click();  faq_changeexp<?php echo $faq->id ?>();}) 

</script>
<?php
}
}
?>	

<style type="text/css" media="screen">
.post_content_opened #post_title<?php echo $faq->id ?> {
  background-color:<?php echo '#'.$stl->tbghovercolor ?>!important;
  border-color:<?php echo '#'.$stl->tbgcolor ?>!important;
}
#content<?php echo $faq->id ?>{
width: <?php echo $stl->width.'px' ?>;
}
#post_title<?php echo $faq->id ?> {
<?php if($stl->numbering==1)echo "padding:0px;"; ?>
height: <?php echo $stl->theight.'px' ?>!important;
width: <?php echo $stl->twidth.'px' ?>;
border-style: <?php echo $stl->tbstyle ?>;
border-top-style:<?php echo $stl->tbtopstyle ?>;
border-right-style:<?php echo $stl->tbrightstyle ?>;
border-width:<?php echo $stl->tbwidth.'px' ?>;
border-color:<?php echo '#'.$stl->tbcolor ?>;
background-size: <?php echo $stl->tbgsize ?>;
background-repeat:no-repeat;
border-radius:<?php echo $stl->tbradius.'px' ?>;
<?php if($stl->titlebg==1) { if ($stl->tbgimage!="") { ?>
background-image:url('<?php echo  JURI::root()."administrator/".$stl->tbgimage ?>');
<?php }} else { if  ($stl->titlebggrad=="0") { ?>
background-color:#<?php echo $stl->tbgcolor ?>;
<?php } else {$user_agent = $_SERVER['HTTP_USER_AGENT']; if (preg_match('/MSIE/i', $user_agent)){ ?> background-color:<?php echo '#'.$stl->gradcolor1.';' ;}else{
 if($stl->gradtype!="circle") { ?>
background: -webkit-linear-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->gradcolor1 ?>,<?php echo '#'.$stl->gradcolor2 ?>);
background: -moz-linear-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->gradcolor1 ?>,<?php echo '#'.$stl->gradcolor2 ?>);
background: -o-linear-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->gradcolor1 ?>,<?php echo '#'.$stl->gradcolor2 ?>);
<?php } else { ?> 
background: -webkit-radial-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->gradcolor1 ?>,<?php echo '#'.$stl->gradcolor2 ?>);
background: -moz-radial-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->gradcolor1 ?>,<?php echo '#'.$stl->gradcolor2 ?>);
background: -o-radial-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->gradcolor1 ?>,<?php echo '#'.$stl->gradcolor2 ?>);
<?php } } }} ?>
display:table;
}	

#tchangeimg<?php echo $faq->id ?>{
display: table-cell;
vertical-align: middle;
width: auto;
}

#tchangeimg<?php echo $faq->id ?> img{
	

max-width: none
}

#post_title<?php echo $faq->id ?> #tchangeimg<?php echo $faq->id ?> img{
margin-left:<?php echo $stl->marginlimage1.'px' ?>;
}

#post_title<?php echo $faq->id ?>:hover{
 <?php if  ($stl->titlebggrad=="0") { ?>
background-color:#<?php echo $stl->tbghovercolor ?>!important ;
<?php } else {$user_agent = $_SERVER['HTTP_USER_AGENT']; if (preg_match('/MSIE/i', $user_agent)){ ?> background-color:<?php echo '#'.$stl->tbghovercolor.'!important;' ;}else{ if($stl->gradtype!="circle") { ?>
background: -webkit-linear-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->tbghovercolor ?>,<?php echo '#'.$stl->tbghovercolor ?>);
background: -moz-linear-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->tbghovercolor ?>,<?php echo '#'.$stl->tbghovercolor ?>);
background: -o-linear-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->tbghovercolor ?>,<?php echo '#'.$stl->tbghovercolor ?>);
<?php } else { ?> 
background: -webkit-radial-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->tbghovercolor ?>,<?php echo '#'.$stl->tbghovercolor ?>);
background: -moz-radial-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->tbghovercolor ?>,<?php echo '#'.$stl->tbghovercolor ?>);
background: -o-radial-gradient(<?php echo $stl->gradtype ?>,<?php echo '#'.$stl->tbghovercolor ?>,<?php echo '#'.$stl->tbghovercolor ?>);
<?php } } }
?>
}
#date_user<?php echo $faq->id ?>
{
width:<?php echo $stl->dwidth.'%' ?>;
height:<?php echo $stl->dheight.'px' ?>;
margin-left:<?php echo $stl->dmarginleft.'px' ?>;
font-size:14px;
color:<?php echo '#'.$stl->dtextcolor ?>;
background-color:<?php echo '#'.$stl->dbackgroundcolor ?>;
border-style:<?php echo $stl->dborderstyle ?>;
border-width:<?php echo $stl->dborderwidth.'px' ?>;
border-color:<?php echo '#'.$stl->dbordercolor ?>;
border-radius:<?php echo $stl->dbordercornerradius.'px' ?>;
border-top-style:<?php echo $stl->dbordertopstyle ?>;
border-bottom-style:<?php echo $stl->dborderbottomstyle ?>;
display: inline-table;
}
#date<?php echo $faq->id ?> img
{
box-shadow:none  !important;
padding-right:3px  !important;
padding-bottom:2px  !important;
padding-top:0px  !important;
padding-left:3px  !important;
float:none !important;
vertical-align:middle  !important;
}
#user<?php echo $faq->id ?> img
{
float:none !important;
box-shadow:none !important;
padding:2px !important;
padding-left:4px !important;
vertical-align:middle !important;
}
div.like_hits<?php echo $faq->id ?>
{
width:<?php echo $stl->dlikehitswidth.'%' ?>;
background-color:<?php echo '#'.$stl->dlikehitsbgcolor ?>;
margin-left:<?php echo $stl->dlikehitsmargin.'px' ?>;
font-size:14px;
border-style:<?php echo $stl->dlikehitsbdrst ?>;
border-width:<?php echo $stl->dlikehitsbdrw.'px' ?>;
border-color:<?php echo '#'.$stl->dlikehitsbdrc ?>;
border-radius:<?php echo $stl->dlikehitsbdrrad.'px' ?>;
border-top-style:<?php echo $stl->dlikehitsbdrtst ?>;
border-bottom-style:<?php echo $stl->dlikehitsbdrbst ?>;
color:<?php echo '#'.$stl->dlikehitstxtcl ?>;
display: inline-table;
}
span.like_hits_span
{
display:table-cell;
width:50%;
text-align:right;
padding:4px;
}
img.like_img{
box-shadow:none !important;
float:none !important;
padding:0px !important;
vertical-align:top !important;
margin-right:2px !important;
cursor:pointer !important;
}
img.unlike_img{
vertical-align: bottom !important;
box-shadow:none !important;
float:none !important;
padding:0px !important;
margin-right:2px !important;
cursor:pointer !important;
}
span.sentences
{
padding-left:3px
}
#date<?php echo $faq->id ?>
{
display: table-cell;
text-align: right;
padding-right: 4px;
width:auto;
}
span.likeimg
{
border-right-style: solid;
border-width: 1px;
border-color: #737373;
margin-right: 6px;
padding-right: 6px;
}
#ttext<?php echo $faq->id ?>{
width:<?php echo $stl->ttxtwidth.'%' ?>;
padding-left:<?php echo $stl->ttxtpleft.'px' ?>;
font-size:<?php echo $stl->tfontsize.'px' ?>;
color:<?php echo '#'.$stl->tcolor ?>;
display: table-cell;
vertical-align: middle;
<?php if($stl->ttxtpleft==0 or $stl->ttxtpleft=="") echo "text-align: center;";?>
<?php if($stl->numbering==1)echo "padding-top: 1%;"; ?>
font-family: sans-serif !important;
}

#post_content_wrapper<?php echo $faq->id ?> {
width: <?php echo $stl->awidth.'px' ?>;
border-style: <?php echo $stl->abstyle ?>;
border-right-style: <?php echo $stl->abrightstyle ?>;
border-width:<?php echo $stl->abwidth.'px' ?>;
border-color:<?php echo '#'.$stl->abcolor ?>;
background-size: <?php echo $stl->abgsize ?>;
border-radius:<?php echo $stl->abradius.'px' ?>;
padding:<?php echo $stl->apadd.'px' ?>;
}
#post_right<?php echo $faq->id ?> {
width:<?php if ($stl->answidth==""  or $stl->answidth==0)echo $stl->awidth.'px'; else echo $stl->answidth.'px' ;?>;
}
div.number<?php echo $faq->id ?>{
font-size:  <?php echo $stl->numberfnts.'px' ?>;
color:  <?php echo '#'.$stl->numbercl ?>;
display: table-cell;
font-family: fantasy;
width: 10px;
font-family: sans-serif !important;
}	
.post_content_wrapper #imgbefore<?php echo $faq->id ?> img{
width: <?php echo $stl->aimagewidth.'px' ?>;
height: <?php echo $stl->aimageheight.'px' ?>;
margin-top:<?php echo $stl->amarginimage ?>;
}

.post_content_wrapper #imgafter<?php echo $faq->id ?> img {
width: <?php echo $stl->aimagewidth2.'px' ?>;
height: <?php echo $stl->aimageheight2.'px' ?>;
margin-top:<?php echo $stl->amarginimage2 ?>;
}
	
#atext<?php echo $faq->id ?> p{
margin:0px;
font-size:<?php echo $stl->afontsize.'px' ?>!important;
}

#atext<?php echo $faq->id ?> a{
color:#1982d1 !important;
}

#atext<?php echo $faq->id ?> a:hover{
color:#1982d1 !important;
}

a{
color:#1982d1;
}

#atext<?php echo $faq->id ?>{
padding:<?php echo $stl->amargin ?>;
font-size:<?php echo $stl->afontsize.'px' ?>;
color:<?php echo '#'.$stl->atxtcolor ?>;
}	


#searchform<?php echo $faq->id ?>{
margin:;	
}

.searchform #skey<?php echo $faq->id ?> {
background-color: <?php echo '#'.$stl->sboxbgcolor ?> !important;
padding:0px;
outline: none;
height: 24px !important;
width:195px !important;
border: none;
//display: block;
//position:absolute;
//right:6%;
//bottom: 40%;
padding-left:4px!important;
}

.searchform #srbuts<?php echo $faq->id ?>  {
//bottom: 40%;
//right:10% !important;
background-image: url('<?php  echo plugins_url( '',__FILE__);?>/images/search-faq.png') !important;
width: 24px !important;
height: 24px !important;
background-size: 100% 100%;
//position:absolute;
background-repeat: no-repeat;
border: 0px;
cursor: pointer;
margin-right: 0px !important;
margin-top:0px !important;
margin-bottom:0px !important;
outline: none !important;
padding:0px !important;
background-color:transparent;
}
.searchform #srresbuts<?php echo $faq->id ?>  {
//bottom: 40%;
//right: 6% !important;
//position:absolute;
width:24px;
height:24px;
background-repeat: no-repeat;
background-image:url('<?php  echo plugins_url( '',__FILE__);?>/images/reset-faq.png') !important;
background-size: 100% 100%;
border: 0px;
cursor: pointer;
outline: none;
margin-top:0px !important;
margin-bottom:0px !important;
padding:0px !important;
background-color:transparent;
}

.sp_search_reset
{
	width: 51px;
    float: right;
    position: relative;
    left: -56px;
}




#cattitle<?php echo $faq->id ?>	{
<?php if($stl->ctbg == 0){
	?>
background:none;
<?php } 
else { if($stl->ctbggrad == 0){
?>
background-color: <?php echo '#'.$stl->ctbgcolor ?>;
<?php } else { $user_agent = $_SERVER['HTTP_USER_AGENT']; if (preg_match('/MSIE/i', $user_agent)){ ?> background-color:<?php echo '#'.$stl->ctgradcolor1.';' ;}else{ if($stl->ctgradtype!="circle") { ?>
background: -webkit-linear-gradient(<?php echo $stl->ctgradtype ?>,<?php echo '#'.$stl->ctgradcolor1 ?>,<?php echo '#'.$stl->ctgradcolor2 ?>);
background: -moz-linear-gradient(<?php echo $stl->ctgradtype ?>,<?php echo '#'.$stl->ctgradcolor1 ?>,<?php echo '#'.$stl->ctgradcolor2 ?>);
background: -o-linear-gradient(<?php echo $stl->ctgradtype ?>,<?php echo '#'.$stl->ctgradcolor1 ?>,<?php echo '#'.$stl->ctgradcolor2 ?>);
<?php } else { ?> 
background: -webkit-radial-gradient(<?php echo $stl->ctgradtype ?>,<?php echo '#'.$stl->ctgradcolor1 ?>,<?php echo '#'.$stl->ctgradcolor2 ?>);
background: -moz-radial-gradient(<?php echo $stl->ctgradtype ?>,<?php echo '#'.$stl->ctgradcolor1 ?>,<?php echo '#'.$stl->ctgradcolor2 ?>);
background: -o-radial-gradient(<?php echo $stl->ctgradtype ?>,<?php echo '#'.$stl->ctgradcolor1 ?>,<?php echo '#'.$stl->ctgradcolor2 ?>);
<?php }

}}}
?>

color: <?php echo '#'.$stl->cttxtcolor ?>;
font-size:<?php echo $stl->ctfontsize.'px' ?>;
padding:<?php echo $stl->ctpadding ?>;
margin:<?php echo $stl->ctmargin ?>;
border-radius:<?php echo $stl->ctbradius.'px' ?>;
border-style: <?php echo $stl->ctbstyle ?>;
border-width:<?php echo $stl->ctbwidth.'px' ?>;
border-color:<?php echo '#'.$stl->ctbcolor ?>;
}
	
#catdes<?php echo $faq->id ?>{
<?php if($stl->cdbg == 0){
	?>
background:none;
<?php } 
else { if($stl->cdbggrad == 0){
?>
background-color: <?php echo '#'.$stl->cdbgcolor ?>;
<?php } else {$user_agent = $_SERVER['HTTP_USER_AGENT']; if (preg_match('/MSIE/i', $user_agent)){ ?> background-color:<?php echo '#'.$stl->cdgradcolor1.';' ;}else{ if($stl->cdgradtype!="circle") { ?>
background: -webkit-linear-gradient(<?php echo $stl->cdgradtype ?>,<?php echo '#'.$stl->cdgradcolor1 ?>,<?php echo '#'.$stl->cdgradcolor2 ?>);
background: -moz-linear-gradient(<?php echo $stl->cdgradtype ?>,<?php echo '#'.$stl->cdgradcolor1 ?>,<?php echo '#'.$stl->cdgradcolor2 ?>);
background: -o-linear-gradient(<?php echo $stl->cdgradtype ?>,<?php echo '#'.$stl->cdgradcolor1 ?>,<?php echo '#'.$stl->cdgradcolor2 ?>);
<?php } else { ?> 
background: -webkit-radial-gradient(<?php echo $stl->cdgradtype ?>,<?php echo '#'.$stl->cdgradcolor1 ?>,<?php echo '#'.$stl->cdgradcolor2 ?>);
background: -moz-radial-gradient(<?php echo $stl->cdgradtype ?>,<?php echo '#'.$stl->cdgradcolor1 ?>,<?php echo '#'.$stl->cdgradcolor2 ?>);
background: -o-radial-gradient(<?php echo $stl->cdgradtype ?>,<?php echo '#'.$stl->cdgradcolor1 ?>,<?php echo '#'.$stl->cdgradcolor2 ?>);
<?php }

}}}
?>

color: <?php echo '#'.$stl->cdtxtcolor ?>;
font-size:<?php echo $stl->cdfontsize.'px' ?>;
margin:<?php echo $stl->cdmargin ?>;	
padding:<?php echo $stl->cdpadding ?>;
border-radius:<?php echo $stl->cdbradius.'px' ?>;
border-style: <?php echo $stl->cdbstyle ?>;
border-width:<?php echo $stl->cdbwidth.'px' ?>;
border-color:<?php echo '#'.$stl->cdbcolor ?>;
}	
	
	a.post_exp, a.post_coll, #post_expcol<?php echo $faq->id ?> {
color:<?php echo '#'.$stl->expcolcolor ?> ;
font-size:<?php echo $stl->expcolfontsize.'px' ?>;
text-decoration: none;
cursor:pointer;
}

a.post_exp:hover, a.post_coll:hover, #post_expcol<?php echo $faq->id ?>:hover {
color:<?php echo '#'.$stl->expcolhovercolor ?> !important;
background:none !important;
text-decoration: none;
cursor:pointer;
}

.expcoll, #expcol<?php echo $faq->id ?> {
margin:<?php echo $stl->expcolmargin ?>;
color:<?php echo '#'.$stl->expcolcolor ?> ;
}

a.more-link, #more-link<?php echo $faq->id ?>{
color:<?php echo '#'.$stl->rmcolor ?> !important; 
font-size:<?php echo $stl->rmfontsize.'px' ?> !important; 
text-decoration: none;
cursor:pointer;
}

a.more-link, #more-link<?php echo $faq->id ?>:hover{
color:<?php echo '#'.$stl->rmhovercolor ?> !important; 
text-decoration: none;
cursor:pointer;
}





</style>

	
<script>
var many_myfaq=<?php echo $many_faqs ?>;	
</script>
	
	

	
<script>
var change = true;

function faq_changesrc<?php echo $faq->id ?>(x)
{
if (document.getElementById('stl<?php echo $faq->id ?>'+x))
{

if(change) {
change = false;

if (document.getElementById('stl<?php echo $faq->id ?>'+x).src=="<?php echo $stl->tchangeimage1; ?>")
{
document.getElementById('stl<?php echo $faq->id ?>'+x).src="<?php echo $stl->tchangeimage2; ?>";
document.getElementById('stl<?php echo $faq->id ?>'+x).style.marginLeft="<?php echo $stl->marginlimage2.'px' ?>";

}
else
{
document.getElementById('stl<?php echo $faq->id ?>'+x).src="<?php echo $stl->tchangeimage1; ?>";
document.getElementById('stl<?php echo $faq->id ?>'+x).style.marginLeft="<?php echo $stl->marginlimage1.'px' ?>";

}

}

setTimeout("change=true",400);
}
}



var changeall = true;
function faq_changeexp<?php echo $faq->id ?>()
{

for (i=0; i<<?php echo $s ?>; i++)
{

if (document.getElementById('stl<?php echo $faq->id ?>'+i))
{

document.getElementById('stl<?php echo $faq->id ?>'+i).src="<?php echo $stl->tchangeimage2; ?>";
document.getElementById('stl<?php echo $faq->id ?>'+i).style.marginLeft="<?php echo $stl->marginlimage2.'px' ?>";

}
}
}


function faq_changecoll<?php echo $faq->id ?>()
{
if(changeall) {
changeall = false;
for (i=0; i<<?php echo $s ?>; i++)
{
if (document.getElementById('stl<?php echo $faq->id ?>'+i))
{
document.getElementById('stl<?php echo $faq->id ?>'+i).src="<?php echo $stl->tchangeimage1; ?>";
document.getElementById('stl<?php echo $faq->id ?>'+i).style.marginLeft="<?php echo $stl->marginlimage1.'px' ?>";
}
}
}
setTimeout("changeall=true",400);
}

</script>	
		

	<style>
<?php 
if($stl->width<$stl->twidth)
{
?>
	#post_title<?php echo $faq->id ?>{
		 width: 99%;
		
	}
<?php } ?>	


<?php 
if($stl->width<$stl->awidth)
{
?>
#post_content_wrapper<?php echo $faq->id ?>{
		 width: 99%;
		
	}
<?php } ?>	

<?php 
if ($stl->answidth==""  or $stl->answidth==0)
	$ans_width =  $stl->awidth; 
else 
	$ans_width = $stl->answidth;


if($stl->width<$ans_width)
{
?>
#post_right<?php echo $faq->id ?>{
		 width: 99%;
		
	}
<?php } ?>	



@media screen and (max-width: <?php echo $stl->width ?>px) {
    #content<?php echo $faq->id ?> {
        width: 99%;
    }
	
	#post_title<?php echo $faq->id ?>{
		 width: 99%;
		
	}
	#post_content_wrapper<?php echo $faq->id ?>{
		 width: 99%;
		
	}
	#post_right<?php echo $faq->id ?>{
		 width: 99%;
		
	}
}

</style>
	 	

	

<body>
		<div id="contentOuter"><div id="contentInner">
  <div class="faq_content" id="<?php echo 'content'.$faq->id ?>" >
  
<ul class="posts" style="<?php if ($stl->background=="0") { ?> background-color:<?php echo '#'.$stl->bgcolor;  } else { if ($stl->background=="1") {  if ($stl->bgimage!="") { ?> background-image:url(<?php echo $stl->bgimage ?>) <?php } } }?> ">				                                                                             
			<!-- Loop Starts -->
			<li class="selected" id="post-1236" >

<?php if ($faq->show_searchform == 1)
{ 
?>		
<form class="searchform" id="<?php echo 'searchform'.$faq->id ?>" action="<?php echo  $_SERVER['REQUEST_URI']; ?>" method="post">
<div style="display: block;">
<div style="position:relative;    text-align: right;">

<input id="<?php echo 'skey'.$faq->id ?>" name="search<?php echo $faq->id ?>"   value="<?php if(isset($_POST['search'.$faq->id]) && esc_html($_POST['search'.$faq->id])!="") { echo esc_html($_POST['search'.$faq->id]); } else echo "Search..." ;?>" onfocus="(this.value == 'Search...') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Search...')">
<div class="sp_search_reset">
<input type="submit" value="" id="<?php echo 'srbuts'.$faq->id ?>" name="submit<?php echo $faq->id ?>" >
	
<input type="submit" value="" id="<?php echo 'srresbuts'.$faq->id ?>" name="reset<?php echo $faq->id ?>"  >

</div>
<br><br>
</div>
</div>	
</form><?php
} 
echo '<img  style="display:none"  src="'.plugins_url( '',__FILE__).'/upload/ikon/like_black.png">';
echo '<img  style="display:none"  src="'.plugins_url( '',__FILE__).'/upload/ikon/like_white.png">';
echo '<img  style="display:none"  src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_black.png">';
echo '<img  style="display:none"  src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_white.png">'; 

if ($faq->standcat==0) {	  
	$a=false;
	if ($cats)
	{
		foreach($cats as $cat) {
			if($cat!=null)
			$a=true;
		}
	}

	if($a) {
	  echo '<div class="expcoll" id="expcol'.$faq->id. '">
		 <a   class="post_exp" id="post_expcol'.$faq->id. '"><span onclick=" iiiiiiiiiii='.$many_faqs.'; faq_changeexp'.$faq->id.'();expand_hits(1,'.$faq->id.','.$stl->id.',\''.$stl->tbgcolor.'\',\''.$stl->tbghovercolor.'\')">'.__("Expand All","faq").' </span></a><span>|</span>
		 <a   class="post_coll" id="post_expcol'.$faq->id. '"><span onclick="jjjjjjjjjjj='.$many_faqs.'; faq_changecoll'.$faq->id.'();expand_hits(0,'.$faq->id.','.$stl->id.',\''.$stl->tbgcolor.'\',\''.$stl->tbghovercolor.'\')">'.__("Collapse All","faq").'</span></a></div>';
	}


		 $n=0;
		if ($cats) {
			if($faq->numbertext==1) {
			  $num=$faq->numbertext;$point=".";
			}
			else {
			   $num="";$point="";
			}
		    foreach($cats as $cat) {			 
				if ($cat!=null and $cat->show_title==1) {
					if ($cat->title=="Uncategorized")
					echo '<div class="cattitle" id="cattitle'.$faq->id. '" ><span style="float:left">'.$num.$point.'</span>'.__("Uncategorized","faq").$atts.'</div>';
					else
					echo '<div class="cattitle" id="cattitle'.$faq->id. '"><span style="float:left">'.$num.$point.'</span>'.$cat->title.'</div>';
				}
				if ($cat!=null and $cat->show_description==1 && $cat->description!="")
				 echo '<div class="catdes" id="catdes'.$faq->id. '" >'.$cat->description.'</div>';
				 
				else {
				  echo '<div style="padding-top:18px"></div>';
				}
				
				$number_div = "";
				$likespan = "";
				if( $cat!=null and count($rows[$cat->id])) {
				if($stl->numbering==1)$numbering=1;
				 for ($i=0;$i<count($rows[$cat->id]);$i++) {
					 $date="";
					 if($stl->numbering==1)$number_div='<div class="number'.$faq->id.'" >'.$numbering.'</div>';else $number_div=="";
					 $row = &$rows[$cat->id][$i];
					if($faq->date==1 or $faq->user==1)
						 {$date=$row->date;$user_name=$row->user_name; if($stl->ikncol==0){$dateimg='<img  src="'.plugins_url( '',__FILE__).'/upload/ikon/Calendar-Black.png">';$user_img='<img  src="'.plugins_url( '',__FILE__).'/upload/ikon/User_Black.png" >';}
						 else{$dateimg='<img  src="'.plugins_url( '',__FILE__).'/upload/ikon/Calendar_white.png">';$user_img='<img  src="'.plugins_url( '',__FILE__).'/upload/ikon/User_white.png" >';}
						 if($faq->user==0){$user_img=""; $user_name="";}if($faq->date==0 or $date==""){$dateimg="";$date="";}if($user_name==""){$user_img="";}
						 $date_user_div='<div class="date_user" id="date_user'.$faq->id.'"  ><span id="user'.$faq->id.'" style="vertical-align: bottom;">'.$user_img.$user_name.'</span><span style="vertical-align: bottom;" id="date'.$faq->id.'" >'.$dateimg.$date.'</span></div>';}
						 else{$date_user_div='';}if($row->date=="" && $row->user_name==""){$date_user_div='';}
					if($faq->like==1 or $faq->hits==1)
						 {if($faq->like==0){$like='';$unlike='';$imglike='';$imgunlike='';$br='';}
							   else {$like=$row->like;  $unlike=$row->unlike;$br='<br>';
								  if($stl->ikncol==0){ $imgunlike='<img onclick="unlike('.$row->id.','.$faq->id.','.$stl->id.')" class="unlike_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_black.png">';
									 $imglike='<img onclick="like('.$row->id.','.$faq->id.','.$stl->id.')"  class="like_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/like_black.png">';}
								 else { $imgunlike='<img onclick="unlike('.$row->id.','.$faq->id.','.$stl->id.')" class="unlike_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_white.png">';
									 $imglike='<img onclick="like('.$row->id.','.$faq->id.','.$stl->id.')"  class="like_img"   src="'.plugins_url( '',__FILE__).'/upload/ikon/like_white.png">';}}
								  if($faq->hits==1){$hits=$row->hits;$hits_expression='Hits: ';$hitsspan=''.$br.'<span id="hits'.$row->id.'" style="margin-right:10px;margin-right:10px;float:right;" >'.$hits_expression.$hits.'</span>';}
								  elseif($faq->hits==0){$hits='';$hits_expression='';$hitsspan='';}
								  if (isset($_SESSION['expand_hits_valid_user'.$faq->id])) if($_SESSION['expand_hits_valid_user'.$faq->id]==1)unset($_SESSION['expand_hits_valid_user'.$faq->id]);
								  if (isset($_SESSION['hits_valid_user'.$row->id])) { if($_SESSION['hits_valid_user'.$row->id]==1)unset($_SESSION['hits_valid_user'.$row->id]);}
								  if(isset($_SESSION['valid_user'.$row->id]) && $_SESSION['valid_user'.$row->id]==1 && $faq->like==1 ){$likespan='<span  class="sentences" style="width:50%;float:none;display:table-cell;" >You already voted for this FAQ today!</span>';}elseif(!isset($_SESSION['valid_user'.$row->id])  && $faq->like==1){$likespan='<span class="sentences" style="width:50%;float:none;display:table-cell;" >Was this helpful?</span>';} 
								  if ($faq->like==1)$class='class="likeimg"';else $class="";
								  $like_hits_div='<div id="like_hits_div'.$row->id.'" class="like_hits'.$faq->id.'" >'.$likespan.'<span class="like_hits_span" style="width:50%;float:none;display:table-cell;"><span><span   '.$class.' >'.$imglike.$like.'</span><span>'.$imgunlike.$unlike.'</span></span>'.$hitsspan.'</span></div>';}
								  else{$like_hits_div='';}
						echo '</li><li id="post-1236" class="selected" style="margin-left:'.$stl->marginleft.'px !important"><div class="post_top">
									  <div class="post_right" >
										  <a href="#" class="post_ajax_title"><span id="post_span'.$row->id.$faq->id.'" onclick="faq_changesrc'.$faq->id.'('.$n.')"><div onclick="hits('.$row->id.','.$faq->id.','.$stl->id.');edit_title(1,'.$row->id.','.$faq->id.',\''.$stl->tbgcolor.'\',\''.$stl->tbghovercolor.'\')"  class="post_title" id="post_title'.$faq->id.'" style="padding: 5px;'?><?php if($stl->titlebg==1) { if ($stl->tbgimage!="") { echo 'background-image:url('.$stl->tbgimage.')'?><?php } echo '">' ?><?php } else echo 'background-color:#'.$stl->tbgcolor.'">
										  '.$number_div.''?><?php if($stl->imgpos==0){ if ($stl->tchangeimage1!=""){ echo'<div align="left" class="tchangeimg" id="tchangeimg'.$faq->id.'"  style="padding-right: 6px;padding-left: 5px;"><img src="'.$stl->tchangeimage1.'"  id="stl'.$faq->id.$n.'" style="box-shadow:none;padding:0px;vertical-align: middle;"/></div>'  ?><?php } echo '<div class="ttext'.$faq->id.'" id="ttext'.$faq->id.'" >'.stripslashes($row->title).'</div></div></span></a>
										</div>
									</div>';}else{ echo '<div class="ttext'.$faq->id.'" id="ttext'.$faq->id.'" >'.stripslashes($row->title).'</div>'?><?php if ($stl->tchangeimage1!=""){ echo'<div align="right" class="tchangeimg" id="tchangeimg'.$faq->id.'"  style="padding-right: 6px;padding-left: 5px;"><img src="'.$stl->tchangeimage1.'"  id="stl'.$faq->id.$n.'" style="box-shadow:none;padding:0px;vertical-align: middle;"/></div>' ?><?php } echo '</div></span></a>
									</div></div>';}
								if (strlen($row->fullarticle)>1){
								echo '<div id="post_content'.$row->id.'" class="post_content" style="padding-left:'.$stl->ansmarginleft.'px !important;">
									  <div  class="post_content_wrapper" id="post_content_wrapper'.$faq->id.'" style="'?><?php if($stl->abg==1) { if ($stl->abgimage!="") { echo 'background-image:url('.$stl->abgimage.')'?><?php } echo '">' ?><?php } else echo 'background-color:#'.$stl->abgcolor.'">
										'?><?php if ($stl->aimage!=""){ echo'<div class="imgbefore" id="imgbefore'.$faq->id. '"><img src="'.$stl->aimage.'"  /></div>'  ?><?php } echo ''.$date_user_div.'<div class="post_right" id="post_right'.$faq->id.'"><div class="atext" id="atext'.$faq->id. '">'.wpautop($row->article).'<p><a href="#" class="more-link" id="more-link'.$faq->id. '">More</a></p>
											<div class="post_content_more" style="margin-top:-6px;">'.wpautop($row->fullarticle).'</div>	    
											   </div></div>'.$like_hits_div?><?php if ($stl->aimage2!=""){ echo'<div class="imgafter" id="imgafter'.$faq->id. '"><img src="'.$stl->aimage2.'"  /></div>'  ?><?php } echo '
									   </div></div>
									</li>';
								
								}
								else{
								echo '<div id="post_content'.$row->id.'" class="post_content" style="padding-left:'.$stl->ansmarginleft.'px !important;">
									  <div class="post_content_wrapper" id="post_content_wrapper'.$faq->id.'" style="'?><?php if($stl->abg==1) { if ($stl->abgimage!="") { echo 'background-image:url('.$stl->abgimage.')'?><?php } echo '">' ?><?php } else echo 'background-color:#'.$stl->abgcolor.'">
										'?><?php if ($stl->aimage!=""){ echo'<div class="imgbefore" id="imgbefore'.$faq->id. '"><img src="'.$stl->aimage.'"  /></div>'  ?><?php } echo ''.$date_user_div.'<div class="post_right" id="post_right'.$faq->id.'"><div style="border-top:1px;" class="atext" id="atext'.$faq->id. '">'.wpautop($row->article).'	    
											   </div></div>'.$like_hits_div?><?php if ($stl->aimage2!=""){ echo'<div class="imgafter" id="imgafter'.$faq->id. '"><img src="'.$stl->aimage2.'"  /></div>'  ?><?php } echo '
									   </div></div>
									</li>';
								
							}

						echo '<div style="padding-bottom:'.$stl->paddingbq.'px"></div>';	
							
						$n++;	
						if($stl->numbering==1)$numbering++;	
				}

					
					}
					else {
						if(isset($_POST['submit'.$faq->id]))
						{
						echo 'Question(s) not found';
						}
						elseif($cat==null)
						 echo "";
						else
						 echo 'There are no questions in this category';		
					}
					
					echo '<div style="padding-bottom:30px;"></div>';
				if($faq->numbertext==1) {	
				  $num++;
				}
			}
		}
    }
	
	else{	/////////////// stand category////////////////////  ]
	
	if($faq->numbertext==1)
 {$num=$faq->numbertext;$point=".";}
 else{$num="";$point="";}
$a=false;

if ($standcats)
{
foreach($standcats as $cat)
 {

$a=true;
}
}

if($a)
{	
echo '<div class="expcoll" id="expcol'.$faq->id. '">
     <a  class="post_exp" id="post_expcol'.$faq->id. '"><span onclick="iiiiiiiiiii='.$many_faqs.'; faq_changeexp'.$faq->id.'();expand_post_hits(1,'.$faq->id.','.$stl->id.',\''.$stl->tbgcolor.'\',\''.$stl->tbghovercolor.'\')">'.__("Expand All","faq").' </span></a><span>|</span>
     <a  class="post_coll" id="post_expcol'.$faq->id. '"><span onclick="jjjjjjjjjjj='.$many_faqs.'; faq_changecoll'.$faq->id.'();expand_post_hits(0,'.$faq->id.','.$stl->id.',\''.$stl->tbgcolor.'\',\''.$stl->tbghovercolor.'\')">'.__("Collapse All","faq").'</span></a></div>';
}	
	
	
$k=0;
	if ($standcats)
{
foreach($standcats as $cat)
 {if($cat!=null) {
 $number_div = "";
$likespan = "";
 
if($stl->numbering==1)$numbering=1;
if ( $cat->name=="")
{
echo '<div style="padding-bottom:60px"></div>';
}
else
echo '<div class="cattitle" id="cattitle'.$faq->id. '"><span style="float:left">'.$num.$point.'</span>'.$cat->name.'</div>';
if (category_description($cat->term_id)!="")
echo '<div class="catdes" id="catdes'.$faq->id. '">'.category_description($cat->term_id).'</div>';
else{
echo '<div style="padding-top:18px"></div>';
}

if(count($rows[$cat->term_id])){
 for ($i=0;$i<count($rows[$cat->term_id]);$i++)
 {
 if($stl->numbering==1)$number_div='<div class="number'.$faq->id.'" >'.$numbering.'</div>';else $number_div=="";				  
 $row = &$rows[$cat->term_id][$i];
if (stripos($row->post_content, "<!--more-->") !== false)
{

$answer1=explode('<!--more-->',$row->post_content);
$row->text=$answer1[0];
$row->fulltext=$answer1[1];

}
else{
$row->text=$row->post_content;
$row->fulltext='';
}


 $stand_cat_post=$wpdb->get_row($wpdb->prepare("SELECT * FROM  ".$wpdb->prefix."posts as A LEFT JOIN  ".$wpdb->prefix."post_right_content as B ON A.ID = B.id LEFT JOIN  ".$wpdb->prefix."users as C ON A.post_author = C.ID WHERE A.ID='%d'",$row->ID));
 
 if($faq->date==1 or $faq->user==1)

     { $ch=$stand_cat_post->post_date;$date_hour=explode(' ',$ch);$date=date('d-m-Y',strtotime($date_hour[0])); $user_name=$stand_cat_post->display_name; if($stl->ikncol==0){$dateimg='<img  src="'.plugins_url( '',__FILE__).'/upload/ikon/Calendar-Black.png">';$user_img='<img  src="'.plugins_url( '',__FILE__).'/upload/ikon/User_Black.png" >';}
	 else{$dateimg='<img  src="'.plugins_url( '',__FILE__).'/upload/ikon/Calendar_white.png">';$user_img='<img  src="'.plugins_url( '',__FILE__).'/upload/ikon/User_white.png" >';}
	 if($faq->user==0){$user_img=""; $user_name="";}if($faq->date==0){$dateimg="";$date="";}if($user_name==""){$user_img="";}
	 $date_user_div='<div class="date_user" id="date_user'.$faq->id.'"  ><span id="user'.$faq->id.'" style="vertical-align: bottom;">'.$user_img.$user_name.'</span><span style="vertical-align: bottom;" id="date'.$faq->id.'" >'.$dateimg.$date.'</span></div>';}
	 else{$date_user_div='';}
	 
 if($faq->like==1 or $faq->hits==1)
     {  if($faq->like==0){$like='';$unlike='';$imglike='';$imgunlike='';$br='';}
	       else {$br='<br>';if($stand_cat_post->like==NULL)$like=0;else $like=$stand_cat_post->like;if($stand_cat_post->unlike==NULL)$unlike=0;else $unlike=$stand_cat_post->unlike;
	          if($stl->ikncol==0){ $imgunlike='<img onclick="post_unlike('.$row->ID.','.$faq->id.','.$stl->id.')" class="unlike_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_black.png">';
                 $imglike='<img onclick="post_like('.$row->ID.','.$faq->id.','.$stl->id.')"  class="like_img"   src="'.plugins_url( '',__FILE__).'/upload/ikon/like_black.png">';}
             else { $imgunlike='<img onclick="post_unlike('.$row->ID.','.$faq->id.','.$stl->id.')" class="unlike_img"  src="'.plugins_url( '',__FILE__).'/upload/ikon/unlike_white.png">';
                 $imglike='<img onclick="post_like('.$row->ID.','.$faq->id.','.$stl->id.')"  class="like_img"   src="'.plugins_url( '',__FILE__).'/upload/ikon/like_white.png">';}}
			  if(isset($_SESSION['post_valid_user'.$row->ID]) && $_SESSION['post_valid_user'.$row->ID]==1 && $faq->like==1){$likespan='<span class="sentences" style="width:50%;float:none;display:table-cell;" >You already voted for this FAQ today!</span>';}elseif(!isset($_SESSION['post_valid_user'.$row->ID])  && $faq->like==1){$likespan='<span class="sentences" style="width:50%;float:none;display:table-cell;" >Was this helpful?</span>';}
			  if($faq->hits==1){if($stand_cat_post->hits==NULL)$hits=0;else $hits=$stand_cat_post->hits;$hits_expression='Hits: ';$hitsspan=''.$br.'<span id="post_hits'.$row->ID.'" style="margin-right:10px;float:right;" >'.$hits_expression.$hits.'</span>';}
			  elseif($faq->hits==0){$hits='';$hits_expression='';$hitsspan='';}
			  if(isset($_SESSION['post_hits_valid_user'.$row->ID]) and $_SESSION['post_hits_valid_user'.$row->ID]==1)unset($_SESSION['post_hits_valid_user'.$row->ID]);  
			  if(isset($_SESSION['expand_post_hits_valid_user'.$row->ID]) and  $_SESSION['expand_post_hits_valid_user'.$faq->id]==1)unset($_SESSION['expand_post_hits_valid_user'.$faq->id]);                                    
	          if ($faq->like==1)$class='class="likeimg"';else $class="";
			  $like_hits_div='<div id="post_like_hits_div'.$row->ID.'" class="like_hits'.$faq->id.'" >'.$likespan.'<span class="like_hits_span" style="width:50%;float:none;display:table-cell;"  ><span><span '.$class.' >'.$imglike.$like.'</span><span>'.$imgunlike.$unlike.'</span></span>'.$hitsspan.'</span></div>';}
			  else{$like_hits_div='';}
	echo  '</li><li id="post-1236" class="selected" style="margin-left:'.$stl->marginleft.'px !important"><div class="post_top">
				  <div class="post_right" id="post_right'.$faq->id.'">
					  <a href="#" class="post_ajax_title"><span id="post_span'.$row->ID.$faq->id.'" onclick="faq_changesrc'.$faq->id.'('.$k.')"><h2 onclick="post_hits('.$row->ID.','.$faq->id.','.$stl->id.');edit_title(1,'.$row->ID.','.$faq->id.',\''.$stl->tbgcolor.'\',\''.$stl->tbghovercolor.'\')" class="post_title" id="post_title'.$faq->id.'" style="padding:5px;'?><?php if ($stl->tbgimage!="") { echo 'background-image:url('.$stl->tbgimage.')'?><?php } echo '">
					  '.$number_div.''?><?php if($stl->imgpos==0){ if ($stl->tchangeimage1!=""){ echo'<div align="left" class="tchangeimg" id="tchangeimg'.$faq->id.'" style="padding-right: 6px;padding-left: 5px;"><img src="'.$stl->tchangeimage1.'" id="stl'.$faq->id.$k.'" style="box-shadow:none;padding:0px;vertical-align: middle;" /></div>'  ?><?php } echo '<div class="ttext" id="ttext'.$faq->id.'" >'.stripslashes($row->post_title).'</div></h2></span></a>
				    </div>
			    </div>';}else{ echo '<div class="ttext" id="ttext'.$faq->id.'" >'.stripslashes($row->post_title).'</div>'?><?php if ($stl->tchangeimage1!=""){ echo'<div align="right" class="tchangeimg" id="tchangeimg'.$faq->id.'" style="padding-right: 6px;padding-left: 5px;"><img src="'.$stl->tchangeimage1.'" id="stl'.$faq->id.$k.'" style="box-shadow:none;padding:0px;vertical-align: middle;" /></div>' ?><?php }
				    echo '</h2></span></a>
			    </div></div>';}
			if (strlen($row->fulltext)>1){
			echo '<div id="post_content'.$row->ID.'" class="post_content" style="padding-left:'.$stl->ansmarginleft.'px !important;">
				  <div class="post_content_wrapper" id="post_content_wrapper'.$faq->id.'" style="'?><?php if($stl->abg==1) {  if ($stl->abgimage!="") { echo 'background-image:url('.$stl->abgimage.')'?><?php } echo '">' ?><?php } else echo 'background-color:#'.$stl->abgcolor.'">
				    '?><?php if ($stl->aimage!=""){ echo'<div class="imgbefore" id="imgbefore'.$faq->id. '"><img src="'.$stl->aimage.'"  /></div>'  ?><?php } echo ''.$date_user_div.'<div class="post_right" id="post_right'.$faq->id.'"><div class="atext" id="atext'.$faq->id. '">'.wpautop($row->text).'<p><a href="#" class="more-link " id="more-link'.$faq->id. '">More</a></p>
			            <div class="post_content_more" style="margin-top:-6px;">'.wpautop($row->fulltext).'</div>	    
			               </div></div>'.$like_hits_div?><?php if ($stl->aimage2!=""){ echo'<div class="imgafter" id="imgafter'.$faq->id. '"><img src="'.$stl->aimage2.'"  /></div>'  ?><?php } echo '
			       </div></div>
				</li>';		
			}
			else{
			echo '<div id="post_content'.$row->ID.'"  class="post_content" style="padding-left:'.$stl->ansmarginleft.'px !important;">
				  <div class="post_content_wrapper" id="post_content_wrapper'.$faq->id.'" style="'?><?php if($stl->abg==1) {  if ($stl->abgimage!="") { echo 'background-image:url('.$stl->abgimage.')'?><?php } echo '">' ?><?php } else echo 'background-color:#'.$stl->abgcolor.'">
				    '?><?php if ($stl->aimage!=""){ echo'<div class="imgbefore" id="imgbefore'.$faq->id. '"><img src="'.$stl->aimage.'"  /></div>'  ?><?php } echo ''.$date_user_div.'<div class="post_right" id="post_right'.$faq->id.'"><div class="atext" id="atext'.$faq->id. '">'.wpautop($row->post_content).'	    
			               </div></div>'.$like_hits_div?><?php if ($stl->aimage2!=""){ echo'<div class="imgafter" id="imgafter'.$faq->id. '"><img src="'.$stl->aimage2.'"  /></div>'  ?><?php } echo '
			       </div></div>
				</li>';
}
	echo '<div style="padding-bottom:'.$stl->paddingbq.'px"></div>';	
		
	$k++;
if($stl->numbering==1)$numbering++;		

}

}

else{
if(isset($_POST['submit'.$faq->id]))
{
echo 'Question(s) not found';
}
else
echo 'There are no questions in this category';

}
	
	echo '<div style="padding-bottom:30px;"></div>';
	if($faq->numbertext==1)
    {	
	$num++;
    }
	
	}
	
	}
	}	
//ob_start();	
	}	
$many_faqs++;
?>
		</ul>		
	  </div>
	  </div>
	  </div> 	

<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
	
	try {
		var pageTracker = _gat._getTracker("UA-9222847-1");
		// Cookied already: 
		pageTracker._trackPageview();
	} catch(err) {}
</script>
</body>

<?php
       $content=ob_get_contents();
		return $content;
}

/*function do_output_buffer() {
  
}
add_action('init', 'do_output_buffer');*/

//// add editor new mce button
add_filter('mce_external_plugins', "Spider_Faq_register");
add_filter('mce_buttons', 'Spider_Faq_add_button', 0);

/// function for add new button

function Spider_Faq_add_button($buttons)
{
    array_push($buttons, "Spider_Faq_mce");
    return $buttons;
}


 /// function for registr new button
function Spider_Faq_register($plugin_array)
{   
    $url = plugins_url( 'js/editor_plugin.js' , __FILE__ ); 
    $plugin_array["Spider_Faq_mce"] = $url;
    return $plugin_array;	
}

function add_button_style_Spider_Faq() {
  ?>
  <script>
    var spider_faq_plugin_url = '<?php echo plugins_url(plugin_basename(dirname(__FILE__))); ?>'; 
  </script>
  <?php
}

add_action('admin_head', 'add_button_style_Spider_Faq');



add_action('admin_menu', 'Spider_Faq_options_panel');
function Spider_Faq_options_panel(){
  $ikon_dir = plugins_url(plugin_basename(dirname(__FILE__))) . '/images/spider_faq_menu_ikon.png';
  add_menu_page(	'Theme page title', 'Spider FAQ', 'manage_options', 'Spider_Faq', 'Spider_Faq', $ikon_dir);
 $faqqq=add_submenu_page( 'Spider_Faq', 'Spider Faq', 'FAQs', 'manage_options', 'Spider_Faq', 'Spider_Faq');
 $questions=add_submenu_page( 'Spider_Faq', 'Questions', 'Questions', 'manage_options', 'Spider_Faq_Questions', 'Spider_Faq_Questions');
  add_submenu_page( 'Spider_Faq', 'Categories', 'Categories', 'manage_options', 'Spider_Faq_Categories', 'Spider_Faq_Categories');
  $page_theme=add_submenu_page( 'Spider_Faq', 'Themes', 'Themes', 'manage_options', 'Spider_Faq_Themes', 'Spider_Faq_Themes');
  add_submenu_page( 'Spider_Faq', 'Licensing', 'Licensing', 'manage_options', 'Spider_FAQ_Licensing', 'Spider_FAQ_Licensing');
  $featured_plugins_page = add_submenu_page('Spider_Faq', 'Featured Plugins', 'Featured Plugins', 'manage_options', 'Spider_Faq_featured_plugins', 'Spider_Faq_featured_plugins');
   add_action('admin_print_styles-' . $featured_plugins_page, 'Spider_Faq_featured_plugins_styles');


  add_submenu_page( 'Spider_Faq', 'Uninstall Spider_Faq ', 'Uninstall Spider FAQ', 'manage_options', 'Uninstall_Spider_FAQ', 'Uninstall_Spider_Faq');
	add_action('admin_print_styles-' . $page_theme, 'sp_faq_admin_styles_scripts');
	add_action('admin_print_styles-' .$questions, 'faq_calaendar_js');
  }
  
  function Spider_FAQ_Licensing(){
	?>
    <div style="display:block;width:95%;text-align:right"><a href="http://web-dorado.com/files/fromFAQWP.php" target="_blank" style="color:red; text-decoration:none;">
            <img src="<?php echo plugins_url('images/header.png',__FILE__) ?>" border="0" alt="http://web-dorado.com/files" width="215"><br>
            Get the full version&nbsp;&nbsp;&nbsp;&nbsp;
            </a>
			</div>
   <div style="width:95%"> <p>
This plugin is the non-commercial version of the Spider FAQ. Use of the FAQ is free.<br /> The only
limitation is the use of the themes. If you want to use one of the 22 standard themes or create a new one that
satisfies the needs of your web site, you are required to purchase a license.<br /> Purchasing a license will add 22
standard themes and give possibility to edit the themes of the Spider FAQ. </p>
<br /><br />
<a href="http://web-dorado.com/files/fromFAQWP.php" class="button-primary" target="_blank">Purchase a License</a>
<br /><br /><br />
<p>After the purchasing the commercial version follow this steps:</p>
<ol>
	<li>Deactivate Spider FAQ Plugin</li>
	<li>Delete Spider FAQ Plugin</li>
	<li>Install the downloaded commercial version of the plugin</li>
</ol>
</div>  
    <?php
	
	
	}
  
  function faq_calaendar_js()
  {
	wp_enqueue_script("faq_calaendar",plugins_url('js\calendar.js', __FILE__));
	wp_enqueue_script("faq_calaendar2",plugins_url('js\calendar_function.js', __FILE__));
	wp_enqueue_script("faq_calaendar3",plugins_url('js\calendar-setup.js', __FILE__));
	wp_enqueue_style("faq_calaendar4",plugins_url('js\calendar-jos.css', __FILE__));
	wp_enqueue_style("wpusers",plugins_url('js\template.css', __FILE__));
	}
   function sp_faq_admin_styles_scripts()
  {
  if(get_bloginfo('version')>3.3){
	wp_enqueue_script("jquery");

	}
	else
	{
		 wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js');
		wp_enqueue_script( 'jquery' );
	

	}
	
	wp_enqueue_script("colcor_js",plugins_url('jscolor/jscolor.js', __FILE__));
	wp_enqueue_script("theme_reset",plugins_url('js/theme_reset.js', __FILE__));
	
  }



require_once("nav_function/nav_html_func.php");

add_filter('admin_head','faq_ShowTinyMCE');
function faq_ShowTinyMCE() {
	
	// conditions here
	wp_enqueue_script( 'common' );
	wp_enqueue_script( 'jquery-color' );
	wp_print_scripts('editor');
	if (function_exists('add_thickbox')) add_thickbox();
	wp_print_scripts('media-upload');
	wp_admin_css();
	wp_enqueue_script('utils');
	do_action("admin_print_styles-post-php");
	do_action('admin_print_styles');
}

function Spider_Faq()
{
global $wpdb;
	require_once("spider_faq_functions.php");
	require_once("spider_faq_functions.html.php");
	

	if(isset($_GET["task"])){
	$task=$_GET["task"];
	}
	else
	{
		$task="default";
	}
	if(isset($_GET["id"]))
	{
	
		$id=$_GET["id"];
		
	}
	else
	{
		$id=0;
	
	}
	
	
	switch($task){
	case 'Spider_Faq':
		show_spider_faq();
		break;
		

	
	case 'add_Spider_Faq':
		add_spider_faq();
		break;
	
	
	case 'save':
	if($id)
	{	
	check_admin_referer('nonce_sp_faq', 'nonce_sp_faq');
	apply_spider_faq($id);
		
	}
	else
	{   check_admin_referer('nonce_sp_faq', 'nonce_sp_faq');
		save_spider_faq();
	}
		show_spider_faq();
		break;
			
	case 'apply':

		if($id)	
		{
			check_admin_referer('nonce_sp_faq', 'nonce_sp_faq');
			apply_spider_faq($id);
		}
		else
		{
			check_admin_referer('nonce_sp_faq', 'nonce_sp_faq');
			save_spider_faq();
			$id=$wpdb->get_var("SELECT MAX(id) FROM ".$wpdb->prefix."spider_faq_faq");
		}
		
		edit_spider_faq($id);
		break;	
		

		
	case 'edit_Spider_Faq':
       
	   edit_spider_faq($id);
		break;	

	
	case 'remove_Spider_Faq':
	    $nonce_sp_faq = $_REQUEST['_wpnonce'];
		if (! wp_verify_nonce($nonce_sp_faq, 'nonce_sp_faq') )
		  die("Are you sure you want to do this?");
		remove_spider_faq($id);
		show_spider_faq();
		break;
			
		
			default:
			show_spider_faq();
			break;
	}
}

function Spider_Faq_Questions()
{
global $wpdb;
	require_once("spider_faq_question_functions.php");// add functions for player
	require_once("spider_faq_question_functions.html.php");// add functions for vive player
	

	if(isset($_GET["task"])){
	$task=$_GET["task"];
	}
	else
	{
		$task="default";
	}
	if(isset($_GET["id"]))
	{
	
		$id=$_GET["id"];
		
	}
	else
	{
		$id=0;
	}
	
	
	
	
	switch($task){
	case 'Spider_Faq_Questions':
		show_spider_ques();
		break;
		case "unpublish_Spider_Faq_Questions":
		$nonce_sp_faq = $_REQUEST['_wpnonce'];
		if (! wp_verify_nonce($nonce_sp_faq, 'nonce_sp_faq') )
		  die("Are you sure you want to do this?");
		change_spider_ques($id);		
		show_spider_ques();
		
		break;
	


	
	case 'add_Spider_Faq_Questions':
		add_spider_ques();
		break;
	
	
	case 'save':
	if($id)
	{	
check_admin_referer('nonce_sp_faq', 'nonce_sp_faq');	
	apply_spider_ques($id);
		
	}
	else
	{
	check_admin_referer('nonce_sp_faq', 'nonce_sp_faq');
		save_spider_ques();
	}
		show_spider_ques();
		break;
			
	case 'apply':	
		if($id)	
		{
			check_admin_referer('nonce_sp_faq', 'nonce_sp_faq');
			apply_spider_ques($id);
		}
		else
		{
			check_admin_referer('nonce_sp_faq', 'nonce_sp_faq');
			save_spider_ques();
			$id=$wpdb->get_var("SELECT MAX(id) FROM ".$wpdb->prefix."spider_faq_question");
		}
		
		edit_spider_ques($id);
		break;	
		

		
	case 'edit_Spider_Faq_Questions':
	
        edit_spider_ques($id);
   	
    		break;	
	

	
	case 'remove_Spider_Faq_Questions':
		$nonce_sp_faq = $_REQUEST['_wpnonce'];
		if (! wp_verify_nonce($nonce_sp_faq, 'nonce_sp_faq') )
		  die("Are you sure you want to do this?");
		remove_spider_ques($id);
		show_spider_ques();
		break;
			
	
			default:
			show_spider_ques();
			break;
	}
}

function Spider_Faq_Categories()
{
global $wpdb;
	require_once("spider_faq_category_functions.php");// add functions for player
	require_once("spider_faq_category_functions.html.php");// add functions for vive player
	

	if(isset($_GET["task"])){
	$task=$_GET["task"];
	}
	else
	{
		$task="default";
	}
	if(isset($_GET["id"]))
	{
	
		$id=$_GET["id"];
		
	}
	else
	{
		$id=0;
	
	}
		
	
	
	switch($task){
	case 'Spider_Faq_Categories':
		show_spider_cat();
		break;
		case "unpublish_Spider_Faq_Categories":
		$nonce_sp_faq = $_REQUEST['_wpnonce'];
		if (! wp_verify_nonce($nonce_sp_faq, 'nonce_sp_faq') )
		  die("Are you sure you want to do this?");
		change_spider_cat($id);		
		show_spider_cat();
		
		break;
	
	
	case 'add_Spider_Faq_Categories':
		add_spider_cat();
		break;
	
	
	case 'save':
	if($id)
	{	
	check_admin_referer('nonce_sp_faq', 'nonce_sp_faq');
	apply_spider_cat($id);
		
	}
	else
	{   check_admin_referer('nonce_sp_faq', 'nonce_sp_faq');
		save_spider_cat();
	}
		show_spider_cat();
		break;
			
	case 'apply':	
		if($id)	
		{
			check_admin_referer('nonce_sp_faq', 'nonce_sp_faq');
			apply_spider_cat($id);
		}
		else
		{
			check_admin_referer('nonce_sp_faq', 'nonce_sp_faq');
			save_spider_cat();
			$id=$wpdb->get_var("SELECT MAX(id) FROM ".$wpdb->prefix."spider_faq_category");
		}
		
		edit_spider_cat($id);
		break;	
		

		
	case 'edit_Spider_Faq_Categories':
		
        edit_spider_cat($id);
		
			
    		break;	
	


	
	case 'remove_Spider_Faq_Categories':
		$nonce_sp_faq = $_REQUEST['_wpnonce'];
		if (! wp_verify_nonce($nonce_sp_faq, 'nonce_sp_faq') )
		  die("Are you sure you want to do this?");
		remove_spider_cat($id);
		show_spider_cat();
		break;
			
	
		
		
			default:
			show_spider_cat();
			break;
	}
}



function Spider_Faq_Themes(){
global $wpdb;
	require_once("spider_faq_theme_functions.php");// add functions for player
	require_once("spider_faq_theme_functions.html.php");// add functions for vive player
	

	if(isset($_GET["task"])){
	$task=$_GET["task"];
	}
	else
	{
		$task="default";
	}
	if(isset($_GET["id"]))
	{
	
		$id=$_GET["id"];
		
	}
	else
	{
		$id=0;
	}
	
	
	switch($task){
	case 'Spider_Faq_Themes':
		show_spider_theme();
		break;
		

	
	case 'add_Spider_Faq_Themes':
		add_spider_theme();
		break;
	
	
	case 'save':
	if($id)
	{		
	apply_spider_theme($id);
		
	}
	else
	{
		save_spider_theme();
	}
		show_spider_theme();
		break;
			
	case 'apply':	
		if($id)	
		{
			
			apply_spider_theme($id);
		}
		else
		{
			
			save_spider_theme();
			$id=$wpdb->get_var("SELECT MAX(id) FROM ".$wpdb->prefix."spider_faq_theme");
		}
		
		edit_spider_theme($id);
		break;	
		


		
	case 'edit_Spider_Faq_Themes':
	
        edit_spider_theme($id);
    				
    		break;	
	


	
	case 'remove_Spider_Faq_Themes':
		remove_spider_theme($id);
		show_spider_theme();
		break;
			

			default:
			show_spider_theme();
			break;
	}
}





//////////////////////////////////////////////////////////////////////////actions for popup and xmls
require_once('functions_for_ajax_and_xml.php'); //include all functions for down call ajax
add_action('wp_ajax_spiderFaqselectfaq'			,   'spider_faq_select_faq');
add_action('wp_ajax_spiderFaqselectcategory' 	,     'spider_faq_select_category');
add_action('wp_ajax_spiderFaqselectstandcategory'	, 'spider_faq_select_standcategory');




function Uninstall_Spider_FAQ(){
global $wpdb;
$base_name = plugin_basename('Spider_Faq');
$base_page = 'admin.php?page='.$base_name;
$mode = "";


if(!empty($_POST['do'])) {

	if(esc_html($_POST['do'])=="UNINSTALL Spider FAQ") {
			check_admin_referer('Spider_Faq uninstall');
			if(trim($_POST['Spider_FAQ_yes']) == 'yes') {
				
				echo '<div id="message" class="updated fade">';
				echo '<p>';
				echo "Table 'spider_faq_question' has been deleted.";
				$wpdb->query("DROP TABLE ".$wpdb->prefix."spider_faq_question");
				echo '<font style="color:#000;">';
				echo '</font><br />';
				echo '</p>';
				echo '<p>';
				echo "Table 'spider_faq_category' has been deleted.";
				$wpdb->query("DROP TABLE ".$wpdb->prefix."spider_faq_category");
				echo '<font style="color:#000;">';
				echo '</font><br />';
				echo '</p>';
				echo "Table 'spider_faq_theme' has been deleted.";
				$wpdb->query("DROP TABLE ".$wpdb->prefix."spider_faq_theme");
				echo '<font style="color:#000;">';
				echo '</font><br />';
				echo '</p>';
                echo '<p>';
				echo "Table 'spider_faq_faq' has been deleted.";
				$wpdb->query("DROP TABLE ".$wpdb->prefix."spider_faq_faq");
				echo '<font style="color:#000;">';
				echo '</font><br />';
				echo '</p>';				
				echo '</div>'; 
				
				$mode = 'end-UNINSTALL';
			}
		}
    }



switch($mode) {
		case 'end-UNINSTALL':
			$deactivate_url = wp_nonce_url('plugins.php?action=deactivate&amp;plugin='.plugin_basename(__FILE__), 'deactivate-plugin_'.plugin_basename(__FILE__));
			echo '<div class="wrap">';
			echo '<h2>Uninstall Spider FAQ</h2>';
			echo '<p><strong>'.sprintf('<a href="%s">Click Here</a> To Finish The Uninstallation And Spider FAQ Will Be Deactivated Automatically.', $deactivate_url).'</strong></p>';
			echo '</div>';
			break;
	// Main Page
	default:
?>
<form method="post" action="<?php echo admin_url('admin.php?page=Uninstall_Spider_FAQ'); ?>">
<?php wp_nonce_field('Spider_Faq uninstall'); ?>
<div class="wrap">
	<div id="icon-Spider_Faq" class="icon32"><br /></div>
	<h2><?php echo 'Uninstall Spider FAQ'; ?></h2>
	<p>
		<?php echo 'Deactivating Spider FAQ plugin does not remove any data that may have been created. To completely remove this plugin, you can uninstall it here.'; ?>
	</p>
	<p style="color: red">
		<strong><?php echo 'WARNING:'; ?></strong><br />
		<?php echo 'Once uninstalled, this cannot be undone. You should use a Database Backup plugin of WordPress to back up all the data first.'; ?>
	</p>
	<p style="color: red">
		<strong><?php echo 'The following WordPress Options/Tables will be DELETED:'; ?></strong><br />
	</p>
	<table class="widefat">
		<thead>
			<tr>
				<th><?php echo 'WordPress Tables'; ?></th>
			</tr>
		</thead>
		<tr>
			<td valign="top">
				<ol>
				<?php
						echo '<li>spider_faq_faq</li>'."\n";
						echo '<li>spider_faq_question</li>'."\n";
						echo '<li>spider_faq_category</li>'."\n";
						echo '<li>spider_faq_theme</li>'."\n";
						
				?>
				</ol>
			</td>
		</tr>
	</table>
	<p style="text-align: center;">
		<?php echo 'Do you really want to uninstall Spider FAQ?'; ?><br /><br />
		<input type="checkbox" name="Spider_FAQ_yes" value="yes" />&nbsp;<?php echo 'Yes'; ?><br /><br />
		<input type="submit" name="do" value="<?php echo 'UNINSTALL Spider FAQ'; ?>" class="button-primary" onclick="return confirm('<?php echo 'You Are About To Uninstall Spider FAQ From WordPress.\nThis Action Is Not Reversible.\n\n Choose [Cancel] To Stop, [OK] To Uninstall.'; ?>')" />
	</p>
</div>
</form>
<?php
} // End switch($mode)	
}


function Spider_Faq_featured_plugins() {
  ?>
    <div id="main_featured_plugins_page">
      <table align="center" width="90%" style="margin-top: 0px;border-bottom: rgb(111, 111, 111) solid 2px;">
        <tr>
          <td colspan="2" style="height: 70px;"><h3 style="margin: 0px;font-family:Segoe UI;padding-bottom: 15px;color: rgb(111, 111, 111); font-size:18pt;">Featured Plugins</h3></td>
          <td></td>
        </tr>
      </table>
      <form method="post">
        <ul id="featured-plugins-list">
		  <li class="photo-gallery">
            <div class="product">
              <div class="title">
                <strong class="heading">Photo Gallery</strong>
                <p>WordPress Photo Gallery Plugin</p>
              </div>
            </div>
            <div class="description">
                <p>Photo Gallery is a fully responsive WordPress Gallery plugin with advanced functionality. 
				It allows having different image galleries for your posts and pages, as well as different widgets. </p>
                <a target="_blank" href="http://web-dorado.com/products/wordpress-photo-gallery-plugin.html" class="download">Download</a>
            </div>
          </li>
          <li class="form-maker">
            <div class="product">
              <div class="title">
                <strong class="heading">Form Maker</strong>
                <p>Wordpress form builder plugin</p>
              </div>
            </div>
            <div class="description">
                <p>Form Maker is a modern and advanced tool for creating WordPress forms easily and fast.</p>
                <a target="_blank" href="http://web-dorado.com/products/wordpress-form.html" class="download">Download</a>
            </div>
          </li>
          <li class="spider-calendar">
            <div class="product">
              <div class="title">
                <strong class="heading">Spider Calendar</strong>
                <p>WordPress event calendar plugin</p>
              </div>
            </div>
            <div class="description">
                <p>Spider Event Calendar is a highly configurable product which allows you to have multiple organized events.</p>
                <a target="_blank" href="http://web-dorado.com/products/wordpress-calendar.html" class="download">Download</a>
            </div>
          </li>
          <li class="catalog">
            <div class="product">
              <div class="title">
                <strong class="heading">Spider Catalog</strong>
                <p>WordPress product catalog plugin</p>
              </div>
            </div>
            <div class="description">
                <p>Spider Catalog for WordPress is a convenient tool for organizing the products represented on your website into catalogs.</p>
                <a target="_blank" href="http://web-dorado.com/products/wordpress-catalog.html" class="download">Download</a>
            </div>
          </li>
          <li class="player">
            <div class="product">
              <div class="title">
                <strong class="heading">Video Player</strong>
                <p>WordPress Video player plugin</p>
              </div>
            </div>
            <div class="description">
                <p>Spider Video Player for WordPress is a Flash & HTML5 video player plugin that allows you to easily add videos to your website with the possibility</p>
                <a target="_blank" href="http://web-dorado.com/products/wordpress-player.html" class="download">Download</a>
            </div>
          </li>
          <li class="contacts">
            <div class="product">
              <div class="title">
                <strong class="heading">Spider Contacts</strong>
                <p>Wordpress staff list plugin</p>
              </div>
            </div>
            <div class="description">
                <p>Spider Contacts helps you to display information about the group of people more intelligible, effective and convenient.</p>
                <a target="_blank" href="http://web-dorado.com/products/wordpress-contacts-plugin.html" class="download">Download</a>
            </div>
          </li>
          <li class="facebook">
            <div class="product">
              <div class="title">
                <strong class="heading">Spider Facebook</strong>
                <p>WordPress Facebook plugin</p>
              </div>
            </div>
            <div class="description">
                <p>Spider Facebook is a WordPress integration tool for Facebook.It includes all the available Facebook social plugins and widgets to be added to your web</p>
                <a target="_blank" href="http://web-dorado.com/products/wordpress-facebook.html" class="download">Download</a>
            </div>
          </li>
          <li class="zoom">
            <div class="product">
              <div class="title">
                <strong class="heading">Zoom</strong>
                <p>WordPress text zoom plugin</p>
              </div>
            </div>
            <div class="description">
                <p>Zoom enables site users to resize the predefined areas of the web site.</p>
                <a target="_blank" href="http://web-dorado.com/products/wordpress-zoom.html" class="download">Download</a>
            </div>
          </li>
          <li class="flash-calendar">
            <div class="product">
              <div class="title">
                <strong class="heading">Flash Calendar</strong>
                <p>WordPress flash calendar plugin</p>
              </div>
            </div>
            <div class="description">
                <p>Spider Flash Calendar is a highly configurable Flash calendar plugin which allows you to have multiple organized events.</p>
                <a target="_blank" href="http://web-dorado.com/products/wordpress-events-calendar.html" class="download">Download</a>
            </div>
          </li>
        </ul>
      </form>
    </div >
    <?php
}


function add_faq_column() {

    global $wpdb;
	$exists_numbertext = 0;
    $exists_like = 0;
    $exists_hits = 0;
	$exists_date = 0;
    $exists_user = 0;
	
	
	$form_properties = $wpdb->get_results("DESCRIBE " . $wpdb->prefix . "spider_faq_faq", ARRAY_A);

	foreach ($form_properties as $prop) {
	        if ($prop['Field'] == 'numbertext')
			  $exists_numbertext = 1;
			if ($prop['Field'] == 'like')
			  $exists_like = 1;
			if ($prop['Field'] == 'hits')
			  $exists_hits = 1;
			if ($prop['Field'] == 'date') 
			  $exists_date = 1;
			if ($prop['Field'] == 'user')
			  $exists_user = 1;
			}
	  if (!$exists_numbertext) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_faq ADD `numbertext` int(11) NOT NULL AFTER `expand`");
      }		
	  if (!$exists_like) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_faq ADD `like` int(11) NOT NULL AFTER `numbertext`");
      }
      if (!$exists_hits) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_faq ADD `hits` int(11) NOT NULL AFTER `like`");
      }
	  if (!$exists_date) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_faq ADD `date` text NOT NULL AFTER `hits`");
      }  	
      if (!$exists_user) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_faq ADD `user` longtext NOT NULL AFTER `date`");
      }	
}



function add_question_column() {

    global $wpdb;
    $exists_like = 0;
    $exists_unlike = 0;
    $exists_hits = 0;
    $exists_user_name = 0;
    $exists_date = 0;
	
	$form_properties = $wpdb->get_results("DESCRIBE " . $wpdb->prefix . "spider_faq_question", ARRAY_A);

	foreach ($form_properties as $prop) {
			if ($prop['Field'] == 'like')
			  $exists_like = 1;
			if ($prop['Field'] == 'unlike')
			  $exists_unlike = 1;
			if ($prop['Field'] == 'hits')
			  $exists_hits = 1;
			if ($prop['Field'] == 'user_name')
			  $exists_user_name = 1;
            if ($prop['Field'] == 'date') 
			  $exists_date = 1;
			}

	  if (!$exists_like) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_question ADD `like` int(11) NOT NULL AFTER `published`");
      }
      if (!$exists_unlike) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_question ADD `unlike` int(11) NOT NULL AFTER `like`");
      }
      if (!$exists_hits) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_question ADD `hits` int(11) NOT NULL AFTER `unlike`");
      }
      if (!$exists_user_name) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_question ADD `user_name` longtext NOT NULL AFTER `hits`");
      }
      if (!$exists_date) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_question ADD `date` text NOT NULL AFTER `user_name`");
      }  		
}


function add_theme_column() {
    global $wpdb;	
	global $truefalse;
	
    $exists_dwidth = 0;
    $exists_dheight = 0;
    $exists_dlikehitswidth = 0;
    $exists_dlikehitsmargin = 0;
    $exists_dmarginleft = 0; 
	$exists_dbordertopstyle = 0;
	$exists_dborderbottomstyle = 0;
    $exists_dbackgroundcolor = 0;
    $exists_dborderstyle = 0;
    $exists_dborderwidth = 0;
    $exists_dbordercolor = 0;
	$exists_dbordercornerradius = 0;
    $exists_dtextcolor = 0;
    $exists_dlikehitsbgcolor = 0;
    $exists_dlikehitsbdrst = 0;
    $exists_dlikehitsbdrtst = 0;
	$exists_dlikehitsbdrw = 0;
    $exists_dlikehitsbdrc = 0;
    $exists_dlikehitsbdrrad = 0;
    $exists_dlikehitstxtcl = 0;
    $exists_apadd = 0;
	$exists_dlikehitsbdrbst = 0;
    $exists_numbering = 0;
    $exists_ansmarginleft = 0;
    $exists_imgpos = 0;
    $exists_answidth = 0;
	$exists_ikncol = 0;
    $exists_numberfnts = 0;
    $exists_numbercl = 0;
    $exists_tbtopstyle = 0;
    $exists_tbrightstyle = 0;
	$exists_abrightstyle = 0;
    $exists_default = 0;
	
	
	$form_properties = $wpdb->get_results("DESCRIBE " . $wpdb->prefix . "spider_faq_theme", ARRAY_A);

	foreach ($form_properties as $prop) {
			if ($prop['Field'] == 'dwidth')
			  $exists_dwidth = 1;
			if ($prop['Field'] == 'dheight')
			  $exists_dheight = 1;
			if ($prop['Field'] == 'dlikehitswidth')
			  $exists_dlikehitswidth = 1;
			if ($prop['Field'] == 'dlikehitsmargin')
			  $exists_dlikehitsmargin = 1;
			if ($prop['Field'] == 'dmarginleft')
			  $exists_dmarginleft = 1;  
            if ($prop['Field'] == 'dbordertopstyle') 
			  $exists_dbordertopstyle = 1;
            if ($prop['Field'] == 'dborderbottomstyle')
			  $exists_dborderbottomstyle = 1;
			if ($prop['Field'] == 'dbackgroundcolor')
			  $exists_dbackgroundcolor = 1;
			if ($prop['Field'] == 'dborderstyle')
			  $exists_dborderstyle = 1;
			if ($prop['Field'] == 'dborderwidth')
			  $exists_dborderwidth = 1;
            if ($prop['Field'] == 'dbordercolor')
			  $exists_dbordercolor = 1;
			if ($prop['Field'] == 'dbordercornerradius')
			  $exists_dbordercornerradius = 1;
			if ($prop['Field'] == 'dtextcolor')
			  $exists_dtextcolor = 1;
			if ($prop['Field'] == 'dlikehitsbgcolor')
			  $exists_dlikehitsbgcolor = 1;
			if ($prop['Field'] == 'dlikehitsbdrst')
			  $exists_dlikehitsbdrst = 1;
            if ($prop['Field'] == 'dlikehitsbdrtst') 
			  $exists_dlikehitsbdrtst = 1;
			if ($prop['Field'] == 'dlikehitsbdrw') 
			  $exists_dlikehitsbdrw = 1;
			if ($prop['Field'] == 'dlikehitsbdrc') 
			  $exists_dlikehitsbdrc = 1;
			if ($prop['Field'] == 'dlikehitsbdrrad') 
			  $exists_dlikehitsbdrrad = 1;
			if ($prop['Field'] == 'dlikehitstxtcl') 
			  $exists_dlikehitstxtcl = 1; 
			if ($prop['Field'] == 'apadd') 
			  $exists_apadd = 1;  
			if ($prop['Field'] == 'dlikehitsbdrbst')
			  $exists_dlikehitsbdrbst = 1;
			if ($prop['Field'] == 'numbering') 
			  $exists_numbering = 1;
			if ($prop['Field'] == 'ansmarginleft') 
			  $exists_ansmarginleft = 1;
			if ($prop['Field'] == 'imgpos') 
			  $exists_imgpos = 1;
			if ($prop['Field'] == 'answidth') 
			  $exists_answidth = 1;
			if ($prop['Field'] == 'ikncol') 
			  $exists_ikncol = 1;
			if ($prop['Field'] == 'numberfnts') 
			  $exists_numberfnts = 1;
			if ($prop['Field'] == 'numbercl') 
			  $exists_numbercl = 1;
			if ($prop['Field'] == 'tbtopstyle') 
			  $exists_tbtopstyle = 1;
			if ($prop['Field'] == 'tbrightstyle') 
			  $exists_tbrightstyle = 1;
			if ($prop['Field'] == 'abrightstyle') 
			  $exists_abrightstyle = 1;
			if ($prop['Field'] == 'default') 
			  $exists_default = 1;
		}
		
	  if (!$exists_dwidth) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dwidth` varchar(200) NOT NULL AFTER `rmfontsize`");
      }
      if (!$exists_dheight) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dheight` varchar(200) NOT NULL AFTER `dwidth`");
      }
      if (!$exists_dlikehitswidth) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dlikehitswidth` varchar(200) NOT NULL AFTER `dheight`");
      }
      if (!$exists_dlikehitsmargin) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dlikehitsmargin` varchar(200) NOT NULL AFTER `dlikehitswidth`");
      }
      if (!$exists_dmarginleft) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dmarginleft` varchar(200) NOT NULL AFTER `dlikehitsmargin`");
      }
      if (!$exists_dbordertopstyle) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dbordertopstyle` varchar(200) NOT NULL AFTER `dmarginleft`");
      }
      if (!$exists_dborderbottomstyle) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dborderbottomstyle` varchar(200) NOT NULL AFTER `dbordertopstyle`");
      }
	  if (!$exists_dbackgroundcolor) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dbackgroundcolor` text NOT NULL AFTER `dborderbottomstyle`");
      }
      if (!$exists_dborderstyle) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dborderstyle` varchar(200) NOT NULL AFTER `dbackgroundcolor`");
      }
	  if (!$exists_dborderwidth) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dborderwidth` varchar(200) NOT NULL AFTER `dborderstyle`");
      }
 	  if (!$exists_dbordercolor) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dbordercolor` text NOT NULL AFTER `dborderwidth`");
      }
	  if (!$exists_dbordercornerradius) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dbordercornerradius` varchar(200) NOT NULL AFTER `dbordercolor`");
      }
	  if (!$exists_dtextcolor) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dtextcolor` text NOT NULL AFTER `dbordercornerradius`");
      }
	  if (!$exists_dlikehitsbgcolor) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dlikehitsbgcolor` text NOT NULL AFTER `dtextcolor`");
      }
	  if (!$exists_dlikehitsbdrst) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dlikehitsbdrst` text NOT NULL AFTER `dlikehitsbgcolor`");
      }
	  if (!$exists_dlikehitsbdrtst) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dlikehitsbdrtst` text NOT NULL AFTER `dlikehitsbdrst`");
      }
	  if (!$exists_dlikehitsbdrw) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dlikehitsbdrw` text NOT NULL AFTER `dlikehitsbdrtst`");
      }
	  if (!$exists_dlikehitsbdrc) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dlikehitsbdrc` text NOT NULL AFTER `dlikehitsbdrw`");
      }
	  if (!$exists_dlikehitsbdrrad) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dlikehitsbdrrad` text NOT NULL AFTER `dlikehitsbdrc`");
      }
	  if (!$exists_dlikehitstxtcl) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dlikehitstxtcl` text NOT NULL AFTER `dlikehitsbdrrad`");
      }
	  if (!$exists_apadd) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `apadd` text NOT NULL AFTER `dlikehitstxtcl`");
      }
	  if (!$exists_dlikehitsbdrbst) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `dlikehitsbdrbst` text NOT NULL AFTER `apadd`");
      }
	  if (!$exists_numbering) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `numbering` tinyint(2) NOT NULL AFTER `dlikehitsbdrbst`");
      }
	  if (!$exists_ansmarginleft) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `ansmarginleft` text NOT NULL AFTER `numbering`");
      }
	  if (!$exists_imgpos) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `imgpos` tinyint(2) NOT NULL AFTER `ansmarginleft`");
      }
	  if (!$exists_answidth) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `answidth` text NOT NULL AFTER `imgpos`");
      }
	  if (!$exists_ikncol) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `ikncol` tinyint(2) NOT NULL AFTER `answidth`");
      }
	  if (!$exists_numberfnts) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `numberfnts` text NOT NULL AFTER `ikncol`");
      }
	  if (!$exists_numbercl) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `numbercl` text NOT NULL AFTER `numberfnts`");
      }
	  if (!$exists_tbtopstyle) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `tbtopstyle` text NOT NULL AFTER `numbercl`");
      }
	  if (!$exists_tbrightstyle) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `tbrightstyle` text NOT NULL AFTER `tbtopstyle`");
      }
	  if (!$exists_abrightstyle) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `abrightstyle` text NOT NULL AFTER `tbrightstyle`");
      }
	  if (!$exists_default) {
        $wpdb->query("ALTER TABLE " . $wpdb->prefix . "spider_faq_theme ADD `default` tinyint(2) NOT NULL AFTER `abrightstyle`");
        $truefalse=true;
      }
}


function Spider_FAQ_activate() {
global $wpdb;
global $truefalse;

$truefalse = false;

$sql_faq="CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."spider_faq_faq` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `title` text NOT NULL,
   `standcat` tinyint(1) NOT NULL,
   `category`  varchar(255) NOT NULL,
   `standcategory`  varchar(255) NOT NULL, 
   `theme` varchar(255) NOT NULL,
   `show_searchform` tinyint(1) NOT NULL,
   `expand` tinyint(1) NOT NULL,
   PRIMARY KEY (`id`)
 ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

$sql_question="CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."spider_faq_question` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `title` text NOT NULL,
   `category` int(11) NOT NULL,
   `article` longtext NOT NULL,
   `fullarticle` longtext NOT NULL,
   `ordering` int(11) NOT NULL, 
   `published` tinyint(1) NOT NULL,
   PRIMARY KEY  (`id`)
 ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";


$sql_category="CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."spider_faq_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `show_title` tinyint(1) NOT NULL,
  `show_description` tinyint(1) NOT NULL,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";



$sql_theme="CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."spider_faq_theme` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `background` tinyint(2) NOT NULL,
  `bgimage` varchar(200) NOT NULL,
  `bgcolor` text NOT NULL,
  `width` varchar(200) NOT NULL,
  `ctbg` tinyint(1) NOT NULL,
  `ctbggrad` tinyint(1) NOT NULL,
  `ctbgcolor` text NOT NULL,
  `ctgradtype` varchar(200) NOT NULL,
  `ctgradcolor1` text NOT NULL,
  `ctgradcolor2` text NOT NULL,
  `cttxtcolor` text NOT NULL,
  `ctfontsize` varchar(200) NOT NULL,
  `ctmargin` varchar(200) NOT NULL,
  `ctpadding` varchar(200) NOT NULL,
  `ctbstyle` text NOT NULL,
  `ctbwidth` varchar(200) NOT NULL,
  `ctbcolor` text NOT NULL,
  `ctbradius` varchar(200) NOT NULL,
  `cdbg` tinyint(1) NOT NULL,
  `cdbggrad` tinyint(1) NOT NULL,
  `cdbgcolor` text NOT NULL,
  `cdgradtype` varchar(200) NOT NULL,
  `cdgradcolor1` text NOT NULL,
  `cdgradcolor2` text NOT NULL,
  `cdtxtcolor` text NOT NULL,
  `cdfontsize` varchar(200) NOT NULL,
  `cdmargin` varchar(200) NOT NULL,
  `cdpadding` varchar(200) NOT NULL,
  `cdbstyle` varchar(200) NOT NULL,
  `cdbwidth` varchar(200) NOT NULL,
  `cdbcolor` text NOT NULL,
  `cdbradius` varchar(200) NOT NULL,
  `paddingbq` varchar(200) NOT NULL,
  `marginleft` varchar(200) NOT NULL,
  `theight` varchar(200) NOT NULL,
  `twidth` varchar(200) NOT NULL,
  `tfontsize` varchar(200) NOT NULL,
  `ttxtwidth` varchar(200) NOT NULL,
  `ttxtpleft` varchar(200) NOT NULL,
  `tcolor` text NOT NULL,
  `titlebg` tinyint(1) NOT NULL,
  `tbgcolor` text NOT NULL,
  `tbgimage` varchar(200) NOT NULL,
  `titlebggrad` tinyint(1) NOT NULL,
  `gradtype` varchar(200) NOT NULL,
  `gradcolor1` text NOT NULL,
  `gradcolor2` text NOT NULL,
  `tbghovercolor` text NOT NULL,
  `tbgsize` varchar(200) NOT NULL,
  `tbstyle` varchar(200) NOT NULL,
  `tbwidth` varchar(200) NOT NULL,
  `tbcolor` text NOT NULL,
  `tbradius` varchar(200) NOT NULL,
  `tchangeimage1` varchar(200) NOT NULL,
  `marginlimage1` varchar(200) NOT NULL,
  `tchangeimage2` varchar(200) NOT NULL,
  `marginlimage2` varchar(200) NOT NULL,
  `awidth` varchar(200) NOT NULL,
  `amargin` varchar(200) NOT NULL,
  `afontsize` varchar(200) NOT NULL,
  `abg` tinyint(1) NOT NULL,
  `abgcolor` text NOT NULL,
  `abgimage` varchar(200) NOT NULL,
  `abgsize` varchar(200) NOT NULL,
  `abstyle` varchar(200) NOT NULL,
  `abwidth` varchar(200) NOT NULL,
  `abcolor` text NOT NULL,
  `abradius` varchar(200) NOT NULL,
  `aimage` varchar(200) NOT NULL,
  `aimage2` varchar(200) NOT NULL,
  `aimagewidth` varchar(200) NOT NULL,
  `aimageheight` varchar(200) NOT NULL,
  `amarginimage` varchar(200) NOT NULL,
  `aimagewidth2` varchar(200) NOT NULL,
  `aimageheight2` varchar(200) NOT NULL,
  `amarginimage2` varchar(200) NOT NULL,
  `atxtcolor` text NOT NULL,
  `expcolcolor` text NOT NULL,
  `expcolfontsize` varchar(200) NOT NULL,
  `expcolmargin` varchar(200) NOT NULL,
  `expcolhovercolor` text NOT NULL,
  `sformmargin` varchar(200) NOT NULL,
  `sboxwidth` varchar(200) NOT NULL,
  `sboxheight` varchar(200) NOT NULL,
  `sboxbg` tinyint(1) NOT NULL,
  `sboxbgcolor` text NOT NULL,
  `sboxbstyle` text NOT NULL,
  `sboxbwidth` varchar(200) NOT NULL,
  `sboxbcolor` text NOT NULL,
  `sboxfontsize` varchar(200) NOT NULL,
  `sboxtcolor` text NOT NULL,
  `srwidth` varchar(200) NOT NULL,
  `srheight` varchar(200) NOT NULL,
  `srbg` tinyint(1) NOT NULL,
  `srbgcolor` text NOT NULL,
  `srbstyle` text NOT NULL,
  `srbwidth` varchar(200) NOT NULL,
  `srbcolor` text NOT NULL,
  `srfontsize` varchar(200) NOT NULL,
  `srfontweight` varchar(200) NOT NULL,
  `srtcolor` text NOT NULL,
  `rmcolor` text NOT NULL,
  `rmhovercolor` text NOT NULL,
  `rmfontsize` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ";


$post_right_content = "CREATE TABLE IF NOT EXISTS`".$wpdb->prefix."post_right_content` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
	`like` int(11) NOT NULL,
	`unlike` int(11) NOT NULL,
	`hits` int(11) NOT NULL,
     PRIMARY KEY (`id`)
  )ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
 


$wpdb->query($sql_faq);
$wpdb->query($sql_question);
$wpdb->query($sql_category);
$wpdb->query($sql_theme);
$wpdb->query($post_right_content);


$id=$wpdb->get_var("SELECT MAX(id) FROM ".$wpdb->prefix."spider_faq_theme");

if(!$id or  $id <17) {
$table_name=$wpdb->prefix."spider_faq_theme";
$sql_theme1="INSERT INTO `".$table_name."` VALUES(1, 'White', 2, '', 'FFFFFF', '600', 1, 1, '44A9CF', 'top', '44A9CF', '54DDFF', 'FFFFFF', '20', '0 60 0 0', '9 20 12', 'solid', '2', 'E0E0E0', '2', 1, 0, 'C4C4C4', 'top', 'FFFFFF', 'FFFFFF', '000000', '12', '10 90 12 21', '4 8', 'double', '3', 'FFFFFF', '2', '', '', '30', '512', '14', '', '6', '000000', 0, 'FFFFFF', '', 0, 'top', 'FFFFFF', 'FFFFFF', 'EDEAD8', '100%', 'solid', '1', 'C7C7C7', '4', '', '', '', '', '513', '0 15 25', '13', 0, 'FFFFFF', '', '', 'none', '', 'FFFFFF', '', '', '".plugins_url("upload/style1/style1a.png",__FILE__)."', '', '', '', '512', '5', '', '44A9CF', '000000', '14', '12 60 18 0', '8F8F8F', '0 60 12 0', '300', '25', 0, 'EBEBEB', 'solid', '2', 'A6A6A6', '12', '000000', '60', '30', 0, 'FFFFFF', 'solid', '2', '828282', '14', '', '000000', '000000', '9E9E9E', '12')";
$sql_theme2="INSERT INTO `".$table_name."` VALUES(2, 'Cyan', 2, '', 'FFFFFF', '600', 1, 0, '242424', 'top', 'FFFFFF', 'FFFFFF', 'FFFFFF', '20', '0 60 10 8', '10 15 8 ', 'solid', '2', '5EBDB0', '', 0, 0, 'FFFFFF', 'top', 'FFFFFF', 'FFFFFF', '212121', '13', '10 90 14 30', '6', 'dashed', '2', '5EBDB0', '', '1', '4', '35', '510', '14', '', '5', '2B2727', 0, '70E0D1', '', 0, 'top', 'FFFFFF', 'FFFFFF', 'FFFFFF', '100% 100%', 'outset', '1', 'ABABAB', '3', '', '', '', '', '511', '0 8 24', '13', 0, '70E0D1', '', '', 'none', '', 'FFFFFF', '', '', '', '', '', '', '', '', '', '2B2727', '000000', '16', '12 60 18 0', '58B0A4', '0 60 12 0', '220', '25', 1, 'EBEBEB', 'solid', '2', '5EBDB0', '14', 'FFFFFF', '70', '28', 1, '242424', 'solid', '2', '5EBDB0', '14', 'bold', 'FFFFFF', '000000', '9E9E9E', '12')";
$sql_theme3="INSERT INTO `".$table_name."` VALUES(3, 'Green Gradient', 2, '', 'FFFFFF', '600', 1, 1, 'BDBDBD', 'top', 'B3B3B3', 'DEDEDE', '000000', '18', '8 60 0 2', '9 6 12', 'outset', '2', '20BD1A', '', 0, 0, 'FFFFFF', 'top', 'FFFFFF', 'FFFFFF', '000000', '12', '12 87 18 28', '4 6', 'double', '3', 'C7C7C7', '', '', '', '25', '520', '14', '', '6', 'FFFFFF', 0, 'CCCCCC', '', 1, 'top', '20BD1A', '6FCF46', 'B5B5B5', '100% 100%', 'solid', '2', '6B9999', '2', '', '', '', '', '520', '', '12', 0, 'C2C2C2', '', '100% 100%', 'solid', '2', '6B9999', '', '', '', '', '', '', '', '', '', '000000', '315221', '14', '12 60 18 0', '9E9E9E', '0 60 12 0', '220', '25', 0, 'EBEBEB', 'solid', '3', '6BB347', '14', '000000', '75', '27', 1, '6BB347', 'solid', '2', 'C9C9C9', '', '', 'FFFFFF', '1EB319', 'CFCFCF', '12')";
$sql_theme4="INSERT INTO `".$table_name."` VALUES(4, 'Black & Gold', 2, '', 'FFFFFF', '600', 1, 1, 'FFFFFF', 'top', '000000', '3D3D3D', 'FFFFFF', '18', '5 59 20 3', '9 4 12 ', 'outset', '2', 'F5A403', '6', 1, 0, 'FFBE3B', 'top', 'FFFFFF', 'FFFFFF', '000000', '14', '8 90 30 30', '4 6', 'groove', '1', '828282', '12', '', '', '30', '520', '14', '', '6', 'F5A403', 0, 'CCCCCC', '', 1, 'top', '000000', '242424', 'FFFFFF', '100% 100%', 'outset', '1', '878787', '4', '', '', '', '', '521', '', '12', 0, 'ADADAD', '', '', 'none', '', 'FFFFFF', '', '', '', '', '', '', '', '', '', 'FFFFFF', '000000', '14', '12 60 18 0', 'CCCCCC', '0 60 14 0', '220', '25', 1, 'EBEBEB', 'solid', '2', 'F5A403', '14', 'FFFFFF', '70', '25', 1, '0F0F0F', 'solid', '2', 'F5A403', '', '', 'FFFFFF', 'F5A403', '919191', '12')";
$sql_theme5="INSERT INTO `".$table_name."` VALUES(5, 'Light Blue', 2, '', 'FFFFFF', '600', 1, 0, 'D7EBF9', 'top', 'FFFFFF', 'FFFFFF', '000000', '18', '0 60 0 0', '6', 'outset', '2', 'AED0EA', '2', 0, 0, 'FFFFFF', 'top', 'FFFFFF', 'FFFFFF', '23376E', '14', '10 60 14 30', '6', 'solid', '1', 'CFCFCF', '5', '', '', '30', '520', '14', '', '6', '2779B1', 0, 'D7EBF9', '', 0, 'top', '00FFCC', '636363', 'EEF6FC', '', 'solid', '1', 'AED0EA', '3', '', '', '', '', '520', '', '12', 0, 'F9FAFB', '', '', 'solid', '1', 'D6D6D6', '2', '', '', '', '', '', '', '', '', '000000', '2779B1', '14', '12 60 18 0', '36DDFF', '0 60 12 0', '220', '25', 1, 'EBEBEB', 'solid', '2', '2779B1', '14', '000000', '70', '30', 1, 'D7EBF9', 'solid', '1', '2779B1', '', '', '2779B1', '6699CC', '000000', '12')";
$sql_theme6="INSERT INTO `".$table_name."` VALUES(6, 'Black', 2, '', 'FFFFFF', '600', 1, 1, 'FFFFFF', 'circle', '008BE8', '00498F', 'FFFFFF', '18', '0 60 0 0', '10 4', 'outset', '2', 'CCCCCC', '2', 1, 0, '5C5C5C', 'top', 'FFFFFF', 'FFFFFF', 'FFFFFF', '14', '10 60 18 30', '4 6', 'solid', '1', '008BE8', '12', '', '', '30', '520', '14', '', '6', 'FFFFFF', 0, '474747', '', 1, 'circle', '242424', '474747', '00498F', '', 'none', '', 'FFFFFF', '4', '', '', '', '', '520', '', '12', 0, '141414', '', '', 'none', '', 'FFFFFF', '', '', '', '', '', '', '', '', '', 'FFFFFF', '00498F', '14', '12 60 18 0', '4F4F4F', '0 60 14 0', '220', '25', 1, 'EBEBEB', 'ridge', '2', '00498F', '14', 'FFFFFF', '70', '25', 1, '303030', 'ridge', '1', '00498F', '', '', 'FFFFFF', 'FFFFFF', '00498F', '12')";
$sql_theme7="INSERT INTO `".$table_name."` VALUES(7, 'Blue', 2, '', 'FFFFFF', '600', 1, 0, 'A3DFE3', 'top', 'FFFFFF', 'FFFFFF', '080808', '18', '0 60 0 0', '8 6', 'outset', '2', 'E59600', '2', 1, 0, 'E59600', 'top', 'FFFFFF', 'FFFFFF', 'FCFCFC', '14', '10 78 12 22', '4 6', 'solid', '1', '59FFFF', '20', '', '', '30', '520', '14', '', '6', 'FFFFFF', 0, '1283E5', '', 1, 'circle', '1283E5', '2D90E8', 'E59600', '100% 100%', 'solid', '1', 'FFFFFF', '6', '', '', '', '', '518', '', '12', 0, 'EEEEEE', '', '100% 100%', 'solid', '1', 'BABABA', '6', '', '', '', '', '', '', '', '', '000000', '2D90E8', '14', '10 60 14 0', '878787', '0 60 14 0', '220', '25', 1, 'EBEBEB', 'solid', '2', 'E59600', '14', 'FFFFFF', '70', '25', 1, '1283E5', 'solid', '2', 'E59600', '', '', 'FFFFFF', '2D90E8', '6E6E6E', '12')";
$sql_theme8="INSERT INTO `".$table_name."` VALUES(8, 'Black & Green', 2, '', 'FFFFFF', '600', 1, 0, 'FFFFFF', 'top', 'FFFFFF', 'FFFFFF', '000000', '18', '0 60 0 2', '8 4 10', 'outset', '1', '9BCC60', '4', 0, 0, 'FFFFFF', 'top', 'FFFFFF', 'FFFFFF', '000000', '14', '10 85 12 35', '4 6', 'solid', '1', '616161', '12', '', '', '30', '520', '14', '', '6', '9BCC60', 0, 'CCCCCC', '', 1, 'top', '312C24', '262017', '50443A', '100% 100%', 'solid', '2', 'FFFFFF', '4', '', '', '', '', '520', '', '12', 0, '50443A', '', '', 'solid', '2', 'FFFFFF', '4', '', '', '', '', '', '', '', '', 'FFFFFF', '000000', '14', '12 60 11 0', '878787', '0 60 14 0', '220', '25', 1, 'EBEBEB', 'solid', '2', '9BCC60', '14', 'FFFFFF', '70', '27', 1, '312C24', 'solid', '2', '9BCC60', '', '', 'FFFFFF', '9BCC60', 'D9D9D9', '12')";
$sql_theme9="INSERT INTO `".$table_name."` VALUES(9, 'Grey', 2, '', 'FFFFFF', '600', 0, 0, 'FFFFFF', 'top', 'FFFFFF', 'FFFFFF', '000000', '18', '0 60 0 4', '8 4 6', 'none', '', 'FFFFFF', '', 1, 0, 'FFFFFF', 'top', 'FFFFFF', 'FFFFFF', '000000', '13', '10 80 14 20', '4 6', 'dashed', '1', 'BABABA', '', '', '', '30', '520', '14', '', '6', 'FFFFFF', 0, '8390A0', '', 0, 'top', 'FFFFFF', 'FFFFFF', '384454', '', 'none', '', 'FFFFFF', '4', '', '', '', '', '520', '', '12', 0, '384454', '', '', 'none', '', 'FFFFFF', '4', '', '', '', '', '', '', '', '', 'FFFFFF', '000000', '14', '8 60 14 0', 'CCCCCC', '0 60 14 0', '220', '25', 0, 'EBEBEB', 'solid', '2', '000000', '14', '000000', '70', '27', 0, 'FFFFFF', 'solid', '2', '000000', '', '', '000000', 'FFFFFF', '6E6E6E', '12')";
$sql_theme10="INSERT INTO `".$table_name."` VALUES(10, 'Tomato', 2, '', 'FFFFFF', '600', 1, 1, '434544', 'top', '262626', '757575', 'FFFFFF', '18', '0 60 0 4', '8 4', 'none', '', 'FFFFFF', '8', 1, 0, 'D9D9D9', 'top', 'FFFFFF', 'FFFFFF', '000000', '14', '10 60 14 35', '4 6', 'solid', '1', 'B5B5B5', '5', '', '', '30', '520', '14', '', '6', 'FFFFFF', 0, 'C44F45', '', 0, 'top', 'FFFFFF', 'FFFFFF', '7C7E7D', '100% 100%', 'solid', '1', 'A1A1A1', '5', '', '', '', '', '520', '', '12', 0, 'D9D4CE', '', '', 'solid', '1', 'A1A1A1', '5', '', '', '', '', '', '', '', '', '000000', '000000', '14', '10 60 14 0', 'CCCCCC', '0 60 16 0', '220', '25', 1, 'EBEBEB', 'solid', '2', 'C44F45', '14', '000000', '70', '27', 1, 'FFFFFF', 'solid', '2', 'C44F45', '', '', '000000', 'C44F45', 'E6E6E6', '12')";
$sql_theme11="INSERT INTO `".$table_name."` VALUES(11, 'Green', 2, '', 'FFFFFF', '600', 1, 1, 'FFFFFF', 'top', '12FFDA', '0FD1B3', 'FFFFFF', '18', '0 60 0 0', '8 4', 'groove', '1', '0A8E79', '8', 1, 0, 'FFB969', 'top', 'FFFFFF', 'FFFFFF', '000000', '14', '10 60 14 35', '5 7', 'outset', '1', 'A6A6A6', '12', '', '', '30', '520', '14', '', '6', 'FFFFFF', 0, '0A8E79', '', 0, 'top', 'FFFFFF', 'FFFFFF', '0EC9AC', '', 'none', '', 'FFFFFF', '5', '', '', '', '', '518', '', '12', 0, 'EDEDED', '', '100% 100%', 'solid', '1', 'A6A6A6', '5', '', '', '', '', '', '', '', '', '000000', '000000', '14', '10 60 14 0', 'A1A1A1', '0 60 16 0', '220', '25', 1, 'EBEBEB', 'solid', '2', '087362', '14', 'FFFFFF', '70', '27', 1, '0EC9AC', 'solid', '2', '087362', '', '', 'FFFFFF', '087362', 'C9C9C9', '12')";
$sql_theme12="INSERT INTO `".$table_name."` VALUES(12, 'Yellow', 2, '', 'FFFFFF', '600', 0, 0, 'FFFFFF', 'top', 'FFFFFF', 'FFFFFF', '000000', '18', '0 60 0 4', '10 4 8', 'solid', '1', '000000', '12', 1, 0, 'DEDCD9', 'top', 'FFFFFF', 'FFFFFF', '000000', '13', '10 60 14 4', '5 8', 'groove', '1', 'CCCCCC', '20', '', '', '30', '520', '14', '', '8', '000000', 0, 'FEE000', '', 0, 'top', 'FFFFFF', 'FFFFFF', 'FFFFFF', '100% 100%', 'solid', '1', '737373', '12', '', '', '', '', '520', '', '12', 0, 'F2F2F2', '', '100% 100%', 'solid', '1', 'B3B3B3', '12', '', '', '', '', '', '', '', '', '000000', '000000', '14', '12 60 18 0', 'CCCCCC', '0 60 14 0', '220', '25', 0, 'EBEBEB', 'solid', '2', '000000', '14', '000000', '70', '27', 0, 'FFFFFF', 'solid', '2', '000000', '', '', '000000', '000000', '919191', '12')";
$sql_theme13="INSERT INTO `".$table_name."` VALUES(13, 'White & Blue', 2, '', 'FFFFFF', '600', 0, 0, 'FFFFFF', 'top', 'FFFFFF', 'FFFFFF', '000000', '18', '0 60 0 4', '8 4 10', 'groove', '2', '3BCBFF', '12', 1, 0, 'E6E6E6', 'top', 'FFFFFF', 'FFFFFF', '000000', '14', '12 100 14 40', '4 6', 'dotted', '1', '595959', '12', '', '', '30', '520', '14', '', '8', '000000', 0, 'F5F5F5', '', 0, 'top', 'FFFFFF', 'FFFFFF', '3BCBFF', '100% 100%', 'outset', '1', 'C7C7C7', '14', '', '', '', '', '520', '', '12', 0, 'FFFFFF', '', '100% 100%', 'outset', '1', 'C7C7C7', '14', '', '', '', '', '', '', '', '', '000000', '000000', '14', '10 60 14 0', 'CCCCCC', '0 60 16 0', '220', '25', 0, 'EBEBEB', 'outset', '1', '000000', '14', '000000', '70', '27', 0, 'FFFFFF', 'outset', '1', '000000', '', '', '000000', '000000', '8F8F8F', '12')";
$sql_theme14="INSERT INTO `".$table_name."` VALUES(14, 'Light Yellow', 2, '', 'FFFFFF', '600', 1, 0, 'F5F5F5', 'top', 'FFFFFF', 'FFFFFF', '000000', '18', '0 60 0 0', '8 4', 'solid', '1', 'C5A009', '', 1, 0, 'FDF6D2', 'top', 'FFFFFF', 'FFFFFF', '000000', '14', '10 82 14 25', '4 8', 'groove', '1', '8F8F8F', '5', '', '', '30', '520', '14', '', '7', '1C94CD', 0, 'F6F6F6', '', 0, 'top', 'FFFFFF', 'FFFFFF', 'FDF6D2', '100% 100%', 'outset', '1', 'FBCB09', '0', '', '', '', '', '520', '', '12', 0, 'EEEEEE', '', '100% 100%', 'outset', '1', 'D1D1D1', '', '', '', '', '', '', '', '', '', '000000', '000000', '14', '10 60 14 0', 'A6A6A6', '0 60 16 0', '220', '25', 1, 'EBEBEB', 'outset', '2', 'FBCB09', '14', '000000', '70', '27', 1, 'F6F6F6', 'outset', '2', 'FBCB09', '', '', '000000', '1C94CD', '7A7A7A', '12')";
$sql_theme15="INSERT INTO `".$table_name."` VALUES(15, 'Yellow Gradient', 2, '', 'FFFFFF', '600', 1, 1, 'FEF9D9', 'top', 'FEF9D9', 'F3E157', '000000', '18', '0 60 0 0', '8 4', 'ridge', '1', 'B3B3B3', '', 0, 0, 'FFFFFF', 'top', 'FFFFFF', 'FFFFFF', '000000', '14', '10 86 14 31', '4 8', 'ridge', '1', 'CFCFCF', '2', '', '', '30', '520', '14', '95', '', '000000', 0, 'CCCCCC', '', 1, 'top', 'FEF9D9', 'F3E157', 'FFFFFF', '100% 100%', 'outset', '1', 'CEB80D', '', '".plugins_url("upload/style15/style15a.png",__FILE__)."', '6', '".plugins_url("upload/style15/style15b.png",__FILE__)."', '', '520', '', '12', 0, 'FCF8D5', '', '100% 100%', 'solid', '1', 'DBDBDB', '', '', '', '', '', '', '', '', '', '000000', '000000', '14', '10 60 14 0', 'CCCCCC', '0 60 16 0', '220', '25', 1, 'EBEBEB', 'outset', '2', 'CEB80D', '14', '000000', '70', '27', 1, 'FCF8D5', 'outset', '2', 'CEB80D', '', '', '000000', '000000', '787878', '14')";
$sql_theme16="INSERT INTO `".$table_name."` VALUES(16, 'Grey & White', 2, '', 'FFFFFF', '600', 0, 1, 'FFFFFF', 'top', 'FFFFFF', 'FFFFFF', '000000', '20', '0 60 0 0', '6 4 8', 'none', '', 'FFFFFF', '', 1, 0, 'FFFFFF', 'top', 'FFFFFF', 'FFFFFF', '000000', '14', '10 60 14 42', '4 8', 'ridge', '1', 'CCCCCC', '', '', '', '30', '520', '14', '94', '', '000000', 0, 'D3D3D3', '', 0, 'top', 'FFFFFF', 'FFFFFF', 'FFFFFF', '100% 100%', 'outset', '1', '000000', '', '".plugins_url("upload/style16/style16a.png",__FILE__)."', '10', '".plugins_url("upload/style16/style16b.png",__FILE__)."', '', '520', '', '12', 0, 'EBEBEB', '', '100% 100%', 'outset', '1', 'B8B8B8', '', '', '', '', '', '', '', '', '', '000000', '000000', '14', '10 60 14 0', 'CCCCCC', '0 60 16 0', '220', '25', 0, 'EBEBEB', 'solid', '2', '000000', '14', '000000', '70', '27', 0, 'FFFFFF', 'solid', '2', '000000', '', '', '000000', '000000', '616161', '12')";
$sql_theme17="INSERT INTO `".$table_name."` VALUES(17, 'Green & Blue', 2, '', 'FFFFFF', '600', 1, 0, 'E0CA3B', 'top', 'FFFFFF', 'FFFFFF', '000000', '18', '0 20 0 0', '8 4 6', 'groove', '1', 'AED2D9', '8', 0, 0, 'FFFFFF', 'top', 'FFFFFF', 'FFFFFF', '000000', '14', '9 20 14 42', '8', 'outset', '1', 'E3E3E3', '5', '', '', '30', '560', '14', '95', '', '000000', 0, 'AED2D9', '', 0, 'top', 'FFFFFF', 'FFFFFF', 'CCD232', '100% 100%', 'dotted', '1', '3B3B3B', '18', '".plugins_url("upload/style17/style17a.png",__FILE__)."', '8', '".plugins_url("upload/style17/style17b.png",__FILE__)."', '', '560', '', '12', 0, 'E8E8E8', '', '100% 100%', 'outset', '1', 'D4D4D4', '18', '', '', '', '', '', '', '', '', '000000', '000000', '14', '10 40 14 0', 'B2B82C', '0 40 16 0', '220', '25', 0, 'EBEBEB', 'inset', '', '000000', '14', '000000', '70', '27', 0, 'FFFFFF', 'inset', '', '000000', '', '', '000000', '000000', 'C9C9C9', '12')";
//create tables




////// insert themes rows
$wpdb->query($sql_theme1);
$wpdb->query($sql_theme2);
$wpdb->query($sql_theme3);
$wpdb->query($sql_theme4);
$wpdb->query($sql_theme5);
$wpdb->query($sql_theme6);
$wpdb->query($sql_theme7);
$wpdb->query($sql_theme8);
$wpdb->query($sql_theme9);
$wpdb->query($sql_theme10);
$wpdb->query($sql_theme11);
$wpdb->query($sql_theme12);
$wpdb->query($sql_theme13);
$wpdb->query($sql_theme14);
$wpdb->query($sql_theme15);
$wpdb->query($sql_theme16);
$wpdb->query($sql_theme17);


$table_name=$wpdb->prefix."spider_faq_category";
$sql_category_insert_row1="INSERT INTO `".$wpdb->prefix."spider_faq_category` (id,title,description,show_title,show_description,published) VALUES(1, 'Uncategorized', '',1, 1, 1)";
////// insert category rows
$wpdb->query($sql_category_insert_row1);
}

/////  update tables
add_faq_column();
add_question_column();
add_theme_column();

////// update themes
$table_name=$wpdb->prefix."spider_faq_theme";
if($truefalse)
{
    $wpdb->update( $table_name,  
    array('sboxbgcolor'=>'EBEBEB','afontsize'=>'14','amargin'=>'0 15 5','dwidth' => '100','dheight' => '','dlikehitswidth' => '100','dlikehitsmargin' => '','dmarginleft' => '','dbordertopstyle' => 'solid','dborderbottomstyle' => 'solid','dbackgroundcolor' => 'FFFFF','dborderstyle' => 'solid','dborderwidth' => '1','dbordercolor' => 'DBDBDB','dbordercornerradius' => '5','dtextcolor' => '44A9CF','dlikehitsbgcolor' => 'FFFFFF','dlikehitsbdrst'=>'solid','dlikehitsbdrtst' => 'solid','dlikehitsbdrw'=>'1','dlikehitsbdrc'=>'DBDBDB','dlikehitsbdrrad'=>'5','dlikehitstxtcl' => '44A9CF','apadd' => '','dlikehitsbdrbst' => 'solid','numbering' => '0','ansmarginleft'=>'','imgpos' => '0','answidth'=>'','ikncol' => '0','numberfnts'=>'','numbercl'=>'FFFFFF','tbtopstyle'=>'solid','tbrightstyle'=>'solid','abrightstyle'=>'none','default'=>'1'),  
    array( 'id' => 1 ),  
    array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%d','%s', '%d','%s','%s','%s','%s','%s','%d'),  
    array( '%d' )  
              );

    $wpdb->update( $table_name,  
    array('sboxbgcolor'=>'EBEBEB','afontsize'=>'14','amargin'=>'0 8 3','dwidth' => '100','dlikehitswidth' => '100','dbordertopstyle' => 'none','dborderbottomstyle' => 'solid','dbackgroundcolor' => 'C4FAF3','dborderstyle' => 'none','dborderwidth' => '1','dbordercolor' => '242424','dtextcolor' => '242424','dlikehitsbgcolor' => 'C4FAF3','dlikehitsbdrtst' => 'outset','dlikehitsbdrw' => '1','dlikehitsbdrc' => '242424','dlikehitstxtcl' => '000000','apadd' => '2','dlikehitsbdrbst' => 'none','numbering' => '0','imgpos' => '0','ikncol' => '0','tbtopstyle'=>'outset','tbrightstyle'=>'outset','abrightstyle'=>'none','default'=>'1'  ),  
    array( 'id' => 2 ),  
    array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%d', '%d','%s','%s','%s','%d'),  
    array( '%d' )  
              );
			  
	$wpdb->update( $table_name,  
    array('tbgcolor'=>'20BD1A','sboxbgcolor'=>'EBEBEB','afontsize'=>'14','dwidth' => '100','dlikehitswidth' => '100','dbordertopstyle' => 'none','dborderbottomstyle' => 'none','dbackgroundcolor' => '6B9999','dborderstyle' => 'none','dbordercolor' => '20BD1A','dtextcolor' => 'FFFFFF','dlikehitsbgcolor' => '6B9999','dlikehitsbdrtst' => 'none','dlikehitstxtcl' => 'FFFFFF','apadd' => '2','dlikehitsbdrbst' => 'none','numbering' => '0','imgpos' => '0','ikncol' => '0' ,'tbtopstyle'=>'solid','tbrightstyle'=>'solid','abrightstyle'=>'solid','default'=>'1' ),  
    array( 'id' => 3 ),  
    array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%d', '%d','%s','%s','%s','%d'),  
    array( '%d' )  
              );
			  
    $wpdb->update( $table_name,  
    array('tbgcolor'=>'000000','sboxbgcolor'=>'EBEBEB','afontsize'=>'14','dwidth' => '100','dheight' => '','dlikehitswidth' => '100','dlikehitsmargin' => '','dmarginleft' => '','dbordertopstyle' => 'solid','dborderbottomstyle' => 'solid','dbackgroundcolor' => 'FFBE3B','dborderstyle' => 'solid','dborderwidth' => '1','dbordercolor' => '030303','dbordercornerradius' => '4','dtextcolor' => '000000','dlikehitsbgcolor' => 'FFBE3B','dlikehitsbdrst'=>'solid','dlikehitsbdrtst' => 'solid','dlikehitsbdrw'=>'1','dlikehitsbdrc'=>'030303','dlikehitsbdrrad'=>'4','dlikehitstxtcl' => '000000','apadd' => '3','dlikehitsbdrbst' => 'solid','numbering' => '0','ansmarginleft'=>' ','imgpos' => '0','answidth'=>'  ','ikncol' => '0','numberfnts'=>'','numbercl'=>'','tbtopstyle'=>'outset','tbrightstyle'=>'outset','abrightstyle'=>'none','default'=>'1'  ),  
    array( 'id' => 4 ),  
    array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%d','%s', '%d','%s','%s','%s','%s','%s','%d'),  
    array( '%d' )  
              );
			  
    $wpdb->update( $table_name,  
    array('sboxbgcolor'=>'EBEBEB','afontsize'=>'14','dwidth' => '100','dheight' => '','dlikehitswidth' => '100','dlikehitsmargin' => '','dmarginleft' => '','dbordertopstyle' => 'none','dborderbottomstyle' => '','dbackgroundcolor' => 'BBBBBB','dborderstyle' => 'none','dborderwidth' => '','dbordercolor' => 'FFFFFF','dbordercornerradius' => '','dtextcolor' => '2779B1','dlikehitsbgcolor' => 'E0E0E0','dlikehitsbdrst'=>'','dlikehitsbdrtst' => '','dlikehitsbdrw'=>'','dlikehitsbdrc'=>'FFFFFF','dlikehitsbdrrad'=>'','dlikehitstxtcl' => '2779B1','apadd' => '2','dlikehitsbdrbst' => 'none','numbering' => '0','ansmarginleft'=>' ','imgpos' => '0','answidth'=>'  ','ikncol' => '0','numberfnts'=>'','numbercl'=>'' ,'tbtopstyle'=>'solid','tbrightstyle'=>'solid','abrightstyle'=>'solid','default'=>'1' ),  
    array( 'id' => 5 ),  
    array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%d','%s', '%d','%s','%s','%s','%s','%s','%d'),  
    array( '%d' )  
              );
	$wpdb->update( $table_name,  
    array('tbgcolor'=>'242424','sboxbgcolor'=>'EBEBEB','afontsize'=>'14','dwidth' => '100','dheight' => '','dlikehitswidth' => '100','dlikehitsmargin' => '','dmarginleft' => '','dbordertopstyle' => 'solid','dborderbottomstyle' => '','dbackgroundcolor' => '5C5C5C','dborderstyle' => 'solid','dborderwidth' => '1','dbordercolor' => '000000','dbordercornerradius' => '4','dtextcolor' => '000000','dlikehitsbgcolor' => '5C5C5C','dlikehitsbdrst'=>'solid','dlikehitsbdrtst' => '','dlikehitsbdrw'=>'1','dlikehitsbdrc'=>'000000','dlikehitsbdrrad'=>'4','dlikehitstxtcl' => '000000','apadd' => '','dlikehitsbdrbst' => 'solid','numbering' => '0','ansmarginleft'=>'','imgpos' => '0','answidth'=>'','ikncol' => '1','numberfnts'=>'','numbercl'=>'' ,'tbtopstyle'=>'none','tbrightstyle'=>'none','abrightstyle'=>'none','default'=>'1' ),  
    array( 'id' => 6 ),  
    array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%d','%s', '%d','%s','%s','%s','%s','%s','%d'),  
    array( '%d' )  
              );
	$wpdb->update( $table_name,  
    array('tbgcolor'=>'1283E5','sboxbgcolor'=>'EBEBEB','afontsize'=>'14','dwidth' => '100','dheight' => '21','dlikehitswidth' => '100','dlikehitsmargin' => '','dmarginleft' => '','dbordertopstyle' => 'none','dborderbottomstyle' => '','dbackgroundcolor' => 'E59600','dborderstyle' => 'none','dborderwidth' => '','dbordercolor' => 'FFFFFF','dbordercornerradius' => '4','dtextcolor' => 'FFFFFF','dlikehitsbgcolor' => 'E59600','dlikehitsbdrst'=>'','dlikehitsbdrtst' => '','dlikehitsbdrw'=>'','dlikehitsbdrc'=>'FFFFFF','dlikehitsbdrrad'=>'4','dlikehitstxtcl' => 'FFFFFF','apadd' => '3','dlikehitsbdrbst' => '','numbering' => '0','ansmarginleft'=>'','imgpos' => '0','answidth'=>'','ikncol' => '0' ,'numberfnts'=>'','numbercl'=>'','tbtopstyle'=>'solid','tbrightstyle'=>'solid','abrightstyle'=>'solid','default'=>'1' ),  
    array( 'id' => 7 ),  
    array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%d','%s', '%d','%s','%s','%s','%s','%s','%d'),  
    array( '%d' )  
              );
	$wpdb->update( $table_name,  
    array('tbgcolor'=>'312C24','sboxbgcolor'=>'EBEBEB','afontsize'=>'14','dwidth' => '100','dheight' => '22','dlikehitswidth' => '100','dlikehitsmargin' => '','dmarginleft' => '','dbordertopstyle' => '','dborderbottomstyle' => '','dbackgroundcolor' => '413626','dborderstyle' => 'none','dborderwidth' => '','dbordercolor' => 'FFFFFF','dbordercornerradius' => '','dtextcolor' => '000000','dlikehitsbgcolor' => '413626','dlikehitsbdrst'=>'','dlikehitsbdrtst' => '','dlikehitsbdrw'=>'','dlikehitsbdrc'=>'','dlikehitsbdrrad'=>'','dlikehitstxtcl' => '000000','apadd' => '','dlikehitsbdrbst' => '','numbering' => '0','ansmarginleft'=>'','imgpos' => '0','answidth'=>'','ikncol' => '1','numberfnts'=>'','numbercl'=>'','tbtopstyle'=>'solid','tbrightstyle'=>'solid','abrightstyle'=>'solid','default'=>'1'  ),  
    array( 'id' => 8 ),  
    array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%d','%s', '%d','%s','%s','%s','%s','%s','%d'),  
    array( '%d' )  
              );
    $wpdb->update( $table_name,  
    array('sboxbgcolor'=>'EBEBEB','afontsize'=>'14','dwidth' => '100','dheight' => '23','dlikehitswidth' => '100','dlikehitsmargin' => '','dmarginleft' => '','dbordertopstyle' => '','dborderbottomstyle' => 'solid','dbackgroundcolor' => '8390A0','dborderstyle' => '','dborderwidth' => '1','dbordercolor' => '000000','dbordercornerradius' => '3','dtextcolor' => '000000','dlikehitsbgcolor' => '8390A0','dlikehitsbdrst'=>'','dlikehitsbdrtst' => 'solid','dlikehitsbdrw'=>'1','dlikehitsbdrc'=>'000000','dlikehitsbdrrad'=>'3','dlikehitstxtcl' => '000000','apadd' => '2','dlikehitsbdrbst' => '','numbering' => '0','ansmarginleft'=>'','imgpos' => '0','answidth'=>'','ikncol' => '0' ,'numberfnts'=>'','numbercl'=>'','tbtopstyle'=>'none','tbrightstyle'=>'none','abrightstyle'=>'none','default'=>'1' ),  
    array( 'id' => 9 ),  
    array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%d','%s', '%d','%s','%s','%s','%s','%s','%d'),  
    array( '%d' )  
              );
    $wpdb->update( $table_name,  
    array('sboxbgcolor'=>'EBEBEB','afontsize'=>'14','dwidth' => '100','dheight' => '','dlikehitswidth' => '100','dlikehitsmargin' => '','dmarginleft' => '','dbordertopstyle' => '','dborderbottomstyle' => 'solid','dbackgroundcolor' => 'E4DFDA','dborderstyle' => '','dborderwidth' => '1','dbordercolor' => '737373','dbordercornerradius' => '','dtextcolor' => '000000','dlikehitsbgcolor' => 'E4DFDA','dlikehitsbdrst'=>'','dlikehitsbdrtst' => 'solid','dlikehitsbdrw'=>'1','dlikehitsbdrc'=>'737373','dlikehitsbdrrad'=>'','dlikehitstxtcl' => '000000','apadd' => '','dlikehitsbdrbst' => '','numbering' => '0','ansmarginleft'=>'','imgpos' => '0','answidth'=>'','ikncol' => '0' ,'numberfnts'=>'','numbercl'=>'' ,'tbtopstyle'=>'solid','tbrightstyle'=>'solid','abrightstyle'=>'solid','default'=>'1'),  
    array( 'id' => 10 ),  
    array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%d','%s', '%d','%s','%s','%s','%s','%s','%d'),  
    array( '%d' )  
              );
    $wpdb->update( $table_name,  
    array('sboxbgcolor'=>'EBEBEB','afontsize'=>'14','dwidth' => '100','dheight' => '','dlikehitswidth' => '100','dlikehitsmargin' => '','dmarginleft' => '','dbordertopstyle' => '','dborderbottomstyle' => '','dbackgroundcolor' => 'E0E0E0','dborderstyle' => '','dborderwidth' => '','dbordercolor' => 'FFFFFF','dbordercornerradius' => '2','dtextcolor' => '000000','dlikehitsbgcolor' => 'E0E0E0','dlikehitsbdrst'=>'','dlikehitsbdrtst' => '','dlikehitsbdrw'=>'','dlikehitsbdrc'=>'FFFFFF','dlikehitsbdrrad'=>'2','dlikehitstxtcl' => '000000','apadd' => '2','dlikehitsbdrbst' => '','numbering' => '0','ansmarginleft'=>'','imgpos' => '0','answidth'=>'','ikncol' => '0' ,'numberfnts'=>'','numbercl'=>'','tbtopstyle'=>'none','tbrightstyle'=>'none','abrightstyle'=>'solid','default'=>'1' ),  
    array( 'id' => 11 ),  
    array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%d','%s', '%d','%s','%s','%s','%s','%s','%d'),  
    array( '%d' )  
              );
    $wpdb->update( $table_name,  
    array('sboxbgcolor'=>'EBEBEB','afontsize'=>'14','dwidth' => '100','dheight' => '','dlikehitswidth' => '100','dlikehitsmargin' => '','dmarginleft' => '','dbordertopstyle' => '','dborderbottomstyle' => '','dbackgroundcolor' => 'DFDFDF','dborderstyle' => '','dborderwidth' => '','dbordercolor' => 'FFFFFF','dbordercornerradius' => '11','dtextcolor' => '000000','dlikehitsbgcolor' => 'DFDFDF','dlikehitsbdrst'=>'','dlikehitsbdrtst' => '','dlikehitsbdrw'=>'','dlikehitsbdrc'=>'FFFFFF','dlikehitsbdrrad'=>'11','dlikehitstxtcl' => '000000','apadd' => '','dlikehitsbdrbst' => '','numbering' => '0','ansmarginleft'=>'','imgpos' => '0','answidth'=>'','ikncol' => '0' ,'numberfnts'=>'','numbercl'=>'','tbtopstyle'=>'solid','tbrightstyle'=>'solid','abrightstyle'=>'solid','default'=>'1' ),  
    array( 'id' => 12 ),  
    array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%d','%s', '%d','%s','%s','%s','%s','%s','%d'),  
    array( '%d' )  
              );
    $wpdb->update( $table_name,  
    array('sboxbgcolor'=>'EBEBEB','afontsize'=>'14','dwidth' => '100','dheight' => '','dlikehitswidth' => '100','dlikehitsmargin' => '','dmarginleft' => '','dbordertopstyle' => '','dborderbottomstyle' => '','dbackgroundcolor' => 'E2E2E2','dborderstyle' => '','dborderwidth' => '','dbordercolor' => 'FFFFFF','dbordercornerradius' => '15','dtextcolor' => '000000','dlikehitsbgcolor' => 'E2E2E2','dlikehitsbdrst'=>'','dlikehitsbdrtst' => '','dlikehitsbdrw'=>'','dlikehitsbdrc'=>'FFFFFF','dlikehitsbdrrad'=>'15','dlikehitstxtcl' => '000000','apadd' => '','dlikehitsbdrbst' => '','numbering' => '0','ansmarginleft'=>'','imgpos' => '0','answidth'=>'','ikncol' => '0' ,'numberfnts'=>'','numbercl'=>'','tbtopstyle'=>'outset','tbrightstyle'=>'outset','abrightstyle'=>'outset','default'=>'1' ),  
    array( 'id' => 13 ),  
    array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%d','%s', '%d','%s','%s','%s','%s','%s','%d'),  
    array( '%d' )  
              );
    $wpdb->update( $table_name,  
    array('sboxbgcolor'=>'EBEBEB','afontsize'=>'14','dwidth' => '100','dheight' => '','dlikehitswidth' => '100','dlikehitsmargin' => '','dmarginleft' => '','dbordertopstyle' => '','dborderbottomstyle' => 'solid','dbackgroundcolor' => 'E6E6E6','dborderstyle' => '','dborderwidth' => '1','dbordercolor' => 'D3D3D3','dbordercornerradius' => '','dtextcolor' => '000000','dlikehitsbgcolor' => 'E6E6E6','dlikehitsbdrst'=>'','dlikehitsbdrtst' => 'solid','dlikehitsbdrw'=>'1','dlikehitsbdrc'=>'D3D3D3','dlikehitsbdrrad'=>'','dlikehitstxtcl' => '000000','apadd' => '','dlikehitsbdrbst' => '','numbering' => '0','ansmarginleft'=>'','imgpos' => '0','answidth'=>'','ikncol' => '0' ,'numberfnts'=>'','numbercl'=>'','tbtopstyle'=>'outset','tbrightstyle'=>'outset','abrightstyle'=>'outset','default'=>'1' ),  
    array( 'id' => 14 ),  
    array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%d','%s', '%d','%s','%s','%s','%s','%s','%d'),  
    array( '%d' )  
              );
    $wpdb->update( $table_name,  
    array('tbgcolor'=>'FEF9D9','sboxbgcolor'=>'EBEBEB','ttxtpleft'=>'1','afontsize'=>'14','ttxtwidth'=>'92','dwidth' => '100','dheight' => '','dlikehitswidth' => '100','dlikehitsmargin' => '','dmarginleft' => '','dbordertopstyle' => '','dborderbottomstyle' => 'solid','dbackgroundcolor' => 'FFF7B5','dborderstyle' => '','dborderwidth' => '1','dbordercolor' => 'DAD7D7','dbordercornerradius' => '','dtextcolor' => '4E4E4E','dlikehitsbgcolor' => 'FFF7B5','dlikehitsbdrst'=>'','dlikehitsbdrtst' => 'solid','dlikehitsbdrw'=>'1','dlikehitsbdrc'=>'DAD7D7','dlikehitsbdrrad'=>'','dlikehitstxtcl' => '4E4E4E','apadd' => '','dlikehitsbdrbst' => '','numbering' => '0','ansmarginleft'=>'','imgpos' => '0','answidth'=>'520','ikncol' => '0' ,'numberfnts'=>'','numbercl'=>'','tbtopstyle'=>'outset','tbrightstyle'=>'outset','abrightstyle'=>'solid','default'=>'1' ),  
    array( 'id' => 15 ),  
    array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%d','%s', '%d','%s','%s','%s','%s','%s','%d'),  
    array( '%d' )  
              );
	$wpdb->update( $table_name,  
    array('sboxbgcolor'=>'EBEBEB','ttxtpleft'=>'1','afontsize'=>'14','ttxtwidth'=>'90','dwidth' => '100','dheight' => '','dlikehitswidth' => '100','dlikehitsmargin' => '','dmarginleft' => '','dbordertopstyle' => '','dborderbottomstyle' => 'solid','dbackgroundcolor' => 'DBDBDB','dborderstyle' => '','dborderwidth' => '1','dbordercolor' => 'C5C5C5','dbordercornerradius' => '','dtextcolor' => '000000','dlikehitsbgcolor' => 'DBDBDB','dlikehitsbdrst'=>'','dlikehitsbdrtst' => 'solid','dlikehitsbdrw'=>'1','dlikehitsbdrc'=>'C5C5C5','dlikehitsbdrrad'=>'','dlikehitstxtcl' => '000000','apadd' => '','dlikehitsbdrbst' => '','numbering' => '0','ansmarginleft'=>'','imgpos' => '0','answidth'=>'520','ikncol' => '0','numberfnts'=>'','numbercl'=>'','tbtopstyle'=>'outset','tbrightstyle'=>'outset','abrightstyle'=>'outset','default'=>'1'  ),  
    array( 'id' => 16 ),  
    array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%d','%s', '%d','%s','%s','%s','%s','%s','%d'),  
    array( '%d' )  
              );
    $wpdb->update( $table_name,  
    array('sboxbgcolor'=>'EBEBEB','ttxtpleft'=>'1','tbstyle'=>'none','afontsize'=>'14','ttxtwidth'=>'92','dwidth' => '100','dheight' => '','dlikehitswidth' => '100','dlikehitsmargin' => '','dmarginleft' => '','dbordertopstyle' => '','dborderbottomstyle' => '','dbackgroundcolor' => 'D5D5D5','dborderstyle' => '','dborderwidth' => '','dbordercolor' => 'FFFFFF','dbordercornerradius' => '10','dtextcolor' => '000000','dlikehitsbgcolor' => 'D5D5D5','dlikehitsbdrst'=>'','dlikehitsbdrtst' => '','dlikehitsbdrw'=>'','dlikehitsbdrc'=>'FFFFFF','dlikehitsbdrrad'=>'10','dlikehitstxtcl' => '000000','apadd' => '3','dlikehitsbdrbst' => '','numbering' => '0','ansmarginleft'=>'','imgpos' => '0','answidth'=>'520','ikncol' => '0' ,'numberfnts'=>'','numbercl'=>'','tbtopstyle'=>'none','tbrightstyle'=>'none','abrightstyle'=>'outset','default'=>'1' ),  
    array( 'id' => 17 ),  
    array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%d','%s', '%d','%s','%s','%s','%s','%s','%d'),  
    array( '%d' )  
              );
    $themes= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."spider_faq_theme");
    foreach($themes as $theme)
{
     $id=$theme->id;
     if($id>17)
     $wpdb->update( $table_name,  
     array('dwidth' => '100','dheight' => '','dlikehitswidth' => '100','dlikehitsmargin' => '','dmarginleft' => '','dbordertopstyle' => 'none','dborderbottomstyle' => 'none','dbackgroundcolor' => '','dborderstyle' => 'none','dborderwidth' => '','dbordercolor' => '','dbordercornerradius' => '','dtextcolor' => '000000','dlikehitsbgcolor' => '','dlikehitsbdrst'=>'none','dlikehitsbdrtst' => 'none','dlikehitsbdrw'=>'','dlikehitsbdrc'=>'','dlikehitsbdrrad'=>'','dlikehitstxtcl' => '000000','apadd' => '','dlikehitsbdrbst' => 'none','numbering' => '0','ansmarginleft'=>'','imgpos' => '0','answidth'=>'','ikncol' => '0','numberfnts'=>'','numbercl'=>'','tbtopstyle'=>'none','tbrightstyle'=>'none','abrightstyle'=>'none','default'=>'1' ),  
     array( 'id' => $id ),  
     array( '%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%d','%s', '%d','%s','%s','%s','%s','%s','%d'),  
     array( '%d' )  
              );
}
  $faqs= $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."spider_faq_faq ");
   if($faqs)
{
    foreach($faqs as $faq)
{
     $faq_id=$faq->id;
     $wpdb->update( $wpdb->prefix."spider_faq_faq",
     array('like'=>'1','hits'=>'1','user'=>'1','date'=>'1','numbertext'=>'1'),  
     array( 'id' => $faq_id ),  
     array( '%d','%d','%d','%d','%d'),  
     array( '%d' )  
              );
}
}
/////insert new theme rows
			$id=$wpdb->get_var("SELECT MAX(id) FROM ".$wpdb->prefix."spider_faq_theme");
			$id18=$id+1; $id19=$id+2; $id20=$id+3; $id21=$id+4; $id22=$id+5;
			
$sql_theme22="INSERT INTO `".$table_name."` VALUES(".$id18.", 'Grey & White', 2, '', 'FFFFFF', '600', 1, 0, '636363', 'top', 'FFFFFF', 'FFFFFF', 'FFFFFF', '19', '1 37 1 1', '11', 'none', '', 'FFFFFF', '3', 1, 0, 'ACACAC', 'top', 'FFFFFF', 'FFFFFF', 'FFFFFF', '12', '10 90 14 30', '10', 'none', '', 'FFFFFF', '3', '5', '2', '30', '540', '18', '', '15', '4E4D4D', 0, 'C2C2C2', '', 0, 'top', 'FFFFFF', 'FFFFFF', 'D9DBDB', '', 'none', '7', 'D9DBDB', '', '', '', '', '', '516', '4 7', '14', 0, 'D8D7D7', '', '', 'none', '7', '9C9C9C', '', '', '', '', '', '', '', '', '', '2F3B41', '000000', '14', '10 40 14 0', 'CCCCCC', '', '220', '20', 1, 'EBEBEB', 'solid', '2', '666666', '14', '000000', '53', '20', 1, 'EBEBEB', 'solid', '2', '666666', '14', '', '000000', 'C2C2C2', 'C2C2C2', '12','98','','99','3','5','none','solid','D8D7D7','none','1','B2B0B0','','7C7A7A','D8D7D7','none','none','','FFFFFF','','7C7A7A','','none','1','26','0','','0','30','FFFFFF','none','solid','solid','18')";
$sql_theme19="INSERT INTO `".$table_name."` VALUES(".$id19.", 'Grey & Black', 2, '', 'FFFFFF', '600', 1, 0, 'BDBDBD', 'top', 'FFFFFF', 'FFFFFF', '000000', '20', '1 37 1 1', '11', 'none', '', 'FFFFFF', '5', 1, 0, 'E7E7E7', 'top', 'FFFFFF', 'FFFFFF', '000000', '', '10 90 14 30', '10', 'none', '', 'FFFFFF', '5', '5', '2', '30', '540', '18', '92', '', 'ECECE7', 0, '5E5D5D', '', 0, 'top', 'FFFFFF', 'FFFFFF', '5A5E5E', '', 'none', '', 'FFFFFF', '5', '".plugins_url("upload/style19/style19a.png",__FILE__)."', '', '".plugins_url("upload/style19/style19b.png",__FILE__)."', '', '530', '', '14', 0, 'C4C4C4', '', '', 'none', '', 'FFFFFF', '4', '', '', '', '', '', '', '', '', '000000', '000000', '14', '10 40 14 0', 'CCCCCC', '', '220', '20', 1, 'EBEBEB', 'solid', '1', '5A5E5E', '14', 'FFFFFF', '53', '20', 1, 'BDBDBD', 'solid', '1', '5A5E5E', '14', '', 'FFFFFF', '5E5D5D', '5E5D5D', '12','100','','100','','','none','solid','C4C4C4','none','1','B2B0B0','','969494','B2B0B0','none','none','','FFFFFF','2','FFFFFF','2','none','0','7','0','530','0','','','','','','19')";
$sql_theme20="INSERT INTO `".$table_name."` VALUES(".$id20.", 'Green & White', 2, '', 'FFFFFF', '600', 1, 0, 'D3D3D3', 'top', 'FFFFFF', 'FFFFFF', '4E4E4E', '20', '1 37 1 1', '11', 'none', '', 'FFFFFF', '5', 1, 0, 'B2B2B0', 'top', 'FFFFFF', 'FFFFFF', '4E4E4E', '', '10 90 14 30', '10', 'none', '', 'FFFFFF', '5', '', '', '30', '540', '18', '92', '13', 'ECE7E7', 0, '0D3700', '', 0, 'top', 'FFFFFF', 'FFFFFF', '003312', '', 'none', '5', '003312', '', '".plugins_url("upload/ikon/Icon.png",__FILE__)."', '', '".plugins_url("upload/ikon/Icon.png",__FILE__)."', '', '495', '', '14', 0, 'D3D3D3', '', '', 'none', '5', 'A3A3A3', '', '', '', '', '', '', '', '', '', '6B6969', '000000', '14', '10 40 14 0', 'CCCCCC', '', '220', '20', 1, 'EBEBEB', 'solid', '2', '5A5E5E', '14', 'FFFFFF', '53', '20', 1, 'BDBDBD', 'solid', '2', '5A5E5E', '14', '', 'FFFFFF', '0D3700', '0D3700', '12','99','','100','','2','none','solid','D3D3D3','none','1','B2B0B0','','A3A3A3','CCCDCE','none','none','','FFFFFF','2','A3A3A3','2','none','0','47','0','495','0','','','none','solid','solid','20')";
$sql_theme21="INSERT INTO `".$table_name."` VALUES(".$id21.", 'Red & Grey', 2, '', 'FFFFFF', '600', 1, 0, '8F8F8F', 'top', 'FFFFFF', 'FFFFFF', 'ECE7E7', '20', '1 37 1 1', '11', 'none', '', 'FFFFFF', '3', 1, 0, '8F8F8F', 'top', 'FFFFFF', 'FFFFFF', 'ECE7E7', '', '10 90 14 30', '10', 'none', '', 'FFFFFF', '5', '5', '2', '30', '540', '18', '', '', 'ECE7E7', 0, '370009', '', 0, 'top', 'FFFFFF', 'FFFFFF', '46171E', '', 'none', '3', '46171E', '', '', '', '', '', '537', '', '14', 0, 'C4C4C4', '', '', 'none', '', 'FFFFFF', '', '', '', '', '', '', '', '', '', '4E4D4D', '000000', '14', '10 40 14 0', 'CCCCCC', '', '220', '20', 1, 'EBEBEB', 'solid', '1', '8B8B8B', '14', 'FFFFFF', '53', '20', 1, 'C2C2C2', 'solid', '1', '8B8B8B', '14', '', 'FFFFFF', '370009', '370009', '12','100','','98','5','','none','none','B2B0B0','none','1','FFFFFF','','46171E','C4C4C4','none','solid','1','A3A3A3','','46171E','','none','0','3','0','530','1','','','solid','none','','21')";
$sql_theme18="INSERT INTO `".$table_name."` VALUES(".$id22.", 'Dark Blue', 2, '', 'FFFFFF', '600', 1, 0, 'BDBDBD', 'top', 'FFFFFF', 'FFFFFF', 'FFFFFF', '20', '1 37 1 1', '11', 'none', '', 'FFFFFF', '5', 1, 0, 'E7E7E7', 'top', 'FFFFFF', 'FFFFFF', '000000', '', '10 90 14 30', '10', 'none', '', 'FFFFFF', '5', '5', '2', '30', '540', '18', '92', '10', 'FFFFFF', 0, '283841', '', 0, 'top', 'FFFFFF', 'FFFFFF', '283839', '', 'none', '', 'FFFFFF', '5', '".plugins_url("upload/style18/style18b.png",__FILE__)."', '', '".plugins_url("upload/style18/style18a.png",__FILE__)."', '', '525', '', '14', 1, 'CCCCCC', '".plugins_url("upload/style19/BG.png",__FILE__)."', '', 'none', '', 'FFFFFF', '', '', '', '', '', '', '', '', '', '000000', '000000', '14', '10 40 14 0', 'CCCCCC', '', '220', '20', 1, 'EBEBEB', 'solid', '2', '9C9C9C', '14', 'FFFFFF', '53', '20', 1, 'BDBDBD', 'solid', '2', '9C9C9C', '14', '', 'FFFFFF', '283841', '283841', '12','100','','98','5','','none','none','DAD7D7','none','','FFFFFF','','969494','F5F3EB','none','solid','1','DAD7D7','','969494','','none','0','9','1','520','0','','','','','','22')";
$wpdb->query($sql_theme18);
$wpdb->query($sql_theme19);
$wpdb->query($sql_theme20);
$wpdb->query($sql_theme21);
$wpdb->query($sql_theme22);
			  			  
}

}
register_activation_hook( __FILE__, 'Spider_FAQ_activate' );
