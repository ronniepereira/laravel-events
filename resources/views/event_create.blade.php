@extends('layouts.app')
@section('content')
    <!-- New Event Form -->
    <div class="row w-100 justify-content-center align-items-center">
        <form action="{{ url('event') }}" method="POST" class="new-event-form">
            {!! csrf_field() !!}
            <!-- Event Name -->
            <label for="title" class="control-label">Título</label>
            <input type="text" name="title" id="title" class="form-control">
            
            <label for="description" class="control-label">Descrição</label>
            <textarea rows="3" name="description" id="description" class="form-control"></textarea>
            <div class="dates">
                <div>
                    <label class="" for="start_date">Data Ínicio:</label>
                    <input type="datetime-local" id="start_date" name="start_date">
                </div>
                <div>
                    <label class="" for="end_date">Data Fim:</label>
                    <input type="datetime-local" id="end_date" name="end_date">
                </div>
            </div>
            
            <!-- Add Event Button -->
            <button type="submit" class="btn btn-success">
                <i class="fa fa-plus"></i> Criar
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

.dates {
    margin: 20px auto;
    display: flex;
    justify-content: space-between;
}

.dates div input {
    padding: 0 4px;
    border-radius: 4px;
}

.btn {
    margin-top: 20px;
    right: 0;
}
</style>