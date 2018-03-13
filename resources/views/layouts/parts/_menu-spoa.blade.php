<div id="sidebar" class="sidebar responsive fixed" style="padding-top: 45px;">
	
	<ul class="nav nav-list">
		@if(!empty($MenuSistema))
			@include('layouts.parts._menu-spoa-items', array('items' => $MenuSistema->roots()))
		@endif
	</ul>	
	
	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>
</div>