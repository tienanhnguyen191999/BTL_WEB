$(document).ready(function() {
    $('#main-table').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

    // Toast manage 
    const urlParams = new URLSearchParams(window.location.search);
    const success = urlParams.get('success');
    const error = urlParams.get('error');
    if (success != null) toastr.success('Cập nhật thành công');
    if (error != null) toastr.error('ID không tồn tại');
    // Remove all query String (?) or Hash (#) 
    window.history.pushState({}, document.title, window.location.pathname);

    // Handle delete 
    $(".delete-btn").click(function (){
        $(this).addClass('active');
        $('.delete-btn').not(this).removeClass('active');
    })

    $('.btn-confirm-delete').click(function () {
        // Call request delete
        let deleteId = $('.delete-btn.active').data('id');
        window.location = `${window.location.pathname}delete?id=${deleteId}`;
    })
}) 
