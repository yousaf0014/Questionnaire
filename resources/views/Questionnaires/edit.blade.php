@extends('layouts.admin.layout')
<!-- if there are creation errors, they will show here -->
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="pull-left">          
                Edit Questionnaire
            </h4>
            <a class="pull-right btn btn-default btn-sm mt5" href="{{url('/Questionnaire')}}">
                <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back
            </a>        
            <a href="javascript:;" onclick="submitMe()"class="btn btn-default pull-right btn-sm mt5 mr10">Save</a>    
            <div class="clearfix"></div>
        </div>

        <div class="panel-body">
            <ol class="breadcrumb">         
                <li><a href="{{url('/Questionnaire')}}">Questionnaire</a></li>
                <li class="active">Add</a>
            </ol>
            {{ Html::ul($errors->all()) }}
            {!! Form::model($questionnaire, array('url' => array('/Questionnaire/update', $questionnaire->id),'id'=>'add_content','name'=>'add_content','class'=>'form-horizontal', 'method' => 'PUT')) !!}
                <div class="form-group">
                    <label class="col-lg-2 control-label">Name</label>
                    <div class="col-lg-10">
                        {!! Form::text('name', Input::old('name'), array('class' => 'form-control input-sm','placeholder'=>'Name')) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-2 control-label">Duration</label>
                    <div class="col-lg-3">
                        {!! Form::text('duration', Input::old('duration'), array('class' => 'form-control input-sm','placeholder'=>'Duration')) !!}
                    </div>
                    <div class="col-lg-7">
                        <?php $typeList = array('Minutes'=>'Minutes','Hours'=>'Hours') ?>
                         {!! Form::select('duration_type', $typeList, Input::old('duration_type') , array('class' => 'form-control input-sm')) !!}
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-lg-2 control-label">Can Resume</label>
                    <div class="col-lg-10">
                        {!! Form::radio('resume', 1) !!} Yes&nbsp;&nbsp;&nbsp;&nbsp;
                        {!! Form::radio('resume', 0) !!} No
                    </div>
                </div>    
                <div class="form-group">                
                    <div class="col-lg-offset-1 col-lg-1">
                        <a class="pull-right btn btn-danger" href="{{url('/Questionnaire')}}">
                        <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back</a>
                    </div>
                    <div class="col-lg-offset-1">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>                                    
                    </div>
                </div>
            {!! Form::close() !!}
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
    $(document).ready(function(){
        options = {
                rules: {
                    "name": {required:true},
                    "duration": {required:true,digits:true},
                    "resume":{required:true}
                },
                messages: {
                    "name": "Please enter Name",
                    "Duration": {required:"Please enter duration",digits:"Please enter an integer"},
                    "resume":"Please select"
                }
            };
            
            $('#add_questionnaire').validate( options );
    });
    </script>
@endsection