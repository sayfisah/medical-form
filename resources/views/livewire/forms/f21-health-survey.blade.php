<div class="p-6 bg-white rounded-xl shadow-md" x-data>
    <h2 class="text-2xl font-bold">Health Survey <br />
        <span class="text-sm text-gray-500">SF-12-v2</span>
    </h2>

    <form wire:submit.prevent="submit" class="space-y-6 mt-6">

        {{-- Dialysis Centre --}}
        <x-form-input
            label="Pusat Dialisis"
            model="form.dialysis_centre"
            type="select"
            :options="[
                '' => '-- Select NKF Dialysis Centre --',
                'nkf_klang' => 'NKF Klang',
                'nkf_setapak' => 'NKF Setapak',
                'nkf_cheras' => 'NKF Cheras',
                'nkf_subang' => 'NKF Subang',
                'nkf_ipoh' => 'NKF Ipoh',
                'nkf_penang' => 'NKF Penang',
                'nkf_johor_bahru' => 'NKF Johor Bahru',
                'nkf_kota_bharu' => 'NKF Kota Bharu',
                'nkf_kuching' => 'NKF Kuching',
                'nkf_kota_kinabalu' => 'NKF Kota Kinabalu',
            ]"
        />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form-input label="Nama" model="form.name" />
            <x-form-input label="Tarikh" model="form.date" type="date" />
        </div>

        <div class="p-4 text-sm text-gray-800 rounded-lg bg-gray-50">
            Tinjauan ini bertujuan untuk mengetahui pandangan tentang tahap kesihatan anda.
            <b>Sila beri satu pilihan jawapan untuk setiap soalan.</b><br><br>
            <span class="label-translation">
                This survey aims to understand your views on your health status.
                <b>Please select one answer for each question.</b>
            </span>
        </div>

        {{-- Q1 --}}
        <x-form-table-radio
            label="1. Apakah pandangan anda mengenai tahap kesihatan anda secara umum? (In general, would you say your health is?)"
            model="form.healthLevel"
            :options="[
                'Hebat' => 'Hebat',
                'Sangat Bagus' => 'Sangat Bagus',
                'Bagus' => 'Bagus',
                'Baik' => 'Baik',
                'Teruk' => 'Teruk',
            ]"
        />

        {{-- Section Label for Q2–Q3 --}}
        <div class="p-4 text-sm text-gray-800 rounded-lg bg-gray-50">
            Soalan seterusnya adalah mengenai aktiviti yang anda lakukan pada hari biasa.
            Adakan kesihatan anda sekarang mengehadkan anda untuk melakukan aktiviti tersebut? Sekiranya ya, berapa banyak ?<br><br>
            <span class="label-translation">
                The next question is about activities you do on a typical day.
                Does your current health limit you in doing these activities? If yes, how much?
            </span>
        </div>

        {{-- Q2 --}}
        <x-form-table-radio
            label="2. Aktiviti sederhana seperti menggerakkan meja, menyapu, atau menolak penyedut hampas? (Moderate activity such as moving a table, sweeping, or pushing a vacuum cleaner)"
            model="form.limitAct2"
            :options="[
                'limited a lot' => 'Ya, sangat terhad',
                'limited a little' => 'Ya, sedikit terhad',
                'not limited at all' => 'Tidak terhad',
            ]"
        />

        {{-- Q3 --}}
        <x-form-table-radio
            label="3. Menaiki tangga (Climbing stairs)"
            model="form.limitAct3"
            :options="[
                'limited a lot' => 'Ya, sangat terhad',
                'limited a little' => 'Ya, sedikit terhad',
                'not limited at all' => 'Tidak terhad',
            ]"
        />

        {{-- Section Label for Q4–Q5 --}}
        <div class="p-4 text-sm text-gray-800 rounded-lg bg-gray-50">
            Sepanjang <b>4 minggu yang lepas</b>, adakah anda mempunyai sebarang masalah
            dalam melakukan kerja atau aktiviti harian disebabkan kesihatan fizikal anda?<br><br>
            <span class="label-translation">
                During the past 4 weeks, how much of the time have you had any of the following problems
                with your work or other regular daily activities as a result of your physical health?
            </span>
        </div>

        {{-- Q4 --}}
        <x-form-table-radio
            label="4. Mencapai kurang daripada apa yang anda inginkan. (Accomplish less than you would like.)"
            model="form.limitAct4"
            :options="[
                'All the time' => 'Sepanjang Masa',
                'Most of the time' => 'Kerap',
                'Some of the time' => 'Kadang-kala',
                'A little of the time' => 'Sesekali',
                'None of the time' => 'Tidak pernah',
            ]"
        />

        {{-- Q5 --}}
        <x-form-table-radio
            label="5. Terbatas dalam melakukan kerja atau aktiviti lain. (Were limited in the kind of work or other activities.)"
            model="form.limitAct5"
            :options="[
                'All the time' => 'Sepanjang Masa',
                'Most of the time' => 'Kerap',
                'Some of the time' => 'Kadang-kala',
                'A little of the time' => 'Sesekali',
                'None of the time' => 'Tidak pernah',
            ]"
        />

                {{-- Section Label for Q6–Q7 --}}
        <div class="p-4 text-sm text-gray-800 rounded-lg bg-gray-50">
