@extends('layouts/default')

@section('title')
    @parent
@stop

@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/iCheck/css/all.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/formelements.css')}}">
@stop

@section('content')
    <section class="content-header">
        <h1>Role</h1>
        <ol class="breadcrumb">
            <li>
                <a href="">
                    <i class="fa fa-fw fa-key"></i> Role Management
                </a>
            </li>
            <li><a href="{{ route('roles.index') }}">Role</a></li>
            <li class="active">Add Role</li>
        </ol>
    </section>

    <section class="content">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fa fa-fw fa-plus"></i> New Role
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="{{ route('roles.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>System Name<font color="red">*</font>:</strong>
                                        <input type="text" class="form-control" name="name" placeholder="e.g. branch-manager" value="{{ old('name') }}">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Display Name<font color="red">*</font>:</strong>
                                        <input type="text" class="form-control" name="display_name" placeholder="e.g. Branch Manager" value="{{ old('display_name') }}">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Description:</strong>
                                        <input type="text" class="form-control" name="description" placeholder="Role description" value="{{ old('description') }}">
                                    </div>
                                </div>

                                <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Permissions (optional):</strong>
                                        <select class="form-control select2" style="width:100%" name="permission[]" multiple>
                                            @foreach($permission as $perm)
                                                <option value="{{ $perm->id }}" {{ in_array($perm->id, old('permission', [])) ? 'selected' : '' }}>
                                                    {{ $perm->display_name ?: $perm->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> -->

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.right_sidebar')
    </section>
@stop

@section('footer_scripts')
    <script type="text/javascript" src="{{asset('assets/vendors/custom_js/form_elements.js')}}"></script>
@stop

