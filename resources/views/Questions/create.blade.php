@extends('layouts.admin.layout')
<!-- if there are creation errors, they will show here -->
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="pull-left">          
                Add Questions
            </h4>
            <a class="pull-right btn btn-default btn-sm mt5" href="{{url('/Questionnaire')}}">
                <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back
            </a>        
            <a href="javascript:;" onclick="submitForm()" class="btn btn-default pull-right btn-sm mt5 mr10">Save</a>    
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <div class="col-lg-12">
                <ol class="breadcrumb">         
                    <li><a href="{{url('/questionnaires')}}">Questionnaires</a></li>
                    <li class="active">Add Questions ({{$questionnaire->name}})</li>
                </ol>
                {{ Html::ul($errors->all()) }}
                {!! Form::open(array('url' => 'Questions/'.$questionnaire->id,'id'=>'add_question','name'=>'add_question','class'=>'form-horizontal')) !!}
                    <div id="questions_area">
                        
                    </div>

                    <div class="form-group">                    
                        <label class="col-lg-2  control-label">
                            <a href="javascript:;" class="btn btn-primary btn-sm mt5" onclick="addQuestion()">
                                <span class="glyphicon glyphicon-plus"></span>&nbsp;Add Question
                            </a>
                        </label>
                    </div>
                    <div class="form-group">                
                        <div class="col-lg-offset-1 col-lg-1">
                            <a class="pull-right btn btn-danger" href="{{url('/Questionnaire')}}">
                            <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back</a>
                        </div>
                        <div class="col-lg-1">
                            <button type="button" onclick="submitForm()" class="btn btn-primary btn-sm">Save Questions</button>                                    
                        </div>
                        <div class="col-lg-offset-1 col-lg-8">                        
                            <label class="col-lg-4 error" id="error_message" style="display:none"></label>
                        <div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div style="display:none" >
        <div id="hidden_input_question">
            <div class="questionC">
                <div id="id_XXX" class="group-XXX row">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Question Type</label>
                        <div class="col-lg-9">
                            <?php $typeList = array('text'=>'Text','radio'=>'Radio','select'=>'Multiple Choice (Single Option)','checkbox'=>'Multiple Choice (Multiple Option)') ?>
                             {!! Form::select('data[XXX][type]', $typeList, null,array('class' => 'form-control input-sm','onchange'=>"reloadOptions('XXX',this)")) !!}
                        </div>
                        <div class="col-lg-1">
                            <a onclick="$('#id_XXX').remove()" href="javascript:;" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash mr5"></span>&nbsp;Delete</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Question XXX</label>
                        <div class="col-lg-9">
                             <input type="text" name="data[XXX][statement]"  id="XXX" class="form-control input-sm input_t">
                        </div>
                        
                    </div>

                    <div id="options_XXX"> 
                        <div class="option">
                            <div class="form-group" id="option_XXX_1">
                                <label class="col-lg-2 control-label">Answer</label>
                                <div class="col-lg-8" >
                                    <input type="text" name="data[XXX][answer][1][value]" class="form-control input-sm input_XXX_t">
                                </div>

                                <div class="col-lg-1 check_XXX_1" style="display:none">
                                    <input type="checkbox" name="data[XXX][answer][1][correct]" class="check_XXX" disabled="disabled" value="1">
                                    &nbsp;Correct ?
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <label class="col-lg-3  control-label add_more_XXX" style="display:none">
                                <a href="javascript:;" class="btn btn-primary btn-sm mt5" onclick="addOption('XXX')">
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
        </div>
        <div id="options_html">  
            <div class="option option_XXX">
                <div class="form-group" id="option_XXX_YYY">        
                    <label class="col-lg-2 control-label">Answer</label>
                    <div class="col-lg-8">
                        <input type="text" name="data[XXX][answer][YYY][value]" class="input_XXX_t form-control input-sm">
                    </div>

                    <div class="col-lg-1 check_XXX_YYY">
                        <input type="checkbox" name="data[XXX][answer][YYY][correct]" class="check_XXX" value="1"> Correct?
                    </div>

                    <div class="col-lg-1">
                        <a  class="btn btn-danger" onclick="$('#option_XXX_YYY').remove()" href="javascript:;" title="Delete"><span class="glyphicon glyphicon-trash mr5"></span>&nbsp;Delete</a>
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
            $('#add_question').submit();
        }
        $('#error_message').html(messages).show().focus();
    }
    $(document).ready(function(){
        addQuestion();
    });
    function addQuestion(){
        var HTM = $('#hidden_input_question ').html();
        var questionCount = $('#questions_area .questionC').length *1 + 1;
        var replacedHTML = HTM.replace(/XXX/gi,questionCount);
      $('#questions_area').append(replacedHTML);    
    }

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