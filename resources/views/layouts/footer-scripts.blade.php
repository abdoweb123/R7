
	<!-- Vendor JS -->
	<script src="{{ url('admin_new/js/vendors.min.js') }}"></script>
	<script src="{{ url('admin_new/js/pages/chat-popup.js') }}"></script>
    <script src="{{ url('admin_new/assets/icons/feather-icons/feather.min.js')}}"></script>	
    <script src="{{ url('admin_new/assets/vendor_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ url('admin_new/assets/vendor_components/perfect-scrollbar-master/perfect-scrollbar.jquery.min.js')}}"></script>
	<script src="{{ url('admin_new/assets/vendor_components/fullcalendar/lib/moment.min.js')}}"></script>
	<script src="{{ url('admin_new/assets/vendor_components/fullcalendar/fullcalendar.min.js')}}"></script>
	<script src="{{ url('admin_new/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
	<script src="https://www.amcharts.com/lib/4/core.js"></script>
	<script src="https://www.amcharts.com/lib/4/maps.js"></script>
	<script src="https://www.amcharts.com/lib/4/geodata/worldLow.js"></script>
	<script src="https://www.amcharts.com/lib/4/themes/dataviz.js"></script>
	<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

	<!-- CrmX Admin App -->
	<script src="{{ url('admin_new/js/template.js') }}"></script>
	<script src="{{ url('admin_new/js/demo.js') }}"></script>
	{{-- <script src="{{ url('admin_new/js/pages/dashboard.js') }}"></script> --}}
	@yield('js')

	@if(isset($data_table))
		<script src="{{ url('admin_new/assets/vendor_components/datatable/datatables.min.js') }}"></script>
		<script src="{{ url('admin_new/js/pages/data-table.js') }}"></script>
	@endif
	

@livewireScripts