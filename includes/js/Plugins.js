
/**
 * jQuery Mobile Menu 
 * Turn unordered list menu into dropdown select menu
 * version 1.0(31-OCT-2011)
 * 
 * Built on top of the jQuery library
 *   http://jquery.com
 * 
 * Documentation
 * 	 http://github.com/mambows/mobilemenu
 */
(function($){$.fn.mobileMenu=function(options){var defaults={defaultText:'跳转到...',className:'select-menu',subMenuClass:'sub-menu',subMenuDash:'&ndash;'},settings=$.extend(defaults,options),el=$(this);this.each(function(){el.find('ul').addClass(settings.subMenuClass);$('<select />',{'class':settings.className}).insertAfter(el);$('<option />',{"value":'#',"text":settings.defaultText}).appendTo('.'+settings.className);el.find('a').each(function(){var $this=$(this),optText='&nbsp;'+$this.text(),optSub=$this.parents('.'+settings.subMenuClass),len=optSub.length,dash;if($this.parents('ul').hasClass(settings.subMenuClass)){dash=Array(len+1).join(settings.subMenuDash);optText=dash+optText}$('<option />',{"value":this.href,"html":optText,"selected":(this.href==window.location.href)}).appendTo('.'+settings.className)});$('.'+settings.className).change(function(){var locations=$(this).val();if(locations!=='#'){window.location.href=$(this).val()}})});return this}})(jQuery);


/*! NProgress (c) 2013, Rico Sta. Cruz
 *  http://ricostacruz.com/nprogress */

