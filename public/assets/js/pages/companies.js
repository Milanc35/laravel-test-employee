$(document).ready(function() {
  var pageLib = {
      dataListEle: $("#companies-table"),
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
            data : appUtils.getAppData('companies', {data: []}).data,
            paging: false,
            ordering: false,
            info: false,
            searching: false,
            columns: [
                {
                    data: "logo",
                    render: function(data, type) {
                        if (!data) {
                            return data;
                        }
                        return '<img align="centre" src="/'+data+'" height="75px" />'
                    }
                },
                { data: "name" },
                { data: "email" },
                {
                    data: "website",
                    render: function(data, type) {
                        return '<a href="'+data+'" target="_blank">'+data+'</a>'
                    }
                },
                {
                    data: "id",
                    render: function(data, type) {
                        return '<a class="btn btn-primary" href="/admin/companies/'+data+'/edit">'+appUtils.getMessage('edit', 'Edit')+'</a> '
                        + '<a data-index='+data+' class="btn btn-danger table-delete-btn">'+appUtils.getMessage('delete', 'Dele')+'</a>';
                    }
                },
            ]
          });

          that.dataListEle.on("click", "tr td .table-delete-btn", function(){
              var id = $(this).data('index');
              if (id) {
                  var deleteMsg = appUtils.getMessage('delete_failed', 'Delete Failed', 'company');
                  var deleteTitle = appUtils.getMessage('failed', 'Failed',);
                  $.ajax({
                  		url: '/admin/companies/'+id+'',
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
