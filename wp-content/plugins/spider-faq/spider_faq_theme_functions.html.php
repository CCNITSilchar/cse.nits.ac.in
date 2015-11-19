<?php   
function html_add_spider_theme(){
	

	
?>
<script type="text/javascript">
function submitbutton(pressbutton) 
{
	if(!document.getElementById('title').value){
	alert("Title is required.");
	return;
	
	}
	
	document.getElementById("adminForm").action=document.getElementById("adminForm").action+"&task="+pressbutton;
	document.getElementById("adminForm").submit();
	
}




var plugin_url= "<?php echo plugins_url( '',__FILE__)?>";

</script>
<script type="text/javascript">


jQuery(function() {
	var formfield=null;
	
	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html){
		if (formfield) {
		
			
			var fileurl = jQuery('img',html).attr('src');
			if(fileurl)
	
			{
							window.parent.document.getElementById('imagebox'+x).src=fileurl;
							window.parent.document.getElementById('imagebox'+x).style.display="block";
			}

			formfield.val(fileurl);
			
			tb_remove();
		} else {
		
			window.original_send_to_editor(html);
		}
		formfield=null;
	};
 
	jQuery('.lu_upload_button').click(function() {
 		formfield = jQuery(this).parent().find(".text_input");
		x=this.id;
 		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		jQuery('#TB_overlay,#TB_closeWindowButton').bind("click",function(){formfield=null;});
		return false;
	});
	jQuery(document).keyup(function(e) {
  		if (e.keyCode == 27) formfield=null;
	});
});


</script>



<table width="95%">
  <tbody>
   <tr>
        	<td width="100%" style="font-size:14px; font-weight:bold"><a href="http://web-dorado.com/spider-faq-wordpress-guide-step-4-1.html" target="_blank" style="color:blue; text-decoration:none;">User Manual</a><br>
This section allows you to create/edit themes for the FAQs <a href="http://web-dorado.com/spider-faq-wordpress-guide-step-4-1.html" target="_blank" style="color:blue; text-decoration:none;">More...</a></td>
           
   			</tr>
  <tr>
  <td width="100%"><h2>Add Theme Parameters</h2></td>
  <td align="right"><input type="button" onclick="submitbutton('save')" value="Save" class="button-secondary action"> </td>  
  <td align="right"><input type="button" onclick="submitbutton('apply')" value="Apply" class="button-secondary action"> </td> 
  <td align="right"><input type="button" onclick="window.location.href='admin.php?page=Spider_Faq_Themes'" value="Cancel" class="button-secondary action"> </td> 
  </tr>
  </tbody></table>
  <br />
  <br />
   <link rel="stylesheet" href="<?php echo  plugins_url( 'elements/backendstyle.css',	__FILE__ ); ?>">
<form action="admin.php?page=Spider_Faq_Themes" method="post" name="adminForm" id="adminForm">
<div id="themeparams">
<div style="float:left">
       <div class="divfieldset"> 
	   
 <fieldset style="width:430px" ><legend>General Parameters</legend>    


<table class="admintable">
<tr>
<td width="220"  class="key">
Theme Title:
</td>
<td>
<input type="text" name="title" id="title" size="20"  value="" />
</td>
</tr>

<tr id="bg">
<td width="200px">
Background:
</td>
<td width="200">
	<input type="radio" name="background"  value="0" onChange="show_(0)"  id="show0"><label for="show0">Color</label>	 
	<input type="radio" name="background"  value="1" onChange="show_(1)"   id="show1"><label for="show1">Image</label>
	<input type="radio" name="background"  value="2" onChange="show_(2)"  checked="checked" id="show2"><label  for="show2"> Transparent</label>
</td>
</tr>
				
				
<script type="text/javascript">

function show_(x)
{
	
	if(x==0)
	{
	document.getElementById('bg').parentNode.childNodes[8].setAttribute('style','display:none');	
	document.getElementById('bg').parentNode.childNodes[6].removeAttribute('style');	
	}
	else
	{
	if(x==1)
	{
   document.getElementById('bg').parentNode.childNodes[6].setAttribute('style','display:none');	
	document.getElementById('bg').parentNode.childNodes[8].removeAttribute('style');
	}
	else
	{
	document.getElementById('bg').parentNode.childNodes[6].setAttribute('style','display:none');	
	document.getElementById('bg').parentNode.childNodes[8].setAttribute('style','display:none');	
	}
	}
	
}
</script>


<tr>
<td width="220"  class="key">
Background Color:
</td>
<td>
<input  type="text" name="bgcolor" id="bgcolor" value="" class="color">
</td>


<script type="text/javascript">
        
		show1=document.getElementById("show1").checked;
	if (show1)
	{
document.getElementById('bg').parentNode.childNodes[6].setAttribute('style','display:none');

	}
	
        </script>		
</tr>


 <tr>
<td width="220" class="key">
Background Image:
</td>
 <td> 
                     <input type="text" value="" name="bgimage" id="post_image1" class="text_input" style="width:121px; margin-bottom:4px;"/><a class="button lu_upload_button" id="1" href="#" />Select</a><br />
                   <a href="javascript:removeImage1();">Remove Image</a><br />
                             <div style="height:150px;">
                <img style="display:block" height="150" width="180" id="imagebox1" src="" />     
                                                 </div>     
                                    <script type="text/javascript">    
                  function removeImage1()
                                    {
                                 document.getElementById("post_image1").value='';
                                 document.getElementById("imagebox1").style.display="none";
                                 
                                    }
                                    </script>              
                                </td>	

<script type="text/javascript">
        
		show0=document.getElementById("show0").checked;
	if (show0)
	{
document.getElementById('bg').parentNode.childNodes[8].setAttribute('style','display:none');

	}
	
        </script>									

</tr>

		
<script type="text/javascript">
        
		show2=document.getElementById("show2").checked;
	if (show2)
	{
document.getElementById('bg').parentNode.childNodes[6].setAttribute('style','display:none');
document.getElementById('bg').parentNode.childNodes[8].setAttribute('style','display:none');
	}
	
        </script>	


<tr>
<td width="220"  class="key">
Width:
</td>
<td>
<input size="20"  type="text" name="width" id="width" value="600" />
</td>
</tr>
				


</table>
</fieldset>
</div>

<div class="clear"></div>

<div class="divfieldset">
<fieldset style="width:430px"><legend>Question Title Parameters </legend>     
<table class="admintable">

<tr>
<td width="220"  class="key">
Space Between Questions:
</td>
<td>
<input size="20"  type="text" name="paddingbq" id="paddingbq" value="" />
</td>
</tr>
				


<tr>
<td width="220" >
Margin (left):
</td>
<td width="170px">
<input size="20"  type="text" name="marginleft" id="marginleft" value="" />
</td>
</tr>				
				
<tr>
<td width="220"  class="key">
Height:
</td>
<td>
<input size="20"  type="text" name="theight" id="theight" value="40" />
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Width:
</td>
<td>
<input size="20"  type="text" name="twidth"  id="twidth" value="540" />
</td>
</tr>				
								
				
<tr>
<td width="220"  class="key">
Font Size:
</td>
<td>
<input size="20"  type="text" name="tfontsize" id="tfontsize" value="18" />
</td>
</tr>

 <tr>
<td width="180px" >
Text Width:
</td>
<td width="170px">
<input size="20"  type="text" name="ttxtwidth" id="ttxtwidth" value="" />%
</td>
</tr>
				
<tr>
<td width="180px" >
Padding (left):
</td>
<td width="170px">
<input size="20"  type="text" name="ttxtpleft" id="ttxtpleft" value="" />
</td>
</tr>
				
				
<tr>
<td width="220"  class="key">
Text Color:
</td>
<td>
<input type="text" name="tcolor" id="tcolor" value="000000" class="color">
</td>
</tr>				
				
<tr id="titlebg">
<td td width="180px">
Background:
</td>
<td width="170px">	
<input type="radio" name="titlebg"   value="0" onChange="titlebg_(0)" checked="checked" id="titlebg0"><label for="titlebg0">Color</label>	 
<input type="radio" name="titlebg"  value="1" onChange="titlebg_(1)"  id="titlebg1"><label for="titlebg1">Image</label>
						
					</td>

<script type="text/javascript">



function titlebg_(x)
{
	
	if(x==0)
	{
	document.getElementById('titlebg').parentNode.childNodes[21].setAttribute('style','display:none');
	document.getElementById('titlebg').parentNode.childNodes[17].removeAttribute('style');
	 document.getElementById('titlebg').parentNode.childNodes[27].removeAttribute('style');
	 document.getElementById('titlebg').parentNode.childNodes[29].setAttribute('style','display:none');
	titlebggrad1=document.getElementById("titlebggrad1").checked;
	if (titlebggrad1)
	{
document.getElementById('titlebg').parentNode.childNodes[19].setAttribute('style','display:none');
document.getElementById('titlebg').parentNode.childNodes[23].removeAttribute('style');
document.getElementById('titlebg').parentNode.childNodes[25].removeAttribute('style');
	}
	titlebggrad0=document.getElementById("titlebggrad0").checked;
	if (titlebggrad0)
	{
document.getElementById('titlebg').parentNode.childNodes[23].setAttribute('style','display:none');
document.getElementById('titlebg').parentNode.childNodes[25].setAttribute('style','display:none');
document.getElementById('titlebg').parentNode.childNodes[19].removeAttribute('style');
	}
	}
	else
	{
	document.getElementById('titlebg').parentNode.childNodes[17].setAttribute('style','display:none');
     document.getElementById('titlebg').parentNode.childNodes[19].setAttribute('style','display:none');
     document.getElementById('titlebg').parentNode.childNodes[23].setAttribute('style','display:none');
	 document.getElementById('titlebg').parentNode.childNodes[25].setAttribute('style','display:none');
	 document.getElementById('titlebg').parentNode.childNodes[27].setAttribute('style','display:none');
	document.getElementById('titlebg').parentNode.childNodes[21].removeAttribute('style');
	document.getElementById('titlebg').parentNode.childNodes[29].removeAttribute('style');
	}
	
	
}
</script> 

<tr>
<td td width="180px">
Gradient:
</td>
<td width="170px">	
<input type="radio" name="titlebggrad"  value="0" onChange="titlebggrad_(0)" checked="checked" id="titlebggrad0"><label for="titlebggrad0">No</label>	 
<input type="radio" name="titlebggrad"  value="1" onChange="titlebggrad_(1)"  id="titlebggrad1"><label for="titlebggrad1">Yes</label>
</td>

<script type="text/javascript">



function titlebggrad_(x)
{
	if(x==0)
	{
	document.getElementById('titlebg').parentNode.childNodes[21].setAttribute('style','display:none');
	document.getElementById('titlebg').parentNode.childNodes[23].setAttribute('style','display:none');
	document.getElementById('titlebg').parentNode.childNodes[25].setAttribute('style','display:none');
	document.getElementById('titlebg').parentNode.childNodes[19].removeAttribute('style');
	document.getElementById('titlebg').parentNode.childNodes[17].removeAttribute('style');
	}
	else
	{
	document.getElementById('titlebg').parentNode.childNodes[19].setAttribute('style','display:none');
	document.getElementById('titlebg').parentNode.childNodes[21].setAttribute('style','display:none');
	document.getElementById('titlebg').parentNode.childNodes[23].removeAttribute('style');
	document.getElementById('titlebg').parentNode.childNodes[25].removeAttribute('style');
	}

	
}


titlebg1=document.getElementById("titlebg1").checked;
	if (titlebg1)
	{
document.getElementById('titlebg').parentNode.childNodes[17].setAttribute('style','display:none');

	}
</script> 

</tr>	            
			  
<tr>
<td width="180px">
Background Color:
</td>
<td>
<input type="text" name="tbgcolor" id="tbgcolor" value="" class="color">
</td>
					
					<script type="text/javascript">
        
		titlebg1=document.getElementById("titlebg1").checked;
	if (titlebg1)
	{
document.getElementById('titlebg').parentNode.childNodes[19].setAttribute('style','display:none');

	}
	
	titlebg0=document.getElementById("titlebg0").checked;
	titlebggrad1=document.getElementById("titlebggrad1").checked;
	if (titlebg0 && titlebggrad1)
	{
document.getElementById('titlebg').parentNode.childNodes[19].setAttribute('style','display:none');

	}
        </script>		
					
</tr>
			
<tr>
<td width="220"  class="key">
Background Image:
</td>

<td>  
                     <input type="text" value="" name="tbgimage" id="post_image2" class="text_input" style="width:121px; margin-bottom:4px;"/><a class="button lu_upload_button" id="2" href="#" />Select</a><br />
                   <a href="javascript:removeImage2();">Remove Image</a><br />
                               <div style="height:150px;">
                <img style=" display:block; width:150px" id="imagebox2" src="" />     
                                                 </div>     
                                    <script type="text/javascript">    
                  function removeImage2()
                                    {
                                 document.getElementById("post_image2").value='';
                                 document.getElementById("imagebox2").style.display="none";
                                
                                    }
                                    </script>              
                                </td>	
		<script type="text/javascript">
        
		titlebg0=document.getElementById("titlebg0").checked;
	if (titlebg0)
	{
document.getElementById('titlebg').parentNode.childNodes[21].setAttribute('style','display:none');

	}
	
        </script>				
								
</tr>

<tr>
<td width="180px">
Gradient Direction:
</td>
<td>
<select name="gradtype" id="gradtype">					 
<option    value="top"    selected="selected">Top/Bottom</option>	 
<option    value="left"   >Left/Right</option>
<option    value="circle"  >Center</option>						
</select>					
</td>

<script type="text/javascript">
        
		titlebg1=document.getElementById("titlebg1").checked;
	if (titlebg1)
	{
document.getElementById('titlebg').parentNode.childNodes[23].setAttribute('style','display:none');

	}
	
	titlebg0=document.getElementById("titlebg0").checked;
	titlebggrad0=document.getElementById("titlebggrad0").checked;
	if (titlebg0 && titlebggrad0)
	{
document.getElementById('titlebg').parentNode.childNodes[23].setAttribute('style','display:none');

	}
        </script>		        
			  
   </tr>		

 <tr>
<td width="180px">
Background Color:
</td>
<td >
From <input size="5" type="text" name="gradcolor1" id="gradcolor1" value="" class="color">
To <input size="5" type="text" name="gradcolor2" id="gradcolor2" value="" class="color">
</td>
				<script type="text/javascript">
        
		titlebg1=document.getElementById("titlebg1").checked;
	if (titlebg1)
	{
document.getElementById('titlebg').parentNode.childNodes[25].setAttribute('style','display:none');

	}
	
	titlebg0=document.getElementById("titlebg0").checked;
	titlebggrad0=document.getElementById("titlebggrad0").checked;
	if (titlebg0 && titlebggrad0)
	{
document.getElementById('titlebg').parentNode.childNodes[25].setAttribute('style','display:none');

	}
	
	
        </script>			
</tr>
 
 
<tr>
<td width="180px">
Background Hover Color:
</td>
<td>
<input type="text" name="tbghovercolor" id="tbghovercolor" value="" class="color">
</td>
		<script type="text/javascript">			
			titlebg1=document.getElementById("titlebg1").checked;
	if (titlebg1)
	{
document.getElementById('titlebg').parentNode.childNodes[27].setAttribute('style','display:none');

	}
        
	
	</script>				
</tr>
				
<tr>
<td width="220"  class="key">
Background-size:
</td>
<td>
<input size="20"  type="text" name="tbgsize" id="tbgsize" value="" />
</td>
<script type="text/javascript">			
			titlebg0=document.getElementById("titlebg0").checked;
	if (titlebg0)
	{
document.getElementById('titlebg').parentNode.childNodes[29].setAttribute('style','display:none');

	}
        
	
	</script>	
