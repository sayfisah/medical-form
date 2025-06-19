<?php

namespace App\Livewire;

use Livewire\Component;

class FormSelector extends Component
{
    public $formName = '';
    public $forms = [];

    public function mount()
    {
        $this->forms = [
            'f1-apd-commence' => 'APD Commencement Post-Test Form (HChoice)',
            'f2-apd-termination' => 'APD Termination Post-Test Form (HChoice)',
            'f3_capd_exchange_assessment_fmc' => 'CAPD Exchange Assessment (FMC)',
            'f4_capd_exchange_lucenxia_baxter' => 'CAPD Exchange (Lucenxia/Baxter)',
            'f5-ckd-nursing-report' => 'CKD Nursing Report Form',
            'f6_ckd_self_monitoring_referral_form' => 'CKD Self-Monitoring Referral Form',
            'f7_cpd_log_book' => 'CPD Log Book (Chronic Peritoneal Dialysis)',
            'f8_daily_nursing_report' => 'Daily Nursing Report (Peritoneal Dialysis)',
            'f9-emergency-trolley-checklist' => 'Emergency Trolley Checklist',
            'f10-feedback-form' => 'Feedback Form (Borang Maklumbalas)',
            'f11_hemodialysis_program_application' => 'Hemodialysis Program Application Form',
            'f12-holiday-patient-application' => 'Holiday Patient Application Form',
            'f13-incident-report-referral' => 'Incident Report & Referral Letter',
            'f14-summary-medical-report' => 'Medical Report Application Summary',
            'f15_peritoneal_dialysis_referral' => 'Peritoneal Dialysis Referral Form',
            'f16_temporary_admission' => 'Temporary Admission Form',
            'f17_troubleshooting_action_post_test' => 'Troubleshooting & Action Post-Test Form',
            'f18-medical-equipment-loan' => 'Medical Equipment Loan Form – CKD Clinic (NKF)',
            'f19-Assessed-Mis-Form' => 'Comprehensive Malnutration Inflammation Score',
            'f20_LampiranC' => 'Lampiran C',
        ];
    }

    public function viewForm()
    {
        if (!$this->formName) {
            $this->dispatch('form-error', 'Please select a form first.');
            return;
        }

        return redirect()->to("/form/" . $this->formName);
    }

    public function render()
    {
        return view('livewire.form-selector');
    }
}
