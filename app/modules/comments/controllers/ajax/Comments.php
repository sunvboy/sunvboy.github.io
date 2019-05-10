<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends FC_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model(array('BackendComments_Model','FrontendComments_Model'));
		$this->load->library('ConfigBie');
	}

	public function addcomment(){
		$module = $this->input->post('module');
		$moduleid = $this->input->post('moduleid');
		$parentid = $this->input->post('parentid');
		$alert = array(
			'error' => '',
			'message' => '',
			'result' => ''
		);
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', ' / ');
		$this->form_validation->set_rules('fullname', 'Họ và tên', 'trim|required');
//		$this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|required');
		$this->form_validation->set_rules('contents', 'Nội dung', 'trim|required');
		if ($this->form_validation->run($this)){
			$post = $this->input->post('post');
			$data = '';
			if(isset($post) && is_array($post) && count($post)){
				// print_r($post);die;
				foreach($post as $key => $val){
					$data[$val['name']] = nl2br($val['value']) ;
				}
			}else{
				$data['fullname'] = $this->input->post('fullname');
				$data['message'] = $this->input->post('contents');
			}
			$data['parentid'] = $parentid;
			$data['module'] = $module;
			$data['moduleid'] = $moduleid;
			$data['publish'] = 0;
			$data['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);

			if(isset($data) && is_array($data) && count($data)){
				$this->db->insert('comments', $data);
				$this->db->flush_cache();
			}
		}else{
			$alert['error'] = validation_errors();
		}
		echo json_encode($alert); die();
	}
	
	
	public function listComment(){
		$module = $this->input->post('module');
		$moduleid = $this->input->post('moduleid');
		$page = $this->input->post('page');
		$pageid = $this->input->post('pageid');
		$page = (int)$page;
		$config['total_rows'] = $this->FrontendComments_Model->Countall($module, $moduleid,$pageid);
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['base_url'] ='#" data-page="';
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 10;
			$config['cur_page'] = $page;
			$config['page'] = $page; 
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['reuse_query_string'] = TRUE;
			$config['full_tag_open'] = '<div class="pagination mb30"><ul class="uk-pagination uk-pagination-right" style="padding: 0px">';
			$config['full_tag_close'] = '</ul></div>';
			$config['first_tag_open'] = '<li style="padding: 0px">';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li style="padding: 0px">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="uk-active" style="padding: 0px"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['next_tag_open'] = '<li style="padding: 0px">';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li style="padding: 0px">';
			$config['prev_tag_close'] = '</li>';
			$config['num_tag_open'] = '<li style="padding: 0px">';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['listPagination'] = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			// print_r($data['listPagination']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$data['listComment'] = $this->FrontendComments_Model->View(($page * $config['per_page']),$config['per_page'], $module, $moduleid,$pageid);
			$data['listComment'] = recursive($data['listComment']);
			//var_dump($data['listComment']);die();
			// $data['listComment'] = recursive($data['listComment']);
		}
		$member_log = json_decode($this->session->userdata('fc_customer_auth'), TRUE);
		$html = '';
		if(isset($data['listComment']) && is_array($data['listComment']) && count($data['listComment'])){
			foreach($data['listComment'] as $key => $val){
				$html = $html . '<li class="comment even thread-odd thread-alt depth-1" id="comment-'.$val['id'].'">';
				$html = $html . '<article>';
					$html = $html . '<header class="comment-header"><p class="comment-author"><img alt="'.$val['fullname'].'" src="https://secure.gravatar.com/avatar/3d66ebd4719dd1630aba274cbbe5e0a9?s=48&amp;d=mm&amp;r=g"  class="avatar avatar-48 photo"height="48" width="48"></p><div class="comment-meta"><p><span><a target="_blank" href="javascript:void();" class="comment-author-link">'.$val['fullname'].'</a> <span class="says">nói</span></span></p><p><time class="comment-time"><a href="javascript:void();" class="comment-time-link" >'.$val['created'].'</a></time></p></div></header>';

					$html = $html . ' <div class="comment-content"><p>'.$val['message'].'</p></div><div class="comment-reply item-reply" data-id="'.$val['id'].'"><a rel="nofollow" class="comment-reply-link" href="javascript:void();">Trả lời</a></div>';
				$html = $html . '</article>';
				$html = $html . '<div class="reply-comment" style="margin-top: 50px;"></div>';


				if(isset($val['child']) && is_array($val['child']) && count($val['child'])) {
					foreach($val['child'] as $keyg => $vals){
					$html = $html . ' <ul class="children">
                <li class="comment byuser comment-author-hd00842 bypostauthor odd alt depth-2" id="comment-'.$vals['id'].'">
                    <article>
                        <header class="comment-header">
                            <p class="comment-author">
                                <img alt="'.$vals['fullname'].'" src="https://secure.gravatar.com/avatar/3d66ebd4719dd1630aba274cbbe5e0a9?s=48&amp;d=mm&amp;r=g" class="avatar avatar-48 photo" height="48" width="48">
                            </p>
                            <div class="comment-meta">
                                <p><span><a target="_blank" href="javascript:void();" class="comment-author-link">'.$vals['fullname'].'</a> <span class="says">nói</span></span></p>
                                <p>
                                    <time class="comment-time">
                                        <a href="javascript:void();" class="comment-time-link" >'.$vals['created'].'</a>
                                    </time>
                                </p>
                            </div>
                        </header>
                        <div class="comment-content">
                            <p>'.$vals['message'].'</p>
                        </div>

                    </article>
                </li>
            </ul>';

				}}

				$html = $html . '</li>';


			}
			$html = $html . '<li class="ajax-pagination">'.$data['listPagination'].'</li>';
		}else{
			$html = $html.'';
		}
		echo json_encode(array(
			'html' => $html,
		));
		// die();
	}
	
}
