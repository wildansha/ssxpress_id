// admin_product page
function previewImg(n) {
  const foto = document.querySelector(".foto-input" + n);
  const fotoLabel = document.querySelector(".foto-label" + n);
  const imgPreview = document.querySelector(".foto-preview" + n);

  fotoLabel.textContent = foto.files[0].name;

  const fileFoto = new FileReader();
  fileFoto.readAsDataURL(foto.files[0]);

  fileFoto.onload = function (event) {
    imgPreview.src = event.target.result;
  };
}

function hapusFotoProduct(n) {
  const foto = document.querySelector(".foto-input" + n);
  const fotoLabel = document.querySelector(".foto-label" + n);
  const imgPreview = document.querySelector(".foto-preview" + n);
  foto.value = "";
  fotoLabel.textContent = "Pilih Gambar";
  imgPreview.src = "";
}

function hapusFotoProductServer(n) {
  const foto = document.querySelector("#hapusFoto" + n);
  foto.value = "y";
}

//format Rupiah
var rupiah = document.getElementById("harga");
if (rupiah != null) {
  rupiah.addEventListener("input", function (e) {
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah(this.value, "");
  });
}

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
}

//ckeditor
function ckeditor(id) {
  ClassicEditor.create(document.querySelector(id), {
    toolbar: {
      items: [
        "heading",
        "|",
        "fontSize",
        "fontFamily",
        "fontColor",
        "bold",
        "alignment",
        "italic",
        "link",
        "bulletedList",
        "numberedList",
        "highlight",
        "|",
        "indent",
        "outdent",
        "|",
        "blockQuote",
        "insertTable",
        "undo",
        "redo",
      ],
    },
    language: "en",
    image: {
      toolbar: ["imageTextAlternative", "imageStyle:full", "imageStyle:side"],
    },
    table: {
      contentToolbar: ["tableColumn", "tableRow", "mergeTableCells"],
    },
    licenseKey: "",
  })
    .then((editor) => {
      window.editor = editor;
    })
    .catch((error) => {
      console.error("Oops, something went wrong!");
      console.error(
        "Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:"
      );
      console.warn("Build id: 561sgew402r2-pgqshusvdoge");
      console.error(error);
    });
}
