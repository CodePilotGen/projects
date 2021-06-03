<?php

/**
 * --------------------------------------------------------------------
 * 
 * --------------------------------------------------------------------
 *
 */

namespace App\Models;

use CodeIgniter\Model;

class Model_question extends Model{
    function getTotalQuestions()
    {
        return $this->db->count_all_results('questions');
    }
    
    function getQuestion($question_id)
    {
        $this->db->WHERE('question_id', $question_id);
        $query  = $this->db->get('questions');
        return $query->row();
    }

    public function addQuestion($question_data)
    {
        $db = db_connect();
        $builder = $db->table('questions');

        $data   = array(
            'question_id'         => $question_data['question_id'],
            'question_content' => $question_data['question_content'],
        );

        $builder->replace($data);

        $query = $db->query("SELECT * FROM questions ORDER BY question_id DESC LIMIT 1");
        $result = $query->getRow();

        return $result->question_id;

    }

    public function updateQuestion($question_id, $question_data){
        $data   = array(
            'question_content' => $question_data['question_content'],
        );
        $this->db->where('questions.question_id', $question_id);
        return $this->db->update('questions', $data);
    }

    public function deleteQuestion($question_id)
    {
        $db = db_connect();
        $builder = $db->table('questions');

        $builder->where('questions.question_id', $question_id);
        return $builder->delete();
    }
}

?>