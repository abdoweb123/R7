<div>
  <aside class="control-sidebar">
	  
	<div class="rpanel-title"><span class="pull-right btn btn-circle btn-danger"><i class="ion ion-close text-white" data-toggle="control-sidebar"></i></span> </div>  <!-- Create the tabs -->
    <ul class="nav nav-tabs control-sidebar-tabs">
      <li class="nav-item" ><a href="#control-sidebar-theme-demo-options-tab" data-bs-toggle="tab" class="active"><i class="mdi mdi-settings"></i></i></a></li>
      <li class="nav-item" ><a href="#control-sidebar-home-tab" data-bs-toggle="tab" class=""><i class="mdi mdi-message-text"></i></a></li>
      <li class="nav-item"><a href="#control-sidebar-settings-tab" data-bs-toggle="tab"><i class="mdi mdi-playlist-check"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">

        <div class="tab-pane active" id="control-sidebar-theme-demo-options-tab">
            <h4 class="control-sidebar-heading p-0"></h4>
                <div class="flexbox mb-10 pb-10 bb-1 light-on-off">
                <label for="toggle_left_sidebar_skin" class="control-sidebar-subheading">
                Dark or Light Skin
                </label>
                <label class="switch">
                <input type="checkbox" data-mainsidebarskin="toggle" wire:click="change_mood" id="toggle_left_sidebar_skin">
                <span class="switch-on fs-30"><i class="mdi mdi-lightbulb-on"></i></span>
                <span class="switch-off fs-30"><i class="mdi mdi-lightbulb"></i></span>
                </label>
                </div>

                <h4 class="control-sidebar-heading p-0">
                    <div class="flexbox mb-10 pb-10 bb-1">
                        <label for="rtl" class="control-sidebar-subheading">
                        Turn RTL/LTR
                        </label>
                        <label class="switch switch-border switch-danger">
                        <input type="checkbox" data-layout="rtl" id="rtl" wire:click="change_lang">
                        <span class="switch-indicator"></span>
                        <span class="switch-description"></span>
                        </label>
                        </div>


		<h4 class="control-sidebar-heading">Skin Colors</h4>
		<ul class="list-inline clearfix theme-switch">
			<li style="padding: 5px;line-height: 25px;">
				<a href="javascript:void(0)" data-theme="theme-primary" style="display: inline-block;vertical-align: middle;" class="clearfix active bg-primary rounded w-80 h-80" title="Theme Primary"></a>
			</li>
			
			<li style="padding: 5px;line-height: 25px;">
				<a href="javascript:void(0)" data-theme="theme-success" style="display: inline-block;vertical-align: middle;" class="clearfix active bg-success rounded w-80 h-80" title="Theme success"></a>
			</li>

			<li style="padding: 5px;line-height: 25px;">
				<a href="javascript:void(0)" data-theme="theme-info" style="display: inline-block;vertical-align: middle;" class="clearfix active bg-info rounded w-80 h-80" title="Theme info"></a>
			</li>

			<li style="padding: 5px;line-height: 25px;">
				<a href="javascript:void(0)" data-theme="theme-secondary" style="display: inline-block;vertical-align: middle;" class="clearfix active bg-secondary rounded w-80 h-80" title="Theme secondary"></a>
			</li>

			<li style="padding: 5px;line-height: 25px;">
				<a href="javascript:void(0)" data-theme="theme-warning" style="display: inline-block;vertical-align: middle;" class="clearfix active bg-warning rounded w-80 h-80" title="Theme warning"></a>
			</li>

			<li style="padding: 5px;line-height: 25px;">
				<a href="javascript:void(0)" data-theme="theme-danger" style="display: inline-block;vertical-align: middle;" class="clearfix active bg-danger rounded w-80 h-80" title="Theme danger"></a>
			</li>
			
		</ul>
		
        </div>
    </div>
  </aside>

</div>