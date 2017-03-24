@extends('layouts.admin.layout')
<!-- if there are creation errors, they will show here -->
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="pull-left">          
                Edit Questionnaire
            </h4>
            <a class="pull-right btn btn-default btn-sm mt5" href="{{url('/Questions',$question->questionnaire->id)}}">
                <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back
            </a>        
            <a href="javascript:;" onclick="submitMe()"class="btn btn-default pull-right btn-sm mt5 mr10">Save</a>    
            <div class="clearfix"></div>
        </div>

        <div class="panel-body">
            <ol class="breadcrumb">         
                <li><a href="{{url('/Questionnaire')}}">Questionnaire</a></li>
                <li><a href="{{url('/Questions',$question->questionnaire->id)}}">Questionnaire</a></li>
                <li class="active">Add</a>
            </ol>
            {{ Html::ul($errors->all()) }}
            {!! Form::model($question, array('url' => array('/Questions/update', $question->id),'id'=>'edit_question','name'=>'edit_question','class'=>'form-horizontal', 'method' => 'PUT')) !!}
                <div id="questions_area">
                    <div id="id_1" class="group-1 row">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Question Type</label>
                            <div class="col-lg-9">
                                <?php $typeList = array('text'=>'Text','radio'=>'Radio','select'=>'Multiple Choice (Single Option)','checkbox'=>'Multiple Choice (Multiple Option)') ?>
                                 {!! Form::select('data[1][type]', $typeList, $question->type,array('class' => 'form-control input-sm','onchange'=>"reloadOptions('XXX',this)")) !!}
                            </div>                            
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Question</label>
                            <div class="col-lg-9">
                                 <input type="text" name="data[1][statement]" value="{{$question->statement}}" id="1" class="form-control input-sm input_t">
                            </div>
                        </div>
                        <div id="options_1"> 
                            @foreach($question->QuestionAnswer as $index=>$answer)                            
                                <div class="option">
                                    <div class="form-group" id="option_1_{{$index}}">
                                        <label class="col-lg-2 control-label">Answer</label>
                                        <div class="col-lg-8" >
                                            <input type="text" name="data[1][answer][{{$index}}][value]" value="{{$answer->value}}" class="form-control input-sm input_1_t">
                                        </div>
                                        @if($answer->statemen != 'text')
                                            <div class="col-lg-1 check_1_{{$index}}" style="display:{{$answer->statemen == 'text' ? 'none':''}}">
                                                <input type="checkbox" name="data[1][answer][{{$index}}][correct]" {{$answer->correct == 1 ?'checked="checked"':''}} class="check_{{$index}}" {{$answer->statemen == 'text' ? 'disabled="disabled"':''}} value="1">
                                                &nbsp;Correct ?
                                            </div>
                                            @if($index != 0)
                                                <div class="col-lg-1">
                                                    <a  class="btn btn-danger" onclick="$('#option_1_{{$index}}').remove()" href="javascript:;" title="Delete"><span class="glyphicon glyphicon-trash mr5"></span>&nbsp;Delete</a>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>                            
                            @endforeach
                        </div>
                        <div>
                            <div class="form-group">
                                <label class="col-lg-3  control-label add_more_1" style="display:{{$answer->statemen == 'text' ? 'none':''}}">
                                    <a href="javascript:;" class="btn btn-primary btn-sm mt5" onclick="addOption('1')">
                                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Add Option
                                    </a>
                                </label>                    
                            </div>
                        </div>
                        <div>
                            <div class="form-group">
                                <hr />
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">                
                    <div class="col-lg-offset-1 col-lg-1">
                        <a class="pull-right btn btn-danger" href="{{url('/Questions',$question->questionnaire->id)}}">
                        <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back</a>
                    </div>
                    <div class="col-lg-1">
                        <button type="button" onclick="submitForm()" class="btn btn-primary btn-sm">Save Question</button>                                    
                    </div>
                    <div class="col-lg-offset-1 col-lg-8">                        
                        <label class="col-lg-4 error" id="error_message" style="display:none"></label>
                    <div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
 <div style="display:none" >
        <div id="options_html">  
            <div class="option option_1">
                <div class="form-group" id="option_1_YYY">        
                    <label class="col-lg-2 control-label">Answer</label>
                    <div class="col-lg-8">
                        <input type="text" name="data[1][answer][YYY][value]" class="input_1_t form-control input-sm">
                    </div>

                    <div class="col-lg-1 check_1_YYY">
                        <input type="checkbox" name="data[1][answer][YYY][correct]" class="check_1" value="1"> Correct?
                    </div>

                    <div class="col-lg-1">
                        <a  class="btn btn-danger" onclick="$('#option_1_YYY').remove()" href="javascript:;" title="Delete"><span class="glyphicon glyphicon-trash mr5"></span>&nbsp;Delete</a>
                    </div>
                
                </div>   
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/jquery.form.js?v=1')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.validate.min.js?v=1')}}"></script>
    <script type="text/javascript">
    function submitForm(){
        var messages = '';
        var flag = true;
        if($('#questions_area .input_t').length <1 ){
            messages = "No question to save. Please add question <br/>";
            flag = false;
        }else{
            $('#questions_area .input_t').each(function(){
                var qid = $(this).attr('id');
                var qtext = $(this).val();
                if(qtext == ''){
                    flag = false;
                    messages += 'Question'+qid+" statement missing <br/>";
                    $(this).addClass('error');
                }
                
                var i = 1;
                $('#questions_area .input_'+ qid +'_t').each(function(){
                    if($(this).val() == ''){
                        flag = false;
                        messages += 'Question'+qid+' Answer'+ i + " statement missing <br/>";
                        $(this).addClass('error');
                    }
                });

                if(!$('.check_'+qid).prop('disabled')){
                    if($('.check_'+qid+':checked').length < 1){
                        flag = false;
                        messages += 'Question'+qid+" No correct answer selected <br/>";
                    }
                }
            });
            }
        if(flag ==  true){
            $('#edit_question').submit();
        }
        $('#error_message').html(messages).show().focus();
    }
    $(document).ready(function(){});
    
    function addOption(count){
        var optioncount = $('#questions_area #options_'+count+' .option').length *1 + 1;
        var HTM  = $('#options_html ').html();   
        var replacedHTML = HTM.replace(/XXX/gi,count);
        replacedHTML = replacedHTML.replace(/YYY/gi,optioncount);
        $('#questions_area #options_'+count).append(replacedHTML);
        return false;
    }

    function reloadOptions(fieldId,elem){
        var fieldVal = $(elem).val();
        if(fieldVal == 'text'){
            $('.option_'+fieldId).remove();
            $('.check_'+fieldId+'_1').hide();
            $('.check_'+fieldId+'_1 input').attr('disabled','disabled');
            $('.add_more_'+fieldId).hide();
        }else{
            $('.check_'+fieldId+'_1 input').removeAttr('disabled');
            $('.check_'+fieldId+'_1').show();
            $('.add_more_'+fieldId).show();
        }
    }
    </script>
@endsection