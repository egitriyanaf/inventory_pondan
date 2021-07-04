@extends('index')

@section('content')
  <section class="content-header">
      <h1>
        Satuan
        <small>Panel Kendali</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('beranda') }}"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">Satuan</li>
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
                  <th><center>SATUAN</center></th>
                  @if(Auth::user()->level == 'Admin')
                    <th width="50px">AKSI</th>
                  @endif
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $d)
                    <tr>
                      <td width="10px" align="center">{{ $no++ }}</td>
                      <td>{{ $d->satuan }}</td>
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
                          <form method="post" action="{{ url('ubah_satuan/'.$d->id) }}">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Ubah Data Satuan</h4>
                            </div>
                            <div class="modal-body">
                                @csrf
                                
                                <div class="box-body">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label>Satuan</label>
                                        <input type="text" class="form-control" id="satuan" name="satuan" required value="{{ $d->satuan }}">
                                      </div>
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
      <form method="post" action="{{ url('simpan_satuan') }}">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Data Satuan</h4>
        </div>
        <div class="modal-body">
            @csrf
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Satuan</label>
                    <input type="text" class="form-control" id="satuan" name="satuan" required>
                  </div>
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
          window.location.href = "{{ url('hapus_satuan') }}"+'/'+id;
        }
      })
    }
</script>
@endsection