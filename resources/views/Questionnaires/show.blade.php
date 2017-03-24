@extends('layouts.admin.layout')
<!-- if there are creation errors, they will show here -->
@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="pull-left">          
                View Questionnire
            </h4>
            <a class="pull-right btn btn-default btn-sm mt5" href="{{url('/Questionnaire')}}">
                <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back
            </a>        
            <div class="clearfix"></div>
        </div>

        <div class="panel-body">
            <ol class="breadcrumb">         
                <li><a href="{{url('/Questionnaire')}}">Questionnaires</a></li>
                <li class="active">Show</li>
            </ol>
            <table style="width:100%" class="table table-bordered table-striped table-hover" cellspacing="0" cellpadding="5">
                <tr>        
                    <th class="text-center col-lg-2">Field Name</th>
                    <th class="text-center col-lg-10">Field Value</th>
                </tr>
                <tr>
                    <td class="text-center"><strong>Questionnaire Name</strong></td>
                    <td class="text-left">{{$questionnaire->name}}</td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Duration</strong></td>
                    <td class="text-left">{{$questionnaire->duration}} {{$questionnaire->type}}</td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Can resume?</strong></td>
                    <td class="text-left">{{$questionnaire->resume == 1 ? 'Yes':'No'}}</td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Published</strong></td>
                    <td class="text-left">{{$questionnaire->published == 1 ? 'Yes':'No'}}</td>
                </tr>
            </table>

            <h2>List of question</h2>

            <table style="width:100%" class="table table-bordered table-striped table-hover" cellspacing="0" cellpadding="5">
                @if(!empty($questions))
                    @foreach($questions as $question)
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
                    @endforeach
                @endif
            </table>

            <div class="clearfix"></div>
            <div class="form-group">                
                <div class="col-lg-offset-1 col-lg-1">
                    <a class="pull-right btn btn-danger" href="{{url('/Questionnaire')}}">
                    <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Go Back</a>
                </div>                
            </div>
            
        </div>
    </div>
@endsection
@section('scripts')
  
@endsection