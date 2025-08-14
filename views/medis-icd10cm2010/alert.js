$('.btn-alert').on('click', function (e) {
    e.preventDefault(); // Matikan aksi default pada href untuk menampilkan sweetalert
    const href = $(this).attr('href');
    const form = $(this).parents('form');
    // const action = $(this).attr('data-action');
    // const namaUser = $(this).attr('data-value');
    const title = $(this).attr('title');
    const text = $(this).attr('text');
    const icon = $(this).attr('icon');
    const isForDelete = $(this).attr('isForDelete') ?? false;
    const confirmButtonText = $(this).attr('confirm-button-text');
    const cancelButtonText = $(this).attr('cancel-button-text');
    if (isForDelete) {
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: confirmButtonText,
            cancelButtonText: cancelButtonText ?? "Tidak"
        }).then((result) => {
            if (result.value) {
                $.post($(this).attr("href"), function (data) {
                    // console.log(data);
                    // /* reload gridview */
                    // $.pjax.reload("#pjax-gridview", {
                    //     "timeout": false
                    // });
                    showAlert('Data ICD-10 berhasil dihapus', 'success');
                    $.pjax.reload({
                        container: '#pjax-gridview',
                        timeout: false
                    });
                });
            }
        });
    } else {
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirmButtonText,
            cancelButtonText: cancelButtonText ?? "Tidak"
        }).then((result) => {
            if (result.value) {
                $.post($(this).attr("href"), function (data) {
                    // /* reload gridview */
                    // $.pjax.reload("#pjax-gridview", {
                    //     "timeout": false
                    // });
                });
            }
        });
    }
});