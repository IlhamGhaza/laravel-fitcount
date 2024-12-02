<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FitCount - Community</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400,500,700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
    <style>
        html{
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    <x-header />

    <div class="CommunityPage" style="width: 1440px; height: 2806px; position: relative; background: white">
        <div class="relative w-screen">
            <img class="w-full h-[558px] object-cover" src="{{ asset('images/image3.svg') }}" alt="komunitas" />
            <div class="absolute inset-0 bg-black/30"></div>
        </div>

        <div class="YukBergabungKeKomunitas"
            style="left: 344px; top: 687px; position: absolute; color: #384031; font-size: 48px; font-family: Poppins; font-weight: 700; word-wrap: break-word">
            Yuk Bergabung ke Komunitas!</div>
        <div class="Benefit"
            style="left: 344px; top: 909px; position: absolute; color: #384031; font-size: 48px; font-family: Poppins; font-weight: 700; word-wrap: break-word">
            Benefit</div>
        <div class="DapatkanInformasiUntukProgressBeratmu"
            style="width: 499px; left: 97px; top: 159px; position: absolute; color: white; font-size: 48px; font-family: Poppins; font-weight: 600; word-wrap: break-word">
            Dapatkan informasi untuk progress beratmu!</div>

        {{-- <div class="Frame29" style="width: 249px; height: 91px; left: 97px; top: 413px; position: absolute">
            <div class="Rectangle221"
                style="width: 249px; height: 60px; left: 0px; top: 15px; position: absolute; border-radius: 100px; border: 3px white solid">
            </div>x
            <div class="Bergabung"
                style="width: 112px; height: 27px; left: 69px; top: 32px; position: absolute; color: white; font-size: 20px; font-family: Poppins; font-weight: 400; word-wrap: break-word">
                Bergabung
            </div>
        </div> --}}
        <div class="Frame29" style="width: 249px; height: 91px; left: 97px; top: 413px; position: absolute">
            <a href="{{route('check.auth1') }}">
                <div class="Rectangle221"
                    style="width: 249px; height: 60px; left: 0px; top: 15px; position: absolute; border-radius: 100px; border: 3px white solid">
                </div>
                <div class="Bergabung"
                    style="width: 112px; height: 27px; left: 69px; top: 32px; position: absolute; color: white; font-size: 20px; font-family: Poppins; font-weight: 400; word-wrap: break-word">
                    Bergabung
                </div>
            </a>
        </div>


        <div class="TemukanArtikelDanInspirasiSetiapBulannyaDiEmailmu"
            style="left: 97px; top: 375px; position: absolute; color: white; font-size: 15px; font-family: Poppins; font-weight: 300; word-wrap: break-word">
            Temukan artikel dan inspirasi setiap bulannya di emailmu.</div>
        <div
            style="width: 753px; left: 344px; top: 779px; position: absolute; color: black; font-size: 20px; font-family: Poppins; font-weight: 500; word-wrap: break-word">
            Bergabunglah dengan komunitas FitCount untuk mendapatkan dukungan dan motivasi dalam perjalanan kesehatan
            Anda. Bersama-sama kita bisa mencapai tujuan kebugaran dan gaya hidup sehat yang lebih baik.</div>
        <div
            style="width: 753px; left: 344px; top: 996px; position: absolute; color: black; font-size: 20px; font-family: Poppins; font-weight: 500; word-wrap: break-word">
            Dapatkan akses eksklusif ke berbagai fitur menarik seperti tracking BMI, event kesehatan terkini, dan tools
            perencanaan aktivitas. Komunitas kami terdiri dari para profesional kesehatan dan sesama anggota yang siap
            berbagi pengalaman dan tips praktis untuk hidup sehat.</div>
        <div class="Rectangle226"
            style="width: 876px; height: 365px; left: 282px; top: 1291px; position: absolute; background: white; border-radius: 25px; border: 4px #385723 solid">
        </div>
        <div class="Rectangle227"
            style="width: 876px; height: 365px; left: 282px; top: 1696px; position: absolute; background: white; border-radius: 25px; border: 4px #385723 solid">
        </div>
        <div class="Rectangle228"
            style="width: 876px; height: 365px; left: 282px; top: 2101px; position: absolute; background: white; border-radius: 25px; border: 4px #385723 solid">
        </div>
        <div
            style="width: 504px; left: 322px; top: 1421px; position: absolute; color: black; font-size: 20px; font-family: Poppins; font-weight: 500; word-wrap: break-word">
            Pantau perkembangan BMI Anda dengan mudah dan teratur. Fitur pencatatan BMI kami membantu Anda memahami
            perubahan berat badan dan memberikan rekomendasi yang sesuai dengan kondisi tubuh Anda.</div>
        <div
            style="width: 504px; left: 322px; top: 1826px; position: absolute; color: black; font-size: 20px; font-family: Poppins; font-weight: 500; word-wrap: break-word">
            Jangan lewatkan berbagai event kesehatan menarik! Dari webinar nutrisi, workshop olahraga, hingga challenge
            kesehatan bulanan. Selalu update dengan informasi terbaru untuk mendukung gaya hidup sehat Anda.</div>
        <div
            style="width: 504px; left: 322px; top: 2231px; position: absolute; color: black; font-size: 20px; font-family: Poppins; font-weight: 500; word-wrap: break-word">
            Kelola rutinitas sehat Anda dengan To Do List yang praktis. Rencanakan jadwal olahraga, pengingat minum air,
            dan catat target kesehatan harian Anda dengan lebih terstruktur dan mudah diikuti.</div>
        <div class="Group14" style="width: 230.63px; height: 205px; left: 866px; top: 1371px; position: absolute">
            <div class="SubwayWrite" style="width: 205px; height: 205px; left: 0px; top: 0px; position: absolute">
                <div class="Vector"
                    style="width: 205px; height: 153.75px; left: 0px; top: 22.22px; position: absolute; background: #A5B987">
                </div>
            </div>

        </div>
        <div class="PencatatanHasilBmi"
            style="left: 322px; top: 1356px; position: absolute; color: #385723; font-size: 36px; font-family: Poppins; font-weight: 700; word-wrap: break-word">
            Pencatatan Hasil BMI</div>
        <div class="UpdateEventKesehatan"
            style="left: 322px; top: 1761px; position: absolute; color: #385723; font-size: 36px; font-family: Poppins; font-weight: 700; word-wrap: break-word">
            Update Event Kesehatan</div>
        <div class="ToDoList"
            style="left: 322px; top: 2166px; position: absolute; color: #385723; font-size: 36px; font-family: Poppins; font-weight: 700; word-wrap: break-word">
            To Do List</div>
        <div class="PhNewspaperClipping"
            style="width: 230px; height: 230px; left: 866px; top: 1764px; position: absolute">
            {{-- <div class="Vector"
                style="width: 186.88px; height: 165.31px; left: 21.56px; top: 35.94px; position: absolute; background: #A5B987">
            </div> --}}
        </div>
    </div>
    <x-footer />
</body>

</html>
