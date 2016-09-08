<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Perhitungan EVA</title>
	<script type="text/javascript" src="{{URL::asset('public/jquery-3.1.0.min.js')}}"></script>
	<script>
	$(document).ready(function() {
	// 	$.getJSON("earnedvalueanalysis", function(response)){
	// 		var tr = '';
	// 		$.each(response.project, function(index, value) {
	// 		    tr += '<tr value="' + value.name + '" text="' + value.name + '" />';
	// 		});
	//
	// 		$('#list').append(tr);
	// 	}

	//	   var table = document.getElementById("list");
	//	   var rows = table.getElementsByTagName("tr");
	//	   for (i = 0; i < rows.length; i++) {
	//	       var currentRow = table.rows[i];
	//	       rows[i].onclick = function(){rowHandlers();};
//		       currentRow.onclick = createClickHandler(currentRow);
//		   }

//		function addRowHandlers() {
//		}


        $('form').on('submit', function(event) {
			event.stopPropagation(); // Stop stuff happening
			event.preventDefault(); // Totally stop stuff happening

			var data = new FormData();
			data.append('files', $('#xml')[0].files[0]);

			$.ajax({
				url: 'uploadXML',
				type: 'POST',
				data: data,
				cache: false,
				dataType: 'json',
				processData: false, // Don't process the files
				contentType: false, // Set content type to false as jQuery will tell the server its a query string request
				// success: function(data, textStatus, jqXHR)
				// {
				// 	alert('success');
				// },
				success: function(jqXHR, textStatus, errorThrown)
				{
					window.location	= 'eva';
				}
			});
		});
	});

	// function checkAnswer(){
	// 	var response = document.getElementById('answer').value;
	// 	if (response == "correctanswer")
	// 	location = '/eva/eva';
	// 	else
	// 	location = '/';
	// 	return false;
	// }
	</script>
	<style type="text/css">
	html,body, #flex-countainer{
		width: 100%;
		height: 100%;
		overflow: hidden;
	}
	header{
		width: 100%;
		height: 150px;
		position: fixed;
		top: 0px;
		left: 0px;
		background: #cccbcb;
	}
	#logo {
		width: 100%;
		height: 50px;
		margin-left: 40%;
		margin-top: 5px;
	}
	#logo > img {
		width: 20%;
		display: inline-block;
		float:left;
		height: auto;
	}
	div#content-wrapper {
		margin-top: 200px;
		width: 100%;
	}
	#section{
		background-color: #FFF;
		height: calc(100vh - 150px);
		/*height: 500px;*/
		display: inline;
		float: left;
		overflow-y: auto;
		margin-left: 20%;
		margin-right: 20%;
		/*padding: 10px 5px 0px 0px;*/
	}
	#section>div{
		padding: 10px;
	}
	#project{
		width: 100%;
	}
	#title{
		font-size: 40px;
		font-family:inherit;
		font-weight: bold;
		color: #610b27;
	}
	#projectlist{
		padding:10px;
	}
	table#list, th, td{
		background-color: #f1f1c1;
		border: 1px solid #696969;
	    border-collapse: collapse;
	}
	th, td {
	    padding: 5px;
	    text-align: left;
	}
	#input-data{
		width:100%;
	}
	#input{
		float: left;
		display: inline-block;
		font-size:25px;
	}
	</style>
</head>

<body>
	<div id="flex-countainer">
		<header>
			<div id="logo">
				<img src="{{URL::asset('public/image/logoEVA.png')}}" alt="" />
			</div>
		</header>
		<div id="content-wrapper">
			<div id="section">
				<div id="project">
					<div id="title">
					Project List <output id="project" name="project"></output>
					</div>
					<div id="projectlist">
						<table id="list">
							<tr>
								<th>Nama Proyek</th>
							</tr>
						</table>
					</div>
				</div>
				<div id="input-data">
					<form id="input" enctype="multipart/form-data">
						Select file to upload:
						<input type="file" name="xml" id="xml">
						<input type="submit" value="Hitung EVA" name="submit">
					</form>
				</div>
			</div>
		</div>
		<footer>
		</footer>
	</div>
</body>
</html>

<script>
//$(window).on('load', function() {
//	$.getJSON( "earnedvalueanalysis", function(response) {
//		$('#project').text(response.projectlist.name);
//
//	});
//});

</script>
