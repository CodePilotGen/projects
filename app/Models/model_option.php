<?php

/**
 * --------------------------------------------------------------------
 * 
 * --------------------------------------------------------------------
 *
 */

namespace App\Models;

use CodeIgniter\Model;

class Model_option extends Model{
    function getTotalOptions()
    {
        return $this->db->count_all_results('options');
    }
    
    function getOption($option_id)
    {
        $this->db->WHERE('option_id', $option_id);
        $query  = $this->db->get('options');
        return $query->row();
    }

    public function addOption($option_data)
    {
        $db = db_connect();
        $builder = $db->table('options');

        $data   = array(
            'option_id'         => $option_data['option_id'],
            'option_content' => $option_data['option_content'],
            'question_id' => $option_data['question_id'],
        );


        $builder->replace($data);

        $query = $db->query("SELECT * FROM options ORDER BY option_id DESC LIMIT 1");
        $result = $query->getRow();

        return $result->option_id;
    }

    public function updateOption($option_id, $option_data){
        $data   = array(
            'option_content'         => $option_data['option_content'],
        );
        $this->db->where('options.option_id', $option_id);
        return $this->db->update('options', $data);
    }

    public function deleteOption($option_id)
    {
        $db = db_connect();
        $builder = $db->table('options');
        $builder->where('options.option_id', $option_id);
        return $builder->delete();
    }
}

?>