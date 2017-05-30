@extends('layouts.blank')

@push('stylesheets')
<!-- Example -->
<!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="col-md-12">
            <h1>Gestione Ruoli</h1>
        </div>
        <div class="col-md-6">
            <button class="btn"
                    id="new_role"
                    data-toggle="modal"
                    data-target="#newRoleModal">
                Nuovo Ruolo
            </button>
            <table class="table">
                <thead>
                <tr>
                    <td>Nome</td>
                    <td>DisplayName</td>
                    <td>Descrizione</td>
                    <td>Azioni</td>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td id="role_name">{{$role->name}}</td>
                        <td id="role_display_name">{{$role->display_name}}</td>
                        <td id="role_description">{{$role->description}}</td>
                        <td>
                            <button class="btn editRoleButton"
                                    id="edit_role"
                                    data-toggle="modal"
                                    data-target="#editRoleModal">
                                Modifica
                            </button>
                            {!! Form::open(['url' => 'admin/roles', 'method' => 'delete']) !!}
                            {{ Form::hidden('name', $role->name, array('id' => 'name')) }}
                            {{ Form::submit('Cancella Ruolo', array('class' => 'btn')) }}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /page content -->

    <div class="modal fade" id="newRoleModal"
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
                    {!! Form::open(['url' => 'admin/roles', 'method' => 'post']) !!}
                    <div class="form-group col-md-6">
                        <label for="name">Nome</label>
                        {{ Form::text('name', '', array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-md-6">
                        <label for="display_name">DisplayName</label>
                        {{ Form::text('display_name', '', array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Descrizione: </label>
                        {{ Form::text('description', '', array('class' => 'form-control')) }}
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

    <div class="modal fade" id="editRoleModal"
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
                        id="newUserModalLabel">Modifica Utente</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => 'admin/roles', 'method' => 'put']) !!}
                    <div class="form-group col-md-6">
                        {{ Form::hidden('old_name','', array('id' => 'old_name')) }}
                        {{ Form::label('edit_name', 'Nome') }}
                        {{ Form::text('edit_name', '', array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('edit_display_name', 'Display Name') }}
                        {{ Form::text('edit_display_name', '', array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('edit_description', 'Descrizione') }}
                        {{ Form::text('edit_description', '', array('class' => 'form-control')) }}
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

    <!-- footer content -->
    <footer>
        <div class="pull-right">
            Piattaforma Federlegno by <a href="https://colorlib.com">Cloud</a>
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->

    <script>
        $(function() {
            $('.editRoleButton').on("click", function (e) {
                name = $(this).parent().siblings('#role_name').html();
                displayName = $(this).parent().siblings('#role_display_name').html();
                description = $(this).parent().siblings('#role_description').html();
                $("#old_name").val(name);
                $("#edit_name").val(name);
                $("#edit_display_name").val(displayName);
                $("#edit_description").val(description);
            });
        });
    </script>

@endsection