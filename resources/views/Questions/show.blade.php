@extends('layouts.admin.layout')
<!-- if there are creation errors, they will show here -->
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="pull-left">          
                View Question
            </h4>
            <a class="pull-right btn btn-default btn-sm mt5" href="{{url('/Questions',$questionnaire->id)}}">
                <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back
            </a>        
            <div class="clearfix"></div>
        </div>

        <div class="panel-body">
            <ol class="breadcrumb">         
                <li><a href="{{url('/Questionnaire')}}">Questionnaires</a></li>
                <li><a href="{{url('/Questions',$questionnaire->id)}}">Question</a></li>
                <li class="active">Show</li>
            </ol>
            <table style="width:100%" class="table table-bordered table-striped table-hover" cellspacing="0" cellpadding="5">
                <tr>
                    <td class="text-left"><strong>Q: {{$question->statement}} ({{$question->type}})</strong></td>                        
                </tr>
                <tr>
                    <td class="text-left">
                        <ul>
                            @foreach($question->QuestionAnswer as $answer)
                            <li>{{$answer->value}} {{$answer->correct == 1 ? '(Correct)':''}}</li>
                            @endforeach
                        <ul>
                    </td>
                </tr>            
            </table>

            <div class="clearfix"></div>
            <div class="form-group">                
                <div class="col-lg-offset-1 col-lg-1">
                    <a class="pull-right btn btn-danger" href="{{url('/Questions',$questionnaire->id)}}">
                    <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back</a>
                </div>                
            </div>
            
        </div>
    </div>
@endsection
@section('scripts')
  
@endsection