@extends('layouts.app')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Usuarios</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div align="right">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#modalAgregarUsuario">
                                        <i class=" ri-user-add-fill"></i> <span> Usuario</span>
                                    </button>
                                </div><br>


                                <div class="tab-content">
                                    <div class="tab-pane show active" id="datatable-usuarios-preview">
                                          <table id="basic-datatable" class="table dt-responsive w-100">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Nombre</th>
                                                    <th>Correo Electrónico</th>
                                                    <th>Rol</th>
                                                    <th>Departamento</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($catalogo as $item)
                                                    <tr>
                                                        <td>{{ $item['id'] }}</td>
                                                        <td>{{ $item['name'] }}</td>
                                                        <td>{{ $item['email'] }}</td>
                                                        <td>{{ $item['rol'] }}</td>
                                                        @switch($item['departamento'])
                                                            @case(0)
                                                                <td>Unidad de Informática y Estadistica</td>
                                                            @break

                                                            @case(1)
                                                                <td>Departamento de Capacitación a Municipios</td>
                                                            @break

                                                            @case(2)
                                                                <td>Departamento de Atención Ciudadana</td>
                                                            @break
                                                        @endswitch
                                                        <td>
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalEditarUsuario{{ $item['id'] }}">
                                                                <i class="ri-file-edit-line"></i>
                                                            </button>
                                                            <form
                                                                action="{{ route('catalogo_usuarios.destroy', $item['id']) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="ri-delete-bin-2-fill"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <!--modal editar usuarios-->
                                                    <div id="modalEditarUsuario{{ $item['id'] }}" class="modal fade"
                                                        tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title"> Editar Usuario </h4>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form method="POST"
                                                                    action="{{ route('catalogo_usuarios.update', $item['id']) }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class=" mb-3">
                                                                            <label>Nombre</label>
                                                                            <input type="text"
                                                                                class="form-control form-control-sm"
                                                                                name="txtNombre"
                                                                                placeholder="{{ $item['name'] }}"
                                                                                maxlength="255" />
                                                                        </div>
                                                                        <div class=" mb-3">
                                                                            <label>Correo Electrónico </label>
                                                                            <input type="text"
                                                                                class="form-control form-control-sm"
                                                                                name="txtEmail"
                                                                                placeholder="{{ $item['email'] }}"
                                                                                maxlength="255" />
                                                                        </div>
                                                                        <div class=" mb-3">
                                                                            <label>Contraseña</label>
                                                                            <div class="input-group input-group-merge">
                                                                                <input type="password" name="txtContrasena"
                                                                                    class="form-control">
                                                                                <div class="input-group-text show-password"
                                                                                    data-password="true">
                                                                                    <span class="password-eye"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class=" mb-3">
                                                                            <label>Rol administrativo</label>
                                                                            <select class="form-control form-control-sm"
                                                                                name="txtRol">
                                                                                <option value="{{ $item['rol'] }}">
                                                                                    {{ $item['rol'] }}</option>
                                                                                @if (Auth::user()->super())
                                                                                    <option value="super">Superusuario
                                                                                    </option>
                                                                                    <option value="administrador">
                                                                                        Administrador
                                                                                    </option>
                                                                                @else
                                                                                    <option value="enlace">Enlace</option>
                                                                                @endif
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light"
                                                                            data-bs-dismiss="modal">Cerrar</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Guardar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--modal editar usuarios-->
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- inicioModal de agregar  usuario-->
                                <div id="modalAgregarUsuario" class="modal fade" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"> Agregar Usuario </h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{ route('catalogo_usuarios.store') }}">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class=" mb-3">
                                                        <label>Nombre</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="txtAgregarNombre" />
                                                    </div>
                                                    <div class=" mb-3">
                                                        <label>Correo Electrónico </label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="txtAgregarEmail" />
                                                    </div>
                                                    <div class=" mb-3">
                                                        <label>Contraseña</label>
                                                        <div class="input-group input-group-merge">
                                                            <input type="password" name="txtAgregarContrasena"
                                                                class="form-control">
                                                            <div class="input-group-text show-password"
                                                                data-password="true">
                                                                <span class="password-eye"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" mb-3">
                                                        <label>Rol administrativo</label>
                                                        <select class="form-control form-control-sm" name="txtAgregarRol">
                                                            @if (Auth::user()->super())
                                                                <option value="super">Superusuario</option>
                                                                <option value="administrador">Administrador</option>
                                                            @else
                                                                <option value="enlace">Enlace</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    @if (Auth::user()->super())
                                                        <div class=" mb-3">
                                                            <label>Departamento</label>
                                                            <select class="form-control form-control-sm"
                                                                name="txtAgregarDepartamento">
                                                                <option value="0">Unidad de Informática y Estadística
                                                                </option>
                                                                <option value="1">Departamento de Capacitación a
                                                                    Municipios</option>
                                                                <option value="2">Departamento de Atención Ciudadana
                                                                </option>
                                                            </select>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- fin  Modal de agregar usuario -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
