$(document).ready(function (){
    $('#RoleTable').DataTable( {
        processing: true,
        ajax: {
            url: '/role/ajax',
        },
        columns: [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'id',
                name: 'id',
                render: function ( data, type, row ) {
                    var html = '<div class="text-center">';

                    if (userPermissions.canEditRole) {
                        html += '<a href="/role/edit/'+ data +'" class="btn btn-primary btn-sm" title="Edit Data"><i class="fas fa-edit"></i></a>';
                    }

                    if (userPermissions.canDeleteRole) {
                        html += '&nbsp;&nbsp;' + '<a href="/role/delete/'+ data +'" class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i> </a>';
                    }

                    html += '</div>';

                    return html;
                },
            },
        ],
    });



    $('.parent').change(function () {
        var parentId = $(this).val();
        $('.child[data-parent="' + parentId + '"]').prop('checked', $(this).prop('checked'));
    });

    // Handle child checkboxes
    $('.child').change(function () {
        var parentId = $(this).data('parent');
        var checkedChildren = $('.child[data-parent="' + parentId + '"]:checked').length;
        var totalChildren = $('.child[data-parent="' + parentId + '"]').length;
        $('.parent[value="' + parentId + '"]').prop('checked', checkedChildren === totalChildren);
    });
});

$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Are you sure ?',
            text: "You want to delete this data ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(link);
                window.location.href = link
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
            else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    title: "Cancelled",
                    text: "Your imaginary file is safe :)",
                    icon: "error"
                });
            }
        })
    });
});
