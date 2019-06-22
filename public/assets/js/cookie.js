/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */
 
jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};

if($.cookie("nexus-color")) {
    $("link.color-switcher").attr("href",$.cookie("nexus-color"));
}

$(document).ready(function() { 

    $(".theme-options .theme-color").click(function() { 
        $("link.color-switcher").attr("href",$(this).attr('href'));
        $.cookie("nexus-color",$(this).attr('href'), {expires: 365, path: '/'});
        return false;
    });

    var identifier = window.location.hash;

    if (identifier === "#app-green") {
        $("link.color-switcher").attr("href","assets/styles/css/app-green.css");
        $.cookie("nexus-color","assets/styles/css/app-green.css", {expires: 365, path: '/'});
    } else if (identifier === "#app-pink") {
        $("link.color-switcher").attr("href","assets/styles/css/app-pink.css");
        $.cookie("nexus-color","assets/styles/css/app-pink.css", {expires: 365, path: '/'});
    }  else if (identifier === "#app-red") {
        $("link.color-switcher").attr("href","assets/styles/css/app-red.css");
        $.cookie("nexus-color","assets/styles/css/app-red.css", {expires: 365, path: '/'});
    }  else if (identifier === "#app-blue") {
        $("link.color-switcher").attr("href","assets/styles/css/app.css");
        $.cookie("nexus-color","assets/styles/css/app.css", {expires: 365, path: '/'});
    } 

});