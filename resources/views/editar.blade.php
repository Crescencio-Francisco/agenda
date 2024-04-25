@extends('layouts.app')

@section('content')
<div class="container-fluid py-5 bg-light justify-content-center align-items-center" style="min-height: 90vh;">
    @if (session('error'))
        <div class="alert alert-danger mx-auto p-3 text-center alert-dismissible" style="max-width: 500px;">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6 m-auto p-4 bg-white shadow-sm rounded">
            <div class="row align-items-center mb-4">
                <h5 class="col-9">Editar Evento</h5>
                <i class="fa fa-edit col-3 text-end" aria-hidden="true"></i>
            </div>
            <form action="{{ route('evento.submeter.formulario.editar', ['id' => $eventos['id']]) }}" method="POST">

                @csrf
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" name="inputTitulo" class="form-control form-control-sm" id="titulo"
                        placeholder="Título do evento" value="{{ $eventos['title'] }}" required>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label for="dataInicio" class="form-label">Início</label>
                        <input type="datetime-local" name="inputDataInicio" class="form-control form-control-sm"
                            id="dataInicio" value="{{ $eventos['start'] }}" required>
                    </div>
                    <div class="col-sm-6">
                        <label for="dataTermino" class="form-label">Término</label>
                        <input type="datetime-local" name="inputDataTermino" class="form-control form-control-sm"
                            id="dataTermino" value="{{ $eventos['end'] }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea name="inputDescricao" id="descricao" cols="30" rows="5"
                        class="form-control form-control-sm"
                        placeholder="Descrição do evento">{{ $eventos['description'] }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="cor" class="form-label">Cor do rótulo</label>
                    <input type="color" name="inputColor" value="{{ $eventos['color'] }}"
                        class="form-control form-control-sm" id="cor">
                </div>
                <button type="submit" class="btn btn-sm btn-success me-2" style="border-radius: 10%;">Salvar</button>
                <a href="{{ route('eventos') }}" class="btn btn-sm btn-secondary">Voltar</a>
            </form>
        </div>
    </div>
</div>

@endsection
