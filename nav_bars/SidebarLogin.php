<script>

  var clicked = false; 

  // Load the SDK Asynchronously
   (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '<?php echo $facebook->getAppID() ?>',
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional initialization code here
	FB.Event.subscribe('auth.authResponseChange', function(response) {		
		
		// Create a list of users in our website
		if(response.authResponse != null) {			
			FB.api('/me', function(me){
              if (me.name) {
                document.write("<p>" + me.name + "</p>");
			  }
            }) 	
		}
		if (clicked) {
			window.location = "http://www.whizium.com/default.php"
		}
    });
  };

</script>



<?php if ($user_profile) { ?>
	<div class ='SideBarHeader' id='logoutheader'><h3>Logout</h3></div>
	<div align= "center"><a href="#" id="auth-logoutlink"><img src="graphics/FBLogoutImage.jpg" alt="Facebook Logout" name="FB_Logout" width="70" height="22" id="FB_Logout"/></a></div><?php } else { ?>
 	<div class ='SideBarHeader'><h3>Login</h3></div>
	<p>If you have previously registered. Please login below:</p>
	<div align= "center"><a href="#" id="auth-loginlink"><img src="graphics/FBLoginImage.jpg" alt="Facebook Logout" name="FB_Logout" width="154" height="22" id= "FB_Logout"/></a></div><?php } ?>


    
<script>
// listen for and handle auth.statusChange events
if (document.getElementById('auth-logoutlink') != null) {
	document.getElementById('auth-logoutlink').addEventListener('click', function(){
	  clicked = true;
	  FB.logout();
	});		
}
if (document.getElementById('auth-loginlink') != null) {
	document.getElementById('auth-loginlink').addEventListener('click', function(){
	  clicked = true;
	  FB.login(function(response) {
   		// handle the response
 		},{scope: 'email'});
	});
}
</script>