Sepanjang 4 minggu yang lepas, adakah anda mempunyai sebarang masalah dalam melakukan kerja atau aktiviti harian disebabkan masalah emosi (seperti kemurungan atau rasa cemas)?<br><br>
            <span class="label-translation">
During the past 4 weeks, how much of the time have you had any of the following problems with your work or other regular daily activities as a result of any emotional problems (such as feeling depressed or anxious) ?
            </span>
        </div>

        {{-- Q6 --}}
        <x-form-table-radio
            label="6. Mencapai kurang daripada apa yang anda inginkan (masalah emosi). (Accomplish less than you would like due to emotional problems)"
            model="form.limitAct6"
            :options="[
                'All the time' => 'Sepanjang Masa',
                'Most of the time' => 'Kerap',
                'Some of the time' => 'Kadang-kala',
                'A little of the time' => 'Sesekali',
                'None of the time' => 'Tidak pernah',
            ]"
        />

        {{-- Q7 --}}
        <x-form-table-radio
            label="7. Kurang teliti dalam melakukan kerja (masalah emosi). (Did work or activities less carefully than usual due to emotional problems)"
            model="form.limitAct7"
            :options="[
                'All the time' => 'Sepanjang Masa',
                'Most of the time' => 'Kerap',
                'Some of the time' => 'Kadang-kala',
                'A little of the time' => 'Sesekali',
                'None of the time' => 'Tidak pernah',
            ]"
        />

        {{-- Q8 --}}
        <x-form-table-radio
            label="8. Berapa kerap rasa sakit mengganggu kerja anda? (How much did pain interfere with your normal work?)"
            model="form.limitAct8"
            :options="[
                'Not at all' => 'Tiada',
                'A little bit' => 'Sedikit',
                'Moderately' => 'Sederhana',
                'Quite a bit' => 'Banyak',
                'Extremely' => 'Sangat Banyak',
            ]"
        />


        {{-- Section Label for Q4–Q5 --}}
        <div class="p-4 text-sm text-gray-800 rounded-lg bg-gray-50">
Soalan di bawah adalah mengenai perasaan anda sepanjang 4 minggu lepas.
Untuk setiap soalan, sila berikan jawapan yang paling hampir dengan perasaan anda.
Berapa kerap sepanjang 4 minggu yang lepas.....<br><br>
            <span class="label-translation">
These questions are about how you feel and how things have been with you during the past 4 weeks.
For each question, please give the one answer that comes closest to the way you have been feeling.
How much of the time during the past 4 weeks.....
            </span>
        </div>

        {{-- Q9 --}}
        <x-form-table-radio
            label="9. Anda merasa tenang dan aman? (Have you felt calm and peaceful?)"
            model="form.q9"
            :options="[
                'All of the time' => 'Sepanjang Masa',
                'Most of the time' => 'Kerap',
                'Some of the time' => 'Kadang-kala',
                'A little of the time' => 'Sesekali',
                'None of the time' => 'Tidak pernah',
            ]"
        />

        {{-- Q10 --}}
        <x-form-table-radio
            label="10. Anda mempunyai tenaga yang banyak? (Did you have a lot of energy?)"
            model="form.q10"
            :options="[
                'All of the time' => 'Sepanjang Masa',
                'Most of the time' => 'Kerap',
                'Some of the time' => 'Kadang-kala',
                'A little of the time' => 'Sesekali',
                'None of the time' => 'Tidak pernah',
            ]"
        />

        {{-- Q11 --}}
        <x-form-table-radio
            label="11. Anda merasa sedih dan suram? (Have you felt downhearted and depressed?)"
            model="form.q11"
            :options="[
                'All of the time' => 'Sepanjang Masa',
                'Most of the time' => 'Kerap',
                'Some of the time' => 'Kadang-kala',
                'A little of the time' => 'Sesekali',
                'None of the time' => 'Tidak pernah',
            ]"
        />

        {{-- Q12 --}}
        <x-form-table-radio
            label="12. Berapa kerap kesihatan fizikal dan masalah emosi mengganggu aktiviti sosial anda? (How much of the time has your physical or emotional health interfered with your social activities?)"
            model="form.q12"
            :options="[
                'All of the time' => 'Sepanjang Masa',
                'Most of the time' => 'Kerap',
                'Some of the time' => 'Kadang-kala',
                'A little of the time' => 'Sesekali',
                'None of the time' => 'Tidak pernah',
            ]"
        />

        {{-- Submit --}}
        @if (!$isSubmitted)
            <div class="text-right">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                    Submit
                </button>
            </div>
        @else
            <div class="text-green-600 font-semibold">Form successfully submitted!</div>
        @endif

    </form>
</div>
