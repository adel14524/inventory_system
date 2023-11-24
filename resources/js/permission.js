$(document).ready(function (){
    $('#PermissionTable').DataTable( {
        processing: true,
        ajax: {
            url: '/permission/ajax',
        },
        columns: [
            {
                data: 'id',
                name: 'id',
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

                    if (userPermissions.canEditPermission) {
                        html += '<div class="text-center"><a href="/permission/edit/'+ data +'" class="btn btn-primary btn-sm" title="Edit Data"><i class="fas fa-edit"></i></a>';
                    }

                    if (userPermissions.canDeletePermission) {
                        html += '&nbsp;&nbsp;' + '<a href="/permission/delete/'+ data +'" class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i> </a>';
                    }

                    html += '</div>';

                    return html;
                },
            },
        ],
    });

    $('#square-switch1').change(function() {
        var checkbox = $(this);
        var additionalInputRow = $('#parent-input');

        // Update the display of the additional input row based on the checkbox state
        additionalInputRow.toggle(checkbox.prop('checked'));
    });

    $('#parent').select2({
        width: 'resolve',
        placeholder: 'Please Select Parent Permission',
        allowClear: true,
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
