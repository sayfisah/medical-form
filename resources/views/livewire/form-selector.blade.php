<div x-data="formSelector()">
    <h2 class="text-xl font-bold mb-4">Medical & Dialysis Forms Selection</h2>

    <div>
        <select x-model="formName" class="form-control w-full rounded border px-4 py-2">
            <option value="">-- Select a Form --</option>
            <template x-for="(title, key) in forms" :key="key">
                <option :value="key" x-text="title"></option>
            </template>
        </select>
    </div>

    <!-- Custom validation message -->
    <p x-show="errorMessage" x-text="errorMessage" class="text-red-600 mt-2"></p>

    <div class="mt-4 text-center">
        <button @click="viewForm" class="btn btn-primary px-4 py-2 rounded">
            View Form
        </button>
    </div>
</div>

<script>
    function formSelector() {
        return {
            formName: '',
            errorMessage: '',
            forms: {
                'f1-apd-commence': 'APD Commencement Post-Test Form (HChoice)',
                'f2-apd-termination': 'APD Termination Post-Test Form (HChoice)',
                'f3-capd-fmc': 'CAPD Exchange Assessment (FMC)',
                'f4-capd-lucenxia': 'CAPD Exchange (Lucenxia/Baxter)',
                'f5-ckd-nursing-report': 'CKD Nursing Report Form',
                'f6-ckd-self-monitoring': 'CKD Self-Monitoring Referral Form',
                'f7-cpd-logbook': 'CPD Log Book (Chronic Peritoneal Dialysis)',
                'f8-daily-nursing-report': 'Daily Nursing Report (Peritoneal Dialysis)',
                'f9-emergency-trolley-checklist': 'Emergency Trolley Checklist',
                'f10-feedback-form': 'Feedback Form (Borang Maklumbalas)',
                'f11_hemodialysis_program_application': 'Hemodialysis Program Application Form',
                'f12-holiday-patient-application': 'Holiday Patient Application Form',
                'f13-incident-report-referral': 'Incident Report & Referral Letter',
                'f14-summary-medical-report': 'Medical Report Application Summary',
                'f15_peritoneal_dialysis_referral': 'Peritoneal Dialysis Referral Form',
                'f16_temporary_admission': 'Temporary Admission Form',
                'f17_troubleshooting_action_post_test': 'Troubleshooting & Action Post-Test Form',
                'f18-medical-equipment-loan': 'Medical Equipment Loan Form – CKD Clinic (NKF)',
                'f19_Assessed_MIS_Form': 'Comprehensive Malnutration Inflammation Score',
                'f20_LampiranC': 'Lampiran C',
                'f21-health-survey': 'Health Survey',
                'f22-welfare-records': 'Welfare Records',
                'f23-info-dis-consent-form' : 'Info DIS',

            },
            viewForm() {
                if (!this.formName) {
                    this.errorMessage = '⚠️ Please select a form before proceeding.';
                    return;
                }

                // Clear error message
                this.errorMessage = '';
                
                // Redirect to selected form
                window.location.href = `/form/${this.formName}`;
            }
        };
    }
</script>
