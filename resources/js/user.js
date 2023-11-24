$(document).ready(function (){
    $('#UserTable').DataTable( {
        processing: true,
        ajax: {
            url: '/user/ajax',
        },
        columns: [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'username',
                name: 'username'
            },
            {
                data: 'id',
                name: 'id',
                render:function (data, type, row) {
                    return row.first_name + '&nbsp;' + row.last_name;
                }
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'phone',
                name: 'phone'
            },
            {
                data: 'roles',
                name: 'roles',
                render: function ( data, type, row ) {

                    var html = '';

                    if (row.roles.length > 1) {
                        row.roles.forEach(element => {
                            if (element.name == 'Admin') {
                                html += '<span class="badge rounded-pill bg-success">' + element.name + '</span>&nbsp;';
                            }
                            else if (element.name == 'Production') {
                                html += '<span class="badge rounded-pill bg-warning">' + element.name + '</span>&nbsp;';
                            }
                            else if (element.name == 'Sub Admin') {
                                html += '<span class="badge rounded-pill bg-info">' + element.name + '</span>&nbsp;';
                            }
                            else {
                                html += '<span class="badge rounded-pill bg-primary">' + element.name + '</span>&nbsp;';
                            }
                        });
                    }
                    else{
                        row.roles.forEach(element => {
                            if (element.name == 'Admin') {
                                html += '<span class="badge rounded-pill bg-success">' + element.name + '</span>&nbsp;';
                            }
                            else if (element.name == 'Production') {
                                html += '<span class="badge rounded-pill bg-warning">' + element.name + '</span>&nbsp;';
                            }
                            else if (element.name == 'Sub Admin') {
                                html += '<span class="badge rounded-pill bg-info">' + element.name + '</span>&nbsp;';
                            }
                            else {
                                html += '<span class="badge rounded-pill bg-primary">' + element.name + '</span>&nbsp;';
                            }
                        });
                    }

                    return html;
                },
            },
            {
                data: 'id',
                name: 'id',
                render: function ( data, type, row ) {

                    var html = '<div class="text-center">';

                    if (userPermissions.canEditUser) {
                        html += '<a href="/user/edit/'+ data +'" class="btn btn-primary btn-sm" title="Edit Data"><i class="fas fa-edit"></i></a>';
                    }

                    if (userPermissions.canDeleteUser) {
                        html += '&nbsp;&nbsp;' + '<a href="/user/delete/'+ data +'" class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i> </a>';
                    }

                    html += '</div>';

                    return html;
                },
            },
        ],
    });

    $('.select2-multiple').select2({
        placeholder: "Select a Role",
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
