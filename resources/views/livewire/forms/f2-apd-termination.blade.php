@push('form-css')
    <link rel="stylesheet" href="{{ asset('css/forms/f1.css') }}">
@endpush
<div class="p-4 max-w-5xl mx-auto" x-data="markCounter(@js($answers))">
<h1 style="text-align:center; font-size: 28px; font-weight: bold;">
  Termination of <span style="color:#0055A5;">“HomeChoice”</span> Automated PD Machine<br>
  <small style="font-size: 18px; font-weight: normal;">Post Test Form (Patient/Caregiver)</small>
</h1>
<br>
<hr>
<br>
<div id="form-top" class="p-4 max-w-5xl mx-auto" x-data="markCounter(@js($answers))">

    <form wire:submit.prevent="submit">

        @if (session()->has('message'))
             <div class="p-4 mb-4 text-sm text-white rounded-xl bg-emerald-500  font-normal no-print ">
                {{ session('message') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <x-form-input label="Name" model="name" placeholder="Enter full name" :disabled="$isSubmitted"/>
            <x-form-input label="NRIC" model="nric" placeholder="Enter NRIC number" :disabled="$isSubmitted"/>
            <x-form-input label="Date" model="date" type="date" :disabled="$isSubmitted"/>
        </div>



<table class="w-full text-sm border border-gray-300">
    <thead class="bg-gray-100">
        <tr>
            <th class="border px-2 py-1">No</th>
            <th class="border px-2 py-1" style="width:20px;">Activities</th>
            <th class="border px-2 py-1">Work Process</th>
            <th class="border px-2 py-1">Action</th>
            <th class="border px-2 py-1" style="width:200px;">Remark</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($questions as $qIndex => $question)
            @php $stepCount = count($question['steps']); @endphp
            @foreach ($question['steps'] as $sIndex => $step)
                <tr>
                    @if ($loop->first)
                        <td class="border px-2 py-1 text-center" rowspan="{{ $stepCount }}">
                            {{ $qIndex + 1 }}
                        </td>
                        <td class="border px-2 py-1" rowspan="{{ $stepCount }}">
                            {{ $question['text'] }}<br />
                            <span class="text-xs text-gray-600 block mt-1">
                                Mark: (<span x-text="questionYesCount({{ $qIndex }})"></span>/{{ $stepCount }})
                            </span>
                        </td>
                    @endif

                    <td class="border px-2 py-1">{!! $step !!}</td>
                    <td class="border px-2 py-1 text-center">
                        <div class="flex justify-center gap-2 items-center">
    <!-- Screen radio buttons (hidden when printing) -->
    <div class="print-hide flex gap-2">
        <label>
            <input
                type="radio"
                name="answers[{{ $qIndex }}][{{ $sIndex }}]"
                value="yes"
                x-model="answers[{{ $qIndex }}][{{ $sIndex }}]"
                wire:model.defer="answers.{{ $qIndex }}.{{ $sIndex }}"
                @if($isSubmitted) disabled @endif
            />
            Yes
        </label>
        <label>
            <input
                type="radio"
                name="answers[{{ $qIndex }}][{{ $sIndex }}]"
                value="no"
                x-model="answers[{{ $qIndex }}][{{ $sIndex }}]"
                wire:model.defer="answers.{{ $qIndex }}.{{ $sIndex }}"
                @if($isSubmitted) disabled @endif
            />
            No
        </label>
    </div>

    <!-- Print-only result -->
    <div class="print-show hidden">
        <span x-text="answers[{{ $qIndex }}][{{ $sIndex }}] ?? '-'"></span>
    </div>
</div>

                        @error("answers.$qIndex.$sIndex")
                            <span class="text-red-600 text-xs font-medium block mt-1">{{ $message }}</span>
                        @enderror
                    </td>

                    @if ($loop->first)
                        <td class="border px-2 py-1" rowspan="{{ $stepCount }}">
                            <textarea
                                class="w-full border px-1 py-0.5 rounded resize-y min-h-[60px]"
                                wire:model.defer="remarks.{{ $qIndex }}"
                                rows="10"
                                @if($isSubmitted) disabled @endif
                            ></textarea>
                            @error("remarks.$qIndex")
                                <span class="text-red-500 text-xs block mt-1">{{ $message }}</span>
                            @enderror
                        </td>
                    @endif
                </tr>
            @endforeach
        @endforeach

        <tr class="bg-gray-100 font-semibold">
            <td colspan="3" class="text-end border px-2 py-2">
                Total Marks
            </td>
            <td colspan="2" class="border px-2 py-2">
                <span x-text="totalYes()"></span> /
                <span x-text="totalSteps()"></span> (<span x-text="percentage()"></span>%)
            </td>
        </tr>
    </tbody>
</table>



<x-form-input label="Final Remark" name="final_remark" model="final_remark" type="textarea" :disabled="$isSubmitted"/>
<x-form-input label="Training By" name="training_by" model="training_by" :disabled="$isSubmitted"/>

<div class="mt-4 flex gap-2 justify-center items-center no-print">

    @if (!$isSubmitted)
        <button
            type="button"
            style="background-color:#ef4444; color:white; padding:8px 16px; border:none; border-radius:6px; cursor:pointer;"
            onclick="if(confirm('Cancel?')) { window.location.href = '/' }"
        >
            Cancel
        </button>
        <button
            type="submit"
            style="background-color:#16a34a; color:white; padding:8px 16px; border:none; border-radius:6px; cursor:pointer;"
        >
            Submit
        </button>
    @else
            <button
            type="button"
            onclick="window.location.href='/'"
            style="background-color:#4b5563; color:white; padding:8px 16px; border:none; border-radius:6px; cursor:pointer;"
        >
            Back to Home
        </button>
        <button 
            type="button" 
            onclick="window.print()" 
            style="background-color:#2563eb; color:white; padding:8px 16px; border:none; border-radius:6px; cursor:pointer;"
        >
            Print / Export to PDF
        </button>
    @endif
</div>





    </form>
</div>
</div>

<script>
    function markCounter(initialAnswers) {
        return {
            answers: initialAnswers,

            questionYesCount(qIndex) {
                return Object.values(this.answers[qIndex] ?? {}).filter(ans => ans === 'yes').length;
            },

            totalYes() {
                return Object.values(this.answers)
                    .flatMap(q => Object.values(q))
                    .filter(ans => ans === 'yes').length;
            },

            totalSteps() {
                return Object.values(this.answers)
                    .flatMap(q => Object.values(q))
                    .length;
            },

            percentage() {
                let total = this.totalSteps();
                return total ? Math.round((this.totalYes() / total) * 100) : 0;
            }
        }
    }


</script>
