<?php

namespace App\Http\Controllers;

use App\Models\BmiRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BmiRecordController extends Controller
{
    // Method untuk menampilkan form BMI
    public function showForm()
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        $userData = null;

        // Jika pengguna sudah login, ambil data dari database
        if ($user) {
            $userData = [
                'gender' => $user->gender,
                'age' => $user->age,
                'height' => $user->height,
                'weight' => $user->weight,
            ];
        }

        // Kirim data user ke view untuk mengisi form secara otomatis
        return redirect(route('home') . '#bmi-section');
    }

    // Method untuk menghitung BMI
    public function calculate(Request $request)
    {
        // Validasi inputan user
        $request->validate([
            'weight' => 'required|numeric|min:1',
            'height' => 'required|numeric|min:1',
            'age' => 'required|numeric|min:1',
            'gender' => 'required|string',
            'activity_level' => 'required|string',
        ]);

        // Hitung BMI
        $heightInMeters = $request->height / 100; // Convert cm ke meter
        $bmiScore = $request->weight / ($heightInMeters * $heightInMeters);

        // Tentukan kategori BMI berdasarkan skor
        $bmiCategory = $this->getBmiCategory($bmiScore);

        // Jika pengguna login dan ingin menyimpan hasilnya
        $message = '';
        if (Auth::check()) {
            // Ambil data user yang sedang login
            $user = Auth::user();

            // Simpan hasil BMI ke dalam database
            BmiRecord::create([
                'user_id' => $user->id,
                'bmi_score' => round($bmiScore, 2),
                'bmi_category' => $bmiCategory,
            ]);

            // Pesan berhasil simpan
            $message = 'Hasil BMI Anda telah berhasil disimpan!';
        }

        // Kembalikan hasil BMI dan kategori ke view dengan pesan jika disimpan
        return view('bmi', compact('bmiScore', 'bmiCategory', 'message'));
    }

    // Menentukan kategori BMI
    private function getBmiCategory($bmiScore)
    {
        if ($bmiScore < 18.5) {
            return 'Underweight';
        } elseif ($bmiScore >= 18.5 && $bmiScore < 24.9) {
            return 'Normal weight';
        } elseif ($bmiScore >= 25 && $bmiScore < 29.9) {
            return 'Overweight';
        } else {
            return 'Obese';
        }
    }

    //get recomendation from hasil_bmi
    private function getRecommendation($age, $gender, $activityLevel, $bmiCategory)
    {
        $recommendation = '';

        // Rekomendasi berdasarkan kategori BMI
        switch ($bmiCategory) {
            case 'Underweight':
                $recommendation = 'Tingkatkan asupan kalori dengan makanan bernutrisi.';
                break;
            case 'Normal weight':
                $recommendation = 'Pertahankan pola makan sehat dan olahraga rutin.';
                break;
            case 'Overweight':
                $recommendation = 'Cobalah menyeimbangkan pola makan dan aktivitas fisik.';
                break;
            case 'Obese':
                $recommendation = 'Konsultasikan dengan ahli gizi untuk manajemen berat badan.';
                break;
        }

        // Tambahkan saran berdasarkan usia
        if ($age > 50) {
            $recommendation .= ' Perhatikan kesehatan tulang dengan kalsium dan olahraga ringan.';
        }

        // Tambahkan saran berdasarkan gender
        if ($gender === 'female' && $bmiCategory !== 'Normal weight') {
            $recommendation .= ' Pertimbangkan konsultasi terkait risiko kesehatan perempuan.';
        }

        // Tambahkan saran berdasarkan tingkat aktivitas
        switch ($activityLevel) {
            case 'low':
                $recommendation .= ' Tingkatkan aktivitas seperti berjalan kaki setiap hari.';
                break;
            case 'medium':
                $recommendation .= ' Pertahankan gaya hidup aktif Anda.';
                break;
            case 'high':
                $recommendation .= ' Luar biasa! Pastikan asupan kalori cukup untuk aktivitas Anda.';
                break;
        }

        return $recommendation;
    }
}
