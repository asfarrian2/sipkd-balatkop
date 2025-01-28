<form action="/spj/rincian/store" method="POST" id="frmCabang" enctype="multipart/form-data">
                            @csrf
                    <input type="text" hidden value="{{ $spj->id_spj}}" name="id_spj" id="id_spj" class="form-control" placeholder="" required>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3 col-md-12 col-sm-6">
                                <span>Rincian</span>
                                <select name="id_penyedia" id="select-option" onchange="autofill()" class="form-control" required>
                                 <option value="">Pilih Rincian</option>
                                     @foreach ($detail as $d)
                                         <option
                                             value="{{ $d->id_subdet }}">{{ ($d->uraian_rekdet) }} Rp <?php echo number_format($d->pagu_rekdet ,2,',','.')?> </option>
                                     @endforeach
                                 </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon col-md-6 col-sm-6">
                                <span>Pagu Anggaran</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6  form-group has-feedback">
						<input readonly type="text" class="form-control has-feedback-left" style="background-color: white;" id="input-text" placeholder="Pagu Anggaran">
						<span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
					</div>
					<div class="col-md-6 col-sm-6  form-group has-feedback">
						<input readonly type="text" class="form-control" id="input-text2" style="background-color: white;" placeholder="Koefesien">
						<span class="fa fa-shopping-cart form-control-feedback right" aria-hidden="true"></span>
					</div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon col-md-6 col-sm-6">
                                <span>Sisa Anggaran</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6  form-group has-feedback">
						<input readonly type="text" class="form-control has-feedback-left" id="input-text3" style="background-color: white;" placeholder="Sisa Anggaran">
						<span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
					</div>
					<div class="col-md-6 col-sm-6  form-group has-feedback">
						<input readonly type="text" class="form-control" id="input-text4" style="background-color: white;" placeholder="Sisa Koefesien">
						<span class="fa fa-shopping-cart form-control-feedback right" aria-hidden="true"></span>
					</div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-6 col-md-12 col-sm-6">
                                <span>Nominal</span>
                                <input type="text" name="nominal_det" id="nominalduit"  class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div><br></div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3 col-md-12 col-sm-6">
                                <span>Koefesien</span>
                                <input type="text" value="" name="nominal_det" id="tgl_spj" class="form-control" placeholder="" required>
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
