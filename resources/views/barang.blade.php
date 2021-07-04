@extends('index')

@section('content')
  <section class="content-header">
      <h1>
        Barang
        <small>Panel Kendali</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">Barang</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              @if(Auth::user()->level == 'Admin')
              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#tambahdata"><i class="fa fa-plus"></i> Tambah Data</button>
              @endif
            </div>
            <div class="box-body">
              <table class="table table-bordered table-striped datatables">
                <thead>
                <tr>
                  <th width="10px"><center>NO</center></th>
                  <th width="100px"><center>ITEM</center></th>
                  <th><center>DESKRIPSI</center></th>
                  <th width="50px"><center>QTY</center></th>
                  <th width="80px"><center>SATUAN</center></th>
                  <th width="100px"><center>HARGA</center></th>
                  <!-- <th>DISC</th>
                  <th>TAX</th>
                  <th>AMOUNT</th> -->
                  @if(Auth::user()->level == 'Admin')
                    <th width="50px">AKSI</th>
                  @endif
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $d)
                    <tr>
                      <td width="10px" align="center">{{ $no++ }}</td>
                      <td width="100px">{{ $d->item }}</td>
                      <td>{{ $d->desc }}</td>
                      <td width="50px" align="center">{{ number_format($d->qty) }}</td>
                      <td width="80px" align="center">{{ $d->satuan }}</td>
                      <td width="100px" align="right">Rp {{ number_format($d->unit_price) }}</td>
                      <!-- <td>{{ $d->disc }}</td>
                      <td>{{ $d->tax }}</td>
                      <td>{{ $d->amount }}</td> -->
                      @if(Auth::user()->level == 'Admin')
                        <td width="50px">
                          <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#ubahdata{{ $d->id }}"><i class="fa fa-edit"></i></button>
                          <button class="btn btn-default btn-sm" onclick="return del('{{ $d->id  }}')"><i class="fa fa-trash"></i></button>
                        </td>
                      @endif
                    </tr>


                    <div class="modal fade" id="ubahdata{{$d->id}}">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form method="post" action="{{ url('ubah_barang/'.$d->id) }}">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Ubah Data Barang</h4>
                            </div>
                            <div class="modal-body">
                                @csrf
                                <div class="box-body">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Item</label>
                                        <input type="text" class="form-control" id="item" name="item" required value="{{ $d->item }}">
                                      </div>
                                      <div class="form-group">
                                        <label>Item Deskripsi</label>
                                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" required value="{{ $d->desc }}">
                                      </div>
                                      <div class="form-group">
                                        <label>QTY</label>
                                        <input type="number" step="1" min="0" class="form-control" id="qty" required name="qty" value="{{ $d->qty }}">
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Satuan</label>
                                        <select class="form-control" id="satuan" name="satuan" required>
                                          <option>-- Select --</option>
                                          @foreach($satuan as $s)
                                            <option value="{{ $s->id }}" {{ ($d->id_satuan == $s->id) ? 'selected':''}}>{{ $s->satuan }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <label>Harga</label>
                                        <input type="number" min="0" step="1" class="form-control" id="harga" name="harga" value="{{ $d->unit_price }}" required>
                                      </div>
                                      <!-- <div class="form-group">
                                        <label>Disc (%)</label>
                                        <input type="number" class="form-control" id="disc" name="disc" step="0.1" min="0" max="100" required>
                                      </div>
                                      <div class="form-group">
                                        <label>Tax</label>
                                        <input type="text" class="form-control" id="tax" name="tax" required>
                                      </div>
                                      <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" class="form-control" id="amount" name="amount" min="0" step="1" required>
                                      </div>
                                    </div> -->
                                  </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

<!-- FORM TAMBAH DATA -->
<div class="modal fade" id="tambahdata">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="{{ url('simpan_barang') }}">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Data Barang</h4>
        </div>
        <div class="modal-body">
            @csrf
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <!-- <div class="form-group">
                    <label>Kode</label>
                    <input type="text" class="form-control" id="kode" name="kode" readonly>
                  </div> -->
                  <div class="form-group">
                    <label>Item</label>
                    <input type="text" class="form-control" id="item" name="item" required>
                  </div>
                  <div class="form-group">
                    <label>Item Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                  </div>
                  <div class="form-group">
                    <label>QTY</label>
                    <input type="number" step="1" min="0" class="form-control" id="qty" required name="qty" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Satuan</label>
                    <select class="form-control" id="satuan" name="satuan" required>
                      <option>-- Pilih --</option>
                      @foreach($satuan as $s)
                        <option value="{{ $s->id }}">{{ $s->satuan }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Harga</label>
                    <input type="number" min="0" step="1" class="form-control" id="harga" name="harga" required>
                  </div>
                  <!-- <div class="form-group">
                    <label>Disc (%)</label>
                    <input type="number" class="form-control" id="disc" name="disc" step="0.1" min="0" max="100" required>
                  </div>
                  <div class="form-group">
                    <label>Tax</label>
                    <input type="text" class="form-control" id="tax" name="tax" required>
                  </div>
                  <div class="form-group">
                    <label>Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount" min="0" step="1" required>
                  </div> -->
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.9/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    @if(Session::get('sukses'))
      Swal.fire({
        icon: 'success',
        title: '{{ Session::get("sukses") }}',
        showConfirmButton: false,
        timer: 1500
      })
    @endif
  });

  function del(id) {
      Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data yang dihapus tidak bisa dikembalikan lagi!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Iya, hapus aja!'
      }).then(result => {
        if (result.value) {
          window.location.href = "{{ url('hapus_barang') }}"+'/'+id;
        }
      })
    }
</script>
@endsection