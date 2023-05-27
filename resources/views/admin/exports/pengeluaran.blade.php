 <table>
    <thead>
        <tr>
            <td>Nomor Referensi</td>
            <td>Nama</td>
            <td>Deskripsi</td>
            <td>Jenis Biaya</td>
            <td>Tanggal</td>
            <td>Jumlah</td>
            <td>Transfer Via</td>
        </tr>
    </thead>
    <tbody>
        @isset($data_pengeluaran)
        @foreach ($data_pengeluaran as $key => $bills)
     <tr>
        <td>{{ $bills->nomor_referensi ?? '' }}</td>
        <td>
            {{ $bills->nama ?? '' }}
        </td>
        <td>
            {{ $bills->deskripsi ?? '' }}
        </td>
        <td>
            {{ $bills->jenis->nama ?? 'Belum ada' }}
        </td>
        <td>
            {{ $bills->tanggal ?? '' }}
        </td>
        <td>{{ number_format($bills->amount) ?? '' }}</td>
        <td>{{ $bills->transfer_via}}</td>
    </tr>
    @endforeach
    @endisset



</tbody>
</table>