</tr>		
				
				
<tr>
<td width="180px" >
Border Style:
</td>
<td width="170px">
<select name="tbstyle" id="tbstyle">					 
<option    value="solid"   selected="selected">Solid</option>	 
<option    value="dotted" >Dotted</option>
<option    value="dashed" >Dashed</option>		
<option    value="double"  >Double</option>
<option    value="groove" >Groove</option>		
<option    value="ridge" >Ridge</option>
<option    value="inset" >Inset</option>	
<option    value="outset" >Outset</option>	
<option    value="none" >None</option>				
</select>
</td>
</tr>
<tr>
<td width="180px" >
Border Top Style:
</td>
<td width="170px">
<select name="tbtopstyle" id="tbtopstyle">					 
<option    value="solid"  selected="selected">Solid</option>	 
<option    value="dotted" >Dotted</option>
<option    value="dashed">Dashed</option>		
<option    value="double"  >Double</option>
<option    value="groove"  >Groove</option>		
<option    value="ridge"  >Ridge</option>
<option    value="inset"    >Inset</option>	
<option    value="outset"   >Outset</option>	
<option    value="none"    >None</option>				
</select>
</td>
</tr>
<tr>
<td width="180px" >
Border Right Style:
</td>
<td width="170px">
<select name="tbrightstyle" id="tbrightstyle">					 
<option    value="solid"  selected="selected">Solid</option>	 
<option    value="dotted" >Dotted</option>
<option    value="dashed" >Dashed</option>		
<option    value="double" >Double</option>
<option    value="groove" >Groove</option>		
<option    value="ridge"  >Ridge</option>
<option    value="inset"  >Inset</option>	
<option    value="outset" >Outset</option>	
<option    value="none"  >None</option>				
</select>
</td>
</tr>								
<tr>
<td width="180px" >
Border Width:
</td>
<td width="170px">
<input size="20"  type="text" name="tbwidth" id="tbwidth" value="" />
</td>
</tr>
				
<tr>
<td width="180px">
Border Color:
</td>
<td>
<input type="text" name="tbcolor" id="tbcolor" value="" class="color">
</td>
</tr>
				
<tr>
<td width="180px" >
Border Corner Radius:
</td>
<td width="170px">
<input size="20"  type="text" name="tbradius" id="tbradius" value="" />
</td>
</tr>	
 <tr>
<td td width="180px">
Numbering:
</td>
<td width="170px">	
<input type="radio" name="numbering"  value="0"  onchange="numbfontcol(0)"  id="numberingno"><label for="numbering">No</label>	 
<input type="radio" name="numbering"  value="1"  checked="checked" onchange="numbfontcol(1)" id="numberingyes"><label for="numbering">Yes</label>
</td>
</tr>
<tr id="numbfont" style="display:table-row" >
<td width="180px" >
Numbering Font Size:
</td>
<td width="170px">
<input size="20"  type="text" name="numberfnts" id="numberfnts" value="" />
</td>
</tr>
<tr id="numbcol" style="display:table-row">
<td width="180px" >
Numbering Color:
</td>
<td width="170px">
<input size="20"  type="text" name="numbercl" id="numbercl" value="" class="color"/>
</td>
</tr>				
<tr>
<td width="220"  class="key">
Bullet Image (Collapsed):
</td>
<td>  
                     <input type="text" value="" name="tchangeimage1" id="post_image3" class="text_input" style="width:121px; margin-bottom:4px; "/><a class="button lu_upload_button" id="3" href="#" />Select</a><br />
                   <a href="javascript:removeImage3();">Remove Image</a><br />
                               <div style="height:50px;">
                <img style="display:block"  id="imagebox3" src="" />     
                                                 </div>     
                                    <script type="text/javascript"> 
function numbfontcol(m)
{
if(m==1)
{
document.getElementById("numbfont").style.display="table-row";
document.getElementById("numbcol").style.display="table-row";
}
else 
{
document.getElementById("numbfont").style.display="none";
document.getElementById("numbcol").style.display="none";
}
}									
                  function removeImage3()
                                    {
                                 document.getElementById("post_image3").value='';
                                 document.getElementById("imagebox3").style.display="none";
                                
                                    }
                                    </script>              
                                </td>	
</tr>
				

				
<tr>
<td width="220"  class="key">
Image Margin (left):
</td>
<td>
<input size="20"  type="text" name="marginlimage1" id="marginlimage1" value="" />
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Bullet Image (Expanded):
</td>
<td>  
                     <input type="text" value="" name="tchangeimage2" id="post_image4" class="text_input" style="width:121px; margin-bottom:4px;"/><a class="button lu_upload_button" id="4" href="#" />Select</a><br />
                   <a href="javascript:removeImage4();">Remove Image</a><br />
                               <div style="height:50px;">
                <img style="display:block"  id="imagebox4" src="" />     
                                                 </div>     
                                    <script type="text/javascript">    
                  function removeImage4()
                                    {
                                 document.getElementById("post_image4").value='';
                                 document.getElementById("imagebox4").style.display="none";
                                
                                    }
                                    </script>              
                                </td>	
</tr>
				
				
<tr>
<td width="220"  class="key">
Image Margin (left):
</td>
<td>
<input size="20"  type="text" name="marginlimage2" id="marginlimage2" value="" />
</td>
</tr>
 <tr>
<td td width="180px">
Image Position:
</td>
<td width="170px">	
<input type="radio" name="imgpos"  value="0" checked="checked" id="imgposleft"><label for="imgpos">Left</label>	 
<input type="radio" name="imgpos"  value="1"   id="imgposright"><label for="imgpos">Right</label>
</td>
</tr>
</table>
</fieldset>
</div>

<div class="clear"></div>
<div class="divfieldset">
<fieldset style="width:430px;" ><legend>Search Box Parameters </legend>    
<table class="admintable">				
<tr>
<td width="220"  class="key">
Background Color:
</td>
<td>
<input type="text" name="sboxbgcolor" id="sboxbgcolor" value="" class="color">
</td>
</tr>
</table>
</fieldset>
</div>
<div class="clear"></div>

<div class="divfieldset">
<fieldset style="width:430px;"><legend>Expand/Collapse Parameters </legend>    
<table class="admintable">
<tr>
<td width="220"  class="key">
Color:
</td>
<td>
<input type="text" name="expcolcolor" id="expcolcolor" value="000000" class="color">
 </td>
</tr>
				
<tr>
<td width="220"  class="key">
Hover Color:
</td>
<td>
<input type="text" name="expcolhovercolor" id="expcolhovercolor" value="CCCCCC" class="color">
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Font Size:
</td>
<td>
<input type="text" name="expcolfontsize" id="expcolfontsize" value="14">
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Margin:
</td>
<td>
<input type="text" name="expcolmargin" id="expcolmargin" value="">
</td>
</tr>

</table>
</fieldset>
</div>

<div class="divfieldset">
<fieldset style="width:430px;"><legend>Read More Button Parameters </legend>     
<table class="admintable">	


<tr>
<td width="220"  class="key">
Color:
</td>
<td>
<input type="text" name="rmcolor" id="rmcolor" value="" class="color">
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Hover Color:
</td>
<td>
<input type="text" name="rmhovercolor" id="rmhovercolor" value="" class="color">
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Font Size:
</td>
<td>
<input type="text" name="rmfontsize" id="rmfontsize" value="">
</td>
</tr>			
	          </table>
</fieldset>
</div>
</div>
<div style="float:left">
<div class="divfieldset">  
 <fieldset style="width:430px;"><legend>Category Parameters </legend>  
<table class="admintable" style=" width: 420px; ">

  <tr>
<td>
<div style="font-size:14px; font-weight:bold;"></div>
</td> 
</tr>

				
<tr id="ctbg">
<td td width="180px">
Background:
</td>
<td width="170px">	
<input type="radio" name="ctbg"   value="0" onChange="ctbg_(0)" checked="checked" id="ctbg0"><label for="ctbg0">No</label>	 
<input type="radio" name="ctbg"  value="1" onChange="ctbg_(1)"   id="ctbg1"><label for="ctbg1">Yes</label>
</td>

<script type="text/javascript">

function ctbg_(x)
{
	
	if(x==0)
	{
	document.getElementById('ctbg').parentNode.childNodes[4].setAttribute('style','display:none');
    document.getElementById('ctbg').parentNode.childNodes[6].setAttribute('style','display:none');
    document.getElementById('ctbg').parentNode.childNodes[8].setAttribute('style','display:none');
    document.getElementById('ctbg').parentNode.childNodes[10].setAttribute('style','display:none');
	
	}
	else
	{
	document.getElementById('ctbg').parentNode.childNodes[4].removeAttribute('style');
	ctbggrad0=document.getElementById("ctbggrad0").checked;
	if (ctbggrad0)
	{
document.getElementById('ctbg').parentNode.childNodes[8].setAttribute('style','display:none');
document.getElementById('ctbg').parentNode.childNodes[10].setAttribute('style','display:none');
document.getElementById('ctbg').parentNode.childNodes[6].removeAttribute('style');

	}
	ctbggrad1=document.getElementById("ctbggrad1").checked;
	if (ctbggrad1)
	{
document.getElementById('ctbg').parentNode.childNodes[6].setAttribute('style','display:none');
document.getElementById('ctbg').parentNode.childNodes[8].removeAttribute('style');
document.getElementById('ctbg').parentNode.childNodes[10].removeAttribute('style');
	}
				
	}

	
}
</script> 
</tr>

 
				
<tr>
<td td width="180px">
Gradient:
</td>
<td width="170px">	
<input type="radio" name="ctbggrad"  value="0" onChange="ctbggrad_(0)" checked="checked" id="ctbggrad0"><label for="ctbggrad0">No</label>	 
<input type="radio" name="ctbggrad"  value="1" onChange="ctbggrad_(1)"   id="ctbggrad1"><label for="ctbggrad1">Yes</label>
</td>

<script type="text/javascript">


function ctbggrad_(x)
{
	
if(x==0)
	{
    document.getElementById('ctbg').parentNode.childNodes[8].setAttribute('style','display:none');
    document.getElementById('ctbg').parentNode.childNodes[10].setAttribute('style','display:none');
	document.getElementById('ctbg').parentNode.childNodes[6].removeAttribute('style');
	}
	else
	{
	document.getElementById('ctbg').parentNode.childNodes[6].setAttribute('style','display:none');  
	document.getElementById('ctbg').parentNode.childNodes[8].removeAttribute('style');
	document.getElementById('ctbg').parentNode.childNodes[10].removeAttribute('style');				
	}
	}
	
		ctbg0=document.getElementById("ctbg0").checked;
	if (ctbg0)
	{
document.getElementById('ctbg').parentNode.childNodes[4].setAttribute('style','display:none');

	}
	
</script>   
			   </tr>	            

<tr>
<td width="180px">
Background Color:
</td>
<td width="170px">
<input type="text" name="ctbgcolor" id="ctbgcolor"  value="" class="color">
</td>
					<script type="text/javascript">
        
		ctbg0=document.getElementById("ctbg0").checked;
	if (ctbg0)
	{
document.getElementById('ctbg').parentNode.childNodes[6].setAttribute('style','display:none');

	}
	
	ctbg1=document.getElementById("ctbg1").checked;
	ctbggrad1=document.getElementById("ctbggrad1").checked;
	if (ctbg1 && ctbggrad1)
	{
document.getElementById('ctbg').parentNode.childNodes[6].setAttribute('style','display:none');

	}
        </script>		
					
                </tr>
			   
<tr>
<td width="180px">
Gradient Direction:
</td>
<td>
<select name="ctgradtype" id="ctgradtype">					 
<option    value="top" selected="selected">Top/Bottom</option>	 
<option    value="left"  >Left/Right</option>
<option    value="circle"  >Center</option>						
</select>					
</td>

<script type="text/javascript">
        
		ctbg0=document.getElementById("ctbg0").checked;
	if (ctbg0)
	{
document.getElementById('ctbg').parentNode.childNodes[8].setAttribute('style','display:none');

	}
	
	ctbg1=document.getElementById("ctbg1").checked;
	ctbggrad0=document.getElementById("ctbggrad0").checked;
	if (ctbg1 && ctbggrad0)
	{
document.getElementById('ctbg').parentNode.childNodes[8].setAttribute('style','display:none');

	}
        </script>			        
			  
   </tr>		

 <tr>
<td width="180px">
Background Color:
</td>
<td >
From <input size="5" type="text" name="ctgradcolor1" id="ctgradcolor1" value="" class="color">
To <input size="5" type="text" name="ctgradcolor2" id="ctgradcolor2" value="" class="color">
</td>
				<script type="text/javascript">
           
		ctbg0=document.getElementById("ctbg0").checked;
	if (ctbg0)
	{
document.getElementById('ctbg').parentNode.childNodes[10].setAttribute('style','display:none');

	}
	
	ctbg1=document.getElementById("ctbg1").checked;
	ctbggrad0=document.getElementById("ctbggrad0").checked;
	if (ctbg1 && ctbggrad0)
	{
document.getElementById('ctbg').parentNode.childNodes[10].setAttribute('style','display:none');

	}
		
	
        </script>			
                </tr>


<tr>
<td width="220"  class="key">
Text Color:
</td>
<td>
<input type="text" name="cttxtcolor" id="cttxtcolor" value="000000" class="color">
</td>
</tr>
				 
<tr>
<td width="220"  class="key">
Font Size:
</td>
<td>
<input size="20"  type="text" name="ctfontsize" id="ctfontsize" value="20" />
</td>
</tr>

<tr>
<td width="180px" >
Margin:
</td>
<td width="170px">
<input type="text" name="ctmargin" id="ctmargin" size="20" value="" />
</td>
</tr>
				
<tr>
<td width="220" class="key">
Padding:
</td>
<td>
<input type="text" name="ctpadding" id="ctpadding" size="20" value="" />
</td>
</tr>
				
				
<tr>
<td width="180px" >
Border Style:
</td>
<td width="170px">
<select name="ctbstyle" id="ctbstyle">					 
<option    value="solid"   selected="selected">Solid</option>	 
<option    value="dotted"    >Dotted</option>
<option    value="dashed"    >Dashed</option>		
<option    value="double"    >Double</option>
<option    value="groove"    >Groove</option>		
<option    value="ridge"     >Ridge</option>
<option    value="inset"   >Inset</option>	
<option    value="outset"   >Outset</option>
<option    value="none"    >None</option>				
</select>
</td>
</tr>
				
				
<tr>
<td width="180px" >
Border Width:
</td>
<td width="170px">
<input size="20"  type="text" name="ctbwidth" id="ctbwidth" value="" />
</td>
</tr>
				
<tr>
<td width="180px">
Border Color:
</td>
<td>
<input type="text" name="ctbcolor" id="ctbcolor" value="" class="color">
</td>
</tr>
				
<tr>
<td width="180px" >
Border Corner Radius:
</td>
<td width="170px">
<input size="20"  type="text" name="ctbradius" id="ctbradius" value="" />
</td>
</tr>	

<tr>
<td>
<div style="font-size:14px; font-weight:bold; margin-top:8px;"></div>
</td> 
</tr>

				
<tr id="cdbg">
<td td width="180px">
Background:
</td>
<td width="170px">	
<input type="radio" name="cdbg"   value="0" onChange="cdbg_(0)" checked="checked" id="cdbg0"><label for="cdbg0">No</label>	 
<input type="radio" name="cdbg"  value="1" onChange="cdbg_(1)"  id="cdbg1"><label for="cdbg1">Yes</label>
</td>

<script type="text/javascript">



function cdbg_(x)
{
	
	if(x==0)
	{
	document.getElementById('cdbg').parentNode.childNodes[32].setAttribute('style','display:none');
    document.getElementById('cdbg').parentNode.childNodes[34].setAttribute('style','display:none');
    document.getElementById('cdbg').parentNode.childNodes[36].setAttribute('style','display:none');
    document.getElementById('cdbg').parentNode.childNodes[38].setAttribute('style','display:none');
	
	}
	else
	{
	document.getElementById('cdbg').parentNode.childNodes[32].removeAttribute('style');
	cdbggrad0=document.getElementById("cdbggrad0").checked;
	if (cdbggrad0)
	{
document.getElementById('cdbg').parentNode.childNodes[36].setAttribute('style','display:none');
document.getElementById('cdbg').parentNode.childNodes[38].setAttribute('style','display:none');
document.getElementById('cdbg').parentNode.childNodes[34].removeAttribute('style');

	}
	cdbggrad1=document.getElementById("cdbggrad1").checked;
	if (cdbggrad1)
	{
document.getElementById('cdbg').parentNode.childNodes[34].setAttribute('style','display:none');
document.getElementById('cdbg').parentNode.childNodes[36].removeAttribute('style');
document.getElementById('cdbg').parentNode.childNodes[38].removeAttribute('style');
	}
				
	}
	
	
}
</script> 
</tr>

 
				
