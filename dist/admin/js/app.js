$("#form-login").submit(function(t){t.preventDefault(),$("#loading").modal({keyboard:!1}),$.ajax({type:"POST",url:"acts/acts.login.php?act=login",data:$("#form-login").serialize(),success:function(t){try{var e=JSON.parse(t.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));$("#loading").modal("hide"),e.succeed?window.location.href="home":($("#alert-title").html(e.title),$("#alert-content").html(e.errno+" - "+e.erro),$("#alert").modal("show"),"21010"==e.errno&&$("#alert").on("hidden.bs.modal",function(t){window.location.href="../provisoria"}))}catch(t){$("#loading").modal("hide"),$("#alert-title").html("Erro ao fazer parse do JSON!"),$("#alert-content").html(String(t.stack)),$("#alert").modal("show")}}})}),function(s){"use strict";function n(t){return t.is('[type="checkbox"]')?t.prop("checked"):t.is('[type="radio"]')?!!s('[name="'+t.attr("name")+'"]:checked').length:t.is("select[multiple]")?(t.val()||[]).length:t.val()}function e(a){return this.each(function(){var t=s(this),e=s.extend({},i.DEFAULTS,t.data(),"object"==typeof a&&a),r=t.data("bs.validator");(r||"destroy"!=a)&&(r||t.data("bs.validator",r=new i(this,e)),"string"==typeof a&&r[a]())})}var i=function(t,e){this.options=e,this.validators=s.extend({},i.VALIDATORS,e.custom),this.$element=s(t),this.$btn=s('button[type="submit"], input[type="submit"]').filter('[form="'+this.$element.attr("id")+'"]').add(this.$element.find('input[type="submit"], button[type="submit"]')),this.update(),this.$element.on("input.bs.validator change.bs.validator focusout.bs.validator",s.proxy(this.onInput,this)),this.$element.on("submit.bs.validator",s.proxy(this.onSubmit,this)),this.$element.on("reset.bs.validator",s.proxy(this.reset,this)),this.$element.find("[data-match]").each(function(){var t=s(this),e=t.attr("data-match");s(e).on("input.bs.validator",function(){n(t)&&t.trigger("input.bs.validator")})}),this.$inputs.filter(function(){return n(s(this))&&!s(this).closest(".has-error").length}).trigger("focusout"),this.$element.attr("novalidate",!0)};i.VERSION="0.11.9",i.INPUT_SELECTOR=':input:not([type="hidden"], [type="submit"], [type="reset"], button)',i.FOCUS_OFFSET=20,i.DEFAULTS={delay:500,html:!1,disable:!0,focus:!0,custom:{},errors:{match:"Does not match",minlength:"Not long enough"},feedback:{success:"glyphicon-ok",error:"glyphicon-remove"}},i.VALIDATORS={native:function(t){var e=t[0];return e.checkValidity?!e.checkValidity()&&!e.validity.valid&&(e.validationMessage||"error!"):void 0},match:function(t){var e=t.attr("data-match");return t.val()!==s(e).val()&&i.DEFAULTS.errors.match},minlength:function(t){var e=t.attr("data-minlength");return t.val().length<e&&i.DEFAULTS.errors.minlength}},i.prototype.update=function(){var t=this;return this.$inputs=this.$element.find(i.INPUT_SELECTOR).add(this.$element.find('[data-validate="true"]')).not(this.$element.find('[data-validate="false"]').each(function(){t.clearErrors(s(this))})),this.toggleSubmit(),this},i.prototype.onInput=function(t){var e=this,r=s(t.target),a="focusout"!==t.type;this.$inputs.is(r)&&this.validateInput(r,a).done(function(){e.toggleSubmit()})},i.prototype.validateInput=function(e,r){var a=(n(e),e.data("bs.validator.errors"));e.is('[type="radio"]')&&(e=this.$element.find('input[name="'+e.attr("name")+'"]'));var i=s.Event("validate.bs.validator",{relatedTarget:e[0]});if(this.$element.trigger(i),!i.isDefaultPrevented()){var o=this;return this.runValidators(e).done(function(t){e.data("bs.validator.errors",t),t.length?r?o.defer(e,o.showErrors):o.showErrors(e):o.clearErrors(e),a&&t.toString()===a.toString()||(i=t.length?s.Event("invalid.bs.validator",{relatedTarget:e[0],detail:t}):s.Event("valid.bs.validator",{relatedTarget:e[0],detail:a}),o.$element.trigger(i)),o.toggleSubmit(),o.$element.trigger(s.Event("validated.bs.validator",{relatedTarget:e[0]}))})}},i.prototype.runValidators=function(a){function i(t){return r=t,a.attr("data-"+r+"-error")||((e=a[0].validity).typeMismatch?a.attr("data-type-error"):e.patternMismatch?a.attr("data-pattern-error"):e.stepMismatch?a.attr("data-step-error"):e.rangeOverflow?a.attr("data-max-error"):e.rangeUnderflow?a.attr("data-min-error"):e.valueMissing?a.attr("data-required-error"):null)||a.attr("data-error");var e,r}var o=[],e=s.Deferred();return a.data("bs.validator.deferred")&&a.data("bs.validator.deferred").reject(),a.data("bs.validator.deferred",e),s.each(this.validators,s.proxy(function(t,e){var r=null;!n(a)&&!a.attr("required")||void 0===a.attr("data-"+t)&&"native"!=t||!(r=e.call(this,a))||(r=i(t)||r,!~o.indexOf(r)&&o.push(r))},this)),!o.length&&n(a)&&a.attr("data-remote")?this.defer(a,function(){var t={};t[a.attr("name")]=n(a),s.get(a.attr("data-remote"),t).fail(function(t,e,r){o.push(i("remote")||r)}).always(function(){e.resolve(o)})}):e.resolve(o),e.promise()},i.prototype.validate=function(){var t=this;return s.when(this.$inputs.map(function(){return t.validateInput(s(this),!1)})).then(function(){t.toggleSubmit(),t.focusError()}),this},i.prototype.focusError=function(){if(this.options.focus){var t=this.$element.find(".has-error :input:first");0!==t.length&&(s("html, body").animate({scrollTop:t.offset().top-i.FOCUS_OFFSET},250),t.focus())}},i.prototype.showErrors=function(t){var e=this.options.html?"html":"text",r=t.data("bs.validator.errors"),a=t.closest(".form-group"),i=a.find(".help-block.with-errors"),o=a.find(".form-control-feedback");r.length&&(r=s("<ul/>").addClass("list-unstyled").append(s.map(r,function(t){return s("<li/>")[e](t)})),void 0===i.data("bs.validator.originalContent")&&i.data("bs.validator.originalContent",i.html()),i.empty().append(r),a.addClass("has-error has-danger"),a.hasClass("has-feedback")&&o.removeClass(this.options.feedback.success)&&o.addClass(this.options.feedback.error)&&a.removeClass("has-success"))},i.prototype.clearErrors=function(t){var e=t.closest(".form-group"),r=e.find(".help-block.with-errors"),a=e.find(".form-control-feedback");r.html(r.data("bs.validator.originalContent")),e.removeClass("has-error has-danger has-success"),e.hasClass("has-feedback")&&a.removeClass(this.options.feedback.error)&&a.removeClass(this.options.feedback.success)&&n(t)&&a.addClass(this.options.feedback.success)&&e.addClass("has-success")},i.prototype.hasErrors=function(){return!!this.$inputs.filter(function(){return!!(s(this).data("bs.validator.errors")||[]).length}).length},i.prototype.isIncomplete=function(){return!!this.$inputs.filter("[required]").filter(function(){var t=n(s(this));return!("string"==typeof t?s.trim(t):t)}).length},i.prototype.onSubmit=function(t){this.validate(),(this.isIncomplete()||this.hasErrors())&&t.preventDefault()},i.prototype.toggleSubmit=function(){this.options.disable&&this.$btn.toggleClass("disabled",this.isIncomplete()||this.hasErrors())},i.prototype.defer=function(t,e){return e=s.proxy(e,this,t),this.options.delay?(window.clearTimeout(t.data("bs.validator.timeout")),void t.data("bs.validator.timeout",window.setTimeout(e,this.options.delay))):e()},i.prototype.reset=function(){return this.$element.find(".form-control-feedback").removeClass(this.options.feedback.error).removeClass(this.options.feedback.success),this.$inputs.removeData(["bs.validator.errors","bs.validator.deferred"]).each(function(){var t=s(this),e=t.data("bs.validator.timeout");window.clearTimeout(e)&&t.removeData("bs.validator.timeout")}),this.$element.find(".help-block.with-errors").each(function(){var t=s(this),e=t.data("bs.validator.originalContent");t.removeData("bs.validator.originalContent").html(e)}),this.$btn.removeClass("disabled"),this.$element.find(".has-error, .has-danger, .has-success").removeClass("has-error has-danger has-success"),this},i.prototype.destroy=function(){return this.reset(),this.$element.removeAttr("novalidate").removeData("bs.validator").off(".bs.validator"),this.$inputs.off(".bs.validator"),this.options=null,this.validators=null,this.$element=null,this.$btn=null,this.$inputs=null,this};var t=s.fn.validator;s.fn.validator=e,s.fn.validator.Constructor=i,s.fn.validator.noConflict=function(){return s.fn.validator=t,this},s(window).on("load",function(){s('form[data-toggle="validator"]').each(function(){var t=s(this);e.call(t,t.data())})})}(jQuery);