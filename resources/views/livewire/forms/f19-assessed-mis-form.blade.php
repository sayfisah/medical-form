<div x-data="{
        total: 0,
        calculate() {
            this.total = 0;
            const fields = [
                'weight_change', 'dietary_intake', 'gi_symptoms',
                'functional_capacity', 'comorbidity',
                'fat_stores', 'muscle_wasting', 'bmi',
                'albumin', 'tibc'
            ];
            fields.forEach(field => {
                const el = $refs[field];
                if (!el) return;
                const selected = el.querySelector('input[type=radio]:checked');
                if (selected) this.total += parseInt(selected.value);
            });
        }
    }"
    x-init="calculate()"
    @change.window="calculate()"
    class="max-w-4xl mx-auto space-y-8 bg-white p-6 rounded-xl shadow-md"
>

    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
        Comprehensive Malnutrition Inflammation Score – Part A
    </h2>

    <!-- Question 1 -->
    <div x-ref="weight_change" class="p-4 border rounded-lg bg-gray-50">
        <p class="font-semibold mb-2">1. Change in dry weight (past 3–6 months):</p>
        <label class="block mb-1">
            <input type="radio" name="weight_change" value="0" wire:model="form.weight_change" class="mr-2"> No decrease in dry weight or weight loss or &lt;0.5 kg
        </label>
        <label class="block mb-1">
            <input type="radio" name="weight_change" value="1" wire:model="form.weight_change" class="mr-2"> Minor weight loss (0.5–1 kg)
        </label>
        <label class="block mb-1">
            <input type="radio" name="weight_change" value="2" wire:model="form.weight_change" class="mr-2"> Weight loss &gt;1 kg but &lt;5%
        </label>
        <label class="block">
            <input type="radio" name="weight_change" value="3" wire:model="form.weight_change" class="mr-2"> Weight loss &gt;5%
        </label>
    </div>

    <!-- Question 2 -->
    <div x-ref="dietary_intake" class="p-4 border rounded-lg bg-gray-50">
        <p class="font-semibold mb-2">2. Dietary intake:</p>
        <label class="block mb-1">
            <input type="radio" name="dietary_intake" value="0" wire:model="form.dietary_intake" class="mr-2"> Good appetite, no deterioration
        </label>
        <label class="block mb-1">
            <input type="radio" name="dietary_intake" value="1" wire:model="form.dietary_intake" class="mr-2"> Sub-optimal solid diet intake
        </label>
        <label class="block mb-1">
            <input type="radio" name="dietary_intake" value="2" wire:model="form.dietary_intake" class="mr-2"> Moderate decrease to full liquid
        </label>
        <label class="block">
            <input type="radio" name="dietary_intake" value="3" wire:model="form.dietary_intake" class="mr-2"> Hypo-caloric liquid to starvation
        </label>
    </div>

    <!-- Question 3 -->
    <div x-ref="gi_symptoms" class="p-4 border rounded-lg bg-gray-50">
        <p class="font-semibold mb-2">3. Gastrointestinal (GI) symptoms:</p>
        <label class="block mb-1">
            <input type="radio" name="gi_symptoms" value="0" wire:model="form.gi_symptoms" class="mr-2"> No symptoms, good appetite
        </label>
        <label class="block mb-1">
            <input type="radio" name="gi_symptoms" value="1" wire:model="form.gi_symptoms" class="mr-2"> Mild, poor appetite or nausea
        </label>
        <label class="block mb-1">
            <input type="radio" name="gi_symptoms" value="2" wire:model="form.gi_symptoms" class="mr-2"> Occasional vomiting / moderate
        </label>
        <label class="block">
            <input type="radio" name="gi_symptoms" value="3" wire:model="form.gi_symptoms" class="mr-2"> Frequent diarrhea/vomiting
        </label>
    </div>

    <!-- Question 4 -->
    <div x-ref="functional_capacity" class="p-4 border rounded-lg bg-gray-50">
        <p class="font-semibold mb-2">4. Functional capacity (nutritionally related impairment):</p>
        <label class="block mb-1">
            <input type="radio" name="functional_capacity" value="0" wire:model="form.functional_capacity" class="mr-2"> Normal, feeling fine
        </label>
        <label class="block mb-1">
            <input type="radio" name="functional_capacity" value="1" wire:model="form.functional_capacity" class="mr-2"> Tired frequently
        </label>
        <label class="block mb-1">
            <input type="radio" name="functional_capacity" value="2" wire:model="form.functional_capacity" class="mr-2"> Difficulty with independent activities
        </label>
        <label class="block">
            <input type="radio" name="functional_capacity" value="3" wire:model="form.functional_capacity" class="mr-2"> Bed/chair-ridden
        </label>
    </div>

    <!-- Question 5 -->
    <div x-ref="comorbidity" class="p-4 border rounded-lg bg-gray-50">
        <p class="font-semibold mb-2">5. Comorbidity and years on dialysis:</p>
        <label class="block mb-1">
            <input type="radio" name="comorbidity" value="0" wire:model="form.comorbidity" class="mr-2"> &lt;1 yr dialysis, healthy
        </label>
        <label class="block mb-1">
            <input type="radio" name="comorbidity" value="1" wire:model="form.comorbidity" class="mr-2"> 1–4 yrs, mild comorbidity
        </label>
        <label class="block mb-1">
            <input type="radio" name="comorbidity" value="2" wire:model="form.comorbidity" class="mr-2"> &gt;4 yrs, moderate comorbidity
        </label>
        <label class="block">
            <input type="radio" name="comorbidity" value="3" wire:model="form.comorbidity" class="mr-2"> Severe or multiple comorbidities
        </label>
    </div>

    <!-- Question 6 -->
    <div x-ref="fat_stores" class="p-4 border rounded-lg bg-gray-50">
        <p class="font-semibold mb-2">6. Decreased fat stores:</p>
        <label class="block mb-1">
            <input type="radio" name="fat_stores" value="0" wire:model="form.fat_stores" class="mr-2"> Normal
        </label>
        <label class="block mb-1">
            <input type="radio" name="fat_stores" value="1" wire:model="form.fat_stores" class="mr-2"> Mild
        </label>
        <label class="block mb-1">
            <input type="radio" name="fat_stores" value="2" wire:model="form.fat_stores" class="mr-2"> Moderate
        </label>
        <label class="block">
            <input type="radio" name="fat_stores" value="3" wire:model="form.fat_stores" class="mr-2"> Severe
        </label>
    </div>

    <!-- Question 7 -->
    <div x-ref="muscle_wasting" class="p-4 border rounded-lg bg-gray-50">
        <p class="font-semibold mb-2">7. Signs of muscle wasting:</p>
        <label class="block mb-1">
            <input type="radio" name="muscle_wasting" value="0" wire:model="form.muscle_wasting" class="mr-2"> Normal
        </label>
        <label class="block mb-1">
            <input type="radio" name="muscle_wasting" value="1" wire:model="form.muscle_wasting" class="mr-2"> Mild
        </label>
        <label class="block mb-1">
            <input type="radio" name="muscle_wasting" value="2" wire:model="form.muscle_wasting" class="mr-2"> Moderate
        </label>
        <label class="block">
            <input type="radio" name="muscle_wasting" value="3" wire:model="form.muscle_wasting" class="mr-2"> Severe
        </label>
    </div>

    <!-- Question 8 -->
    <div x-ref="bmi" class="p-4 border rounded-lg bg-gray-50">
        <p class="font-semibold mb-2">8. BMI (kg/m²):</p>
        <label class="block mb-1">
            <input type="radio" name="bmi" value="0" wire:model="form.bmi" class="mr-2"> ≥20
        </label>
        <label class="block mb-1">
            <input type="radio" name="bmi" value="1" wire:model="form.bmi" class="mr-2"> 18–19.99
        </label>
        <label class="block mb-1">
            <input type="radio" name="bmi" value="2" wire:model="form.bmi" class="mr-2"> 16–17.99
        </label>
        <label class="block">
            <input type="radio" name="bmi" value="3" wire:model="form.bmi" class="mr-2"> &lt;16
        </label>
    </div>

    <!-- Question 9 -->
    <div x-ref="albumin" class="p-4 border rounded-lg bg-gray-50">
        <p class="font-semibold mb-2">9. Albumin (g/dL):</p>
        <label class="block mb-1">
            <input type="radio" name="albumin" value="0" wire:model="form.albumin" class="mr-2"> ≥4.0
        </label>
        <label class="block mb-1">
            <input type="radio" name="albumin" value="1" wire:model="form.albumin" class="mr-2"> 3.5–3.9
        </label>
        <label class="block mb-1">
            <input type="radio" name="albumin" value="2" wire:model="form.albumin" class="mr-2"> 3.0–3.4
        </label>
        <label class="block">
            <input type="radio" name="albumin" value="3" wire:model="form.albumin" class="mr-2"> &lt;3.0
        </label>
    </div>

    <!-- Question 10 -->
    <div x-ref="tibc" class="p-4 border rounded-lg bg-gray-50">
        <p class="font-semibold mb-2">10. TIBC (μg/dL):</p>
        <label class="block mb-1">
            <input type="radio" name="tibc" value="0" wire:model="form.tibc" class="mr-2"> ≥250
        </label>
        <label class="block mb-1">
            <input type="radio" name="tibc" value="1" wire:model="form.tibc" class="mr-2"> 200–249
        </label>
        <label class="block mb-1">
            <input type="radio" name="tibc" value="2" wire:model="form.tibc" class="mr-2"> 150–199
        </label>
        <label class="block">
            <input type="radio" name="tibc" value="3" wire:model="form.tibc" class="mr-2"> &lt;150
        </label>
    </div>

    <!-- Total Score -->
    <div class="text-center mt-6 bg-blue-50 rounded-lg p-4 text-lg font-semibold text-blue-900 shadow">
        Total Score: <span x-text="total" class="text-2xl font-bold"></span>
    </div>

</div>
