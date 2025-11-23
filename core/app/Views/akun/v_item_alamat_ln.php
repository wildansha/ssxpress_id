<div class="card shadow w-100 mb-3">
    <div class="card-body">
        <p class="mb-0" style="font-size: 16px;font-weight: bold;"><?= $nama_penerima ?></p>
        <p class="mb-0" style="font-size: 12px;color: gray;"><?= "+" . $telp_penerima ?></p>
        <p class="mb-0 p-1 rounded" style="font-size: 12px;text-align: left;background-color: grey;color: white;"><?= $alamat . ", " . $negara ?></p>
        <hr class="my-2" style="border-bottom: 1px solid black;">
        <button type="button" class="btn btn-danger" onclick="delete_alamat_ln(<?= $id ?>)"><i class="fas fa-fw fa-trash-alt"></i> Hapus</button>
    </div>
</div>