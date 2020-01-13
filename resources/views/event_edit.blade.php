@extends('layouts.app')
@section('content')
<div class="row w-100 justify-content-center align-items-center">
<form action="{{ route('event.update', $event->id) }}" method="POST" class="form-horizontal">
    <input type="hidden" name="_method" value="put" />
    {!! csrf_field() !!}
    <!-- Event Name -->
    
    <label for="title" class="control-label">Título</label>
    <input type="text" name="title" id="title" class="form-control" value="{{$event->title}}">
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="description" class="control-label">Descrição</label>
    <textarea rows="10" name="description" id="description" class="form-control description">{{ $event->description }}</textarea>
    @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="dates">
        <div>
            <label for="start_date">Data Ínicio:</label>
            <input type="datetime-local" id="start_date" name="start_date" class="form-control" value="{{ date('Y-m-d\TH:i:s', strtotime($event->start_date)) }}" min="2010-01-01T00:00" max="2050-12-31T23:59">
            @error('start_date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="end_date">Data Fim:</label>
            <input type="datetime-local" id="end_date" name="end_date" class="form-control" value="{{ date('Y-m-d\TH:i:s', strtotime($event->end_date)) }}" min="2010-01-01T00:00" max="2050-12-31T23:59" >
            @error('end_date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <!-- Add Event Button -->
    <button type="submit" class="btn btn-success">
        <i class="fa fa-plus"></i> Salvar
    </button>
    
</form>
</div>
@endsection

<style>
textarea {
   resize: none;
}

form {
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 2px;
    width: 75%;
}

form label {
    margin-top: 20px;
}

form label:first-child {
    margin-top: 0px;
}

.description {
    resize: none;
}

.dates {
    margin: 20px auto;
    display: flex;
    justify-content: space-between;
}

.btn {
    margin-top: 20px;
    right: 0;
}

.alert-danger {
    margin-top: 10px;
}
</style>