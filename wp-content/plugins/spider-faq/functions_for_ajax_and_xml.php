<?php
function spider_faq_select_category(){
	require_once("nav_function/nav_html_func.php");
	global $wpdb;
	$sort["default_style"]="manage-column column-autor sortable desc";
	$order = "ORDER BY id";
	$sort["sortid_by"] = "id";
	$sort["custom_style"] = "manage-column column-autor sortable desc";
	$sort["1_or_2"]="2";
	if(isset($_POST['page_number']))
	{
			
			if($_POST['asc_or_desc'])
			{
				$sort["sortid_by"]= esc_sql(esc_html(stripslashes($_POST['order_by'])));
				if($_POST['asc_or_desc']==1)
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
		$whereee= ' WHERE published=1 AND title LIKE "%'.$search_tag.'%"';
	}
	else
	{
		$whereee=' WHERE published=1';
	}
	
	
	
	// get the total number of records
	$query = "SELECT COUNT(*) FROM ".$wpdb->prefix."spider_faq_category ". $whereee;
	$total = $wpdb->get_var($query);
	$pageNav['total'] =$total;
	$pageNav['limit'] =	 $limit/20+1;
	
	$query = "SELECT * FROM ".$wpdb->prefix."spider_faq_category ".$whereee." ". $order." "." LIMIT ".$limit.",20";

	
	
	$rows = $wpdb->get_results($query);
	html_select_category($rows, $pageNav,$sort);
	exit;	
	}
	
	
	
	
	
	
	
	
function html_select_category($rows, $pageNav, $sort)
{
$serch_value="";
if(!isset($sort["sortid_by"])) $sort["sortid_by"] = "id";
if(!isset($sort["custom_style"])) $sort["custom_style"] = "";
if(!isset($sort["1_or_2"])) $sort["1_or_2"]="2";
?>
<script type="text/javascript">

function submitbutton(pressbutton) {

var form = document.adminForm;

if (pressbutton == 'cancel') 

{

submitform( pressbutton );

return;

}

submitform( pressbutton );

}
function xxx()
{

	var id =[];
	var title =[];
	
	for(i=0; i<<?php echo count($rows) ?>; i++)
		if(document.getElementById("v"+i))
			if(document.getElementById("v"+i).checked)
			{
				id.push(document.getElementById("v"+i).value);
				title.push(document.getElementById("title_"+i).value);
				
			}
	window.parent.jSelectCategories(id, title);
	
}
function ordering(name,as_or_desc)
	{
		document.getElementById('asc_or_desc').value=as_or_desc;		
		document.getElementById('order_by').value=name;
		document.getElementById('admin_form').submit();
	}
function checkAll( n, fldName ) {
  if (!fldName) {
     fldName = 'cb';
  }
	var f = document.adminForm;
	var c = f.toggle.checked;
	var n2 = 0;
	for (i=0; i < n; i++) {
		cb = eval( 'f.' + fldName + '' + i );
		if (cb) {
			cb.checked = c;
			n2++;
		}
	}
	if (c) {
		document.adminForm.boxchecked.value = n2;
	} else {
		document.adminForm.boxchecked.value = 0;
	}
}
</script>
<style>
input[type=checkbox]:before {
 font: 400 21px/1 Dashicons !important; 
}
input[type=checkbox] {
 max-width:16px !important;
 max-height:16px !important;
}
</style>
      <link media="all" type="text/css" href="<?php echo get_admin_url(); ?>load-styles.php?c=1&amp;dir=ltr&amp;load=admin-bar,wp-admin,dashicons,buttons,wp-auth-check" rel="stylesheet">
      <link media="all" type="text/css" href="<?php echo get_admin_url(); ?>css/colors<?php echo ((get_bloginfo('version') < '3.8') ? '-fresh' : ''); ?>.min.css" id="colors-css" rel="stylesheet">
	  
	<form action="<?php echo admin_url('admin-ajax.php?action=spiderFaqselectcategory') ?>" method="post" id="admin_form" name="adminForm">
    
		<table style="width:98%">
           <td align="right" width="100%">
           <button onclick="xxx();" style="width:98px; height:34px; background:url(<?php echo plugins_url("images/add_but.png",__FILE__); ?>) no-repeat;border:none;cursor:pointer;">&nbsp;</button>        
             </td>

       </tr>
		</table>    
    
        <?php 
        if(isset($_POST['serch_or_not'])) {if($_POST['serch_or_not']=="search"){ $serch_value=esc_sql(esc_html(stripslashes($_POST['search_events_by_title']))); }else{$serch_value="";}} 
	$serch_fields='<div class="alignleft actions" style="width:180px;">
    	<label for="search_events_by_title" style="font-size:14px">Title: </label>
        <input type="text" name="search_events_by_title" value="'.$serch_value.'" id="search_events_by_title" onchange="clear_serch_texts()">
    </div>
	<div class="alignleft actions">
   		<input type="button" value="Search" onclick="document.getElementById(\'page_number\').value=\'1\'; document.getElementById(\'serch_or_not\').value=\'search\';
		 document.getElementById(\'admin_form\').submit();" class="button-secondary action">
		 <input type="button" value="Reset" onclick="window.location.href=\''. admin_url('admin-ajax.php?action=spiderFaqselectcategory').'\'" class="button-secondary action">
    </div>';
	 print_html_nav1($pageNav['total'],$pageNav['limit'],$serch_fields);	
	 ?>
    <table class="wp-list-table widefat plugins" style="margin:25px; width:93%">
    <thead style="position:inherit">
    	<tr>
          <th style="width:44px;position:inherit;padding:19px 3px 6px 4px" class="manage-column column-cb check-column"><input  type="checkbox" name="toggle" id="toggle" value="" onclick="checkAll(<?php echo count($rows)?>, 'v')"></th>
          <th style="width:70px;padding-left:11px" scope="col" id="id" class="table_small_col <?php if($sort["sortid_by"]=="id") echo $sort["custom_style"]; ?>" style="width:110px" ><a style=" padding: 0px; " href="javascript:ordering('id',<?php if($sort["sortid_by"]=="id") echo $sort["1_or_2"]; else echo "1"; ?>)"><span>ID</span><span class="sorting-indicator"></span></a></th>
          <th style="width:398px;padding-left:7px" scope="col" id="title" class="<?php if($sort["sortid_by"]=="title") echo $sort["custom_style"];  ?>" style="" ><a style=" padding: 0px; " href="javascript:ordering('title',<?php if($sort["sortid_by"]=="title") echo $sort["1_or_2"]; else echo "1"; ?>)"><span>Title</span><span class="sorting-indicator"></span></a></th>
          <th scope="col" id="published" class="<?php if($sort["sortid_by"]=="published") echo $sort["custom_style"];  ?>" style="width:80px" ><a style=" padding: 0px; " href="javascript:ordering('published',<?php if($sort["sortid_by"]=="published") echo $sort["1_or_2"]; else echo "1"; ?>)"><span>Published</span><span class="sorting-indicator"></span></a></th>
       </tr>
    </thead>
                
    <?php
    $k = 0;
	for($i=0, $n=count($rows); $i < $n ; $i++)
	{
		$row = &$rows[$i];
		$published 	= $row->published;
		
	
?>
        <tr class="<?php echo "row$k"; ?>">
        	<td class="table_small_col check-column" style="padding:9px 4px 6px 13px">
            <input type="checkbox" id="v<?php echo $i?>" value="<?php echo $row->id;?>" />
            <input type="hidden" id="title_<?php echo $i?>" value="<?php echo  htmlspecialchars($row->title);?>" />
          
            </td>
        	<td class="table_small_col"><?php echo $row->id?></td>
        	<td><a style="cursor: pointer;" onclick="window.parent.jSelectCategories(['<?php echo $row->id?>'],['<?php echo htmlspecialchars(addslashes($row->title));?>'])"><?php echo $row->title?></a></td>            
            <td ><?php echo $published?></td>        
        </tr>
        <?php
		$k = 1 - $k;
	}
	?>
    </table>
    <input type="hidden" name="asc_or_desc" id="asc_or_desc" value="<?php if(isset($_POST['asc_or_desc'])) echo esc_sql(esc_html(stripslashes($_POST['asc_or_desc']))); else echo "1"; ?>" />
 	<input type="hidden" name="order_by" id="order_by" value="<?php if(isset($_POST['order_by'])) echo esc_sql(esc_html(stripslashes($_POST['order_by']))); else echo 'id'; ?>" />
    <input type="hidden" name="option" value="com_Spider_Video_Player" />
    <input type="hidden" name="task" value="select_playlist" />    
    <input type="hidden" name="boxchecked" value="0" /> 
    </form>
    <?php
}











function spider_faq_select_standcategory(){
	require_once("nav_function/nav_html_func.php");
    global $wpdb;
	$order = "ORDER BY term_id";
	$sort["default_style"]="manage-column column-autor sortable desc";
	if(isset($_POST['page_number']))
	{
			
			if($_POST['asc_or_desc'])
			{
				$sort["sortid_by"]=esc_sql(esc_html(stripslashes($_POST['order_by'])));
				if($_POST['asc_or_desc']==1)
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
		$whereee= ' WHERE '.$wpdb->prefix.'term_taxonomy.taxonomy="category" AND '.$wpdb->prefix.'terms.name LIKE "%'.$search_tag.'%"';
	}
	else
	{
		$whereee='WHERE '.$wpdb->prefix.'term_taxonomy.taxonomy="category"';
	}
	
	
	
	// get the total number of records
	

	$query = "SELECT COUNT(*) FROM ".$wpdb->prefix."term_taxonomy left join ".$wpdb->prefix."terms on  ".$wpdb->prefix."terms.term_id=".$wpdb->prefix."term_taxonomy.term_id ". $whereee;
	$total = $wpdb->get_var($query);
	$pageNav['total'] =$total;
	
	$pageNav['limit'] =	 $limit/20+1;
	
	$query =	"SELECT ".$wpdb->prefix."term_taxonomy.*,".$wpdb->prefix."terms.name as catname FROM ".$wpdb->prefix."term_taxonomy left join ".$wpdb->prefix."terms on  ".$wpdb->prefix."terms.term_id=".$wpdb->prefix."term_taxonomy.term_id ".$whereee." ". $order." "." LIMIT ".$limit.",20";
$rows = $wpdb->get_results($query);	
	
	
	html_select_standcategory($rows, $pageNav,$sort);
	exit;
	
	}
	
	
	
	
	
	
	
	
function html_select_standcategory($rows, $pageNav, $sort) {
$serch_value = "";
if(!isset($sort["sortid_by"])) $sort["sortid_by"] = "term_id";
if(!isset($sort["custom_style"])) $sort["custom_style"] = "";
if(!isset($sort["1_or_2"])) $sort["1_or_2"]="2";
?>
<script type="text/javascript">

function submitbutton(pressbutton) {

var form = document.adminForm;

if (pressbutton == 'cancel') 

{

submitform( pressbutton );

return;

}

submitform( pressbutton );

}
function yyy()
{

	var cid =[];
	var titles =[];
	
	for(i=0; i<<?php echo count($rows) ?>; i++)
		if(document.getElementById("c"+i))
			if(document.getElementById("c"+i).checked)
			{
				cid.push(document.getElementById("c"+i).value);
				titles.push(document.getElementById("titles_"+i).value);
				
			}
	window.parent.jSelectStandCategories(cid, titles);
}
function ordering(name,as_or_desc)
	{
		document.getElementById('asc_or_desc').value=as_or_desc;		
		document.getElementById('order_by').value=name;
		document.getElementById('admin_form').submit();
	}
function checkAll( n, fldName ) {
  if (!fldName) {
     fldName = 'cb';
  }
	var f = document.adminForm;
	var c = f.toggle.checked;
	var n2 = 0;
	for (i=0; i < n; i++) {
		cb = eval( 'f.' + fldName + '' + i );
		if (cb) {
			cb.checked = c;
			n2++;
		}
	}
	if (c) {
		document.adminForm.boxchecked.value = n2;
	} else {
		document.adminForm.boxchecked.value = 0;
	}
}
</script>
<style>
input[type=checkbox]:before {
 font: 400 21px/1 Dashicons !important; 
}
input[type=checkbox] {
 max-width:16px !important;
 max-height:16px !important;
}
</style>
    <link media="all" type="text/css" href="<?php echo get_admin_url(); ?>load-styles.php?c=1&amp;dir=ltr&amp;load=admin-bar,wp-admin,dashicons,buttons,wp-auth-check" rel="stylesheet">
    <link media="all" type="text/css" href="<?php echo get_admin_url(); ?>css/colors<?php echo ((get_bloginfo('version') < '3.8') ? '-fresh' : ''); ?>.min.css" id="colors-css" rel="stylesheet">	  
	<form action="<?php echo admin_url('admin-ajax.php?action=spiderFaqselectstandcategory') ?>" method="post" id="admin_form" name="adminForm">
    
		<table style="width:98%">
           <td align="right" width="100%">
           <button onclick="yyy();" style="width:98px; height:34px; background:url(<?php echo plugins_url("images/add_but.png",__FILE__); ?>) no-repeat;border:none;cursor:pointer;">&nbsp;</button>        
             </td>

       </tr>
		</table>    
    
        <?php 
        if(isset($_POST['serch_or_not'])) {if($_POST['serch_or_not']=="search"){ $serch_value=esc_sql(esc_html(stripslashes($_POST['search_events_by_title']))); }else{$serch_value="";}} 
	$serch_fields='<div class="alignleft actions" style="width:180px;">
    	<label for="search_events_by_title" style="font-size:14px">Title: </label>
        <input type="text" name="search_events_by_title" value="'.$serch_value.'" id="search_events_by_title" onchange="clear_serch_texts()">
    </div>
	<div class="alignleft actions">
   		<input type="button" value="Search" onclick="document.getElementById(\'page_number\').value=\'1\'; document.getElementById(\'serch_or_not\').value=\'search\';
		 document.getElementById(\'admin_form\').submit();" class="button-secondary action">
		 <input type="button" value="Reset" onclick="window.location.href=\''. admin_url('admin-ajax.php?action=spiderFaqselectstandcategory').'\'" class="button-secondary action">
    </div>';
	 print_html_nav1($pageNav['total'],$pageNav['limit'],$serch_fields);	
	 ?>
    <table class="wp-list-table widefat plugins" style="margin:25px; width:93%" >
    <thead>
    	<tr style="position:inherit">
         <th style="width:44px;position:inherit;padding:19px 3px 6px 4px" class="manage-column column-cb check-column"><input  type="checkbox" name="toggle" id="toggle" value="" onclick="checkAll(<?php echo count($rows)?>, 'c')" style="margin-top: -9px;"></th>
         <th style="width:70px;padding-left:60px" scope="col" id="id" class="table_small_col <?php if($sort["sortid_by"]=="term_id") echo $sort["custom_style"]; ?>" style="width:110px" ><a style="padding:0px;" href="javascript:ordering('term_id',<?php if($sort["sortid_by"]=="term_id") echo $sort["1_or_2"]; else echo "1"; ?>)"><span style="align:center">ID</span><span class="sorting-indicator"></span></a></th>
         <th style="width: 79%;padding-left: 89px;" scope="col" id="title" class="<?php if($sort["sortid_by"]=="name") echo $sort["custom_style"]; ?>" style="" ><a style="padding:0px;" href="javascript:ordering('name',<?php if($sort["sortid_by"]=="name") echo $sort["1_or_2"]; else echo "1"; ?>)"><span>Title</span><span class="sorting-indicator"></span></a></th>
       </tr>
    </thead>	
    <?php	
    $k = 0;
	for($i=0, $n=count($rows); $i < $n ; $i++)
	{
		$row = &$rows[$i];
		
       ?>
        <tr class="<?php echo "row$k"; ?>">
        	<td class="table_small_col check-column" style="padding:9px 4px 6px 13px">
            <input type="checkbox" id="c<?php echo $i?>" value="<?php echo $row->term_id;?>" />
            <input type="hidden" id="titles_<?php echo $i?>" value="<?php echo  htmlspecialchars($row->catname);?>" />          
            </td>
        	<td class="table_small_col"><?php echo $row->term_id?></td>
        	<td style="padding-left: 105px;"><a style="cursor: pointer;" onclick="window.parent.jSelectStandCategories(['<?php echo $row->term_id?>'],['<?php echo htmlspecialchars(addslashes($row->catname));?>'])"><?php echo $row->catname?></a></td>            
                
        </tr>
        <?php
		$k = 1 - $k;
	}
	?>
    </table>
    <input type="hidden" name="asc_or_desc" id="asc_or_desc" value="<?php if(isset($_POST['asc_or_desc'])) echo esc_sql(esc_html(stripslashes($_POST['asc_or_desc']))); else echo "1"; ?>"  />
 	<input type="hidden" name="order_by" id="order_by" value="<?php if(isset($_POST['order_by'])) echo esc_sql(esc_html(stripslashes($_POST['order_by'])));else echo "term_id"; ?>"  />
    <input type="hidden" name="option" value="com_Spider_Video_Player">
    <input type="hidden" name="task" value="select_playlist">    
    <input type="hidden" name="boxchecked" value="0">     
    </form>
    <?php
}

function spider_faq_select_faq()
{
global $wpdb;

$query =	"SELECT id, title FROM ".$wpdb->prefix."spider_faq_faq";
$rows = $wpdb->get_results($query);	
	
	
	html_select_faq($rows);
	exit;
}



function html_select_faq($rows)
{
global $wpdb;
?>


	
   <html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Spider FAQ</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<script language="javascript" type="text/javascript" src="<?php echo get_option("siteurl"); ?>/wp-includes/js/jquery/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option("siteurl"); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option("siteurl"); ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option("siteurl"); ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<base target="_self">
</head>
<body id="link"  style="" dir="ltr" class="forceColors">
	<div class="tabs" role="tablist" tabindex="-1">
		<ul>
			<li id="spider_faq_tab" class="current" role="tab" tabindex="0"><span><a href="javascript:mcTabs.displayTab('spider_faq_tab','spider_faq_panel');" onMouseDown="return false;" tabindex="-1">Spider FAQ</a></span></li>
		</ul>
	</div>
    <style>
    .panel_wrapper{
		height:100px !important;
	}
    </style> 


    	<div class="panel_wrapper">
			<div id="spider_faq_panel" class="panel current">
                <table>
              	  <tr>
               		 <td style="height:50px; width:100px; vertical-align:top;">
                		Select a FAQ 
                	</td>
                	<td style="vertical-align:top">
<select name="Spider_Faqname" id="Spider_Faqname" style="width:200px;" >
<option value="- Select Spider_Faq -" selected="selected">- Select -</option>
<?php    $ids_Spider_Faq=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."spider_faq_faq order by title",0);
	   foreach($ids_Spider_Faq as $arr_Spider_Faq)
	   {
		   ?>
           <option value="<?php echo $arr_Spider_Faq->id; ?>"><?php echo $arr_Spider_Faq->title; ?></option>
           <?php }?>
</select>
 </td>
                </tr>
				

                </table>
                </div>
        </div>
        <div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();" />
		</div>

		<div style="float: right">
			<input type="submit" id="insert" name="insert" value="Insert" onClick="insert_Spider_FAQ();" />
		</div>
	</div>
<script type="text/javascript">
function insert_Spider_FAQ() {
	if(document.getElementById('Spider_Faqname').value=='- Select Spider FAQ -')
	{
		tinyMCEPopup.close();
	}
	else
	{
	   var tagtext;
	   tagtext='[Spider_FAQ id="'+document.getElementById('Spider_Faqname').value+'" ]';				
	   window.tinyMCE.execCommand('mceInsertContent', false, tagtext);
	   tinyMCEPopup.close();	  
	}
	
}

</script>
<?php 
}?>