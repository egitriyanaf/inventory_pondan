@extends('index')

@section('content')
  <section class="content-header">
      <h1>
        Barang Keluar
        <small>Panel Kendali</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('beranda') }}"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">Barang Keluar</li>
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
                  <th><center>INVOICE DATE</center></th>
                  <th><center>INVOICE NO</center></th>
                  <th><center>TERMS</center></th>
                  <th><center>DUE DATE</center></th>
                  <th><center>SHIP VIA</center></th>
                  <th><center>SHIP DATE</center></th>
                  <th><center>PO NO</center></th>
                  <th><center>CURRENCY</center></th>
                  <th><center>NO FAKTUR PJK</center></th>
                  <th width="82px">AKSI</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $d)
                    <tr>
                      <td width="10px" align="center">{{ $no++ }}</td>
                      <td>{{ $d->invoice_date }}</td>
                      <td>{{ $d->kode }}</td>
                      <td>{{ $d->terms }}</td>
                      <td>{{ $d->due_date }}</td>
                      <td>{{ $d->ship_via }}</td>
                      <td>{{ $d->due_date }}</td>
                      <td>{{ $d->po_no }}</td>
                      <td>{{ $d->currency }}</td>
                      <td>{{ $d->no_faktur }}</td>
                      <td width="50px">
                      @if(Auth::user()->level == 'Admin')
                          <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#ubahdata{{ $d->kode }}"><i class="fa fa-edit"></i></button>
                          <button class="btn btn-default btn-sm" onclick="return del('{{ $d->kode  }}')"><i class="fa fa-trash"></i></button>
                      @endif
                          <a href="{{ url('cetak_faktur_pajak/'.$d->kode) }}" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

