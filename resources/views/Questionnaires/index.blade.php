@extends('layouts.admin.layout')

@section('content')

<div>
    <div class="pull-left"><h3>Content Management</h3></div>
    <div class="pull-right" style="padding-top:20px">
        <form id="searchCompanies" name="searchSs" class="pull-right" action="{{url('/Questionnaire')}}">
            <input type="text" value="{{isset($keyword) ? $keyword : ''}}" name="keyword" class="form-control input-sm pull-left" style="width:150px; margin-right:5px" />
            <a href="javascript:{}" class="btn btn-primary btn-sm" onclick="$('#searchCompanies').submit();">Search</a>
            <a href="{{url('/Questionnaire/create/')}}" class="btn btn-success btn-sm">Add Questionnire</a>
        </form>
    </div>
    <div class="clearfix"></div>

    <table style="width:100%" class="table table-bordered table-striped table-hover" cellspacing="0" cellpadding="5">
        <tr>        
            <th class="text-center" width="5%">#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Number of Questions</th>
            <th class="text-center">Duration</th>
            <th class="text-center">Resumeable</th>
            <th class="text-center">Published</th>
            <th class="text-center" width="20%">Actions</th>
        </tr>
        
        <?php
        $counter = ($questionnaires->currentPage()-1) * $questionnaires->perPage();
        ?>
        @foreach ($questionnaires as $row)
            <?php $counter++; ?>
            <tr>
                <td class="text-center">{{$counter}}</td>
                <td><a href="{{url('/Questions/'.$row->id.'/')}}" title="View questions">{{$row->name}}<a/></td>
                
                <td class="text-center">
                    @foreach($row->questionsCount as $countrow)
                        Count:{{$countrow->questions}}
                    @endforeach
                     | 
                    <a title="Add questions" class="btn btn-primary btn-sm mt5" href="{{url('/Questions/create',$row->id)}}">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Question</a>

                </td>
                <td>{{$row->duration}} {{$row->duration_type}}</td>
                <td>{{ $row->resume == 0 ? 'No':'Yes'}}</td>
                <td><a href="{{url('/Questionnaire/active/'.$row->id)}}/{{ $row->published == 0 ? 1:0}}" title="Edit Content" class="edit_info">{{ $row->published == 0 ? 'No':'Yes'}}</a></td>
                <td class="text-center">
                    <a href="{{url('/Questionnaire/'.$row->id.'/')}}" title="View" class="btn btn-primary btn-sm mt5">
                        <span class="glyphicon glyphicon-eye-open"></span>&nbsp; View</a> &nbsp;


                    <a href="{{url('/Questionnaire/'.$row->id.'/edit')}}" title="Edit Content" class="btn btn-primary btn-sm mt5">
                        <span class="glyphicon glyphicon-pencil"></span>&nbsp; Edit</a> &nbsp;

                    {!! Form::open(array('url' => '/Questionnaire/' . $row->id ,'id'=>'delete_'.$row->id,'class' => 'pull-right')) !!}
                        {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::close() !!}


                    <a onclick="show_alert('{{$row->id}}')" href="javascript:;" title="Delete" class="btn btn-primary btn-sm mt5">
                        <span class="glyphicon glyphicon-trash mr5"></span>&nbsp;Delete
                    </a> 

                    
                    
                </td>
            </tr>
        @endforeach
    </table>
    {!! $questionnaires->links() !!}
</div>

@endsection
@section('scripts')

<script>

    $(document).ready(function(){
        $.ajaxSetup({
           headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

        $("#myModal").on("show.bs.modal", function(e) {
            url =  $(e.relatedTarget).data('target-url');
            $.get( url , function( data ) {
                $(".modal-body").html(data);
            });

        });
    });


    function show_alert(id) {
        if(confirm('Are you sure? you want to delete.')){
            $('#delete_'+id).submit();
        }else{
            return false;
        }
    }
</script>

@endsection
