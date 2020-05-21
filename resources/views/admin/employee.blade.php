@extends('layouts.admin.template')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">@lang('employee.list_caption')</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="text-right">
                <a type="button" href="{{route('admin.employees.create')}}" class="btn btn-success">@lang('employee.create_btn')</a>
            </div>
            <table id="employees-table" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>@lang('employee.first_name')</th>
                <th>@lang('employee.last_name')</th>
                <th>@lang('employee.email')</th>
                <th>@lang('employee.phone')</th>
                <th>@lang('employee.company')</th>
                <th>@lang('admin_layout.action')</th>
              </tr>
              </thead>
              </tfoot>
            </table>

            {{ $employees->links() }}
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
        appUtils.setAppData('employees', JSON.parse('{!! str_replace("'", "\\'", $employees->toJson()) !!}'));
        appUtils.setMessages({
            delete_failed: '@lang('employee.delete_failed')',
            delete_success: '@lang('employee.delete_success')',
        }, 'company');
    </script>
    <script src="{{ asset('assets/js/pages/employees.js')  }}"></script>
@endsection
