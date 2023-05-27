<?php

namespace app\Algoritma;

use App\Models\Guru;
use App\Models\Hari;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\Teach;
use App\Models\Waktu;
use App\Models\Waktunotavailable;
use Illuminate\Support\Facades\DB;

class GenerateAlgoritma
{


    public function randKromosom($kromosom, $count_teachs, $input_year, $input_semester)
    {
        // Jadwal::truncate();

        $data_waktu = Waktu::all();
        $data_hari = Hari::all();
        $data_kelas = Kelas::all();

        $jadwal = Jadwal::where('semester_id', $input_semester)
            ->where('tahun_ajaran_id', $input_year)->exists();
        if ($jadwal) {
            // return back();
        } else {
            // for ($i = 0; $i < $kromosom; $i++) {
            $values = [];
            foreach ($data_waktu as $waktu) {
                foreach ($data_hari as $hari) {
                    foreach ($data_kelas as $kelas) {
                        $guru   = Guru::inRandomOrder()->first();

                        // Mengecek guru sudah ada pada hari dan jam ini

                        $jadwal_s = Jadwal::where('semester_id', $input_semester)
                            ->where('tahun_ajaran_id', $input_year)
                            ->where('hari_id', $hari->id)
                            ->where('waktu_id', $waktu->id)
                            ->where('kelas_id', $kelas->id)
                            ->where('guru_id', $guru->id);


                        if ($jadwal_s->exists()) {
                            // total guru yang punya tugas mengajar di kelas dan di hari yang sama
                            $guru_count   = Jadwal::where('semester_id', $input_semester)
                                ->where('tahun_ajaran_id', $input_year)
                                ->where('hari_id', $hari->id)
                                ->where('kelas_id', $kelas->id)
                                ->where('guru_id', $guru->id)
                                ->count();

                            $selesai = false;
                            $counter = 0;
                            $ditemukan = false;
                            while (!$selesai && $counter < $guru_count) {
                                // cari guru lain pada waktu yg lain di kelas yg sama
                                $guru_id   = Jadwal::where('semester_id', $input_semester)
                                    ->where('tahun_ajaran_id', $input_year)
                                    ->where('hari_id', $hari->id)
                                    ->where('kelas_id', $kelas->id)
                                    ->where('guru_id', $guru->id)
                                    ->select('guru_id')
                                    ->inRandomOrder()->first();


                                // ditemukan
                                $bentrok = Jadwal::where('semester_id', $input_semester)
                                    ->where('tahun_ajaran_id', $input_year)
                                    ->where('waktu_id', $waktu->id)
                                    ->where('hari_id', $hari->id)
                                    ->where('kelas_id', $kelas->id)
                                    ->whereIn('guru_id', $guru_id)
                                    ->get();

                                if ($bentrok) {
                                } else {
                                    // simpan jadwal guru pada hari, jam dan kelas sekarang
                                    $params = [
                                        'tahun_ajaran_id' => $input_year,
                                        'semester_id' => $input_semester,
                                        'guru_id' => $guru_id,
                                        'mapel_id' => $guru->mapel_id,
                                        'hari_id'   => $hari->id,
                                        'waktu_id'  => $waktu->id,
                                        'kelas_id'  => $kelas->id,
                                        // 'type'      => $i + 1,
                                    ];

                                    $Jadwal = Jadwal::create($params);
                                }



                                // counter menambah
                                $counter++;
                            }
                            // jika tidak menemukan, hapus semua data guru yang ada di waktu kbm di kelas ini
                            if (!$ditemukan) {
                                # code...
                            }
                        } else {

                            // simpan jadwal guru pada hari, jam dan kelas sekarang
                            $params = [
                                'tahun_ajaran_id' => $input_year,
                                'semester_id' => $input_semester,
                                'guru_id' => $guru->id,
                                'mapel_id' => $guru->mapel_id,
                                'hari_id'   => $hari->id,
                                'waktu_id'  => $waktu->id,
                                'kelas_id'  => $kelas->id,
                                // 'type'      => $i + 1,
                            ];

                            $Jadwal = Jadwal::create($params);
                        }
                    }
                }
            }
            $data[] = $values;
            // }

            return $data;
        }
    }

