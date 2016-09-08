<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>tic tac toe</title>
	<script type="text/javascript" src="{{URL::asset('public/jquery-3.1.0.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('public/canvasjs.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('public/lodash.min.js')}}"></script>

	<style media="screen">
	html,body, #flex-countainer{
		width: 100%;
		height: 100%;
		overflow: hidden;
	}
	header{
		width: 100%;
		height: 150 px;
		/*height: 150px;*/
		position: fixed;
		top: 0px;
		left: 0px;
		background: #cccbcb;
	}
	#logo {
		width: 100%;
		/*background: #ffffff;*/
		height: 50px;
		margin-left: 40%;
		margin-top: 5px;
	}
	#logo > img {
		width: 20%;
		display: inline-block;
		float: left;
		height: auto;
	}
	#name{
		width: 100%;
		height: 60px;
		background-color: #610b27;
		float: left;
	}
	#projectname{
		margin-top: 5px;
		margin-left: 10%;
		font-size: 30px;
		color: #ffffff;
	}
	/*#menu{
		width: 40%;
		display: inline-block;
		float: right;
	}
	#menu ul li{
		list-style-type:none;
		display: inline;
		font-size: 24px;
		font-weight: bold;
		color: #FF4D4D;
		margin-right: 15px;
	}
	#name{
		height: 80px;
		width: 100%;
		background-color: #FF4D4D;
	}
	#company-name{
		font-size: 30px;
	}*/
	div#content-wrapper {
		margin-top: 170px;
		width: 100%;
	}
	/*#navigation{
		background-color: #CCC;
		height: calc(100vh - 120px);
		width:15%;
		display: inline;
		/*float: left;
		position: fixed;
		left: 0px;
	}*/
	#section{
		background-color: #FFF;
		height: calc(100vh - 120px);
		/*height: 500px;*/
		/*width: 85%;*/
		display: inline;
		float: left;
		overflow-y: auto;
		width: 100%;
		margin-left: 20px;
		margin-right: 20px;
		/*margin-left: calc(100vw - 85%);*/
		/*padding: 10px 5px 0px 0px;*/
	}
	#section>div{
		padding: 10px;
	}
	/*#today{
	font-size: 30px;
	width: 33%;
	float: center;
	}*/
	#date{
		width: 100%;
		font-size: 25px;
		font-weight: bold;
		margin-top: 5px;
	}

	#base-data{
		width:100%;
	}
	#planned-value, #earned-value, #actual-cost{
		font-size: 20px;
		width: 33%;
		float: left;
		display: inline-block;
	}
	#budget-at-completion, #plan-at-completion{
		font-size: 20px;
		width: 50%;
		float: left;
		display: inline-block;
	}
	#base-data-dua{
		width:100%;
	}
	#graphic{

	}
	#report{

	}
	#status, #forecast{
		font-size: 35px;
		width: 45%;
		float: left;
		display: inline-block;
	}
	#statusbox, #forecastbox{
		font-size: 20px;
		width: 95%;
		height: auto;
	    margin: 10px;
	    border: 2px solid #000;
	}
	</style>
	<body>
		<div id="flex-countainer">
			<header>
				<div id="logo">
					<img src="..\eva\public\image\logoEVA.png" alt="" />
					<!--<div id="menu">
						<ul>
							<li>Home</li>
							<li>Projects</li>
							<li>Calendar</li>
							<li>People</li>
						</ul>
					</div>
				</div>/>-->
				<!--<div id="name">
					<div id="company-name">
						Forward
					</div>
				</div>/>-->
				</div>
				<div id="name">
					<div id="projectname">
						Project Name
					</div>
				</div>
			</header>
			<div id="content-wrapper">
				<!--<div id="navigation">
					<div id="tasks">
						Task
					</div>
					<div id="wbs">
						WBS
					</div>
					<div id="gantt">
						Gantt Chart
					</div>
					<div id="report">
						Report
					</div>
				</div>/>-->
				<!-- <div id="today">
			</div> -->
			</div>
			<div id="section">
				<div id= "date">
					Tanggal Perhitungan:
					<div id="pilihdate">
						<form id="tanggal">
						  <select name="tanggalperhitungan">

						  </select>
						  <input type="submit">
						</form>
					</div>
				</div>
				<div id="base-data">
					<div id="planned-value">
						Planned Value: Rp <output id="pv" name="pv"></output>
					</div>
					<div id="earned-value">
						Earned Value: Rp <output id="ev" name="ev"></output>
					</div>
					<div id="actual-cost">
						Actual Cost: Rp<output id="ac" name="ac"></output>
					</div>
				</div>
				<div id="base-data-dua">
					<div id="budget-at-completion">
						Budget at Completion: Rp <output id="bac" name="ac"></output>
					</div>
					<div id="plan-at-completion">
						Plan at Completion: <output id="pac" name="ac"></output> hours
					</div>
				</div>
				<div id="graphic">
					<div id="chartContainer" style="height: 300px; width: 100%;"></div>
					<!-- <img src="..\eva\public\image\template grafik.png" alt="" /> -->
				</div>
				<div id="report">
					<div id="status">
						Project Status
						<div id="statusbox">
							<div id="sv">
							</div>
							<div id="spistatus"> The project's time efficiency so far is <output id="spi" name="spi"></output>
							</div>
							<div id="cv">
							</div>
							<div id="cpistatus"> The project's cost efficiency so far is <output id="cpi" name="cpi"></output>
							</div>
						</div>
					</div>
					<div id="forecast">
						Project Forecast
						<div id="forecastbox">
							<div id="tacforecast"> The Project is approximately finish in <output id="tac" name="tac"></output> hours
							</div>
							<div id="vacforecast"> With differences on time by  <output id="dac" name="dac"></output> hours
							</div>
							<div id="eacforecast"> The Project is approximately finish with cost Rp <output id="eac" name="eac"></output>
							</div>
							<div id="etcforecast"> The Project cost to complete is Rp <output id="etc" name="etc"></output>
							</div>
							<div id="tcpiforecast"> The Project need  <output id="tcpi" name="tcpi"></output> cost efficiency to finish in budget.
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer>
		</footer>
	</div>
