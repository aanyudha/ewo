<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_controller extends Admin_Core_Controller
{

    public function __construct()
    {
        parent::__construct();
		$this->load->library('jasper/PHPJasperXML.php');
    }

    /**
     * untuk report
     */
    public function reports()
    {
        check_permission('add_post');
        $data['title'] = trans('reports');
        $data['authors'] = $this->auth_model->get_all_users();
		$data['corps_post'] = $this->corp_model->get_all_corps();
        $data['form_action'] = admin_url() . "reports";
        $data['list_type'] = "reports";
        $data['checking_only_reports'] = "reports_";

        //get paginated posts
        $pagination = $this->paginate(admin_url() . 'reports', $this->post_admin_model->get_paginated_posts_count('reports'));
        $data['reports'] = $this->post_admin_model->get_paginated_posts($pagination['per_page'], $pagination['offset'], 'reports');

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/report/reports', $data);
        $this->load->view('admin/includes/_footer');
    }
	/**
     * untuk report by finished date
     
    public function reports2()
    {
        $this->load->view('admin/report/reports2');
    }*/
	
	/**
     * Filter report tanggal PDF
     */
    public function reports1_XLS()
    {
        //check_permission('users');
		$data['title'] = trans("reports2");
        $tglAwal = $this->input->post('tglAwal', true);
        $tglAkhir = $this->input->post('tglAkhir', true);
        $category = $this->input->post('category', true);
	   
	    $inputPath =  base_url() . "uploads/reports/report4.jrxml";
		$xml = simplexml_load_file($inputPath);
		$PHPJasperXML = new PHPJasperXML("en","XLS"); //if export excel, can use PHPJasperXML("en","XLS OR XLSX"); 
		//$PHPJasperXML->debugsql=true;	
		$dbdriver="mysql";//natively is 'mysql', 'psql', or 'sqlsrv'. the rest will use PDO driver. for oracle, use 'oci'
		//var_dump($inputPath);
		$PHPJasperXML->arrayParameter=array("inp_tgl_awal"=>"'".$tglAwal."'", "inp_tgl_akhir"=>"'".$tglAkhir."'", "inp_category"=>"'%".$category."%'");
		$PHPJasperXML->xml_dismantle($xml);
		$PHPJasperXML->transferDBtoArray('localhost','root','12345','ewohotel_tntrm',$dbdriver);
		$PHPJasperXML->outpage("I","reports_created_date.xls"); 
    }
	
	/**
     * Filter report tanggal PDF
     */
    public function reports2_PDF()
    {
        //check_permission('users');
		$data['title'] = trans("reports2");
        $tglAwal = $this->input->post('tglAwal', true);
        $tglAkhir = $this->input->post('tglAkhir', true);
        $category = $this->input->post('category', true);
	   
	    $inputPath =  base_url() . "uploads/reports/report2.jrxml";
		$xml = simplexml_load_file($inputPath);
		$PHPJasperXML = new PHPJasperXML("en","TCPDF"); //if export excel, can use PHPJasperXML("en","XLS OR XLSX"); 
		//$PHPJasperXML->debugsql=true;	
		$dbdriver="mysql";//natively is 'mysql', 'psql', or 'sqlsrv'. the rest will use PDO driver. for oracle, use 'oci'
		//var_dump($inputPath);
		$PHPJasperXML->arrayParameter=array("inp_tgl_awal"=>"'".$tglAwal."'", "inp_tgl_akhir"=>"'".$tglAkhir."'", "inp_category"=>"'%".$category."%'");
		$PHPJasperXML->xml_dismantle($xml);
		$PHPJasperXML->transferDBtoArray('localhost','root','12345','ewohotel_tntrm',$dbdriver);
		$PHPJasperXML->outpage('I'); 
    }
	
	/**
     * Filter report tanggal XLS
     */
    public function reports2_XLS()
    {
        //check_permission('users');
		$data['title'] = trans("reports2");
        $tglAwal = $this->input->post('tglAwal', true);
        $tglAkhir = $this->input->post('tglAkhir', true);
		 $category = $this->input->post('category', true);
		 
	    $inputPath =  base_url() . "uploads/reports/report5.jrxml";
		$xml = simplexml_load_file($inputPath);
		$PHPJasperXML = new PHPJasperXML("en","XLS"); //if export excel, can use PHPJasperXML("en","XLS OR XLSX"); 
		//$PHPJasperXML->debugsql=true;	
		$dbdriver="mysql";//natively is 'mysql', 'psql', or 'sqlsrv'. the rest will use PDO driver. for oracle, use 'oci'
		//var_dump($inputPath);
		$PHPJasperXML->arrayParameter=array("inp_tgl_awal"=>"'".$tglAwal."'", "inp_tgl_akhir"=>"'".$tglAkhir."'", "inp_category"=>"'%".$category."%'");
		$PHPJasperXML->xml_dismantle($xml);
		$PHPJasperXML->transferDBtoArray('localhost','root','12345','ewohotel_tntrm',$dbdriver);
		$PHPJasperXML->outpage("I","reports_replied_date.xls");
    }
	
	 /**
     * untuk report in
     */
    public function reports_in()
    {
        check_permission('add_post');
        $data['title'] = trans('reports_in');
        $data['authors'] = $this->auth_model->get_all_users();
		$data['corps_post'] = $this->corp_model->get_all_corps();
		$data['role_post_in'] = $this->auth_model->get_active_role_for_dept();
        $data['form_action'] = admin_url() . "reports_in";
        $data['list_type'] = "reports_in";
        $data['checking_only_reports'] = "reports_";

        //get paginated posts
        $pagination = $this->paginate(admin_url() . 'reports_in', $this->post_admin_model->get_paginated_posts_in_count('reports_in'));
        $data['reports_in'] = $this->post_admin_model->get_paginated_posts_in($pagination['per_page'], $pagination['offset'], 'reports_in');

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/report/reports_in', $data);
        $this->load->view('admin/includes/_footer');
    }
	
	 /**
     * untuk report out
     */
    public function reports_out()
    {
        check_permission('add_post');
        $data['title'] = trans('reports_out');
        $data['authors'] = $this->auth_model->get_all_users();
        $data['authors_only_dept'] = $this->auth_model->get_users_by_dept_id(user()->dept_id);
        $data['dep'] = $this->department_model->get_all_departments();
		$data['corps_post'] = $this->corp_model->get_all_corps();
        $data['form_action'] = admin_url() . "reports_out";
        $data['list_type'] = "reports_out";
        $data['checking_only_reports'] = "reports_";

        //get paginated posts
        $pagination = $this->paginate(admin_url() . 'reports_out', $this->post_admin_model->get_paginated_posts_out_count('reports_out'));
        $data['reports_out'] = $this->post_admin_model->get_paginated_posts_out($pagination['per_page'], $pagination['offset'], 'reports_out');

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/report/reports_out', $data);
        $this->load->view('admin/includes/_footer');
    }
	
	
}
