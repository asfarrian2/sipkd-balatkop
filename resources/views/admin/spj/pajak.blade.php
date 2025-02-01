<form action="/spj/pajak/store" method="POST" id="frmCabang" enctype="multipart/form-data">
                    @csrf
                    <input type="text" hidden value="{{ $id_spj}}" name="id_spj" id="id_spj" class="form-control" placeholder="" required>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3 col-md-12 col-sm-6">
                                <span>PPN (Rp)</span>
                                <input type="text" value="0" name="pajakppn" id="pajakppn" class="form-control" placeholder="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-6 col-md-12 col-sm-6">
                                <span>Jenis Pajak PPh</span>
                                <select name="id_pajak" id="id_pajak" class="form-control" required>
                                 <option value="">Pilih Pajak</option>
                                     @foreach ($pajak as $d)
                                         <option
                                             value="{{ $d->id_pajak }}">{{ ($d->jenis_pajak) }}</option>
                                     @endforeach
                                 </select>
                            </div>
                        </div>
                    </div>
                    <div><br></div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3 col-md-12 col-sm-6">
                                <span>Nominal PPh (Rp)</span>
                                <input type="text" value="" name="pajakpph" id="pajakpph" class="form-control" placeholder="" required>
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
