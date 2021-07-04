@extends('index')

@section('content')
  <section class="content-header">
      <h1>
        Surat Jalan
        <small>Panel Kendali</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">Surat Jalan</li>
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
                  <th>Delivery No</th>
                  <th>PO No.</th>
                  <th>Delivery Date</th>
                  <th>Ship Via</th>
                  <th>Bill To</th>
                  <th>Ship</th>
                  <th>Address</th>
                  <th>Description</th>
                  @if(Auth::user()->level == 'Admin')
                    <th width="82px">AKSI</th>
                  @endif
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $d)
                    <tr>
                      <td width="10px" align="center">{{ $no++ }}</td>
                      <td>{{ $d->delivery_no }}</td>
                      <td>{{ $d->po_no }}</td>
                      <td>{{ $d->delivery_date }}</td>
                      <td>{{ $d->ship_via }}</td>
                      <td>{{ $d->bill_to }}</td>
                      <td>{{ $d->nama }}</td>
                      <td>{{ $d->alamat }}</td>
                      <td>{{ $d->desc }}</td>
                      @if(Auth::user()->level == 'Admin')
                        <td width="50px">
                          <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#ubahdata{{ $d->delivery_no }}"><i class="fa fa-edit"></i></button>
                          <button class="btn btn-default btn-sm" onclick="return del('{{ $d->delivery_no  }}')"><i class="fa fa-trash"></i></button>
                          <a href="{{ url('cetak_surat_jalan/'.$d->delivery_no) }}" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                      @endif
                    </tr>

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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="{{ url('simpan_surat_jalan') }}" autocomplete="off">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Data Surat Jalan</h4>
        </div>
        <div class="modal-body">
            @csrf
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Delivery No.</label>
                    <input type="text" class="form-control" id="delivery_no" name="delivery_no" required>
                  </div>
                  <div class="form-group">
                    <label>Delivery Date</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" id="delivery_date" name="delivery_date" class="form-control pull-right datepicker">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Ship Via</label>
                    <input type="text" class="form-control" id="ship_via" name="ship_via" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Ship To</label>
                    <select class="form-control" id="ship_to" name="ship_to" required>
                      <option>-- Pilih --</option>
                      @foreach($pelanggan as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>PO No.</label>
                    <select class="form-control" id="po_no" name="po_no" required>
                      <option>-- Pilih --</option>
                      @foreach($nomorpo as $np)
                        <option value="{{ $np->po_no }}">{{ $np->po_no }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Bill To</label>
                    <select class="form-control" id="bill_to" name="bill_to" required>
                      <option>-- Pilih --</option>
                      <option value="Pelanggan Umum">Pelanggan Umum</option>
                      @foreach($pelanggan as $p)
                        <option value="{{ $p->nama }}">{{ $p->nama }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" id="desc" name="desc" rows="5"></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <a href="#tambah_item" id="tambah_item" onclick="myFunction()"><i class="fa fa-plus"></i> Tambah Item</a>
                  <table id="table_tambah_item" class="table table-bordered">
                    <thead>
                      <tr>
                        <th width="120px"><center>Item</center></th>
                        <th><center>Item Description</center></th>
                        <th width="70px"><center>Satuan</center></th>
                        <th width="100px"><center>Qty</center></th>
                        <th width="100px"><center>Exp. Date</center></th>
                        <th><center>Serial Number</center></th>
                        <th><center></center></th>
                      </tr>
                    </thead>
                  </table>
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

@foreach($data as $d)
  <!-- FORM UBAH DATA -->
    <div class="modal fade" id="ubahdata{{ $d->delivery_no}}">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form method="post" action="{{ url('update_surat_jalan/'.$d->delivery_no) }}" autocomplete="off">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Ubah Data Surat Jalan</h4>
            </div>
            <div class="modal-body">
                @csrf
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Delivery No.</label>
                        <input type="text" class="form-control" id="delivery_no" name="delivery_no" value="{{ $d->delivery_no }}" required>
                      </div>
                      <div class="form-group">
                        <label>Delivery Date</label>

                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" id="delivery_date" name="delivery_date" class="form-control pull-right datepicker" value="{{ $d->delivery_date }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Ship Via</label>
                        <input type="text" class="form-control" id="ship_via" name="ship_via" value="{{ $d->ship_via }}" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Ship To</label>
                        <select class="form-control" id="ship_to" name="ship_to" required>
                          <option>-- Pilih --</option>
                          @foreach($pelanggan as $p)
                            <option value="{{ $p->id }}" {{ ($d->id_pelanggan == $p->id) ? 'selected' : '' }}>{{ $p->nama }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>PO No.</label>
                        <select class="form-control" id="po_no" name="po_no" required>
                          <option>-- Pilih --</option>
                          @foreach($nomorpo as $np)
                            <option value="{{ $np->po_no }}" {{ ($d->po_no == $np->po_no) ? 'selected':''}}>{{ $np->po_no }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Bill To</label>
                        <select class="form-control" id="bill_to" name="bill_to" required>
                          <option>-- Pilih --</option>
                          <option value="Pelanggan Umum" {{ ('Pelanggan Umum' == $d->bill_to) ? 'selected':''}}>Pelanggan Umum</option>
                          @foreach($pelanggan as $p)
                            <option value="{{ $p->nama }}" {{ ($p->nama == $d->bill_to) ? 'selected':''}}>{{ $p->nama }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" id="desc" name="desc" rows="5">{{ $d->desc }}</textarea>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <!-- <a href="#tambah_item" id="tambah_item" onclick="myFunctionUpdate()"><i class="fa fa-plus"></i> Tambah Item</a> -->
                      <table id="table_tambah_item_update" class="table table-bordered">
                        <thead>
                          <tr>
                            <th width="120px"><center>Item</center></th>
                            <th><center>Item Description</center></th>
                            <th width="70px"><center>Satuan</center></th>
                            <th width="100px"><center>Qty</center></th>
                            <th width="100px"><center>Exp. Date</center></th>
                            <th><center>Serial Number</center></th>
                            <th><center></center></th>
                          </tr>
                        </thead>
                        <tbody>
                          <span hidden> {{ $num = 100 }} </span>
                          @foreach($detail as $dt)
                            @if($d->delivery_no == $dt->delivery_no)
                              <tr>
                                <td>
                                  <select class="form-control" onchange="OnSelectChangeUpdate2(this, {{$num}})" name="item[]">

                                    @foreach($barang as $br)
                                      <option data-desc = "{{ $br->desc }}" data-satuan="{{ $br->satuan }}" value="{{ $br->item }}" {{ ($br->item == $dt->item ) ? 'selected':''}}  >{{ $br->item }}</option>
                                    @endforeach
                                  </select>
                                </td>
                                <td>
                                  <textarea class="form-control" name="desc_detail[]" id="desc_detail{{$num}}" readonly="">{{ $dt->desc }}</textarea>
                                </td>
                                <td>
                                  <input type="text" name="satuan[]" id="satuan{{$num}}" class="form-control" value="{{ $dt->satuan }}" readonly>
                                </td>
                                <td>
                                  <input type="number" step="1" min="0" name="qty[]" id="qty{{ $num }}"class="form-control" value="{{ $dt->qty }}">
                                </td>
                                <td>
                                  <input type="date" name="expired_date[]" value="{{ $dt->expired_date }}" class="form-control">
                                </td>
                                <td>
                                  <input type="text" name="serial_number[]" value="{{ $dt->serial_number}}" class="form-control">
                                </td>
                                <td onclick="myDeleteFunctionUpdate2(this)">
                                  <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                </td>
                              </tr>
                            @endif
                              <span hidden> {{ $num++ }} </span>
                          @endforeach
                        </tbody>
                      </table>
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
          window.location.href = "{{ url('hapus_surat_jalan') }}"+'/'+id;
        }
      })
    }
</script>

<script>
  function myFunction() {
    var table = document.getElementById("table_tambah_item");
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);

    // alert(rowCount);
    <?php $select = ''; ?>

    <?php foreach ($barang as $key): ?>
      <?php $select .="<option value='".$key->item."' data-desc = '".$key->desc."' data-satuan='".$key->satuan."' data-harga='".$key->unit_price."'>".$key->item."</option>"; ?>
    <?php endforeach ?>

    cell1.innerHTML = "<select onchange='OnSelectChange(this,"+rowCount+")' class='form-control' name='item[]' id='item"+rowCount+"' required><option>-- Pilih --</option><?php echo $select; ?></select>";
    cell2.innerHTML = "<textarea class='form-control' name='desc_detail[]' id='desc_detail"+rowCount+"' readonly></textarea>";
    cell3.innerHTML = "<input type='text' class='form-control' name='satuan[]' id='satuan"+rowCount+"' readonly>";
    cell4.innerHTML = "<input type='number' step='1' min='0' class='form-control' name='qty[]' id='qty"+rowCount+"' required>";
    cell5.innerHTML = "<input type='date' id='expired_date"+rowCount+"' name='expired_date[]' class='form-control pull-right datepicker'>";
    cell6.innerHTML = "<input type='text' class='form-control' name='serial_number[]' id='serial_number"+rowCount+"' required>";
    cell7.innerHTML = "<button type='button' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></button>";
    cell7.onclick = function() {
      myDeleteFunction(this.parentNode.rowIndex);
    }
  }

  function OnSelectChange(event, id) {
      document.getElementById('desc_detail'+id).value = event.selectedOptions[0].getAttribute('data-desc'); 
      document.getElementById('satuan'+id).value = event.selectedOptions[0].getAttribute('data-satuan'); 
  }

  function myDeleteFunction(x) {
    document.getElementById("table_tambah_item").deleteRow(x);
  }


</script>

<script>
  function myFunctionUpdate() {
    var table = document.getElementById("table_tambah_item_update");
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);

    // alert(rowCount);
    <?php $select = ''; ?>

    <?php foreach ($barang as $key): ?>
      <?php $select .="<option value='".$key->item."' data-desc = '".$key->desc."' data-satuan='".$key->satuan."' data-harga='".$key->unit_price."'>".$key->item."</option>"; ?>
    <?php endforeach ?>

    cell1.innerHTML = "<select onchange='OnSelectChangeUpdate(this,"+rowCount+")' class='form-control' name='item[]' id='item"+rowCount+"' required><option>-- Pilih --</option><?php echo $select; ?></select>";
    cell2.innerHTML = "<textarea class='form-control' name='desc_detail[]' id='desc_detail"+rowCount+"' readonly></textarea>";
    cell3.innerHTML = "<input type='text' class='form-control' name='satuan[]' id='satuan"+rowCount+"' readonly>";
    cell4.innerHTML = "<input type='number' step='1' min='0' class='form-control' name='qty[]' id='qty"+rowCount+"' required>";
    cell5.innerHTML = "<input type='date' id='expired_date"+rowCount+"' name='expired_date[]' class='form-control pull-right datepicker'>";
    cell6.innerHTML = "<input type='text' class='form-control' name='serial_number[]' id='serial_number"+rowCount+"' required>";
    cell7.innerHTML = "<button type='button' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></button>";
    cell7.onclick = function() {
      myDeleteFunctionUpdate(this.parentNode.rowIndex);
    }
  }

  function OnSelectChangeUpdate(event, id) {
      document.getElementById('desc_detail'+id).value = event.selectedOptions[0].getAttribute('data-desc'); 
      document.getElementById('satuan'+id).value = event.selectedOptions[0].getAttribute('data-satuan');  
  }

  function OnSelectChangeUpdate2(event, x) {
      document.getElementById('desc_detail'+x).value = event.selectedOptions[0].getAttribute('data-desc'); 
      document.getElementById('satuan'+x).value = event.selectedOptions[0].getAttribute('data-satuan');  
  }

  function myDeleteFunctionUpdate(x) {
    document.getElementById("table_tambah_item_update").deleteRow(x);
  }

  function myDeleteFunctionUpdate2(x) {
    document.getElementById("table_tambah_item_update").deleteRow(x.parentNode.rowIndex);
    // alert(x.parentNode.rowIndex);
  }
</script>

@endsection