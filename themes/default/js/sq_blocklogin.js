
jQuery('#sq_login').live('click',function(){jQuery('#sq_login').addClass('sq_minloading');jQuery('#sq_login').attr("disabled","disabled");jQuery('#sq_login').val('');jQuery.getJSON(sqQuery.ajaxurl,{action:'sq_login',user:jQuery('#sq_user').val(),password:jQuery('#sq_password').val(),nonce:sqQuery.nonce}).success(function(responce){jQuery('#sq_login').removeAttr("disabled");jQuery('#sq_login').val('Login');jQuery('#sq_login').removeClass('sq_minloading');if(typeof responce.token!='undefined'){__token=responce.token;jQuery('#sq_blocklogin').remove();window.sq_main.load();}else
if(typeof responce.error!='undefined')
jQuery('#sq_blocklogin').find('.sq_error').html(responce.error);}).error(function(){jQuery('#sq_login').removeAttr("disabled");jQuery('#sq_login').val('Login');jQuery('#sq_login').removeClass('sq_minloading');jQuery('#sq_blocklogin').find('.sq_error').html(__error_login);});});function autoLogin(){if(!checkEmail(jQuery('#sq_email').val())){jQuery('#sq_blocklogin').find('.sq_error').html(__invalid_email);jQuery('#sq_register_email').show();jQuery('#sq_register').html(__try_again);return false;}
jQuery('#sq_register').html(__connecting);jQuery('#sq_register_wait').addClass('sq_minloading');jQuery('#sq_blocklogin').find('.sq_message').hide();jQuery.getJSON(sqQuery.ajaxurl,{action:'sq_register',email:jQuery('#sq_email').val(),nonce:sqQuery.nonce}).success(function(responce){jQuery('#sq_register_wait').removeClass('sq_minloading');if(typeof responce.token!='undefined'){__token=responce.token;jQuery('#sq_blocklogin').remove();window.sq_main.load();}else{if(typeof responce.info!='undefined'){jQuery('#sq_autologin').hide();jQuery('#sq_blocklogin').find('ul').show();jQuery('#sq_blocklogin').find('.sq_message').html(responce.info).show();}else{if(typeof responce.error!='undefined'){jQuery('#sq_blocklogin').find('.sq_error').html(responce.error);jQuery('#sq_register_email').show();jQuery('#sq_register').html(__try_again);}}}}).error(function(){jQuery('#sq_register_wait').removeClass('sq_minloading');jQuery('#sq_blocklogin').find('.sq_error').html(__error_login);jQuery('#sq_register_email').show();jQuery('#sq_register').html(__try_again);});}
function checkEmail(email)
{var emailRegEx=/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;if(email!='')
if(emailRegEx.test(email)){return true;}else{return false;}
return true;}
jQuery('#sq_user').live('keypress',function(event){if(event.keyCode==13)
jQuery('#sq_login').trigger('click');return event.keyCode!=13;});jQuery('#sq_password').live('keypress',function(event){if(event.keyCode==13)
jQuery('#sq_login').trigger('click');return event.keyCode!=13;});