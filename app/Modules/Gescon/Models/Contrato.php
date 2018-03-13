<?php

namespace App\Modules\Gescon\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Gescon\Enum\TipoContrato;
use App\Modules\Gescon\Enum\TipoVariacao;
use App\Modules\Gescon\Enum\ModalidadeGarantia;
use App\Modules\Gescon\Enum\ObjetoContrato;
use App\Modules\Gescon\Enum\StatusContrato;
use Carbon\Carbon;
use MaskHelper;

/**
 * Class Contrato
 * @package App\Modules\Gescon\Models
 * @version October 30, 2017, 2:13 pm BRST
 */
class Contrato extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_gescon.contrato';
    
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_contrato';

    public $fillable = [
        'nr_contrato',
        'co_uasg',
        'id_contratante',
        'id_contratante_representante',
        'id_contratante_assinante',
        'in_tipo',
        'nr_modalidade',
        'id_modalidade',
        'nr_ano',
        'nr_processo',
        'nr_cronograma',
        'tx_arquivo_modalidade',
        'tx_arquivo_contrato',
        'tx_arquivo_ata',
        'id_contratada',
        'in_objeto',
        'ds_objeto',
        'ds_informacao_complementar',
        'vl_mensal',
        'vl_anual',
        'vl_global',
        'dt_assinatura',
        'dt_publicacao',
        'dt_inicio_servico',
        'dt_cessacao',
        'nr_ano_prorrogacao',
        'dt_prorrogacao',
        'in_tipo_variacao',
        'id_indice_variacao',
        'in_modalidade_garantia',
        'vl_garantia',
        'op_percentual_garantia',
        'dt_vencimento_garantia',
        'in_status_contrato',
        'ds_justificativa',
        'dt_encerramento',
        'nr_cpf_encerramento',
        'in_status_contrato',
        'ds_justificativa',
        'dt_encerramento',
        'nr_cpf_encerramento'
    ];


    public function setNrProcessoAttribute($value){
        $nr_processo = str_replace(".", "", $value);
        $nr_processo = str_replace("/", "", $nr_processo);
        $nr_processo = str_replace("-", "", $nr_processo);

        return $this->attributes['nr_processo'] = $nr_processo;
    }
    
    public function setNrModalidadeAttribute($value){
        $nr_modalidade = str_replace("/", "", $value);
        return $this->attributes['nr_modalidade'] = $nr_modalidade;
    }

    public function setNrContratoAttribute($value){
        $nr_contrato = str_replace("/", "", $value);
        return $this->attributes['nr_contrato'] = $nr_contrato;
    }

    public function getNrContratoAttribute(){
        return MaskHelper::aplicaMascara($this->attributes['nr_contrato'],'####/####');    
    }    

    public function getNrCronogramaAttribute(){
        return MaskHelper::aplicaMascara($this->attributes['nr_cronograma'],'####/####');    
    }

    public function setNrCronogramaAttribute($value){
        $nr_cronograma = str_replace("/", "", $value);
        return $this->attributes['nr_cronograma'] = $nr_cronograma;
    }

    public function getDtVencimentoGarantiaAttribute(){
       return Carbon::parse($this->attributes['dt_vencimento_garantia'])->format('d/m/Y');
    }

    public function setDtVencimentoGarantiaAttribute($value){
        if (strlen($value) > 0){
            try{
                return $this->attributes['dt_vencimento_garantia'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }catch(\Exception $e){
                return $this->attributes['dt_vencimento_garantia'] = date('Y-m-d');
            }
        }else{
            return $this->attributes['dt_vencimento_garantia'] = null;
        }
    }

    public function getDtProrrogacaoAttribute(){
       return Carbon::parse($this->attributes['dt_prorrogacao'])->format('d/m/Y');
    }

    public function setDtProrrogacaoAttribute($value){
        if (strlen($value) > 0){
            try{
                return $this->attributes['dt_prorrogacao'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }catch(\Exception $e){
                return $this->attributes['dt_prorrogacao'] = date('Y-m-d');
            }
        }
    }

    public function getDtCessacaoAttribute(){
       return Carbon::parse($this->attributes['dt_cessacao'])->format('d/m/Y');
    }

    public function setDtCessacaoAttribute($value){
        if (strlen($value) > 0){
            try{
                return $this->attributes['dt_cessacao'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }catch(\Exception $e){
                return $this->attributes['dt_cessacao'] = date('Y-m-d');
            }
        }else{
            return $this->attributes['dt_cessacao'] = null;
        }
    }

    public function getDtInicioServicoAttribute(){
       return Carbon::parse($this->attributes['dt_inicio_servico'])->format('d/m/Y');
    }

    public function setDtInicioServicoAttribute($value){
        if (strlen($value) > 0){
            try{
                return $this->attributes['dt_inicio_servico'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }catch(\Exception $e){
                return $this->attributes['dt_inicio_servico'] = date('Y-m-d');
            }
        }
    }

    public function getDtPublicacaoAttribute(){
       return Carbon::parse($this->attributes['dt_publicacao'])->format('d/m/Y');
    }

    public function setDtPublicacaoAttribute($value){
        if (strlen($value) > 0){
            try{
                return $this->attributes['dt_publicacao'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }catch(\Exception $e){
                return $this->attributes['dt_publicacao'] = date('Y-m-d');
            }
        }
    }

    public function getDtAssinaturaAttribute(){
       return Carbon::parse($this->attributes['dt_assinatura'])->format('d/m/Y');
    }

    public function setDtAssinaturaAttribute($value){
        if (strlen($value) > 0){
            try{
                return $this->attributes['dt_assinatura'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }catch(\Exception $e){
                return $this->attributes['dt_assinatura'] = date('Y-m-d');
            }
        }
    }

    public function setVlMensalAttribute($value) {
        $vl_mensal = str_replace(".", "", $value);
        $vl_mensal = str_replace(",", ".", $vl_mensal);

        return $this->attributes['vl_mensal'] = $vl_mensal;
    }

    public function getVlMensalAttribute() {
        $vl_mensal = number_format($this->attributes['vl_mensal'], 2, ',', '.');

        return $vl_mensal;
    }

    public function setVlAnualAttribute($value) {
        $vl_anual = str_replace(".", "", $value);
        $vl_anual = str_replace(",", ".", $vl_anual);

        return $this->attributes['vl_anual'] = $vl_anual;
    }

    public function getVlAnualAttribute() {
        $vl_anual = number_format($this->attributes['vl_anual'], 2, ',', '.');

        return $vl_anual;
    }

    public function setVlGlobalAttribute($value) {
        $vl_global = str_replace(".", "", $value);
        $vl_global = str_replace(",", ".", $vl_global);

        return $this->attributes['vl_global'] = $vl_global;
    }

    public function getVlGlobalAttribute() {
        $vl_global = number_format($this->attributes['vl_global'], 2, ',', '.');

        return $vl_global;
    }

    public function setVlGarantiaAttribute($value) {
        if ($value != ""){
            $vl_garantia = str_replace(".", "", $value);
            $vl_garantia = str_replace(",", ".", $vl_garantia);

            return $this->attributes['vl_garantia'] = $vl_garantia;
        }else{
            return $this->attributes['vl_garantia'] = null;
        }
    }

    public function getVlGarantiaAttribute() {
        $vl_garantia = str_replace(".", ",", $this->attributes['vl_garantia']);

        return $vl_garantia;
    }

    public function setOpPercentualGarantiaAttribute($value) {
        if ($value != ""){
            $op_percentual_garantia = str_replace(".", "", $value);
            $op_percentual_garantia = str_replace(",", ".", $op_percentual_garantia);

            return $this->attributes['op_percentual_garantia'] = $op_percentual_garantia;
        }else{
            return $this->attributes['op_percentual_garantia'] = null;    
        }
    }

    public function getOpPercentualGarantiaAttribute() {
        $op_percentual_garantia = str_replace(".", ",", $this->attributes['op_percentual_garantia']);

        return $op_percentual_garantia;
    }

    public function getPrazoVencimentoAttribute()
    {
        $dataInicio = Carbon::now();
        $dataCessacao = Carbon::createFromFormat('Y-m-d', $this->attributes['dt_cessacao']);
        return $dataInicio->copy()->diffInDays($dataCessacao, false);
    }

    public function getRotaVisualizacaoContratoAttribute()
    {
        switch ($this->attributes['in_objeto']) {

            case ("TR" || "VG" || "BG" || "LP"):
                return url('gescon/contratos/terceirizacao/show/'.$this->attributes['id_contrato'].'');
                break;
        }
    }    

    public function getRotaEdicaoContratoAttribute()
    {
        switch ($this->attributes['in_objeto']) {

            case ("TR" || "VG" || "BG" || "LP"):
                return url('gescon/contratos/terceirizacao/edit/'.$this->attributes['id_contrato'].'');
                break;
        }
    } 

    public function getDtEncerramentoAttribute(){
       return Carbon::parse($this->attributes['dt_encerramento'])->format('d/m/Y');
    }

    public function setDtEncerramentoAttribute($value){
        if (strlen($value) > 0){
            try{
                return $this->attributes['dt_encerramento'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }catch(\Exception $e){
                return $this->attributes['dt_encerramento'] = date('Y-m-d');
            }
        }else{
            return $this->attributes['dt_encerramento'] = null;
        }
    }

    public function setNrCpfEncerramentoAttribute($value)
    {
        $this->attributes['nr_cpf_encerramento'] = MaskHelper::removeMascaraCpf($value);
    }

    public function getNrCpfEncerramentoAttribute()
    {
        if (strlen($this->attributes['nr_cpf_encerramento']) == 11) {
            return MaskHelper::aplicaMascara($this->attributes['nr_cpf_encerramento'],'###.###.###-##');    
        }
    }   

    public function getObjetoContratoAttribute()
    {
        return ObjetoContrato::getValue($this->attributes['in_objeto']);
    }

    public function getTipoContratoAttribute()
    {
        return TipoContrato::getValue($this->attributes['in_tipo']);
    }

    public function getTipoVariacaoAttribute() {
        return TipoVariacao::getValue($this->attributes['in_tipo_variacao']);
    }

    public function getModalidadeGarantiaAttribute() {
        return ModalidadeGarantia::getValue($this->attributes['in_modalidade_garantia']);
    }

    public function getStatusContratoAttribute()
    {
        return StatusContrato::getValue($this->attributes['in_status_contrato']);
    }

    public function modalidade(){
        return $this->hasOne(Modalidade::class, 'id_modalidade', 'id_modalidade')->withTrashed();
    }    

    public function contratada(){
        return $this->hasOne(Contratada::class, 'id_contratada', 'id_contratada')->withTrashed();
    }    

    public function contratante(){
        return $this->hasOne(Contratante::class, 'id_contratante', 'id_contratante')->withTrashed();
    }

    public function assinante(){
        return $this->hasOne(ContratanteAssinante::class, 'id_contratante_assinante', 'id_contratante_assinante')->withTrashed();
    }

    public function itensContratacao(){
        return $this->hasMany(ContratoItemContratacaoTerceirizacao::class, 'id_contrato', 'id_contrato')->where('deleted_at', null);
    }

    public function processosPagamento(){
        return $this->hasMany(ContratoProcessoPagamento::class, 'id_contrato', 'id_contrato')->where('deleted_at', null);
    }

    public function prepostos(){
        return $this->hasMany(ContratoPreposto::class, 'id_contrato', 'id_contrato')->where('deleted_at', null);
    }

    public function fiscais(){
        return $this->hasMany(ContratoFiscal::class, 'id_contrato', 'id_contrato')->where('deleted_at', null);
    }

    public function outrasInformacoes(){
        return $this->hasMany(ContratoInformacaoAdicional::class, 'id_contrato', 'id_contrato')->where('deleted_at', null);
    }
}
