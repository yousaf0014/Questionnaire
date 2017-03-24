<div class="form-group">
    <label class="col-lg-2 control-label">Name</label>
    <div class="col-lg-10">
        {!! Form::text('name', Input::old('link_title'), array('class' => 'form-control input-sm','placeholder'=>'Name')) !!}
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
