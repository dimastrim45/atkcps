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
                                            <td>
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
                                        <tr>
                                            <td>Gudang FG</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isWFG"
                                                        id="isWFGTrue" value="1">
                                                    <label class="form-check-label" for="isWFGTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isWFG"
                                                        id="isWFGFalse" value="0">
                                                    <label class="form-check-label" for="isWFGFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td>Gudang Retail</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isWRT"
                                                        id="isWRTTrue" value="1">
                                                    <label class="form-check-label" for="isWRTTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isWRT"
                                                        id="isWRTFalse" value="0">
                                                    <label class="form-check-label" for="isWRTFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Gudang RM</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isWRM"
                                                        id="isWRMTrue" value="1">
                                                    <label class="form-check-label" for="isWRMTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isWRM"
                                                        id="isWRMFalse" value="0">
                                                    <label class="form-check-label" for="isWRMFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td>HRG</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isHRG"
                                                        id="isHRGTrue" value="1">
                                                    <label class="form-check-label" for="isHRGTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isHRG"
                                                        id="isHRGFalse" value="0">
                                                    <label class="form-check-label" for="isHRGFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Digital Sales</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isDGS"
                                                        id="isDGSTrue" value="1">
                                                    <label class="form-check-label" for="isDGSTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isDGS"
                                                        id="isDGSFalse" value="0">
                                                    <label class="form-check-label" for="isDGSFalse">Not Allowed</label>
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
                                                    <input class="form-check-input" type="radio" name="isMKT"
                                                        id="isMKTTrue" value="1">
                                                    <label class="form-check-label" for="isMKTTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isMKT"
                                                        id="isMKTFalse" value="0">
                                                    <label class="form-check-label" for="isMKTFalse">Not Allowed</label>
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
                                                    <input class="form-check-input" type="radio" name="isPRD"
                                                        id="isPRDTrue" value="1">
                                                    <label class="form-check-label" for="isPRDTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isPRD"
                                                        id="isPRDFalse" value="0">
                                                    <label class="form-check-label" for="isPRDFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td>PPIC</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isPPI"
                                                        id="isPPITrue" value="1">
                                                    <label class="form-check-label" for="isPPITrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isPPI"
                                                        id="isPPIFalse" value="0">
                                                    <label class="form-check-label" for="isPPIFalse">Not Allowed</label>
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
                                                    <input class="form-check-input" type="radio" name="isPCH"
                                                        id="isPCHTrue" value="1">
                                                    <label class="form-check-label" for="isPCHTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isPCH"
                                                        id="isPCHFalse" value="0">
                                                    <label class="form-check-label" for="isPCHFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Quality Control</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isQCT"
                                                        id="isQCTTrue" value="1">
                                                    <label class="form-check-label" for="isQCTTrue">Allowed</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="isQCT"
                                                        id="isQCTFalse" value="0">
                                                    <label class="form-check-label" for="isQCTFalse">Not Allowed</label>
                                                </div>
                                            </td>
                                        </tr>
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