<tr>
<td td width="180px">
Gradient:
</td>
<td width="170px">	
<input type="radio" name="cdbggrad"  value="0" onChange="cdbggrad_(0)" checked="checked" id="cdbggrad0"><label for="cdbggrad0">No</label>	 
<input type="radio" name="cdbggrad"  value="1" onChange="cdbggrad_(1)"  id="cdbggrad1"><label for="cdbggrad1">Yes</label>
</td>

<script type="text/javascript">



function cdbggrad_(x)
{
	
if(x==0)
	{
    document.getElementById('cdbg').parentNode.childNodes[36].setAttribute('style','display:none');
    document.getElementById('cdbg').parentNode.childNodes[38].setAttribute('style','display:none');
	document.getElementById('cdbg').parentNode.childNodes[34].removeAttribute('style');
	}
	else
	{
	document.getElementById('cdbg').parentNode.childNodes[34].setAttribute('style','display:none');  
	document.getElementById('cdbg').parentNode.childNodes[36].removeAttribute('style');
	document.getElementById('cdbg').parentNode.childNodes[38].removeAttribute('style');				
	}
	}
	
		cdbg0=document.getElementById("cdbg0").checked;
	if (cdbg0)
	{
document.getElementById('cdbg').parentNode.childNodes[32].setAttribute('style','display:none');

	}
	
</script>   
</tr>	            
			  
<tr>
<td width="180px">
Background Color:
</td>
<td width="170px">
<input type="text" name="cdbgcolor" id="cdbgcolor"  value="" class="color">
</td>
					<script type="text/javascript">
        
		cdbg0=document.getElementById("cdbg0").checked;
	if (cdbg0)
	{
document.getElementById('cdbg').parentNode.childNodes[34].setAttribute('style','display:none');

	}
	
	cdbg1=document.getElementById("cdbg1").checked;
	cdbggrad1=document.getElementById("cdbggrad1").checked;
	if (cdbg1 && cdbggrad1)
	{
document.getElementById('cdbg').parentNode.childNodes[34].setAttribute('style','display:none');

	}
        </script>		
					
                </tr>
			   
<tr>
<td width="180px">
Gradient Direction:
</td>
<td>
<select name="cdgradtype" id="cdgradtype">					 
<option    value="top" selected="selected">Top/Bottom</option>	 
<option    value="left"    >Left/Right</option>
<option    value="circle"    >Center</option>						
</select>					
</td>

<script type="text/javascript">
        
		cdbg0=document.getElementById("cdbg0").checked;
	if (cdbg0)
	{
document.getElementById('cdbg').parentNode.childNodes[36].setAttribute('style','display:none');

	}
	
	cdbg1=document.getElementById("cdbg1").checked;
	cdbggrad0=document.getElementById("cdbggrad0").checked;
	if (cdbg1 && cdbggrad0)
	{
document.getElementById('cdbg').parentNode.childNodes[36].setAttribute('style','display:none');

	}
        </script>			        
			  
   </tr>		

<tr>
<td width="180px">
Background Color:
</td>
<td >
From <input size="5" type="text" name="cdgradcolor1" id="cdgradcolor1" value="" class="color">
To <input size="5" type="text" name="cdgradcolor2" id="cdgradcolor2" value="" class="color">
</td>
<script type="text/javascript">
           
		cdbg0=document.getElementById("cdbg0").checked;
	if (cdbg0)
	{
document.getElementById('cdbg').parentNode.childNodes[38].setAttribute('style','display:none');

	}
	
	cdbg1=document.getElementById("cdbg1").checked;
	cdbggrad0=document.getElementById("cdbggrad0").checked;
	if (cdbg1 && cdbggrad0)
	{
document.getElementById('cdbg').parentNode.childNodes[38].setAttribute('style','display:none');

	}
		
	
        </script>			
</tr>


<tr>
<td width="220"  class="key">
Text Color:
</td>
<td>
<input type="text" name="cdtxtcolor" id="cdtxtcolor" value="000000" class="color">
</td>
</tr>
				 
<tr>
<td width="220"  class="key">
Font Size:
</td>
<td>
<input size="20"  type="text" name="cdfontsize" id="cdfontsize" value="" />
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Margin:
</td>
<td>
<input size="20"  type="text" name="cdmargin" id="cdmargin" value="" />
</tr>

<tr>
<td width="180px" >
Padding:
</td>
<td width="170px">
<input type="text" name="cdpadding" id="cdpadding" size="20" value="" />
</td>
</tr>

<tr>
<td width="180px" >
Border Style:
</td>
<td width="170px">
<select name="cdbstyle" id="cdbstyle">					 
<option    value="solid"   selected="selected">Solid</option>	 
<option    value="dotted" >Dotted</option>
<option    value="dashed" >Dashed</option>		
<option    value="double" >Double</option>
<option    value="groove" >Groove</option>		
<option    value="ridge"  >Ridge</option>
<option    value="inset"  >Inset</option>	
<option    value="outset" >Outset</option>
<option    value="none" >None</option>				
</select>
</td>
</tr>
				
				
<tr>
<td width="180px" >
Border Width:
</td>
<td width="170px">
<input size="20"  type="text" name="cdbwidth" id="cdbwidth" value="" />
</td>
</tr>
				
<tr>
<td width="180px">
Border Color:
</td>
<td>
<input type="text" name="cdbcolor" id="cdbcolor" value="" class="color">
</td>
</tr>
				
<tr>
<td width="180px" >
Border Corner Radius:
</td>
<td width="170px">
<input size="20"  type="text" name="cdbradius" id="cdbradius" value="" />
</td>
</tr>	
			
				
</table>
</fieldset>
</div>

<div class="divfieldset">
<fieldset style="width:430px;" ><legend>Answer Parameters </legend>     
<table class="admintable">

<tr>
<td width="220"  class="key">
Width:
</td>
<td>
<input size="20"  type="text" name="awidth" id="awidth"  value="540" />
</td>
</tr>		
				
<tr>
<td width="220"  class="key">
 Padding:
</td>
<td>
<input size="20"  type="text" name="apadd" id="apadd" value="" />
</td>
</tr>								
<tr>
<td width="220"  class="key">
Font Size:
</td>
<td>
<input size="20"  type="text" name="afontsize" id="afontsize" value="16" />
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Text Color:
</td>
<td>
<input type="text" name="atxtcolor" id="atxtcolor" value="000000" class="color">
</td>
</tr>


<tr id="abg">
<td>
Background:
</td>
<td width="170px">	
<input type="radio" name="abg"  value="0" onChange="abg_(0)" checked="checked" id="abg0"><label for="abg0">Color</label>	 
<input type="radio" name="abg"  value="1" onChange="abg_(1)"   id="abg1"><label for="abg1">Image</label>
</td>

<script type="text/javascript">

function abg_(x)
{
	
	if(x==0)
	{
	document.getElementById('abg').parentNode.childNodes[11].setAttribute('style','display:none');
	document.getElementById('abg').parentNode.childNodes[13].setAttribute('style','display:none');
	document.getElementById('abg').parentNode.childNodes[9].removeAttribute('style');
	}
	else
	{
     document.getElementById('abg').parentNode.childNodes[9].setAttribute('style','display:none');
	document.getElementById('abg').parentNode.childNodes[11].removeAttribute('style');
	document.getElementById('abg').parentNode.childNodes[13].removeAttribute('style');
	}
	
	
}
</script> 
				
				
<tr>
<td width="200px">
Background Color:
</td>
<td>
<input type="text" name="abgcolor" id="abgcolor" value="CCCCCC" class="color">
</td>
		
					<script type="text/javascript">
        
		abg1=document.getElementById("abg1").checked;
	if (abg1)
	{
document.getElementById('abg').parentNode.childNodes[9].setAttribute('style','display:none');

	}
	
        </script>		
			
</tr>
				

				
<tr>
<td width="220"  class="key">
Background Image:
</td>
<td>  
                     <input type="text" value="" name="abgimage" id="post_image5" class="text_input" style="width:121px; margin-bottom:4px;"/><a class="button lu_upload_button" id="5" href="#" />Select</a><br />
                   <a href="javascript:removeImage5();">Remove Image</a><br />
                               <div style="height:150px;">
                <img style="display:block;width:160px"  id="imagebox5" src="" />     
                                                 </div>     
                                    <script type="text/javascript">    
                  function removeImage5()
                                    {
                                 document.getElementById("post_image5").value='';
                                 document.getElementById("imagebox5").style.display="none";
                                
                                    }
                                    </script>              
                                </td>		

	
					<script type="text/javascript">
        
		abg0=document.getElementById("abg0").checked;
	if (abg0)
	{
document.getElementById('abg').parentNode.childNodes[11].setAttribute('style','display:none');

	}
	
        </script>		
										
</tr>
	
	
<tr>
<td width="220"  class="key">
Background-size:
</td>
<td>
<input size="20"  type="text" name="abgsize" id="abgsize" value="" />
</td>
<script type="text/javascript">
        
		abg0=document.getElementById("abg0").checked;
	if (abg0)
	{
document.getElementById('abg').parentNode.childNodes[13].setAttribute('style','display:none');

	}
	
        </script>		
</tr>	

<tr>
<td width="180px" >
Border Style:
</td>
<td width="170px">
<select name="abstyle" id="abstyle">					 
<option    value="solid"   selected="selected">Solid</option>	 
<option    value="dotted"    >Dotted</option>
<option    value="dashed"    >Dashed</option>		
<option    value="double"   >Double</option>
<option    value="groove"  >Groove</option>		
<option    value="ridge"    >Ridge</option>
<option    value="inset"  >Inset</option>	
<option    value="outset"   >Outset</option>	
<option    value="none"  >None</option>				
</select>                
</td>
</tr>
<tr>
<td width="180px" >
Border Right Style:
</td>
<td width="170px">
<select name="abrightstyle" id="abrightstyle">					 
<option    value="solid"   selected="selected">Solid</option>	 
<option    value="dotted"   >Dotted</option>
<option    value="dashed"  >Dashed</option>		
<option    value="double"  >Double</option>
<option    value="groove"  >Groove</option>		
<option    value="ridge"   >Ridge</option>
<option    value="inset"  >Inset</option>	
<option    value="outset" >Outset</option>	
<option    value="none"  >None</option>				
</select>                
</td>
</tr>								
<tr>
<td width="180px" >
Border Width:
</td>
<td width="170px">
<input size="20"  type="text" name="abwidth" id="abwidth" value="" />
</td>
</tr>
				
<tr>
<td width="180px">
Border Color:
</td>
<td>
<input type="text" name="abcolor" id="abcolor" value="" class="color">
</td>
</tr>
				
<tr>
<td width="180px" >
Border Corner Radius:
</td>
<td width="170px">
<input size="20"  type="text" name="abradius" id="abradius" value="" />
</td>
</tr>				
<tr>
<td width="220"  class="key">
Content Padding:
</td>
<td>
<input size="20"  type="text" name="amargin" id="amargin" value="" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Content Width:
</td>
<td>
<input size="20"  type="text" name="answidth" id="answidth" value="" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Padding (left):
</td>
<td>
<input size="20"  type="text" name="ansmarginleft" id="ansmarginleft" value="" />
</td>
</tr>
<tr>
<td td width="180px">
Icon Color:
</td>
<td width="170px">	
<input type="radio" name="ikncol"  value="0" checked="checked" id="ikncolb"><label for="ikncol">Black</label>	 
<input type="radio" name="ikncol"  value="1"  id="ikncolw"><label for="ikncol">White</label>
</td>
</tr>	
<tr>
<td width="220"  class="key">
Data Width:
</td>
<td>
<input size="20"  type="text" name="dwidth" id="dwidth" value="" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Data Height:
</td>
<td>
<input size="20"  type="text" name="dheight" id="dheight" value="" />
</td>
</tr>				
<tr>
<td width="220"  class="key">
Data Margin (left):
</td>
<td>
<input size="20"  type="text" name="dmarginleft" id="dmarginleft" value="" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Data Text Color:
</td>
<td>
<input size="20"  type="text" name="dtextcolor" id="dtextcolor" value="" class="color" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Data Background Color:
</td>
<td>
<input size="20"  type="text" name="dbackgroundcolor" id="dbackgroundcolor" value="" class="color" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Data Border Style:
</td>
<td width="170px">
<select name="dborderstyle" id="dborderstyle">					 
<option    value="solid"   selected="selected" >Solid</option>	 
<option    value="dotted"    >Dotted</option>
<option    value="dashed"    >Dashed</option>		
<option    value="double"   >Double</option>
<option    value="groove"   >Groove</option>		
<option    value="ridge"    >Ridge</option>
<option    value="inset"   >Inset</option>	
<option    value="outset" >Outset</option>	
<option    value="none"  >None</option>				
</select>
</td>
</tr>
<tr>
<td width="220"  class="key">
Data Border Width:
</td>
<td>
<input size="20"  type="text" name="dborderwidth" id="dborderwidth" value="" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Data Border Color:
</td>
<td>
<input size="20"  type="text" name="dbordercolor" id="dbordercolor" value="" class="color"  />
</td>
</tr>
<tr>
<td width="220"  class="key">
Data Border Corner Radius:
</td>
<td>
<input size="20"  type="text" name="dbordercornerradius" id="dbordercornerradius" value="" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Data Border Top Style:
</td>
<td width="170px">
<select name="dbordertopstyle" id="dbordertopstyle">					 
<option    value="solid"   selected="selected" >Solid</option>	 
<option    value="dotted"   >Dotted</option>
<option    value="dashed"   >Dashed</option>		
<option    value="double"   >Double</option>
<option    value="groove"   >Groove</option>		
<option    value="ridge"    >Ridge</option>
<option    value="inset"    >Inset</option>	
<option    value="outset"   >Outset</option>	
<option    value="none"    >None</option>				
</select>
</td>
</tr>
<tr>
<td width="220"  class="key">
Data Border Bottom Style:
</td>
<td width="170px">
<select name="dborderbottomstyle" id="dborderbottomstyle">					 
<option    value="solid"   selected="selected">Solid</option>	 
<option    value="dotted"    >Dotted</option>
<option    value="dashed"    >Dashed</option>		
<option    value="double"    >Double</option>
<option    value="groove"   >Groove</option>		
<option    value="ridge"   >Ridge</option>
<option    value="inset"  >Inset</option>	
<option    value="outset"  >Outset</option>	
<option    value="none"    >None</option>				
</select>
</td>
</tr>
<tr>
<td width="220"  class="key">
Like Hits Data Width:
</td>
<td>
<input size="20"  type="text" name="dlikehitswidth" id="dlikehitswidth" value="" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Like Hits Data Margin (left):
</td>
<td>
<input size="20"  type="text" name="dlikehitsmargin" id="dlikehitsmargin" value="" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Like Hits Data Background Color:
</td>
<td>
<input size="20"  type="text" name="dlikehitsbgcolor" id="dlikehitsbgcolor" value="" class="color" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Like Hits Data Border Style:
</td>
<td width="170px">
<select name="dlikehitsbdrst" id="dlikehitsbdrst">					 
<option    value="solid"   selected="selected">Solid</option>	 
<option    value="dotted"    >Dotted</option>
<option    value="dashed"    >Dashed</option>		
<option    value="double"    >Double</option>
<option    value="groove"    >Groove</option>		
<option    value="ridge"     >Ridge</option>
<option    value="inset"    >Inset</option>	
<option    value="outset"   >Outset</option>	
<option    value="none"    >None</option>				
</select>
</td>
</tr>
<tr>
<td width="220"  class="key">
Like Hits Data Border Width:
</td>
<td>
<input size="20"  type="text" name="dlikehitsbdrw" id="dlikehitsbdrw" value="" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Like Hits Data Border Color:
</td>
<td>
<input size="20"  type="text" name="dlikehitsbdrc" id="dlikehitsbdrc" value="" class="color"/>
</td>
</tr>
<tr>
<td width="220"  class="key">
Like Hits Data Border Top Style:
</td>
<td width="170px">
<select name="dlikehitsbdrtst" id="dlikehitsbdrtst">					 
<option    value="solid"   selected="selected">Solid</option>	 
<option    value="dotted"    >Dotted</option>
<option    value="dashed"    >Dashed</option>		
<option    value="double"    >Double</option>
<option    value="groove"   >Groove</option>		
<option    value="ridge"    >Ridge</option>
<option    value="inset"    >Inset</option>	
<option    value="outset"   >Outset</option>	
<option    value="none"    >None</option>				
</select>
</td>
</tr>
<tr>
<td width="220"  class="key">
Like Hits Data Border Bottom Style:
</td>
<td width="170px">
<select name="dlikehitsbdrbst" id="dlikehitsbdrbst">					 
<option    value="solid"   selected="selected">Solid</option>	 
<option    value="dotted"    >Dotted</option>
<option    value="dashed"   >Dashed</option>		
<option    value="double"   >Double</option>
<option    value="groove"   >Groove</option>		
<option    value="ridge"    >Ridge</option>
<option    value="inset"    >Inset</option>	
<option    value="outset"   >Outset</option>	
<option    value="none"   >None</option>				
</select>
</td>
</tr>
<tr>
<td width="220"  class="key">
Like Hits Data Border Corner Radius:
</td>
<td>
<input size="20"  type="text" name="dlikehitsbdrrad" id="dlikehitsbdrrad" value="" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Like Hits Data Text Color:
</td>
<td>
<input size="20"  type="text" name="dlikehitstxtcl" id="dlikehitstxtcl" value="" class="color" />
</td>
</tr>					
<tr>
<td width="220"  class="key">
Image (before text):
</td>
<td>  
                     <input type="text" value="" name="aimage" id="post_image6" class="text_input" style="width:121px; margin-bottom:4px;"/><a class="button lu_upload_button" id="6" href="#" />Select</a><br />
                   <a href="javascript:removeImage6();">Remove Image</a><br />
                               <div style="height:50px;">
                <img style=" display:block;width:160px" id="imagebox6" src="" />     
                                                 </div>     
                                    <script type="text/javascript">    
                  function removeImage6()
                                    {
                                 document.getElementById("post_image6").value='';
                                 document.getElementById("imagebox6").style.display="none";
                                
                                    }
                                    </script>              
                                </td>		
