<form action="/spj/pajak/{{Crypt::encrypt($pajak->id_inpajak)}}/update" method="POST" id="frmCabang" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3 col-md-12 col-sm-6">
                                <span>PPN (Rp)</span>
                                <input type="text" value="{{ $pajak->ppn }}" name="pajakppn" id="ppnbaru" class="form-control" placeholder="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-6 col-md-12 col-sm-6">
                                <span>Jenis Pajak PPh</span>
                                <select id="id_pajak" name="id_pajak" class="form-control" required="required">
                                    <option value="">Pilih PPh</option>
                                     @foreach ($detail as $d)
                                    <option
                                    {{ $pajak->id_pajak == $d->id_pajak ? 'selected' : '' }}
                                    value="{{ $d->id_pajak }}">{{ $d->jenis_pajak }}</option>
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
                                <input type="text" value="{{ $pajak->pph }}" name="pajakpph" id="pphbaru" class="form-control" placeholder="" required>
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
