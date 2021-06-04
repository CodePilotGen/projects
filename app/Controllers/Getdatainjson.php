<?php
//if( ! defined('BASEPATH')) exit('No direct script access allowed');


namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\Response;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

class Getdatainjson extends BaseController {

	public function allquestions(){
		$db = db_connect();
		$builder = $db->table('options');
		$builder->select('q.*,options.option_id, options.option_content,  
							GROUP_CONCAT(h.hyp_id,":",h.hyp_content,":", oh.option_hyp_point,":",oh.option_hyp_id) AS hyp_with_point');

		$builder->join('option_hyp AS oh', 'oh.option_id = options.option_id','left');
		$builder->join('hyps AS h', 'oh.hyp_id = h.hyp_id','left');
		$builder->join('questions AS q', 'q.question_id = options.question_id','left');
		$builder->groupBy('options.option_id');

		$query = $builder->get();
		$result = $query->getResultArray();


		$builder = $db->table('hyps');
		$builder->select('hyps.*');
		$query = $builder->get();
		$result_hyps = $query->getResultArray();

		$rs = array();
    	$rs['hyps'] = array();
    	array_push($rs['hyps'],$result_hyps);

    	foreach($result as $entry){
    		$questionId = $entry['question_id'];
    		if (!array_key_exists($questionId, $rs)) {
    			$rs[$questionId] = array();
    			$rs[$questionId]['options'] = array();
    		}	    		

    		$rs[$questionId]['question_content'] = $entry['question_content'];
    		$rs[$questionId]['options'][$entry['option_id']] = array('option_content'=>$entry['option_content'], 'option_hyp' => array());

    		$hyp_with_point = $entry['hyp_with_point'];

    		if($hyp_with_point != NULL){
    			$hyps = explode(",", $hyp_with_point);

	    		foreach($hyps as $k => $hyp){
	    			$element = explode(":", $hyp);

	    			$option_hyp_element = array('hyp_id' => $element[0], 'hyp_content' => $element[1], 'option_hyp_point' => $element[2], 'option_hyp_id' => $element[3]);
	    			array_push($rs[$questionId]['options'][$entry['option_id']]['option_hyp'], $option_hyp_element);
	    		}
    		}
    		else{
    			array_push($rs[$questionId]['options'][$entry['option_id']]['option_hyp'], array());
    		}
    		

    	}
		echo json_encode($rs);
		exit;
	}

	public function allhyps(){
		$db = db_connect();
		$builder = $db->table('hyps');
		$builder->select('*');
	
		$builder->join('option_hyp AS oh', 'oh.hyp_id = hyps.hyp_id','left');

		$builder->join('options', 'oh.option_id = options.option_id','left');
		$builder->join('questions AS q', 'q.question_id = options.question_id','left');

		$query = $builder->get();
		$result = $query->getResultArray();

		$rs = array();
    	
    	foreach($result as $entry){
    		$hypId = $entry['hyp_id'];
    		$questionId = $entry['question_id'];
    		if (!array_key_exists($hypId, $rs)) {
    			$rs[$hypId] = array();
    			$rs[$hypId]['questions'] = array();
    		}	    		

    		$rs[$hypId]['hyp_content'] = $entry['hyp_content'];
    		if (!array_key_exists($questionId,$rs[$hypId]['questions'])) {
    			$rs[$hypId]['questions'][$questionId] = array('question_id'=>$questionId,'question_content'=>$entry['question_content'],'options'=>array());
    		}
    		$option = ['option_id'=>$entry['option_id'], 'option_hyp_point'=>$entry['option_hyp_point'], 'option_hyp_id'=>$entry['option_hyp_id'], 'option_content'=>$entry['option_content']];
    		array_push($rs[$hypId]['questions'][$questionId]['options'], $option);
    	}
		echo json_encode($rs);
		exit;
	}

	public function getMaxIds(){
		$db = db_connect();
		$builder = $db->table('questions');

		$builder->selectMax('question_id');
		$query = $builder->get();

		$result = $query->getResultArray();

		$question_last_id = intval($result[0]['question_id']);

  		$query = $db->query("SELECT options.option_id FROM options ORDER BY option_id DESC LIMIT 1");
  		$result = $query->getRow();

  		$option_last_id = ($result !== null)? intval($result->option_id) : 0 ;

  		$query_hyp = $db->query("SELECT option_hyp.option_hyp_id FROM option_hyp ORDER BY option_hyp_id DESC LIMIT 1");
  		$result_hyp = $query_hyp->getRow();

  		$option_hyp_last_id = ($result_hyp !== null) ? intval($result_hyp->option_hyp_id) : 0;

  		$query = $db->query("SELECT * FROM hyps ORDER BY hyp_id DESC LIMIT 1");
  		$result_hyp = $query->getRow();

		$hyp_last_id = ($result_hyp !== null) ? intval($result_hyp->hyp_id) : 0;  

		$query_option_hyp = $db->query("SELECT option_hyp.option_hyp_id FROM option_hyp");
		$result_ids_option_hyp = $query_option_hyp->getResultArray();

		$id_values = array();

		foreach ($result_ids_option_hyp as $key => $value) {
			// code...
			$id_values[$key] = intval($value['option_hyp_id']); 
		}

  		$last_ids = array(
  			'question_last_id' => $question_last_id,
  			'option_last_id'   => $option_last_id,
  			'option_hyp_last_id'      => $option_hyp_last_id,
  			'hyp_last_id'     => $hyp_last_id,
  			'option_hyp_ids'  => $id_values,
  		);

  		echo json_encode($last_ids);
		exit;
	}

	function addquestion(){
		$request = service('request');
		
		$question_id = $request->getPost('question_id');
		$question_data = $request->getPost('question_content');

		$new_question = array(
            'question_id'         => $question_id,
            'question_content' => $question_data,
        );

        $this->model_question = model('Model_question');
        echo $this->model_question->addQuestion($new_question);
        exit;
		
	}

	function deletequestion(){
		$request = service('request');
		
		$question_id = $request->getPost('question_id');
		$this->model_question = model('Model_question');
		
		$this->model_question->deleteQuestion($question_id);

		$db = db_connect();
		$builder = $db->table('questions');

		$builder->selectMax('question_id');
		$query = $builder->get();

		$result = $query->getResultArray();

		$db = db_connect();

		$builder = $db->table('options');
		$builder->where('options.question_id', $question_id);
		$builder->delete();

		$question_last_id = intval($result[0]['question_id']);
		echo $question_last_id;
	}


	function addoption(){
		$request = service('request');
		
		$option_id   = $request->getPost('option_id');
		$question_id = $request->getPost('question_id');
		$option_data = $request->getPost('option_content');

		$new_option = array(
			'option_id'      => $option_id,
            'question_id'    => $question_id,
            'option_content' => $option_data,
        );

        $this->model_option = model('Model_option');
        echo $this->model_option->addOption($new_option);
        exit;
	}

	function deleteoption(){
		$request = service('request');
		$option_id   = $request->getPost('option_id');

		$db = db_connect();

		$builder = $db->table('options');
		$builder->where('options.option_id', $option_id);
		$builder->delete();

		$builder = $db->table('option_hyp');
		$builder->where('option_hyp.option_id', $option_id);
		$builder->delete();		

		$query = $db->query("SELECT * FROM options ORDER BY option_id DESC LIMIT 1");
  		$result = $query->getRowArray();
        
  		echo json_encode($result);
  		exit;
	}

	function add_option_hyp(){
		$request = service('request');
		$post_data = $request->getPost();

		$data   = array(
            'option_hyp_id'       => $post_data['option_hyp_id'],
            'option_hyp_point'    => $post_data['option_hyp_point'],
            'option_id'           => $post_data['option_id'],
            'hyp_id'              => $post_data['hyp_id'],
        );

        $db = db_connect();
        $builder = $db->table('option_hyp');
        $builder->replace($data);

  		$query = $db->query("SELECT * FROM option_hyp ORDER BY option_hyp_id DESC LIMIT 1");
  		$result = $query->getRow();
        
  		echo $result->option_hyp_id;
	}

	function add_hyp(){
		$request = service('request');
		$post_data = $request->getPost();

		$data = array(
            'hyp_id'              => $post_data['hyp_id'],
			'hyp_content'         => $post_data['hyp_content'],              
        );

        $db = db_connect();
        $builder = $db->table('hyps');
        $builder->replace($data);

  		$query = $db->query("SELECT * FROM hyps ORDER BY hyp_id DESC LIMIT 1");
  		$result = $query->getRow();
        
  		echo $result->hyp_id;
	}

	function hyps(){
		$db = db_connect();

        $query = $db->query("SELECT * FROM hyps");
  		$result = $query->getResultArray();

  		echo json_encode($result);
  		exit;
	}

	function delete_hyp(){
		$request = service('request');
		$post_data = $request->getPost();

		$hyp_id = $post_data['hyp_id'];

		$db = db_connect();
		$builder = $db->table('hyps');

		
		$builder->where('hyps.hyp_id', $hyp_id);
		$builder->delete();

		$builder = $db->table('powers');
		$builder->where('powers.hyp_id', $hyp_id);
		$builder->delete();
		
		$builder = $db->table('option_hyp');
		$builder->where('option_hyp.hyp_id', $hyp_id);
		$builder->delete();

		$query = $db->query("SELECT * FROM hyps ORDER BY hyp_id DESC LIMIT 1");
  		$result = $query->getRowArray();
        
  		echo json_encode($result);
  		exit;
	}

	function combo_max_id(){
		$db = db_connect();
		$builder = $db->table('combos');

		$builder->selectMax('combo_id');
		$query = $builder->get();

		$result = $query->getResultArray();

		$combo_max_id = intval($result[0]['combo_id']);

		echo $combo_max_id;
		exit;
	}

	function add_combo(){
		$request = service('request');
		$post_data = $request->getPost();
		
		$data = array(
            'combo_id'           => $post_data['combo_id'],
			'combo_name'         => $post_data['combo_name'],              
        );

        $db = db_connect();
        $builder = $db->table('combos');
        $builder->replace($data);

  		$query = $db->query("SELECT * FROM combos ORDER BY combo_id DESC LIMIT 1");
  		$result = $query->getRow();
        
  		echo $result->combo_id;
	}

	function add_power(){
		$request = service('request');
		$post_data = $request->getPost();

		$data = array(
            'combo_id'       => $post_data['combo_id'],
			'hyp_id'         => $post_data['hyp_id'],
			'power'          => $post_data['power'],

        );

		$db = db_connect();
        $builder = $db->table('powers');

		if($post_data['action'] == 'add'){
			
        	$builder->insert($data);
		}
		else{
			$data = array(
	            'combo_id'       => $post_data['combo_id'],
				'hyp_id'         => $post_data['hyp_id'],
				'power'          => $post_data['power'],
				'power_id'       => $post_data['power_id']
	        );
	        $builder->replace($data);
		}
        

  		$query = $db->query("SELECT * FROM powers ORDER BY power_id DESC LIMIT 1");
  		$result = $query->getRow();
        
  		echo $result->power_id;
	}

	function combos(){
		$db = db_connect();
		$builder = $db->table('combos');
		$builder->select('*');

		$builder->join('powers AS p', 'p.combo_id = combos.combo_id','left');
		$builder->join('hyps AS h', 'h.hyp_id = p.hyp_id','left');

		$query = $builder->get();
		$result = $query->getResultArray();

		$rs = array();

		foreach($result as $entry){
    		
    		$comboId = $entry['combo_id'];

    		if (!array_key_exists($comboId, $rs)) {
    			$rs[$comboId] = array();
    			$rs[$comboId]['hyps'] = array();
    		}	    		

    		$rs[$comboId]['combo_name'] = $entry['combo_name'];

    		$hyp = [
    				'hyp_id'           => $entry['hyp_id'], 
    				'hyp_content'      => $entry['hyp_content'], 
    				'power'            => $entry['power'], 
    				'power_id'         => $entry['power_id']
    			];
    		array_push($rs[$comboId]['hyps'], $hyp);

    	}

		echo json_encode($rs);
		exit;
	}

	function delete_combo(){
		$request = service('request');
		$post_data = $request->getPost();

		$combo_id = $post_data['combo_id'];

		$db = db_connect();
		$builder = $db->table('powers');

		
		$builder->where('powers.combo_id', $combo_id);
		$builder->delete();

		$builder = $db->table('combos');
		$builder->where('combos.combo_id', $combo_id);
		$builder->delete();
		

		$query = $db->query("SELECT * FROM combos ORDER BY combo_id DESC LIMIT 1");
  		$result = $query->getRowArray();
        
  		echo json_encode($result);
	}

	//-------------------

	function questions_frontend(){
		$db = db_connect();
		$builder = $db->table('questions');
		$builder->select('*');

		$builder->join('options', 'options.question_id = questions.question_id','left');
		$builder->join('option_hyp', 'option_hyp.option_id = options.option_id','left');
		$builder->orderBy('questions.question_id');

		$query = $builder->get();
		$result = $query->getResultArray();

		$rs = array();
		foreach($result as $entry){
    		$questionId = $entry['question_id'];
    		if (!array_key_exists($questionId, $rs)) {
    			$rs[$questionId] = array();
    			$rs[$questionId]['options'] = array();
    		}	    		

    		$rs[$questionId]['title'] = $entry['question_content'];
    		$rs[$questionId]['options'][$entry['option_id']] = array('title'=>$entry['option_content'], 'hypothesis' => array());
    		array_push($rs[$questionId]['options'][$entry['option_id']]['hypothesis'], ['id'=>$entry['hyp_id'], 
    			'point'=>intval($entry['option_hyp_point'])]);
    	}

    	$rs = array_values($rs);
    	for($i=0; $i<count($rs); $i++) {
    		$rs[$i]["options"] = array_values($rs[$i]["options"]);
    	}

    	echo json_encode($rs);
    	exit;
	}

	function hyps_frontend(){
		$db = db_connect();

        $query = $db->query("SELECT * FROM hyps");
  		$result = $query->getResultArray();

  		$rs = array_values($result);
  		echo json_encode($rs);
  		exit;
	}

	function combos_frontend(){
		$db = db_connect();
		$builder = $db->table('combos');
		$builder->select('*');

		$builder->join('powers AS p', 'p.combo_id = combos.combo_id','left');
		$builder->join('hyps AS h', 'h.hyp_id = p.hyp_id','left');

		$query = $builder->get();
		$result = $query->getResultArray();

		$rs = array();

		foreach($result as $entry){
    		
    		$comboId = $entry['combo_id'];

    		if (!array_key_exists($comboId, $rs)) {
    			$rs[$comboId] = array();
    			$rs[$comboId]['hyps'] = array();
    		}	    		

    		$rs[$comboId]['combo_name'] = $entry['combo_name'];

    		$hyp = [
    				'hyp_id'           => $entry['hyp_id'], 
    				'hyp_content'      => $entry['hyp_content'], 
    				'power'            => $entry['power'], 
    				'power_id'         => $entry['power_id']
    			];
    		array_push($rs[$comboId]['hyps'], $hyp);

    	}

    	$rs = array_values($rs);
		echo json_encode($rs);
		exit;
	}

}

?>