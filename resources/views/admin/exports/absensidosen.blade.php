<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Kode Matakuliah</th>
            <th>Nama Mata Kuliah</th>
            <th>NIDN Dosen</th>
            <th>Nama Dosen</th>
            <th>Kelas</th>
            <th>Total Kehadiran</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data_absensi as $key => $absensi)
        <tr>
            <td>{{++$key}}</td>
            <td>
                {{$absensi->mapel->kode_mapel ?? ''}}
            </td>
            <td>
                {{$absensi->mapel->nama_mapel ?? ''}}
            </td>
            <td>
                {{$absensi->dosen->nidn}}
            </td>
            <td>
                {{$absensi->dosen->nama_dosen ?? ''}}
            </td>
            <td>{{$absensi->kelas->nama_kelas ?? ''}}</td>
            <td>{{$absensi->total ?? '0'}}</td>

        </tr>
        @endforeach
    </tbody>
</table>