;(function(factory){if(typeof module==='function'){module.exports=factory()}else if(typeof define==='function'&&define.amd){define(factory)}else{this.NProgress=factory()}})(function(){var NProgress={};NProgress.version='0.1.3';var Settings=NProgress.settings={minimum:0.08,easing:'ease',positionUsing:'',speed:200,trickle:true,trickleRate:0.02,trickleSpeed:800,showSpinner:true,barSelector:'[role="bar"]',spinnerSelector:'[role="spinner"]',template:'<div class="bar" role="bar"><div class="peg"></div></div><div class="spinner" role="spinner"><div class="spinner-icon"></div></div>'};NProgress.configure=function(options){var key,value;for(key in options){value=options[key];if(value!==undefined&&options.hasOwnProperty(key))Settings[key]=value}return this};NProgress.status=null;NProgress.set=function(n){var started=NProgress.isStarted();n=clamp(n,Settings.minimum,1);NProgress.status=(n===1?null:n);var progress=NProgress.render(!started),bar=progress.querySelector(Settings.barSelector),speed=Settings.speed,ease=Settings.easing;progress.offsetWidth;queue(function(next){if(Settings.positionUsing==='')Settings.positionUsing=NProgress.getPositioningCSS();css(bar,barPositionCSS(n,speed,ease));if(n===1){css(progress,{transition:'none',opacity:1});progress.offsetWidth;setTimeout(function(){css(progress,{transition:'all '+speed+'ms linear',opacity:0});setTimeout(function(){NProgress.remove();next()},speed)},speed)}else{setTimeout(next,speed)}});return this};NProgress.isStarted=function(){return typeof NProgress.status==='number'};NProgress.start=function(){if(!NProgress.status)NProgress.set(0);var work=function(){setTimeout(function(){if(!NProgress.status)return;NProgress.trickle();work()},Settings.trickleSpeed)};if(Settings.trickle)work();return this};NProgress.done=function(force){if(!force&&!NProgress.status)return this;return NProgress.inc(0.3+0.5*Math.random()).set(1)};NProgress.inc=function(amount){var n=NProgress.status;if(!n){return NProgress.start()}else{if(typeof amount!=='number'){amount=(1-n)*clamp(Math.random()*n,0.1,0.95)}n=clamp(n+amount,0,0.994);return NProgress.set(n)}};NProgress.trickle=function(){return NProgress.inc(Math.random()*Settings.trickleRate)};(function(){var initial=0,current=0;NProgress.promise=function($promise){if(!$promise||$promise.state()=="resolved"){return this}if(current==0){NProgress.start()}initial++;current++;$promise.always(function(){current--;if(current==0){initial=0;NProgress.done()}else{NProgress.set((initial-current)/initial)}});return this}})();NProgress.render=function(fromStart){if(NProgress.isRendered())return document.getElementById('nprogress');addClass(document.documentElement,'nprogress-busy');var progress=document.createElement('div');progress.id='nprogress';progress.innerHTML=Settings.template;var bar=progress.querySelector(Settings.barSelector),perc=fromStart?'-100':toBarPerc(NProgress.status||0),spinner;css(bar,{transition:'all 0 linear',transform:'translate3d('+perc+'%,0,0)'});if(!Settings.showSpinner){spinner=progress.querySelector(Settings.spinnerSelector);spinner&&removeElement(spinner)}document.body.appendChild(progress);return progress};NProgress.remove=function(){removeClass(document.documentElement,'nprogress-busy');var progress=document.getElementById('nprogress');progress&&removeElement(progress)};NProgress.isRendered=function(){return!!document.getElementById('nprogress')};NProgress.getPositioningCSS=function(){var bodyStyle=document.body.style;var vendorPrefix=('WebkitTransform'in bodyStyle)?'Webkit':('MozTransform'in bodyStyle)?'Moz':('msTransform'in bodyStyle)?'ms':('OTransform'in bodyStyle)?'O':'';if(vendorPrefix+'Perspective'in bodyStyle){return'translate3d'}else if(vendorPrefix+'Transform'in bodyStyle){return'translate'}else{return'margin'}};function clamp(n,min,max){if(n<min)return min;if(n>max)return max;return n}function toBarPerc(n){return(-1+n)*100}function barPositionCSS(n,speed,ease){var barCSS;if(Settings.positionUsing==='translate3d'){barCSS={transform:'translate3d('+toBarPerc(n)+'%,0,0)'}}else if(Settings.positionUsing==='translate'){barCSS={transform:'translate('+toBarPerc(n)+'%,0)'}}else{barCSS={'margin-left':toBarPerc(n)+'%'}}barCSS.transition='all '+speed+'ms '+ease;return barCSS}var queue=(function(){var pending=[];function next(){var fn=pending.shift();if(fn){fn(next)}}return function(fn){pending.push(fn);if(pending.length==1)next()}})();var css=(function(){var cssPrefixes=['Webkit','O','Moz','ms'],cssProps={};function camelCase(string){return string.replace(/^-ms-/,'ms-').replace(/-([\da-z])/gi,function(match,letter){return letter.toUpperCase()})}function getVendorProp(name){var style=document.body.style;if(name in style)return name;var i=cssPrefixes.length,capName=name.charAt(0).toUpperCase()+name.slice(1),vendorName;while(i--){vendorName=cssPrefixes[i]+capName;if(vendorName in style)return vendorName}return name}function getStyleProp(name){name=camelCase(name);return cssProps[name]||(cssProps[name]=getVendorProp(name))}function applyCss(element,prop,value){prop=getStyleProp(prop);element.style[prop]=value}return function(element,properties){var args=arguments,prop,value;if(args.length==2){for(prop in properties){value=properties[prop];if(value!==undefined&&properties.hasOwnProperty(prop))applyCss(element,prop,value)}}else{applyCss(element,args[1],args[2])}}})();function hasClass(element,name){var list=typeof element=='string'?element:classList(element);return list.indexOf(' '+name+' ')>=0}function addClass(element,name){var oldList=classList(element),newList=oldList+name;if(hasClass(oldList,name))return;element.className=newList.substring(1)}function removeClass(element,name){var oldList=classList(element),newList;if(!hasClass(element,name))return;newList=oldList.replace(' '+name+' ',' ');element.className=newList.substring(1,newList.length-1)}function classList(element){return(' '+(element.className||'')+' ').replace(/\s+/gi,' ')}function removeElement(element){element&&element.parentNode&&element.parentNode.removeChild(element)}return NProgress});

/*

 scrollup v2.2.0
 Author: Mark Goodyear - http://markgoodyear.com
 Git: https://github.com/markgoodyear/scrollup

 Copyright 2014 Mark Goodyear.
 Licensed under the MIT license
 http://www.opensource.org/licenses/mit-license.php

 Twitter: @markgdyr

 */
