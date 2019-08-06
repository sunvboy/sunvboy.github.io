<section class="content-header">
    <h1>Bảng điều khiển</h1>
    <ol class="breadcrumb">
        <li class="active"><a href="<?php echo site_url('admin'); ?>"><i class="fa fa-dashboard"></i> Bảng điều
                khiển</a></li>
    </ol>
</section>
<?php
$_payments = $this->Autoload_Model->_get_where(array('select' => 'fullname, phone, created, id, total_price', 'table' => 'payments', 'where' => array('trash' => 0, 'status' => 'wait'), 'limit' => 10,), TRUE);
$_count_new_payment = $this->Autoload_Model->_get_where(array('select' => 'fullname, phone, created, id, total_price', 'table' => 'payments', 'where' => array('trash' => 0, 'status' => 'wait'),), TRUE);
$_count_new_payment = count($_count_new_payment);
$_count_all_product = $this->db->select('id')->from('products')->where(array('trash' => 0))->count_all_results();
$row = $this->db->select('*')->from('counter_values')->get()->row_array();
$_count_all_visitor = $row['all_value'];
$_count_all_contact = $this->db->select('id')->from('contacts')->where('trash', 0)->count_all_results();
?>

<?php echo show_flashdata(); ?>
<?php $this->fcUser = $this->config->item('fcUser'); ?>
<?php if (in_array('users/backend/groups/dashboard', $this->fcUser['group'])) { ?>
  
<?php } else { ?>
    <section class="content"></section>
<?php } ?>