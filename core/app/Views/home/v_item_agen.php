<div class="card border-0 w-100 mb-3 agen-card shadow-xl" style="border-radius: 12px; transition: all 0.3s ease; cursor: pointer; overflow: hidden;background-color: #e6e6e6;">
    <div class="card-body p-0">
        <div style="padding: 20px;">
            <h5 class="mb-2" style="font-size: 18px; font-weight: bold; color: #333; text-transform: capitalize;">
                <?= $kabupaten ?>
            </h5>
            <div style="margin-bottom: 15px;">
                <p class="mb-0" style="font-size: 13px; color: #666; line-height: 1.6; display: flex; align-items: flex-start;">
                    <i class="fas fa-map-pin" style="color: #2563eb; margin-right: 8px; margin-top: 2px; flex-shrink: 0;"></i>
                    <span><?= $alamat ?></span>
                </p>
            </div>
            <div style="display: flex; gap: 10px; margin-top: 15px;">
                <a href="<?= $link_gmaps ?>" target="_blank" class="btn btn-sm" style="background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%); color: white; border: none; border-radius: 8px; flex: 1; font-size: 13px; font-weight: 500; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                    <i class="fas fa-map-location-dot"></i> Buka Maps
                </a>
              
            </div>
        </div>
    </div>
</div>

<style>
    .agen-card {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .agen-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(37, 99, 235, 0.3);
    }

    .agen-card:hover button:first-child {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
    }
</style>