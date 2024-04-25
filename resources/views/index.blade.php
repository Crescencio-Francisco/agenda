@extends('layouts.app')

@section('content')
<div class="container bg-white rounded my-5 p-md-5 shadow-sm">
    @if (session('success'))
        <div id="alerta" class="alert alert-success mb-4 rounded p-3 text-center alert-dismissible">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning mb-4 rounded p-3 text-center alert-dismissible">
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger mb-4 rounded p-3 text-center alert-dismissible">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <small class="py-3 text-muted">Clique em uma data para selecioná-la ou em várias datas para criar um evento</small>
        <div class="col-md-9">
            <div id="calendar"></div>
        </div>

        <div class="col-md-3 mt-5 mt-md-0 bg-success bg-gradient rounded text-light">
            <div class="p-4">
                <h4 class="pb-3 text-center">Detalhes do Evento</h4>
                <p>
                    <i class="bi bi-pin-fill"></i>
                    <span class="">Nome do Evento</span><br>
                    <span class="text-white-50" id="ver_title">---</span>
                </p>
                <p>
                    <i class="bi bi-calendar2-event-fill"></i>
                    <span class="">Data de Início</span><br>
                    <span class="text-white-50" id="ver_start">---</span>
                </p>
                <p>
                    <i class="bi bi-calendar-event-fill"></i>
                    <span class="">Data de Término</span><br>
                    <span class="text-white-50" id="ver_end">---</span>
                </p>
                <p>
                    <span class="">Descrição do Evento</span><br>
                    <span class="text-white-50" id="ver_description">---</span>
                </p>
                <form action="{{ route('evento.editar') }}" method="GET">
                    <input id="ver_id" name="idEvento" value="" hidden>
                    <button type="submit" class="btn btn-light border-0 text-success me-3 float-end btn-editar"
                        title="Editar"><i class="bi bi-pencil-fill"></i></button>
                </form>
                <form action="{{ route('evento.apagar') }}" method="POST">
                    @csrf
                    <input id="apagar_id" name="idEvento" value="" hidden>
                    <button type="submit" class="btn btn-light border-0 text-danger me-3 float-end btn-apagar"
                        title="Apagar"><i class="bi bi-trash-fill"></i></button>
                </form>
            </div>
        </div>
    </div>

</div>


    {{-- Modal de registo de evento --}}
    <div class="modal fade" id="modalRegistar" tabindex="-1" aria-hidden="true" aria-labelledby="modalRegistoLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 border-0">
                <div class="modal-header border-0 bg-gradient">
                    <h5 class="modal-title text-black display-4 fs-5">Novo Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-4">
                    <form action="{{ route('registar.evento') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Nome do Evento</label>
                            <input type="text" name="inputTitulo" class="form-control form-control-sm" id="titulo" placeholder="Nome do evento" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="dataInicio" class="form-label">Data de Início</label>
                                <input type="datetime-local" name="inputDataInicio" class="form-control form-control-sm" id="dataInicio" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="dataTermino" class="form-label">Data de Término</label>
                                <input type="datetime-local" name="inputDataTermino" class="form-control form-control-sm" id="dataTermino" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea name="inputDescricao" id="descricao" cols="30" rows="5" class="form-control form-control-sm" placeholder="Descrição do evento"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="cor" class="form-label">Cor do Rótulo</label>
                            <input type="color" name="inputColor" class="form-control form-control-sm" id="cor">
                        </div>
                        <button type="submit" class="btn btn-success btn-sm float-end">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
