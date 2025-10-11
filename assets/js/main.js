// Initiate venobox lightbox
$(document).ready(function () {
  $(".venobox").venobox();
});

// product page
$(".slider-promo-isi").slick({
  arrows: true,
  dots: true,
  autoplay: true,
  autoplaySpeed: 3000,
});

// /product page

// modal img when clicked

$("#myModal").on("show.bs.modal", function (e) {
  var image = $(e.relatedTarget);

  var tittle = image.data("tittle");
  var harga = image.data("harga");
  var deskripsi = image.data("deskripsi");

  var modal = $(this);
  modal.find(".modal-title").text(tittle);
  modal.find(".modal-harga").text(harga);
  modal.find(".modal-deskripsi").text(deskripsi);

  var imagesrc = image.attr("src");
  $(".img-responsive").attr("src", imagesrc);
});

// /modal img when clicked
