<div> 
	@section('title')
		{{ $title }}
	@endsection
	@section('css')
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap" rel="stylesheet">
		<style>
			body{
				font-family: 'Cairo', sans-serif !important;
			}
		</style>
	@endsection

    <div class="row">
		<div class="col-lg-3 col-md-6 col-12">
			<div class="box">
				<a href="{{ url('users') }}">
					<div class="box-body p-40">
						<div class="d-flex justify-content-between align-items-center">
							<div>
								<h2 class="my-0 fw-700">{{ @$total_employees }}</h2>
								<p class="text-fade mb-0"> عدد الموظفين</p>						
							</div>
							<div class="icon">
								<i class="glyphicon glyphicon-user bg-success me-0 fs-24"></i>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-12">
			<div class="box">
					<div class="box-body p-40">
						<div class="d-flex justify-content-between align-items-center">
							<div>
								<h2 class="my-0 fw-700">{{ @$offers }}</h2>
								<p class="text-fade mb-0"> عدد طلبات التوظيف</p>						
							</div>
							<div class="icon">
								<i class="fa fa-bolt bg-warning me-0 fs-24"></i>
							</div>
						</div>
					</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-12">
			<div class="box">
				<a href="{{ url('jobs') }}">
					<div class="box-body p-40">
						<div class="d-flex justify-content-between align-items-center">
							<div>
								<h2 class="my-0 fw-700">{{ @$total_jobs_active }}</h2>
								<p class="text-fade mb-0">عدد المشاريع</p>						
							</div>
							<div class="icon">
								<i class="fa fa-industry bg-danger me-0 fs-24"></i>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-12">
			<div class="box">
				<a href="{{ url('user-traning') }}">
					<div class="box-body p-40">
						<div class="d-flex justify-content-between align-items-center">
							<div>
								<h2 class="my-0 fw-700">{{ @$total_employees_training }}</h2>
								<p class="text-fade mb-0">عدد تدريبات الموظفين</p>						
							</div>
							<div class="icon">
								<i class="fa fa-bullhorn bg-success me-0 fs-24"></i>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>

		<div class="col-12">
            <div class="box">
              <div class="row g-0 py-2">
                <div class="col-12 col-lg-3">
                  <div class="box-body be-1 border-light">
					<a href="{{ url('specialties') }}">
						<div class="flexbox mb-1">
						<span>
							<span class="icon-User fs-40"><span class="path1"></span><span class="path2"></span></span><br>
							عدد التخصصات
						</span>
						<span class="text-primary fs-40">{{ @$specialist }}</span>
						</div>
					</a>
                    <div class="progress progress-xxs mt-10 mb-0">
                      <div class="progress-bar" role="progressbar" style="width: 35%; height: 4px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>


                <div class="col-12 col-lg-3 hidden-down">
                  <div class="box-body be-1 border-light">
					<a href="{{ url('companies') }}">
						<div class="flexbox mb-1">
						<span>
							<span class="icon-Selected-file fs-40"><span class="path1"></span><span class="path2"></span></span><br>
							عدد الشركات
						</span>
						<span class="text-info fs-40">{{ @$companies_count }}</span>
						</div>
					</a>
                    <div class="progress progress-xxs mt-10 mb-0">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 55%; height: 4px;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>


                <div class="col-12 col-lg-3 d-none d-lg-block">
                  <div class="box-body be-1 border-light">
					<a href="{{ url('jobs') }}">
						<div class="flexbox mb-1">
						<span>
							<span class="icon-Info-circle fs-40"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span><br>
						عدد المشاريع الغير مكتمله
						</span>
						<span class="text-warning fs-40">{{ @$job_not_complete_count }}</span>
						</div>
					</a>
                    <div class="progress progress-xxs mt-10 mb-0">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 65%; height: 4px;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>


                <div class="col-12 col-lg-3 d-none d-lg-block">
                  <div class="box-body">
					<a href="{{ url('jobs-expaire') }}">
						<div class="flexbox mb-1">
						<span>
							<span class="icon-Group-folders fs-40"><span class="path1"></span><span class="path2"></span></span><br>
							عدد المشاريع المكتمله
						</span>
						<span class="text-danger fs-40">{{ @$job_count }}</span>
						</div>
					</a>
                    <div class="progress progress-xxs mt-10 mb-0">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 40%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

		{{-- <div class="col-md-12"> --}}
			<div class=" col-md-6 ">
				<div class="box">
					<a href="{{ url('jobs') }}">
						<div class="box-body p-40">
							<div class="d-flex justify-content-between align-items-center">
								<div>
									<h2 class="my-0 fw-700">{{ @$total_jobs_active }}</h2>
									<p class="text-fade mb-0"> عدد المشاريع الحاليه</p>						
								</div>
								<div class="icon">
									<i class="fa fa-sticky-note bg-danger me-0 fs-24"></i>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
			<div class=" col-md-6">
				<div class="box">
					<a href="{{ url('trainers') }}">
						<div class="box-body p-40">
							<div class="d-flex justify-content-between align-items-center">
								<div>
									<h2 class="my-0 fw-700">{{ @$total_trainers }}</h2>
									<p class="text-fade mb-0">  عدد المدربين </p>						
								</div>
								<div class="icon">
									<i class="fa fa-wheelchair-alt bg-success me-0 fs-24"></i>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
		{{-- </div> --}}

        <div class="col-xl-6 col-12">
            <div class="box">
				<a href="{{ url('jobs') }}">
					<div class="box-header no-border">
						<h4 class="box-title">
							الوظائف
						</h4>
					</div>
				</a>
                <div class="box-body pt-0">
                    <div id="yearly-comparison"></div>
                </div>
            </div>
		</div>
		<div class="col-xl-6 col-12">
			<div class="box">
				<div class="box-header no-border">
				<a href="{{ url('jobs-expaire') }}">
					<h4 class="box-title"> نسبه اكتمال المشاريع</h4>
				</a>
					<div>
						<canvas id="pie-chart" height="234"></canvas>
					</div>
				</div>
			</div>
		</div>
		@if(count($employee_tasks))
			@foreach($employee_tasks as $employee_task)
			<div class="col-xl-4 col-12">
				<div class="box">
					<div class="box-body d-flex align-items-center pb-0">
						<div class="d-flex flex-column flex-grow-1">
							<a href="{{ url('user-details/'.@$employee_task->user->id) }}" class="box-title text-muted fw-600 fs-18 mb-2 hover-primary">{{ @$employee_task->user->full_name }}</a>
							<span class="fw-500 text-fade">{{ @$employee_task->user->email }}</span>
							<span class="fw-500 text-fade">{{ @$employee_task->user->phone }}</span>
						</div>
						<img src="{{ image_exist( @$employee_task->user->profile_image) }}" alt="" class="align-self-end h-100">
					</div>
				</div>
			  </div>	
			@endforeach
		@endif
		

		<div class="col-xl-6 col-12">
			<div class="box">
				<div class="box-body">
					<div class="d-flex align-items-center justify-content-between">
						<a href="{{ url('jobs') }}">
						<div>
							<h6 class="mb-0 fw-600 text-dark text-uppercase">اخر 5 مشاريع</h6>
						</div>
						</a>
						<div>
							<a href="javascript:void(0)">
								<i class="ti-reload"></i>
							</a>
						</div>
					</div>
					<div class="table-responsive">
						<table id="example5" class="table table-bordered table-striped" style="width:100%">
							<thead>
							<tr>
								<th>#</th>
								<th>وصف الوظيفة</th>
								<th>اسم الشركة</th>
								<th> تاريخ البدايه</th>
								<th>تاريخ النهايه</th>
							</tr>
							</thead>
							<tbody>
							@foreach ($last_five_job as $index=>$item)
								<tr>
									<td>{{ $index + 1 }}</td>
									<td>@isset($item->job->job_description)  {{ $item->job->job_description }} @else لا يوجد @endisset</td>
									<td>@isset($item->company->company_name)  {{ $item->company->company_name }} @else لا يوجد @endisset</td>
									<td>{{ @$item->start_time }}</td>
									<td>{{ @$item->end_time }}</td>
								</tr>
							@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-6 col-12">
			<div class="box">
				<div class="box-body">
					<div class="d-flex align-items-center justify-content-between">
						<a href="{{ url('everyday-tasks') }}">
							<div>
								<h6 class="mb-0 fw-600 text-dark text-uppercase">اخر 5 مهام</h6>
							</div>
						</a>
						<div>
							<a href="javascript:void(0)">
								<i class="ti-reload"></i>
							</a>
						</div>
					</div>
					<div class="table-responsive">
						<table id="example5" class="table table-bordered table-striped" style="width:100%">
							<thead>
							<tr>
								<th>#</th>
								<th>وصف الوظيفة</th>
								<th>اسم الشركة</th>
								<th>اسم الموظف</th>
								<th>اسم المهمة </th>
							</tr>
							</thead>
							<tbody>
							@foreach ($job_tasks as $index=>$item)
								<tr>
									<td>{{ $index + 1 }}</td>
									<td>@isset($item->job->job_description)  {{ $item->job->job_description }} @else لا يوجد @endisset</td>
									<td>@isset($item->company->company_name)  {{ $item->company->company_name }} @else لا يوجد @endisset</td>
									<td>@isset($item->user->full_name)  {{ $item->user->full_name }} @else _____ @endisset</td>
									<td>{{$item->getTranslation('name', 'ar')}}</td>
								</tr>
							@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
			{{-- <div class="col-lg-3 col-md-6 col-12">							
				<div class="box">
					<div class="box-body">
					<div class="d-flex justify-content-between align-items-center">
						<div>
							<h1 class="my-0">{{ @$total_employees }} </h1>
							<p class="text-fade mb-0">عدد الموظفين</p>
						</div>
						<div class="bg-info px-30 py-10 text-center rounded"><i class="glyphicon glyphicon-user"></i></div>
					</div>
					</div>
				</div>
				<div class="box bg-danger">
					<div class="box-body">
						<div class="d-flex justify-content-between align-items-center">
							<div class="text-center">									
								<h2 class="fw-600">{{ @$total_jobs_active }}</h2>
								<p> عدد الوظائف</p>
							</div>
							<div id="visitors-char"></div>
						</div>
					</div>
				</div>
				<div class="box">
					<div class="box-body">
					<div class="d-flex justify-content-between align-items-center">
						<div>
							<h1 class="my-0">{{ @$traning_coureses }}</h1>
							<p class="text-fade mb-0">عدد الدورات التدريبيه </p>
						</div>
						<div class="bg-success px-30 py-5 text-center rounded"><i class=" ti-notepad"></i></div>
					</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-12">
				<div class="box">
					<div class="box-body">
						<h4 class="box-title"> نسبه اكتمال المشاريع</h4>
						<div>
							<canvas id="pie-chart" height="200"></canvas>
						</div>
					</div>
				</div>
			</div> --}}
			
          
        {{-- </div> --}}
        <div class="col-12">
            <div class="box">
                <div class="box-header">
                    <h4 class="box-title">تقرير المدن والمهام</h4>
                    <ul class="box-controls pull-right">
                      <li><a class="box-btn-close" href="#"></a></li>
                      <li><a class="box-btn-slide" href="#"></a></li>
                      <li><a class="box-btn-fullscreen" href="#"></a></li>
                    </ul>
                </div>
                <div class="box-body bg-primary p-0">
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="p-15">
                                {{-- <div class="lookup lookup-lg lookup-right d-none d-lg-block">
                                    <input type="text" name="s" placeholder="Search" class="w-p100">
                                </div> --}}
                                <div class="mt-30">
                                    <h4>المدن</h4>
                                    <p class="mb-0 fw-700"><i class="ti-location-pin text-danger fs-16"></i> <span class="fs-12">الوظائف بكل مدينة</span></p>
                                    @if(count($cities))
                                        @foreach($cities as $city)
                                            <div class="mt-40">
                                                <p class="mb-0 fw-700">{{ @$city->name }}</p>											
                                                <div class="progress">												
                                                    <div class="progress-bar progress-bar-danger progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                    <span class="sr-only">{{ @$city->jobs_count }} job (warning)</span>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>									
                            </div>
                        </div>
                        <div class="col-lg-8 col-12 bg-white">
                            <div id="reports" style="height: 400px" class="overflow-hidden position-relative"></div>
                        </div>
                    </div>
                </div>						
            </div>
        </div>
    </div>
  <!-- /.row -->
  @section('js')
  <script src="{{ url('admin_new/assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>
  <script src="{{ url('admin_new/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>
  <script src="{{ url('admin_new/assets/vendor_components/zingchart_branded_version/zingchart.min.js') }}"></script>
  <script src="{{ url('admin_new/assets/vendor_components/chart.js-master/Chart.min.js')}}"></script>
	{{-- <script src="{{ url('admin_new/js/pages/widget-charts2.js') }}"></script> --}}
 {{-- اسكربت نسبه اكتمال المشاريع --}}
 <script>
  $( document ).ready(function() {
        "use strict";
        if( $('#pie-chart').length > 0 ){
            var ctx6 = document.getElementById("pie-chart").getContext("2d");
            var data6 = {
                labels: [
                "المهام المكتمله",
                " المهام الغير مكتمله"
            ],
            datasets: [
                {
                    data: [{{ @$Percentage_of_finished_jobs }}, {{ @$Percentage_of_not_finished_jobs }}],
                    backgroundColor: [
                        "#689f38",
                        "#c3243a"
                    ],
                    hoverBackgroundColor: [
                        "#33691e",
                        "#244674"
                    ]
                }]
            };
            
            var pieChart  = new Chart(ctx6,{
                type: 'pie',
                data: data6,
                options: {
                    animation: {
                        duration:	3000
                    },
                    responsive: true,
                    legend: {
                        labels: {
                        fontFamily: "Nunito Sans",
                        fontColor:"#878787"
                        }
                    },
                    tooltip: {
                        backgroundColor:'rgba(33,33,33,1)',
                        cornerRadius:0,
                        footerFontFamily:"'Nunito Sans'"
                    },
                    elements: {
                        arc: {
                            borderWidth: 0
                        }
                    }
                }
            });
        }
    }); 
  </script>
  {{-- اسكربت الوظائف --}}
  <script>
    var options = {
		chart: {
			height: 340,
			type: 'bar',
			toolbar: {
				show: false
			}
		},
		plotOptions: {
			bar: {
				horizontal: false,
				endingShape: 'rounded',
				columnWidth: '35%',
			},
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 2,
			colors: ['transparent']
		},
		colors: ["#2444e8", "#c6cffb"],
		series: [{
			name: 'المهام المكتمله',
			data: <?php echo json_encode( @$total_jobs_finshed->pluck('finishedfinshed')); ?>
		}, {
			name: 'المهام الغير مكتمله',
			data: <?php echo json_encode( @$total_jobs_finshed->pluck('notfinished')); ?>
		},],
		xaxis: {
			categories: <?php echo json_encode( @$total_jobs_finshed->pluck('job_description')); ?>,
			axisBorder: {
				show: true,
				color: '#bec7e0',
			},
			axisTicks: {
				show: true,
				color: '#bec7e0',
			},
		},
		legend: {
			position: 'top',
			horizontalAlign: 'right',
		},
		yaxis: {
			title: {
				text: 'المهام'
			}
		},
		fill: {
			opacity: 1

		},
		// legend: {
		//     floating: true
		// },
		grid: {
			row: {
				colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
				opacity: 0.2
			},
			borderColor: '#f1f3fa'
		},
		tooltip: {
			y: {
				formatter: function (val) {
					return "" + val + "k"
				}
			}
		}
	}

	var chart = new ApexCharts(
		document.querySelector("#yearly-comparison"),
		options
	);

	chart.render();
  </script>
  <script>
    var ts2 = 1484418600000;
	var dates = [];
	var spikes = [5, -5, 3, -3, 8, -8]
	for (var i = 0; i < 120; i++) {
		ts2 = ts2 + 86400000;
		var innerArr = [ts2, dataSeries[1][i].value];
		dates.push(innerArr)
	}

	var options = {
		chart: {
			type: 'area',
			stacked: false,
			height: 300,
			zoom: {
				type: 'x',
				enabled: true
			},
			toolbar: {
				autoSelected: 'zoom'
			}
		},
		dataLabels: {
			enabled: false
		},
		series: [{
			name: 'Stock',
			data: dates
		}],
		markers: {
			size: 0,
		},
		fill: {
			gradient: {
				enabled: true,
				shadeIntensity: 1,
				inverseColors: false,
				opacityFrom: 0.9,
				opacityTo: 0.2,
				stops: [0, 90, 100]
			},
		},
		yaxis: {
			min: 20000000,
			max: 250000000,
			labels: {
				formatter: function (val) {
					return (val / 1000000).toFixed(0);
				},
			},
		},

		xaxis: {
			type: 'datetime',
		},


		tooltip: {
			shared: false,
			y: {
				formatter: function (val) {
					return (val / 1000000).toFixed(0)
				}
			}
		}
	}

	var chart = new ApexCharts(
		document.querySelector("#chart-line"),
		options
	);

	chart.render();




	am4core.ready(function () {

		// Themes begin
		am4core.useTheme(am4themes_dataviz);
		am4core.useTheme(am4themes_animated);
		// Themes end

		// Create map instance
		var chart = am4core.create("reports", am4maps.MapChart);

		// Set map definition
		chart.geodata = am4geodata_worldLow;

		// Set projection
		chart.projection = new am4maps.projections.Miller();

		// Create map polygon series
		var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());

		// Exclude Antartica
		polygonSeries.exclude = ["AQ"];

		// Make map load polygon (like country names) data from GeoJSON
		polygonSeries.useGeodata = true;

		// Configure series
		var polygonTemplate = polygonSeries.mapPolygons.template;
		polygonTemplate.tooltipText = "{name}";
		polygonTemplate.fill = chart.colors.getIndex(0).lighten(0.5);

		// Create hover state and set alternative fill color
		var hs = polygonTemplate.states.create("hover");
		hs.properties.fill = chart.colors.getIndex(0);

		// Add image series
		var imageSeries = chart.series.push(new am4maps.MapImageSeries());
		imageSeries.mapImages.template.propertyFields.longitude = "longitude";
		imageSeries.mapImages.template.propertyFields.latitude = "latitude";
		imageSeries.data = <?php echo json_encode( @$all_job_tasks); ?>

		// add events to recalculate map position when the map is moved or zoomed
		chart.events.on("mappositionchanged", updateCustomMarkers);

		// this function will take current images on the map and create HTML elements for them
		function updateCustomMarkers(event) {

			// go through all of the images
			imageSeries.mapImages.each(function (image) {
				// check if it has corresponding HTML element
				if (!image.dummyData || !image.dummyData.externalElement) {
					// create onex
					image.dummyData = {
						externalElement: createCustomMarker(image)
					};
				}

				// reposition the element accoridng to coordinates
				var xy = chart.geoPointToSVG({ longitude: image.longitude, latitude: image.latitude });
				image.dummyData.externalElement.style.top = xy.y + 'px';
				image.dummyData.externalElement.style.left = xy.x + 'px';
			});

		}

		// this function creates and returns a new marker element
		function createCustomMarker(image) {

			var chart = image.dataItem.component.chart;

			// create holder
			var holder = document.createElement('div');
			holder.className = 'map-marker';
			holder.title = image.dataItem.dataContext.title;
			holder.style.position = 'absolute';

			// maybe add a link to it?
			if (undefined != image.url) {
				holder.onclick = function () {
					window.location.href = image.url;
				};
				holder.className += ' map-clickable';
			}

			// create dot
			var dot = document.createElement('div');
			dot.className = 'dot';
			holder.appendChild(dot);

			// create pulse
			var pulse = document.createElement('div');
			pulse.className = 'pulse';
			holder.appendChild(pulse);

			// append the marker to the map container
			chart.svgContainer.htmlElement.appendChild(holder);

			return holder;
		}

	}); 
</script>
  @endsection
</div>
