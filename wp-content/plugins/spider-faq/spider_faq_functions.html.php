<?php   
function html_add_spider_faq($row,$theme_row){
	$value = "";
	$value1 = "";	
	
?>
<script type="text/javascript">


var next=0;
				 	function doNothing() {  
var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
    if( keyCode == 13 ) {


        if(!e) var e = window.event;

        e.cancelBubble = true;
        e.returnValue = false;

        if (e.stopPropagation) {
                e.stopPropagation();
                e.preventDefault();
        }
}
}


function jSelectCategories(catid, title) {
	

	
		cat_ids = document.getElementById('cats').value;
		
		tbody = document.getElementById('cat');
		
		var  str;
		str=document.getElementById('cats').value;
		
		
       
		
		for(i=0; i<catid.length; i++)
		{
		var  var_serch=","+catid[i]+",";
		
		
		if((!str)||str.indexOf(var_serch)==(-1)){

		
		
		
			tr = document.createElement('tr');
				tr.setAttribute('cat_id', catid[i]);
				tr.setAttribute('id', next);
				
	
	
				
			var td_info = document.createElement('td');
				td_info.setAttribute('id','info_'+next);
			//	td_info.setAttribute('width','60%');
			
			
			b = document.createElement('b');
				b.innerHTML = title[i];
				b.style.width='120px';
				b.style.float='left';
				b.style.position="inherit";
			
			
			td_info.appendChild(b);
			
			
			//td.appendChild(p_url);
			
			var img_X = document.createElement("img");
					img_X.setAttribute("src", "<?php echo plugins_url("images/delete_el.png",__FILE__); ?>");
//					img_X.setAttribute("height", "17");
					img_X.style.cssText = "cursor:pointer; margin-left:60px";
					img_X.setAttribute("onclick", 'remove_row("'+next+'")');
					
			var td_X = document.createElement("td");
					td_X.setAttribute("id", "X_"+next);
					td_X.setAttribute("valign", "middle");
//					td_X.setAttribute("align", "right");
					td_X.style.width='50px';
					td_X.appendChild(img_X);
					
			var img_UP = document.createElement("img");
					img_UP.setAttribute("src", "<?php echo plugins_url("images/up.png",__FILE__); ?>");
//					img_UP.setAttribute("height", "17");
					img_UP.style.cssText = "cursor:pointer";
					img_UP.setAttribute("onclick", 'up_row("'+next+'")');
					
			var td_UP = document.createElement("td");
					td_UP.setAttribute("id", "up_"+next);
					td_UP.setAttribute("valign", "middle");
					td_UP.style.width='20px';
					td_UP.appendChild(img_UP);
					
			var img_DOWN = document.createElement("img");
					img_DOWN.setAttribute("src", "<?php echo plugins_url("images/down.png",__FILE__); ?>");
//					img_DOWN.setAttribute("height", "17");
					img_DOWN.style.cssText = "margin:2px;cursor:pointer";
					img_DOWN.setAttribute("onclick", 'down_row("'+next+'")');
					
			var td_DOWN = document.createElement("td");
					td_DOWN.setAttribute("id", "down_"+next);
					td_DOWN.setAttribute("valign", "middle");
					td_DOWN.style.width='20px';
					td_DOWN.appendChild(img_DOWN);
				
			tr.appendChild(td_info);
			tr.appendChild(td_X);
			tr.appendChild(td_UP);
			tr.appendChild(td_DOWN);
			tbody.appendChild(tr);

//refresh
			next++;
			}
		}
		
		document.getElementById('cats').value=cat_ids;
		tb_remove();
		refresh_();
		
	}
	
function remove_row(id){	
	tr=document.getElementById(id);
	tr.parentNode.removeChild(tr);
	refresh_();
}

function refresh_(){

	cat=document.getElementById('cat');
	GLOBAL_tbody=cat;
	tox=',';
	for (x=0; x < GLOBAL_tbody.childNodes.length; x++)
	{
		tr=GLOBAL_tbody.childNodes[x];
		tox=tox+tr.getAttribute('cat_id')+',';
	}

	document.getElementById('cats').value=tox;
}

function up_row(id){
	form=document.getElementById(id).parentNode;
	k=0;
	while(form.childNodes[k])
	{
	if(form.childNodes[k].getAttribute("id"))
	if(id==form.childNodes[k].getAttribute("id"))
		break;
	k++;
	}
	if(k!=0)
	{
		up=form.childNodes[k-1];
		down=form.childNodes[k];
		form.removeChild(down);
		form.insertBefore(down, up);
		refresh_();
	}
}

function down_row(id){
	form=document.getElementById(id).parentNode;
	l=form.childNodes.length;
	k=0;
	while(form.childNodes[k])
	{
	if(id==form.childNodes[k].id)
		break;
	k++;
	}

	if(k!=l-1)
	{
		up=form.childNodes[k];
		down=form.childNodes[k+2];
		form.removeChild(up);
if(!down)
down=null;
		form.insertBefore(up, down);
		refresh_();
	}
}





var next=0;
function jSelectStandCategories(cid, ctitle) {
	

	
		cat_ids =document.getElementById('contcats').value;
		
		tbody = document.getElementById('contcat');
		
		var  str;
		str=document.getElementById('contcats').value;
		
		
       
		
		for(i=0; i<cid.length; i++)
		{
		var  var_serch=","+cid[i]+",";
		
		
		if((!str)||str.indexOf(var_serch)==(-1)){

		
		
		
			tr = document.createElement('tr');
				tr.setAttribute('cats_id', cid[i]);
				tr.setAttribute('id','cats_'+next);
				
	
	
				
			var td_info = document.createElement('td');
				td_info.setAttribute('id','cinfo_'+next);
			//	td_info.setAttribute('width','60%');
			
			
			b = document.createElement('b');
				b.innerHTML = ctitle[i];
				b.style.width='120px';
				b.style.float='left';
				b.style.position="inherit";
			
			
			td_info.appendChild(b);
			
			
			//td.appendChild(p_url);
			
			var img_X = document.createElement("img");
					img_X.setAttribute("src", "<?php echo plugins_url("images/delete_el.png",__FILE__); ?>");
//					img_X.setAttribute("height", "17");
					img_X.style.cssText = "cursor:pointer; margin-left:60px";
					img_X.setAttribute("onclick", 'contremove_row("'+"cats_"+next+'")');
					
					
			var td_X = document.createElement("td");
					td_X.setAttribute("id", "X_"+next);
					td_X.setAttribute("valign", "middle");
//					td_X.setAttribute("align", "right");
					td_X.style.width='50px';
					td_X.appendChild(img_X);
					
			var img_UP = document.createElement("img");
					img_UP.setAttribute("src", "<?php echo plugins_url("images/up.png",__FILE__); ?>");
//					img_UP.setAttribute("height", "17");
					img_UP.style.cssText = "cursor:pointer";
					img_UP.setAttribute("onclick", 'contup_row("'+"cats_"+next+'")');
					
			var td_UP = document.createElement("td");
					td_UP.setAttribute("id", "up_"+next);
					td_UP.setAttribute("valign", "middle");
					td_UP.style.width='20px';
					td_UP.appendChild(img_UP);
					
			var img_DOWN = document.createElement("img");
					img_DOWN.setAttribute("src", "<?php echo plugins_url("images/down.png",__FILE__); ?>");
//					img_DOWN.setAttribute("height", "17");
					img_DOWN.style.cssText = "margin:2px;cursor:pointer";
					img_DOWN.setAttribute("onclick", 'contdown_row("'+"cats_"+next+'")');
					
			var td_DOWN = document.createElement("td");
					td_DOWN.setAttribute("id", "down_"+next);
					td_DOWN.setAttribute("valign", "middle");
					td_DOWN.style.width='20px';
					td_DOWN.appendChild(img_DOWN);
				
			tr.appendChild(td_info);
			tr.appendChild(td_X);
			tr.appendChild(td_UP);
			tr.appendChild(td_DOWN);
			tbody.appendChild(tr);

//refresh
			next++;
			}
		}
		
		document.getElementById('contcats').value=cat_ids;
		tb_remove();
		contrefresh_();
		
	}
	
function contremove_row(id){	
	tr=document.getElementById(id);
	tr.parentNode.removeChild(tr);
	contrefresh_();
}

function contrefresh_(){
	cat=document.getElementById('contcat');
	
	GLOBAL_tbody=cat;
	tox=',';
	for (x=0; x < GLOBAL_tbody.childNodes.length; x++)
	{
		tr=GLOBAL_tbody.childNodes[x];
		tox=tox+tr.getAttribute('cats_id')+',';
	}

	document.getElementById('contcats').value=tox;
}

function contup_row(id){
	form=document.getElementById(id).parentNode;
	k=0;
	while(form.childNodes[k])
	{
	if(form.childNodes[k].getAttribute("id"))
	if(id==form.childNodes[k].getAttribute("id"))
		break;
	k++;
	}
	if(k!=0)
	{
		up=form.childNodes[k-1];
		down=form.childNodes[k];
		form.removeChild(down);
		form.insertBefore(down, up);
		contrefresh_();
	}
}

function contdown_row(id){
	form=document.getElementById(id).parentNode;
	l=form.childNodes.length;
	k=0;
	while(form.childNodes[k])
	{
	if(id==form.childNodes[k].id)
		break;
	k++;
	}

	if(k!=l-1)
	{
		up=form.childNodes[k];
		down=form.childNodes[k+2];
		form.removeChild(up);
if(!down)
down=null;
		form.insertBefore(up, down);
		contrefresh_();
	}
}

function submitbutton(pressbutton) 
{
	if(!document.getElementById('title').value){
	alert("Title is required.");
	return;
	
	}
	
	document.getElementById("adminForm").action=document.getElementById("adminForm").action+"&task="+pressbutton;
	document.getElementById("adminForm").submit();
	
}



</script>



<table width="95%">
  <tbody>
<tr>
        	<td width="100%" style="font-size:14px; font-weight:bold"><a href="http://web-dorado.com/spider-faq-wordpress-guide-step-5.html" target="_blank" style="color:blue; text-decoration:none;">User Manual</a><br>
This section allows you to create FAQs. You can add unlimited number of FAQs. <a href="http://web-dorado.com/spider-faq-wordpress-guide-step-5.html" target="_blank" style="color:blue; text-decoration:none;">More...</a></td>
            
   			</tr>
  <tr>
  <td width="100%"><h2>Add FAQ</h2></td>
  <td align="right"><input type="button" onclick="submitbutton('save')" value="Save" class="button-secondary action"> </td>  
  <td align="right"><input type="button" onclick="submitbutton('apply')" value="Apply" class="button-secondary action"> </td> 
  <td align="right"><input type="button" onclick="window.location.href='admin.php?page=Spider_Faq'" value="Cancel" class="button-secondary action"> </td> 
  </tr>
  </tbody></table>
  <br />
  <br />
<form action="admin.php?page=Spider_Faq" method="post" onkeypress="doNothing()" name="adminForm" id="adminForm">
<?php $sp_faq_nonce = wp_create_nonce('nonce_sp_faq'); ?>
<table class="admintable">


<tr>
<td width="180px" align="right" class="key">
Title:
</td>
<td>
<input class="text_area" type="text" name="title" id="title" size="50"  maxlength="250" value="<?php echo $row->title;?>">
</td>
</tr>
</table>



<ul>
<li>
<span style="margin-left:56px">Use Standard Category:</span>
	<input type="radio" name="standcat"  value="0" onChange="show_(0)"  checked="checked" id="show0"><label for="show0"> No</label>	
	<input type="radio" name="standcat" value="1"  onChange="show_(1)"  id="show1"><label for="show1">Yes</label>
	
</li>


<span id="cuc"></span>
<script type="text/javascript">

function show_(x)
{
	
	if(x==0)
	{
	document.getElementById('cuc').parentNode.childNodes[9].setAttribute('style','display:none');	
	document.getElementById('cuc').parentNode.childNodes[7].removeAttribute('style');	
	}
	else
	{
    document.getElementById('cuc').parentNode.childNodes[7].setAttribute('style','display:none');	
	document.getElementById('cuc').parentNode.childNodes[9].removeAttribute('style');
	}
	
}
</script>


<li>
<span style="margin-left:85px">Select Categories:</span>
<table style="margin-left:187px; margin-top:-17px">
<tr>
<td>
<a href="<?php echo admin_url('admin-ajax.php?action=spiderFaqselectcategory') ?>&post_id=270&amp;TB_iframe=1&amp;width=1024&amp;height=394" class="thickbox thickbox-preview" id="content-add_media" title="Add Category" onclick="return false;"><img src="<?php echo plugins_url("images/add_but.png",__FILE__) ?>" ></a>

<table width="30%">
<tbody id="cat"></tbody>
</table>
</td>
</tr>
</table>
<input type="hidden" name="params" id="cats" value="<?php echo $value; ?>">

 

		<script type="text/javascript">
        
		show1=document.getElementById("show1").checked;
	if (show1)
	{
document.getElementById('cuc').parentNode.childNodes[7].setAttribute('style','display:none');

	}
	
        </script>
</li>



<li>
<span style="margin-left:85px">Select Categories:</span>
<table style="margin-left:187px; margin-top:-17px">
<tr>
<td>
<a href="<?php echo admin_url('admin-ajax.php?action=spiderFaqselectstandcategory') ?>&post_id=270&amp;TB_iframe=1&amp;width=1024&amp;height=394" class="thickbox thickbox-preview" id="content-add_media" title="Add Media" onclick="return false;"><img src="<?php echo plugins_url("images/add_but.png",__FILE__) ?>" ></a>

<table width="30%">
<tbody id="contcat"></tbody>
</table>
</td>
</tr>
</table>

<input type="hidden" name="contcats" id="contcats" value="<?php echo $value1; ?>">



	<script type="text/javascript">
        
		show0=document.getElementById("show0").checked;
	if (show0)
	{
document.getElementById('cuc').parentNode.childNodes[9].setAttribute('style','display:none');

	}
	
</script>
</li>
</ul>

<table class="admintable">
<tr>
<td width="182px" align="right" class="key">
Show Search Form:
</td>
<td>
<input type="radio" name="show_searchform"   value="0"  id="show_searchform0"><label for="show_searchform0">No</label>	 
<input type="radio" name="show_searchform"  value="1"  checked="checked" id="show_searchform1"><label for="show_searchform1">Yes</label>
</td>
</tr>

<tr>
<td width="182px" align="right" class="key">
Expand All Answers After The Page Is Loaded:
</td>
<td width="100px">
<input type="radio" name="expand"   value="0" checked="checked" id="expand0"><label for="expand0">No</label>	 
<input type="radio" name="expand"  value="1"   id="expand1"><label for="expand1">Yes</label>
</td>
</tr>

                    <tr>
				<td  width="182px" align="right" class="key">
                		Category Numbering: 
                	</td>
				<td style="width:100px; vertical-align:top;">
				  <input name="faq_numbertext" id="faq_numbertext"  type="radio" value="0" >
				  <span>No</span>
				        <input name="faq_numbertext" id="faq_numbertext"  type="radio" value="1" checked="checked">
						<span>Yes</span>

				</td>
				</tr>
				<tr>
                     <td  width="182px" align="right" class="key">
                		Like: 
                	</td>
				<td style="width:100px; vertical-align:top;">
				  <input name="faq_like" id="faq_like"  type="radio" value="0" >
				  <span>No</span>
				        <input name="faq_like" id="faq_like"  type="radio" value="1" checked="checked">
						<span>Yes</span>

				</td>
				</tr>
				<tr>
				<td  width="182px" align="right" class="key">
                		Hits: 
                	</td>
				<td style="width:100px; vertical-align:top;">
				  <input name="faq_hits" id="faq_hits"  type="radio" value="0" >
				  <span>No</span>
				        <input name="faq_hits" id="faq_hits"  type="radio" value="1" checked="checked">
						<span>Yes</span>

				</td>
				</tr>
				<tr>
				<td  width="182px" align="right" class="key">
                		Date: 
                	</td>
				<td style="width:100px; vertical-align:top;">
				  <input name="faq_date" id="faq_date"  type="radio" value="0"  >
				  <span>No</span>
				        <input name="faq_date" id="faq_date"  type="radio" value="1" checked="checked">
						<span>Yes</span>

				</td>
				</tr>
				<tr>
				<td  width="182px" align="right" class="key">
                		User: 
                	</td>
				<td style="width:100px; vertical-align:top;">
				  <input name="faq_user" id="faq_user"  type="radio" value="0"  >
				  <span>No</span>
				        <input name="faq_user" id="faq_user"  type="radio" value="1" checked="checked">
						<span>Yes</span>

				</td>
				</tr>
</table>
<?php wp_nonce_field('nonce_sp_faq', 'nonce_sp_faq'); ?>
<input type="hidden" name="id"
value="<?php echo $row->id; ?>" />
<input type="hidden" name="task" value="" />
</form>
<?php




}








