@extends('layouts.app')

@section('content')

<h1>タスク新規作成ページ</h1>


 <div class="container">
      <div class="row">
            <div class="col-xs-12"></div>
            <div class="col-sm-8 col-sm-offset-2"></div>
            <div class="col-md-8 col-md-offset-2"></div>
            <div class="col-lg-6 col-lg-offset-3"></div>
      </div>
    
    {!! Form::model($task, ['route' => 'tasks.store']) !!}
        
        <div class="form-group">
        {!! Form::label('status', 'ステータス:') !!}
        {!! Form::text('status', null, ['class' => 'form-control']) !!}
        </div>
    
        <div class="form-group">
        {!! Form::label('content', 'タスク:') !!}
        {!! Form::text('content', null, ['class' => 'form-control']) !!}
        </div>
    
       {!! Form::submit('POST', ['class' => 'btn btn-primary']) !!}


    {!! Form::close() !!}
</div>

@endsection