</tr>
				
<tr>
<td width="220"  class="key">
Image Width:
</td>
<td>
<input size="20"  type="text" name="aimagewidth" id="aimagewidth" value="" />
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Image Height:
</td>
<td>
<input size="20"  type="text" name="aimageheight" id="aimageheight" value="" />
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Image Margin:
</td>
<td>
<input size="20"  type="text" name="amarginimage" id="amarginimage" value="" />
</td>
</tr>
				
				
<tr>
<td width="220"  class="key">
Image (after text):
</td>
<td>  
                     <input type="text" value="" name="aimage2" id="post_image7" class="text_input" style="width:121px; margin-bottom:4px;"/><a class="button lu_upload_button" id="7" href="#" />Select</a><br />
                   <a href="javascript:removeImage7();">Remove Image</a><br />
                               <div style="height:50px;">
                <img style=" display:block; width:160px" id="imagebox7" src="" />     
                                                 </div>     
                                    <script type="text/javascript">    
                  function removeImage7()
                                    {
                                 document.getElementById("post_image7").value='';
                                 document.getElementById("imagebox7").style.display="none";
                                
                                    }
                                    </script>              
                                </td>	
				</tr>
				
<tr>
<td width="220"  class="key">
Image Width:
</td>
<td>
<input size="20"  type="text" name="aimagewidth2" id="aimagewidth2" value="" />
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Image Height:
</td>
 <td>
<input size="20"  type="text" name="aimageheight2" id="aimageheight2" value="" />
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Image Margin:
</td>
<td>
 <input size="20"  type="text" name="amarginimage2" id="amarginimage2" value="" />
  </td>
  </tr>
				
</table>
</fieldset>
</div>
</div>			  
</fieldset>
</div>
<input type="hidden" name="id"
value="" />
<input type="hidden" name="task" value="" />
</form>
<?php
}



function 	html_show_spider_theme($rows, $pageNav,$sort){
	global $wpdb;
	$serch_value = "";
	if(!isset($sort["sortid_by"]))$sort["sortid_by"] = "id";
	if(!isset($sort["custom_style"]))$sort["custom_style"] = "";
	if(!isset($sort["1_or_2"]))$sort["1_or_2"] = "1";
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
    <form method="post"  onkeypress="doNothing()" action="admin.php?page=Spider_Faq_Themes" id="admin_form" name="admin_form">
	<table cellspacing="10" width="100%">
	 <tr>
        <td width="100%" style="font-size:14px; font-weight:bold"><a href="http://web-dorado.com/step-4-adding-themes/spider-faq-wordpress-guide-step-4-1.html" target="_blank" style="color:blue; text-decoration:none;">User Manual</a><br>
This section allows you to create/edit themes for the FAQs. <a href="http://web-dorado.com/step-4-adding-themes/spider-faq-wordpress-guide-step-4-1.html" target="_blank" style="color:blue; text-decoration:none;">More...</a></td>
   
   			</tr>
	
    <tr>
    <td style="width:80px">
    <?php echo "<h2>".'Themes'. "</h2>"; ?>
    </td>
    <td  style="width:90px; text-align:right;"><p class="submit" style="padding:0px; text-align:left"><input type="button" value="Add a Theme" name="custom_parametrs" onclick="window.location.href='admin.php?page=Spider_Faq_Themes&task=add_Spider_Faq_Themes'" /></p></td>
<td style="text-align:right;font-size:16px;padding:20px; padding-right:30px">

	</td>

    </tr>
    </table>
    <?php
	if(isset($_POST['serch_or_not'])) {if(esc_html($_POST['serch_or_not'])=="search"){ $serch_value=esc_sql(esc_html(stripslashes($_POST['search_events_by_title']))); }else{$serch_value="";}} 
	$serch_fields='<div class="alignleft actions" style="width:204px;">
    	<label for="search_events_by_title" style="font-size:14px">Title: </label>
        <input type="text" name="search_events_by_title" value="'.$serch_value.'" id="search_events_by_title" onchange="clear_serch_texts()">
    </div>
	<div class="alignleft actions">
   		<input type="button" value="Search" onclick="document.getElementById(\'page_number\').value=\'1\'; document.getElementById(\'serch_or_not\').value=\'search\';
		 document.getElementById(\'admin_form\').submit();" class="button-secondary action">
		 <input type="button" value="Reset" onclick="window.location.href=\'admin.php?page=Spider_Faq_Themes\'" class="button-secondary action">
    </div>';
	 print_html_nav1($pageNav['total'],$pageNav['limit'],$serch_fields);	
	
	?>
  <table class="wp-list-table widefat fixed pages" style="width:95%">
 <thead>
 <TR>
   <th scope="col" id="id" class="<?php if($sort["sortid_by"]=="id") echo $sort["custom_style"];  ?>" style="width:45px;padding: 2px 11px 2px 0px;" ><a style="padding: 8px 4px 7px 10px;" href="javascript:ordering('id',<?php if($sort["sortid_by"]=="id") echo $sort["1_or_2"]; else echo "1"; ?>)"><span>ID</span><span style="margin-top:6px; margin-left:5px" class="sorting-indicator"></span></a></th>
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
         <td style="padding-left: 10px;padding-top: 8px; padding-bottom: 0px; padding-right: 0px;"><?php echo $rows[$i]->id; ?></td>
         <td><a  href="admin.php?page=Spider_Faq_Themes&task=edit_Spider_Faq_Themes&id=<?php echo $rows[$i]->id?>"><?php echo $rows[$i]->title; ?></a></td>
  
         
         <td ><a  href="admin.php?page=Spider_Faq_Themes&task=edit_Spider_Faq_Themes&id=<?php echo $rows[$i]->id?>">Edit</a></td>
         
		 <td><a href="javascript:confirmation('admin.php?page=Spider_Faq_Themes&task=remove_Spider_Faq_Themes&id=<?php echo $rows[$i]->id ?>','<?php if($rows[$i]->title!="") echo addslashes($rows[$i]->title); else echo "" ?>')">Delete</a> </td>
  </tr> 
 <?php } ?>
 </tbody>
 </table>
 <input type="hidden" name="oreder_move" id="oreder_move" value="" />
 <input type="hidden" name="asc_or_desc" id="asc_or_desc" value="<?php if(isset($_POST['asc_or_desc'])) echo esc_sql(esc_html(stripslashes($_POST['asc_or_desc'])));?>"  />
 <input type="hidden" name="order_by" id="order_by" value="<?php if(isset($_POST['order_by'])) echo esc_sql(esc_html(stripslashes($_POST['order_by'])));?>"  />
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
	
 function html_edit_spider_theme($row){
 global $wpdb; 
?>
<script type="text/javascript">
var plugin_url= "<?php echo plugins_url( '',__FILE__)?>";
function submitbutton(pressbutton) 
{

	if(!document.getElementById('title').value){
	alert("Title is required.");
	return;
	
	}

	document.getElementById("adminForm1").action=document.getElementById("adminForm1").action+"&task="+pressbutton;
	document.getElementById("adminForm1").submit();
	
}


</script>

<script type="text/javascript">

jQuery(function() {
	var formfield=null;
	var x=null;
	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html){
		if (formfield) {
	
			
			var fileurl = jQuery('img',html).attr('src');
		
			if(fileurl)
	
			{
							window.parent.document.getElementById('imagebox'+x).src=fileurl;
							window.parent.document.getElementById('imagebox'+x).style.display="block";
			}
							
		
			formfield.val(fileurl);
			
			
			tb_remove();
		} else {
			window.original_send_to_editor(html);
		}
		formfield=null;
	};
 
	jQuery('.lu_upload_button').click(function() {
 		formfield = jQuery(this).parent().find(".text_input");
		formimg = jQuery(this).parent().find(".img_input");
		x=this.id;
		
 		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		jQuery('#TB_overlay,#TB_closeWindowButton').bind("click",function(){formfield=null;});
		return false;
	});
	jQuery(document).keyup(function(e) {
  		if (e.keyCode == 27) formfield=null;
	});
});



</script>




<table width="95%">
  <tbody>
 <tr>
        <td width="100%" style="font-size:14px; font-weight:bold"><a href="http://web-dorado.com/step-4-adding-themes/spider-faq-wordpress-guide-step-4-1.html" target="_blank" style="color:blue; text-decoration:none;">User Manual</a><br>
This section allows you to create/edit themes for the FAQs. <a href="http://web-dorado.com/step-4-adding-themes/spider-faq-wordpress-guide-step-4-1.html" target="_blank" style="color:blue; text-decoration:none;">More...</a></td>
   
   			</tr>
	
  <tr>
  <td width="100%"><h2>Theme - <?php echo stripslashes($row->title) ?></h2></td>
  <td align="right"><input type="button" onclick="submitbutton('save')" value="Save" class="button-secondary action"> </td>  
  <td align="right"><input type="button" onclick="submitbutton('apply')" value="Apply" class="button-secondary action"> </td> 
  <td align="right"><input type="button" onclick="window.location.href='admin.php?page=Spider_Faq_Themes'" value="Cancel" class="button-secondary action"> </td> 
  </tr>
  </tbody></table>
  <br />
  <br />
  <link rel="stylesheet" href="<?php echo  plugins_url( 'elements/backendstyle.css',	__FILE__ ); ?>">	
<form action="admin.php?page=Spider_Faq_Themes&id=<?php echo $row->id; ?>" method="post" name="adminForm1" id="adminForm1">
<div id="themeparams">
<div style="float:left">
<div class="divfieldset"> 
 <fieldset style="width:430px"><legend>General Parameters </legend>    


<table class="admintable">
<tr>
<td width="220"  class="key">
Theme Title:
</td>
<td>
<input  type="text" name="title" id="title" size="20"  value="<?php echo $row->title;?>" />
</td>
</tr>


<tr id="bg">
<td width="200px">
Background:
</td>
<td width="200">
	<input type="radio" name="background"  value="0" onChange="show_(0)"  <?php if($row->background==0) echo 'checked="checked"' ?> id="show0"><label for="show0">Color</label>	 
	<input type="radio" name="background"  value="1" onChange="show_(1)"  <?php if($row->background==1) echo 'checked="checked"' ?>id="show1"><label for="show1">Image</label>
	<input type="radio" name="background"  value="2" onChange="show_(2)" <?php if($row->background==2) echo 'checked="checked"' ?> id="show2"><label  for="show2"> Transparent</label>
</td>
</tr>
				
				
<script type="text/javascript">

function show_(x)
{
	
	if(x==0)
	{
	document.getElementById('bg').parentNode.childNodes[8].setAttribute('style','display:none');	
	document.getElementById('bg').parentNode.childNodes[6].removeAttribute('style');	
	}
	else
	{
	if(x==1)
	{
   document.getElementById('bg').parentNode.childNodes[6].setAttribute('style','display:none');	
	document.getElementById('bg').parentNode.childNodes[8].removeAttribute('style');
	}
	else
	{
	document.getElementById('bg').parentNode.childNodes[6].setAttribute('style','display:none');	
	document.getElementById('bg').parentNode.childNodes[8].setAttribute('style','display:none');	
	}
	}
	
}
</script>

<tr>
<td width="220"  class="key">
Background Color:
</td>
<td>
<input  type="text" name="bgcolor" id="bgcolor" value="<?php echo $row->bgcolor; ?>" class="color">
</td>

<script type="text/javascript">
        
		show1=document.getElementById("show1").checked;
	if (show1)
	{
document.getElementById('bg').parentNode.childNodes[6].setAttribute('style','display:none');

	}
	
        </script>
</tr>


 <tr>
<td width="220" class="key">
Background Image:
</td>
<td>            
                  <input type="text" value="<?php if($row->bgimage )echo htmlspecialchars($row->bgimage); ?>" name="bgimage" id="post_image1" class="text_input" style="width:121px; margin-bottom:4px;"/><a class="button lu_upload_button" id="1" href="#" />Select</a><br />
                      <a href="javascript:removeImage1();">Remove Image</a><br />
                    <div style="height:150px;">
              <img style=" display:<?php if($row->bgimage=='') echo 'none'; else echo 'block' ?>" height="150"  width="180" class="img_input" id="imagebox1" src="<?php echo $row->bgimage ?>" />     
                          </div>     
              <script type="text/javascript">    
                  function removeImage1()
                         {
                                 document.getElementById("post_image1").value='';
                                 document.getElementById("imagebox1").style.display="none";
                              
                        }
                                    </script>              
                                </td>				

<script type="text/javascript">
        
		show0=document.getElementById("show0").checked;
	if (show0)
	{
document.getElementById('bg').parentNode.childNodes[8].setAttribute('style','display:none');

	}
	
        </script>			
</tr>

<script type="text/javascript">
        
		show2=document.getElementById("show2").checked;
	if (show2)
	{
document.getElementById('bg').parentNode.childNodes[6].setAttribute('style','display:none');
document.getElementById('bg').parentNode.childNodes[8].setAttribute('style','display:none');
	}
	
        </script>	

<tr>
<td width="220"  class="key">
Width:
</td>
<td>
<input size="20"  type="text" name="width" id="width" value="<?php if($row->width=="") echo '600'; else echo $row->width; ?>" />
</td>
</tr>
				
 <tfoot>
						<tr style="text-align:center">
							<td colspan="11">
							<?php $theme_id= $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."spider_faq_theme WHERE id=".$row->id." ");
							if($theme_id->default==1 or $theme_id->default==18 or $theme_id->default==19 or $theme_id->default==20 or $theme_id->default==21 or $theme_id->default==22 ){ 
							?>
		
		<img onclick="reset_theme_<?php if($theme_id->default==1) echo $row->id ;else echo $theme_id->default ; ?>();" src="<?php echo plugins_url("images/reset_theme.png",__FILE__) ?>" />
		<?php }?>
							</td>
						</tr>
					</tfoot>


