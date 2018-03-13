<div id="estatisticas-composicao-comissao">
    <div class="row">
    <div class="col-sm-4">
        <div class="infobox infobox-blue infobox-medium infobox-dark">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-users"></i>
            </div>
            <div class="infobox-data">
                <div class="infobox-content">Membros titulares</div>
                <div class="infobox-content">{{ $comissao->membros->where('pivot.in_cargo','T')->count() }}</div>
            </div>
        </div>

        <div class="infobox infobox-green infobox-medium infobox-dark">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-thumbs-up"></i>
            </div>
            <div class="infobox-data">
                <div class="infobox-content">Titulares da base</div>
                <div class="infobox-content">{{ $comissao->membros->where('pivot.in_cargo','T')->where('pivot.in_posicionamento_comissao','B')->count() }}</div>
            </div>
        </div>

        <div class="infobox infobox-red infobox-medium infobox-dark">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-thumbs-down"></i>
            </div>
            <div class="infobox-data">
                <div class="infobox-content">Titulares da oposição</div>
                <div class="infobox-content">{{ $comissao->membros->where('pivot.in_cargo','T')->where('pivot.in_posicionamento_comissao','O')->count() }}</div>
            </div>
        </div>

        <div class="infobox infobox-grey infobox-medium infobox-dark">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-question-circle"></i>
            </div>
            <div class="infobox-data">
                <div class="infobox-content">Titulares indefinidos</div>
                <div class="infobox-content">{{ $comissao->membros->where('pivot.in_cargo','T')->where('pivot.in_posicionamento_comissao','I')->count() }}</div>
            </div>
        </div> 
    </div>

    <div class="col-sm-4">
        
        <div class="infobox infobox-blue infobox-medium ">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-users"></i>
            </div>
            <div class="infobox-data">
                <div class="infobox-content">Membros suplentes</div>
                <div class="infobox-content">{{ $comissao->membros->where('pivot.in_cargo','S')->count() }}</div>
            </div>
        </div>

        <div class="infobox infobox-green infobox-medium ">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-thumbs-up"></i>
            </div>
            <div class="infobox-data">
                <div class="infobox-content">Suplentes da base</div>
                <div class="infobox-content">{{ $comissao->membros->where('pivot.in_cargo','S')->where('pivot.in_posicionamento_comissao','B')->count() }}</div>
            </div>
        </div>

        <div class="infobox infobox-red infobox-medium ">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-thumbs-down"></i>
            </div>
            <div class="infobox-data">
                <div class="infobox-content">Suplentes oposição</div>
                <div class="infobox-content">{{ $comissao->membros->where('pivot.in_cargo','S')->where('pivot.in_posicionamento_comissao','O')->count() }}</div>
            </div>
        </div>

        <div class="infobox infobox-grey infobox-medium ">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-question-circle"></i>
            </div>
            <div class="infobox-data">
                <div class="infobox-content">Suplentes indefinidos</div>
                <div class="infobox-content">{{ $comissao->membros->where('pivot.in_cargo','S')->where('pivot.in_posicionamento_comissao','I')->count() }}</div>
            </div>
        </div>
        
    </div>

    <div class="col-sm-4">
        <div class="infobox infobox-blue infobox-medium infobox-dark">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-users"></i>
            </div>
            <div class="infobox-data">
                <div class="infobox-content">Membros totais</div>
                <div class="infobox-content">{{ $comissao->membros->count() }}</div>
            </div>
        </div>
        
        <div class="infobox infobox-green infobox-medium infobox-dark">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-thumbs-up"></i>
            </div>
            <div class="infobox-data">
                <div class="infobox-content">Membros da base</div>
                <div class="infobox-content">{{ $comissao->membros->where('pivot.in_posicionamento_comissao','B')->count() }}</div>
            </div>
        </div>
        

        <div class="infobox infobox-red infobox-medium infobox-dark">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-thumbs-down"></i>
            </div>
            <div class="infobox-data">
                <div class="infobox-content">Membros da oposição</div>
                <div class="infobox-content">{{ $comissao->membros->where('pivot.in_posicionamento_comissao','O')->count() }}</div>
            </div>
        </div>

        <div class="infobox infobox-grey infobox-medium infobox-dark">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-question-circle"></i>
            </div>
            <div class="infobox-data">
                <div class="infobox-content">Membros indefinidos</div>
                <div class="infobox-content">{{ $comissao->membros->where('pivot.in_posicionamento_comissao','I')->count() }}</div>
            </div>
        </div>
    </div>
</div>
</div>