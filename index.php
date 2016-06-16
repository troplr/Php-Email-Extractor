<!DOCTYPE html>
<html>
<head>
<title>Free Email Extractor From Texts Online</title>
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
	}
	textarea{
		width: 100%
	}
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
::-webkit-input-placeholder {
   color: #676565;
   font-size: 40px
}

:-moz-placeholder { /* Firefox 18- */
   color: #676565;  
   font-size: 40px
}

::-moz-placeholder {  /* Firefox 19+ */
   color: #676565;  
   font-size: 40px
}

:-ms-input-placeholder {  
   color: #676565; 
   font-size: 40px 
}
</style>

	
</head>
<body>
<div style="max-width: 800px;height: 300px;margin:20px auto">
<h1 style="font-size: 21px;">Copy and paste texts from any sources and extract email addresses here.</h1>
<form method="post" action="extract.php">  
<textarea name="search" rows="20" placeholder="Add Text Here..." autofocus></textarea></p>
<!-- <input type="text" name="removestrings" placeholder="Add texts separated by comma to remove extra texts. E.g www.,http://,Email-"></input> -->
<textarea name="removestrings" rows="10" placeholder="Add texts separated by comma to remove extra texts. E.g www.,Email-"></textarea>

<button class="btn" type="submit" name="submit" >Extract</button>  
</form>
</div>

</body>
</html>












