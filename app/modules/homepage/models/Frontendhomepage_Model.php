<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontendHomePage_Model extends FC_Model{

    public function __construct(){
        parent::__construct();
    }
    public function ReadAllItems( $start = 0, $limit = 0, $order='desc'){
        $this->db->select('id, title,fullname,created,title,message,description');
        $this->db->where(array('type' => 0,'publish' => 1, 'trash' => 0));
        $this->db->from('mailsubricre');
        $this->db->order_by('id '.$order.'');
        $this->db->limit($limit, $start);
        $result = $this->db->get()->result_array();
        $this->db->flush_cache();
        return $result;
    }

    public function CountAllItems(){
        $this->db->select('id, title,fullname,created,title,message,description');
        $this->db->where(array('type' => 0,'publish' => 1, 'trash' => 0));
        $this->db->from('mailsubricre');
        $this->db->order_by('id desc');
        $result = $this->db->count_all_results();
        $this->db->flush_cache();
        return $result;
    }


//    public function ReadAllItemsViewed( $start = 0, $limit = 0, $order='desc'){
//        $this->db->select('articles.id, articles.title, articles.slug, articles.canonical, articles.images,articles.viewed, articles.created,articles.description,articles.content,catalogues, (SELECT fullname FROM users WHERE users.id = articles.userid_created) as fullname,(SELECT fullname FROM users WHERE users.id = articles.userid_updated) as fullname_update, (SELECT title FROM articles_catalogues WHERE articles.cataloguesid = articles_catalogues.id) as catalogue');
//        $this->db->where(array('articles.publish' => 1, 'articles.trash' => 0, 'articles.alanguage' => 'vietnamese'));
//        $this->db->from('articles');
//        $this->db->order_by('articles.viewed '.$order.'');
//        $this->db->limit($limit, $start);
//        $result = $this->db->get()->result_array();
//        $this->db->flush_cache();
//        return $result;
//    }
//
//    public function CountAllItemsViewed(){
//        $this->db->select('articles.id, articles.title, articles.slug, articles.canonical, articles.images,articles.viewed, articles.created,articles.description,articles.content');
//        $this->db->where(array('articles.publish' => 1, 'articles.trash' => 0, 'articles.alanguage' => 'vietnamese'));
//        $this->db->from('articles');
//        $this->db->order_by('articles.viewed desc');
//        $result = $this->db->count_all_results();
//        $this->db->flush_cache();
//        return $result;
//    }
//    public function ReadAllItemsId( $start = 0, $limit = 0, $order='desc'){
//        $this->db->select('articles.id, articles.title, articles.slug, articles.canonical, articles.images,articles.viewed, articles.created,articles.description,articles.content,catalogues, (SELECT fullname FROM users WHERE users.id = articles.userid_created) as fullname,(SELECT fullname FROM users WHERE users.id = articles.userid_updated) as fullname_update, (SELECT title FROM articles_catalogues WHERE articles.cataloguesid = articles_catalogues.id) as catalogue');
//        $this->db->where(array('articles.publish' => 1, 'articles.trash' => 0, 'articles.alanguage' => 'vietnamese'));
//        $this->db->from('articles');
//        $this->db->order_by('articles.id desc');
//        $this->db->limit($limit, $start);
//        $result = $this->db->get()->result_array();
//        $this->db->flush_cache();
//        return $result;
//    }
//
//    public function CountAllItemsId(){
//        $this->db->select('articles.id, articles.title, articles.slug, articles.canonical, articles.images,articles.viewed, articles.created,articles.description,articles.content');
//        $this->db->where(array('articles.publish' => 1, 'articles.trash' => 0, 'articles.alanguage' => 'vietnamese'));
//        $this->db->from('articles');
//        $this->db->order_by('articles.id desc');
//        $result = $this->db->count_all_results();
//        $this->db->flush_cache();
//        return $result;
//    }
//
//    public function ReadAllItemsCmt( $start = 0, $limit = 0, $order='desc'){
//        $this->db->select('id, fullname, message,module,moduleid');
//        $this->db->where(array('publish' => 1, 'trash' => 0));
//        $this->db->from('comments');
//        $this->db->order_by('comments.id desc');
//        $this->db->limit($limit, $start);
//        $result = $this->db->get()->result_array();
//        $this->db->flush_cache();
//        return $result;
//    }
//
//    public function CountAllItemsCmt(){
//        $this->db->select('id, fullname, message,module,moduleid');
//        $this->db->where(array('publish' => 1, 'trash' => 0));
//        $this->db->from('comments');
//        $this->db->order_by('comments.id desc');
//        $result = $this->db->count_all_results();
//        $this->db->flush_cache();
//        return $result;
//    }

}
