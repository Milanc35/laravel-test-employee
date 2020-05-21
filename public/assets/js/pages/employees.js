$(document).ready(function() {
  var pageLib = {
      dataListEle: $("#employees-table"),
      initPage: function () {
          this.initTable();
      },
      initTable: function() {
          if (!this.dataListEle || !this.dataListEle.length) {
              return;
          }
          var that = this;

          that.dataListEle.DataTable({
            responsive: true,
            autoWidth: false,
            data : appUtils.getAppData('employees', {data: []}).data,
            paging: false,
            ordering: false,
            info: false,
            searching: false,
            columns: [
                { data: "last_name" },
                { data: "first_name" },
                { data: "email" },
                { data: "phone" },
                { data: "company.name" },
                {
                    data: "id",
                    render: function(data, type) {
                        return '<a class="btn btn-primary" href="/admin/employees/'+data+'/edit">'+appUtils.getMessage('edit', 'Edit')+'</a>'
                        + '<a data-index='+data+' class="btn btn-danger table-delete-btn">'+appUtils.getMessage('delete', 'Dele')+'</a>'
                    }
                },
            ]
          });

          that.dataListEle.on("click", "tr td .table-delete-btn", function(){
              var id = $(this).data('index');
              if (id) {
                  var deleteMsg = appUtils.getMessage('delete_failed', 'Delete Failed', 'employee');
                  var deleteTitle = appUtils.getMessage('failed', 'Failed',);
                  $.ajax({
                  		url: '/admin/employees/'+id+'',
                  		type: "DELETE",
                        data: {},
                  		cache: false,
                        dataType: 'json',
                  		success: function(dataResult){
                            console.log(dataResult);
                            if (dataResult && dataResult.code == 'ok' ) {
                                location.reload();
                            } else {
                                appUtils.displayBootstrapToasts('danger', deleteTitle, deleteMsg);
                            }
                  		},
                        error: function(error){
                             appUtils.displayBootstrapToasts('danger', deleteTitle, deleteMsg);
                        }
              	   });
              }
          });
      },
      randerList: function() {
          this.dataListEle.DataTable().draw('page');
      },
  }

  pageLib.initPage();
});
