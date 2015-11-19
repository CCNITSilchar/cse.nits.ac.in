<?php 

function add_spider_cat(){
	
// display function
html_add_spider_cat();
}

function show_spider_cat(){	  
  global $wpdb;
  $where = "";
  $order = "ORDER BY id";
	$sort["default_style"]="manage-column column-autor sortable desc";
	
	if(isset($_POST['page_number']))
	{
			
			if($_POST['asc_or_desc'])
			{
				$sort["sortid_by"]=esc_sql(esc_html(stripslashes($_POST['order_by'])));
				if(esc_sql(esc_html(stripslashes($_POST['asc_or_desc'])))==1)
				{
					$sort["custom_style"]="manage-column column-title sorted asc";
					$sort["1_or_2"]="2";
					$order="ORDER BY ".$sort["sortid_by"]." ASC";
				}
				else
				{
					$sort["custom_style"]="manage-column column-title sorted desc";
					$sort["1_or_2"]="1";
					$order="ORDER BY ".$sort["sortid_by"]." DESC";
				}
			}
	if($_POST['page_number'])
		{
			$limit=(esc_sql(esc_html(stripslashes($_POST['page_number'])))-1)*20; 
		}
		else
		{
			$limit=0;
		}
	}
	else
		{
			$limit=0;
		}
	if(isset($_POST['search_events_by_title'])){
		$search_tag = esc_sql(esc_html(stripslashes($_POST['search_events_by_title'])));
		}
		
		else
		{
		$search_tag="";
		}
	if ( $search_tag ) {
		$where= ' WHERE title LIKE "%'.$search_tag.'%"';
	}
	
	
	
	
	
	
	
	
	// get the total number of records
	$query = "SELECT COUNT(*) FROM ".$wpdb->prefix."spider_faq_category". $where;
	
	$total = $wpdb->get_var($query);
	$pageNav['total'] =$total;
	$pageNav['limit'] =	 $limit/20+1;
	
	$query = "SELECT * FROM ".$wpdb->prefix."spider_faq_category".$where." ". $order." "." LIMIT ".$limit.",20";
	$rows = $wpdb->get_results($query);	   
		html_show_spider_cat( $rows, $pageNav,$sort);   	
	
}





function edit_spider_cat($id){
	global $wpdb;
	  
	  $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_category WHERE id='%d'",$id);
	   $row=$wpdb->get_row($query);

    html_edit_spider_cat($row);
}






function save_spider_cat(){

	global $wpdb;
	$save_or_no= $wpdb->insert($wpdb->prefix.'spider_faq_category', array(
		'id'	=> NULL,
        'title'    => esc_sql(esc_html(stripslashes($_POST["title"]))),
        'description' => esc_sql(esc_html(stripslashes($_POST["description"]))),
		'show_title'	 => esc_sql(esc_html(stripslashes($_POST["show_title"]))),
		'show_description'	=> esc_sql(esc_html(stripslashes($_POST["show_description"]))),
        'published'			  => esc_sql(esc_html(stripslashes($_POST["published"]))),
                ),
				array(
				'%d',
				'%s',
				'%s',
				'%d',
				'%d',
				'%d',				
				)
                );
			
					if(!$save_or_no)
	{
		?>
	<div class="updated"><p><strong><?php _e('Error. Please install plugin again'); ?></strong></p></div>
	<?php
		return false;
	}
	?>
	<div class="updated"><p><strong><?php _e('Item Saved'); ?></strong></p></div>
	<?php
	
    return true;
}

function apply_spider_cat(){

	global $wpdb;
	
	
	 $save_or_no= $wpdb->update($wpdb->prefix.'spider_faq_category', array(
        'title'     => esc_sql(esc_html(stripslashes($_POST["title"]))),
        'description'  => esc_sql(esc_html(stripslashes($_POST["description"]))),
		'show_title'      =>esc_sql(esc_html(stripslashes($_POST["show_title"]))),
		'show_description'	 =>esc_sql(esc_html(stripslashes($_POST["show_description"]))),
        'published'  =>esc_sql(esc_html(stripslashes($_POST["published"]))),
                ),
				 array('id'=>esc_sql(esc_html(stripslashes($_POST["id"])))),
				 
				 
				array(
				'%s',
				'%s',
				'%d',	
				'%d',
				'%d',
				
				)
                );
				?>
	<div class="updated"><p><strong><?php _e('Item Saved'); ?></strong></p></div>
	<?php
	
    return true;
	
}







function remove_spider_cat($id){
   global $wpdb;
 $sql_remov_tag=$wpdb->prepare("DELETE FROM ".$wpdb->prefix."spider_faq_category WHERE id='%d'",$id);
 if(!$wpdb->query($sql_remov_tag))
 {
	  ?>
	  <div id="message" class="error"><p>Spider Faq Not Deleted</p></div>
      <?php
	 
 }
 else{
 ?>
 <div class="updated"><p><strong><?php _e('Item Deleted.' ); ?></strong></p></div>
 <?php
 }
}



function change_spider_cat( $id ){
  global $wpdb;
  $published=$wpdb->get_var($wpdb->prepare("SELECT published FROM ".$wpdb->prefix."spider_faq_category WHERE `id`='%d'",$id ));
  if($published)
   $published=0;
  else
   $published=1;
  $savedd=$wpdb->update($wpdb->prefix.'spider_faq_category', array(
			  'published'    =>$published,
              ), 
              array('id'=>$id),
			  array(  '%d' )
			  );
	if(!$savedd)
	{
    ?>
	<div class="error"><p><strong><?php _e('Error. Please install plugin again'); ?></strong></p></div>
	<?php
     return false;
	}
	?>
	<div class="updated"><p><strong><?php _e('Item Saved'); ?></strong></p></div>
	<?php	
    return true;
}
?>