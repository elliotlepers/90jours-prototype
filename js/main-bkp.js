jQuery(".via_facebook").on("click", function(){
	hello('facebook').login({scope: 'email'});
});

jQuery(".via_email").on("click", function(){
	jQuery(".connect").slideUp();
	jQuery("#send_via_mail").slideDown();

	hello('facebook').logout();
	document.getElementById('profile').innerHTML = "";
});

jQuery(".cta").on("click", function(){
	jQuery(".connect").slideDown();
	jQuery("#send_via_mail").slideUp();
	hello('facebook').logout();
	document.getElementById('profile').innerHTML = "";
});


function init_logout(){
	jQuery(".logout").on("click", function(){
		hello('facebook').logout();
		document.getElementById('profile').innerHTML = "";
	});
}

jQuery("#send_via_mail").submit(function(){

	first_name = this.first_name.value;
	last_name = this.last_name.value;
	email = this.email.value;
	g_recaptcha_response = jQuery("#g-recaptcha-response").val();


	var label = document.getElementById('profile');

	jQuery.ajax({
	  type: "post",
	  url: "../insert.php",
	  data: {
	    'first_name': first_name,
	    'last_name' : last_name,
	    'email': email,
	    'g_recaptcha_response': g_recaptcha_response
	  },
	  success: function(data){
	  	console.log(data);
	    if(data==="0"){
	      	label.innerHTML = "Une erreur s'est produite. Merci de réessayer.";
	    } else if(data==='1') {
	    	label.innerHTML = 'Bienvenue, ' + first_name + " " + last_name + ' !';
	    	jQuery("#send_via_mail").find("input").val("");
			jQuery("#send_via_mail").slideUp();
	    } else if(data==='2') {
			label.innerHTML = 'Vous avez déjà signé, ' + first_name + " " + last_name + ' !';
			jQuery("#send_via_mail").find("input").val("");
			jQuery("#send_via_mail").slideUp();
	    } else if(data==='3') {
			label.innerHTML = 'Veuillez confirmer le filtre anti-spam.';	    	
	    }
	  }
	});

	return false;
});

hello.on('auth.login', function(auth) {

	// Call user information, for the given network
	hello(auth.network).api('/me').then(function(r) {
		// Inject it into the container
		var label = document.getElementById('profile');

		jQuery.ajax({
		  type: "post",
		  url: "../insert.php",
		  data: {
		    'first_name': r.first_name,
		    'last_name' : r.last_name,
		    'email': r.email,
		    'avatar': r.picture
		  },
		  success: function(data){
		  	console.log(data);
		    if(data==="0"){
		      	label.innerHTML = "Une erreur s'est produite. Merci de réessayer.";
		    } else if(data==='1') {
		    	label.innerHTML = '<img src="' + r.picture + '" /> Bienvenue, ' + r.name + ' !<br/><span class="logout">Inscrire quelqu\'un d\'autre</span>';
		    	jQuery(".logout").on("click", function(){
		    		init_logout()
		    	});
		    } else if(data==='2') {
				label.innerHTML = '<img src="' + r.picture + '" /> Vous avez déjà signé, ' + r.name + ' !<br/><span class="logout">Inscrire quelqu\'un d\'autre</span>';
				init_logout()
		    } 
		  }
		});
	});
});

hello.init({
	facebook: '241175529606535',
	twitter: 'Aw0ntgqVjNW0tuuhXWUIT8Jmn'
}, {redirect_uri: 'redirect.html', oauth_version: '1.0a'});
