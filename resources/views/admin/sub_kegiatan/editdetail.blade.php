<form action="/sub_kegiatan/subdet/store" method="POST" id="frmCabangEdit">
@csrf

    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span>PAGU</span>
                <input type="text" id="duit" value="{{ $detail_subkegiatan->pagu_subdet}}" class="form-control duit" name="pagu_sub_det" required>
            </div>
        </div>
    </div>
    <input hidden type="text" value="{{ $detail_subkegiatan->id_subdet}}" id="" class="form-control duit" name="input_kode_sub_kegiatan" required>
    <div class="row mt-2">
        <div class="col-12">
            <div class="form-group">
                <button class="btn btn-success w-100">
                    SIMPAN
                </button>
            </div>
        </div>
    </div>
</form>

