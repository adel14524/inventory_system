$(document).ready(function (){
    $('#categoryTable').DataTable( {
        processing: true,
        ajax: {
            url: '/product/category/ajax',
        },
        columns: [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'category_name',
                name: 'category_name'
            },
            {
                data: 'id',
                name: 'id',
                render: function ( data, type, row ) {
                    var html = '<div class="text-center">';

                    if (userPermissions.canEditCategory) {
                        html += '<a href="/product/category/edit/'+ data +'" class="btn btn-primary btn-sm" title="Edit Data"><i class="fas fa-edit"></i></a>';
                    }

                    if (userPermissions.canDeleteCategory) {
                        html += '&nbsp;&nbsp;' + '<a href="/product/category/delete/'+ data +'" class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i> </a>';
                    }

                    html += '</div>';

                    return html;
                },
            },
        ],
    });
});
