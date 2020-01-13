@extends('layouts.app')
@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel">
        <!-- Display Validation Errors -->
        @include('common.errors')
        
        @if (count($all_events) == 0)
        <div class="card card-default without-events">
            <h3>Você não tem eventos cadastrados</h3>
            <p>Clique em Novo Evento para cadastrar</p>
        </div>
        @endif

        <!-- Today Events -->
        @if (count($today_events) > 0)
            <div class="card card-default">
                <div class="card-heading">
                    <h4 class="card-title text-center" ><strong>Eventos hoje / Em andamento</strong></h4>
                </div>

                <div class="card-body">    
                    <table class="table event-table">
                        <!-- Table Headings -->
                        <thead>
                            <tr class="d-flex">
                                <th class="col-sm-2" >Titulo</th>
                                <th class="col-sm-4">Descrição</th>
                                <th class="col-sm-2">Data Início</th>
                                <th class="col-sm-2">Data Fim</th>
                                <th class="col-sm-2">Ações</th>
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                            @foreach ($today_events as $event)
                                <tr class="d-flex">
                                    <td class="col-sm-2 table-text">
                                        <div>{{ $event->title }}</div>
                                    </td>
                                    <td class="col-sm-4 table-text">
                                        <div>{{ $event->description }}</div>
                                    </td>
                                    <td class="col-sm-2 table-text">
                                        <div>{{ date('d/m/Y \a\s h:i', strtotime($event->start_date)) }}</div>
                                    </td>
                                    <td class="col-sm-2 table-text">
                                        <div>{{ date('d/m/Y \a\s h:i', strtotime($event->end_date)) }}</div>
                                    </td>
                                    <td class="col-sm-2 actions row">
                                        <div>
                                            <a class="btn btn-primary" href="{{route('event.edit', $event->id )}}">Editar</a>
                                        </div>
                                        <form action="{{ route('event.delete', $event->id) }}" method="POST">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button class="btn btn-danger">Deletar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Next 5 Days Events -->
        @if (count($next_five_days_events) > 0)
            <div class="card card-default">
                <div class="card-heading">
                    <h4 class="card-title text-center" ><strong>Eventos nos próximos cinco dias</strong></h4>
                </div>

                <div class="card-body">    
                    <table class="table event-table">
                        <!-- Table Headings -->
                        <thead>
                            <tr class="d-flex">
                                <th class="col-sm-2">Titulo</th>
                                <th class="col-sm-4">Descrição</th>
                                <th class="col-sm-2">Data Início</th>
                                <th class="col-sm-2">Data Fim</th>
                                <th class="col-sm-2">Ações</th>
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                            @foreach ($next_five_days_events as $event)
                                <tr class="d-flex">
                                    <td class="col-sm-2 table-text">
                                        <div>{{ $event->title }}</div>
                                    </td>
                                    <td class="col-sm-4 table-text">
                                        <div>{{ $event->description }}</div>
                                    </td>
                                    <td class="col-sm-2 table-text">
                                        <div>{{ date('d/m/Y \a\s h:i', strtotime($event->start_date)) }}</div>
                                    </td>
                                    <td class="col-sm-2 table-text">
                                        <div>{{ date('d/m/Y \a\s h:i', strtotime($event->end_date)) }}</div>
                                    </td>
                                    <td class="col-sm-2 actions row">
                                        <div>
                                            <a class="btn btn-primary" href="{{route('event.edit', $event->id )}}">Editar</a>
                                        </div>
                                        <form action="{{ route('event.delete', $event->id) }}" method="POST">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button class="btn btn-danger">Deletar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif


        <!-- All Events -->
        @if (count($all_events) > 0)
            <div class="card card-default">
                <div class="card-heading">
                    <h4 class="text-center" ><strong>Todos eventos</strong></h4>
                </div>

                <div class="card-body">  
                    <div class="btn-export">
                        <a class="btn btn-warning" href="{{ route('export') }}">Exportar para CSV</a>
                    </div>
                    
                    <table class="table event-table">
                        <!-- Table Headings -->
                        <thead>
                            <tr class="d-flex">
                                <th class="col-sm-2">Titulo</th>
                                <th class="col-sm-4">Descrição</th>
                                <th class="col-sm-2">Data Início</th>
                                <th class="col-sm-2">Data Fim</th>
                                <th class="col-sm-2">Ações</th>
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                            @foreach ($all_events as $event)
                                <tr class="d-flex"">
                                    <td class="col-sm-2 table-text">
                                        <div>{{ $event->title }}</div>
                                    </td>
                                    <td class="col-sm-4 table-text">
                                        <div>{{ $event->description }}</div>
                                    </td>
                                    <td class="col-sm-2 table-text">
                                        <div>{{ date('d/m/Y \a\s H:i', strtotime($event->start_date)) }}</div>
                                    </td>
                                    <td class="col-sm-2 table-text">
                                        <div>{{ date('d/m/Y \a\s H:i', strtotime($event->end_date)) }}</div>
                                    </td>
                                    <td class="col-sm-2 actions">
                                        <div>
                                            <a class="btn btn-primary" href="{{ route('event.edit', $event->id )}}">Editar</a>
                                        </div>
                                        <form action="{{ route('event.delete', $event->id) }}" method="POST">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button class="btn btn-danger">Deletar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="all_events_link">
                        {{ $all_events->links() }}
                    </div>
                </div>
            </div>
        @endif
            <div class="border card-body new-event">
                <h4 class="text-center" ><strong>Novo evento</strong></h4>
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="input-import ">
                    <button class="btn btn-primary">Importar via CSV</button>
                    <a class="btn btn-success" href="{{ url('/event/create') }}">Novo evento</a>
                </form>
            </div>
        </div>
        
    </div>
@endsection

<style>
.card  {
    margin: 35px auto;
    box-shadow: 0 0 2px;
}

.card-heading {
    margin: 10px auto;
}

.without-events {
    display: flex;
    flex-direction: column;
    padding: 20 0px;
    align-items: center;
}

.actions {
    display: flex;
}

.actions div {
    margin-right: 5px;
}

.input-import {
    width: 70%;
    padding: 5px;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.new-event {
    display: flex;
    flex-direction: column;
}

.new-event form {
    display: flex;
}

.new-event form input {
    margin-right: 10px;
}

.new-event form button {
    margin-right: 10px;
}

.btn-export {
    display: flex;
    justify-content: flex-end;
}

.btn-export a {
    margin: 10px;
}

.all_events_link {
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>