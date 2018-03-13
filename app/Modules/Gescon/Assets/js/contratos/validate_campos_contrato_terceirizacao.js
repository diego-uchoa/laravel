$('#formulario').validate({
	errorElement: 'div',
	focusInvalid: false,
	ignore: ".ignore",
	errorClass: 'help-block',
	rules: {
		nr_contrato: {
			required: true
		},
		co_uasg: {
			required: true
		},
		in_tipo: {
			required: true
		},
		nr_modalidade: {
			required: true
		},
		id_modalidade: {
			required: true
		},
		nr_processo: {
			required: true
		},
		nr_cpf_cnpj: {
			required: true
		},
		no_razao_social: {
			required: true
		},
		ed_cep_logradouro: {
			required: true
		},
		ed_logradouro: {
			required: true
		},
		id_municipio_logradouro: {
			required: true
		},
		no_representante: {
			required: true
		},
		nr_telefone: {
			required: true
		},
		no_preposto: {
			required: true
		},
		nr_telefone_preposto: {
			required: true
		},
		ds_email_preposto: {
			required: true,
			email:true
		},
		ds_objeto: {
			required: true
		},
		vl_mensal: {
			required: true
		},
		vl_anual: {
			required: true
		},
		vl_global: {
			required: true
		},
		id_unidade_atendida: {
			required: true
		},
		id_edificio_atendido: {
			required: true
		},
		id_tipo_item: {
			required: true
		},
		qt_item_contratacao: {
			required: true
		},
		id_unidade_medida: {
			required: true
		},
		vl_item_contratacao: {
			required: true
		},
		dt_assinatura: {
			required: true
		},
		dt_publicacao: {
			required: true
		},
		dt_inicio_servico: {
			required: true
		},
		dt_prorrogacao: {
			required: true
		},
		nr_nota_empenho: {
			required: true
		},
		tp_nota_empenho: {
			required: true
		},
		nr_plano_interno: {
			required: true
		},
		nr_elemento_despesa: {
			required: true
		},
		id_informacao: {
			required: true
		},
		ds_informacao: {
			required: true
		},
		in_tipo_fiscal: {
			required: true
		},
        nr_cpf_titular: {
			required: true
		},
        no_titular: {
			required: true
		},
        nr_matricula_titular: {
			required: true
		},
        ds_email_titular: {
			required: true,
			email:true
		},
        nr_telefone_titular: {
			required: true
		},
        nr_cpf_substituto: {
			required: true
		},
        no_substituto: {
			required: true
		},
        nr_matricula_substituto: {
			required: true
		},
        ds_email_substituto: {
			required: true,
			email:true
		},
        nr_telefone_substituto: {
			required: true
		},
        nr_portaria: {
			required: true
		},
        dt_inicio_fiscal: {
			required: true
		},
        nr_boletim: {
			required: true
		}
	},

	messages: {
		nr_contrato: {
			required: ""
		},
		co_uasg: {
			required: ""
		},
		in_tipo: {
			required: ""
		},
		nr_modalidade: {
			required: ""
		},
		id_modalidade: {
			required: ""
		},
		nr_processo: {
			required: ""
		},
		nr_cpf_cnpj: {
			required: ""
		},
		no_razao_social: {
			required: ""
		},
		ed_cep_logradouro: {
			required: ""
		},
		ed_logradouro: {
			required: ""
		},
		id_municipio_logradouro: {
			required: ""
		},
		no_representante: {
			required: ""
		},
		nr_telefone: {
			required: ""
		},
		no_preposto: {
			required: "",
		},
		nr_telefone_preposto: {
			required: "",
		},
		ds_email_preposto: {
			required: "",
			email: "Favor informar um email válido."
		},
		ds_objeto: {
			required: ""
		},
		vl_mensal: {
			required: ""
		},
		vl_anual: {
			required: ""
		},
		vl_global: {
			required: ""
		},
		id_unidade_atendida: {
			required: ""
		},
		id_edificio_atendido: {
			required: ""
		},
		id_tipo_item: {
			required: ""
		},
		qt_item_contratacao: {
			required: ""
		},
		id_unidade_medida: {
			required: ""
		},
		vl_item_contratacao: {
			required: ""
		},
		dt_assinatura: {
			required: ""
		},
		dt_publicacao: {
			required: ""
		},
		dt_inicio_servico: {
			required: ""
		},
		dt_prorrogacao: {
			required: ""
		},
		nr_nota_empenho: {
			required: ""
		},
		tp_nota_empenho: {
			required: ""
		},
		nr_plano_interno: {
			required: ""
		},
		nr_elemento_despesa: {
			required: ""
		},
		id_informacao: {
			required: ""
		},
		ds_informacao: {
			required: ""
		},
		in_tipo_fiscal: {
			required: ""
		},
        nr_cpf_titular: {
			required: ""
		},
        no_titular: {
			required: ""
		},
        nr_matricula_titular: {
			required: ""
		},
        ds_email_titular: {
			required: "",
			email: "Favor informar um email válido."
		},
        nr_telefone_titular: {
			required: ""
		},
        nr_cpf_substituto: {
			required: ""
		},
        no_substituto: {
			required: ""
		},
        nr_matricula_substituto: {
			required: ""
		},
        ds_email_substituto: {
			required: "",
			email: "Favor informar um email válido."
		},
        nr_telefone_substituto: {
			required: ""
		},
        nr_portaria: {
			required: ""
		},
        dt_inicio_fiscal: {
			required: ""
		},
        nr_boletim: {
			required: ""
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