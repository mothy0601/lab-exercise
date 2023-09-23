<?php $index = 1; foreach($search_result as $search_results) { ?>
    <tr>
        <td class="align-middle"><?=  $index ?>.</td>
        <td class="align-middle"><?=  $search_results['item_code'] ?></td>
        <td class="align-middle"><?=  $search_results['item_name'] ?></td>
        <td class="text-center align-middle"><?=  $search_results['item_quantity'] ?></td>
        <td class="text-end align-middle"><?=  $search_results['item_price'] ?></td>
        <td class="text-center align-middle">
            <button onclick="update_item('<?=  $search_results['item_id'] ?>')" class="btn btn-primary btn-size-w btn-size-h align-middle">EDIT</button>
            <button onclick="delete_item('<?=  $search_results['item_id'] ?>')" class="btn btn-danger btn-size-w btn-size-h align-middle">DELETE</button>
        </td>
    </tr>
<?php $index++; } ?>