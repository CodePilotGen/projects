<?php

/**
 * --------------------------------------------------------------------
 * CODEIGNITER 4 - SimpleAuth
 * --------------------------------------------------------------------
 *
 * This content is released under the MIT License (MIT)
 *
 * @package    SimpleAuth
 * @author     GeekLabs - Lee Skelding 
 * @license    https://opensource.org/licenses/MIT	MIT License
 * @link       https://github.com/GeekLabsUK/SimpleAuth
 * @since      Version 1.0
 * 
 */

namespace App\Controllers;

class ThinkFrame extends BaseController
{
	
    public function questions(){
        return view('thinkframe/questions');
    }

    public function options(){
        return view('thinkframe/options');
    }

    public function hyps(){
        return view('thinkframe/hyps');
    }

    public function combos(){
        return view('thinkframe/combos');
    }

	//--------------------------------------------------------------------

}
