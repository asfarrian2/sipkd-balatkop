<form action="/spj/store" method="POST" id="frmCabang" enctype="multipart/form-data">
                            @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3 col-md-6 col-sm-6">
                                <span>Tanggal</span>
                                <input type="date" value="" name="tgl_spj" id="tgl_spj" class="form-control" placeholder="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3 col-md-12 col-sm-6">
                                <span>Uraian</span>
                                <textarea name="uraian_spj" id="uraian_spj" class="form-control" placeholder="" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3 col-md-12 col-sm-6">
                                <span>Penerima</span>
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
