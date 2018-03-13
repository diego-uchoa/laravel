document.write('<script src="/assets/js/select2-4.0.3.min.js" type="text/javascript"></script>');
document.write('<script src="/assets/js/i18n/pt-BR.js" type="text/javascript"><\/script>');
document.write('<script src="/assets/js/chosen.jquery.min.js" type="text/javascript"></script>');

$.fn.select2_select = function(id_campo, url) {
    var url = url; 
    $('#'+id_campo).select2({
        
        placeholder: "Selecione...",
        minimumInputLength: 2,
        language: "pt-BR",
        ajax: {
            url: url,
            dataType: 'json',
            data: function (params) {
                return {
                    parametro: $.trim(params.term)
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
    
    });
    
};


$.fn.chosen_select = function() {
    
    if(!ace.vars['touch']) {
        $('.chosen-select').chosen({allow_single_deselect:true}); 
        //resize the chosen on window resize
        $(window)
        .off('resize.chosen')
        .on('resize.chosen', function() {
            $('.chosen-select').each(function() {
                 var $this = $(this);
                 $this.next().css({'width': $this.parent().width()});
            })
        }).trigger('resize.chosen');
        //resize chosen on sidebar collapse/expand
        $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
            if(event_name != 'sidebar_collapsed') return;
            $('.chosen-select').each(function() {
                 var $this = $(this);
                 $this.next().css({'width': $this.parent().width()});
            })
        });
    }

};