<div class="container" x-data>
    <form wire:submit.prevent="submit" class="space-y-6">
        <h2 class="text-xl font-bold">MEDICAL EQUIPMENT LOAN FORM</h2>

        <div class="space-y-4">
            <h3 class="text-lg font-semibold">PATIENT'S DETAILS</h3>

            <x-form-input label="Name" model="name" :disabled="$isSubmitted"/>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form-input label="IC Number/passport" model="nric" :disabled="$isSubmitted"/>
                <x-form-input label="Phone Number" model="phone" type="tel" :disabled="$isSubmitted"/>
            </div>

            <x-form-input label="Home Address" model="address" type="textarea" rows="3" :disabled="$isSubmitted"/>
            <x-form-input label="CKD Clinic" model="clinic" :disabled="$isSubmitted"/>
        </div>

        <hr class="border-gray-300" />

        <div class="space-y-4">
            <h3 class="text-lg font-semibold">MEDICAL EQUIPMENT INFORMATION</h3>

            <h4 class="font-medium">Blood Pressure Monitor Set:</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <x-form-input label="BP Machine" model="bp_machine" :disabled="$isSubmitted"/>
                <x-form-input label="Small Cuff" model="small_cuff" :disabled="$isSubmitted"/>
                <x-form-input label="Big Cuff" model="big_cuff" :disabled="$isSubmitted"/>
            </div>

            <h4 class="font-medium">Glucose Monitor Set:</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <x-form-input label="Glucometer" model="glucometer" :disabled="$isSubmitted"/>
                <x-form-input label="Lancing Pen" model="lancing_pen" :disabled="$isSubmitted"/>
                <x-form-input label="Lancet (Needle)" model="lancet" :disabled="$isSubmitted"/>
            </div>
        </div>

        <hr class="border-gray-300" />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form-input label="Loan Date" model="loan_date" type="date" :disabled="$isSubmitted"/>
            <x-form-input label="Return Date" model="return_date" type="date" :disabled="$isSubmitted"/>
        </div>

        <x-form-input label="Remarks" model="remarks" type="textarea" rows="3" />

        <div class="mt-6">
            <h3 class="text-lg font-semibold">DECLARATION</h3>
            <ul class="list-decimal pl-6 space-y-2 text-sm text-gray-700">
                <li>I will take proper care of this equipment.</li>
                <li>I will take responsibility for any damage or missing parts.</li>
                <li>I will return the equipment on the agreed date or upon request.</li>
            </ul>

            <div class="mt-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" wire:model="agree" :disabled="$isSubmitted" class="form-checkbox">
                    <span class="ml-2 text-sm">I have read and agree to the above declaration.</span>
                </label>
                @error('agree') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

        @if (session()->has('message'))
            <div class="mt-4 text-green-600 font-semibold">
                {{ session('message') }}
            </div>
        @endif
    </form>
</div>
