<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body {
			font-size: 14px;
		}
	</style>
</head>
<body>
	<table style="width: 100%;">
		<tr>
			<td style="width: 56%;vertical-align: top;">
				<table style="width: 100%; border: 1px solid #000;border-radius: 3px;">
					<tr>
						<td style="border-bottom: 1px dashed #000;"><b>PT. PONDAN PANGAN MAKMUR INDONESIA</b></td>
					</tr>
					<tr>
						<td>Kaw. Ind JATAKE, Jl. Industri VII <br> Blok.M No. 12, Pasir Jaya, Jatiuwung, Kota Tangerang</td>
					</tr>
				</table>
				<table style="margin-top: 7px;width: 100%;">
					<tr>
						<td style="width: 20%;height: 45px;vertical-align: top;">Bill To</td>
						<td style="width: 1%; vertical-align: top;">:&nbsp;</td>
						<td style="width: 79%;vertical-align: top;border-top: 1px solid #000;border-right: 1px solid #000;border-left: 1px solid #000;border-radius: 3px 3px 0px 0px;">{{ $data->bill_to }}</td>
					</tr>
					<tr>
						<td style="height: 122px;vertical-align: top;">Ship To</td>
						<td style="vertical-align: top;">:&nbsp;</td>
						<td style="height: 122px;vertical-align: top;border-bottom: 1px solid #000;border-right: 1px solid #000;border-left: 1px solid #000;border-top: 1px dashed #000;border-radius: 0px 0px 3px 3px;">{{ $data->nama }} <br> {{ $data->alamat }}</td>
					</tr>
				</table>
			</td>
			<td style="width: 1%;"></td>
			<td style="width: 43%; vertical-align: top;">
				<table style="width: 100%;">
					<tr>
						<td><center><span style="font-size: 40px;"><b>Sales Invoice</b></span></center></td>
					</tr>
					<tr>
						<td>
							<table style="width: 100%;border: 1px solid #000;border-radius: 3px;">
								<tr>
									<td style="border-right: 1px dashed #000;">Invoice Date</td>
									<td>Invoice No.</td>
								</tr>
								<tr>
									<td style="border-right: 1px dashed #000; border-bottom: 1px dashed #000;"><center>{{ $data->invoice_date }}</center></td>
									<td style="border-bottom: 1px dashed #000;"><center>{{ $data->kode }}</center></td>
								</tr>
								<tr>
									<td style="border-right: 1px dashed #000; ">Terms</td>
									<td>Due Date</td>
								</tr>
								<tr>
									<td style="border-right: 1px dashed #000; border-bottom: 1px dashed #000;"><center>{{ $data->terms }}</center></td>
									<td style="border-bottom: 1px dashed #000;"><center>{{ $data->due_date }}</center></td>
								</tr>
								<tr>
									<td style="border-right: 1px dashed #000; ">Ship Via</td>
									<td>Ship Date</td>
								</tr>
								<tr>
									<td style="border-right: 1px dashed #000; border-bottom: 1px dashed #000;"><center>{{ $data->ship_via }}</center></td>
									<td style="border-bottom: 1px dashed #000;"><center>{{ $data->ship_date }}</center></td>
								</tr>
								<tr>
									<td style="border-right: 1px dashed #000; ">PO. No.</td>
									<td>Currency</td>
								</tr>
								<tr>
									<td style="border-right: 1px dashed #000; border-bottom: 1px dashed #000;"><center>{{ $data->po_no }}</center></td>
									<td style="border-bottom: 1px dashed #000;"><center>{{ $data->currency }}</center></td>
								</tr>
								<tr>
									<td>No. Faktur Pjk</td>
									<td>{{ $data->no_faktur }}</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table style="width: 100%;border: 1px solid #000;" cellspacing="0">
		<tr>
			<td style="border: 1px solid #000;"><center>No</center></td>
			<td style="border: 1px solid #000;"><center>Item</center></td>
			<td style="border: 1px solid #000;"><center>Item&nbsp;Description</center></td>
			<td style="border: 1px solid #000;"><center>Qty</center></td>
			<td style="border: 1px solid #000;"><center>Satuan</center></td>
			<td style="border: 1px solid #000;"><center>Unit&nbsp;Price</center></td>
			<td style="border: 1px solid #000;"><center>Disc&nbsp;%</center></td>
			<td style="border: 1px solid #000;"><center>Tax</center></td>
			<td style="border: 1px solid #000;"><center>Amount</center></td>
		</tr>
		@foreach($detail as $d)
			<tr>
				<td style="border-right: 1px solid #000; text-align: center;">{{ $no++ }}</td>
				<td style="border-right: 1px solid #000;">{{ $d->item_barang }}</td>
				<td style="border-right: 1px solid #000;">{{ $d->desc }}</td>
				<td style="border-right: 1px solid #000; text-align: center;">{{ $d->qty }}</td>
				<td style="border-right: 1px solid #000; text-align: center;">{{ $d->satuan }}</td>
				<td style="border-right: 1px solid #000; text-align: right;">{{ $d->unit_price }}</td>
				<td style="border-right: 1px solid #000; text-align: center;">{{ $d->disc }}</td>
				<td style="border-right: 1px solid #000;">{{ $d->tax }}</td>
				<td style="border-right: 1px solid #000; text-align: right;">{{ number_format($d->amount) }}</td>
			</tr>
		@endforeach
	</table>
	<table width="100%">
		<tr>
			<td style="width: 70%;vertical-align: top;">
				<table style="width: 100%;">
					<tr style="vertical-align: top;">
						<td style="width: 10%;height: 50px;">Say&nbsp;:</td>
						<td style="border: 1px solid #000; width: 90%;border-radius: 3px;">&nbsp;</td>
					</tr>
				</table>
			</td>
			<td style="width: 1%;">&nbsp;</td>
			<td style="width: 29%;">
				<table style="width: 100%; border: 1px solid #000;border-radius: 3px;">
					<tr>
						<td style="border-bottom: 1px solid #000;width: 80px;">Sub Total</td>
						<td style="border-bottom: 1px solid #000;">:</td>
						<td style="border-bottom: 1px solid #000; text-align: right;">{{ number_format($subtotal) }}</td>
					</tr>
					<tr>
						<td>Disc</td>
						<td>:</td>
						<td style="text-align: right;">{{ number_format($disc) }}</td>
					</tr>
				</table>
				<table style="width: 100%; border: 1px solid #000;border-radius: 3px; margin-top: 5px;">
					<tr>
						<td style="border-bottom: 1px solid #000;width: 80px;">Tot Sub Diskon</td>
						<td style="border-bottom: 1px solid #000;">:</td>
						<td style="border-bottom: 1px solid #000; text-align: right;">{{ number_format($totsubdisc) }}</td>
					</tr>
					<tr>
						<td>PPN 10%</td>
						<td>:</td>
						<td style="text-align: right;"> {{ number_format($data->ppn) }}</td>
					</tr>
				</table>
				<table style="width: 100%; border: 1px solid #000;border-radius: 3px; margin-top: 5px;">
					<tr>
						<td style="width: 80px;">Freight</td>
						<td>:</td>
						<td style="text-align: right;"></td>
					</tr>
				</table>
				<table style="width: 100%; border: 1px solid #000;border-radius: 3px; margin-top: 5px;">
					<tr>
						<td style="width: 80px;"><b>Total Invoice</b></td>
						<td>:</td>
						<td style="text-align: right;">{{ number_format($totsubdisc) }}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	<br><br><br>

	<table style="width: 100%;">
		<tr>
			<td>
				<table style="width: 100%">
					<tr>
						<td style="width: 30%;">Approved By,</td>
						<td style="width: 70%;"><center><b>( Ricky Widjaja ) <br> Direktur</b></center></td>
					</tr>
				</table>
			</td>
			<td>
				<table style="width: 100%; ">
					<tr>
						<td style="width: 2px;">- </td>
						<td>Cantumkan nomor invoice yang dibayar dalam berita transfer</td>
					</tr>
					<tr>
						<td>- </td>
						<td>Transfer ke BCA an. PT. Pondan Pangan Makmur Indonesia</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>