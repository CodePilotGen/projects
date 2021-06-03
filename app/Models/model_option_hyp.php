<?php

/**
 * --------------------------------------------------------------------
 * 
 * --------------------------------------------------------------------
 *
 */

namespace App\Models;

use CodeIgniter\Model;

class Model_option_hyp extends Model{
    function getTotalOption_Hyps()
    {
        return $this->db->count_all_results('option_hyp');
    }
    
    function getOptionHyp($option_hyp_id)
    {
        $this->db->WHERE('option_hyp_id', $option_hyp_id);
        $query  = $this->db->get('option_hyp');
        return $query->row();
    }

    public function addOptionHyp($option_hyp_data)
    {
        $data   = array(
            'option_hyp_id'         => $option_hyp_data['option_hyp_id'],
            'option_hyp_point'    => $option_hyp_data['option_hyp_point'],
            'option_id'           => $option_hyp_data['option_id'],
            'hyp_id'              => $option_hyp_data['hyp_id'],
        );
        $this->db->insert('option_hyp', $data);
        return $this->db->insert_id();
    }

    public function updateOptionHyp($option_hyp_id, $option_hyp_data){
       $data   = array(
            'option_hyp_id'         => $option_hyp_data['option_hyp_id'],
            'option_hyp_point'    => $option_hyp_data['option_hyp_point'],
            'option_id'           => $option_hyp_data['option_id'],
            'hyp_id'              => $option_hyp_data['hyp_id'],
        );
        $this->db->where('option_hyp.option_hyp_id', $option_hyp_id);
        return $this->db->update('option_hyp', $data);
    }

    public function deleteOptionHyp($option_hyp_id)
    {
        $this->db->where('option_hyp.option_hyp_id', $option_hyp_id);
        return $this->db->delete('option_hyp');
    }
}

?>