<!-- UBAH DATA -->
@foreach($data as $d)

  <div class="modal fade" id="ubahdata{{ $d->kode }}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form method="post" action="{{ url('update_transaksi/'.$d->kode ) }}" autocomplete="off">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Ubah Data</h4>
          </div>
          <div class="modal-body">
              @csrf
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Invoice Date</label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" id="invoice_date" name="invoice_date" class="form-control pull-right datepicker" value="{{ $d->invoice_date }}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Terms</label>
                      <input type="text" class="form-control" id="terms" name="terms" required value="{{ $d->terms }}">
                    </div>
                    <div class="form-group">
                      <label>Ship Via</label>
                      <input type="text" class="form-control" id="ship_via" name="ship_via" required value="{{ $d->ship_via }}">
                    </div>
                    <div class="form-group">
                      <label>PO No</label>
                      <input type="text" class="form-control" id="po_number" name="po_number" required value="{{ $d->po_no }}">
                    </div>
                    <div class="form-group">
                      <label>Bill To</label>
                      <select class="form-control" id="bill_to" name="bill_to" required>
                        <option>-- Pilih --</option>
                        <option value="Pelanggan Umum" {{ ($d->bill_to == 'Pelanggan Umum') ? 'selected':''}}>Pelanggan Umum</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>No. Faktur Pajak</label>
                      <input type="text" class="form-control" id="faktur_pajak" name="faktur_pajak" required value="{{ $d->no_faktur }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Invoice No</label>
                      <input type="text" class="form-control" id="invoice_number" name="invoice_number" required value="{{ $d->kode }}">
                    </div>
                    <div class="form-group">
                      <label>Due Date</label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" id="due_date" name="due_date" class="form-control pull-right datepicker" value="{{ $d->due_date }}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Ship Date</label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" id="ship_date" name="ship_date" class="form-control pull-right datepicker" value="{{ $d->ship_date}}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Currency</label>
                      <select class="form-control" id="currency" name="currency" required>
                        <option>-- Pilih --</option>
                        <option value="IDR" {{ ($d->currency == 'IDR') ? 'selected':''}}>IDR</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Ship To</label>
                      <select class="form-control" id="ship_to" name="ship_to" required>
                        <option>-- Pilih --</option>
                        @foreach($pelanggan as $p)
                          <option value="{{ $p->id }}" {{ ($d->kode_pelanggan) ? 'selected':''}}>{{ $p->nama }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>PPN 10%</label>
                      <input type="number" min="0" step="1" class="form-control" id="ppn" name="ppn" required value="{{ $d->ppn }}">
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
                          <th><center>Unit Price</center></th>
                          <th width="80px"><center>Qty</center></th>
                          <th width="80px"><center>Disc %</center></th>
                          <th width="70px"><center>Tax</center></th>
                          <th><center>Amount</center></th>
                          <th><center></center></th>
                        </tr>
                      </thead>
                      <tbody>
                        <span hidden> {{ $num = 100 }} </span>
                        @foreach($detail as $dt)
                          @if($dt->kode_transaksi == $d->kode)
                            <tr>
                              <td>
                                <select class="form-control" onchange="OnSelectChangeUpdate2(this, {{$num}})" name="item[]">
                                  @foreach($barang as $br)
                                    <option data-desc = "{{$br->desc}}" data-satuan="{{ $br->satuan}}" data-harga="{{ $br->unit_price}}" value="{{ $br->item }}" {{ ($br->item == $dt->item_barang ) ? 'selected':''}}>{{ $br->item }}</option>
                                  @endforeach
                                </select>
                              </td>
                              <td>
                                <textarea class="form-control" name="desc[]" id="desc{{$num}}" readonly="">{{ $dt->desc }}</textarea>
                              </td>
                              <td>
                                <input type="text" name="satuan[]" id="satuan{{ $num }}" class="form-control" value="{{ $dt->satuan }}" readonly>
                              </td>
                              <td>
                                <input type="number" step="1" min="0" name="unit_price[]" id="unit_price{{ $num }}"  class="form-control" value="{{ $dt->unit_price }}" readonly>
                              </td>
                              <td>
                                <input type="number" step="1" min="0" name="qty[]" id="qty{{ $num }}" oninput="hitungUpdate2({{ $num }})" class="form-control" value="{{ $dt->qty }}">
                              </td>
                              <td>
                                <input type="number" step="1" min="0" name="disc[]" value="{{ $dt->disc }}" class="form-control">
                              </td>
                              <td>
                                <input type="text" name="tax[]" value="{{ $dt->tax}}" class="form-control">
                              </td>
                              <td>
                                <input type="number" name="amount[]" id="amount{{ $num }}" class="form-control" value="{{ $dt->amount }}" readonly>
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

<!-- FORM TAMBAH DATA -->
<div class="modal fade" id="tambahdata">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="{{ url('simpan_Transaksi') }}" autocomplete="off">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Data</h4>
        </div>
        <div class="modal-body">
            @csrf
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Invoice Date</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" id="invoice_date" name="invoice_date" class="form-control pull-right datepicker">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Terms</label>
                    <input type="text" class="form-control" id="terms" name="terms" required>
                  </div>
                  <div class="form-group">
                    <label>Ship Via</label>
                    <input type="text" class="form-control" id="ship_via" name="ship_via" required>
                  </div>
                  <div class="form-group">
                    <label>PO No</label>
                    <input type="text" class="form-control" id="po_number" name="po_number" required>
                  </div>
                  <div class="form-group">
                    <label>Bill To</label>
                    <select class="form-control" id="bill_to" name="bill_to" required>
                      <option>-- Pilih --</option>
                      <option value="Pelanggan Umum">Pelanggan Umum</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>No. Faktur Pajak</label>
                    <input type="text" class="form-control" id="faktur_pajak" name="faktur_pajak" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Invoice No</label>
                    <input type="text" class="form-control" id="invoice_number" name="invoice_number" required>
                  </div>
                  <div class="form-group">
                    <label>Due Date</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" id="due_date" name="due_date" class="form-control pull-right datepicker">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Ship Date</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" id="ship_date" name="ship_date" class="form-control pull-right datepicker">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Currency</label>
                    <select class="form-control" id="currency" name="currency" required>
                      <option>-- Pilih --</option>
                      <option value="IDR">IDR</option>
                    </select>
                  </div>
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
                    <label>PPN 10%</label>
                    <input type="number" min="0" step="1" class="form-control" id="ppn" name="ppn" required>
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
                        <th><center>Unit Price</center></th>
                        <th width="80px"><center>Qty</center></th>
                        <th width="80px"><center>Disc %</center></th>
                        <th width="70px"><center>Tax</center></th>
                        <th><center>Amount</center></th>
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

  function del(kode) {
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
          window.location.href = "{{ url('hapus_transaksi') }}"+'/'+kode;
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
    var cell8 = row.insertCell(7);
    var cell9 = row.insertCell(8);

    // alert(rowCount);
    <?php $select = ''; ?>

    <?php foreach ($barang as $key): ?>
      <?php $select .="<option value='".$key->item."' data-desc = '".$key->desc."' data-satuan='".$key->satuan."' data-harga='".$key->unit_price."'>".$key->item."</option>"; ?>
    <?php endforeach ?>

    cell1.innerHTML = "<select onchange='OnSelectChange(this,"+rowCount+")' class='form-control' name='item[]' required><option>-- Pilih --</option><?php echo $select; ?></select>";
    cell2.innerHTML = "<textarea class='form-control' name='desc[]' id='desc"+rowCount+"' readonly></textarea>";
    cell3.innerHTML = "<input type='text' class='form-control' name='satuan[]' id='satuan"+rowCount+"' readonly>";
    cell4.innerHTML = "<input type='number' class='form-control' name='unit_price[]' id='unit_price"+rowCount+"' readonly>";
    cell5.innerHTML = "<input type='number' step='1' min='0' class='form-control' name='qty[]' id='qty"+rowCount+"' oninput='hitung("+rowCount+")' required>";
    cell6.innerHTML = "<input type='number' step='1' min='0' class='form-control' name='disc[]' required>";
    cell7.innerHTML = "<input type='text' class='form-control' name='tax[]' required>";
    cell8.innerHTML = "<input type='number' step='1' min='0' class='form-control' name='amount[]' id='amount"+rowCount+"' readonly>";
    cell9.innerHTML = "<button type='button' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></button>";
    cell9.onclick = function() {
      myDeleteFunction(this.parentNode.rowIndex);
    }
  }

  function OnSelectChange(event, id) {
      document.getElementById('desc'+id).value = event.selectedOptions[0].getAttribute('data-desc'); 
      document.getElementById('satuan'+id).value = event.selectedOptions[0].getAttribute('data-satuan');
      document.getElementById('unit_price'+id).value = event.selectedOptions[0].getAttribute('data-harga'); 
  }

  function hitung(id) {
    var unit_price = $('#unit_price'+id).val();
    var qty = $('#qty'+id).val();
    var result = unit_price * qty;

    $('#amount'+id).val(result);
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
    var cell8 = row.insertCell(7);
    var cell9 = row.insertCell(8);

    // alert(rowCount);
    <?php $select = ''; ?>

    <?php foreach ($barang as $key): ?>
      <?php $select .="<option value='".$key->item."' data-desc = '".$key->desc."' data-satuan='".$key->satuan."' data-harga='".$key->unit_price."'>".$key->item."</option>"; ?>
    <?php endforeach ?>

    cell1.innerHTML = "<select onchange='OnSelectChangeUpdate(this,"+rowCount+")' class='form-control' name='item[]' required><option>-- Pilih --</option><?php echo $select; ?></select>";
    cell2.innerHTML = "<textarea class='form-control' name='desc[]' id='desc"+rowCount+"' readonly></textarea>";
    cell3.innerHTML = "<input type='text' class='form-control' name='satuan[]' id='satuan"+rowCount+"' readonly>";
    cell4.innerHTML = "<input type='number' step='1' min='0' class='form-control' name='unit_price[]' id='unit_price"+rowCount+"' readonly>";
    cell5.innerHTML = "<input type='number' step='1' min='0' class='form-control' name='qty[]' id='qty"+rowCount+"' required oninput='hitungUpdate("+rowCount+")'>";
    cell6.innerHTML = "<input type='number' step='1' min='0' class='form-control' name='disc[]' required>";
    cell7.innerHTML = "<input type='text' class='form-control' name='tax[]' required>";
    cell8.innerHTML = "<input type='number' step='1' min='0' class='form-control' name='amount[]' id='amount"+rowCount+"' readonly>";
    cell9.innerHTML = "<button type='button' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></button>";
    cell9.onclick = function() {
      myDeleteFunctionUpdate(this.parentNode.rowIndex);
    }
  }

  function OnSelectChangeUpdate(event, id) {
      document.getElementById('desc'+id).value = event.selectedOptions[0].getAttribute('data-desc'); 
      document.getElementById('satuan'+id).value = event.selectedOptions[0].getAttribute('data-satuan'); 
      document.getElementById('unit_price'+id).value = event.selectedOptions[0].getAttribute('data-harga'); 
  }

  function OnSelectChangeUpdate2(event, id) {
      document.getElementById('desc'+id).value = event.selectedOptions[0].getAttribute('data-desc'); 
      document.getElementById('satuan'+id).value = event.selectedOptions[0].getAttribute('data-satuan'); 
      document.getElementById('unit_price'+id).value = event.selectedOptions[0].getAttribute('data-harga'); 
  }

  function hitungUpdate(id) {
    var unit_price = $('#unit_price'+id).val();
    var qty = $('#qty'+id).val();
    var result = unit_price * qty;

    $('#amount'+id).val(result);
  }

  function hitungUpdate2(x) {
    var unit_price = $('#unit_price'+x).val();
    var qty = $('#qty'+x).val();
    var result = unit_price * qty;

    $('#amount'+x).val(result);
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