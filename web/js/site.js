let bodyLoad = `
<div style="text-align: center; margin: 3% 0 3% 0">
    <img src="${baseUrl}/images/loading.gif">
</div>
`;

$("#detailModal").on("show.bs.modal", function (event) {
  let button = $(event.relatedTarget);
  let modal = $(this);
  let title = button.data("title");
  let header = `${title}
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>`;
  let href = button.attr("href");
  console.log(href);
  modal.find(".modal-header").html(header);
  modal.find(".modal-body").html(bodyLoad);
  $.post(href).done(function (data) {
    modal.find(".modal-body").html(data);
  });
});

// const flashSuccess = $('.flashSuccess-data').data('flashdata');
const flashData = $(".flashSuccess-data");
const hasFlash = flashData.data("flashdata");
// const href = $(this).attr('href');
if (hasFlash) {
  // $data = $('.flashSuccess-data');
  const alertTypes = flashData.data("alert");
  const dataValue = flashData.data("value");
  Swal.fire({
    position: "center",
    title: dataValue,
    icon: alertTypes,
    showConfirmButton: false,
    timer: 3000,
  });
}

function showAlert(title, icon) {
  return Swal.fire({
    position: "center",
    title: title,
    icon: icon,
    showConfirmButton: false,
    timer: 3000,
  });
}
