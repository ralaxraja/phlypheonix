<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	
	<title><?php echo $title_for_layout; ?></title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('reset.css');
		echo $this->Html->css('default.css');
		echo $this->Html->css('dynamic.css');
		
		if(file_exists(WWW_ROOT . 'css' . DS . $this->params['controller'] . '.css')){
			echo $this->Html->css($this->params['controller'] . '.css');
		}
		
		if(isset($cssFiles)){
			foreach($cssFiles as $file){
				echo "\t<link rel=\"stylesheet\" type=\"text/css\" href=\"$file\" />\n";
			}
		}
		
		if(isset($jsFilesTop)){
			foreach($jsFilesTop as $file){
				echo "\t<script type\"text/javascript\" language=\"javascript\" src=\"$file\"></script>";
			}
		}

		echo $scripts_for_layout;
		
	?>
	
	<!-- Google //-->
	<script src="https://www.google.com/jsapi?key=ABQIAAAAJlXI2Bwm7HpvuBgtX-0aFRS_grDaFF6eWWjqmO0l-XDntG-CnxSdbe1KeTrfkdPgIp2MP99cn4oF_Q" type="text/javascript"></script>
	
	<!-- JQuery //-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
	
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-16246818-4']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	
</head>

<body>

<div id="wrapper" > 
  <div id="mainHeader">
  	<?php echo $this->element('layouts/header',array('myuser'=>$myuser)); ?>
  </div>

	<?php echo $content_for_layout; ?>	
	
</div>

<?php
	//if($loggedin){ 
		echo $this->element('slist_with_favs',array('schools'=>$schools,'userSchools'=>$myuser['School'],'sex'=>$myuser['User']['sex'],'link'=>'/shop/main/'));
	//}
?>



<div id="background-wrapper">
	<?php 
	if(isset($bgImg)){ 
		echo "<img id=\"background\" src=\"$bgImg\" alt=\"ohiostatebackground\" />";
	} else {
	?>
	<img id="background" src="/img/schools/background/default.jpg" alt="ohiostatebackground" />
	<?php 
	}
	?>
</div>

<div id="viewer-blackout">&nbsp;</div>
<div id="viewer-pop">
	<div id="loader-overlay" class="big title">Loading...<br/><img src="/img/ajax/loading.gif"/></div>
	<iframe id="product-frame" width="100%" height="100%" 
		src=""
			frameborder="0" marginheight="0" marginwidth="0" style="">
		Browser does not support this.  Please upgrade your browser.
	</iframe>
</div>

<div id="return-policy" style="display:none;overflow:auto;height:500px;">
	<?php echo $this->element('returnshort'); ?>
</div>

<div id="fb-root"></div>
<div id="black-out"></div>


</body>

<?php
//controller set scripts
if(isset($jsFilesBottom)){
	foreach($jsFilesBottom as $file){
		echo "<script type=\"text/javascript\" language=\"javascript\" src=\"$file\"></script>\n";
	}
}
?>

<script type="text/javascript" src="/js/jquery.qtip-1.0.0-rc3.js"></script>
<script type="text/javascript" src="/js/viewer-popup.js"></script>


<script type="text/javascript">

//search for schools
<?php echo $this->element('prompts/search_school',array('DOMtarget'=>'#search')); ?>

//show cart
<?php echo $this->element('prompts/cart'); ?>

//heart toggle...add school to favorites
<?php if($loggedin) echo $this->element('js/heart_toggle',array('school_id'=>$school['School']['id'])); ?>

//prompts
<?php echo $this->element('layouts/prompts',array('cprompts'=>$cprompts,'cpdata'=>$cpdata)); ?>

//page specific scripts
<?php 
	if(file_exists(ELEMENTS . 'js' . DS . $this->params['controller'] . '.ctp')) 
		echo $this->element('js/'.$this->params['controller'],compact('scriptData','protocal','loggedin')); 
?>

//page specific prompts
<?php 
if(isset($pageElements)){
	foreach($pageElements as $el){
		echo $this->element($el['element'],array('data'=>$el['data']));
	}
}
?>

/* STUFF FROM ORIGIONAL SHOP LAYOUT */

//first time user prompt
<?php if($showFirstTime) echo $this->element('prompts/first_time_user'); ?>

<!-- FACEBOOK //-->
$.getScript("<?php echo $protocal; ?>://connect.facebook.net/en_US/all.js",function(){
	<?php 
	
	echo $this->Hfacebook->initLogin(
			$FACEBOOK_APP_ID,
			$FACEBOOK_APP_SESSION,
			false,
			array('auth.login'=>'fbloggedin')
	); 
	
	?>
    
	
	$('#fb-reg').click(function(){
		window.formClick=true;
		<?php echo $this->Hfacebook->loginJs('fbloggedin',null,'email,user_birthday,user_education_history'); ?>
	})

	//logged in function
	function fbloggedin(){
		window.addCoupon(function(){window.location.href = '<?php echo $protocal; ?>://flyfoenix.com/users/landing';});
	}

	//logout function
	var fblogout = function(){
		FB.logout(function(response) {
			document.location.href = '/users/logout';	
		});
	}
	
});


//prompt for flash message
<?php echo $this->element('prompts/flash'); ?>
<?php if(strlen($flash) > 0) echo '$(document).ready(function(){$("body").trigger("showFlash");});'; ?>

<?php if($showFirstTime){
//scripts for flash prompt
?>
$(document).ready(function(){
	//dont allow flash close
	$('body').qtip('api').elements.title.hide();
	
	
	//bind the move function
	$('#reg-cont').click(function(){
		$('#reg-inner-wrapper').animate({'left':'-410px'});

		var sex = $('#reg-wrapper input:radio:checked').val();
		var school = $('#reg-wrapper select').val();
		$('#reg-school').val(school);
		$('#reg-sex').val(sex);

	});

	$('#save-pref').click(function(){
		window.addCoupon(function(){$('#register-pop').submit();});
	});

	//show the qtip
	$('body').trigger('showFlash');
});

function addCoupon(callback){
	var wait = 2000;
	$.getJSON('/cart/addNewUserCoupon',function(data){
		if(data.result){
			var $cart = $('#cart');
			$cart.qtip('api').updateContent('Added Coupon to cart...',false);
			$cart.trigger('showCart');
			
			setTimeout(function(){$cart.qtip('hide');},wait); //hide the qtip after 1 second
		}
		setTimeout(callback,wait+1000);
	});
	
}

function recordEvent(event){
	$.get('/shop/recordEvent/'+escape(event));
}

<?php
}
?>

//easy return link
$('.return-link').click(function(){
	$('body').qtip('api').elements.title.show();
	
	$('body').qtip('api').updateContent($('#return-policy').html(),true);
	$('body').qtip('api').updateWidth(650);
	
	$('body').qtip('show');
	return false;
	
});

//share this
var switchTo5x=true;
$(document).ready(function(){
	$.getScript('<?php echo $protocal; ?>://w<?php if($protocal == 'https') echo 's'; ?>.sharethis.com/button/buttons.js',function(){
		stLight.options({publisher:'4db8f048-2ddb-45c3-87c8-40b6077626c7'});
	});
});
</script>
</html>