</table>
</fieldset>
</div>
<div class="divfieldset">
<fieldset style="width:430px"><legend>Question Title Parameters </legend>     
<table class="admintable">

<tr>
<td width="220"  class="key">
Space Between Questions:
</td>
<td>
<input size="20"  type="text" name="paddingbq" id="paddingbq" value="<?php echo htmlspecialchars($row->paddingbq); ?>" />
</td>
</tr>
				

<tr>
<td width="220" >
Margin (left):
</td>
<td width="170px">
<input size="20"  type="text" name="marginleft" id="marginleft" value="<?php echo htmlspecialchars($row->marginleft); ?>" />
</td>
</tr>

				
<tr>
<td width="220"  class="key">
Height:
</td>
<td>
<input size="20"  type="text" name="theight" id="theight" value="<?php echo htmlspecialchars($row->theight); ?>" />
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Width:
</td>
<td>
<input size="20"  type="text" name="twidth" id="twidth" value="<?php echo htmlspecialchars($row->twidth); ?>" />
</td>
</tr>				
				
				
				
<tr>
<td width="220"  class="key">
Font Size:
</td>
<td>
<input size="20"  type="text" name="tfontsize" id="tfontsize" value="<?php echo htmlspecialchars($row->tfontsize); ?>" />
</td>
</tr>

<tr>
<td width="180px" >
Text Width:
</td>
<td width="170px">
<input size="20"  type="text" name="ttxtwidth" id="ttxtwidth" value="<?php   echo htmlspecialchars($row->ttxtwidth); ?>" />%
</td>
</tr>
				
<tr>
<td width="180px" >
Padding (left):
</td>
<td width="170px">
<input size="20"  type="text" name="ttxtpleft" id="ttxtpleft" value="<?php   echo htmlspecialchars($row->ttxtpleft); ?>" />
</tr>
				
<tr>
<td width="220"  class="key">
Text Color:
</td>
<td>
<input type="text" name="tcolor" id="tcolor" value="<?php echo $row->tcolor; ?>" class="color">
</td>
</tr>
				
				
<tr id="titlebg">
<td td width="180px">
Background:
</td>
<td width="170px">	
<input type="radio" name="titlebg"   value="0" onChange="titlebg_(0)" <?php if($row->titlebg==0) echo 'checked="checked"' ?> id="titlebg0"><label for="titlebg0">Color</label>	 
<input type="radio" name="titlebg"  value="1" onChange="titlebg_(1)" <?php if($row->titlebg==1) echo 'checked="checked"' ?>  id="titlebg1"><label for="titlebg1">Image</label>
						
					</td>



<tr>
<td td width="180px">
Gradient:
</td>
<td width="170px">	
<input type="radio" name="titlebggrad"  value="0" onChange="titlebggrad_(0)" <?php if($row->titlebggrad==0) echo 'checked="checked"' ?> id="titlebggrad0"><label for="titlebggrad0">No</label>	 
<input type="radio" name="titlebggrad"  value="1" onChange="titlebggrad_(1)" <?php if($row->titlebggrad==1) echo 'checked="checked"' ?> id="titlebggrad1"><label for="titlebggrad1">Yes</label>
</td>

<script type="text/javascript">



function titlebggrad_(x)
{
	if(x==0)
	{
	document.getElementById('titlebg').parentNode.childNodes[21].setAttribute('style','display:none');
	document.getElementById('titlebg').parentNode.childNodes[23].setAttribute('style','display:none');
	document.getElementById('titlebg').parentNode.childNodes[25].setAttribute('style','display:none');
	document.getElementById('titlebg').parentNode.childNodes[19].removeAttribute('style');
	document.getElementById('titlebg').parentNode.childNodes[17].removeAttribute('style');
	}
	else
	{
	document.getElementById('titlebg').parentNode.childNodes[19].setAttribute('style','display:none');
	document.getElementById('titlebg').parentNode.childNodes[21].setAttribute('style','display:none');
	document.getElementById('titlebg').parentNode.childNodes[23].removeAttribute('style');
	document.getElementById('titlebg').parentNode.childNodes[25].removeAttribute('style');
	}

	
}


titlebg1=document.getElementById("titlebg1").checked;
	if (titlebg1)
	{
document.getElementById('titlebg').parentNode.childNodes[17].setAttribute('style','display:none');

	}
</script> 

</tr>	            
			  
<tr>
<td width="180px">
Background Color:
</td>
<td>
<input type="text" name="tbgcolor" id="tbgcolor" value="<?php echo $row->tbgcolor; ?>" class="color">
</td>
					
					<script type="text/javascript">
        
		titlebg1=document.getElementById("titlebg1").checked;
	if (titlebg1)
	{
document.getElementById('titlebg').parentNode.childNodes[19].setAttribute('style','display:none');

	}
	
	titlebg0=document.getElementById("titlebg0").checked;
	titlebggrad1=document.getElementById("titlebggrad1").checked;
	if (titlebg0 && titlebggrad1)
	{
document.getElementById('titlebg').parentNode.childNodes[19].setAttribute('style','display:none');

	}
        </script>		
					
</tr>

				 
<tr>
<td width="220"  class="key">
Background Image:
</td>

<td>         
                  <input type="text" value="<?php if($row->tbgimage )echo htmlspecialchars($row->tbgimage); ?>" name="tbgimage" id="post_image2" class="text_input" style="width:121px; margin-bottom:4px;"/><a class="button lu_upload_button" id="2" href="#" />Select</a><br />
                      <a href="javascript:removeImage2();">Remove Image</a><br />
                    <div style="height:150px;">
              <img style=" display:<?php if($row->tbgimage=='') echo 'none'; else echo 'block' ?>; width:150px" id="imagebox2" src="<?php echo $row->tbgimage ?>" />     
                          </div>     
              <script type="text/javascript">    
                  function removeImage2()
                         {
                                 document.getElementById("post_image2").value='';
                                 document.getElementById("imagebox2").style.display="none";
                              
                        }
                                    </script>         									
 </td>	
<script type="text/javascript">
        
		titlebg0=document.getElementById("titlebg0").checked;
	if (titlebg0)
	{
document.getElementById('titlebg').parentNode.childNodes[21].setAttribute('style','display:none');

	}
	
        </script>		
	
</tr>


<tr>
<td width="180px">
Gradient Direction:
</td>
<td>
<select name="gradtype" id="gradtype">					 
<option    value="top"   <?php if($row->cdgradtype=="top") echo 'selected="selected"'?>>Top/Bottom</option>	 
<option    value="left"  <?php if($row->cdgradtype=="left") echo 'selected="selected"'?>>Left/Right</option>
<option    value="circle" <?php if($row->cdgradtype=="circle") echo 'selected="selected"'?>>Center</option>						
</select>					
</td>

<script type="text/javascript">
        
		titlebg1=document.getElementById("titlebg1").checked;
	if (titlebg1)
	{
document.getElementById('titlebg').parentNode.childNodes[23].setAttribute('style','display:none');

	}
	
	titlebg0=document.getElementById("titlebg0").checked;
	titlebggrad0=document.getElementById("titlebggrad0").checked;
	if (titlebg0 && titlebggrad0)
	{
document.getElementById('titlebg').parentNode.childNodes[23].setAttribute('style','display:none');

	}
        </script>		        
			  
   </tr>
   

 <tr>
<td width="180px">
Background Color:
</td>
<td >
From <input size="5" type="text" name="gradcolor1" id="gradcolor1" value="<?php echo $row->gradcolor1; ?>" class="color">
To <input size="5" type="text" name="gradcolor2" id="gradcolor2" value="<?php echo $row->gradcolor2; ?>" class="color">
</td>
				<script type="text/javascript">
        
		titlebg1=document.getElementById("titlebg1").checked;
	if (titlebg1)
	{
document.getElementById('titlebg').parentNode.childNodes[25].setAttribute('style','display:none');

	}
	
	titlebg0=document.getElementById("titlebg0").checked;
	titlebggrad0=document.getElementById("titlebggrad0").checked;
	if (titlebg0 && titlebggrad0)
	{
document.getElementById('titlebg').parentNode.childNodes[25].setAttribute('style','display:none');

	}
	
	
        </script>			
</tr>
 

<tr>
<td width="180px">
Background Hover Color:
</td>
<td>
<input type="text" name="tbghovercolor" id="tbghovercolor" value="<?php echo $row->tbghovercolor; ?>" class="color">
</td>
		<script type="text/javascript">			
			titlebg1=document.getElementById("titlebg1").checked;
	if (titlebg1)
	{
document.getElementById('titlebg').parentNode.childNodes[27].setAttribute('style','display:none');

	}
        
	
	</script>				
</tr>
				
<tr>
<td width="220"  class="key">
Background-size:
</td>
<td>
<input size="20"  type="text" name="tbgsize" id="tbgsize" value="<?php echo htmlspecialchars($row->tbgsize); ?>" />
</td>
	<script type="text/javascript">			
			titlebg0=document.getElementById("titlebg0").checked;
	if (titlebg0)
	{
document.getElementById('titlebg').parentNode.childNodes[29].setAttribute('style','display:none');
	}
        
	
	</script>	
</tr>		
				
<script type="text/javascript">



function titlebg_(x)
{
	
	if(x==0)
	{
	document.getElementById('titlebg').parentNode.childNodes[21].setAttribute('style','display:none');	
	document.getElementById('titlebg').parentNode.childNodes[17].removeAttribute('style');
	 document.getElementById('titlebg').parentNode.childNodes[27].removeAttribute('style');
	 document.getElementById('titlebg').parentNode.childNodes[29].setAttribute('style','display:none');
	titlebggrad1=document.getElementById("titlebggrad1").checked;
	if (titlebggrad1)
	{
document.getElementById('titlebg').parentNode.childNodes[19].setAttribute('style','display:none');
document.getElementById('titlebg').parentNode.childNodes[23].removeAttribute('style');
document.getElementById('titlebg').parentNode.childNodes[25].removeAttribute('style');
	}
	titlebggrad0=document.getElementById("titlebggrad0").checked;
	if (titlebggrad0)
	{
document.getElementById('titlebg').parentNode.childNodes[23].setAttribute('style','display:none');
document.getElementById('titlebg').parentNode.childNodes[25].setAttribute('style','display:none');
document.getElementById('titlebg').parentNode.childNodes[19].removeAttribute('style');
	}
	}
	else
	{
	document.getElementById('titlebg').parentNode.childNodes[17].setAttribute('style','display:none');
     document.getElementById('titlebg').parentNode.childNodes[19].setAttribute('style','display:none');
     document.getElementById('titlebg').parentNode.childNodes[23].setAttribute('style','display:none');
	 document.getElementById('titlebg').parentNode.childNodes[25].setAttribute('style','display:none');
	 document.getElementById('titlebg').parentNode.childNodes[27].setAttribute('style','display:none');
	document.getElementById('titlebg').parentNode.childNodes[21].removeAttribute('style');
	document.getElementById('titlebg').parentNode.childNodes[29].removeAttribute('style');
	}
	
	
}
</script> 				
<tr>
<td width="180px" >
Border Style:
</td>
<td width="170px">
<select name="tbstyle" id="tbstyle">					 
<option    value="solid"   <?php if($row->tbstyle=="solid") echo 'selected="selected"'?>>Solid</option>	 
<option    value="dotted"    <?php if($row->tbstyle=="dotted") echo 'selected="selected"'?>>Dotted</option>
<option    value="dashed"    <?php if($row->tbstyle=="dashed") echo 'selected="selected"'?>>Dashed</option>		
<option    value="double"    <?php if($row->tbstyle=="double") echo 'selected="selected"'?>>Double</option>
<option    value="groove"    <?php if($row->tbstyle=="groove") echo 'selected="selected"'?>>Groove</option>		
<option    value="ridge"     <?php if($row->tbstyle=="ridge") echo 'selected="selected"'?>>Ridge</option>
<option    value="inset"    <?php if($row->tbstyle=="inset") echo 'selected="selected"'?>>Inset</option>	
<option    value="outset"    <?php if($row->tbstyle=="outset") echo 'selected="selected"'?>>Outset</option>	
<option    value="none"    <?php if($row->tbstyle=="none" || $row->ctbstyle=="") echo 'selected="selected"'?>>None</option>				
</select>
</td>
</tr>
<tr>
<td width="180px" >
Border Top Style:
</td>
<td width="170px">
<select name="tbtopstyle" id="tbtopstyle">					 
<option    value="solid"   <?php if($row->tbtopstyle=="solid") echo 'selected="selected"'?>>Solid</option>	 
<option    value="dotted"    <?php if($row->tbtopstyle=="dotted") echo 'selected="selected"'?>>Dotted</option>
<option    value="dashed"    <?php if($row->tbtopstyle=="dashed") echo 'selected="selected"'?>>Dashed</option>		
<option    value="double"    <?php if($row->tbtopstyle=="double") echo 'selected="selected"'?>>Double</option>
<option    value="groove"    <?php if($row->tbtopstyle=="groove") echo 'selected="selected"'?>>Groove</option>		
<option    value="ridge"     <?php if($row->tbtopstyle=="ridge") echo 'selected="selected"'?>>Ridge</option>
<option    value="inset"    <?php if($row->tbtopstyle=="inset") echo 'selected="selected"'?>>Inset</option>	
<option    value="outset"    <?php if($row->tbtopstyle=="outset") echo 'selected="selected"'?>>Outset</option>	
<option    value="none"    <?php if($row->tbtopstyle=="none" || $row->ctbstyle=="") echo 'selected="selected"'?>>None</option>				
</select>
</td>
</tr>				
<tr>
<td width="180px" >
Border Right Style:
</td>
<td width="170px">
<select name="tbrightstyle" id="tbrightstyle">					 
<option    value="solid"   <?php if($row->tbrightstyle=="solid") echo 'selected="selected"'?>>Solid</option>	 
<option    value="dotted"    <?php if($row->tbrightstyle=="dotted") echo 'selected="selected"'?>>Dotted</option>
<option    value="dashed"    <?php if($row->tbrightstyle=="dashed") echo 'selected="selected"'?>>Dashed</option>		
<option    value="double"    <?php if($row->tbrightstyle=="double") echo 'selected="selected"'?>>Double</option>
<option    value="groove"    <?php if($row->tbrightstyle=="groove") echo 'selected="selected"'?>>Groove</option>		
<option    value="ridge"     <?php if($row->tbrightstyle=="ridge") echo 'selected="selected"'?>>Ridge</option>
<option    value="inset"    <?php if($row->tbrightstyle=="inset") echo 'selected="selected"'?>>Inset</option>	
<option    value="outset"    <?php if($row->tbrightstyle=="outset") echo 'selected="selected"'?>>Outset</option>	
<option    value="none"    <?php if($row->tbrightstyle=="none" || $row->ctbstyle=="") echo 'selected="selected"'?>>None</option>				
</select>
</td>
</tr>				
<tr>
<td width="180px" >
Border Width:
</td>
<td width="170px">
<input size="20"  type="text" name="tbwidth" id="tbwidth" value="<?php echo htmlspecialchars($row->tbwidth); ?>" />
</td>
</tr>
				
<tr>
<td width="180px">
Border Color:
</td>
<td>
<input type="text" name="tbcolor" id="tbcolor" value="<?php echo $row->tbcolor; ?>" class="color">
</td>
</tr>
				
<tr>
<td width="180px" >
Border Corner Radius:
</td>
<td width="170px">
<input size="20"  type="text" name="tbradius" id="tbradius" value="<?php echo htmlspecialchars($row->tbradius); ?>" />
</td>
</tr>	
 <tr>
