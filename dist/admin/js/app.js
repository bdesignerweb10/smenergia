$("#logout").on("click",function(t){t.preventDefault(),$("#loading-modal").modal({keyboard:!1}),$.ajax({type:"POST",url:"acts/acts.logout.php",success:function(t){try{$("#loading-modal").modal("hide");var e=JSON.parse(t.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));e.succeed?(document.cookie.split(";").forEach(function(t){document.cookie=t.replace(/^ +/,"").replace(/=.*/,"=;expires="+(new Date).toUTCString()+";path=/")}),window.location.href="./"):($("#alert-title").html(e.title),$("#alert-content").html(e.errno+" - "+e.erro),$("#alert").modal("show"),"12010"==e.errno&&$("#alert").on("hidden.bs.modal",function(t){window.location.href="provisoria"}))}catch(t){$("#loading-modal").modal("hide"),$("#alert-title").html("Erro ao fazer parse do JSON!"),$("#alert-content").html(String(t.stack)),$("#alert").modal("show")}}})}),$("#form-login").submit(function(t){t.preventDefault(),$("#loading").modal({keyboard:!1}),$.ajax({type:"POST",url:"acts/acts.login.php?act=login",data:$("#form-login").serialize(),success:function(t){try{var e=JSON.parse(t.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));$("#loading").modal("hide"),e.succeed?window.location.href="home":($("#alert-title").html(e.title),$("#alert-content").html(e.errno+" - "+e.erro),$("#alert").modal("show"))}catch(t){$("#loading").modal("hide"),$("#alert-title").html("Erro ao fazer parse do JSON!"),$("#alert-content").html(String(t.stack)),$("#alert").modal("show")}}})}),$("#btn-login").click(function(t){t.preventDefault(),$("#loading").modal({keyboard:!1}),$.ajax({type:"POST",url:"acts/acts.login.php?act=login",data:$("#form-login").serialize(),success:function(t){try{var e=JSON.parse(t.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));$("#loading").modal("hide"),e.succeed?window.location.href="home":($("#alert-title").html(e.title),$("#alert-content").html(e.errno+" - "+e.erro),$("#alert").modal("show"))}catch(t){$("#loading").modal("hide"),$("#alert-title").html("Erro ao fazer parse do JSON!"),$("#alert-content").html(String(t.stack)),$("#alert").modal("show")}}})}),$("#btn-add-quemsomos").click(function(t){t.preventDefault(),$(".maintable").hide(),$(".mainform").show(),$("#btn-salvar-quemsomos").data("id",null),$("#btn-salvar-quemsomos").data("act","add"),$("#id").val(""),$("#titulo").val(""),$("#descricao").val(""),$("#ativo").bootstrapToggle("off")}),$("#btn-salvar-quemsomos").click(function(t){t.preventDefault(),$("#loading").modal({keyboard:!1});var e=$(this).data("id"),a=$(this).data("act");if("edit"==a)var o="acts/acts.quemsomos.php?act="+a+"&id="+e;else o="acts/acts.quemsomos.php?act="+a;$.ajax({type:"POST",url:o,data:$("#form-quemsomos").serialize(),success:function(t){console.log("data",t);try{$("#loading").modal("hide");var e=JSON.parse(t.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));e.succeed?($("#alert-title").html($("#titulo").val()+("add"==a?" adicionado ":" editado ")+"com sucesso!"),$("#alert-content").html("A "+("add"==a?" adição ":" edição ")+" de "+$("#titulo").val()+" foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada."),$("#alert").modal("show"),$("#alert").on("hidden.bs.modal",function(t){window.location.reload()})):($("#alert-title").html(e.title),$("#alert-content").html(e.errno+" - "+e.erro),$("#alert").modal("show"))}catch(t){$("#loading").modal("hide"),$("#alert-title").html("Erro ao fazer parse do JSON!"),$("#alert-content").html(String(t.stack)),$("#alert").modal("show")}}})}),$(".btn-edit-quemsomos").click(function(t){t.preventDefault(),$("#loading").modal({keyboard:!1});var a=$(this).data("id");$.ajax({type:"POST",url:"acts/acts.quemsomos.php?act=showupd&id="+a,success:function(t){try{$("#loading").modal("hide");var e=JSON.parse(t.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));e.succeed?($(".maintable").hide(),$(".mainform").show(),$("#btn-salvar-quemsomos").data("act","edit"),$("#btn-salvar-quemsomos").data("id",a),$("#id").val(e.dados.id),$("#titulo").val(e.dados.titulo),$("#descricao").val(e.dados.descricao)):($(".mainform").hide(),$(".maintable").show(),$("#btn-salvar-quemsomos").data("id",null),$("#btn-salvar-quemsomos").data("act",null),$("#id").val(""),$("#titulo").val(""),$("#descricao").val(""),$("#alert-title").html(e.title),$("#alert-content").html(e.errno+" - "+e.erro),$("#alert").modal("show"))}catch(t){$("#loading").modal("hide"),$("#alert-title").html("Erro ao fazer parse do JSON!"),$("#alert-content").html(String(t.stack)),$("#alert").modal("show")}}})}),$(".btn-del-quemsomos").click(function(t){t.preventDefault(),$("#loading").modal({keyboard:!1});var e=$(this).data("id");$.ajax({type:"POST",url:"acts/acts.quemsomos.php?act=del&id="+e,success:function(t){try{$("#loading").modal("hide");var e=JSON.parse(t.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));e.succeed?($("#alert-title").html("Evento removido com sucesso!"),$("#alert-content").html("A remoção do evento foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada."),$("#alert").modal("show"),$("#alert").on("hidden.bs.modal",function(t){window.location.reload()})):($("#alert-title").html(e.title),$("#alert-content").html(e.errno+" - "+e.erro),$("#alert").modal("show"))}catch(t){$("#loading").modal("hide"),$("#alert-title").html("Erro ao fazer parse do JSON!"),$("#alert-content").html(String(t.stack)),$("#alert").modal("show")}}})}),$("#btn-voltar-quemsomos").click(function(t){t.preventDefault(),$(".mainform").hide(),$(".maintable").show(),$("#btn-salvar-quemsomos").data("id",null),$("#headline-ger-quemsomos").html(""),$(".headline-form").html("")}),function(s){"use strict";function n(t){return t.is('[type="checkbox"]')?t.prop("checked"):t.is('[type="radio"]')?!!s('[name="'+t.attr("name")+'"]:checked').length:t.is("select[multiple]")?(t.val()||[]).length:t.val()}function e(o){return this.each(function(){var t=s(this),e=s.extend({},r.DEFAULTS,t.data(),"object"==typeof o&&o),a=t.data("bs.validator");(a||"destroy"!=o)&&(a||t.data("bs.validator",a=new r(this,e)),"string"==typeof o&&a[o]())})}var r=function(t,e){this.options=e,this.validators=s.extend({},r.VALIDATORS,e.custom),this.$element=s(t),this.$btn=s('button[type="submit"], input[type="submit"]').filter('[form="'+this.$element.attr("id")+'"]').add(this.$element.find('input[type="submit"], button[type="submit"]')),this.update(),this.$element.on("input.bs.validator change.bs.validator focusout.bs.validator",s.proxy(this.onInput,this)),this.$element.on("submit.bs.validator",s.proxy(this.onSubmit,this)),this.$element.on("reset.bs.validator",s.proxy(this.reset,this)),this.$element.find("[data-match]").each(function(){var t=s(this),e=t.attr("data-match");s(e).on("input.bs.validator",function(){n(t)&&t.trigger("input.bs.validator")})}),this.$inputs.filter(function(){return n(s(this))&&!s(this).closest(".has-error").length}).trigger("focusout"),this.$element.attr("novalidate",!0)};r.VERSION="0.11.9",r.INPUT_SELECTOR=':input:not([type="hidden"], [type="submit"], [type="reset"], button)',r.FOCUS_OFFSET=20,r.DEFAULTS={delay:500,html:!1,disable:!0,focus:!0,custom:{},errors:{match:"Does not match",minlength:"Not long enough"},feedback:{success:"glyphicon-ok",error:"glyphicon-remove"}},r.VALIDATORS={native:function(t){var e=t[0];return e.checkValidity?!e.checkValidity()&&!e.validity.valid&&(e.validationMessage||"error!"):void 0},match:function(t){var e=t.attr("data-match");return t.val()!==s(e).val()&&r.DEFAULTS.errors.match},minlength:function(t){var e=t.attr("data-minlength");return t.val().length<e&&r.DEFAULTS.errors.minlength}},r.prototype.update=function(){var t=this;return this.$inputs=this.$element.find(r.INPUT_SELECTOR).add(this.$element.find('[data-validate="true"]')).not(this.$element.find('[data-validate="false"]').each(function(){t.clearErrors(s(this))})),this.toggleSubmit(),this},r.prototype.onInput=function(t){var e=this,a=s(t.target),o="focusout"!==t.type;this.$inputs.is(a)&&this.validateInput(a,o).done(function(){e.toggleSubmit()})},r.prototype.validateInput=function(e,a){var o=(n(e),e.data("bs.validator.errors"));e.is('[type="radio"]')&&(e=this.$element.find('input[name="'+e.attr("name")+'"]'));var r=s.Event("validate.bs.validator",{relatedTarget:e[0]});if(this.$element.trigger(r),!r.isDefaultPrevented()){var i=this;return this.runValidators(e).done(function(t){e.data("bs.validator.errors",t),t.length?a?i.defer(e,i.showErrors):i.showErrors(e):i.clearErrors(e),o&&t.toString()===o.toString()||(r=t.length?s.Event("invalid.bs.validator",{relatedTarget:e[0],detail:t}):s.Event("valid.bs.validator",{relatedTarget:e[0],detail:o}),i.$element.trigger(r)),i.toggleSubmit(),i.$element.trigger(s.Event("validated.bs.validator",{relatedTarget:e[0]}))})}},r.prototype.runValidators=function(o){function r(t){return a=t,o.attr("data-"+a+"-error")||((e=o[0].validity).typeMismatch?o.attr("data-type-error"):e.patternMismatch?o.attr("data-pattern-error"):e.stepMismatch?o.attr("data-step-error"):e.rangeOverflow?o.attr("data-max-error"):e.rangeUnderflow?o.attr("data-min-error"):e.valueMissing?o.attr("data-required-error"):null)||o.attr("data-error");var e,a}var i=[],e=s.Deferred();return o.data("bs.validator.deferred")&&o.data("bs.validator.deferred").reject(),o.data("bs.validator.deferred",e),s.each(this.validators,s.proxy(function(t,e){var a=null;!n(o)&&!o.attr("required")||void 0===o.attr("data-"+t)&&"native"!=t||!(a=e.call(this,o))||(a=r(t)||a,!~i.indexOf(a)&&i.push(a))},this)),!i.length&&n(o)&&o.attr("data-remote")?this.defer(o,function(){var t={};t[o.attr("name")]=n(o),s.get(o.attr("data-remote"),t).fail(function(t,e,a){i.push(r("remote")||a)}).always(function(){e.resolve(i)})}):e.resolve(i),e.promise()},r.prototype.validate=function(){var t=this;return s.when(this.$inputs.map(function(){return t.validateInput(s(this),!1)})).then(function(){t.toggleSubmit(),t.focusError()}),this},r.prototype.focusError=function(){if(this.options.focus){var t=this.$element.find(".has-error :input:first");0!==t.length&&(s("html, body").animate({scrollTop:t.offset().top-r.FOCUS_OFFSET},250),t.focus())}},r.prototype.showErrors=function(t){var e=this.options.html?"html":"text",a=t.data("bs.validator.errors"),o=t.closest(".form-group"),r=o.find(".help-block.with-errors"),i=o.find(".form-control-feedback");a.length&&(a=s("<ul/>").addClass("list-unstyled").append(s.map(a,function(t){return s("<li/>")[e](t)})),void 0===r.data("bs.validator.originalContent")&&r.data("bs.validator.originalContent",r.html()),r.empty().append(a),o.addClass("has-error has-danger"),o.hasClass("has-feedback")&&i.removeClass(this.options.feedback.success)&&i.addClass(this.options.feedback.error)&&o.removeClass("has-success"))},r.prototype.clearErrors=function(t){var e=t.closest(".form-group"),a=e.find(".help-block.with-errors"),o=e.find(".form-control-feedback");a.html(a.data("bs.validator.originalContent")),e.removeClass("has-error has-danger has-success"),e.hasClass("has-feedback")&&o.removeClass(this.options.feedback.error)&&o.removeClass(this.options.feedback.success)&&n(t)&&o.addClass(this.options.feedback.success)&&e.addClass("has-success")},r.prototype.hasErrors=function(){return!!this.$inputs.filter(function(){return!!(s(this).data("bs.validator.errors")||[]).length}).length},r.prototype.isIncomplete=function(){return!!this.$inputs.filter("[required]").filter(function(){var t=n(s(this));return!("string"==typeof t?s.trim(t):t)}).length},r.prototype.onSubmit=function(t){this.validate(),(this.isIncomplete()||this.hasErrors())&&t.preventDefault()},r.prototype.toggleSubmit=function(){this.options.disable&&this.$btn.toggleClass("disabled",this.isIncomplete()||this.hasErrors())},r.prototype.defer=function(t,e){return e=s.proxy(e,this,t),this.options.delay?(window.clearTimeout(t.data("bs.validator.timeout")),void t.data("bs.validator.timeout",window.setTimeout(e,this.options.delay))):e()},r.prototype.reset=function(){return this.$element.find(".form-control-feedback").removeClass(this.options.feedback.error).removeClass(this.options.feedback.success),this.$inputs.removeData(["bs.validator.errors","bs.validator.deferred"]).each(function(){var t=s(this),e=t.data("bs.validator.timeout");window.clearTimeout(e)&&t.removeData("bs.validator.timeout")}),this.$element.find(".help-block.with-errors").each(function(){var t=s(this),e=t.data("bs.validator.originalContent");t.removeData("bs.validator.originalContent").html(e)}),this.$btn.removeClass("disabled"),this.$element.find(".has-error, .has-danger, .has-success").removeClass("has-error has-danger has-success"),this},r.prototype.destroy=function(){return this.reset(),this.$element.removeAttr("novalidate").removeData("bs.validator").off(".bs.validator"),this.$inputs.off(".bs.validator"),this.options=null,this.validators=null,this.$element=null,this.$btn=null,this.$inputs=null,this};var t=s.fn.validator;s.fn.validator=e,s.fn.validator.Constructor=r,s.fn.validator.noConflict=function(){return s.fn.validator=t,this},s(window).on("load",function(){s('form[data-toggle="validator"]').each(function(){var t=s(this);e.call(t,t.data())})})}(jQuery);