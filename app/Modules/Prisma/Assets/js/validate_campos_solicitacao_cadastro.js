$('#formulario').validate({
	errorElement: 'div',
	focusInvalid: false,
	ignore: ".ignore",
	errorClass: 'help-block',
	rules: {
		no_razao_social: {
			required: true
		},
		no_relatorio: {
			required: true
		},
		no_situacao: {
			required: true
		},
		nr_telefone: {
			required: true
		},
		ds_email: {
			required: true,
			email: true
		},
		ed_logradouro: {
			required: true
		},
		ed_numero_logradouro: {
			required: true
		},
		ed_complemento_logradouro: {
			required: true
		},
		ed_cep_logradouro: {
			required: true
		},
		ed_municipio_logradouro: {
			required: true
		},
		ed_sigla_uf: {
			required: true
		},

		nr_cpf_responsavel: {
			required: true
		},
		no_responsavel: {
			required: true
		},
		nr_telefone_responsavel: {
			required: true
		},
		ds_email_responsavel: {
			required: true,
			email: true
		},
		no_cargo_responsavel: {
			required: false
		},
		nr_cpf_editor: {
			required: false
		},
		noeditor: {
			required: false
		},
		nr_telefone_editor: {
			required: false
		},
		ds_email_editor[]: {
			required: false,
			email: true
		}
	},
	messages: {
		no_razao_social: {
			required: ""
		},
		no_relatorio: {
			required: ""
		},
		no_situacao: {
			required: ""
		},
		nr_telefone: {
			required: ""
		},
		ds_email: {
			required: "",
			email: "Favor informar um email válido."
		},
		ed_logradouro: {
			required: ""
		},
		ed_numero_logradouro: {
			required: ""
		},
		ed_complemento_logradouro: {
			required: ""
		},
		ed_cep_logradouro: {
			required: ""
		},
		ed_municipio_logradouro: {
			required: ""
		},
		ed_sigla_uf: {
			required: ""
		},

		nr_cpf_responsavel: {
			required: ""
		},
		no_responsavel: {
			required: ""
		},
		nr_telefone_responsavel: {
			required: ""
		},
		ds_email_responsavel: {
			required: "",
			email: "Favor informar um email válido."
		},
		no_cargo_responsavel: {
			required: ""
		},

		nr_cpf_editor: {
			required: ""
		},
		no_editor: {
			required: ""
		},
		nr_telefone_editor: {
			required: ""
		},
		ds_email_editor[]: {
			required: "",
			email: "Favor informar um email válido."
		}
	},
	
	highlight: function (e) {
		$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
	},
	unhighlight: function(e) {
		$(e).closest('.form-group').removeClass('has-error');
	},
	success: function (e) {
		$(e).closest('.form-group').removeClass('has-error');
		$(e).remove();
	},
	errorPlacement: function (error, element) {
		if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
			var controls = element.closest('div[class*="col-"]');
			if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
			else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
		}
		else if(element.is('.select2')) {
			error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
		}
		else if(element.is('.chosen-select')) {
			error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
		}
		else if(element.is('.date-picker')) {
			error.insertAfter(element.siblings('[class*="date-picker"]:eq(0)'));
		}
		else error.insertAfter(element.parent());
	},
	submitHandler: function (form) {
	},
	invalidHandler: function (form) {
	}
});