<td td width="180px">
Numbering:
</td>
<td width="170px">	
<input type="radio" name="numbering"  value="0" <?php if($row->numbering==0) echo 'checked="checked"'?> onchange="numbfontcol(0)"  id="numberingno"><label for="numbering">No</label>	 
<input type="radio" name="numbering"  value="1" <?php if($row->numbering==1) echo 'checked="checked"'?> onchange="numbfontcol(1)" id="numberingyes"><label for="numbering">Yes</label>
</td>
</tr>
<tr id="numbfont" <?php if($row->numbering==0) echo 'style="display:none"';else echo 'style="display:table-row;"';?>    >
<td width="180px" >
Numbering Font Size:
</td>
<td width="170px">
<input size="20"  type="text" name="numberfnts" id="numberfnts" value="<?php echo htmlspecialchars($row->numberfnts); ?>" />
</td>
</tr>
<tr id="numbcol" <?php if($row->numbering==0) echo 'style="display:none"';else echo 'style="display:table-row;"';?>  >
<td width="180px" >
Numbering Color:
</td>
<td width="170px">
<input size="20"  type="text" name="numbercl" id="numbercl" value="<?php echo htmlspecialchars($row->numbercl); ?>" class="color"/>
</td>
</tr>								
<tr>
<td width="220"  class="key">
Bullet Image (Collapsed):
</td>

<td>           
                  <input type="text" value="<?php if($row->tchangeimage1 )echo htmlspecialchars($row->tchangeimage1); ?>" name="tchangeimage1" id="post_image3" class="text_input" style="width:121px; margin-bottom:4px;"/><a class="button lu_upload_button" id="3" href="#" />Select</a><br />
                      <a href="javascript:removeImage3();">Remove Image</a><br />
                    <div style="height:50px;">
              <img style=" display:<?php if($row->tchangeimage1=='') echo 'none'; else echo 'block' ?>" id="imagebox3" src="<?php echo $row->tchangeimage1 ?>" />     
                          </div>     
              <script type="text/javascript">
function numbfontcol(m)
{
if(m==1)
{
document.getElementById("numbfont").style.display="table-row";
document.getElementById("numbcol").style.display="table-row";
}
else 
{
document.getElementById("numbfont").style.display="none";
document.getElementById("numbcol").style.display="none";
}
} 
			  
                  function removeImage3()
                         {
                                 document.getElementById("post_image3").value='';
                                 document.getElementById("imagebox3").style.display="none";
                             
                        }
                                    </script>              
 </td>	

</tr>
				
				

				
<tr>
<td width="220"  class="key">
Image Margin (left):
</td>
<td>
<input size="20"  type="text" name="marginlimage1" id="marginlimage1" value="<?php echo htmlspecialchars($row->marginlimage1); ?>" />
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Bullet Image (Expanded):
</td>
<td>           
                  <input type="text" value="<?php if($row->tchangeimage2 )echo htmlspecialchars($row->tchangeimage2); ?>" name="tchangeimage2" id="post_image4" class="text_input" style="width:121px; margin-bottom:4px;"/><a class="button lu_upload_button" id="4" href="#" />Select</a><br />
                      <a href="javascript:removeImage4();">Remove Image</a><br />
                    <div style="height:50px;">
              <img style=" display:<?php if($row->tchangeimage2=='') echo 'none'; else echo 'block' ?>"  id="imagebox4" src="<?php echo $row->tchangeimage2 ?>" />     
                          </div>     
              <script type="text/javascript">    
                  function removeImage4()
                         {
                                 document.getElementById("post_image4").value='';
                                 document.getElementById("imagebox4").style.display="none";
                             
                        }
                                    </script>              
 </td>	
</tr>
				
				
<tr>
<td width="220"  class="key">
Image Margin (left):
</td>
<td>
<input size="20"  type="text" name="marginlimage2" id="marginlimage2" value="<?php echo htmlspecialchars($row->marginlimage2); ?>" />
</td>
</tr>
 <tr>
<td td width="180px">
Image Position:
</td>
<td width="170px">	
<input type="radio" name="imgpos"  value="0" <?php if($row->imgpos==0) echo 'checked="checked"'?>  id="imgposleft"><label for="imgpos">Left</label>	 
<input type="radio" name="imgpos"  value="1" <?php if($row->imgpos==1) echo 'checked="checked"'?>  id="imgposright"><label for="imgpos">Right</label>
</td>
</tr>
</table>
</fieldset >
</div>
<div class="divfieldset">
<fieldset style="width:430px;" ><legend>Search Box Parameters </legend>    
<table class="admintable">			
<tr>
<td width="220"  class="key">
Background Color:
</td>
<td>
<input type="text" name="sboxbgcolor" id="sboxbgcolor" value="<?php echo $row->sboxbgcolor; ?>" class="color">
</td>
</tr>		
</table>
</fieldset>
</div>
<div class="clear"></div>


<div class="divfieldset">

<fieldset style="width:430px;"><legend>Expand/Collapse Parameters </legend>    
<table class="admintable">
<tr>
<td width="220"  class="key">
Color:
</td>
<td>
<input type="text" name="expcolcolor" id="expcolcolor" value="<?php echo $row->expcolcolor; ?>" class="color">
 </td>
</tr>
				
<tr>
<td width="220"  class="key">
Hover Color:
</td>
<td>
<input type="text" name="expcolhovercolor" id="expcolhovercolor" value="<?php echo $row->expcolhovercolor; ?>" class="color">
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Font Size:
</td>
<td>
<input type="text" name="expcolfontsize" id="expcolfontsize" value="<?php echo $row->expcolfontsize; ?>">
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Margin:
</td>
<td>
<input type="text" name="expcolmargin" id="expcolmargin" value="<?php echo $row->expcolmargin; ?>">
</td>
</tr>

</table>
</fieldset >
</div>

<div class="divfieldset">
<fieldset style="width:430px;" ><legend>Read More Button Parameters </legend>     
<table class="admintable">	


<tr>
<td width="220"  class="key">
Color:
</td>
<td>
<input type="text" name="rmcolor" id="rmcolor" value="<?php echo $row->rmcolor; ?>" class="color">
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Hover Color:
</td>
<td>
<input type="text" name="rmhovercolor" id="rmhovercolor" value="<?php echo $row->rmhovercolor; ?>" class="color">
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Font Size:
</td>
<td>
<input type="text" name="rmfontsize" id="rmfontsize" value="<?php echo $row->rmfontsize; ?>">
</td>
</tr>			
	          </table>
</fieldset>
</div>
</div>
<div style="float:left">
<div class="divfieldset" >  
 <fieldset style="width:430px;"><legend>Category Parameters </legend>  
<table class="admintable" style=" width:420px; ">

  <tr>
<td>
<div style="font-size:14px; font-weight:bold;"></div>
</td> 
</tr>

				
<tr id="ctbg">
<td td width="180px">
Background:
</td>
<td width="170px">	
<input type="radio" name="ctbg"   value="0" onChange="ctbg_(0)" <?php if($row->ctbg==0) echo 'checked="checked"' ?> id="ctbg0"><label for="ctbg0">No</label>	 
<input type="radio" name="ctbg"  value="1" onChange="ctbg_(1)"  <?php if($row->ctbg==1) echo 'checked="checked"' ?> id="ctbg1"><label for="ctbg1">Yes</label>
</td>

<script type="text/javascript">

function ctbg_(x)
{
	
	if(x==0)
	{
	document.getElementById('ctbg').parentNode.childNodes[4].setAttribute('style','display:none');
    document.getElementById('ctbg').parentNode.childNodes[6].setAttribute('style','display:none');
    document.getElementById('ctbg').parentNode.childNodes[8].setAttribute('style','display:none');
    document.getElementById('ctbg').parentNode.childNodes[10].setAttribute('style','display:none');
	
	}
	else
	{
	document.getElementById('ctbg').parentNode.childNodes[4].removeAttribute('style');
	ctbggrad0=document.getElementById("ctbggrad0").checked;
	if (ctbggrad0)
	{
document.getElementById('ctbg').parentNode.childNodes[8].setAttribute('style','display:none');
document.getElementById('ctbg').parentNode.childNodes[10].setAttribute('style','display:none');
document.getElementById('ctbg').parentNode.childNodes[6].removeAttribute('style');

	}
	ctbggrad1=document.getElementById("ctbggrad1").checked;
	if (ctbggrad1)
	{
document.getElementById('ctbg').parentNode.childNodes[6].setAttribute('style','display:none');
document.getElementById('ctbg').parentNode.childNodes[8].removeAttribute('style');
document.getElementById('ctbg').parentNode.childNodes[10].removeAttribute('style');
	}
				
	}

	
}
</script> 
</tr>

 
				
<tr>
<td td width="180px">
Gradient:
</td>
<td width="170px">	
<input type="radio" name="ctbggrad"  value="0" onChange="ctbggrad_(0)" <?php if($row->ctbggrad==0) echo 'checked="checked"' ?> id="ctbggrad0"><label for="ctbggrad0">No</label>	 
<input type="radio" name="ctbggrad"  value="1" onChange="ctbggrad_(1)" <?php if($row->ctbggrad==1) echo 'checked="checked"' ?>  id="ctbggrad1"><label for="ctbggrad1">Yes</label>
</td>

<script type="text/javascript">


function ctbggrad_(x)
{
	
if(x==0)
	{
    document.getElementById('ctbg').parentNode.childNodes[8].setAttribute('style','display:none');
    document.getElementById('ctbg').parentNode.childNodes[10].setAttribute('style','display:none');
	document.getElementById('ctbg').parentNode.childNodes[6].removeAttribute('style');
	}
	else
	{
	document.getElementById('ctbg').parentNode.childNodes[6].setAttribute('style','display:none');  
	document.getElementById('ctbg').parentNode.childNodes[8].removeAttribute('style');
	document.getElementById('ctbg').parentNode.childNodes[10].removeAttribute('style');				
	}
	}
	
		ctbg0=document.getElementById("ctbg0").checked;
	if (ctbg0)
	{
document.getElementById('ctbg').parentNode.childNodes[4].setAttribute('style','display:none');

	}
	
</script>   
			   </tr>	            

<tr>
<td width="180px">
Background Color:
</td>
<td width="170px">
<input type="text" name="ctbgcolor" id="ctbgcolor"  value="<?php echo $row->ctbgcolor; ?>" class="color">
</td>
					<script type="text/javascript">
        
		ctbg0=document.getElementById("ctbg0").checked;
	if (ctbg0)
	{
document.getElementById('ctbg').parentNode.childNodes[6].setAttribute('style','display:none');

	}
	
	ctbg1=document.getElementById("ctbg1").checked;
	ctbggrad1=document.getElementById("ctbggrad1").checked;
	if (ctbg1 && ctbggrad1)
	{
document.getElementById('ctbg').parentNode.childNodes[6].setAttribute('style','display:none');

	}
        </script>		
					
                </tr>
			   
<tr>
<td width="180px">
Gradient Direction:
</td>
<td>
<select name="ctgradtype" id="ctgradtype">					 
<option    value="top"    <?php if($row->ctgradtype=="top") echo 'selected="selected"'?>>Top/Bottom</option>	 
<option    value="left"    <?php if($row->ctgradtype=="left") echo 'selected="selected"'?>>Left/Right</option>
<option    value="circle"    <?php if($row->ctgradtype=="circle") echo 'selected="selected"'?>>Center</option>						
</select>					
</td>

<script type="text/javascript">
        
		ctbg0=document.getElementById("ctbg0").checked;
	if (ctbg0)
	{
document.getElementById('ctbg').parentNode.childNodes[8].setAttribute('style','display:none');

	}
	
	ctbg1=document.getElementById("ctbg1").checked;
	ctbggrad0=document.getElementById("ctbggrad0").checked;
	if (ctbg1 && ctbggrad0)
	{
document.getElementById('ctbg').parentNode.childNodes[8].setAttribute('style','display:none');

	}
        </script>			        
			  
   </tr>		

 <tr>
<td width="180px">
Background Color:
</td>
<td >
From <input size="5" type="text" name="ctgradcolor1" id="ctgradcolor1" value="<?php echo $row->ctgradcolor1; ?>" class="color">
To <input size="5" type="text" name="ctgradcolor2" id="ctgradcolor2" value="<?php echo $row->ctgradcolor2; ?>" class="color">
</td>
				<script type="text/javascript">
           
		ctbg0=document.getElementById("ctbg0").checked;
	if (ctbg0)
	{
document.getElementById('ctbg').parentNode.childNodes[10].setAttribute('style','display:none');

	}
	
	ctbg1=document.getElementById("ctbg1").checked;
	ctbggrad0=document.getElementById("ctbggrad0").checked;
	if (ctbg1 && ctbggrad0)
	{
document.getElementById('ctbg').parentNode.childNodes[10].setAttribute('style','display:none');

	}
		
	
        </script>			
                </tr>


<tr>
<td width="220"  class="key">
Text Color:
</td>
<td>
<input type="text" name="cttxtcolor" id="cttxtcolor" value="<?php echo $row->cttxtcolor; ?>" class="color">
</td>
</tr>
				 
<tr>
<td width="220"  class="key">
Font Size:
</td>
<td>
<input size="20"  type="text" name="ctfontsize" id="ctfontsize" value="<?php echo htmlspecialchars($row->ctfontsize); ?>" />
</td>
</tr>

<tr>
<td width="180px" >
Margin:
</td>
<td width="170px">
<input type="text" name="ctmargin" id="ctmargin" size="20" value="<?php echo htmlspecialchars($row->ctmargin); ?>" />
</td>
</tr>
				
<tr>
<td width="220" class="key">
Padding:
</td>
<td>
<input type="text" name="ctpadding" id="ctpadding" size="20" value="<?php echo htmlspecialchars($row->ctpadding); ?>" />
</td>
</tr>
				
				
<tr>
<td width="180px" >
Border Style:
</td>
<td width="170px">
<select name="ctbstyle" id="ctbstyle">					 
<option    value="solid"   <?php if($row->ctbstyle=="solid") echo 'selected="selected"'?>>Solid</option>	 
<option    value="dotted"    <?php if($row->ctbstyle=="dotted") echo 'selected="selected"'?>>Dotted</option>
<option    value="dashed"    <?php if($row->ctbstyle=="dashed") echo 'selected="selected"'?>>Dashed</option>		
<option    value="double"    <?php if($row->ctbstyle=="double") echo 'selected="selected"'?>>Double</option>
<option    value="groove"    <?php if($row->ctbstyle=="groove") echo 'selected="selected"'?>>Groove</option>		
<option    value="ridge"     <?php if($row->ctbstyle=="ridge") echo 'selected="selected"'?>>Ridge</option>
<option    value="inset"    <?php if($row->ctbstyle=="inset") echo 'selected="selected"'?>>Inset</option>	
<option    value="outset"    <?php if($row->ctbstyle=="outset") echo 'selected="selected"'?>>Outset</option>
<option    value="none"    <?php if($row->ctbstyle=="none" || $row->ctbstyle=="") echo 'selected="selected"'?>>None</option>				
</select>
</td>
</tr>
				
				
<tr>
<td width="180px" >
Border Width:
</td>
<td width="170px">
<input size="20"  type="text" name="ctbwidth" id="ctbwidth" value="<?php echo htmlspecialchars($row->ctbwidth); ?>" />
</td>
</tr>
				
<tr>
<td width="180px">
Border Color:
</td>
<td>
<input type="text" name="ctbcolor" id="ctbcolor" value="<?php echo $row->ctbcolor; ?>" class="color">
</td>
</tr>
				
<tr>
<td width="180px" >
Border Corner Radius:
</td>
<td width="170px">
<input size="20"  type="text" name="ctbradius" id="ctbradius" value="<?php echo htmlspecialchars($row->ctbradius); ?>" />
</td>
</tr>	
		

<tr>
<td>
<div style="font-size:14px; font-weight:bold; margin-top:8px;"></div>
</td> 
</tr>

<tr id="cdbg">
<td td width="180px">
Background:
</td>
<td width="170px">	
<input type="radio" name="cdbg"   value="0" onChange="cdbg_(0)" <?php if($row->cdbg==0) echo 'checked="checked"' ?> id="cdbg0"><label for="cdbg0">No</label>	 
<input type="radio" name="cdbg"  value="1" onChange="cdbg_(1)" <?php if($row->cdbg==1) echo 'checked="checked"' ?>  id="cdbg1"><label for="cdbg1">Yes</label>
</td>