!function(a,b,c){a.fn.scrollUp=function(b){a.data(c.body,"scrollUp")||(a.data(c.body,"scrollUp",!0),a.fn.scrollUp.init(b))},a.fn.scrollUp.init=function(d){var e,f=a.fn.scrollUp.settings=a.extend({},a.fn.scrollUp.defaults,d),g=f.scrollTitle?f.scrollTitle:f.scrollText;e=f.scrollTrigger?a(f.scrollTrigger):a("<a/>",{id:f.scrollName,href:"#top",title:g}),e.appendTo("body"),f.scrollImg||f.scrollTrigger||e.html(f.scrollText),e.css({display:"none",position:"fixed",zIndex:f.zIndex}),f.activeOverlay&&a("<div/>",{id:f.scrollName+"-active"}).css({position:"absolute",top:f.scrollDistance+"px",width:"100%",borderTop:"1px dotted"+f.activeOverlay,zIndex:f.zIndex}).appendTo("body"),scrollEvent=a(b).scroll(function(){switch(scrollDis="top"===f.scrollFrom?f.scrollDistance:a(c).height()-a(b).height()-f.scrollDistance,f.animation){case"fade":a(a(b).scrollTop()>scrollDis?e.fadeIn(f.animationInSpeed):e.fadeOut(f.animationOutSpeed));break;case"slide":a(a(b).scrollTop()>scrollDis?e.slideDown(f.animationInSpeed):e.slideUp(f.animationOutSpeed));break;default:a(a(b).scrollTop()>scrollDis?e.show(0):e.hide(0))}}),e.click(function(b){b.preventDefault(),a("html, body").animate({scrollTop:0},f.scrollSpeed,f.easingType)})},a.fn.scrollUp.defaults={scrollName:"scrollUp",scrollDistance:300,scrollFrom:"top",scrollSpeed:300,easingType:"linear",animation:"fade",animationInSpeed:200,animationOutSpeed:200,scrollTrigger:!1,scrollText:"Scroll to top",scrollTitle:!1,scrollImg:!1,activeOverlay:!1,zIndex:2147483647},a.fn.scrollUp.destroy=function(d){a.removeData(c.body,"scrollUp"),a("#"+a.fn.scrollUp.settings.scrollName).remove(),a("#"+a.fn.scrollUp.settings.scrollName+"-active").remove(),a.fn.jquery.split(".")[1]>=7?a(b).off("scroll",d):a(b).unbind("scroll",d)},a.scrollUp=a.fn.scrollUp}(jQuery,window,document);


// Slidebars 0.8.2 - http://plugins.adchsm.me/slidebars/ Written by Adam Smith - http://www.adchsm.me/ Released under MIT License - http://plugins.adchsm.me/slidebars/license.txt
;(function(a){a.slidebars=function(b){var v=a.extend({siteClose:true,disableOver:false,hideControlClasses:false},b);var s=document.createElement("div").style,q=false,i=false;if(s.MozTransition===""||s.WebkitTransition===""||s.OTransition===""||s.transition===""){q=true}if(s.MozTransform===""||s.WebkitTransform===""||s.OTransform===""||s.transform===""){i=true}var p=navigator.userAgent,x=false;if(p.match(/Android/)){x=parseFloat(p.slice(p.indexOf("Android")+8));if(x<3){a("html").addClass("sb-android")}}if(!a("#sb-site").length){a("body").children().wrapAll('<div id="sb-site" />')}var o=a("#sb-site");if(!o.parent().is("body")){o.appendTo("body")}o.addClass("sb-slide");if(a(".sb-left").length){var d=a(".sb-left"),e=false;if(!d.parent().is("body")){d.appendTo("body")}if(x&&x<3){d.addClass("sb-static")}if(d.hasClass("sb-width-custom")){d.css("width",d.attr("data-sb-width"))}}if(a(".sb-right").length){var f=a(".sb-right"),h=false;if(!f.parent().is("body")){f.appendTo("body")}if(x&&x<3){f.addClass("sb-static")}if(f.hasClass("sb-width-custom")){f.css("width",f.attr("data-sb-width"))}}var u=a(".sb-toggle-left, .sb-toggle-right, .sb-open-left, .sb-open-right, .sb-close");function m(){var y=a(window).width();if(!v.disableOver||(typeof v.disableOver==="number"&&v.disableOver>=y)){this.init=true;a("html").addClass("sb-init");if(v.hideControlClasses){u.show()}}else{if(typeof v.disableOver==="number"&&v.disableOver<y){this.init=false;a("html").removeClass("sb-init");if(v.hideControlClasses){u.hide()}if(e||h){j()}}}}m();var t,k=a(".sb-slide");if(q&&i){t="translate";if(x&&x<4.4){t="side"}}else{t="jQuery"}a("html").addClass("sb-anim-type-"+t);function c(y,B,A){if(t==="translate"){y.css({transform:"translate("+B+")"})}else{if(t==="side"){y.css(A,B)}else{if(t==="jQuery"){var z={};z[A]=B;y.stop().animate(z,400)}}}}function g(y){if(y==="left"&&d&&h||y==="right"&&f&&e){j();setTimeout(z,400)}else{z()}function z(){if(this.init&&y==="left"&&d){var A=d.css("width");a("html").addClass("sb-active sb-active-left");c(k,A,"left");setTimeout(function(){e=true},400)}else{if(this.init&&y==="right"&&f){var B=f.css("width");a("html").addClass("sb-active sb-active-right");c(k,"-"+B,"left");setTimeout(function(){h=true},400)}}}}function j(y){if(e||h){e=false;h=false;c(k,"0px","left");setTimeout(function(){a("html").removeClass("sb-active sb-active-left sb-active-right");if(y){window.location=y}},400)}}function l(y){if(y==="left"&&d){if(e){j()}else{if(!e){g("left")}}}else{if(y==="right"&&f){if(h){j()}else{if(!h){g("right")}}}}}this.open=g;this.close=j;this.toggle=l;function w(){m();if(e){g("left")}else{if(h){g("right")}}}a(window).resize(w);function n(z,y){z.stopPropagation();z.preventDefault();if(z.type==="touchend"){y.off("click")}}a(".sb-toggle-left").on("touchend click",function(y){n(y,a(this));if(d&&e!==true){g("left")}else{j()}});a(".sb-toggle-right").on("touchend click",function(y){n(y,a(this));if(f&&h!==true){g("right")}else{j()}});a(".sb-open-left").on("touchend click",function(y){n(y,a(this));if(d&&e!==true){g("left")}});a(".sb-open-right").on("touchend click",function(y){n(y,a(this));if(f&&h!==true){g("right")}});a(".sb-close").on("touchend click",function(y){n(y,a(this));if(e||h){j()}});a(".sb-slidebar a").not(".sb-disable-close").on("click",function(y){n(y,a(this));if(e||h){j(a(this).attr("href"))}});o.on("touchend click",function(y){if(v.siteClose&&(e||h)){n(y,a(this));j()}})}})(jQuery);


