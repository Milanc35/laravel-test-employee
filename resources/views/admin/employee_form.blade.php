@extends('layouts.admin.template')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <form role="form" action="{{!empty($employee) ? route('admin.employees.update', $employee->id) : route('admin.employees.store')}}" method="post" enctype="multipart/form-data">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">@lang('admin_layout.'. (!empty($employee) ? 'edit' : 'add')) @lang('admin_layout.employee')</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
                      <input type="hidden" name="_method" value="{{!empty($employee) ? 'PUT' : 'POST'}}">
                      @csrf
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">@lang('employee.first_name')</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control {{ $errors->has('first_name') ? 'is-warning' : '' }}" id="first_name" name="first_name" value="{{old('first_name', !empty($employee) ? $employee->first_name : null)}}" placeholder="@lang('employee.first_name_holder')">
                            @if ($errors->has('first_name'))
                              <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i>
                                  {{ $errors->first('first_name') }}
                              </label>
                           @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">@lang('employee.last_name')</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control {{ $errors->has('last_name') ? 'is-warning' : '' }}" id="last_name" name="last_name" value="{{old('last_name', !empty($employee) ? $employee->last_name : null)}}" placeholder="@lang('employee.last_name_holder')">
                            @if ($errors->has('last_name'))
                              <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i>
                                  {{ $errors->first('last_name') }}
                              </label>
                           @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">@lang('employee.email')</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control {{ $errors->has('email') ? 'is-warning' : '' }}" id="email" name="email" value="{{old('email', !empty($employee) ? $employee->email : null)}}" placeholder="@lang('employee.email_holder')">
                              @if ($errors->has('email'))
                                <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i>
                                    {{ $errors->first('email') }}
                                </label>
                             @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">@lang('employee.phone')</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control {{ $errors->has('phone') ? 'is-warning' : '' }}" minlength="12" data-inputmask="'mask': ['999-999-9999', '+099 999-999-9999', '+99 999-999-9999', '09 999-999-9999']" data-mask id="phone" name="phone" value="{{old('phone', !empty($employee) ? $employee->phone : null)}}" placeholder="@lang('employee.phone_holder')">
                            @if ($errors->has('phone'))
                              <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i>
                                  {{ $errors->first('phone') }}
                              </label>
                           @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">@lang('employee.company')</label>
                          <div class="col-sm-10">
                            <select class="form-control {{ $errors->has('company_id') ? 'is-warning' : '' }}" id="company_id" name="company_id" data-select2-input>
                                <option value="" selected>---select company----<option>
                                @foreach ($companies as $companyId => $companyName)
                                    <option value="{{$companyId}}" {{ (old('company_id', !empty($employee) ? $employee->company_id : null) == $companyId) ? "selected" : "" }}>{{$companyName}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('company_id'))
                              <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i>
                                  {{ $errors->first('company_id') }}
                              </label>
                           @endif
                          </div>
                        </div>
                  </div>
              </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
              <button type="submit" class="btn btn-info">@lang('admin_layout.save') @lang('admin_layout.employee')</button>
              <a href="{{route('admin.employees.index')}}" class="btn btn-default float-right">@lang('admin_layout.cancel')</a>
          </div>
        </div>
        <!-- /.card -->
        </form>
      </div>
      <!-- /.col -->
    </div>
</div><!-- /.container-fluid -->
@endsection
