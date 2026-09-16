<?= $this->extend('template_admin'); ?>

<?= $this->section('main'); ?>
<div class="container-fluid pb-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 mb-1 text-gray-800">Log Tracking</h1>
            <p class="mb-0 text-muted">Menampilkan maksimal 500 kegagalan terbaru pada tanggal yang dipilih.</p>
        </div>
        <button type="button" class="btn btn-primary mt-2 mt-sm-0" onclick="window.location.reload()">
            <i class="fas fa-sync-alt mr-1"></i> Refresh
        </button>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="get" action="<?= base_url('admin/tracking_log') ?>" class="row align-items-end">
                <div class="col-md-4 mb-2">
                    <label for="date" class="font-weight-bold">Tanggal</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?= esc($selected_date) ?>">
                </div>
                <div class="col-md-5 mb-2">
                    <label for="search" class="font-weight-bold">Cari ID trace atau resi</label>
                    <input type="text" class="form-control" id="search" name="search" value="<?= esc($search) ?>" placeholder="Contoh: SSIN29833">
                </div>
                <div class="col-md-3 mb-2">
                    <button type="submit" class="btn btn-info btn-block"><i class="fas fa-search mr-1"></i> Tampilkan</button>
                </div>
            </form>

            <?php if (!empty($available_dates)) { ?>
                <div class="mt-2 small text-muted">
                    Log tersedia: <?= esc(implode(', ', array_slice($available_dates, 0, 10))) ?><?= count($available_dates) > 10 ? ' …' : '' ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php if (!$log_exists) { ?>
        <div class="alert alert-secondary text-center">File log untuk <?= esc($selected_date) ?> belum tersedia.</div>
    <?php } elseif (empty($records)) { ?>
        <div class="alert alert-success text-center">Tidak ada kegagalan tracking yang cocok pada tanggal ini.</div>
    <?php } else { ?>
        <?php foreach ($records as $record) { ?>
            <?php $context = $record['context']; ?>
            <div class="card shadow-sm mb-3 border-left-<?= $record['type'] === 'API' ? 'danger' : 'warning' ?>">
                <div class="card-body py-3">
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-2">
                        <div>
                            <span class="badge badge-<?= $record['type'] === 'API' ? 'danger' : 'warning' ?> mr-2"><?= esc($record['type']) ?></span>
                            <strong><?= esc($context['id_order'] ?? '-') ?></strong>
                        </div>
                        <span class="text-muted small"><?= esc($record['timestamp']) ?></span>
                    </div>

                    <?php if (!empty($context)) { ?>
                        <div class="row small">
                            <div class="col-md-4 mb-1"><strong>Trace ID:</strong> <?= esc($context['trace_id'] ?? '-') ?></div>
                            <div class="col-md-2 mb-1"><strong>HTTP:</strong> <?= esc((string) ($context['http_status'] ?? '-')) ?></div>
                            <div class="col-md-3 mb-1"><strong>Status:</strong> <?= esc($context['ajax_status'] ?? '-') ?></div>
                            <div class="col-md-3 mb-1"><strong>Durasi:</strong> <?= isset($context['duration_ms']) ? esc((string) $context['duration_ms']) . ' ms' : '-' ?></div>
                        </div>
                        <?php $error_message = $context['curl_error'] ?? ($context['error'] ?? ($context['json_error'] ?? '')); ?>
                        <?php if ($error_message !== '') { ?>
                            <div class="alert alert-danger py-2 px-3 mt-2 mb-2 small"><?= esc($error_message) ?></div>
                        <?php } ?>
                        <?php if (!empty($context['response_preview'])) { ?>
                            <details class="mt-2">
                                <summary class="small font-weight-bold" style="cursor:pointer">Lihat potongan respons</summary>
                                <pre class="bg-light border rounded p-2 mt-2 mb-0 small" style="white-space:pre-wrap;word-break:break-word"><?= esc($context['response_preview']) ?></pre>
                            </details>
                        <?php } ?>
                    <?php } else { ?>
                        <pre class="bg-light border rounded p-2 mb-0 small" style="white-space:pre-wrap;word-break:break-word"><?= esc($record['raw']) ?></pre>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>
<?= $this->endSection(); ?>
