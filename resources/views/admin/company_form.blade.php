@extends('layouts.admin.template')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <form role="form" action="{{!empty($company) ? route('admin.companies.update', $company->id) : route('admin.companies.store')}}" method="post" enctype="multipart/form-data">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">@lang('admin_layout.'. (!empty($company) ? 'edit' : 'add')) @lang('admin_layout.company')</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
                      <input type="hidden" name="_method" value="{{!empty($company) ? 'PUT' : 'POST'}}">
                      @csrf
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">@lang('company.name')</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-warning' : '' }}" id="name" name="name" value="{{old('name', !empty($company) ? $company->name : null)}}" placeholder="@lang('company.name_holder')">
                            @if ($errors->has('name'))
                              <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i>
                                  {{ $errors->first('name') }}
                              </label>
                           @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">@lang('company.email')</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control {{ $errors->has('email') ? 'is-warning' : '' }}" id="email" name="email" value="{{old('email', !empty($company) ? $company->email : null)}}" placeholder="@lang('company.email_holder')">
                              @if ($errors->has('email'))
                                <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i>
                                    {{ $errors->first('email') }}
                                </label>
                             @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">@lang('company.website')</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control {{ $errors->has('website') ? 'is-warning' : '' }}" id="website" name="website" value="{{old('website', !empty($company) ? $company->website : null)}}" placeholder="@lang('company.website_holder')">
                            @if ($errors->has('website'))
                              <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i>
                                  {{ $errors->first('website') }}
                              </label>
                           @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">@lang('company.logo')</label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control {{ $errors->has('logo') ? 'is-warning' : '' }}" id="logo" name="logo">
                            @if ($errors->has('logo'))
                              <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i>
                                  {{ $errors->first('logo') }}
                              </label>
                           @endif
                          </div>
                        </div>

                  </div>
                  <div class="col-md-6 text-center">
                      @if (!empty($company) && $company->logo)
                      <img src="{{asset($company->logo)}}" style="max-height:300px; max-width:300px">
                      @endif
                  </div>
              </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
              <button type="submit" class="btn btn-info">@lang('admin_layout.save') @lang('admin_layout.company')</button>
              <a href="{{route('admin.companies.index')}}" class="btn btn-default float-right">@lang('admin_layout.cancel')</a>
          </div>
        </div>
        <!-- /.card -->
        </form>
      </div>
      <!-- /.col -->
    </div>
</div><!-- /.container-fluid -->
@endsection