/*! perfect-scrollbar - v0.4.9
* http://noraesae.github.com/perfect-scrollbar/
* Copyright (c) 2014 Hyeonje Jun; Licensed MIT */
(function(e){"use strict";"function"==typeof define&&define.amd?define(["jquery"],e):"object"==typeof exports?e(require("jquery")):e(jQuery)})(function(e){"use strict";var t={wheelSpeed:10,wheelPropagation:!1,minScrollbarLength:null,useBothWheelAxes:!1,useKeyboard:!0,suppressScrollX:!1,suppressScrollY:!1,scrollXMarginOffset:0,scrollYMarginOffset:0,includePadding:!1},n=function(){var e=0;return function(){var t=e;return e+=1,".perfect-scrollbar-"+t}}();e.fn.perfectScrollbar=function(o,r){return this.each(function(){var l=e.extend(!0,{},t),a=e(this);if("object"==typeof o?e.extend(!0,l,o):r=o,"update"===r)return a.data("perfect-scrollbar-update")&&a.data("perfect-scrollbar-update")(),a;if("destroy"===r)return a.data("perfect-scrollbar-destroy")&&a.data("perfect-scrollbar-destroy")(),a;if(a.data("perfect-scrollbar"))return a.data("perfect-scrollbar");a.addClass("ps-container");var s,i,c,u,d,p,f,h,v,g,b=e("<div class='ps-scrollbar-x-rail'></div>").appendTo(a),m=e("<div class='ps-scrollbar-y-rail'></div>").appendTo(a),w=e("<div class='ps-scrollbar-x'></div>").appendTo(b),T=e("<div class='ps-scrollbar-y'></div>").appendTo(m),y=parseInt(b.css("bottom"),10),L=parseInt(m.css("right"),10),S=n(),x=function(e,t){var n=e+t,o=u-v;g=0>n?0:n>o?o:n;var r=parseInt(g*(p-u)/(u-v),10);a.scrollTop(r),b.css({bottom:y-r})},M=function(e,t){var n=e+t,o=c-f;h=0>n?0:n>o?o:n;var r=parseInt(h*(d-c)/(c-f),10);a.scrollLeft(r),m.css({right:L-r})},P=function(e){return l.minScrollbarLength&&(e=Math.max(e,l.minScrollbarLength)),e},X=function(){b.css({left:a.scrollLeft(),bottom:y-a.scrollTop(),width:c,display:s?"inherit":"none"}),m.css({top:a.scrollTop(),right:L-a.scrollLeft(),height:u,display:i?"inherit":"none"}),w.css({left:h,width:f}),T.css({top:g,height:v})},D=function(){c=l.includePadding?a.innerWidth():a.width(),u=l.includePadding?a.innerHeight():a.height(),d=a.prop("scrollWidth"),p=a.prop("scrollHeight"),!l.suppressScrollX&&d>c+l.scrollXMarginOffset?(s=!0,f=P(parseInt(c*c/d,10)),h=parseInt(a.scrollLeft()*(c-f)/(d-c),10)):(s=!1,f=0,h=0,a.scrollLeft(0)),!l.suppressScrollY&&p>u+l.scrollYMarginOffset?(i=!0,v=P(parseInt(u*u/p,10)),g=parseInt(a.scrollTop()*(u-v)/(p-u),10)):(i=!1,v=0,g=0,a.scrollTop(0)),g>=u-v&&(g=u-v),h>=c-f&&(h=c-f),X()},I=function(){var t,n;w.bind("mousedown"+S,function(e){n=e.pageX,t=w.position().left,b.addClass("in-scrolling"),e.stopPropagation(),e.preventDefault()}),e(document).bind("mousemove"+S,function(e){b.hasClass("in-scrolling")&&(M(t,e.pageX-n),e.stopPropagation(),e.preventDefault())}),e(document).bind("mouseup"+S,function(){b.hasClass("in-scrolling")&&b.removeClass("in-scrolling")}),t=n=null},Y=function(){var t,n;T.bind("mousedown"+S,function(e){n=e.pageY,t=T.position().top,m.addClass("in-scrolling"),e.stopPropagation(),e.preventDefault()}),e(document).bind("mousemove"+S,function(e){m.hasClass("in-scrolling")&&(x(t,e.pageY-n),e.stopPropagation(),e.preventDefault())}),e(document).bind("mouseup"+S,function(){m.hasClass("in-scrolling")&&m.removeClass("in-scrolling")}),t=n=null},k=function(e,t){var n=a.scrollTop();if(0===e){if(!i)return!1;if(0===n&&t>0||n>=p-u&&0>t)return!l.wheelPropagation}var o=a.scrollLeft();if(0===t){if(!s)return!1;if(0===o&&0>e||o>=d-c&&e>0)return!l.wheelPropagation}return!0},C=function(){l.wheelSpeed/=10;var e=!1;a.bind("mousewheel"+S,function(t,n,o,r){var c=t.deltaX*t.deltaFactor||o,u=t.deltaY*t.deltaFactor||r;e=!1,l.useBothWheelAxes?i&&!s?(u?a.scrollTop(a.scrollTop()-u*l.wheelSpeed):a.scrollTop(a.scrollTop()+c*l.wheelSpeed),e=!0):s&&!i&&(c?a.scrollLeft(a.scrollLeft()+c*l.wheelSpeed):a.scrollLeft(a.scrollLeft()-u*l.wheelSpeed),e=!0):(a.scrollTop(a.scrollTop()-u*l.wheelSpeed),a.scrollLeft(a.scrollLeft()+c*l.wheelSpeed)),D(),e=e||k(c,u),e&&(t.stopPropagation(),t.preventDefault())}),a.bind("MozMousePixelScroll"+S,function(t){e&&t.preventDefault()})},j=function(){var t=!1;a.bind("mouseenter"+S,function(){t=!0}),a.bind("mouseleave"+S,function(){t=!1});var n=!1;e(document).bind("keydown"+S,function(o){if(t&&!e(document.activeElement).is(":input,[contenteditable]")){var r=0,l=0;switch(o.which){case 37:r=-30;break;case 38:l=30;break;case 39:r=30;break;case 40:l=-30;break;case 33:l=90;break;case 32:case 34:l=-90;break;case 35:l=-u;break;case 36:l=u;break;default:return}a.scrollTop(a.scrollTop()-l),a.scrollLeft(a.scrollLeft()+r),n=k(r,l),n&&o.preventDefault()}})},O=function(){var e=function(e){e.stopPropagation()};T.bind("click"+S,e),m.bind("click"+S,function(e){var t=parseInt(v/2,10),n=e.pageY-m.offset().top-t,o=u-v,r=n/o;0>r?r=0:r>1&&(r=1),a.scrollTop((p-u)*r)}),w.bind("click"+S,e),b.bind("click"+S,function(e){var t=parseInt(f/2,10),n=e.pageX-b.offset().left-t,o=c-f,r=n/o;0>r?r=0:r>1&&(r=1),a.scrollLeft((d-c)*r)})},E=function(){var t=function(e,t){a.scrollTop(a.scrollTop()-t),a.scrollLeft(a.scrollLeft()-e),D()},n={},o=0,r={},l=null,s=!1;e(window).bind("touchstart"+S,function(){s=!0}),e(window).bind("touchend"+S,function(){s=!1}),a.bind("touchstart"+S,function(e){var t=e.originalEvent.targetTouches[0];n.pageX=t.pageX,n.pageY=t.pageY,o=(new Date).getTime(),null!==l&&clearInterval(l),e.stopPropagation()}),a.bind("touchmove"+S,function(e){if(!s&&1===e.originalEvent.targetTouches.length){var l=e.originalEvent.targetTouches[0],a={};a.pageX=l.pageX,a.pageY=l.pageY;var i=a.pageX-n.pageX,c=a.pageY-n.pageY;t(i,c),n=a;var u=(new Date).getTime(),d=u-o;d>0&&(r.x=i/d,r.y=c/d,o=u),e.preventDefault()}}),a.bind("touchend"+S,function(){clearInterval(l),l=setInterval(function(){return.01>Math.abs(r.x)&&.01>Math.abs(r.y)?(clearInterval(l),void 0):(t(30*r.x,30*r.y),r.x*=.8,r.y*=.8,void 0)},10)})},H=function(){a.bind("scroll"+S,function(){D()})},A=function(){a.unbind(S),e(window).unbind(S),e(document).unbind(S),a.data("perfect-scrollbar",null),a.data("perfect-scrollbar-update",null),a.data("perfect-scrollbar-destroy",null),w.remove(),T.remove(),b.remove(),m.remove(),w=T=c=u=d=p=f=h=y=v=g=L=null},W=function(t){a.addClass("ie").addClass("ie"+t);var n=function(){var t=function(){e(this).addClass("hover")},n=function(){e(this).removeClass("hover")};a.bind("mouseenter"+S,t).bind("mouseleave"+S,n),b.bind("mouseenter"+S,t).bind("mouseleave"+S,n),m.bind("mouseenter"+S,t).bind("mouseleave"+S,n),w.bind("mouseenter"+S,t).bind("mouseleave"+S,n),T.bind("mouseenter"+S,t).bind("mouseleave"+S,n)},o=function(){X=function(){w.css({left:h+a.scrollLeft(),bottom:y,width:f}),T.css({top:g+a.scrollTop(),right:L,height:v}),w.hide().show(),T.hide().show()}};6===t&&(n(),o())},q="ontouchstart"in window||window.DocumentTouch&&document instanceof window.DocumentTouch,F=function(){var e=navigator.userAgent.toLowerCase().match(/(msie) ([\w.]+)/);e&&"msie"===e[1]&&W(parseInt(e[2],10)),D(),H(),I(),Y(),O(),q&&E(),a.mousewheel&&C(),l.useKeyboard&&j(),a.data("perfect-scrollbar",a),a.data("perfect-scrollbar-update",D),a.data("perfect-scrollbar-destroy",A)};return F(),a})}}),function(e){"function"==typeof define&&define.amd?define(["jquery"],e):"object"==typeof exports?module.exports=e:e(jQuery)}(function(e){function t(t){var a=t||window.event,s=i.call(arguments,1),c=0,u=0,d=0,p=0;if(t=e.event.fix(a),t.type="mousewheel","detail"in a&&(d=-1*a.detail),"wheelDelta"in a&&(d=a.wheelDelta),"wheelDeltaY"in a&&(d=a.wheelDeltaY),"wheelDeltaX"in a&&(u=-1*a.wheelDeltaX),"axis"in a&&a.axis===a.HORIZONTAL_AXIS&&(u=-1*d,d=0),c=0===d?u:d,"deltaY"in a&&(d=-1*a.deltaY,c=d),"deltaX"in a&&(u=a.deltaX,0===d&&(c=-1*u)),0!==d||0!==u){if(1===a.deltaMode){var f=e.data(this,"mousewheel-line-height");c*=f,d*=f,u*=f}else if(2===a.deltaMode){var h=e.data(this,"mousewheel-page-height");c*=h,d*=h,u*=h}return p=Math.max(Math.abs(d),Math.abs(u)),(!l||l>p)&&(l=p,o(a,p)&&(l/=40)),o(a,p)&&(c/=40,u/=40,d/=40),c=Math[c>=1?"floor":"ceil"](c/l),u=Math[u>=1?"floor":"ceil"](u/l),d=Math[d>=1?"floor":"ceil"](d/l),t.deltaX=u,t.deltaY=d,t.deltaFactor=l,t.deltaMode=0,s.unshift(t,c,u,d),r&&clearTimeout(r),r=setTimeout(n,200),(e.event.dispatch||e.event.handle).apply(this,s)}}function n(){l=null}function o(e,t){return u.settings.adjustOldDeltas&&"mousewheel"===e.type&&0===t%120}var r,l,a=["wheel","mousewheel","DOMMouseScroll","MozMousePixelScroll"],s="onwheel"in document||document.documentMode>=9?["wheel"]:["mousewheel","DomMouseScroll","MozMousePixelScroll"],i=Array.prototype.slice;if(e.event.fixHooks)for(var c=a.length;c;)e.event.fixHooks[a[--c]]=e.event.mouseHooks;var u=e.event.special.mousewheel={version:"3.1.9",setup:function(){if(this.addEventListener)for(var n=s.length;n;)this.addEventListener(s[--n],t,!1);else this.onmousewheel=t;e.data(this,"mousewheel-line-height",u.getLineHeight(this)),e.data(this,"mousewheel-page-height",u.getPageHeight(this))},teardown:function(){if(this.removeEventListener)for(var e=s.length;e;)this.removeEventListener(s[--e],t,!1);else this.onmousewheel=null},getLineHeight:function(t){return parseInt(e(t)["offsetParent"in e.fn?"offsetParent":"parent"]().css("fontSize"),10)},getPageHeight:function(t){return e(t).height()},settings:{adjustOldDeltas:!0}};e.fn.extend({mousewheel:function(e){return e?this.bind("mousewheel",e):this.trigger("mousewheel")},unmousewheel:function(e){return this.unbind("mousewheel",e)}})});


