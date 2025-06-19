<div class="max-w-none mx-auto p-6 bg-white font-serif text-sm leading-normal"
    style="width: 210mm; min-height: 297mm; box-sizing: border-box;">

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-50 border border-green-400 text-green-800 rounded text-sm print:hidden">
            {{ session('message') }}
        </div>
    @endif

    <div class="text-center mb-6">
        <h1 class="text-lg font-bold uppercase tracking-wide leading-tight">
            INFORMED CONSENT FOR DISCLOSURE OF PERSONAL INFORMATION
        </h1>
    </div>

    <form wire:submit.prevent="submit">
        <div class="mb-6 text-sm leading-relaxed space-y-3">
            <p class="text-justify">
                In the course of providing haemodialysis treatment, National Kidney Foundation (NKF)
                collects information about you for the purposes of patient care and administration. This
                personal information includes identifying and health information about you.
            </p>
            <p class="text-justify">
                Information collected about patients is protected by privacy law. Access to and use and/or
                holding and use of this information is governed by the <em>Personal Data Protection Act (2010)</em>
                as well as legislation and regulations applicable within various Malaysia states.
            </p>
            <p class="text-justify">
                NKF requests your consent to the use or disclosure of your personal information by ticking
                and then initialling inside the relevant boxes below and by signing and dating the form at
                the end. If you do not consent to particular use, please do not tick and initial that item.
            </p>
        </div>

        <!-- Consent Section -->
        <div class="border-2 border-black p-4 mb-6">
            <!-- Table Header -->
            <div class="grid grid-cols-12 gap-2 font-bold border-b-2 border-black pb-2 mb-3">
                <div class="col-span-1 text-center text-sm">
                    <div>If agree,</div>
                    <div>(✓)</div>
                </div>
                <div class="col-span-2 text-center text-sm">Initial</div>
                <div class="col-span-9 text-sm">I give consent to National Kidney Foundation (NKF) to:</div>
            </div>

            <!-- Consent Items -->
            @foreach ([
                ['key' => 'disclose_outside', 'text' => 'Disclose my personal information outside NKF to enable appropriate health services to be provided to me including (but not limited to) specialist medical practitioners, general practitioners, allied health professionals, hospitals, pathology services, imaging services, my health fund and government agencies.'],
                ['key' => 'planning_development', 'text' => 'Use my personal information to assist in planning and development in relation to service delivery in clinics.'],
                ['key' => 'research_development', 'text' => 'Disclose my personal information, in anonymous form to entities other than NKF for research and development purposes relating to kidney disease, dialysis treatment and renal care.'],
                ['key' => 'training_education', 'text' => 'Use my personal information in training and education of medical, nursing and other allied health students and staff.'],
                ['key' => 'safety_quality', 'text' => 'Use my personal information in NKF safety and quality improvement initiatives.'],
                ['key' => 'renal_registry', 'text' => 'Disclose my personal information and in particular medical history and dialysis treatment history to the National Renal Registry (NRR).'],
                ['key' => 'internal_audit', 'text' => 'Use my personal information for internal audit purposes within NKF.'],
                ['key' => 'health_fund', 'text' => 'Disclose my personal information to my health fund upon receipt of a request from my health fund or upon my request.'],
                ['key' => 'educational_materials', 'text' => 'Use my personal information in order to provide me with educational materials and information about kidney disease, dialysis and related health matters.']
            ] as $item)
                <div class="grid grid-cols-12 gap-2 items-start py-2 border-b border-gray-300">
                    <div class="col-span-1 text-center pt-1">
                        <input type="checkbox" wire:model="consent_{{ $item['key'] }}" class="w-4 h-4 border-2 border-black">
                    </div>
                    <div class="col-span-2 px-1">
                        <x-form-input 
                            model="initial_{{ $item['key'] }}"
                            type="text"
                            class="w-full border-2 border-black h-8 text-center text-sm bg-white"
                        />
                    </div>
                    <div class="col-span-9 text-sm leading-relaxed text-justify pt-1">
                        {{ $item['text'] }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Restriction Section -->
        <div class="border-2 border-black p-4 mb-8">
            <p class="text-sm mb-4 font-bold">
                * Irrespective of any requests received, I direct you NOT to provide any personal information to:
            </p>

            <div class="mb-4">
                <div class="flex items-end mb-2">
                    <span class="text-sm font-semibold mr-3 min-w-fit">Name (and details):</span>
                    <x-form-input 
                        model="restriction_name"
                        type="text"
                        class="flex-1 border-b-2 border-black bg-transparent text-sm pb-1 min-h-8"
                    />
                </div>
                <div class="text-center text-xs italic text-gray-600">(name of person or organisation)</div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div class="flex items-end">
                    <span class="text-sm font-semibold mr-3 min-w-fit">Signature:</span>
                    <x-form-input 
                        model="restriction_signature"
                        type="text"
                        class="flex-1 border-b-2 border-black bg-transparent text-sm pb-1 min-h-8"
                    />
                </div>
                <div class="flex items-end">
                    <span class="text-sm font-semibold mr-3 min-w-fit">Date:</span>
                    <x-form-input 
                        model="restriction_date"
                        type="date"
                        class="flex-1 border-b-2 border-black bg-transparent text-sm pb-1 min-h-8"
                    />
                </div>
            </div>
        </div>

        <!-- Signature Sections -->
        <div class="space-y-8">
            <!-- Patient Signature -->
            <h3 class="font-bold text-base mb-4 text-center uppercase">
                Signature/Thumb Print of Patient
            </h3>
            <div class="grid grid-cols-2 gap-8">
                <div class="space-y-4">
                    <div class="border-1 border h-20 bg-white-50 flex items-center justify-center">
                        <x-form-input
                            model="patient_signature"
                            type="hidden"
                        />
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex items-end">
                        <span class="text-sm font-semibold mr-3 w-20">Name:</span>
                        <x-form-input
                            model="patient_name"
                            type="text"
                            class="flex-1 border-b-2 border-black bg-transparent text-sm pb-1 min-h-8"
                            error="patient_name"
                        />
                    </div>
                    <div class="flex items-end">
                        <span class="text-sm font-semibold mr-3 w-20">NRIC No:</span>
                        <x-form-input
                            model="patient_nric"
                            type="text"
                            class="flex-1 border-b-2 border-black bg-transparent text-sm pb-1 min-h-8"
                            error="patient_nric"
                        />
                    </div>
                    <div class="flex items-end">
                        <span class="text-sm font-semibold mr-3 w-20">Date & Time:</span>
                        <x-form-input
                            model="patient_date_time"
                            type="datetime-local"
                            class="flex-1 border-b-2 border-black bg-transparent text-sm pb-1 min-h-8"
                            error="patient_date_time"
                        />
                    </div>
                </div>
            </div>

            <!-- Witness Signature -->
            <h3 class="font-bold text-base mb-4 text-center uppercase">
                Signature/Thumb Print of Witness
            </h3>
            <div class="grid grid-cols-2 gap-8">
                <div class="space-y-4">
                    <div class="border-1 border h-20 bg-white-50 flex items-center justify-center">
                        <x-form-input 
                            model="witness_signature"
                            type="hidden"
                        />
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex items-end">
                        <span class="text-sm font-semibold mr-3 w-20">Name:</span>
                        <x-form-input 
                            model="witness_name"
                            type="text"
                            class="flex-1 border-b-2 border-black bg-transparent text-sm pb-1 min-h-8"
                        />
                    </div>
                    <div class="flex items-end">
                        <span class="text-sm font-semibold mr-3 w-20">NRIC No:</span>
                        <x-form-input 
                            model="witness_nric"
                            type="text"
                            class="flex-1 border-b-2 border-black bg-transparent text-sm pb-1 min-h-8"
                        />
                    </div>
                    <div class="flex items-end">
                        <span class="text-sm font-semibold mr-3 w-20">Date & Time:</span>
                        <x-form-input 
                            model="witness_date_time"
                            type="datetime-local"
                            class="flex-1 border-b-2 border-black bg-transparent text-sm pb-1 min-h-8"
                        />
                    </div>
                </div>
            </div>

            <!-- Physician Signature -->
            <h3 class="font-bold text-base mb-4 text-center uppercase">
                Signature of Physician
            </h3>
            <div class="grid grid-cols-2 gap-8">
                <div class="space-y-4">
                    <div class="border-1 border h-20 bg-white-50 flex items-center justify-center">
                        <x-form-input 
                            model="physician_signature"
                            type="hidden"
                        />
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex items-end">
                        <span class="text-sm font-semibold mr-3 w-20">Name:</span>
                        <x-form-input 
                            model="physician_name"
                            type="text"
                            class="flex-1 border-b-2 border-black bg-transparent text-sm pb-1 min-h-8"
                            error="physician_name"
                        />
                    </div>
                    <div class="flex items-end">
                        <span class="text-sm font-semibold mr-3 w-20">NRIC No:</span>
                        <x-form-input 
                            model="physician_nric"
                            type="text"
                            class="flex-1 border-b-2 border-black bg-transparent text-sm pb-1 min-h-8"
                            error="physician_nric"
                        />
                    </div>
                    <div class="flex items-end">
                        <span class="text-sm font-semibold mr-3 w-20">Date & Time:</span>
                        <x-form-input 
                            model="physician_date_time"
                            type="datetime-local"
                            class="flex-1 border-b-2 border-black bg-transparent text-sm pb-1 min-h-8"
                            error="physician_date_time"
                        />
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-8 print:hidden">
            <button type="button"
            class="px-3 py-2 mx-1 bg-blue-600 text-white rounded border-none cursor-pointer text-xs hover:bg-blue-700 print:hidden"
            onclick="window.print()">Print Form
        </button>
        </div>
    </form>
</div>
