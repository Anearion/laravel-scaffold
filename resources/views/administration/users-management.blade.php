@extends('layouts.blank')

@push('stylesheets')
<!-- Example -->
<!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="col-md-12">
            <h1>Gestione Utenti</h1>
        </div>
        <div class="col-md-6">
            <button class="btn"
                    id="new_user"
                    data-toggle="modal"
                    data-target="#newUserModal">
                Nuovo Utente
            </button>
            <table class="table">
                <thead>
                <tr>
                    <td>Nome</td>
                    <td>Email</td>
                    <td>Ruolo</td>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->roles[0]->name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /page content -->

    <!-- footer content -->
    <footer>
        <div class="pull-right">
            Piattaforma Federlegno by <a href="https://colorlib.com">Cloud</a>
        </div>
        <div class="clearfix"></div>
    </footer>

    <div class="modal fade" id="newUserModal"
         tabindex="-1" role="dialog"
         aria-labelledby="favoritesModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"
                        id="newUserModalLabel">Aggiungi Utente</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => 'admin/users', 'method' => 'post']) !!}
                    <div class="form-group col-md-6">
                        <label for="name">Nome</label>
                        {{ Form::text('name', '', array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ruolo">Ruolo</label>
                        {{ Form::select('role', $roles, null, array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email: </label>
                        {{ Form::email('email', '', array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password">Password: </label>
                        {{ Form::text('password', '', array('class' => 'form-control')) }}
                    </div>
                    <div class="col-md-12">
                    <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-default"
                            data-dismiss="modal">Annulla</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /footer content -->
@endsection