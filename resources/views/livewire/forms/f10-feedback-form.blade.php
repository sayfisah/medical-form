@push('form-css')
<link rel="stylesheet" href="{{ asset('css/forms/f10.css') }}">
@endpush

<div x-data>
    <form wire:submit.prevent="submit" class="space-y-6 p-4 bg-white shadow rounded">
        <header class="text-2xl font-bold text-center">FEEDBACK FORM</header>

        @if (session()->has('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded no-print">
                {{ session('success') }}
            </div>
        @endif

        <div class="feedback-intro space-y-4">
<div class="bg-gray-100 border border-gray-300 rounded-md p-4 shadow-sm">
    <p class="text-sm text-gray-800 leading-relaxed">
        NKF Renal Education Centre berazam untuk memberi perkhidmatan yang berkualiti kepada pelanggan kami. 
        Kepuasan semua menjadi matlamat kami. Sudilah kiranya lapangkan sedikit masa dan tandakan dalam 
        petak-petak yang berkenaan dan seterusnya kembalikan kepada 
        <span class="font-semibold">Matron Noriah / SN Noraishah</span> secara terus 
        atau melalui alamat yang tertera di bawah untuk diproses.
    </p>
</div>


            <p class="font-semibold">
                Sila klik pada pilihan yang menggambarkan tahap kepuasan anda mengikut skala di bawah.
            </p>
        </div>

        @php
            $labels = [
                1 => 'Sangat tidak berpuas hati',
                2 => 'Tidak berpuas hati',
                3 => 'Kurang berpuas hati',
                4 => 'Agak berpuas hati',
                5 => 'Berpuas hati',
                6 => 'Sangat berpuas hati',
            ];
        @endphp

        <table class="likert-table w-full border-collapse">
            <thead>
                <tr>
                    <th class="border p-2 align-bottom">No</th>
                    <th class="border p-2 align-bottom">Soalan</th>
                    @for ($i = 1; $i <= 6; $i++)
                        <th class="border p-2 text-center font-semibold text-xs">
                            {{ $i }}<br><span class="font-normal">{{ $labels[$i] }}</span>
                        </th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $index => $question)
                    @php($qNum = $index + 1)
                    <tr>
                        <td class="border p-2 text-center">{{ $qNum }}</td>
                        <td class="border p-2">{{ $question }}</td>
                        @for ($i = 1; $i <= 6; $i++)
                            <td class="border p-2 text-center">
<label class="likert-label likert-radio-box-{{ $i }}">
    <input type="radio"
           wire:model.defer="form.responses.{{ $qNum }}"
           value="{{ $i }}" />
    <span>{{ $i }}</span>
</label>


                            </td>
                        @endfor
                    </tr>
                    @error("form.responses.$qNum")
                        <tr>
                            <td colspan="8" class="text-red-500 text-sm pl-2">{{ $message }}</td>
                        </tr>
                    @enderror
                @endforeach
            </tbody>
        </table>

        <div class="text-center no-print mt-4">
            @if (!$isSubmitted)
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded">Submit</button>
            @else
                <button type="button" onclick="window.print()" class="bg-blue-600 text-white px-6 py-2 rounded">Print / Export to PDF</button>
            @endif
        </div>
    </form>
</div>
