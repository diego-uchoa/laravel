<?php $helper = app('App\Helpers\UtilHelper'); ?>
<li class="transparent">
    <a href="{{route('sishelp::ajuda_sistema.index',['sistema'=> $helper->getSistema()])}}" data-rel="tooltip" data-placement="bottom" data-original-title="Ajuda" target="_blank">
        <i class="ace-icon fa fa-question"></i>
    </a>
</li>