<script type="text/javascript">



function cdbg_(x)
{
	
	if(x==0)
	{
	document.getElementById('cdbg').parentNode.childNodes[32].setAttribute('style','display:none');
    document.getElementById('cdbg').parentNode.childNodes[34].setAttribute('style','display:none');
    document.getElementById('cdbg').parentNode.childNodes[36].setAttribute('style','display:none');
    document.getElementById('cdbg').parentNode.childNodes[38].setAttribute('style','display:none');
	
	}
	else
	{
	document.getElementById('cdbg').parentNode.childNodes[32].removeAttribute('style');
	cdbggrad0=document.getElementById("cdbggrad0").checked;
	if (cdbggrad0)
	{
document.getElementById('cdbg').parentNode.childNodes[36].setAttribute('style','display:none');
document.getElementById('cdbg').parentNode.childNodes[38].setAttribute('style','display:none');
document.getElementById('cdbg').parentNode.childNodes[34].removeAttribute('style');

	}
	cdbggrad1=document.getElementById("cdbggrad1").checked;
	if (cdbggrad1)
	{
document.getElementById('cdbg').parentNode.childNodes[34].setAttribute('style','display:none');
document.getElementById('cdbg').parentNode.childNodes[36].removeAttribute('style');
document.getElementById('cdbg').parentNode.childNodes[38].removeAttribute('style');
	}
				
	}
	

	
	
	
}
</script> 
</tr>

 
				
<tr>
<td td width="180px">
Gradient:
</td>
<td width="170px">	
<input type="radio" name="cdbggrad"  value="0" onChange="cdbggrad_(0)" <?php if($row->cdbggrad==0) echo 'checked="checked"' ?> id="cdbggrad0"><label for="cdbggrad0">No</label>	 
<input type="radio" name="cdbggrad"  value="1" onChange="cdbggrad_(1)" <?php if($row->cdbggrad==1) echo 'checked="checked"' ?>  id="cdbggrad1"><label for="cdbggrad1">Yes</label>
</td>

<script type="text/javascript">



function cdbggrad_(x)
{
	
if(x==0)
	{
    document.getElementById('cdbg').parentNode.childNodes[36].setAttribute('style','display:none');
    document.getElementById('cdbg').parentNode.childNodes[38].setAttribute('style','display:none');
	document.getElementById('cdbg').parentNode.childNodes[34].removeAttribute('style');
	}
	else
	{
	document.getElementById('cdbg').parentNode.childNodes[34].setAttribute('style','display:none');  
	document.getElementById('cdbg').parentNode.childNodes[36].removeAttribute('style');
	document.getElementById('cdbg').parentNode.childNodes[38].removeAttribute('style');				
	}
	}
	
		cdbg0=document.getElementById("cdbg0").checked;
	if (cdbg0)
	{
document.getElementById('cdbg').parentNode.childNodes[32].setAttribute('style','display:none');

	}
	
</script>   
</tr>	            
			  
<tr>
<td width="180px">
Background Color:
</td>
<td width="170px">
<input type="text" name="cdbgcolor" id="cdbgcolor"  value="<?php echo $row->cdbgcolor; ?>" class="color">
</td>
					<script type="text/javascript">
        
		cdbg0=document.getElementById("cdbg0").checked;
	if (cdbg0)
	{
document.getElementById('cdbg').parentNode.childNodes[34].setAttribute('style','display:none');

	}
	
	cdbg1=document.getElementById("cdbg1").checked;
	cdbggrad1=document.getElementById("cdbggrad1").checked;
	if (cdbg1 && cdbggrad1)
	{
document.getElementById('cdbg').parentNode.childNodes[34].setAttribute('style','display:none');

	}
        </script>		
					
</tr>
			   
<tr>
<td width="180px">
Gradient Direction:
</td>
<td>
<select name="cdgradtype" id="cdgradtype">					 
<option    value="top"    <?php if($row->cdgradtype=="top") echo 'selected="selected"'?>>Top/Bottom</option>	 
<option    value="left"    <?php if($row->cdgradtype=="left") echo 'selected="selected"'?>>Left/Right</option>
<option    value="circle"    <?php if($row->cdgradtype=="circle") echo 'selected="selected"'?>>Center</option>						
</select>					
</td>

<script type="text/javascript">
        
		cdbg0=document.getElementById("cdbg0").checked;
	if (cdbg0)
	{
document.getElementById('cdbg').parentNode.childNodes[36].setAttribute('style','display:none');

	}
	
	cdbg1=document.getElementById("cdbg1").checked;
	cdbggrad0=document.getElementById("cdbggrad0").checked;
	if (cdbg1 && cdbggrad0)
	{
document.getElementById('cdbg').parentNode.childNodes[36].setAttribute('style','display:none');

	}
        </script>			        
			  
</tr>		

<tr>
<td width="180px">
Background Color:
</td>
<td class="gradinput">
From <input size="5" type="text" name="cdgradcolor1" id="cdgradcolor1" value="<?php echo $row->cdgradcolor1; ?>" class="color">
To <input size="5" type="text" name="cdgradcolor2" id="cdgradcolor2" value="<?php echo $row->cdgradcolor2; ?>" class="color">
</td>
				<script type="text/javascript">
           
		cdbg0=document.getElementById("cdbg0").checked;
	if (cdbg0)
	{
document.getElementById('cdbg').parentNode.childNodes[38].setAttribute('style','display:none');

	}
	
	cdbg1=document.getElementById("cdbg1").checked;
	cdbggrad0=document.getElementById("cdbggrad0").checked;
	if (cdbg1 && cdbggrad0)
	{
document.getElementById('cdbg').parentNode.childNodes[38].setAttribute('style','display:none');

	}
		
	
        </script>			
</tr>

				

<tr>
<td width="220"  class="key">
Text Color:
</td>
<td>
<input type="text" name="cdtxtcolor" id="cdtxtcolor" value="<?php echo $row->cdtxtcolor; ?>" class="color">
</td>
</tr>
				 
<tr>
<td width="220"  class="key">
Font Size:
</td>
<td>
<input size="20"  type="text" name="cdfontsize" id="cdfontsize" value="<?php echo htmlspecialchars($row->cdfontsize); ?>" />
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Margin:
</td>
<td>
<input size="20"  type="text" name="cdmargin" id="cdmargin" value="<?php echo htmlspecialchars($row->cdmargin); ?>" />
</tr>

<tr>
<td width="180px" >
Padding:
</td>
<td width="170px">
<input type="text" name="cdpadding" id="cdpadding" size="20" value="<?php echo htmlspecialchars($row->cdpadding); ?>" />
</td>
</tr>

<tr>
<td width="180px" >
Border Style:
</td>
<td width="170px">
<select name="cdbstyle" id="cdbstyle">					 
<option    value="solid"   <?php if($row->cdbstyle=="solid") echo 'selected="selected"'?>>Solid</option>	 
<option    value="dotted"    <?php if($row->cdbstyle=="dotted") echo 'selected="selected"'?>>Dotted</option>
<option    value="dashed"    <?php if($row->cdbstyle=="dashed") echo 'selected="selected"'?>>Dashed</option>		
<option    value="double"    <?php if($row->cdbstyle=="double") echo 'selected="selected"'?>>Double</option>
<option    value="groove"    <?php if($row->cdbstyle=="groove") echo 'selected="selected"'?>>Groove</option>		
<option    value="ridge"     <?php if($row->cdbstyle=="ridge") echo 'selected="selected"'?>>Ridge</option>
<option    value="inset"    <?php if($row->cdbstyle=="inset") echo 'selected="selected"'?>>Inset</option>	
<option    value="outset"    <?php if($row->cdbstyle=="outset") echo 'selected="selected"'?>>Outset</option>
<option    value="none"    <?php if($row->cdbstyle=="none" || $row->ctbstyle=="") echo 'selected="selected"'?>>None</option>				
</select>
</td>
</tr>
				
				
<tr>
<td width="180px" >
Border Width:
</td>
<td width="170px">
<input size="20"  type="text" name="cdbwidth" id="cdbwidth" value="<?php echo htmlspecialchars($row->cdbwidth); ?>" />
</td>
</tr>
				
<tr>
<td width="180px">
Border Color:
</td>
<td>
<input type="text" name="cdbcolor" id="cdbcolor" value="<?php echo $row->cdbcolor; ?>" class="color">
</td>
</tr>
				
<tr>
<td width="180px" >
Border Corner Radius:
</td>
<td width="170px">
<input size="20"  type="text" name="cdbradius" id="cdbradius" value="<?php echo htmlspecialchars($row->cdbradius); ?>" />
</td>
</tr>	
				
</table>
</fieldset>
</div>

<div class="clear"></div>


<div class="divfieldset">
<fieldset style="width:430px" ><legend>Answer Parameters </legend>     
<table class="admintable">

<tr>
<td width="220"  class="key">
Width:
</td>
<td>
<input size="20"  type="text" name="awidth" id="awidth" value="<?php echo htmlspecialchars($row->awidth); ?>" />
</td>
</tr>		

<tr>
<td width="220"  class="key">
 Padding:
</td>
<td>
<input size="20"  type="text" name="apadd" id="apadd" value="<?php echo htmlspecialchars($row->apadd); ?>" />
</td>
</tr>								
<tr>
<td width="220"  class="key">
Font Size:
</td>
<td>
<input size="20"  type="text" name="afontsize" id="afontsize" value="<?php echo htmlspecialchars($row->afontsize); ?>" />
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Text Color:
</td>
<td>
<input type="text" name="atxtcolor" id="atxtcolor" value="<?php echo $row->atxtcolor; ?>" class="color">
</td>
</tr>


<tr id="abg">
<td>
Background:
</td>
<td width="170px">	
<input type="radio" name="abg"  value="0" onChange="abg_(0)" <?php if($row->abg==0) echo 'checked="checked"' ?> id="abg0"><label for="abg0">Color</label>	 
<input type="radio" name="abg"  value="1" onChange="abg_(1)" <?php if($row->abg==1) echo 'checked="checked"' ?>  id="abg1"><label for="abg1">Image</label>
</td>

<script type="text/javascript">

function abg_(x)
{
	
	if(x==0)
	{
	document.getElementById('abg').parentNode.childNodes[11].setAttribute('style','display:none');
	document.getElementById('abg').parentNode.childNodes[13].setAttribute('style','display:none');
	document.getElementById('abg').parentNode.childNodes[9].removeAttribute('style');
	}
	else
	{
     document.getElementById('abg').parentNode.childNodes[9].setAttribute('style','display:none');
	document.getElementById('abg').parentNode.childNodes[11].removeAttribute('style');
	document.getElementById('abg').parentNode.childNodes[13].removeAttribute('style');
	}
	
	
}
</script> 
				
				
<tr>
<td width="200px">
Background Color:
</td>
<td>
<input type="text" name="abgcolor" id="abgcolor" value="<?php echo $row->abgcolor; ?>" class="color">
</td>
					
					<script type="text/javascript">
        
		abg1=document.getElementById("abg1").checked;
	if (abg1)
	{
document.getElementById('abg').parentNode.childNodes[9].setAttribute('style','display:none');

	}
	
        </script>		
		
</tr>
				


				
<tr>
<td width="220"  class="key">
Background Image:
</td>
<td>           
                  <input type="text" value="<?php if($row->abgimage )echo htmlspecialchars($row->abgimage); ?>" name="abgimage" id="post_image5" class="text_input" style="width:121px; margin-bottom:4px;"/><a class="button lu_upload_button" id="5" href="#" />Select</a><br />
                      <a href="javascript:removeImage5();">Remove Image</a><br />
                    <div style="height:150px;">
              <img style=" display:<?php if($row->abgimage=='') echo 'none'; else echo 'block' ?>; width:160px"   id="imagebox5" src="<?php echo $row->abgimage ?>" />     
                          </div>     
              <script type="text/javascript">    
                  function removeImage5()
                         {
                                 document.getElementById("post_image5").value='';
                                 document.getElementById("imagebox5").style.display="none";
                             
                        }
                                    </script>              
 </td>	
 
 	 <script type="text/javascript">
        
		abg0=document.getElementById("abg0").checked;
	if (abg0)
	{
document.getElementById('abg').parentNode.childNodes[11].setAttribute('style','display:none');

	}
	
        </script>	
 
				</tr>
				
<tr>
<td width="220"  class="key">
Background-size:
</td>
<td>
<input size="20"  type="text" name="abgsize" id="abgsize"  value="<?php echo htmlspecialchars($row->abgsize); ?>" />
</td>
 <script type="text/javascript">
        
		abg0=document.getElementById("abg0").checked;
	if (abg0)
	{
document.getElementById('abg').parentNode.childNodes[13].setAttribute('style','display:none');

	}
	
        </script>	
</tr>	

<tr>
<td width="180px" >
Border Style:
</td>
<td width="170px">
<select name="abstyle" id="abstyle">					 
<option    value="solid"   <?php if($row->abstyle=="solid") echo 'selected="selected"'?>>Solid</option>	 
<option    value="dotted"    <?php if($row->abstyle=="dotted") echo 'selected="selected"'?>>Dotted</option>
<option    value="dashed"    <?php if($row->abstyle=="dashed") echo 'selected="selected"'?>>Dashed</option>		
<option    value="double"    <?php if($row->abstyle=="double") echo 'selected="selected"'?>>Double</option>
<option    value="groove"    <?php if($row->abstyle=="groove") echo 'selected="selected"'?>>Groove</option>		
<option    value="ridge"     <?php if($row->abstyle=="ridge") echo 'selected="selected"'?>>Ridge</option>
<option    value="inset"    <?php if($row->abstyle=="inset") echo 'selected="selected"'?>>Inset</option>	
<option    value="outset"    <?php if($row->abstyle=="outset") echo 'selected="selected"'?>>Outset</option>	
<option    value="none"    <?php if($row->abstyle=="none" || $row->ctbstyle=="") echo 'selected="selected"'?>>None</option>				
</select>
</td>
</tr>
<tr>
<td width="180px" >
Border Right Style:
</td>
<td width="170px">
<select name="abrightstyle" id="abrightstyle">					 
<option    value="solid"   <?php if($row->abrightstyle=="solid") echo 'selected="selected"'?>>Solid</option>	 
<option    value="dotted"    <?php if($row->abrightstyle=="dotted") echo 'selected="selected"'?>>Dotted</option>
<option    value="dashed"    <?php if($row->abrightstyle=="dashed") echo 'selected="selected"'?>>Dashed</option>		
<option    value="double"    <?php if($row->abrightstyle=="double") echo 'selected="selected"'?>>Double</option>
<option    value="groove"    <?php if($row->abrightstyle=="groove") echo 'selected="selected"'?>>Groove</option>		
<option    value="ridge"     <?php if($row->abrightstyle=="ridge") echo 'selected="selected"'?>>Ridge</option>
<option    value="inset"    <?php if($row->abrightstyle=="inset") echo 'selected="selected"'?>>Inset</option>	
<option    value="outset"    <?php if($row->abrightstyle=="outset") echo 'selected="selected"'?>>Outset</option>	
<option    value="none"    <?php if($row->abrightstyle=="none" || $row->ctbstyle=="") echo 'selected="selected"'?>>None</option>				
</select>                
</td>
</tr>				
				
<tr>
<td width="180px" >
Border Width:
</td>
<td width="170px">
<input size="20"  type="text" name="abwidth" id="abwidth" value="<?php echo htmlspecialchars($row->abwidth); ?>" />
</td>
</tr>
				
<tr>
<td width="180px">
Border Color:
</td>
<td>
<input type="text" name="abcolor" id="abcolor" value="<?php echo $row->abcolor; ?>" class="color">
</td>
</tr>
				
