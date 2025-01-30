<form action="/spj/rincian/{{Crypt::encrypt($det_spj->id_det)}}/update" method="POST" id="frmCabang" enctype="multipart/form-data">
                            @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-6 col-md-12 col-sm-6">
                                <span>Nominal (Rp)</span>
                                <input type="text" value="{{ $det_spj->nominal_det}}" name="nominal_baru" id="nominalbaru"  class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div><br></div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3 col-md-12 col-sm-6">
                                <span>Koefesien</span>
                                <input type="number" value="{{ $det_spj->koefesien_det}}" name="koefesien_baru" id="tgl_spj" class="form-control" placeholder="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-success w-100">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
