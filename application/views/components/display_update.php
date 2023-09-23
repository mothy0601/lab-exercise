<?php $item_data = json_encode($search_u_result); $data = json_decode($item_data, true); $item = $data[0];  ?>
<form id="item-update">
	<div class="modal-body">
        <label for="item_u_code">ITEM ID</label>
        <input class="form-control" type="text" id="item_u_id" name="item_u_id" style="pointer-events: none;" value='<?= $item['item_id'] ?>' required>
        <label for="item_u_code">ITEM CODE</label>']
        <input class="form-control" type="text" id="item_u_code" name="item_u_code" value='<?= $item['item_code'] ?>' required>
        <label for="item_u_name">NAME</label>
        <input class="form-control" type="text" id="item_u_name" name="item_u_name" value='<?= $item['item_name'] ?>' required>
        <label for="item_u_qty">QUANTITY</label>
        <input class="form-control" type="number" id="item_u_qty" name="item_u_qty" value='<?= $item['item_quantity'] ?>' required>
        <label for="item_u_price">PRICE</label>
        <input class="form-control" type="number" step=any id="item_u_price" name="item_u_price" value='<?= $item['item_price'] ?>' required>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-size-h btn-size-w">Update</button>
    </div>
</form>
<script>
$('#item-update').on('submit',function(e){
    event.preventDefault();
        $.ajax({
            url: "home_page/c_update_item_control",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.includes('success')) {
                    search_menu();
                    alert("Item Updated");
                    $("#item-update")[0].reset();
                    $('#update-modal').modal('hide');
                } else {
                    alert(data);
                }
            }
        });
    });
</script>