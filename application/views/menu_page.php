<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Items List</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
		text-decoration: none;
	}

	a:hover {
		color: #97310e;
	}

	h1 {
		color: #444;
		background-color: transparent;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
		min-height: 96px;
	}

	p {
		margin: 0 0 10px;
		padding:0;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	.btn-size-w{
		width: 150px;
	}
	.btn-size-h{
		height: 40px;
	}
	.div-b {
		border-bottom: 1px solid #D0D0D0;
	}
	</style>

	<link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">  


</head>
	<script src="assets/bootstrap/jquery-3.6.1.min.js"></script>
  	<script src="assets/bootstrap/bootstrap.bundle.min.js"></script>
<body>

<div id="container">
	<div class="d-flex div-b w-100">
		<div style="width: 12%">
			<h1>Item List</h1>
		</div>
		<div class="p-4" style="width: 10%">
			<button class="btn btn-success btn-size-w btn-size-h" data-bs-toggle="modal" data-bs-target="#add-modal">ADD ITEM</button>
		</div>
		<div style="width: 50%"></div>
		<div class="d-flex p-4" style="width: 28%">
			<label class="m-2" for="search_id"><b>SEARCH:</b></label>
			<input oninput="search_menu()" id="search_id" type="text" class="form-control">
		</div>
	</div>
	<div id="body">
		<table class="table table-strip">
			<thead>
				<tr>
					<th>No.</th>
					<th>Item Code</th>
					<th>Name</th>
					<th class="text-center">Quantity</th>
					<th class="text-center">Price</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody id="item-body">
				
			</tbody>
		</table>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="item-add">
				<div class="modal-body">
					<label for="item_code">ITEM CODE</label>
					<input class="form-control" type="text" id="item_code" name="item_code" required>
					<label for="item_name">NAME</label>
					<input class="form-control" type="text" id="item_name" name="item_name" required>
					<label for="item_qty">QUANTITY</label>
					<input class="form-control" type="number" id="item_qty" name="item_qty" required>
					<label for="item_price">PRICE</label>
					<input class="form-control" type="number" step=any id="item_price" name="item_price" required>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-size-h btn-size-w">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Update Item</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="update-div">

			</div>
		</div>
	</div>
</div>


</body>
<script>
	search_menu();
	function search_menu(){
		$('#item-body').html('')
        $.post("home_page/search_control",{
			search: $('#search_id').val(),
        },function(data){
            $('#item-body').html('')
            $('#item-body').html(data)
        })
	}

	function update_item(update_id){
		$('#update-div').html('')
        $.post("home_page/update_item_control",{
			update_id: update_id,
        },function(data){
            $('#update-div').html('')
            $('#update-div').html(data)
			$('#update-modal').modal('show');
        })
	}

	function delete_item(delete_id){
        $.post("home_page/delete_item_control",{
			delete_id: delete_id,
        },function(data){
			if (data.includes('success')) {
				search_menu();
				alert("Item Deleted");
			} else {
				alert(data);
			}
        })
	}
	$('#item-add').on('submit',function(e){
		event.preventDefault();
		$.ajax({
			url: "home_page/add_item_control",
			method: "POST",
			data: new FormData(this),
			contentType: false,
			processData: false,
			success: function(data) {
				if (data.includes('success')) {
					search_menu();
					alert("Item Added");
					$("#item-add")[0].reset();
					$('#add-modal').modal('hide');
				} else {
					alert(data);
				}
			}
		});
	});

	
</script>
</html>
