/*! jQuery.history v1.0.1 | Copyright 2013 yeikos - MIT license | https://github.com/yeikos/jquery.history */

;(function(e,t){var n=function(t){if(u==="pathname"){if(c!==t)window.history.pushState({},null,c=t)}else if(u==="hash"){if(c!==t){c=location.hash=t;if(o){if(!e("#jQueryHistory").length)throw new Error("jQuery."+r+".push: iframe not found.");if(l){l=0;f.contentWindow.document.open().close();f.contentWindow.location.hash="/"}f.contentWindow.document.open().close();f.contentWindow.location.hash=t}}}else{throw new Error("jQuery."+r+".push: listener is not active.")}n.context.trigger("push",[t,u]);return n},r="history";n.context=e({});e.each(["on","off","trigger"],function(e,t){n[t]=function(){n.context[t].apply(n.context,arguments);return n}});n.push=n;n.getListenType=function(){return u};n.listen=function(l,h){n.unlisten();var p=arguments.length;if(!p||l==="auto"){l=i?"pathname":"hash";p=1}else if(l!=="pathname"&&l!=="hash"){throw new Error("jQuery."+r+".listen: type is not valid.")}if(l==="hash"){if(!s&&p===1||h===true){h=n.config.interval;p=2}if(p===2&&(isNaN(h)||h<1))throw new Error("jQuery."+r+".listen: interval delay is not valid.")}if((u=l)==="pathname"){if(!i)throw new Error("jQuery."+r+".listen: this browser has not support to pushState.");e(window).on("popstate.history",function(e){if(e.originalEvent&&e.originalEvent.state&&c!==location.pathname)n.trigger("change",[c=location.pathname,"pathname"])});if(location.pathname.length>1)n.trigger("load",[location.pathname+location.search+location.hash,"pathname"])}else{if(s&&!h){e(window).on("hashchange.history",function(e){var t=location.hash.substr(1);if(c!==t)n.trigger("change",[c=t,"hash"])})}else{if(o===t)o=n.isIE67();if(o){if(!(p=e("body")).length)throw new Error("jQuery."+r+".listen: document is not ready.");f=e('<iframe id="jQueryHistory" style="display:none" src="javascript:void(0);" />').appendTo(p)[0];var d=f.contentWindow;if(location.hash.length>1){d.document.open().close();d.location.hash=location.hash}a=setInterval(function(){if((c=location.hash)!==d.location.hash){d.document.open().close();d.location.hash=c;n.trigger("change",[c.substr(1),"hash"])}},h)}else{c=location.hash.substr(1);a=setInterval(function(){var e=location.hash.substr(1);if(c!==e)n.trigger("change",[c=e,"hash"])},h)}}if(location.hash.length>1)n.trigger("load",[location.hash.substr(1),"hash"])}return n};n.unlisten=function(){u=c=f=null;e(window).off("popstate.history hashchange.history");e("#jQueryHistory").remove();clearInterval(a);return n};n.getSupports=function(e){var n={},r=arguments.length,i;if(!r||e==="pushState")n.pushState="pushState"in window.history;if(!r||e==="onhashchange")n.onhashchange="onhashchange"in window&&((i=document.documentMode)===t||i>7);if(r)return n[e];return n};n.isIE67=function(){var n="_history_msie",r,i;window[n]=false;r=e('<span><!--[if lte IE 7]><script type="text/javascript">window.'+n+"=true;</script><![endif]--></span>").appendTo("body");i=window[n]===true;try{delete window[n]}catch(s){window[n]=t}r.remove();return i};n.supports=n.getSupports();n.config={interval:100};var i=n.supports.pushState,s=n.supports.onhashchange,o,u=null,a,f,l=1,c;e[r]=n})(jQuery);