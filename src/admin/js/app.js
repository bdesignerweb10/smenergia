
$(function() {

// BEGIN LOGOUT (logout.php)
$("#logout").on("click", function(e) {
		e.preventDefault();

		$('#loading-modal').modal({
			keyboard: false
		});

		$.ajax({
			type: "POST",
			url: "acts/acts.logout.php",
			success: function(data)
			{
			    try {
					$('#loading-modal').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						document.cookie.split(";").forEach(function(c) { document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/"); });
						window.location.href = "./";
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						if(retorno.errno == "12010") {
							$('#alert').on('hidden.bs.modal', function (e) {
								window.location.href = 'provisoria';
							});
						}
					}
			    }
			    catch (e) {
					$('#loading-modal').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
	});
// END BEGIN LOGOUT (logout.php)

// BEGIN LOGIN (login.php)

	$("#form-login").submit(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});
		$.ajax({
			type: "POST",
			url: "acts/acts.login.php?act=login",
			data: $("#form-login").serialize(),
			success: function(data)
			{
			    try {	
			        var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					$('#loading').modal('hide');

					if(retorno.succeed) {
						window.location.href = 'home';
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						/*if(retorno.errno == "21010") {
							$('#alert').on('hidden.bs.modal', function (e) {
								window.location.href = '../provisoria';
							});
						}*/
					}
			    } // fecha try
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    }; // fecha catch
			}
		}); // fecha ajax
	}); // Fecha #form-login

	$('#btn-login').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

		$.ajax({
			type: "POST",
			url: "acts/acts.login.php?act=login",
			data: $("#form-login").serialize(),
			success: function(data)
			{
			    try {
			        var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					$('#loading').modal('hide');

					if(retorno.succeed) {
						window.location.href = 'home';
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						/*if(retorno.errno == "21010") {
							$('#alert').on('hidden.bs.modal', function (e) {
								window.location.href = '../provisoria';
							});
						}*/
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
	});

	// END LOGIN (login.php)

	/*GERENCIAR QUEM SOMOS */
	$('#btn-add-quemsomos').click(function(e) {
		e.preventDefault();

		$('.maintable').hide();
		$('.mainform').show();

		$('#btn-salvar-quemsomos').data('id', null);
    	$('#btn-salvar-quemsomos').data('act', 'add');    	

    	$('#id').val('');
    	$('#titulo').val('');
    	$('#descricao').val('');
    	$('#ativo').bootstrapToggle('off');		
    });


	$('#btn-salvar-quemsomos').click(function(e) {
    	e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');
    	var act = $(this).data('act');

    	if(act == "edit") {
    		var url = "acts/acts.quemsomos.php?act=" + act + "&id=" + id;
    	}
    	else {
    		var url = "acts/acts.quemsomos.php?act=" + act;
    	}

		$.ajax({
			type: "POST",
			url: url,
			data: $("#form-quemsomos").serialize(),
			success: function(data)
			{
				console.log('data', data);
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));
					if(retorno.succeed) {
						$('#alert-title').html($('#titulo').val() + (act == 'add' ? " adicionado " : " editado ") + "com sucesso!");
						$('#alert-content').html("A " + (act == 'add' ? " adição " : " edição ") + " de " + $('#titulo').val() + " foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						})
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

	$('.btn-edit-quemsomos').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.quemsomos.php?act=showupd&id=" + id,
			success: function(data)		
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('.maintable').hide();
						$('.mainform').show();

				    	$('#btn-salvar-quemsomos').data('act', 'edit');
				    	$('#btn-salvar-quemsomos').data('id', id);	    				

						//var d = new Date(retorno.dados.data * 1000);

				    	$('#id').val(retorno.dados.id);
				    	$('#titulo').val(retorno.dados.titulo);				    	
				    	$('#descricao').val(retorno.dados.descricao);
				    	//$('#ativo').bootstrapToggle(retorno.dados.ativo == 1 ? 'on' : 'off');				    	
					}
					else {
						$('.mainform').hide();
						$('.maintable').show();

				    	$('#btn-salvar-quemsomos').data('id', null);
				    	$('#btn-salvar-quemsomos').data('act', null);				    	

				    	$('#id').val('');
				    	$('#titulo').val('');				    	
				    	$('#descricao').val('');
				    	//$('#ativo').bootstrapToggle('off');				    	

						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {			    	
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

    $('.btn-del-quemsomos').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.quemsomos.php?act=del&id=" + id,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Evento removido com sucesso!");
						$('#alert-content').html("A remoção do evento foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

	$('#btn-voltar-quemsomos').click(function(e) {
		e.preventDefault();

		$('.mainform').hide();
		$('.maintable').show();

    	$('#btn-salvar-quemsomos').data('id', null);
    	$('#headline-ger-quemsomos').html('');
		$('.headline-form').html('');
    });	


	/* GERENCIAR CONSULTORES */	


	$('#btn-add-consultores').click(function(e) {
		e.preventDefault();

		$('.maintable').hide();
		$('.mainform').show();

		$('#btn-salvar-consultores').data('id', null);
    	$('#btn-salvar-consultores').data('act', 'add');    	

    	$('#id').val('');
    	$('#nome').val('');
    	$('#descricao').val('');    			
    });

	$('#btn-voltar-consultores').click(function(e) {
		e.preventDefault();

		$('.mainform').hide();
		$('.maintable').show();

    	$('#btn-salvar-consultores').data('id', null);
    	$('#headline-ger-consultores').html('');
		$('.headline-form').html('');
    });


$("#form-consultores").submit(function(e) {
		e.preventDefault();

		$('#loading-modal').modal({
			keyboard: false
		});

		var id = $('#btn-salvar-consultores').data('id');
    	var act = $('#btn-salvar-consultores').data('act');

    	if(act == "edit") {
    		var url = "acts/acts.consultores.php?act=" + act + "&id=" + id;
    	}
    	else {
    		var url = "acts/acts.consultores.php?act=" + act;    		
    	}

		var formData = new FormData();
		formData.append('id', $('#id').val());
		formData.append('nome', $('#nome').val());
		formData.append('img', $('#img')[0].files[0]);
		formData.append('descricao', $('#descricao').val());
		formData.append('ativo', $('#ativo').val());		

		$.ajax({
			type: "POST",
			url: url,
			data : formData,
			processData: false,
			contentType: false,
			success: function(data)
			{
			    try {
			    	console.log(data);
					$('#loading-modal').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#id').val('');
						$('#nome').val('');
						$('#img').val('');
						$('#descricao').val('');
						$('#ativo').val('');

						$('#alert-title').html("Dados alterados com sucesso!");
						$('#alert-content').html("Dados do consultor registrados com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						$('#id').val('');
						$('#nome').val('');
						$('#img').val('');
						$('#descricao').val('');
						$('#ativo').val('');
					}
			    }
			    catch (e) {
					$('#loading-modal').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');

					$('#id').val('');
					$('#nome').val('');
					$('#img').val('');
					$('#descricao').val('');
					$('#ativo').val('');
			    };
			}
		});
	});




   /*$('#btn-salvar-consultores').click(function(e) {
    	e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');
    	var act = $(this).data('act');

    	if(act == "edit") {
    		var url = "acts/acts.consultores.php?act=" + act + "&id=" + id;
    	}
    	else {
    		var url = "acts/acts.consultores.php?act=" + act;    		
    	}

    	console.log(url);
		$.ajax({
			type: "POST",
			url: url,						
			data: $("#form-consultores").serialize(),
			success: function(data)
			{				
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));
					if(retorno.succeed) {
						$('#alert-title').html($('#nome').val() + (act == 'add' ? " adicionado " : " editado ") + "com sucesso!");
						$('#alert-content').html("A " + (act == 'add' ? " adição " : " edição ") + " de " + $('#nome').val() + " foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						})
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });*/

    $('.btn-edit-consultores').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.consultores.php?act=showupd&id=" + id,
			success: function(data)		
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('.maintable').hide();
						$('.mainform').show();

				    	$('#btn-salvar-consultores').data('act', 'edit');
				    	$('#btn-salvar-consultores').data('id', id);	    				

						//var d = new Date(retorno.dados.data * 1000);

				    	$('#id').val(retorno.dados.id);
				    	$('#nome').val(retorno.dados.nome);				    	
				    	$('#descricao').val(retorno.dados.descricao);
				    	//$('#ativo').bootstrapToggle(retorno.dados.ativo == 1 ? 'on' : 'off');				    	
					}
					else {
						$('.mainform').hide();
						$('.maintable').show();

				    	$('#btn-salvar-consultores').data('id', null);
				    	$('#btn-salvar-consultores').data('act', null);				    	

				    	$('#id').val('');
				    	$('#nome').val('');				    	
				    	$('#descricao').val('');
				    	//$('#ativo').bootstrapToggle('off');				    	

						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {			    	
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

    $('.btn-del-consultores').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.consultores.php?act=del&id=" + id,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Consultor removido com sucesso!");
						$('#alert-content').html("A remoção do consultor foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });



    /* GERENCIAR SERVIÇOS */

	$('#btn-add-servicos').click(function(e) {
		e.preventDefault();

		$('.maintable').hide();
		$('.mainform').show();

		$('#btn-salvar-servicos').data('id', null);
    	$('#btn-salvar-servicos').data('act', 'add');    	

    	$('#id').val('');
    	$('#titulo').val('');
    	$('#descricao').val('');
    	$('#ativo').bootstrapToggle('off');		
    });


	$('#btn-salvar-servicos').click(function(e) {
    	e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');
    	var act = $(this).data('act');

    	if(act == "edit") {
    		var url = "acts/acts.servicos.php?act=" + act + "&id=" + id;
    	}
    	else {
    		var url = "acts/acts.servicos.php?act=" + act;
    	}

		$.ajax({
			type: "POST",
			url: url,
			data: $("#form-servicos").serialize(),
			success: function(data)
			{
				console.log('data', data);
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));
					if(retorno.succeed) {
						$('#alert-title').html($('#titulo').val() + (act == 'add' ? " adicionado " : " editado ") + "com sucesso!");
						$('#alert-content').html("A " + (act == 'add' ? " adição " : " edição ") + " de " + $('#titulo').val() + " foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						})
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

	$('.btn-edit-servicos').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.servicos.php?act=showupd&id=" + id,
			success: function(data)		
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('.maintable').hide();
						$('.mainform').show();

				    	$('#btn-salvar-servicos').data('act', 'edit');
				    	$('#btn-salvar-servicos').data('id', id);	    				

						//var d = new Date(retorno.dados.data * 1000);

				    	$('#id').val(retorno.dados.id);
				    	$('#titulo').val(retorno.dados.titulo);				    	
				    	$('#descricao').val(retorno.dados.descricao);
				    	//$('#ativo').bootstrapToggle(retorno.dados.ativo == 1 ? 'on' : 'off');				    	
					}
					else {
						$('.mainform').hide();
						$('.maintable').show();

				    	$('#btn-salvar-servicos').data('id', null);
				    	$('#btn-salvar-servicos').data('act', null);				    	

				    	$('#id').val('');
				    	$('#titulo').val('');				    	
				    	$('#descricao').val('');
				    	//$('#ativo').bootstrapToggle('off');				    	

						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {			    	
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

    $('.btn-del-servicos').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.servicos.php?act=del&id=" + id,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Evento removido com sucesso!");
						$('#alert-content').html("A remoção do evento foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

	$('#btn-voltar-servicos').click(function(e) {
		e.preventDefault();

		$('.mainform').hide();
		$('.maintable').show();

    	$('#btn-salvar-servicos').data('id', null);
    	$('#headline-ger-servicos').html('');
		$('.headline-form').html('');
    });


    /* GERENCIAR MISSÃO VISÃO E VALORES */

	$('#btn-add-missao').click(function(e) {
		e.preventDefault();

		$('.maintable').hide();
		$('.mainform').show();

		$('#btn-salvar-missao').data('id', null);
    	$('#btn-salvar-missao').data('act', 'add');    	

    	$('#id').val('');
    	$('#texto_missao').val('');
    	$('#texto_visao').val('');
    	$('#texto_valores').val('');
    	$('#ativo').bootstrapToggle('off');		
    });


	$('#btn-salvar-missao').click(function(e) {
    	e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');
    	var act = $(this).data('act');

    	if(act == "edit") {
    		var url = "acts/acts.missao.php?act=" + act + "&id=" + id;
    	}
    	else {
    		var url = "acts/acts.missao.php?act=" + act;
    	}

		$.ajax({
			type: "POST",
			url: url,
			data: $("#form-missao").serialize(),
			success: function(data)
			{
				console.log('data', data);
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));
					if(retorno.succeed) {
						$('#alert-title').html($('#texto_missao').val() + (act == 'add' ? " adicionado " : " editado ") + "com sucesso!");
						$('#alert-content').html("A " + (act == 'add' ? " adição " : " edição ") + " de " + $('#texto_missao').val() + " foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						})
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

	$('.btn-edit-missao').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.missao.php?act=showupd&id=" + id,
			success: function(data)		
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('.maintable').hide();
						$('.mainform').show();

				    	$('#btn-salvar-missao').data('act', 'edit');
				    	$('#btn-salvar-missao').data('id', id);	    				

						//var d = new Date(retorno.dados.data * 1000);

				    	$('#id').val(retorno.dados.id);
				    	$('#texto_missao').val(retorno.dados.texto_missao);				    	
				    	$('#texto_visao').val(retorno.dados.texto_visao);	
				    	$('#texto_valores').val(retorno.dados.texto_valores);	
				    	//$('#ativo').bootstrapToggle(retorno.dados.ativo == 1 ? 'on' : 'off');				    	
					}
					else {
						$('.mainform').hide();
						$('.maintable').show();

				    	$('#btn-salvar-missao').data('id', null);
				    	$('#btn-salvar-missao').data('act', null);				    	

				    	$('#id').val('');
				    	$('#texto_missao').val('');				    	
				    	$('#texto_visao').val('');
				    	$('#texto_valores').val('');
				    	//$('#ativo').bootstrapToggle('off');				    	

						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {			    	
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

    $('.btn-del-missao').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.missao.php?act=del&id=" + id,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Evento removido com sucesso!");
						$('#alert-content').html("A remoção do evento foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

	$('#btn-voltar-missao').click(function(e) {
		e.preventDefault();

		$('.mainform').hide();
		$('.maintable').show();

    	$('#btn-salvar-missao').data('id', null);
    	$('#headline-ger-missao').html('');
		$('.headline-form').html('');
    });


    /* GERENCIAR VOCÊ SABIA */


	$('#btn-add-sabia').click(function(e) {
		e.preventDefault();

		$('.maintable').hide();
		$('.mainform').show();

		$('#btn-salvar-sabia').data('id', null);
    	$('#btn-salvar-sabia').data('act', 'add');    	

    	$('#id').val('');
    	$('#pergunta').val('');
    	$('#resposta').val('');
    	$('#ativo').bootstrapToggle('off');		
    });


	$('#btn-salvar-sabia').click(function(e) {
    	e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');
    	var act = $(this).data('act');

    	if(act == "edit") {
    		var url = "acts/acts.sabia.php?act=" + act + "&id=" + id;
    	}
    	else {
    		var url = "acts/acts.sabia.php?act=" + act;
    	}

		$.ajax({
			type: "POST",
			url: url,
			data: $("#form-sabia").serialize(),
			success: function(data)
			{
				console.log('data', data);
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));
					if(retorno.succeed) {
						$('#alert-title').html($('#pergunta').val() + (act == 'add' ? " adicionado " : " editado ") + "com sucesso!");
						$('#alert-content').html("A " + (act == 'add' ? " adição " : " edição ") + " de " + $('#pergunta').val() + " foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						})
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

	$('.btn-edit-sabia').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.sabia.php?act=showupd&id=" + id,
			success: function(data)		
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('.maintable').hide();
						$('.mainform').show();

				    	$('#btn-salvar-sabia').data('act', 'edit');
				    	$('#btn-salvar-sabia').data('id', id);	    				

						//var d = new Date(retorno.dados.data * 1000);

				    	$('#id').val(retorno.dados.id);
				    	$('#pergunta').val(retorno.dados.pergunta);				    	
				    	$('#resposta').val(retorno.dados.resposta);
				    	//$('#ativo').bootstrapToggle(retorno.dados.ativo == 1 ? 'on' : 'off');				    	
					}
					else {
						$('.mainform').hide();
						$('.maintable').show();

				    	$('#btn-salvar-sabia').data('id', null);
				    	$('#btn-salvar-sabia').data('act', null);				    	

				    	$('#id').val('');
				    	$('#pergunta').val('');				    	
				    	$('#resposta').val('');
				    	//$('#ativo').bootstrapToggle('off');				    	

						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {			    	
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

    $('.btn-del-sabia').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.sabia.php?act=del&id=" + id,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Evento removido com sucesso!");
						$('#alert-content').html("A remoção do evento foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

	$('#btn-voltar-sabia').click(function(e) {
		e.preventDefault();

		$('.mainform').hide();
		$('.maintable').show();

    	$('#btn-salvar-sabia').data('id', null);
    	$('#headline-ger-sabia').html('');
		$('.headline-form').html('');
    });



    /* GERENCIAR CLIENTES E PARCEIROS */

    $('#btn-add-clipar').click(function(e) {
		e.preventDefault();

		$('.maintable').hide();
		$('.mainform').show();

		$('#btn-salvar-clipar').data('id', null);
    	$('#btn-salvar-clipar').data('act', 'add');    	

    	$('#id').val('');
    	$('#nome').val('');
    	$('#telefone').val(''); 
    	$('#cliente').bootstrapToggle('off'); 
    	$('#parceiro').bootstrapToggle('off');    		    		
    });

	$('#btn-voltar-clipar').click(function(e) {
		e.preventDefault();

		$('.mainform').hide();
		$('.maintable').show();

    	$('#btn-salvar-clipar').data('id', null);
    	$('#headline-ger-clipar').html('');
		$('.headline-form').html('');

		$('#id').val('');
    	$('#nome').val('');
    	$('#telefone').val('');
    	$('#cliente').bootstrapToggle('off');
    	$('#parceiro').bootstrapToggle('off');
    });


$("#form-clipar").submit(function(e) {
		e.preventDefault();

		$('#loading-modal').modal({
			keyboard: false
		});

		var id = $('#btn-salvar-clipar').data('id');
    	var act = $('#btn-salvar-clipar').data('act');

    	if(act == "edit") {
    		var url = "acts/acts.clipar.php?act=" + act + "&id=" + id;
    	}
    	else {
    		var url = "acts/acts.clipar.php?act=" + act;    		
    	}

		var formData = new FormData();
		formData.append('id', $('#id').val());
		formData.append('nome', $('#nome').val());
		formData.append('telefone', $('#telefone').val());
		formData.append('img', $('#img')[0].files[0]);
		formData.append('cliente', $('#cliente').val());
		formData.append('parceiro', $('#parceiro').val());		

		$.ajax({
			type: "POST",
			url: url,
			data : formData,
			processData: false,
			contentType: false,
			success: function(data)
			{
			    try {
			    	console.log(data);
					$('#loading-modal').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#id').val('');
						$('#nome').val('');
						$('#telefone').val('');
						$('#img').val('');
						$('#cliente').val('');
						$('#parceiro').val('');

						$('#alert-title').html("Dados alterados com sucesso!");
						$('#alert-content').html("Dados de clientes/parceiros registrados com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						$('#id').val('');
						$('#nome').val('');
						$('#telefone').val('');
						$('#img').val('');
						$('#cliente').val('');
						$('#parceiro').val('');
					}
			    }
			    catch (e) {
					$('#loading-modal').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');

					$('#id').val('');
						$('#nome').val('');
						$('#telefone').val('');
						$('#img').val('');
						$('#cliente').val('');
						$('#parceiro').val('');
			    };
			}
		});
	});

   

    $('.btn-edit-clipar').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.clipar.php?act=showupd&id=" + id,
			success: function(data)		
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('.maintable').hide();
						$('.mainform').show();

				    	$('#btn-salvar-clipar').data('act', 'edit');
				    	$('#btn-salvar-clipar').data('id', id);	    				

						//var d = new Date(retorno.dados.data * 1000);

				    	$('#id').val(retorno.dados.id);
				    	$('#nome').val(retorno.dados.nome);				    	
				    	$('#telefone').val(retorno.dados.telefone);				    	
				    	$('#cliente').bootstrapToggle(retorno.dados.cliente == 1 ? 'on' : 'off');	
				    	$('#parceiro').bootstrapToggle(retorno.dados.parceiro == 1 ? 'on' : 'off');				    	
					}
					else {
						$('.mainform').hide();
						$('.maintable').show();

				    	$('#btn-salvar-clipar').data('id', null);
				    	$('#btn-salvar-clipar').data('act', null);				    	

				    	$('#id').val('');
				    	$('#nome').val('');				    	
				    	$('#telefone').val('');
				    	$('#cliente').bootstrapToggle('off');
				    	$('#parceiro').bootstrapToggle('off');				    			    	

						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {			    	
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

    $('.btn-del-clipar').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.clipar.php?act=del&id=" + id,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Clientes / Parceiros removido com sucesso!");
						$('#alert-content').html("A remoção do Cliente / Parceiro foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

});
/*!
 * Validator v0.11.9 for Bootstrap 3, by @1000hz
 * Copyright 2017 Cina Saffary
 * Licensed under http://opensource.org/licenses/MIT
 *
 * https://github.com/1000hz/bootstrap-validator
 */

+function(a){"use strict";function b(b){return b.is('[type="checkbox"]')?b.prop("checked"):b.is('[type="radio"]')?!!a('[name="'+b.attr("name")+'"]:checked').length:b.is("select[multiple]")?(b.val()||[]).length:b.val()}function c(b){return this.each(function(){var c=a(this),e=a.extend({},d.DEFAULTS,c.data(),"object"==typeof b&&b),f=c.data("bs.validator");(f||"destroy"!=b)&&(f||c.data("bs.validator",f=new d(this,e)),"string"==typeof b&&f[b]())})}var d=function(c,e){this.options=e,this.validators=a.extend({},d.VALIDATORS,e.custom),this.$element=a(c),this.$btn=a('button[type="submit"], input[type="submit"]').filter('[form="'+this.$element.attr("id")+'"]').add(this.$element.find('input[type="submit"], button[type="submit"]')),this.update(),this.$element.on("input.bs.validator change.bs.validator focusout.bs.validator",a.proxy(this.onInput,this)),this.$element.on("submit.bs.validator",a.proxy(this.onSubmit,this)),this.$element.on("reset.bs.validator",a.proxy(this.reset,this)),this.$element.find("[data-match]").each(function(){var c=a(this),d=c.attr("data-match");a(d).on("input.bs.validator",function(){b(c)&&c.trigger("input.bs.validator")})}),this.$inputs.filter(function(){return b(a(this))&&!a(this).closest(".has-error").length}).trigger("focusout"),this.$element.attr("novalidate",!0)};d.VERSION="0.11.9",d.INPUT_SELECTOR=':input:not([type="hidden"], [type="submit"], [type="reset"], button)',d.FOCUS_OFFSET=20,d.DEFAULTS={delay:500,html:!1,disable:!0,focus:!0,custom:{},errors:{match:"Does not match",minlength:"Not long enough"},feedback:{success:"glyphicon-ok",error:"glyphicon-remove"}},d.VALIDATORS={"native":function(a){var b=a[0];return b.checkValidity?!b.checkValidity()&&!b.validity.valid&&(b.validationMessage||"error!"):void 0},match:function(b){var c=b.attr("data-match");return b.val()!==a(c).val()&&d.DEFAULTS.errors.match},minlength:function(a){var b=a.attr("data-minlength");return a.val().length<b&&d.DEFAULTS.errors.minlength}},d.prototype.update=function(){var b=this;return this.$inputs=this.$element.find(d.INPUT_SELECTOR).add(this.$element.find('[data-validate="true"]')).not(this.$element.find('[data-validate="false"]').each(function(){b.clearErrors(a(this))})),this.toggleSubmit(),this},d.prototype.onInput=function(b){var c=this,d=a(b.target),e="focusout"!==b.type;this.$inputs.is(d)&&this.validateInput(d,e).done(function(){c.toggleSubmit()})},d.prototype.validateInput=function(c,d){var e=(b(c),c.data("bs.validator.errors"));c.is('[type="radio"]')&&(c=this.$element.find('input[name="'+c.attr("name")+'"]'));var f=a.Event("validate.bs.validator",{relatedTarget:c[0]});if(this.$element.trigger(f),!f.isDefaultPrevented()){var g=this;return this.runValidators(c).done(function(b){c.data("bs.validator.errors",b),b.length?d?g.defer(c,g.showErrors):g.showErrors(c):g.clearErrors(c),e&&b.toString()===e.toString()||(f=b.length?a.Event("invalid.bs.validator",{relatedTarget:c[0],detail:b}):a.Event("valid.bs.validator",{relatedTarget:c[0],detail:e}),g.$element.trigger(f)),g.toggleSubmit(),g.$element.trigger(a.Event("validated.bs.validator",{relatedTarget:c[0]}))})}},d.prototype.runValidators=function(c){function d(a){return c.attr("data-"+a+"-error")}function e(){var a=c[0].validity;return a.typeMismatch?c.attr("data-type-error"):a.patternMismatch?c.attr("data-pattern-error"):a.stepMismatch?c.attr("data-step-error"):a.rangeOverflow?c.attr("data-max-error"):a.rangeUnderflow?c.attr("data-min-error"):a.valueMissing?c.attr("data-required-error"):null}function f(){return c.attr("data-error")}function g(a){return d(a)||e()||f()}var h=[],i=a.Deferred();return c.data("bs.validator.deferred")&&c.data("bs.validator.deferred").reject(),c.data("bs.validator.deferred",i),a.each(this.validators,a.proxy(function(a,d){var e=null;!b(c)&&!c.attr("required")||void 0===c.attr("data-"+a)&&"native"!=a||!(e=d.call(this,c))||(e=g(a)||e,!~h.indexOf(e)&&h.push(e))},this)),!h.length&&b(c)&&c.attr("data-remote")?this.defer(c,function(){var d={};d[c.attr("name")]=b(c),a.get(c.attr("data-remote"),d).fail(function(a,b,c){h.push(g("remote")||c)}).always(function(){i.resolve(h)})}):i.resolve(h),i.promise()},d.prototype.validate=function(){var b=this;return a.when(this.$inputs.map(function(){return b.validateInput(a(this),!1)})).then(function(){b.toggleSubmit(),b.focusError()}),this},d.prototype.focusError=function(){if(this.options.focus){var b=this.$element.find(".has-error :input:first");0!==b.length&&(a("html, body").animate({scrollTop:b.offset().top-d.FOCUS_OFFSET},250),b.focus())}},d.prototype.showErrors=function(b){var c=this.options.html?"html":"text",d=b.data("bs.validator.errors"),e=b.closest(".form-group"),f=e.find(".help-block.with-errors"),g=e.find(".form-control-feedback");d.length&&(d=a("<ul/>").addClass("list-unstyled").append(a.map(d,function(b){return a("<li/>")[c](b)})),void 0===f.data("bs.validator.originalContent")&&f.data("bs.validator.originalContent",f.html()),f.empty().append(d),e.addClass("has-error has-danger"),e.hasClass("has-feedback")&&g.removeClass(this.options.feedback.success)&&g.addClass(this.options.feedback.error)&&e.removeClass("has-success"))},d.prototype.clearErrors=function(a){var c=a.closest(".form-group"),d=c.find(".help-block.with-errors"),e=c.find(".form-control-feedback");d.html(d.data("bs.validator.originalContent")),c.removeClass("has-error has-danger has-success"),c.hasClass("has-feedback")&&e.removeClass(this.options.feedback.error)&&e.removeClass(this.options.feedback.success)&&b(a)&&e.addClass(this.options.feedback.success)&&c.addClass("has-success")},d.prototype.hasErrors=function(){function b(){return!!(a(this).data("bs.validator.errors")||[]).length}return!!this.$inputs.filter(b).length},d.prototype.isIncomplete=function(){function c(){var c=b(a(this));return!("string"==typeof c?a.trim(c):c)}return!!this.$inputs.filter("[required]").filter(c).length},d.prototype.onSubmit=function(a){this.validate(),(this.isIncomplete()||this.hasErrors())&&a.preventDefault()},d.prototype.toggleSubmit=function(){this.options.disable&&this.$btn.toggleClass("disabled",this.isIncomplete()||this.hasErrors())},d.prototype.defer=function(b,c){return c=a.proxy(c,this,b),this.options.delay?(window.clearTimeout(b.data("bs.validator.timeout")),void b.data("bs.validator.timeout",window.setTimeout(c,this.options.delay))):c()},d.prototype.reset=function(){return this.$element.find(".form-control-feedback").removeClass(this.options.feedback.error).removeClass(this.options.feedback.success),this.$inputs.removeData(["bs.validator.errors","bs.validator.deferred"]).each(function(){var b=a(this),c=b.data("bs.validator.timeout");window.clearTimeout(c)&&b.removeData("bs.validator.timeout")}),this.$element.find(".help-block.with-errors").each(function(){var b=a(this),c=b.data("bs.validator.originalContent");b.removeData("bs.validator.originalContent").html(c)}),this.$btn.removeClass("disabled"),this.$element.find(".has-error, .has-danger, .has-success").removeClass("has-error has-danger has-success"),this},d.prototype.destroy=function(){return this.reset(),this.$element.removeAttr("novalidate").removeData("bs.validator").off(".bs.validator"),this.$inputs.off(".bs.validator"),this.options=null,this.validators=null,this.$element=null,this.$btn=null,this.$inputs=null,this};var e=a.fn.validator;a.fn.validator=c,a.fn.validator.Constructor=d,a.fn.validator.noConflict=function(){return a.fn.validator=e,this},a(window).on("load",function(){a('form[data-toggle="validator"]').each(function(){var b=a(this);c.call(b,b.data())})})}(jQuery);	