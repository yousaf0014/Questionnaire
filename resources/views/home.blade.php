@extends('layouts.admin.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td width="40%">name:</td>
                                    <td><strong>{{$user->name}}</strong></td>
                                </tr>
                                <tr>
                                    <td width="40%">Email:</td>
                                    <td><strong>{{$user->email}}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
