<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight">Kontrol Paneli</h2>
        </div>
    </div>
</div>
<div class="page-content page-container" id="page-content">
    <div class="padding sr">
        <div class="alert bg-success mb-5 py-4" role="alert">
            <div class="d-flex">
                <i data-feather="info" width="48" height="48"></i>
                <div class="px-3">
                    <h5 class="alert-heading">Merhaba!</h5>
                    <p>Öncelikle sizleri aramızda görmekten büyük mutluluk duyduğumuzu belirtmek isterim.</p>
                </div>
            </div>
        </div>
        <div class="row row-sm text-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row row-sm">
                            <div class="col-6">
                                <small class="text-muted">Bilet Sayısı</small>
                                <div class="mt-2 font-weight-500 text-info"><?php echo getViewData('count')['ticket']; ?></div>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">Dns Sayısı</small>
                                <div class="mt-2 font-weight-500 text-info"><?php echo getViewData('count')['dns']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>