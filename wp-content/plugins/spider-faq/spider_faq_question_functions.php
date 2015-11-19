<?php 

function add_spider_ques(){
  global $wpdb;
	  
	  
	
    $query = "SELECT ordering,title FROM ".$wpdb->prefix."spider_faq_question order by ordering";
    $ord_elem =  $wpdb->get_results($query);

    
 
  
	$cat_row=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."spider_faq_category WHERE  published=1");
	
  
		
// display function
html_add_spider_ques($cat_row,$ord_elem);
}

function show_spider_ques(){		  
  global $wpdb;
  $where = "";
  $order = "";
	$sort["default_style"]="manage-column column-autor sortable desc";
	
	if(isset($_POST['page_number']))
	{
			
			if($_POST['asc_or_desc'])
			{
				$sort["sortid_by"]=esc_sql(esc_html(stripslashes($_POST['order_by'])));
				if(esc_html($_POST['asc_or_desc'])==1)
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
		$search_tag=esc_sql(esc_html(stripslashes($_POST['search_events_by_title'])));
		}
		
		else
		{
		$search_tag="";
		}
	if ( $search_tag ) {
				$where= ' WHERE '.$wpdb->prefix.'spider_faq_question.title LIKE "%'.$search_tag.'%"';
	}
	
	
	if(isset($_POST['saveorder']))
	{
		if(esc_html($_POST['saveorder'])=="save")
		{
			
			$popoxvac_orderner=array();
			$aranc_popoxutineri_orderner=array();
			$all_products_oreder=$wpdb->get_results("SELECT `id`,`ordering` FROM ".$wpdb->prefix."spider_faq_question");
			foreach($all_products_oreder as $products_oreder)
			{
				if(isset($_POST['order_'.$products_oreder->id]))
				{
					if($_POST['order_'.$products_oreder->id]==$products_oreder->ordering)
					$aranc_popoxutineri_orderner[$products_oreder->id]=$products_oreder->ordering;
					else
					$popoxvac_orderner[$products_oreder->id]=$_POST['order_'.$products_oreder->id];
				}
				else
				{
					$aranc_popoxutineri_orderner[$products_oreder->id]=$products_oreder->ordering;
				}
			}
			
			$count_of_ordered_products=count($all_products_oreder);
			$count_popoxvac=count($popoxvac_orderner);
			$count_anpopox=count($aranc_popoxutineri_orderner);
			if($count_popoxvac)
			{
			for($order_for_ordering=1;$order_for_ordering<=$count_of_ordered_products;$order_for_ordering++){
				$min_popoxvac_value=10000000;
				$min_popoxvac_id=0;
				$min_anpopox_value=10000000;
				$min_anpopox_id=0;
				foreach($popoxvac_orderner as $key=>$popoxvac_order){
					if($min_popoxvac_value>$popoxvac_order){
						$min_popoxvac_value=$popoxvac_order;
						$min_popoxvac_id=$key;
					}
				}

				foreach($aranc_popoxutineri_orderner as $key=>$aranc_popoxutineri_order)	{
					if($min_anpopox_value>$aranc_popoxutineri_order){
						$min_anpopox_value=$aranc_popoxutineri_order;
						$min_anpopox_id=$key;
					}
				}
				
			
				
				if($min_anpopox_value>$min_popoxvac_value)
				{
					$wpdb->update($wpdb->prefix.'spider_faq_question', array(
					'ordering'    =>$order_for_ordering,
					  ), 
					  array('id'=>$min_popoxvac_id),
					  array(  '%d' )
					  );
					  $popoxvac_orderner[$min_popoxvac_id]=1000000000000;
					  
				}
				if($min_anpopox_value==$min_popoxvac_value)
				{
					if($min_popoxvac_value<=$order_for_ordering){
					$wpdb->update($wpdb->prefix.'spider_faq_question', array(
					'ordering'    =>$order_for_ordering,
					  ), 
					  array('id'=>$min_popoxvac_id),
					  array(  '%d' )
					  );
					$popoxvac_orderner[$min_popoxvac_id]=1000000000000;
					}
					else
					{
					$wpdb->update($wpdb->prefix.'spider_faq_question', array(
					'ordering'    =>$order_for_ordering,
					  ), 
					  array('id'=>$min_anpopox_id),
					  array(  '%d' )
					  );
					  $aranc_popoxutineri_orderner[$min_anpopox_id]=1000000000000;
					}
					  
					  
				}
	
				if($min_anpopox_value<$min_popoxvac_value)
				{
					$wpdb->update($wpdb->prefix.'spider_faq_question', array(
					'ordering'    =>$order_for_ordering,
					  ), 
					  array('id'=>$min_anpopox_id),
					  array(  '%d' )
					  );
					  $aranc_popoxutineri_orderner[$min_anpopox_id]=1000000000000;
				}

			}
			}
		
		}
		
		
	}	
		
	
	if(isset($_POST["oreder_move"]) and $_POST["oreder_move"]!="")
	{
		$ids=explode(",",$_POST["oreder_move"]); 
		$this_order=$wpdb->get_var("SELECT ordering FROM ".$wpdb->prefix."spider_faq_question WHERE id=".esc_sql(esc_html(stripslashes($ids[0]))));
		$next_order=$wpdb->get_var("SELECT ordering FROM ".$wpdb->prefix."spider_faq_question WHERE id=".esc_sql(esc_html(stripslashes($ids[1]))));	
		$wpdb->update($wpdb->prefix.'spider_faq_question', array(
		'ordering'    =>$next_order,
          ), 
          array('id'=>$ids[0]),
		array(  '%d' )
			  );
		$wpdb->update($wpdb->prefix.'spider_faq_question', array(
		'ordering'    =>$this_order,
          ), 
          array('id'=>$ids[1]),
		array(  '%d' )
			  );
			  
			  		
	}
	
	
	
	
	
	// get the total number of records
	$query = "SELECT COUNT(*) FROM ".$wpdb->prefix."spider_faq_question". $where;
	
	$total = $wpdb->get_var($query);
	$pageNav['total'] =$total;
	$pageNav['limit'] =	 $limit/20+1;
	
	$query =	"SELECT ".$wpdb->prefix."spider_faq_question.*,".$wpdb->prefix."spider_faq_category.title as cattitle FROM ".$wpdb->prefix."spider_faq_question left join ".$wpdb->prefix."spider_faq_category on  ".$wpdb->prefix."spider_faq_category.id=".$wpdb->prefix."spider_faq_question.category ".$where." ". $order." "." LIMIT ".$limit.",20";
	$rows = $wpdb->get_results($query);	  

		html_show_spider_ques( $rows, $pageNav,$sort);   	
	
}





function edit_spider_ques($id){
	global $wpdb;
	  
	  $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_question WHERE id='%d'",$id);
	   $row=$wpdb->get_row($query);
	 
	   $cat_id_for_order=$row->category;
 $ordering['0'] = array(
        'value' => '0',
        'text' => '0 First'
    );
    $query = "SELECT ordering,title FROM ".$wpdb->prefix."spider_faq_question order by ordering";
    $ord_elem =  $wpdb->get_results($query);	   
$cat_row=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."spider_faq_category");


    html_edit_spider_ques($row,$cat_row,$ord_elem);
}






