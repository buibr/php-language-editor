<?php header('Content-Type: text/html; charset=utf-8'); ?>

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
	
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" >
	<script src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"   integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw=" crossorigin="anonymous"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css"  rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	
	<link rel="stylesheet" type="text/css" href="DataTables/DataTables-1.10.11/css/dataTables.bootstrap.min.css"/>
	<?php /*
	<link rel="stylesheet" type="text/css" href="DataTables/Buttons-1.1.2/css/buttons.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="DataTables/DataTables/DataTables/ColReorder-1.3.1/css/colReorder.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="DataTables/DataTables/FixedColumns-3.2.1/css/fixedColumns.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="DataTables/FixedHeader-3.1.1/css/fixedHeader.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="DataTables/DataTables/KeyTable-2.1.1/css/keyTable.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="DataTables/Responsive-2.0.2/css/responsive.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="DataTables/DataTables/RowReorder-1.1.1/css/rowReorder.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="DataTables/Scroller-1.4.1/css/scroller.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="DataTables/Select-1.1.2/css/select.bootstrap.min.css"/>
	*/ ?>
	
	
	<script type="text/javascript" src="DataTables/DataTables-1.10.11/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="DataTables/DataTables-1.10.11/js/dataTables.bootstrap.min.js"></script>
	<?php /*
	<script type="text/javascript" src="DataTables/JSZip-2.5.0/jszip.min.js"></script>
	<script type="text/javascript" src="DataTables/pdfmake-0.1.18/build/pdfmake.min.js"></script>
	<script type="text/javascript" src="DataTables/pdfmake-0.1.18/build/vfs_fonts.js"></script>
	<script type="text/javascript" src="DataTables/Buttons-1.1.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="DataTables/Buttons-1.1.2/js/buttons.bootstrap.min.js"></script>
	<script type="text/javascript" src="DataTables/Buttons-1.1.2/js/buttons.colVis.min.js"></script>
	<script type="text/javascript" src="DataTables/Buttons-1.1.2/js/buttons.flash.min.js"></script>
	<script type="text/javascript" src="DataTables/Buttons-1.1.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="DataTables/Buttons-1.1.2/js/buttons.print.min.js"></script>
	<script type="text/javascript" src="DataTables/ColReorder-1.3.1/js/dataTables.colReorder.min.js"></script>
	<script type="text/javascript" src="DataTables/FixedColumns-3.2.1/js/dataTables.fixedColumns.min.js"></script>
	<script type="text/javascript" src="DataTables/FixedHeader-3.1.1/js/dataTables.fixedHeader.min.js"></script>
	<script type="text/javascript" src="DataTables/KeyTable-2.1.1/js/dataTables.keyTable.min.js"></script>
	<script type="text/javascript" src="DataTables/Responsive-2.0.2/js/dataTables.responsive.min.js"></script>
	<script type="text/javascript" src="DataTables/Responsive-2.0.2/js/responsive.bootstrap.min.js"></script>
	<script type="text/javascript" src="DataTables/RowReorder-1.1.1/js/dataTables.rowReorder.min.js"></script>
	<script type="text/javascript" src="DataTables/Scroller-1.4.1/js/dataTables.scroller.min.js"></script>
	<script type="text/javascript" src="DataTables/Select-1.1.2/js/dataTables.select.min.js"></script>
	*/ ?>
	<!-- Latest compiled and minified JavaScript -->
	</head>
	<body>
		<?php include 'functions.php'; ?>
		
		<div class="container">
			<style>
				.sidebar-nav-fixed {
					width:20%;
					top:50px;
				}
				.affix {
					position: fixed;
				} 
				
				table.table tr:focus, table.table td:focus{
					outline: 3px solid #337ab7;
				}
				.list-group {
					padding-left: 0;
					margin: 5px -10px 5px -15;
				}
				.pull-right .list-group {
					padding-left: 0;
					margin: 5px -15px 5px -10;
				}
			</style>
			<nav class="navbar navbar-default navbar-fixed-top">
			  <div class="container">
				<div class="col-xs-6 col-sm-2 col-md-1" >
					<div class="list-group">
						<a href="/" class="list-group-item text-center">
							<h4 class="list-group-item-heading"><i class="glyphicon glyphicon-refresh" style="font-size:38px"></i> </h4>
						</a>
					</div>
				</div>
				  
				<div class="col-xs-6 col-sm-3 col-md-2" >
					<div class="list-group">
						<a href="#" class="list-group-item">
							<h4 class="list-group-item-heading">Edit:</h4>
							<p class="list-group-item-text"> <span class="text-success"><b>Click, Focus</b></span></p>
						</a>
					</div>
				</div>

				<div class="col-xs-6 col-sm-3 col-md-2 hidden-xs" >
					<div class="list-group">
						<a href="#" class="list-group-item">
							<h4 class="list-group-item-heading">SAVE:</h4>
							<p class="list-group-item-text"> <span class="text-danger"><b>CTRL + ENTER</b></span></p>
						</a>
					</div>
				</div>

				<div class="col-xs-6 col-sm-3 col-md-2" >
					<div class="list-group">
						<a href="#" class="list-group-item">
							<h4 class="list-group-item-heading">Status:</h4>
							<p req-sts="true" class="list-group-item-text"> - </p>
						</a>
					</div>
				</div>
				  
				
				<div class="col-xs-6 col-sm-3 col-md-2 pull-right" >
					<div class="list-group">
						<a href="#" class="list-group-item" data-toggle="modal" data-target="#addModal">
							<h4 class="list-group-item-heading text-center">ADD:</h4>
							<p class="list-group-item-text text-center"> <span class="text-primary"><b>add new word</b> </p>
						</a>
					</div>
				</div>
				<div class="col-xs-6 col-sm-2 col-md-1 pull-right" >
					<div class="list-group">
						<a href="#" class="list-group-item text-center dropdown-toggle" data-toggle="dropdown" id="save-all">
							<h4 class="list-group-item-heading"><i class="glyphicon glyphicon-floppy-disk" style="font-size:33px"></i> </h4>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu dropdownn-right">
							<li><a href="#" id="en" onclick="saveLang('en');" >EN</a></li>
							<li><a href="#" id="al" onclick="saveLang('al');" >AL</a></li>
							<li><a href="#" id="mk" onclick="saveLang('mk');" >MK</a></li>
							<li class="divider"></li>
							<li><a href="#" data-toggle="modal" data-target="#selectFolder">Set Directory</a></li>
						</ul>
					</div>
				</div>
				  
			  </div>
			</nav>
			
			<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
				<div class="modal-content modal-sm">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Add new word</h4>
				  </div>
				  <div class="modal-body">
					<form method="post" id="addformmodal">
						<div class="form-group">
							<label class="control-label" for="word_key"> KEY </label>
							<input type="text" name="word_key" id="word_key" class="form-control" value="" required />
						</div>
						<div class="form-group">
							<label class="control-label" for="word_en"> EN </label>
							<input type="text" name="word_en" id="word_en" class="form-control" value="" required />
						</div>
						<div class="form-group">
							<label class="control-label" for="word_al"> AL </label>
							<input type="text" name="word_al" id="word_al" class="form-control" value="" required />
						</div>
						<div class="form-group">
							<label class="control-label" for="word_mk"> MK </label>
							<input type="text" name="word_mk" id="word_mk" class="form-control" value="" required />
						</div>
					</form>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					<button type="button" id="addbuttonsubmit"  class="btn btn-primary">Save</button>
				  </div>
				</div>
			  </div>
			</div>

			<!-- MODAL CHANGE DIRECTORY -->
			<div class="modal fade" id="selectFolder" tabindex="-1" role="dialog" aria-labelledby="Select Directory">
			  <div class="modal-dialog" role="document">
				<div class="modal-content modal-sm">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Change Driectory</h4>
				  </div>
				  <div class="modal-body">
					<form method="post" id="setDir">
						<div class="form-group">
							<label class="control-label" for="word_mk"> Chose directory: </label>
							<?php
							$cdir = isset($_COOKIE['dir']) ? $_COOKIE['dir'] : "";
							?>
							<input type="text" class="form-control" name="dirtosave" id="dirtosave" value="<?=$cdir?>"  />
						</div>
					</form>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					<button type="button" id="addbuttonsubmit"  class="btn btn-primary">Save</button>
				  </div>
				</div>
			  </div>
			</div>


			
			<section id="main" class="row" style="margin-top:90px;">
				
				<section class="col-xs-12">
				
					<table id="table" class="display table table-bordered responsive no-wrap" width="100%">
						<thead>
							<tr>
								<th>Key</th>
								<th>EN</th>
								<th>AL</th>
								<th>MK</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody bTBody='true'>
							<?php foreach(getListAll() as $k=>$v):?>
							<tr gtd="<?=$k?>" >
								<td class="warning" ><b><?=$k?></b></td>
								<?=isset($v['en']) ? "<td contentEditable='true' gd='true' gl='en' gk='".$k."'>".$v['en']."</td>" : "<td class='danger' contentEditable='true' gd='true' gl='en' gk='".$k."'></td>"?>
								<?=isset($v['al']) ? "<td contentEditable='true' gd='true' gl='al' gk='".$k."'>".$v['al']."</td>" : "<td class='danger' contentEditable='true' gd='true' gl='al' gk='".$k."'></td>"?>
								<?=isset($v['mk']) ? "<td contentEditable='true' gd='true' gl='mk' gk='".$k."'>".$v['mk']."</td>" : "<td class='danger' contentEditable='true' gd='true' gl='mk' gk='".$k."'></td>"?>
								<td><button class="btn btn-xs btn-danger" gr='true' gk='<?=$k?>'><i class="fa fa-times fa-fw"></i> Delete</button></td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
					
				</section>
				
			</section>
			
		</div>
		<script>
			$(document).ready(function(){
				
				//console.log($("td[gd=true]").length);
				
				$(".affix").css("width", $("aside").outerWidth() - 15);
				$("#main").css("margin-top", ($("nav").outerHeight() + 15) + "px");
				
				console.log($("nav").outerHeight());
				
				$('#table').DataTable( {
					pageLength: 1000,
					"paging": false
				});
				
				$st = $("p[req-sts]");
				
				$("td[gd=true]").on('keyup', function(e){
					$cl = $(this);
					$gk = $cl.attr('gk');
					$gl = $cl.attr('gl');
					$gw = $cl.html().trim();
					dts = "gk=" + $gk + "&gl=" + $gl + "&gw=" + $gw;
					url = "ajax.php?update";
					
					//console.log(e);
					
					if(e.ctrlKey && e.keyCode == 13  || e.ctrlKey && e.keyCode == 83 ) /// if CTRL+Enter  ose CTRL + S
					{
						console.log('saving...');
						e.preventDefault();
						$.ajax({
							method: "POST",
							url: url,
							data: dts,
							dataType: "json",
							success: function ( resp )
							{
								if(resp.status === 'ok')
								{
									$($cl).removeClass('danger').addClass('success');
									$st.html('<span class="text-success"><b>Fjala u editua</b></span>');
								}
								else
								{
									$st.html('<span class="text-danger"><b>Editimi Dështoi.</b></span>');
									$($cl).removeClass('success').addClass('danger');
								}
							},
							error: function (data)
							{
								console.error(data);
							}
						});
					}
					
					if(e.keyCode == 37){} //left
					if(e.keyCode == 38){} //up
					if(e.keyCode == 39) //right
					if(e.keyCode == 40){} //bottom
						

				});
				
				
				$("td[gd=true]").on('focusout', function(e){
					$st.animate({opacity: 0}, 500, function(){ $st.html('-').css('opacity', '1');});
				});
				
				/// for remove an word
				$("button[gr]").on('click', function(){
					$btn = $(this);
					$gk = $btn.attr('gk');
					$tr = $('tr[gtd='+$gk+']');
					dts = "gk=" + $gk;
					url = "ajax.php?remove";
					
					var $confirm = confirm("A jeni te sigurt qe doni ta eliminoni");
					
					if($confirm === true)
					{						
						$.ajax({
							method: "POST",
							url: url,
							data: dts,
							dataType: "json",
							success: function ( resp )
							{
								if(resp.status === 'ok')
								{
									$tr.remove();
									$st.html('<span class="text-success"><b>U eliminua.</b></span>');
								}
								else
								{
									$st.html('<span class="text-danger"><b>Eliminimi Dështoi.</b></span>');
									$($btn).removeClass('success').addClass('danger');
								}
							},
							error: function ( resp )
							{
								console.error( resp );
							}
						});
					}
				});
				
				
				// from modal to add new keyword
				$("#addbuttonsubmit").click(function(){
					var dat = $("#addformmodal").serialize();
					var tBd = $('tbody[bTBody]');
					var url = "ajax.php?add";
					
					var inp = $("#addformmodal :input");
					var arr = new Array;
					inp.each(function(e){
						arr[$(this).attr('name')] = $(this).val();
					});
					
					if(arr.word_key === '')
					{
						$("input[name=word_key]").parent().addClass('has-error');
						alert('Key nuk mund te jet i zbrazet');
					}
					else
					{
						console.log(arr);
						console.log(arr.word_key);
						
						var $confirm = confirm("A jeni te sigurt qe doni ta shtoni kete fjale");
						
						if($confirm === true)
						{						
							$.ajax({
								method: "POST",
								url: url,
								data: dat,
								dataType: "json",
								success: function ( resp )
								{
									console.log(resp);
									
									if(resp.status === 'ok')
									{
										$st.html('<span class="text-success"><b>U krijua me sukses.</b></span>');
										
										$('#addModal').modal('toggle');
										
										var str ="";
										str = "<tr gtd='" + resp.word_key + "'>"
										+ '<td class="warning" ><b>' + resp.word_key + '</b></td>'
										+ '<td contentEditable="true" gd="true" gl="'+ resp.word_en + '" gk="' + resp.word_key + '">' + resp.word_en + '</td>'
										+ '<td contentEditable="true" gd="true" gl="'+ resp.word_al + '" gk="' + resp.word_key + '">' + resp.word_al + '</td>'
										+ '<td contentEditable="true" gd="true" gl="'+ resp.word_mk + '" gk="' + resp.word_key + '">' + resp.word_mk + '</td>'
										+ '<td><button class="btn btn-xs btn-danger" gr="true" gk="' + resp.word_key + '"><i class="fa fa-times fa-fw"></i> Delete</button></td>'
										+ '</tr>';

										tBd.append(str);

									}
									else
									{
										if(typeof resp.error != 'undefined')
										{
											$st.html('<span class="text-danger"><b>' + resp.error + '</b></span>');
										}
										else
										{
											$st.html('<span class="text-danger"><b>Krijimi dështoi.</b></span>');
										}
									}
								},
								error: function ( resp )
								{
									console.error( resp );
								}
							});
						}
					}
				})

				// from modal to add new keyword
				$("#dirtosave").change(function(){

					var val = $("#dirtosave").val(),
					 	url = "ajax.php?changedir",
						dat = "dir="+val;	

					$.ajax({
						method: "POST",
						url: url,
						data: dat,
						dataType: "json",
						success: function ( resp )
						{
							console.log(resp);
							
							if(resp.status === 'ok')
							{
								$st.html('<span class="text-success"><b>Lokacioni u ruajt.</b></span>');
								

							}
							else if(resp.status === 'message')
							{
								if(typeof resp.error != 'undefined')
								{
									$st.html('<span class="text-danger"><b>' + resp.message + '</b></span>');
								}
								else
								{
									$st.html('<span class="text-danger"><b>Krijimi dështoi.</b></span>');
								}
							}
							else
							{
								if(typeof resp.error != 'undefined')
								{
									$st.html('<span class="text-danger"><b>' + resp.error + '</b></span>');
								}
								else
								{
									$st.html('<span class="text-danger"><b>Krijimi dështoi.</b></span>');
								}
							}
						},
						error: function ( resp )
						{
							console.error( resp );
						}
					});
				})

				
				
			});

			function saveLang(lang)
				{

					var lang = lang,
					 	url = "ajax.php?save",
						dat = "lang="+lang;	

					$.ajax({
						method: "POST",
						url: url,
						data: dat,
						dataType: "json",
						success: function ( resp )
						{
							console.log(resp);
							
							if(resp.status === 'ok')
							{
								$st.html('<span class="text-success"><b>Ruajtja u kry.</b></span>');
								

							}
							else if(resp.status === 'message')
							{
								if(typeof resp.error != 'undefined')
								{
									$st.html('<span class="text-danger"><b>' + resp.message + '</b></span>');
								}
								else
								{
									$st.html('<span class="text-danger"><b>Krijimi dështoi.</b></span>');
								}
							}
							else
							{
								if(typeof resp.error != 'undefined')
								{
									$st.html('<span class="text-danger"><b>' + resp.error + '</b></span>');
								}
								else
								{
									$st.html('<span class="text-danger"><b>Krijimi dështoi.</b></span>');
								}
							}
						},
						error: function ( resp )
						{
							console.error( resp );
						}
					});
				}
		</script>
	</body>
</html>