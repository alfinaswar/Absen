@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-6">
                <h2>Edit Role</h2>
            </div>
            <div class="col-md-6 text-end">
                <a class="btn btn-secondary" href="{{ route('roles.index') }}">Kembali</a>
            </div>
        </div>

        {{-- Menampilkan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Terdapat beberapa masalah pada input Anda.
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form edit role --}}
        {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label"><strong>Nama Role:</strong></label>
                    {!! Form::text('name', null, ['placeholder' => 'Nama Role', 'class' => 'form-control']) !!}
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Permissions:</strong></label>
                    <div class="row">
                        @foreach($permission as $value)
                            <div class="col-md-4">
                                <div class="form-check">
                                    {!! Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions), ['class' => 'form-check-input', 'id' => 'perm_' . $value->id]) !!}
                                    <label class="form-check-label" for="perm_{{ $value->id }}">{{ $value->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection