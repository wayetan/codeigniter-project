<?php defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/_parts/public_master_header_view'); ?>
<?php echo $the_view_content;?>
<?php $this->load->view('modals/login_register_modal');?>
<?php $this->load->view('templates/_parts/public_master_footer_view');?>