// circle_bg
function draw() {
	con.clearRect(0,0,WIDTH,HEIGHT);
	for(var i = 0; i < pxs.length; i++) {
		pxs[i].fade();
		pxs[i].move();
		pxs[i].draw();
	}
}

function Circle() {
	this.s = {ttl:8000, xmax:5, ymax:2, rmax:10, rt:1, xdef:960, ydef:540, xdrift:4, ydrift: 4, random:true, blink:true};

	this.reset = function() {
		this.x = (this.s.random ? WIDTH*Math.random() : this.s.xdef);
		this.y = (this.s.random ? HEIGHT*Math.random() : this.s.ydef);
		this.r = ((this.s.rmax-1)*Math.random()) + 1;
		this.dx = (Math.random()*this.s.xmax) * (Math.random() < .5 ? -1 : 1);
		this.dy = (Math.random()*this.s.ymax) * (Math.random() < .5 ? -1 : 1);
		this.hl = (this.s.ttl/rint)*(this.r/this.s.rmax);
		this.rt = Math.random()*this.hl;
		this.s.rt = Math.random()+1;
		this.stop = Math.random()*.2+.4;
		this.s.xdrift *= Math.random() * (Math.random() < .5 ? -1 : 1);
		this.s.ydrift *= Math.random() * (Math.random() < .5 ? -1 : 1);
	}

	this.fade = function() {
		this.rt += this.s.rt;
	}

	this.draw = function() {
		if(this.s.blink && (this.rt <= 0 || this.rt >= this.hl)) this.s.rt = this.s.rt*-1;
		else if(this.rt >= this.hl) this.reset();
		var newo = 1-(this.rt/this.hl);
		con.beginPath();
		con.arc(this.x,this.y,this.r,0,Math.PI*2,true);
		con.closePath();
		var cr = this.r*newo;
		g = con.createRadialGradient(this.x,this.y,0,this.x,this.y,(cr <= 0 ? 1 : cr));
		g.addColorStop(0.0, 'rgba(255,255,255,'+newo+')');
		g.addColorStop(this.stop, 'rgba(255,227,168,'+(newo*.2)+')');
		g.addColorStop(1.0, 'rgba(255,227,168,0)');
		con.fillStyle = g;
		con.fill();
	}

	this.move = function() {
		this.x += (this.rt/this.hl)*this.dx;
		this.y += (this.rt/this.hl)*this.dy;
		if(this.x > WIDTH || this.x < 0) this.dx *= -1;
		if(this.y > HEIGHT || this.y < 0) this.dy *= -1;
	}

	this.getX = function() { return this.x; }
	this.getY = function() { return this.y; }
}
jQuery(document).ready(function(){
	if(jQuery.browser.mobile)
	{

	}
	else
	{
	   if(document.getElementById('pixie')){
	   if(jQuery.browser.msie){
			WIDTH = document.documentElement.offsetWidth;
			HEIGHT = document.documentElement.offsetHeight;
		}else{
			WIDTH = window.innerWidth;
			HEIGHT = window.innerHeight
		}

	    canvas = document.getElementById('pixie');
		jQuery(canvas).attr('width', WIDTH).attr('height',HEIGHT);
	    con = canvas.getContext('2d');
	    pxs = new Array();
		rint = 60;
	    for(var i = 0; i < 50; i++) {
	        pxs[i] = new Circle();
	        pxs[i].reset();
	    }
	    setInterval(draw,rint);
    	}
	}
	
});