function 	html_show_spider_faq($rows, $pageNav,$sort){
	global $wpdb;
	?>
    <script language="javascript">
	function ordering(name,as_or_desc)
	{
		document.getElementById('asc_or_desc').value=as_or_desc;		
		document.getElementById('order_by').value=name;
		document.getElementById('admin_form').submit();
	}
	function saveorder()
	{
		document.getElementById('saveorder').value="save";
		document.getElementById('admin_form').submit();
		
	}
	function listItemTask(this_id,replace_id)
	{
		document.getElementById('oreder_move').value=this_id+","+replace_id;
		document.getElementById('admin_form').submit();
	}
				 	function doNothing() {  
var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
    if( keyCode == 13 ) {


        if(!e) var e = window.event;

        e.cancelBubble = true;
        e.returnValue = false;

        if (e.stopPropagation) {
                e.stopPropagation();
                e.preventDefault();
        }
}
}
	</script>
    <form method="post"  onkeypress="doNothing()" action="admin.php?page=Spider_Faq" id="admin_form" name="admin_form">
	 <?php $sp_faq_nonce = wp_create_nonce('nonce_sp_faq'); ?>
	 <div style="display:block;width:95%;text-align:right"><a href="http://web-dorado.com/files/fromFAQWP.php" target="_blank" style="color:red; text-decoration:none;">
            <img src="<?php echo plugins_url('images/header.png',__FILE__) ?>" border="0" alt="http://web-dorado.com/files" width="215"><br>
            Get the full version&nbsp;&nbsp;&nbsp;&nbsp;
            </a>
			</div>
	<table cellspacing="10" width="100%">
	<tr>
        	<td width="100%" style="font-size:14px; font-weight:bold"><a href="http://web-dorado.com/spider-faq-wordpress-guide-step-5.html" target="_blank" style="color:blue; text-decoration:none;">User Manual</a><br>
This section allows you to create FAQs. You can add unlimited number of FAQs. <a href="http://web-dorado.com/spider-faq-wordpress-guide-step-5.html" target="_blank" style="color:blue; text-decoration:none;">More...</a></td>
           
   			</tr>
    <tr>
    <td style="width:80px">
    <?php echo "<h2>".'FAQs'. "</h2>"; ?>
    </td>
    <td  style="width:90px; text-align:right;"><p class="submit" style="padding:0px; text-align:left"><input type="button" value="Add an FAQ" name="custom_parametrs" onclick="window.location.href='admin.php?page=Spider_Faq&task=add_Spider_Faq'" /></p></td>
<td style="text-align:right;font-size:16px;padding:20px; padding-right:30px">

	</td>
	
    </tr>
    </table>
    <?php
	$serch_value = "";
	if(isset($_POST['serch_or_not'])) {if(esc_html($_POST['serch_or_not'])=="search"){ $serch_value=esc_js(esc_html(stripslashes($_POST['search_events_by_title']))); }else{$serch_value="";}} 
	$serch_fields='<div class="alignleft actions" style="width:204px;">
    	<label for="search_events_by_title" style="font-size:14px">Title: </label>
        <input type="text" name="search_events_by_title" value="'.$serch_value.'" id="search_events_by_title" onchange="clear_serch_texts()">
    </div>
	<div class="alignleft actions" style="padding: 2px 8px 5px 2px;">
   		<input type="button" value="Search" onclick="document.getElementById(\'page_number\').value=\'1\'; document.getElementById(\'serch_or_not\').value=\'search\';
		 document.getElementById(\'admin_form\').submit();" class="button-secondary action">
		 <input type="button" value="Reset" onclick="window.location.href=\'admin.php?page=Spider_Faq\'" class="button-secondary action">
    </div>';
	 print_html_nav1($pageNav['total'],$pageNav['limit'],$serch_fields);	
	
	?>
  <table class="wp-list-table widefat fixed pages" style="width:95%">
 <thead>
 <TR>
   <th scope="col" id="id"  class="<?php if($sort["sortid_by"]=="id") echo $sort["custom_style"];  ?>" style="width:45px;padding: 2px 11px 2px 0px;" ><a style="padding: 8px 4px 7px 10px;" href="javascript:ordering('id',<?php if($sort["sortid_by"]=="id") echo $sort["1_or_2"]; else echo "1"; ?>)"><span>ID</span><span style="margin-top:6px; margin-left:5px" class="sorting-indicator"></span></a></th>
 <th scope="col" id="title" class="<?php if($sort["sortid_by"]=="title") echo $sort["custom_style"];  ?>" style="" ><a href="javascript:ordering('title',<?php if($sort["sortid_by"]=="title") echo $sort["1_or_2"]; else echo "1"; ?>)"><span>Title</span><span class="sorting-indicator"></span></a></th>

 <th style="width:80px">Edit</th>
 <th style="width:80px">Delete</th>
 </TR>
 </thead>
 <tbody>
 <?php 
  for($i=0; $i<count($rows);$i++){ 
	  if(isset($rows[$i-1]->id))
		  {
		  $move_up='<span><a href="#reorder" onclick="return listItemTask(\''.$rows[$i]->id.'\',\''.$rows[$i-1]->id.'\')" title="Move Up">   <img src="'.plugins_url('images/uparrow.png',__FILE__).'" width="16" height="16" border="0" alt="Move Up"></a></span>';
		  }
	  else
	  	{
			$move_up="";
	  	}
		if(isset($rows[$i+1]->id))
  		$move_down='<span><a href="#reorder" onclick="return listItemTask(\''.$rows[$i]->id.'\',\''.$rows[$i+1]->id.'\')" title="Move Down">  <img src="'.plugins_url('images/downarrow.png',__FILE__).'" width="16" height="16" border="0" alt="Move Down"></a></span>';
  		else
  		$move_down="";
  		
  ?>
 <tr>
         <td><div style="width:30px"><?php echo $rows[$i]->id; ?></div></td>
         <td><a  href="admin.php?page=Spider_Faq&task=edit_Spider_Faq&id=<?php echo $rows[$i]->id?>"><?php echo $rows[$i]->title; ?></a></td>
        
         
         
         <td ><a  href="admin.php?page=Spider_Faq&task=edit_Spider_Faq&id=<?php echo $rows[$i]->id?>">Edit</a></td>
         
		 <td><a href="javascript:confirmation('admin.php?page=Spider_Faq&task=remove_Spider_Faq&id=<?php echo $rows[$i]->id ?>&_wpnonce=<?php echo $sp_faq_nonce; ?>','<?php if($rows[$i]->title!="") echo addslashes($rows[$i]->title); else echo "" ?>')">Delete</a> </td>
  </tr> 
 <?php } ?>
 </tbody>
 </table>
 <?php wp_nonce_field('nonce_sp_faq', 'nonce_sp_faq'); ?>
 <input type="hidden" name="oreder_move" id="oreder_move" value="" />
 <input type="hidden" name="asc_or_desc" id="asc_or_desc" value="<?php if(isset($_POST['asc_or_desc'])) echo esc_js(esc_html(stripslashes($_POST['asc_or_desc'])));?>"  />
 <input type="hidden" name="order_by" id="order_by" value="<?php if(isset($_POST['order_by'])) echo esc_js(esc_html(stripslashes($_POST['order_by'])));?>"  />
 <input type="hidden" name="saveorder" id="saveorder" value="" />

 <?php
?>
    
    
   
 </form>
    <?php


	}
	
?>	
<script>

 	function confirmation(href,title) {
	
		var answer = confirm("Are you sure you want to delete '"+title+"'?")
		if (answer){
			document.getElementById('admin_form').action=href;
			document.getElementById('admin_form').submit();
		}
		else{
		}
	
	
	
	}
	</script>	
	
	
	
<?php	
	
	
	
	
	
	
	
	
 function html_edit_spider_faq($row,$theme_row){
global  $wpdb;
$theme_select = "";
$value = "";
$value1 = "";
?>
<script type="text/javascript">


var next=0;
				 	function doNothing() {  
var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
    if( keyCode == 13 ) {


        if(!e) var e = window.event;

        e.cancelBubble = true;
        e.returnValue = false;

        if (e.stopPropagation) {
                e.stopPropagation();
                e.preventDefault();
        }
}
}


function jSelectCategories(catid, title) {
	

	
		cat_ids = document.getElementById('cats').value;
		
		tbody = document.getElementById('cat');
		
		var  str;
		str=document.getElementById('cats').value;
		
		
       
		
		for(i=0; i<catid.length; i++)
		{
		var  var_serch=","+catid[i]+",";
		
		
		if((!str)||str.indexOf(var_serch)==(-1)){

		
		
		
			tr = document.createElement('tr');
				tr.setAttribute('cat_id', catid[i]);
				tr.setAttribute('id', next);
				
	
	
				
			var td_info = document.createElement('td');
				td_info.setAttribute('id','info_'+next);
			//	td_info.setAttribute('width','60%');
			
			
			b = document.createElement('b');
				b.innerHTML = title[i];
				b.style.width='70px';
				b.style.float='left';
				b.style.position="inherit";
			
			
			td_info.appendChild(b);
			
			
			//td.appendChild(p_url);
			
			var img_X = document.createElement("img");
					img_X.setAttribute("src", "<?php echo plugins_url("images/delete_el.png",__FILE__); ?>");
//					img_X.setAttribute("height", "17");
					img_X.style.cssText = "cursor:pointer; margin-left:60px";
					img_X.setAttribute("onclick", 'remove_row("'+next+'")');
					
			var td_X = document.createElement("td");
					td_X.setAttribute("id", "X_"+next);
					td_X.setAttribute("valign", "middle");
//					td_X.setAttribute("align", "right");
					td_X.style.width='50px';
					td_X.appendChild(img_X);
					
			var img_UP = document.createElement("img");
					img_UP.setAttribute("src", "<?php echo plugins_url("images/up.png",__FILE__); ?>");
//					img_UP.setAttribute("height", "17");
					img_UP.style.cssText = "cursor:pointer";
					img_UP.setAttribute("onclick", 'up_row("'+next+'")');
					
			var td_UP = document.createElement("td");
					td_UP.setAttribute("id", "up_"+next);
					td_UP.setAttribute("valign", "middle");
					td_UP.style.width='20px';
					td_UP.appendChild(img_UP);
					
			var img_DOWN = document.createElement("img");
					img_DOWN.setAttribute("src", "<?php echo plugins_url("images/down.png",__FILE__); ?>");
//					img_DOWN.setAttribute("height", "17");
					img_DOWN.style.cssText = "margin:2px;cursor:pointer";
					img_DOWN.setAttribute("onclick", 'down_row("'+next+'")');
					
			var td_DOWN = document.createElement("td");
					td_DOWN.setAttribute("id", "down_"+next);
					td_DOWN.setAttribute("valign", "middle");
					td_DOWN.style.width='20px';
					td_DOWN.appendChild(img_DOWN);
				
			tr.appendChild(td_info);
			tr.appendChild(td_X);
			tr.appendChild(td_UP);
			tr.appendChild(td_DOWN);
			tbody.appendChild(tr);

//refresh
			next++;
			}
		}
		
		document.getElementById('cats').value=cat_ids;
		tb_remove();
		refresh_();
		
	}
	
function remove_row(id){	
	tr=document.getElementById(id);
	tr.parentNode.removeChild(tr);
	refresh_();
}

function refresh_(){

	cat=document.getElementById('cat');
	GLOBAL_tbody=cat;
	tox=',';
	for (x=0; x < GLOBAL_tbody.childNodes.length; x++)
	{
		tr=GLOBAL_tbody.childNodes[x];
		tox=tox+tr.getAttribute('cat_id')+',';
	}

	document.getElementById('cats').value=tox;
}

function up_row(id){
	form=document.getElementById(id).parentNode;
	k=0;
	while(form.childNodes[k])
	{
	if(form.childNodes[k].getAttribute("id"))
	if(id==form.childNodes[k].getAttribute("id"))
		break;
	k++;
	}
	if(k!=0)
	{
		up=form.childNodes[k-1];
		down=form.childNodes[k];
		form.removeChild(down);
		form.insertBefore(down, up);
		refresh_();
	}
}

function down_row(id){
	form=document.getElementById(id).parentNode;
	l=form.childNodes.length;
	k=0;
	while(form.childNodes[k])
	{
	if(id==form.childNodes[k].id)
		break;
	k++;
	}

	if(k!=l-1)
	{
		up=form.childNodes[k];
		down=form.childNodes[k+2];
		form.removeChild(up);
if(!down)
down=null;
		form.insertBefore(up, down);
		refresh_();
	}
}




var next=0;
function jSelectStandCategories(cid, ctitle) {
	

	
		cat_ids =document.getElementById('contcats').value;
		
		tbody = document.getElementById('contcat');
		
		var  str;
		str=document.getElementById('contcats').value;
		
		
       
		
		for(i=0; i<cid.length; i++)
		{
		var  var_serch=","+cid[i]+",";
		
		
		if((!str)||str.indexOf(var_serch)==(-1)){

		
		
		
			tr = document.createElement('tr');
				tr.setAttribute('cats_id', cid[i]);
				tr.setAttribute('id','cats_'+next);
				
	
	
				
			var td_info = document.createElement('td');
				td_info.setAttribute('id','cinfo_'+next);
			//	td_info.setAttribute('width','60%');
			
			
			b = document.createElement('b');
				b.innerHTML = ctitle[i];
				b.style.width='120px';
				b.style.float='left';
				b.style.position="inherit";
			
			
			td_info.appendChild(b);
			
			
			//td.appendChild(p_url);
			
			var img_X = document.createElement("img");
					img_X.setAttribute("src", "<?php echo plugins_url("images/delete_el.png",__FILE__); ?>");
//					img_X.setAttribute("height", "17");
					img_X.style.cssText = "cursor:pointer; margin-left:60px";
					img_X.setAttribute("onclick", 'contremove_row("'+"cats_"+next+'")');
					
					
			var td_X = document.createElement("td");
					td_X.setAttribute("id", "X_"+next);
					td_X.setAttribute("valign", "middle");
//					td_X.setAttribute("align", "right");
					td_X.style.width='50px';
					td_X.appendChild(img_X);
					
			var img_UP = document.createElement("img");
					img_UP.setAttribute("src", "<?php echo plugins_url("images/up.png",__FILE__); ?>");
//					img_UP.setAttribute("height", "17");
					img_UP.style.cssText = "cursor:pointer";
					img_UP.setAttribute("onclick", 'contup_row("'+"cats_"+next+'")');
					
			var td_UP = document.createElement("td");
					td_UP.setAttribute("id", "up_"+next);
					td_UP.setAttribute("valign", "middle");
					td_UP.style.width='20px';
					td_UP.appendChild(img_UP);
					
			var img_DOWN = document.createElement("img");
					img_DOWN.setAttribute("src", "<?php echo plugins_url("images/down.png",__FILE__); ?>");
//					img_DOWN.setAttribute("height", "17");
					img_DOWN.style.cssText = "margin:2px;cursor:pointer";
					img_DOWN.setAttribute("onclick", 'contdown_row("'+"cats_"+next+'")');
					
			var td_DOWN = document.createElement("td");
					td_DOWN.setAttribute("id", "down_"+next);
					td_DOWN.setAttribute("valign", "middle");
					td_DOWN.style.width='20px';
					td_DOWN.appendChild(img_DOWN);
				
			tr.appendChild(td_info);
			tr.appendChild(td_X);
			tr.appendChild(td_UP);
			tr.appendChild(td_DOWN);
			tbody.appendChild(tr);

//refresh
			next++;
			}
		}
		
		document.getElementById('contcats').value=cat_ids;
		tb_remove();
		contrefresh_();
		
	}
	
function contremove_row(id){	
	tr=document.getElementById(id);
	tr.parentNode.removeChild(tr);
	contrefresh_();
}

function contrefresh_(){
	cat=document.getElementById('contcat');
	
	GLOBAL_tbody=cat;
	tox=',';
	for (x=0; x < GLOBAL_tbody.childNodes.length; x++)
	{
		tr=GLOBAL_tbody.childNodes[x];
		tox=tox+tr.getAttribute('cats_id')+',';
	}

	document.getElementById('contcats').value=tox;
}

function contup_row(id){
	form=document.getElementById(id).parentNode;
	k=0;
	while(form.childNodes[k])
	{
	if(form.childNodes[k].getAttribute("id"))
	if(id==form.childNodes[k].getAttribute("id"))
		break;
	k++;
	}
	if(k!=0)
	{
		up=form.childNodes[k-1];
		down=form.childNodes[k];
		form.removeChild(down);
		form.insertBefore(down, up);
		contrefresh_();
	}
}

function contdown_row(id){
	form=document.getElementById(id).parentNode;
	l=form.childNodes.length;
	k=0;
	while(form.childNodes[k])
	{
	if(id==form.childNodes[k].id)
		break;
	k++;
	}

	if(k!=l-1)
	{
		up=form.childNodes[k];
		down=form.childNodes[k+2];
		form.removeChild(up);
if(!down)
down=null;
		form.insertBefore(up, down);
		contrefresh_();
	}
}


function submitbutton(pressbutton) 
{
	if(!document.getElementById('title').value){
	alert("Title is required.");
	return;
	
	}
	
	document.getElementById("adminForm").action=document.getElementById("adminForm").action+"&task="+pressbutton;
	document.getElementById("adminForm").submit();
	
}



</script>




<table width="95%">
  <tbody>
<tr>
        	<td width="100%" style="font-size:14px; font-weight:bold"><a href="http://web-dorado.com/spider-faq-wordpress-guide-step-5.html" target="_blank" style="color:blue; text-decoration:none;">User Manual</a><br>
This section allows you to create FAQs. You can add unlimited number of FAQs. <a href="http://web-dorado.com/spider-faq-wordpress-guide-step-5.html" target="_blank" style="color:blue; text-decoration:none;">More...</a></td>
            
   			</tr>
  <tr>
  <td width="100%"><h2>FAQ - <?php echo stripslashes($row->title) ?></h2></td>
  <td align="right"><input type="button" onclick="submitbutton('save')" value="Save" class="button-secondary action"> </td>  
  <td align="right"><input type="button" onclick="submitbutton('apply')" value="Apply" class="button-secondary action"> </td> 
  <td align="right"><input type="button" onclick="window.location.href='admin.php?page=Spider_Faq'" value="Cancel" class="button-secondary action"> </td> 
  </tr>
  </tbody></table>
  <br />
  <br />
<form action="admin.php?page=Spider_Faq&id=<?php echo $row->id; ?>" method="post" name="adminForm" id="adminForm">

<table class="admintable">
<tr>
<td width="180px" align="right" class="key">
Title:
</td>
<td>
<input class="text_area" type="text" name="title" id="title"  value="<?php echo $row->title;?>" />
</td>
</tr>
</table>



<ul>
<li>
<span style="margin-left:56px">Use Standard Category:</span>
	<input type="radio" name="standcat"  value="0" onChange="show_(0)"  <?php if($row->standcat==0) echo 'checked="checked"'?>  id="show0"><label for="show0"> No</label>	
	<input type="radio" name="standcat" value="1"  onChange="show_(1)"  <?php if($row->standcat==1) echo 'checked="checked"'?>  id="show1"><label for="show1">Yes</label>
	
</li>


<span id="cuc1"></span>
<script type="text/javascript">

function show_(x)
{
	
	if(x==0)
	{
	document.getElementById('cuc1').parentNode.childNodes[9].setAttribute('style','display:none');	
	document.getElementById('cuc1').parentNode.childNodes[7].removeAttribute('style');	
	}
	else
	{
    document.getElementById('cuc1').parentNode.childNodes[7].setAttribute('style','display:none');	
	document.getElementById('cuc1').parentNode.childNodes[9].removeAttribute('style');
	}
	
}
</script>


<li>
<span style="margin-left:85px">Select Categories:</span>
<table style="margin-left:187px; margin-top:-17px">
<tr>
<td>
<a href="<?php echo admin_url('admin-ajax.php?action=spiderFaqselectcategory') ?>&post_id=270&amp;TB_iframe=1&amp;width=1024&amp;height=394" class="thickbox thickbox-preview" id="content-add_media" title="Add Media" onclick="return false;"><img src="<?php echo plugins_url("images/add_but.png",__FILE__) ?>" ></a>

<table width="30%">
<tbody id="cat"></tbody>
</table>
</td>
</tr>
<input type="hidden" name="params" id="cats" value="<?php echo $value; ?>">

<?php

$value=$row->category;
	$cats=array();
	$cats_id=explode(',',$value);
	
	$cats_id= array_slice($cats_id,1, count($cats_id)-2);  



	foreach($cats_id as $id)
	{
	
		$query =$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."spider_faq_category WHERE id='%d'",$id);
		
		$cats[] = $wpdb->get_results($query);
	
	}
	
if($cats)
{
	foreach($cats as $cat)
	{
		$v_ids[]=$cat[0]->id;
		$v_titles[]=addslashes($cat[0]->title);
		
	}

	$v_id='["'.implode('","',$v_ids).'"]';
	$v_title='["'.implode('","',$v_titles).'"]';
	//print_r ($v_title);
	?>
<script type="text/javascript">                
jSelectCategories(<?php echo $v_id?>,<?php echo $v_title?>);
<?php
}

?>
 </script>
 

		<script type="text/javascript">
        
		show1=document.getElementById("show1").checked;
	if (show1)
	{
document.getElementById('cuc1').parentNode.childNodes[7].setAttribute('style','display:none');

	}
	
        </script>
</table>


</li>


<li>
<span style="margin-left:85px">Select Categories:</span>
<table style="margin-left:187px; margin-top:-17px">
<tr>
<td>
<a href="<?php echo admin_url('admin-ajax.php?action=spiderFaqselectstandcategory') ?>&post_id=270&amp;TB_iframe=1&amp;width=1024&amp;height=394" class="thickbox thickbox-preview" id="content-add_media" title="Add Media" onclick="return false;"><img src="<?php echo plugins_url("images/add_but.png",__FILE__) ?>" ></a>

<table width="30%">
<tbody id="contcat"></tbody>
</table>
</td>
</tr>

<input type="hidden" name="contcats" id="contcats" value="<?php echo $value1; ?>">

<?php 

$value1=$row->standcategory; 
	
	$cats_id1=explode(',',$value1);
	
	$cats_id1= array_slice($cats_id1,1, count($cats_id1)-2);  

		
		
		$cats1 = array();
	
	foreach($cats_id1 as $catid)
	{
	
		$query =$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."terms WHERE term_id='%d'",$catid);
		
		$cats1[] = $wpdb->get_row($query);
	
	}

