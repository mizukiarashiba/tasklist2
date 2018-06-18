@extends('layouts.app')

@section('content')

<h1>タスク新規作成ページ</h1>


<div class="row">
    <div class="col-xs-6">
    
    {!! Form::model($task, ['route' => 'tasks.store']) !!}
        
        <div class="form-group">
        {!! Form::label('status', 'ステータス:') !!}
        {!! Form::text('status') !!}
        </div>
    
        <div class="form-group">
        {!! Form::label('content', 'タスク:') !!}
        {!! Form::text('content') !!}
        </div>
    
        {!! Form::submit('投稿') !!}

    {!! Form::close() !!}
    
    </div>
</div>

@endsection