    public function checkPinalty()
    {
        $Jadwals = Jadwal::select(DB::raw('guru_id, hari_id, waktu_id, type, count(*) as `jumlah`'))
            ->groupBy('guru_id')
            ->groupBy('hari_id')
            ->groupBy('waktu_id')
            ->groupBy('type')
            ->having('jumlah', '>', 1)
            ->get();

        $result_Jadwals = $this->increaseProccess($Jadwals);

        $Jadwals = Jadwal::select(DB::raw('guru_id, mapel_id, hari_id, kelas_id, type, count(*) as `jumlah`'))
            ->groupBy('guru_id')
            ->groupBy('mapel_id')
            ->groupBy('hari_id')
            ->groupBy('kelas_id')
            ->groupBy('type')
            ->having('jumlah', '>', 1)
            ->get();

        $result_Jadwals = $this->increaseProccess($Jadwals);

        $Jadwals = Jadwal::select(DB::raw('waktu_id, hari_id, kelas_id, type, count(*) as `jumlah`'))
            ->groupBy('waktu_id')
            ->groupBy('hari_id')
            ->groupBy('kelas_id')
            ->groupBy('type')
            ->having('jumlah', '>', 1)
            ->get();

        $result_Jadwals = $this->increaseProccess($Jadwals);

        // $Jadwals = Jadwal::join('teachs', 'teachs.id', '=', 'Jadwals.teachs_id')
        //     ->join('lecturers', 'lecturers.id', '=', 'teachs.lecturers_id')
        //     ->select(DB::raw('lecturers_id, hari_id, waktu_id, type, count(*) as `jumlah`'))
        //     ->groupBy('lecturers_id')
        //     ->groupBy('hari_id')
        //     ->groupBy('waktu_id')
        //     ->groupBy('type')
        //     ->having('jumlah', '>', 1)
        //     ->get();

        // $result_Jadwals = $this->increaseProccess($Jadwals);

        // $Jadwals = Jadwal::where('hari_id', Jadwal::FRIDAY)->whereIn('waktu_id', [8, 9, 10, 11, 12])->get();

        // if (!empty($Jadwals))
        // {
        //     foreach ($Jadwals as $key => $Jadwal) 
        //     {
        //         $Jadwal->value         = $Jadwal->value + 1;
        //         $Jadwal->value_process = $Jadwal->value_process . "+ 1 ";
        //         $Jadwal->save();
        //     }
        // }

        // $Waktu_not_availables = Waktunotavailable::get();

        // if (!empty($Waktu_not_availables))
        // {
        //     foreach ($Waktu_not_availables as $k => $Waktu_not_available)
        //     {
        //         $Jadwals = Jadwal::whereHas('teach', function ($query) use ($Waktu_not_available)
        //         {
        //             $query = $query->whereHas('lecturer', function ($q) use ($Waktu_not_available)
        //             {
        //                 $q->where('lecturers.id', $Waktu_not_available->lecturers_id);
        //             });
        //         });

        //         $Jadwals = $Jadwals->where('hari_id', $Waktu_not_available->hari_id)->where('waktu_id', $Waktu_not_available->waktu_id)->get();

        //         if (!empty($Jadwals))
        //         {
        //             foreach ($Jadwals as $key => $Jadwal)
        //             {
        //                 $Jadwal->value         = $Jadwal->value + 1;
        //                 $Jadwal->value_process = $Jadwal->value_process . "+ 1 ";
        //                 $Jadwal->save();
        //             }
        //         }

        //     }
        // }

        $Jadwals = Jadwal::get();

        foreach ($Jadwals as $key => $Jadwal) {
            $Jadwal->value = 1 / (1 + $Jadwal->value);
            $Jadwal->save();
        }

        return $Jadwals;
    }

    public function increaseProccess($Jadwals = '')
    {
        if (!empty($Jadwals)) {
            foreach ($Jadwals as $key => $Jadwal) {
                if ($Jadwal->jumlah > 1) {
                    $Jadwal_wheres = Jadwal::where('type', $Jadwal->type)->get();
                    foreach ($Jadwal_wheres as $key => $Jadwal_where) {
                        $Jadwal_where->value         = $Jadwal_where->value + ($Jadwal->jumlah - 1);
                        $Jadwal_where->value_process = $Jadwal_where->value_process . " + " . ($Jadwal->jumlah - 1);
                        $Jadwal_where->save();
                    }
                }
            }
        }
        return $Jadwals;
    }
}