if($cats1)
{
	for($i=0;$i<count($cats1);$i++) { 
		 if($cats1[$i]!=NULL) {
			$v_ids1[]=$cats1[$i]->term_id;
			$v_titles1[]=addslashes($cats1[$i]->name);
		 }
	 }
	

	$v_id1='["'.implode('","',$v_ids1).'"]';
	$v_title1='["'.implode('","',$v_titles1).'"]';
	//print_r ($v_title);
	?>
<script type="text/javascript">                
jSelectStandCategories(<?php echo $v_id1?>,<?php echo $v_title1?>);

 </script>
 
<?php
}

?>
		<script type="text/javascript">
        
		show0=document.getElementById("show0").checked;
	if (show0)
	{
document.getElementById('cuc1').parentNode.childNodes[9].setAttribute('style','display:none');

	}
	
        </script>


</table>


</li>



</ul>


<table class="admintable">
<tr>
<td width="182px" align="right" class="key">
Show Search Form:
</td>
<td>
<input type="radio" name="show_searchform"   value="0" <?php if($row->show_searchform==0) echo 'checked="checked"'?> id="show_searchform0"><label for="show_searchform0">No</label>	 
<input type="radio" name="show_searchform"  value="1"  <?php if($row->show_searchform==1) echo 'checked="checked"'?> id="show_searchform1"><label for="show_searchform1">Yes</label>
</td>
</tr>

