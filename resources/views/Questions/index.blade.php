@extends('layouts.admin.layout')

@section('content')

<div>
    <div class="pull-left"><h3>Question Management ({{$questionnaire->name}})</h3></div>
    <div class="pull-right" style="padding-top:20px">
        <form id="searchCompanies" name="searchSs" class="pull-right" action="{{url('/Questions/'.$questionnaire->id)}}">
            <input type="text" value="{{isset($keyword) ? $keyword : ''}}" name="keyword" class="form-control input-sm pull-left" style="width:150px; margin-right:5px" />
            <a href="javascript:{}" class="btn btn-primary btn-sm" onclick="$('#searchCompanies').submit();">Search</a>            
        </form>
    </div>
    <div class="clearfix"></div>

    <table style="width:100%" class="table table-bordered table-striped table-hover" cellspacing="0" cellpadding="5">
        <head>
            <tr>        
                <th class="text-center" width="5%">#</th>
                <th class="text-center">Statement</th>
                <th class="text-center">Type</th>
                <th class="text-center" width="20%">Actions</th>
            </tr>
        </head>
        <body>
            <?php 
                $counter = ($questions->currentPage()-1) * $questions->perPage();
            ?>
            @foreach ($questions as $row)
                <?php $counter++; ?>
                <tr>
                    <td class="text-center">{{$counter}}</td>
                    <td>{{$row->statement}}</td>
                    <td>{{$row->type}}</td>
                    <td class="text-center">
                        <a href="{{url('/Questions/'.$questionnaire->id.'/'.$row->id)}}" title="View" class="btn btn-primary btn-sm mt5">
                            <span class="glyphicon glyphicon-eye-open"></span>&nbsp; View</a> &nbsp;


                        <a href="{{url('/Questions/edit/'.$row->id)}}" title="Edit Content" class="btn btn-primary btn-sm mt5">
                            <span class="glyphicon glyphicon-pencil"></span>&nbsp; Edit</a> &nbsp;

                        {!! Form::open(array('url' => '/Questions/' . $row->id ,'id'=>'delete_'.$row->id,'class' => 'pull-right')) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                        {!! Form::close() !!}


                        <a onclick="show_alert('{{$row->id}}')" href="javascript:;" title="Delete" class="btn btn-primary btn-sm mt5">
                            <span class="glyphicon glyphicon-trash mr5"></span>&nbsp;Delete
                        </a>

                        
                        
                    </td>
                </tr>
            @endforeach
        </body>
    </table>
    {!! $questions->links() !!}
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
