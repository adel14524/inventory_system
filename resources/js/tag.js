$(document).ready(function (){
    $('#tagTable').DataTable( {
        processing: true,
        ajax: {
            url: '/product/tag/ajax',
        },
        columns: [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'tag_name',
                name: 'tag_name'
            },
            {
                data: 'id',
                name: 'id',
                render: function ( data, type, row ) {
                    var html = '<div class="text-center">';

                    if (userPermissions.canEditTag) {
                        html += '<a href="/product/tag/edit/'+ data +'" class="btn btn-primary btn-sm" title="Edit Data"><i class="fas fa-edit"></i></a>';
                    }

                    if (userPermissions.canDeleteTag) {
                        html += '&nbsp;&nbsp;' + '<a href="/product/tag/delete/'+ data +'" class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i> </a>';
                    }

                    html += '</div>';

                    return html;
                },
            },
        ],
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