<tr>
<td width="182px" align="right" class="key">
Expand All Answers After The Page Is Loaded:
</td>
<td width="100px">
<input type="radio" name="expand"   value="0" <?php if($row->expand==0) echo 'checked="checked"'?> id="expand0"><label for="expand0">No</label>	 
<input type="radio" name="expand"  value="1"  <?php if($row->expand==1) echo 'checked="checked"'?> id="expand1"><label for="expand1">Yes</label>
</td>
</tr>
<tr>
				<td  width="182px" align="right" class="key">
                	Category Numbering: 
                	</td>
				<td style="width:100px; vertical-align:top;">
				  <input name="faq_numbertext" id="faq_numbertext"  type="radio" value="0" <?php if($row->numbertext==0) echo 'checked="checked"';?> >     
				  <span>No</span>
				        <input name="faq_numbertext" id="faq_numbertext"  type="radio" value="1" <?php if($row->numbertext==1) echo 'checked="checked"';?>>
						<span>Yes</span>

				</td>
				</tr>
				<tr>
                     <td  width="182px" align="right" class="key">
                		Like: 
                	</td>
				<td style="width:100px; vertical-align:top;">
				  <input name="faq_like" id="faq_like"  type="radio" value="0" <?php if($row->like==0) echo 'checked="checked"';?>>
				  <span>No</span>
				        <input name="faq_like" id="faq_like"  type="radio" value="1" <?php if($row->like==1) echo 'checked="checked"';?>>
						<span>Yes</span>

				</td>
				</tr>
				<tr>
				<td  width="182px" align="right" class="key">
                		Hits: 
                	</td>
				<td style="width:100px; vertical-align:top;">
				  <input name="faq_hits" id="faq_hits"  type="radio" value="0"  <?php if($row->hits==0) echo 'checked="checked"';?>>
				  <span>No</span>
				        <input name="faq_hits" id="faq_hits"  type="radio" value="1"  <?php if($row->hits==1) echo 'checked="checked"';?>>
						<span>Yes</span>

				</td>
				</tr>
				<tr>
				<td  width="182px" align="right" class="key">
                		Date: 
                	</td>
				<td style="width:100px; vertical-align:top;">
				  <input name="faq_date" id="faq_date"  type="radio" value="0" <?php if($row->date==0) echo 'checked="checked"';?>>
				  <span>No</span>
				    <input name="faq_date" id="faq_date"  type="radio" value="1" <?php if($row->date==1) echo 'checked="checked"';?>>
					<span>Yes</span>

				</td>
				</tr>
				<tr>
				<td  width="182px" align="right" class="key">
                		User: 
                	</td>
				<td style="width:100px; vertical-align:top;">
				  <input name="faq_user" id="faq_user"  type="radio" value="0" <?php if($row->user==0) echo 'checked="checked"';?> >
				  <span>No</span>
				        <input name="faq_user" id="faq_user"  type="radio" value="1" <?php if($row->user==1) echo 'checked="checked"';?>>
						<span>Yes</span>

				</td>
				</tr>
</table>


<?php wp_nonce_field('nonce_sp_faq', 'nonce_sp_faq'); ?>
<input type="hidden" name="id" value="<?php echo $row->id;?>" />
<input type="hidden" name="task" value="" />
</form>
<?php 
 }	
?>