function save_spider_ques(){
	global $wpdb;
	 if(isset($_POST["ordering"])){	 
	 	$rows=$wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'spider_faq_question WHERE ordering>='.esc_sql(esc_html(stripslashes($_POST["ordering"]))).'  ORDER BY `ordering` ASC ');
	 }
	 else{
		 		echo "<h1>Error</h1>";
		return false;
	 }
	 
	 
	$count_of_rows=count($rows);

	$ordering_values = array();
	$ordering_ids = array();
	for($i=0;$i<$count_of_rows;$i++)
	{		
	
		$ordering_ids[$i]=$rows[$i]->id;
		$ordering_values[$i]=$i+1+esc_sql(esc_html(stripslashes($_POST["ordering"])));
	}
	for($i=0;$i<$count_of_rows;$i++){
				$wpdb->update($wpdb->prefix.'spider_faq_question', 
			  array('ordering'    =>$ordering_values[$i]), 
              array('id'=>$ordering_ids[$i]),
			  array(  '%d' )
			  );
			
			 
	}
	
	$answer=stripslashes($_POST["content"]);
	

if (stripos($answer, "<!--more-->") !== false)
{

$answer1=explode('<!--more-->',$answer);
$article=$answer1[0];
$fullarticle=$answer1[1];

}
else{
$article=$answer;
$fullarticle='';
}


	$save_or_no= $wpdb->insert($wpdb->prefix.'spider_faq_question', array(
		'id'	=> NULL,
        'title'     => esc_sql(esc_html(stripslashes($_POST["title"]))),
		'category'   => esc_sql(esc_html(stripslashes($_POST["cat_search"]))),
		'user_name'  => esc_sql(esc_html(stripslashes($_POST["user_name"]))),
		'date'   => esc_sql(esc_html(stripslashes($_POST["date"]))),
		'like'   => esc_sql(esc_html(stripslashes($_POST["like"]))),
		'unlike'   => esc_sql(esc_html(stripslashes($_POST["unlike"]))),
		'hits'   => esc_sql(esc_html(stripslashes($_POST["hits"]))),
        'article'    => $article,
		'fullarticle'    => $fullarticle,
		'ordering'     => $_POST["ordering"],
		'published'				 =>$_POST["published"],
                ),
				array(
				'%d',
				'%s',
				'%s',
				'%s',
				'%s',
				'%d',
				'%d',
				'%d',
				'%s',
				'%s',
				'%s',
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

function apply_spider_ques($id){

	global $wpdb;
	  $corent_ord=$wpdb->get_var('SELECT `ordering` FROM '.$wpdb->prefix.'spider_faq_question WHERE id=\''.$id.'\'');
		 $max_ord=$wpdb->get_var('SELECT MAX(ordering) FROM '.$wpdb->prefix.'spider_faq_question');
		 if($corent_ord>$_POST["ordering"])
		 {
				$rows=$wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'spider_faq_question WHERE ordering>='.$_POST["ordering"].' AND id<>\''.$id.'\'  ORDER BY `ordering` ASC ');
			 
			$count_of_rows=count($rows);
			$ordering_values = array();
			$ordering_ids = array();
			for($i=0;$i<$count_of_rows;$i++)
			{		
			
				$ordering_ids[$i]=$rows[$i]->id;
				$ordering_values[$i]=$i+1+$_POST["ordering"];
			}
			for($i=0;$i<$count_of_rows;$i++){
					$wpdb->update($wpdb->prefix.'spider_faq_question', 
					  array('ordering'    =>$ordering_values[$i]), 
					  array('id'=>$ordering_ids[$i]),
					  array(  '%d' )
					  );
		
			}
		 }
		 if($corent_ord<$_POST["ordering"])
		 {
			 $rows=$wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'spider_faq_question WHERE ordering<='.$_POST["ordering"].' AND id<>\''.$id.'\'  ORDER BY `ordering` ASC ');
			 
			$count_of_rows=count($rows);
			$ordering_values = array();
			$ordering_ids = array();
			for($i=0;$i<$count_of_rows;$i++)
			{		
			
				$ordering_ids[$i]=$rows[$i]->id;
				$ordering_values[$i]=$i+1;
			}
			if($max_ord==esc_sql(esc_html(stripslashes($_POST["ordering"])))-1)
			{
				$_POST["ordering"]--;
			}
			for($i=0;$i<$count_of_rows;$i++){
					$wpdb->update($wpdb->prefix.'spider_faq_question', 
					  array('ordering'    =>$ordering_values[$i]), 
					  array('id'=>$ordering_ids[$i]),
					  array(  '%d' )
					  );
		
			}
		 }
		 
		$answer=stripslashes($_POST["content"]);
	

if (stripos($answer, "<!--more-->") !== false)
{

$answer1=explode('<!--more-->',$answer);
$article=$answer1[0];
$fullarticle=$answer1[1];

}
else{
$article=$answer;
$fullarticle='';
}


	 $save_or_no= $wpdb->update($wpdb->prefix.'spider_faq_question', array(
        
        'title'     => esc_sql(esc_html(stripslashes($_POST["title"]))),
		'category'   => esc_sql(esc_html(stripslashes($_POST["cat_search"]))),
		'user_name'  => esc_sql(esc_html(stripslashes($_POST["user_name"]))),
		'date'		=> esc_sql(esc_html(stripslashes($_POST["date"]))),
		'like'   => esc_sql(esc_html(stripslashes($_POST["like"]))),
		'unlike'   => esc_sql(esc_html(stripslashes($_POST["unlike"]))),
		'hits'   => esc_sql(esc_html(stripslashes($_POST["hits"]))),
        'article'    => $article,
		'fullarticle'    => $fullarticle,
		'ordering'     => $_POST["ordering"],
		'published'				 =>$_POST["published"],
                ),
				 array('id'=>$_POST["id"]),
				 
				 
				array(
				'%s',
				'%s',
				'%s',
				'%s',
				'%d',
				'%d',
				'%d',
				'%s',	
				'%s',
				'%d',
			    '%d',
				
				)
                );
				?>
	<div class="updated"><p><strong><?php _e('Item Saved'); ?></strong></p></div>
	<?php
	
    return true;
	
}







