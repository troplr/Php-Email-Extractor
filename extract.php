<!DOCTYPE html>
<html>
<head>
<title>Extract Emails From Text Online</title>
<script>

var fieldtoclipboard = {
	tooltipobj: null,
	hidetooltiptimer: null,

	createtooltip:function(){
		var tooltip = document.createElement('div')
		tooltip.style.cssText = 
			'position:absolute; background:black; color:white; padding:4px;z-index:10000;'
			+ 'border-radius:3px; font-size:12px;box-shadow:3px 3px 3px rgba(0,0,0,.4);'
			+ 'opacity:0;transition:opacity 0.3s'
		tooltip.innerHTML = 'Copied!'
		this.tooltipobj = tooltip
		document.body.appendChild(tooltip)
	},

	showtooltip:function(e){
		var evt = e || event
		clearTimeout(this.hidetooltiptimer)
		this.tooltipobj.style.left = evt.pageX - 10 + 'px'
		this.tooltipobj.style.top = evt.pageY + 15 + 'px'
		this.tooltipobj.style.opacity = 1
		this.hidetooltiptimer = setTimeout(function(){
			fieldtoclipboard.tooltipobj.style.opacity = 0
		}, 700) // time in milliseconds before tooltip disappears
	},

	selectelement:function(el){
    var range = document.createRange() // create new range object
    range.selectNodeContents(el)
    var selection = window.getSelection() // get Selection object from currently user selected text
    selection.removeAllRanges() // unselect any user selected text (if any)
    selection.addRange(range) // add range to Selection object to select it
	},
	
	copyfield:function(e, fieldref, callback){
		var field = (typeof fieldref == 'string')? document.getElementById(fieldref) : fieldref
		callbackref = callback || function(){}
		if (/(textarea)|(input)/i.test(field) && field.setSelectionRange){
			field.focus()
			field.setSelectionRange(0, field.value.length) // for iOS sake
		}
		else if (field && document.createRange){
			this.selectelement(field)
		}
		else if (field == null){ // copy currently selected text on document
			field = {value:null}
		}
		var copysuccess // var to check whether execCommand successfully executed
		try{
			copysuccess = document.execCommand("copy")
		}catch(e){
			copysuccess = false
		}
		if (copysuccess){ // execute desired code whenever text has been successfully copied
			if (e){
				this.showtooltip(e)
			}
			callbackref(field.value || window.getSelection().toString())
		}
		return false
	},


	init:function(){
		this.createtooltip()
	}
}

fieldtoclipboard.init()


</script>
<style type="text/css">
	body{
		width: 100%;
		margin:0;
		.btn {
  background: #3498db;
  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
  background-image: -o-linear-gradient(top, #3498db, #2980b9);
  background-image: linear-gradient(to bottom, #3498db, #2980b9);
  -webkit-border-radius: 28;
  -moz-border-radius: 28;
  border-radius: 28px;
  font-family: Arial;
  color: #ffffff;
  font-size: 20px;
  padding: 10px 20px 10px 20px;
  text-decoration: none;
}

.btn:hover {
  background: #3cb0fd;
  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
  text-decoration: none;
}
</style>

	
</head>
<body>


<?php
$filtered = $_POST["removestrings"];
/*$filtered_words = array(
    'www.',
    'emails-',
);*/



function extract_emails_from($string){
  preg_match_all("/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i", $string, $matches);
  return $matches[0];
}
$text = $_POST["search"];


/*
$trimms = implode(" ",array_unique(explode(" ", $text)));
echo $trimms;
*/
$emails = extract_emails_from($text);


$filter = explode(",", $filtered);

foreach ($filter as $key => $value) {
	
}


$emails = str_replace($filter, '', $emails);

//preg_replace( "/\r|\n/", "", $emails );

$trimmed = (implode("<br/>",$emails));


//$new = (implode("<br/>", $trimmed));

//$new = implode("<br/>",array_unique(explode("<br/>", $trimmed)));

$new = array_unique(explode("<br/>", $trimmed));

$newemail = implode("<br/>",$new);

?>
<div style="max-width: 800px;    margin: 50px auto;">
<div style="font-size: 20px;font-weight: bold"><?php echo count($emails);?> Emails Extracted</div>
<div style="font-size: 20px;font-weight: bold"><?php echo count($new);?> Unique Emails Found</div>
<?php $dupes = count($emails)-count($new);
?>
<div style="font-size: 20px;font-weight: bold"><?php echo $dupes;?> Duplicate Emails Removed</div>

<div id="select4" style="width: 800px;height: 400px;background-color: #ccc;overflow: scroll;"><?php echo $newemail;?></div>
<div style="float:left;width:210px"><BUTTON class="btn"  onClick="return fieldtoclipboard.copyfield(event, 'select4');">Copy to Clipboard</BUTTON></div>

<div style="float: right;width: 210px"><BUTTON class="btn" onclick="location.href='http://qnahi.com';">Try Again</BUTTON></div>
</div>

<!-- <TEXTAREA id="copyTarget"><?php echo $new;?></TEXTAREA><button id="copyButton">Copy</button> -->
<!-- <input type="text" id="copyTarget" value="<?php echo (implode ( "<br/>",$emails));?>"> <button id="copyButton">Copy</button>
 -->

</body>
</html>