/*! http://responsiveslides.com v1.54 by @viljamis */
(function(c,I,B){c.fn.responsiveSlides=function(l){var a=c.extend({auto:!0,speed:500,timeout:4E3,pager:!1,nav:!1,random:!1,pause:!1,pauseControls:!0,prevText:"Previous",nextText:"Next",maxwidth:"",navContainer:"",manualControls:"",namespace:"rslides",before:c.noop,after:c.noop},l);return this.each(function(){B++;var f=c(this),s,r,t,m,p,q,n=0,e=f.children(),C=e.size(),h=parseFloat(a.speed),D=parseFloat(a.timeout),u=parseFloat(a.maxwidth),g=a.namespace,d=g+B,E=g+"_nav "+d+"_nav",v=g+"_here",j=d+"_on",
w=d+"_s",k=c("<ul class='"+g+"_tabs "+d+"_tabs' />"),x={"float":"left",position:"relative",opacity:1,zIndex:2},y={"float":"none",position:"absolute",opacity:0,zIndex:1},F=function(){var b=(document.body||document.documentElement).style,a="transition";if("string"===typeof b[a])return!0;s=["Moz","Webkit","Khtml","O","ms"];var a=a.charAt(0).toUpperCase()+a.substr(1),c;for(c=0;c<s.length;c++)if("string"===typeof b[s[c]+a])return!0;return!1}(),z=function(b){a.before(b);F?(e.removeClass(j).css(y).eq(b).addClass(j).css(x),
n=b,setTimeout(function(){a.after(b)},h)):e.stop().fadeOut(h,function(){c(this).removeClass(j).css(y).css("opacity",1)}).eq(b).fadeIn(h,function(){c(this).addClass(j).css(x);a.after(b);n=b})};a.random&&(e.sort(function(){return Math.round(Math.random())-0.5}),f.empty().append(e));e.each(function(a){this.id=w+a});f.addClass(g+" "+d);l&&l.maxwidth&&f.css("max-width",u);e.hide().css(y).eq(0).addClass(j).css(x).show();F&&e.show().css({"-webkit-transition":"opacity "+h+"ms ease-in-out","-moz-transition":"opacity "+
h+"ms ease-in-out","-o-transition":"opacity "+h+"ms ease-in-out",transition:"opacity "+h+"ms ease-in-out"});if(1<e.size()){if(D<h+100)return;if(a.pager&&!a.manualControls){var A=[];e.each(function(a){a+=1;A+="<li><a href='#' class='"+w+a+"'>"+a+"</a></li>"});k.append(A);l.navContainer?c(a.navContainer).append(k):f.after(k)}a.manualControls&&(k=c(a.manualControls),k.addClass(g+"_tabs "+d+"_tabs"));(a.pager||a.manualControls)&&k.find("li").each(function(a){c(this).addClass(w+(a+1))});if(a.pager||a.manualControls)q=
k.find("a"),r=function(a){q.closest("li").removeClass(v).eq(a).addClass(v)};a.auto&&(t=function(){p=setInterval(function(){e.stop(!0,!0);var b=n+1<C?n+1:0;(a.pager||a.manualControls)&&r(b);z(b)},D)},t());m=function(){a.auto&&(clearInterval(p),t())};a.pause&&f.hover(function(){clearInterval(p)},function(){m()});if(a.pager||a.manualControls)q.bind("click",function(b){b.preventDefault();a.pauseControls||m();b=q.index(this);n===b||c("."+j).queue("fx").length||(r(b),z(b))}).eq(0).closest("li").addClass(v),
a.pauseControls&&q.hover(function(){clearInterval(p)},function(){m()});if(a.nav){g="<a href='#' class='"+E+" prev'>"+a.prevText+"</a><a href='#' class='"+E+" next'>"+a.nextText+"</a>";l.navContainer?c(a.navContainer).append(g):f.after(g);var d=c("."+d+"_nav"),G=d.filter(".prev");d.bind("click",function(b){b.preventDefault();b=c("."+j);if(!b.queue("fx").length){var d=e.index(b);b=d-1;d=d+1<C?n+1:0;z(c(this)[0]===G[0]?b:d);if(a.pager||a.manualControls)r(c(this)[0]===G[0]?b:d);a.pauseControls||m()}});
a.pauseControls&&d.hover(function(){clearInterval(p)},function(){m()})}}if("undefined"===typeof document.body.style.maxWidth&&l.maxwidth){var H=function(){f.css("width","100%");f.width()>u&&f.css("width",u)};H();c(I).bind("resize",function(){H()})}})}})(jQuery,this,0);

