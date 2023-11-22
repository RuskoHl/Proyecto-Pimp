@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Notificar al Admin</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ route('mails.send-mail') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="title">Titulo:</label>
                    <input type="text" class="form-control" id="title" name="title"> 
                </div>

                <div class="form-group">
                    <label for="body">Mensaje:</label>
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Notificar</button>
            </form>
        </div>
    </div>
    @if (session('alert'))
        <div class="col-12">
            <div class="alert alert-success alert-dimissible fade show" role="alert">
                {{ session('alert') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
@endsection