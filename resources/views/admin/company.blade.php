@extends('layouts.admin.template')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">@lang('company.list_caption')</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="text-right">
                <a type="button" href="{{route('admin.companies.create')}}" class="btn btn-success">@lang('company.create_btn')</a>
            </div>
            <table id="companies-table" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>@lang('company.logo')</th>
                <th>@lang('company.name')</th>
                <th>@lang('company.email')</th>
                <th>@lang('company.website')</th>
                <th>@lang('admin_layout.action')</th>
              </tr>
              </thead>
              </tfoot>
            </table>

            {{ $companies->links() }}
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('scripts')
    <script type="text/javascript">
        appUtils.setAppData('companies', JSON.parse('{!! str_replace("'", "\\'", $companies->toJson()) !!}'));
        appUtils.setMessages({
            delete_failed: '@lang('company.delete_failed')',
            delete_success: '@lang('company.delete_success')',
        }, 'company');
    </script>
    <script src="{{ asset('assets/js/pages/companies.js')  }}"></script>
@endsection
