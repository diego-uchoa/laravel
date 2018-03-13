<div class="row">
    <div class="col-xs-1 col-sm-1"></div>
      <div class="col-xs-12 col-sm-10">
          <div class="widget-box widget-color-grey">
              <div class="widget-header widget-header-small">
                  <h5 class="widget-title">DADOS DA CONTRATADA</strong></h5>
              </div>
              <div class="widget-body">
                  <div class="widget-main">
                      <div class="row div-row-border-bottom">
                          <div class="col-xs-12 col-sm-2 div-column-border-right">
                              <strong>Tipo Contratada</strong> <br>
                              {{ isset($contratada) ? $contratada->descricao_tipo_contratada : null }}
                          </div>
                          <div class="col-xs-12 col-sm-2 div-column-border-right">
                              <strong>CPF/CNPJ</strong> <br>
                              {{ isset($contratada) ? $contratada->nr_cpf_cnpj : null }}
                          </div>
                          <div class="col-xs-12 col-sm-8">
                              <strong>Razão Social</strong> <br>
                              {{ isset($contratada) ? $contratada->no_razao_social : null }}
                          </div>
                      </div>
                      <div class="row div-row-border-bottom">
                          <div class="col-xs-12 col-sm-2 div-column-border-right">
                              <strong>CEP</strong> <br>
                              {{ isset($contratada) ? $contratada->ed_cep_logradouro : null }}
                          </div>
                          <div class="col-xs-12 col-sm-8 div-column-border-right">
                              <strong>Logradouro</strong> <br>
                              {{ isset($contratada) ? $contratada->ed_logradouro : null }}
                          </div>
                          <div class="col-xs-12 col-sm-2">
                              <strong>Numero</strong> <br>
                              {{ isset($contratada) ? $contratada->ed_numero_logradouro : null }}
                          </div>
                      </div>
                      <div class="row" style="padding-top: 4px; padding-bottom: 8px;">
                          <div class="col-xs-12 col-sm-6 div-column-border-right">
                              <strong>Representante</strong> <br>
                              {{ isset($contratada) ? $contratada->no_representante : null }}
                          </div>
                          <div class="col-xs-12 col-sm-4 div-column-border-right">
                              <strong>Email</strong> <br>
                              {{ isset($contratada) ? $contratada->ds_email : null }}
                          </div>
                          <div class="col-xs-12 col-sm-2">
                              <strong>Telefone</strong> <br>
                              {{ isset($contratada) ? $contratada->nr_telefone : null }}
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-xs-12">
                              <div class="widget-box">
                                  <div class="widget-body">
                                      <div class="widget-main">
                                          <div class="row">
                                              <div class="col-xs-12 col-sm-12">
                                                  <h5 class="header smaller lighter grey">LISTA DE PREPOSTOS</h5>
                                              </div>
                                          </div>
                                          <div class="row div-row-border-bottom">
                                              <div class="col-xs-12 col-sm-6 div-column-border-right">
                                                  <strong>Nome</strong> <br>
                                              </div>
                                              <div class="col-xs-12 col-sm-4 div-column-border-right">
                                                  <strong>Email</strong> <br>
                                              </div>
                                              <div class="col-xs-12 col-sm-2">
                                                  <strong>Telefone</strong> <br>
                                              </div>
                                          </div>
                                          @if (isset($contrato))

                                              @foreach ($contrato->prepostos as $preposto)

                                                  <div class="row div-row-border-bottom">
                                                      <div class="col-xs-12 col-sm-6 div-column-border-right">
                                                          {{ $preposto->no_preposto }}
                                                      </div>
                                                      <div class="col-xs-12 col-sm-4 div-column-border-right">
                                                          {{ $preposto->ds_email_preposto }}
                                                      </div>
                                                      <div class="col-xs-12 col-sm-2">
                                                          {{ $preposto->nr_telefone_preposto }}
                                                      </div>
                                                  </div>  

                                              @endforeach

                                          @endif
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xs-1 col-sm-1"></div>
  </div>