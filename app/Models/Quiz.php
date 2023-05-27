<?php
namespace App\Models;


use App\Models\JenisUjian;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Quiz extends Model
{
    protected $table ='quizzes';
    protected $fillable = ['mapel_id','id_prodi','id_semester','id_tahun_ajaran','kode_soal','judul_kuis','durasi','jumlah_soal','tanggal_mulai','tanggal_akhir','id_dosen','dibuat_oleh','jenisujian_id'];


    public function jenis_ujians()
    {
         return $this->belongsTo(JenisUjian::class, 'jenisujian_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class,'dibuat_oleh');
    }

    public function question()
    {
        return $this->hasMany(Question::class);
    }

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester', 'id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran', 'id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id');
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function answer()
    {
        return $this->hasMany(Answer::class);
    }

    public function gurus() //harus sama dengan table di database
    {
        return $this->belongsTo(Guru::class, 'dibuat_oleh');
    }


    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'quiz_kelas')->withTimestamps();
    }


    public function result_quizzes() //harus sama dengan table di database
    {
        return $this->hasMany(ResultQuiz::class, 'quiz_id');
    }

}
