 var new_question = '<div class="question-block" id="question_block_{{question_id}}" question_id="{{question_id}}">' +
                            '<div class="question-box">' +
                                '<input type="text" placeholder="Please enter question." value="{{question_content}}" class="form-control form-control-solid question-content" />' +
                                '<button class="btn btn-sm btn-info add-option"><i class="fas fa-check-circle"></i>&nbsp;option +</button>' +
                                '<button class="btn btn-sm btn-warning remove-question">-</button>' +
                            '</div>' +
                        '</div>';

    var question_in_hyp = '<div class="hyp-question-block" id="question_block_{{question_id}}" question_id="{{question_id}}">' +
                            '<div class="question-box">' +
                                '<input type="text" readonly value="{{question_content}}" class="form-control form-control-solid question-content" />' +
                            '</div>' +
                        '</div>';

    var new_option =    '<div class="option-box" id="option_box_{{question_id}}_{{option_id}}" question_id="{{question_id}}" option_id="{{option_id}}">' +
                            '<input type="text" placeholder="Please enter option." value="{{option_content}}" class="form-control form-control-solid option-content" />' +
                            '<button class="btn btn-sm btn-info add-hyp"><i class="fas fa-flask"></i>&nbsp;link +</button>' +
                            '<button class="btn btn-sm btn-warning remove-option">-</button>' +
                        '</div>';

     var option_in_hyp = '<div class="option-box" id="option_box_{{question_id}}_{{option_id}}" option_id="{{option_id}}">' +
                                '<input type="text" value="{{option_hyp_point}}" id="{{option_hyp_id}}" placeholder="point" class="form-control form-control-solid option-point-hyp">' +
                                '<input type="text" value="{{option_content}}" readonly class="form-control form-control-solid option-content" />' +
                            '</div>';

    var new_hyp =  '<div class="hypo-box" id="hypo_box_{{question_id}}_{{option_id}}_{{hyp_id}}" hyp_id="{{hyp_id}}">' +
                        '<select class="form-select form-select-sm hypo-list" aria-label=".form-select-sm example">' +
                          '<option value="0" selected>No hypothesis available yet</option>' +
                        '</select>' +
                        '&nbsp;#<input type="text" option_hyp_id="{{option_hyp_id}}" value="{{point}}" placeholder="point" class="form-control form-control-solid option-point">' +
                    '</div>';

    var new_hyp_block =  '<div class="hyp-block" id="hyp_block_{{hyp_id}}" hyp_id={{hyp_id}}>' +
                            '<div class="hyp-box">' +
                                '<input type="text" value="{{hyp_content}}" placeholder="Please enter the hypothesis." class="form-control form-control-solid hyp-content" />' +
                                '<button class="btn btn-sm btn-warning remove-hyp">-</button>' +
                            '</div>' +
                        '</div>';

    var point_hyp = '<input type="text" placeholder="point" class="form-control form-control-solid option-point-hyp">';

    var combo_block = '<div class="combo-block" id="combo_block_{{combo_id}}" combo_id="{{combo_id}}">' +
                            '<div class="combo-box">' +
                                '<input type="text"  placeholder="Please enter combo name." value="{{combo_name}}" class="form-control form-control-solid combo-name" />' +
                                '<button class="btn btn-sm btn-warning remove-combo">-</button>' +
                            '</div>' +
                        '</div>';

    var hyp_list_item = '<div class="hyp-list-item"  hyp_id="{{hyp_id}}">' +
                            '<input type="text" value="{{power}}" id="{{power_id}}" class="form-control form-control-solid combo-power">'+
                            '<input type="text" value="{{hyp_content}}" readonly class="form-control form-control-solid hyp-content">'+
                        '</div>';