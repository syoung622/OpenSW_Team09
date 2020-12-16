<?php
require_once('connect.php');


$sql = "SELECT id, title, start, end, color, content FROM events ";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();
?>

	<!DOCTYPE html>
	<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Full calendar PHP</title>

		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- FullCalendar -->
		<link href='lib/fullcalendar.min.css' rel='stylesheet' />

		<script src='/lib/jquery.min.js'></script>
		<!-- jQuery Version 1.11.1 -->
		<script src="js/jquery.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>

		<!-- FullCalendar -->
		<script src='lib/moment.min.js'></script>
		<script src='lib/fullcalendar.min.js'></script>


		<!-- Custom CSS -->
		<style>
			body {
				padding-top: 50px;
				/* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
			}

            #container { 
                float: center;
                width: 1080px; 
                margin: 15px auto; 
                text-align: left; 
            }
            
			#calendar {
                float: left;
				max-width: 800px;
			}

			.col-centered {
				float: none;
				margin: 0 auto;
			}            
      #search_aside { 
         float: right; width: 300px; margin: 20px 0px; padding: 10px; background: #29abb9; 
      }
		</style>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	</head>

	<body>


		<!-- Page Content -->
		<div class="container">

			<div class="row">

				<div class="col-lg-12 text-center">

					<div id="calendar" class="col-centered">
					</div>
                    <!--search-->
                    <aside id="search_aside">
                        <div class = "input-group">
                        <div class = "input-group-text" id="basic-addon1">
                            <span class = "search"></span>
                        </div>
                        <!--search input-->
                        <input autofocus placeholder="search" class="form-control" type="text" autocomplete="off" name="search" id="search"/>
                        </div>
                        <ul class="list-group" id="list"></ul>
                    </aside>
                    <!--JS file-->    
                    <script src="js/search.js"></script>
				</div>

			</div>
			<!-- /.row -->

			<!-- Modal -->
			<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<form class="form-horizontal" method="POST" action="addEvent.php">

							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">Add Event</h4>
							</div>
							<div class="modal-body">

								<div class="form-group">
									<label for="title" class="col-sm-2 control-label">Title</label>
									<div class="col-sm-10">
										<input type="text" name="title" class="form-control" id="title" placeholder="Title">
									</div>
								</div>

								<div class="form-group">
									<label for="color" class="col-sm-2 control-label">Color</label>
									<div class="col-sm-10">
										<select name="color" class="form-control" id="color">
											<option value="">Choose</option>
											<option style="color:#0071c5;" value="#0071c5">&#9724; diary</option>
											<option style="color:#008000;" value="#008000">&#9724; todolist</option>
											<option style="color:#FFD700;" value="#FFD700">&#9724; acoount</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="start" class="col-sm-2 control-label">Start date</label>
									<div class="col-sm-10">
										<input type="text" name="start" class="form-control" id="start" readonly>
									</div>
								</div>
								<div class="form-group">
									<label for="end" class="col-sm-2 control-label">End date</label>
									<div class="col-sm-10">
										<input type="text" name="end" class="form-control" id="end" readonly>
									</div>
								</div>

								<div class="form-group">
									<label for="content" class="col-sm-2 control-label">Content</label>
									<div class="col-sm-10">
										<input type="text" name="content" class="form-control" id="content">
									</div>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Save changes</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<form class="form-horizontal" method="POST" action="editEventTitle.php">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">Edit Event</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="title" class="col-sm-2 control-label">Title</label>
									<div class="col-sm-10">
										<input type="text" name="title" class="form-control" id="title">
									</div>
								</div>

								<div class="form-group">
									<label for="color" class="col-sm-2 control-label">Color</label>
									<div class="col-sm-10">
										<select name="color" class="form-control" id="color">
											<option value="">Choose</option>
											<option style="color:#0071c5;" value="#0071c5">&#9724; diary</option>
											<option style="color:#008000;" value="#008000">&#9724; todolist</option>
											<option style="color:#FFD700;" value="#FFD700">&#9724; acoount</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="content" class="col-sm-2 control-label">Content</label>
									<div class="col-sm-10">
										<input type="text" name="content" class="form-control" id="content">
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<div class="checkbox">
											<label class="text-danger">
												<input type="checkbox" name="delete"> Delete event</label>
										</div>
									</div>
								</div>

								<input type="hidden" name="id" class="form-control" id="id">


							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Save changes</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /.container -->

		<?php date_default_timezone_set("Asia/Seoul");
	$date = date("Y-m-d");
	?>
		<script>

			$(document).ready(function () {

				$('#calendar').fullCalendar({

					header: {

						left: 'prev,next today',
						center: 'title',
						//right: 'month,basicWeek,basicDay'
						right: 'month'
					},

					navLinks: true,
					defaultDate: '<?php echo$date?>',
					minTime: '00:00:00',
					maxTime: '24:00:00',
					editable: true,

					eventLimit: true,
					selectable: true,
					selectHelper: true,
					select: function (start, end) {

						$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
						$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
						$('#ModalAdd').modal('show');
					},
					eventRender: function (event, element) {
						element.bind('dblclick', function () {
							$('#ModalEdit #id').val(event.id);
							$('#ModalEdit #title').val(event.title);
							$('#ModalEdit #color').val(event.color);
							$('#ModalEdit #content').val(event.content);
							$('#ModalEdit').modal('show');
						});
					},
					eventDrop: function (event, delta, revertFunc) {

						edit(event);

					},
					eventResize: function (event, dayDelta, minuteDelta, revertFunc) {

						edit(event);

					},
					events: [
			<?php foreach($events as $event):
						$start = explode(" ", $event['start']);
					$end = explode(" ", $event['end']);
					if($start[1] == '00:00:00'){
					$start = $start[0];
				}else {
					$start = $event['start'];
				}
				if ($end[1] == '00:00:00') {
					$end = $end[0];
				} else {
					$end = $event['end'];
				}
			?>
					{
						id: '<?php echo $event['id']; ?>',
						title: '<?php echo $event['title']; ?>',
						start: '<?php echo $start; ?>',
						end: '<?php echo $end; ?>',
						color: '<?php echo $event['color']; ?>',
						content: '<?php echo $event['content']; ?>',
					},
			<?php endforeach; ?>
			]
			});

			function edit(event) {
				start = event.start.format('YYYY-MM-DD HH:mm:ss');
				if (event.end) {
					end = event.end.format('YYYY-MM-DD HH:mm:ss');
				} else {
					end = start;
				}

				id = event.id;

				Event = [];
				Event[0] = id;
				Event[1] = start;
				Event[2] = end;

				$.ajax({
					url: 'editEventDate.php',
					type: "POST",
					data: { Event: Event },
					success: function (rep) {
						if (rep == 'OK') {
							alert('저장되었습니다.');
						} else {
							alert('다시 시도해주세요.');
						}
					}
				});
			}

	});

		</script>

	</body>

	</html>
