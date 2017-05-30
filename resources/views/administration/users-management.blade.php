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
                        <td id="user_name">{{$user->name}}</td>
                        <td id="user_email">{{$user->email}}</td>
                        <input type="hidden" id="user_id" value="{{$user->id}}">
                        @if(sizeof($user->roles)>0)
                            <td id="user_role">{{$user->roles[0]->display_name}}</td>
                            <input type="hidden" id="role_id" value="{{$user->roles[0]->id}}">
                        @else
                            <td>Nessun Ruolo Definito</td>
                        @endif
                        <td>
                            <button class="btn editUserButton"
                                    id="edit_user"
                                    data-toggle="modal"
                                    data-target="#editUserModal">
                                Modifica
                            </button>
                            {!! Form::open(['url' => 'admin/users', 'method' => 'delete']) !!}
                            {{ Form::hidden('user_id', $user->id, array('id' => 'user_id')) }}
                            {{ Form::submit('Cancella Utente', array('class' => 'btn')) }}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /page content -->


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

    <div class="modal fade" id="editUserModal"
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
                    {!! Form::open(['url' => 'admin/users', 'method' => 'put']) !!}
                    <div class="form-group col-md-6">
                        {{ Form::hidden('old_name','', array('id' => 'old_name')) }}
                        {{ Form::hidden('edit_user_id','', array('id' => 'edit_user_id')) }}
                        {{ Form::label('edit_name', 'Nome') }}
                        {{ Form::text('edit_name', '', array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('edit_role', 'Ruolo') }}
                        {{ Form::select('edit_role', $roles, null, array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('edit_email', 'Email') }}
                        {{ Form::text('edit_email', '', array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('edit_password', 'Password') }}
                        {{ Form::text('edit_password', '', array('class' => 'form-control')) }}
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success" id="editUserSubmit">Submit</button>
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

    <script>
        $(function() {
            $('.editUserButton').on("click", function (e) {
                name = $(this).parent().siblings('#user_name').html();
                user_id = $(this).parent().siblings('#user_id').val();
                email = $(this).parent().siblings('#user_email').html();
                role = $(this).parent().siblings('#role_id').val();
                $('#old_name').val(name);
                $("#edit_user_id").val(user_id);
                $("#edit_name").val(name);
                $("#edit_email").val(email);

                if(role === undefined && $("#edit_role > option[value=-1]").length == 0) {
                    $("#edit_role").prepend($('<option>', {
                        value: -1,
                        text: 'Seleziona un ruolo',
                        disabled: true
                    }));
                    $("#edit_role").val(-1);
                }else if(role === undefined){
                    $("#edit_role").val(-1);
                }else
                    $("#edit_role").val(role);
            });

            $('#editUserModal').on('shown.bs.modal', function () {
                roleValue =  $("#edit_role").val();
                if(roleValue == null)
                    $('#editUserSubmit').prop("disabled",true);
                else
                    $('#editUserSubmit').prop("disabled",false);
            });

            $('#edit_role').on('change', function () {
               if($('#edit_role').val()!=-1){
                   $('#editUserSubmit').prop("disabled",false);
               }
            });

        });
    </script>


    <!-- footer content -->
    <footer>
        <div class="pull-right">
            Piattaforma Federlegno by <a href="https://colorlib.com">Cloud</a>
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
@endsection