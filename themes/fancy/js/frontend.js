
(function($){$._getCookie=function(nombre){var dcookie=document.cookie;var cname=nombre+"=";var longitud=dcookie.length;var inicio=0;while(inicio<longitud)
{var vbegin=inicio+cname.length;if(dcookie.substring(inicio,vbegin)==cname)
{var vend=dcookie.indexOf(";",vbegin);if(vend==-1)
vend=longitud;return unescape(dcookie.substring(vbegin,vend));}
inicio=dcookie.indexOf(" ",inicio)+1;if(inicio==0)
break;}
return null;};$._setCookie=function(name,value){document.cookie=name+"="+value+"; expires="+(60*24)+"; path=/";};})(jQuery);jQuery(document).ready(function($){$(".abh_tabs li").click(function(){$(".abh_tabs li").removeClass('abh_active');$(this).addClass("abh_active");$(".abh_tab").hide();var selected_tab=$(this).find("a").attr("href");$(selected_tab.replace('#','.')+'_tab').fadeIn();$._setCookie('abh_tab',selected_tab);return false;});if($._getCookie('abh_tab')!=null){$(".abh_tab").hide();$(".abh_tabs li").removeClass('abh_active');var selected_tab=$._getCookie('abh_tab');$(selected_tab.replace('#','.')+'_tab').fadeIn();$(selected_tab).parents('.abh_box').find(selected_tab.replace('#','.')).addClass("abh_active");}});