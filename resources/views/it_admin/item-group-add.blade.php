@extends('it_admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Add Item Group') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form action="{{ route('itemgroups.store') }}" method="POST">
                            @csrf

                            <div class="card-body">
                                <label for="">Group Code</label>
                                <div class="input-group mb-4">
                                    <input type="text" name="code"
                                        class="form-control @error('code') is-invalid @enderror"
                                        placeholder="{{ __('Code') }}" value="{{ old('code') }}" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    @error('code')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <label for="">Group Name</label>
                                <div class="input-group mb-4">
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="{{ __('Name') }}" value="{{ old('name') }}" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    @error('name')
                                        <span class="error invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Field</th>
                                            <th>Value</th>
                                            <th></th>
                                            <th>Field</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Engineer</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isENG"
                                                        id="isENGTrue" value="1">
                                                    <label class="form-check-label" for="isENGTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isENG"
                                                        id="isENGFalse" value="0">
                                                    <label class="form-check-label" for="isENGFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td>Finance Accounting Tax</td>
                                            <td >
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isFAT"
                                                        id="isFATTrue" value="1">
                                                    <label class="form-check-label" for="isFATTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isFAT"
                                                        id="isFATFalse" value="0">
                                                    <label class="form-check-label" for="isFATFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Repeat the above block for each of your new boolean fields -->
                                        <tr>
                                            <td>Gudang FG</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isGFG"
                                                        id="isGFGTrue" value="1">
                                                    <label class="form-check-label" for="isGFGTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isGFG"
                                                        id="isGFGFalse" value="0">
                                                    <label class="form-check-label" for="isGFGFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td>Gudang Retail</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isGRT"
                                                        id="isGRTTrue" value="1">
                                                    <label class="form-check-label" for="isGRTTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isGRT"
                                                        id="isGRTFalse" value="0">
                                                    <label class="form-check-label" for="isGRTFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Gudang RM</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isGRM"
                                                        id="isGRMTrue" value="1">
                                                    <label class="form-check-label" for="isGRMTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isGRM"
                                                        id="isGRMFalse" value="0">
                                                    <label class="form-check-label" for="isGRMFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td>HRGA</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isHRGA"
                                                        id="isHRGATrue" value="1">
                                                    <label class="form-check-label" for="isHRGATrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isHRGA"
                                                        id="isHRGAFalse" value="0">
                                                    <label class="form-check-label" for="isHRGAFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Digital Sales</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isDGSL"
                                                        id="isDGSLTrue" value="1">
                                                    <label class="form-check-label" for="isDGSLTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isDGSL"
                                                        id="isDGSLFalse" value="0">
                                                    <label class="form-check-label" for="isDGSLFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td>Sales</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isSLS"
                                                        id="isSLSTrue" value="1">
                                                    <label class="form-check-label" for="isSLSTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isSLS"
                                                        id="isSLSFalse" value="0">
                                                    <label class="form-check-label" for="isSLSFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Marketing</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isMRKT"
                                                        id="isMRKTTrue" value="1">
                                                    <label class="form-check-label" for="isMRKTTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isMRKT"
                                                        id="isMRKTFalse" value="0">
                                                    <label class="form-check-label" for="isMRKTFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td>Pengiriman</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isDEL"
                                                        id="isDELTrue" value="1">
                                                    <label class="form-check-label" for="isDELTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isDEL"
                                                        id="isDELFalse" value="0">
                                                    <label class="form-check-label" for="isDELFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Produksi</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isPROD"
                                                        id="isPRODTrue" value="1">
                                                    <label class="form-check-label" for="isPRODTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isPROD"
                                                        id="isPRODFalse" value="0">
                                                    <label class="form-check-label" for="isPRODFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td>PPIC</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isPPIC"
                                                        id="isPPICTrue" value="1">
                                                    <label class="form-check-label" for="isPPICTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isPPIC"
                                                        id="isPPICFalse" value="0">
                                                    <label class="form-check-label" for="isPPICFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Repair</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isRPR"
                                                        id="isRPRTrue" value="1">
                                                    <label class="form-check-label" for="isRPRTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isRPR"
                                                        id="isRPRFalse" value="0">
                                                    <label class="form-check-label" for="isRPRFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td>Purchasing</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isPRCH"
                                                        id="isPRCHTrue" value="1">
                                                    <label class="form-check-label" for="isPRCHTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isPRCH"
                                                        id="isPRCHFalse" value="0">
                                                    <label class="form-check-label" for="isPRCHFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Repeat this pattern for all 14 boolean fields -->
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
                                <a href="{{ route('itemgroups.index') }}" class="btn btn-danger">{{ __('Cancel') }}</a>
                            </div>
                        </form>

                        <div class="card-footer clearfix">
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