<tr>
<td width="180px" >
Border Corner Radius:
</td>
<td width="170px">
<input size="20"  type="text" name="abradius" id="abradius" value="<?php echo htmlspecialchars($row->abradius); ?>" />
</td>
</tr>					
<tr>
<td width="220"  class="key">
Content Padding:
</td>
<td>
<input size="20"  type="text" name="amargin" id="amargin" value="<?php echo htmlspecialchars($row->amargin); ?>" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Content Width:
</td>
<td>
<input size="20"  type="text" name="answidth" id="answidth" value="<?php echo htmlspecialchars($row->answidth); ?>" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Padding (left):
</td>
<td>
<input size="20"  type="text" name="ansmarginleft" id="ansmarginleft" value="<?php echo htmlspecialchars($row->ansmarginleft); ?>" />
</td>
</tr>
<tr>
<td td width="180px">
Icon Color:
</td>
<td width="170px">	
<input type="radio" name="ikncol"  value="0" <?php if($row->ikncol==0) echo 'checked="checked"'?>  id="ikncolb"><label for="ikncol">Black</label>	 
<input type="radio" name="ikncol"  value="1" <?php if($row->ikncol==1) echo 'checked="checked"'?>  id="ikncolw"><label for="ikncol">White</label>
</td>
</tr>	
<tr>
<td width="220"  class="key">
Data Width:
</td>
<td>
<input size="20"  type="text" name="dwidth" id="dwidth" value="<?php echo htmlspecialchars($row->dwidth); ?>" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Data Height:
</td>
<td>
<input size="20"  type="text" name="dheight" id="dheight" value="<?php echo htmlspecialchars($row->dheight); ?>" />
</td>
</tr>				
<tr>
<td width="220"  class="key">
Data Margin (left):
</td>
<td>
<input size="20"  type="text" name="dmarginleft" id="dmarginleft" value="<?php echo htmlspecialchars($row->dmarginleft); ?>" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Data Text Color:
</td>
<td>
<input size="20"  type="text" name="dtextcolor" id="dtextcolor" value="<?php echo htmlspecialchars($row->dtextcolor); ?>" class="color" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Data Background Color:
</td>
<td>
<input size="20"  type="text" name="dbackgroundcolor" id="dbackgroundcolor" value="<?php echo htmlspecialchars($row->dbackgroundcolor); ?>" class="color" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Data Border Style:
</td>
<td width="170px">
<select name="dborderstyle" id="dborderstyle">					 
<option    value="solid"   <?php if($row->dborderstyle=="solid") echo 'selected="selected"'?>>Solid</option>	 
<option    value="dotted"    <?php if($row->dborderstyle=="dotted") echo 'selected="selected"'?>>Dotted</option>
<option    value="dashed"    <?php if($row->dborderstyle=="dashed") echo 'selected="selected"'?>>Dashed</option>		
<option    value="double"    <?php if($row->dborderstyle=="double") echo 'selected="selected"'?>>Double</option>
<option    value="groove"    <?php if($row->dborderstyle=="groove") echo 'selected="selected"'?>>Groove</option>		
<option    value="ridge"     <?php if($row->dborderstyle=="ridge") echo 'selected="selected"'?>>Ridge</option>
<option    value="inset"    <?php if($row->dborderstyle=="inset") echo 'selected="selected"'?>>Inset</option>	
<option    value="outset"    <?php if($row->dborderstyle=="outset") echo 'selected="selected"'?>>Outset</option>	
<option    value="none"    <?php if($row->dborderstyle=="none" || $row->dborderstyle=="") echo 'selected="selected"'?>>None</option>				
</select>
</td>
</tr>
<tr>
<td width="220"  class="key">
Data Border Width:
</td>
<td>
<input size="20"  type="text" name="dborderwidth" id="dborderwidth" value="<?php echo htmlspecialchars($row->dborderwidth); ?>" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Data Border Color:
</td>
<td>
<input size="20"  type="text" name="dbordercolor" id="dbordercolor" value="<?php echo htmlspecialchars($row->dbordercolor); ?>" class="color"  />
</td>
</tr>
<tr>
<td width="220"  class="key">
Data Border Corner Radius:
</td>
<td>
<input size="20"  type="text" name="dbordercornerradius" id="dbordercornerradius" value="<?php echo htmlspecialchars($row->dbordercornerradius); ?>" />
</td>
</tr>					
<tr>
<td width="220"  class="key">
Data Border Top Style:
</td>
<td width="170px">
<select name="dbordertopstyle" id="dbordertopstyle">					 
<option    value="solid"   <?php if($row->dbordertopstyle=="solid") echo 'selected="selected"'?>>Solid</option>	 
<option    value="dotted"    <?php if($row->dbordertopstyle=="dotted") echo 'selected="selected"'?>>Dotted</option>
<option    value="dashed"    <?php if($row->dbordertopstyle=="dashed") echo 'selected="selected"'?>>Dashed</option>		
<option    value="double"    <?php if($row->dbordertopstyle=="double") echo 'selected="selected"'?>>Double</option>
<option    value="groove"    <?php if($row->dbordertopstyle=="groove") echo 'selected="selected"'?>>Groove</option>		
<option    value="ridge"     <?php if($row->dbordertopstyle=="ridge") echo 'selected="selected"'?>>Ridge</option>
<option    value="inset"    <?php if($row->dbordertopstyle=="inset") echo 'selected="selected"'?>>Inset</option>	
<option    value="outset"    <?php if($row->dbordertopstyle=="outset") echo 'selected="selected"'?>>Outset</option>	
<option    value="none"    <?php if($row->dbordertopstyle=="none" || $row->dbordertopstyle=="") echo 'selected="selected"'?>>None</option>				
</select>
</td>
</tr>
<tr>
<td width="220"  class="key">
Data Border Bottom Style:
</td>
<td width="170px">
<select name="dborderbottomstyle" id="dborderbottomstyle">					 
<option    value="solid"   <?php if($row->dborderbottomstyle=="solid") echo 'selected="selected"'?>>Solid</option>	 
<option    value="dotted"    <?php if($row->dborderbottomstyle=="dotted") echo 'selected="selected"'?>>Dotted</option>
<option    value="dashed"    <?php if($row->dborderbottomstyle=="dashed") echo 'selected="selected"'?>>Dashed</option>		
<option    value="double"    <?php if($row->dborderbottomstyle=="double") echo 'selected="selected"'?>>Double</option>
<option    value="groove"    <?php if($row->dborderbottomstyle=="groove") echo 'selected="selected"'?>>Groove</option>		
<option    value="ridge"     <?php if($row->dborderbottomstyle=="ridge") echo 'selected="selected"'?>>Ridge</option>
<option    value="inset"    <?php if($row->dborderbottomstyle=="inset") echo 'selected="selected"'?>>Inset</option>	
<option    value="outset"    <?php if($row->dborderbottomstyle=="outset") echo 'selected="selected"'?>>Outset</option>	
<option    value="none"    <?php if($row->dborderbottomstyle=="none" || $row->dborderbottomstyle=="") echo 'selected="selected"'?>>None</option>				
</select>
</td>
</tr>								
<tr>
<tr>
<td width="220"  class="key">
Like Hits Data Width:
</td>
<td>
<input size="20"  type="text" name="dlikehitswidth" id="dlikehitswidth" value="<?php echo htmlspecialchars($row->dlikehitswidth); ?>" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Like Hits Data Margin (left):
</td>
<td>
<input size="20"  type="text" name="dlikehitsmargin" id="dlikehitsmargin" value="<?php echo htmlspecialchars($row->dlikehitsmargin); ?>" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Like Hits Data Background Color:
</td>
<td>
<input size="20"  type="text" name="dlikehitsbgcolor" id="dlikehitsbgcolor" value="<?php echo htmlspecialchars($row->dlikehitsbgcolor); ?>" class="color" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Like Hits Data Border Style:
</td>
<td width="170px">
<select name="dlikehitsbdrst" id="dlikehitsbdrst">					 
<option    value="solid"   <?php if($row->dlikehitsbdrst=="solid") echo 'selected="selected"'?>>Solid</option>	 
<option    value="dotted"    <?php if($row->dlikehitsbdrst=="dotted") echo 'selected="selected"'?>>Dotted</option>
<option    value="dashed"    <?php if($row->dlikehitsbdrst=="dashed") echo 'selected="selected"'?>>Dashed</option>		
<option    value="double"    <?php if($row->dlikehitsbdrst=="double") echo 'selected="selected"'?>>Double</option>
<option    value="groove"    <?php if($row->dlikehitsbdrst=="groove") echo 'selected="selected"'?>>Groove</option>		
<option    value="ridge"     <?php if($row->dlikehitsbdrst=="ridge") echo 'selected="selected"'?>>Ridge</option>
<option    value="inset"    <?php if($row->dlikehitsbdrst=="inset") echo 'selected="selected"'?>>Inset</option>	
<option    value="outset"    <?php if($row->dlikehitsbdrst=="outset") echo 'selected="selected"'?>>Outset</option>	
<option    value="none"    <?php if($row->dlikehitsbdrst=="none" || $row->dlikehitsbdrst=="") echo 'selected="selected"'?>>None</option>				
</select>
</td>
</tr>
<tr>
<td width="220"  class="key">
Like Hits Data Border Width:
</td>
<td>
<input size="20"  type="text" name="dlikehitsbdrw" id="dlikehitsbdrw" value="<?php echo htmlspecialchars($row->dlikehitsbdrw); ?>" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Like Hits Data Border Color:
</td>
<td>
<input size="20"  type="text" name="dlikehitsbdrc" id="dlikehitsbdrc" value="<?php echo htmlspecialchars($row->dlikehitsbdrc); ?>" class="color" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Like Hits Data Border Top Style:
</td>
<td width="170px">
<select name="dlikehitsbdrtst" id="dlikehitsbdrtst">					 
<option    value="solid"   <?php if($row->dlikehitsbdrtst=="solid") echo 'selected="selected"'?>>Solid</option>	 
<option    value="dotted"    <?php if($row->dlikehitsbdrtst=="dotted") echo 'selected="selected"'?>>Dotted</option>
<option    value="dashed"    <?php if($row->dlikehitsbdrtst=="dashed") echo 'selected="selected"'?>>Dashed</option>		
<option    value="double"    <?php if($row->dlikehitsbdrtst=="double") echo 'selected="selected"'?>>Double</option>
<option    value="groove"    <?php if($row->dlikehitsbdrtst=="groove") echo 'selected="selected"'?>>Groove</option>		
<option    value="ridge"     <?php if($row->dlikehitsbdrtst=="ridge") echo 'selected="selected"'?>>Ridge</option>
<option    value="inset"    <?php if($row->dlikehitsbdrtst=="inset") echo 'selected="selected"'?>>Inset</option>	
<option    value="outset"    <?php if($row->dlikehitsbdrtst=="outset") echo 'selected="selected"'?>>Outset</option>	
<option    value="none"    <?php if($row->dlikehitsbdrtst=="none" || $row->dlikehitsbdrtst=="") echo 'selected="selected"'?>>None</option>				
</select>
</td>
</tr>
<tr>
<td width="220"  class="key">
Like Hits Data Border Bottom Style:
</td>
<td width="170px">
<select name="dlikehitsbdrbst" id="dlikehitsbdrbst">					 
<option    value="solid"   <?php if($row->dlikehitsbdrbst=="solid") echo 'selected="selected"'?>>Solid</option>	 
<option    value="dotted"    <?php if($row->dlikehitsbdrbst=="dotted") echo 'selected="selected"'?>>Dotted</option>
<option    value="dashed"    <?php if($row->dlikehitsbdrbst=="dashed") echo 'selected="selected"'?>>Dashed</option>		
<option    value="double"    <?php if($row->dlikehitsbdrbst=="double") echo 'selected="selected"'?>>Double</option>
<option    value="groove"    <?php if($row->dlikehitsbdrbst=="groove") echo 'selected="selected"'?>>Groove</option>		
<option    value="ridge"     <?php if($row->dlikehitsbdrbst=="ridge") echo 'selected="selected"'?>>Ridge</option>
<option    value="inset"    <?php if($row->dlikehitsbdrbst=="inset") echo 'selected="selected"'?>>Inset</option>	
<option    value="outset"    <?php if($row->dlikehitsbdrbst=="outset") echo 'selected="selected"'?>>Outset</option>	
<option    value="none"    <?php if($row->dlikehitsbdrbst=="none" || $row->dlikehitsbdrbst=="") echo 'selected="selected"'?>>None</option>				
</select>
</td>
</tr>
<tr>
<td width="220"  class="key">
Like Hits Data Border Corner Radius:
</td>
<td>
<input size="20"  type="text" name="dlikehitsbdrrad" id="dlikehitsbdrrad" value="<?php echo htmlspecialchars($row->dlikehitsbdrrad); ?>" />
</td>
</tr>
<tr>
<td width="220"  class="key">
Like Hits Data Text Color:
</td>
<td>
<input size="20"  type="text" name="dlikehitstxtcl" id="dlikehitstxtcl" value="<?php echo htmlspecialchars($row->dlikehitstxtcl); ?>" class="color" />
</td>
</tr>
<td width="220"  class="key">
Image (before text):
</td>
<td>           
                  <input type="text" value="<?php if($row->aimage )echo htmlspecialchars($row->aimage); ?>" name="aimage" id="post_image6" class="text_input" style="width:121px; margin-bottom:4px;"/><a class="button lu_upload_button" id="6" href="#" />Select</a><br />
                      <a href="javascript:removeImage6();">Remove Image</a><br />
                    <div style="height:50px;">
              <img style=" display:<?php if($row->aimage=='') echo 'none'; else echo 'block' ?>; width:160px" id="imagebox6" src="<?php echo $row->aimage ?>" />     
                          </div>     
              <script type="text/javascript">    
                  function removeImage6()
                         {
                                 document.getElementById("post_image6").value='';
                                 document.getElementById("imagebox6").style.display="none";
                             
                        }
                                    </script>              
 </td>	
</tr>
				
<tr>
<td width="220"  class="key">
Image Width:
</td>
<td>
<input size="20"  type="text" name="aimagewidth" id="aimagewidth" value="<?php echo htmlspecialchars($row->aimagewidth); ?>" />
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Image Height:
</td>
<td>
<input size="20"  type="text" name="aimageheight" id="aimageheight" value="<?php echo htmlspecialchars($row->aimageheight); ?>" />
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Image Margin:
</td>
<td>
<input size="20"  type="text" name="amarginimage" id="amarginimage" value="<?php echo htmlspecialchars($row->amarginimage); ?>" />
</td>
</tr>
				
				
<tr>
<td width="220"  class="key">
Image (after text):
</td>
<td>           
                  <input type="text" value="<?php if($row->aimage2 )echo htmlspecialchars($row->aimage2); ?>" name="aimage2" id="post_image7" class="text_input" style="width:121px; margin-bottom:4px;"/><a class="button lu_upload_button" id="7" href="#" />Select</a><br />
                      <a href="javascript:removeImage7();">Remove Image</a><br />
                    <div style="height:50px;">
              <img style=" display:<?php if($row->aimage2=='') echo 'none'; else echo 'block' ?>; width:160px" id="imagebox7" src="<?php echo $row->aimage2 ?>" />     
                          </div>     
              <script type="text/javascript">    
                  function removeImage7()
                         {
                                 document.getElementById("post_image7").value='';
                                 document.getElementById("imagebox7").style.display="none";
                             
                        }
                                    </script>              
 </td>
				</tr>
				
<tr>
<td width="220"  class="key">
Image Width:
</td>
<td>
<input size="20"  type="text" name="aimagewidth2" id="aimagewidth2" value="<?php echo htmlspecialchars($row->aimagewidth2); ?>" />
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Image Height:
</td>
 <td>
<input size="20"  type="text" name="aimageheight2" id="aimageheight2" value="<?php echo htmlspecialchars($row->aimageheight2); ?>" />
</td>
</tr>
				
<tr>
<td width="220"  class="key">
Image Margin:
</td>
<td>
 <input size="20"  type="text" name="amarginimage2" id="amarginimage2" value="<?php echo htmlspecialchars($row->amarginimage2); ?>" />
  </td>
  </tr>
				
</table>
</fieldset>
</div>
</fieldset>
</div>
</div>

<input type="hidden" name="id" value="<?php echo $row->id;?>" />
<input type="hidden" name="task" value="" />
</form>
<?php
 }	
?>