<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.tailwindcss.com" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<title>Document</title>
<style>/* Custom CSS */
.custom-body {
    display: grid;
    justify-items: start;
}

.custom-header {
    text-align: center;
    padding-top: 1.5rem;
    padding-bottom: 0.5rem;* Tailwind teal-600 */

}
.table1 {
    width: 100%;
    border-collapse: collapse;
}

.custom-thead {
    background-color: blue; /* Tailwind teal-600 */
    color: white;
}

.custom-th {
    padding: 0.75rem 1.5rem;
    text-align: center;
    font-size: 0.875rem; /* text-sm */
    font-weight: 500; /* font-medium */
}

.custom-tbody {
   
    color: #4a5568; /* Tailwind gray-700 */
}

.custom-tr {
    border-bottom: 1px solid #e2e8f0; /* Tailwind border-b */
}

.custom-td {
    padding: 1rem 1.5rem; /* px-6 py-4 */
}

.custom-tfoot {
    background-color: #f7fafc; /* Tailwind gray-100 */
}

.custom-th-footer {
    padding: 0.75rem 1.5rem;
    text-align: right;
    font-size: 0.875rem; /* text-sm */
    font-weight: 600; /* font-semibold */
}

.custom-td-footer {
    padding: 1rem 1.5rem; /* px-6 py-3 */
    font-size: 0.875rem; /* text-sm */
    font-weight: 600; /* font-semibold */
}

.custom-footer {
    margin-top: 2rem;
    text-align: center;
    padding-top: 1rem;
    padding-bottom: 1rem;
}
.custom-header img {
    width: 80px;
    height: 80px;
    margin-right: 1rem; /* Adds some space between the image and the text */
}
.custom-h3 {
    margin-top: 0;
    margin-bottom: 0;
}
.custom-h2 {
    margin-top: 0;
    margin-bottom: 0;
}

.custom-p {
    margin-top: 0;
    margin-bottom: 0;
}
.transaction-info {
    display: flex;
    justify-content: space-between; /* Pisahkan konten kiri dan kanan */
    align-items: center; /* Rata tengah secara vertikal */
    width: 100%; /* Lebar penuh */
}

.transaction-info .left {
    text-align: left; 
    position:absolute;/* Pastikan teks di kiri rata */
}

.transaction-info .right {
    text-align: right; /* Pastikan teks di kanan rata */
margin-bottom:-10px;/* Dorong elemen ini ke kanan */
}

.transaction-info p {
    margin: 0; /* Hilangkan margin default */
    padding: 0;
}

</style>
</head>
<body class="custom-body">
    <div class="custom-header">
    <img src="images/11.png" alt="Logo Apotek" class="w-20 h-20 ml-4" style="position:absolute;margin-left:50px;">
        <h3 class="custom-h3">APOTEK DAWA FAMILY</h3>
        <p class="custom-p">Jl.Citarum Lama, Haurwangi. Kab:Cianjur JawaBarat</p>
        <p class="custom-p">SIA:0220007351906</p>
        <p class="custom-p">SIPA:503/2089/SIPA/DPMPTSP/2020</p>
        <p class="custom-p">Laporan Transaksi</p>
    </div>
    <div class="transaction-info">
        @foreach($laporan as $lp)
    <p class="left">Kode Laporan = {{$lp->kode}}</p>
    @endforeach
    <p class="right">{{ $tanggal->format('d-M-Y') }}</p>
</div>


   <br>
    
    <table class="table1">
        <thead class="custom-thead">
            <tr class="text-center">
                <th class="custom-th">NO</th>
                <th class="custom-th">Kode</th>
                <th class="custom-th">Nama Obat</th>
                <th class="custom-th">Jumlah</th>
                <th class="custom-th">Total</th>
            </tr>
        </thead>
        <tbody class="custom-tbody">
            @php $no = 1; @endphp
            @foreach ($transaksi as $row)
                <tr class="custom-tr">
                    <td class="custom-td" style=" text-align: center;">{{ $no++ }}</td>
                    <td class="custom-td"  style=" text-align: center;">{{ $row->kode }}</td>
                    <td >{{ $row->produk->nama_produk }}</td>
                    <td class="custom-td"  style=" text-align: center;">{{ $row->jumlah }}</td>
                    <td class="custom-td"  style=" text-align: center;">RP. {{ number_format($row->total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot class="custom-tfoot">
            <tr>
                <th colspan="4" class="custom-th-footer">Total Keseluruhan</th>
                <td class="custom-td-footer">RP. {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>