function remove_spider_ques($id){
   global $wpdb;
 $sql_remov_tag=$wpdb->prepare("DELETE FROM ".$wpdb->prefix."spider_faq_question WHERE id='%d'",$id);
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
 
 $rows=$wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'spider_faq_question  ORDER BY `ordering` ASC ');
	if(!isset($_POST["ordering"]))$_POST["ordering"] = "ordering";
	$count_of_rows=count($rows);
	$ordering_values=array();
	$ordering_ids=array();
	for($i=0;$i<$count_of_rows;$i++)
	{		
	
		$ordering_ids[$i]=$rows[$i]->id;
		$ordering_values[$i]=$i+1+esc_sql(esc_html(stripslashes($_POST["ordering"])));
	}

	
		for($i=0;$i<$count_of_rows;$i++)
	{	
			$wpdb->update($wpdb->prefix.'spider_faq_question', 
			  array('ordering'      =>$ordering_values[$i]), 
              array('id'			=>$ordering_ids[$i]),
			  array('%s'),
			  array( '%s' )
			  );
	}
		
 
 
}



function change_spider_ques( $id ){
  global $wpdb;
  $published=$wpdb->get_var($wpdb->prepare("SELECT published FROM ".$wpdb->prefix."spider_faq_question WHERE `id`='%d'",$id ));
  if($published)
   $published=0;
  else
   $published=1;
  $savedd=$wpdb->update($wpdb->prefix.'spider_faq_question', array(
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