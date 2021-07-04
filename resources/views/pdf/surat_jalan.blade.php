<!DOCTYPE html>
<html>
<head>
	<title>CETAK SURAT JALAN</title>
</head>
<body>
	<table style="width: 100%;border-bottom: 1px solid #000;">
		<tr>
			<td style="width: 56%;">
				<b style="font-size: 18px;">PT. PONDAN PANGAN MAKMUR INDONESIA</b><br>
				<span style="font-size: 14px;">Kaw. Ind JATAKE, Jl. Industri VII <br> Blok.M No. 12, Pasir Jaya, Jatiuwung, Kota Tangerang</span>
			</td>
			<td style="width: 5%;"></td>
			<td style="font-size: 35px;width: 39%;text-align: center;">
				Delivery Order
			</td>
		</tr>
	</table>
	<br>
	<table style="width: 100%;">
		<tr>
			<td style="width: 56%;vertical-align: top;">
				<table style="width: 100%;">
					<tr>
						<td style="width: 20%;vertical-align: top;">Bill To</td>
						<td style="width: 1%;vertical-align: top;">:</td>
						<td style="vertical-align: top;border-bottom: 1px solid #000;"><b>{{ $data->bill_to }}</b></td>
					</tr>
					<tr>
						<td style="vertical-align: top;">Ship</td>
						<td style="vertical-align: top;">:</td>
						<td style="vertical-align: top;">{{ $data->nama }}<br>{{ $data->alamat }}</td>
					</tr>
				</table>
			</td>
			<td style="width: 5%;"></td>
			<td style="width: 39%;vertical-align: top;">
				<table style="width: 100%;">
					<tr>
						<td style="width: 40%;">Delivery No</td>
						<td>: {{ $data->delivery_no }}</td>
					</tr>
					<tr>
						<td>PO. No.</td>
						<td>: {{ $data->po_no }}</td>
					</tr>
					<tr>
						<td>Delivery Date</td>
						<td>: {{ $data->delivery_date }}</td>
					</tr>
					<tr>
						<td>Ship Via</td>
						<td>: {{ $data->ship_via }}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br>
	<table style="width: 100%;" cellspacing="0" cellpadding="5">
		<tr>
			<td style="width: 5%;border-right: 1px solid #000; text-align: center;border-bottom: 1px solid #000;border-top: 1px solid #000;border-left: 1px solid #000;">No</td>
			<td style="border-right: 1px solid #000; text-align: center;width: 15%;border-bottom: 1px solid #000;border-top: 1px solid #000;">Item</td>
			<td style="border-right: 1px solid #000; text-align: center;border-bottom: 1px solid #000;border-top: 1px solid #000;">Item Description</td>
			<td style="border-right: 1px solid #000; text-align: center; width: 10%;border-bottom: 1px solid #000;border-top: 1px solid #000;">Qty</td>
			<td style="border-right: 1px solid #000; text-align: center; width: 10%;border-bottom: 1px solid #000;border-top: 1px solid #000;">Satuan</td>
			<td style="border-right: 1px solid #000; text-align: center; width: 15%;border-bottom: 1px solid #000;border-top: 1px solid #000;">Exp. Date</td>
			<td style="border-right: 1px solid #000; text-align: center;width: 20%;border-bottom: 1px solid #000;border-top: 1px solid #000;">Serial Number</td>
		</tr>
		@foreach($detail as $dt)
			<tr>
				<td style="border-right: 1px solid #000;border-left: 1px solid #000;text-align: center;">{{ $no++ }}</td>
				<td style="border-right: 1px solid #000;text-align: center;">{{ $dt->item }}</td>
				<td style="border-right: 1px solid #000;">{{ $dt->desc }}</td>
				<td style="border-right: 1px solid #000;text-align: center;">{{ $dt->qty }}</td>
				<td style="border-right: 1px solid #000;text-align: center;">{{ $dt->satuan }}</td>
				<td style="border-right: 1px solid #000;text-align: center;">{{ $dt->expired_date }}</td>
				<td style="border-right: 1px solid #000;">{{ $dt->serial_number }}</td>
			</tr>
		@endforeach
		<tr>
			<td colspan="2" style="border-top: 1px solid #000;"></td>
			<td style="border: 1px solid #000;"><center>Total Kuantitas</center></td>
			<td style="border: 1px solid #000;text-align: center;">{{ $total }}</td>
			<td colspan="3" style="border-top: 1px solid #000;"></td>
		</tr>
	</table>
	<br>
	<table style="width: 100%;" cellpadding="5">
		<tr>
			<td style="width: 20%;vertical-align: top;">Description</td>
			<td style="width: 80%;border: 1px solid #000;border-radius: 3px;vertical-align: top;">{{ $data->desc }}</td>
		</tr>
	</table>
	<br><br><br>
	<table style="width: 100%;" >
		<tr>
			<td style="width: 40%;">
				<table style="width: 100%;">
					<tr>
						<td width="100%">
							Approved By,
							<br><br><br><br><br>
							<hr>
							Date:
						</td>
						<td width="100%"></td>
					</tr>
				</table>
			</td>
			<td style="width: 40%;">
				<table style="width: 100%;">
					<tr>
						<td width="100%">
							Shipped By,
							<br><br><br><br><br>
							<hr>
							Date:
						</td>
						<td width="100%"></td>
					</tr>
				</table>
			</td>
			<td>
				<table style="width: 100%;">
					<tr>
						<td width="100%">
							Received By,
							<br><br><br><br><br>
							<hr>
							Date:
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>