</body>

<script>

$(window).on('load', function() {
	$.getJSON( "earnedvalueanalysis", function(response) {
		// console.log(response);

	//	var options = '';
	//	$.each(response.datelist, function(index, value) {
	//	    options += '<option value="' + value.evaluate_at + '" text="' + value.evaluate_at + '" />';
	//	});
//
//		$('#tanggalperhitungan').append(options);

		var chartdata	= [
			{ type : 'line', name: "Actual Cost", showInLegend: true, dataPoints : [] },
			{ type : 'line', name: "Earned Value", showInLegend: true, dataPoints : [] },
			{ type : 'line', name: "Planned Value", showInLegend: true, dataPoints : [] },
		];

		_.forEach(response.graphic, function(value, key) {
			// console.log(chartdata[0]);
			chartdata[0].dataPoints.push({ x : new Date(value.evaluate_at), y : value.actual_cost });
			chartdata[1].dataPoints.push({ x : new Date(value.evaluate_at), y : value.earned_value });
			chartdata[2].dataPoints.push({ x : new Date(value.evaluate_at), y : value.planned_value });
		});

		var chart = new CanvasJS.Chart("chartContainer", {
			title:{
				text: "Earned Value Analysis - per Period"
			},
			data: chartdata
		});
		chart.render();

		var pv = response.graphic.planned_value;
		var ev = response.graphic.earned_value;
		var ac = response.graphic.actual_cost;
		var evaluate_at = response.graphic.evaluate_at;

		// $('#today').text(response.data.evaluate_at);
		$('#pv').text(response.data.planned_value);
		$('#ev').text(response.data.earned_value);
		$('#ac').text(response.data.actual_cost);
		$('#bac').text(response.projectlist.budget_at_completion);
		$('#pac').text(response.projectlist.plan_at_completion);


		if (response.data.cost_variance>=1){
	        $('#cv').text("The Project is in budget.");
	    }else{
	        $('#cv').text("The Project is out of budget.");
	    };

	    if (response.data.schedule_variance=1){
	        $('#sv').text("The Project is in schedule.");
	    }else if (response.data.cost_variance>1){
	        $('#sv').text("The Project is ahead of schedule.");
	    }else{
	        $('#sv').text("The Project is behind schedule.");
	    };

		$('#cpi').text(response.data.CPI);

	    $('#spi').text(response.data.SPI);

	    $('#tac').text(response.data.time_at_completion);

	    $('#dac').text(response.data.delay_at_completion);

	    $('#tcpi').text(response.data.TCPI);

	    $('#eac').text(response.data.EAC);

	    $('#etc').text(response.data.ETC);

	    $('#vac').text(response.data.VAC);


	});
});
</script>

</html>
