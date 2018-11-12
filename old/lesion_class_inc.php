<?php

require_once 'DataBaseMysql.class.php';

Class Lesion {

	private $_k_lesion; //int(10)
	private $_k_procedure; //int(7)
	private $PreviousAttempt; //int(2)
	private $PreviousBiopsy; //int(2)
	private $PreviousSPOT; //int(2)
	private $Size; //int(4)
	private $Location; //int(2)
	private $Paris; //int(2)
	private $Morphology; //int(2)
	private $HighestKudo; //int(2)
	private $HighestSano; //int(2)
	private $Predict_Cancer; //int(2)
	private $Predict_Histo; //tinyint(2)
	private $Predict_Histo_Confidence; //tinyint(2)
	private $Feat_Invasion; //int(2)
	private $EnBloc; //int(2)
	private $Access; //int(2)
	private $EMRAttempted; //int(2)
	private $SMInjection; //int(2)
	private $Constituent; //int(2)
	private $Constituent_other; //tinyint(2)
	private $Adrenaline; //int(2)
	private $Dye; //int(2)
	private $No_Injection; //int(2)
	private $Lifting; //int(2)
	private $SnareType; //int(2)
	private $SnareSize; //int(2)
	private $Current; //int(2)
	private $No_Pieces; //int(2)
	private $SnareExcision; //int(2)
	private $AddModality; //int(2)
	private $SuccessfulEMR; //int(2)
	private $STSC_Margin; //tinyint(2)
	private $SCAR_complete; //int(2)
	private $BookTwoStage; //int(2)
	private $IPBleed; //int(2)
	private $IPBleed_Control; //int(2)
	private $SMF; //int(2)
	private $DeepInjury; //tinyint(2)
	private $IPPerforation; //int(2)
	private $IPPerforation_Rx; //int(2)
	private $Defect_Clip_Closure; //tinyint(3)
	private $Defect_Clip_Closure_Number; //int(2)
	private $Duration; //int(5)
	private $HistoPathMajor; //int(2)
	private $Cancer; //int(2)
	private $Dysplasia; //int(2)
	private $SMInvasion; //int(2)
	private $Margins; //int(2)
	private $SpecimenSize; //int(2)
	private $DelayedBleed; //int(2)
	private $DelayedBleed_Admit; //int(2)
	private $DelayedBleed_Colon; //int(2)
	private $DelayedPerforation; //int(2)
	private $DelayedPerforation_Rx; //int(2)
	private $Disposition2Weeks; //int(2)
	private $FollowUp2Weeks; //int(2)
	private $SurgReferral; //int(2)
	private $FirstFU; //int(2)
	private $FirstFUMonths; //tinyint(4)
	private $FirstFUDate; //date
	private $FirstFURecurrence; //tinyint(4)
	private $FirstFUNoRecurScarBx; //tinyint(3)
	private $FirstFURecurrenceSites; //tinyint(4)
	private $FirstFURecurrenceLocation; //tinyint(4)
	private $FirstFURecurrenceLargest; //tinyint(4)
	private $FirstFURecurrenceRx; //tinyint(4)
	private $FirstFURecurrenceExcision; //tinyint(4)
	private $FirstFURecurrenceNotes; //varchar(80)
	private $FirstFURecurHisto; //int(2)
	private $FirstFURecurHistoDysplasia; //int(2)
	private $FirstFUNextColon_Mths; //int(2)
	private $FirstFUOutcome; //int(2)
	private $FirstFUDisposition; //int(2)
	private $FirstFUSurgery; //tinyint(3)
	private $FirstFUSurgeryMethod; //int(2)
	private $FirstFUSurgeryResidual; //int(2)
	private $FirstFUSurgeryType; //int(2)
	private $FirstFUSurgeryNotes; //varchar(80)
	private $SecondFU; //tinyint(3)
	private $SecondFUMonths; //int(3)
	private $SecondFUDate; //date
	private $SecondFURecurrence; //int(3)
	private $SecondFUNoRecurScarBx; //int(2)
	private $SecondFURecurrenceLargest; //int(2)
	private $SecondFURecurrenceLocation; //int(2)
	private $SecondFURecurrenceSites; //int(2)
	private $SecondFUDisposition; //int(2)
	private $SecondFURecurrenceRx; //tinyint(3)
	private $SecondFURecurrenceExcision; //tinyint(3)
	private $SecondFURecurrenceNotes; //varchar(80)
	private $SecondFURecurHistoDysplasia; //tinyint(3)
	private $SecondFUNextColon_Mths; //tinyint(3)
	private $SecondFUOutcome; //tinyint(3)
	private $SecondFUSurgery; //int(2)
	private $SecondFUSurgeryNotes; //varchar(80)
	private $SecondFURecurHisto; //int(2)
	private $SecondFUSurgeryMethod; //int(2)
	private $SecondFUSurgeryResidual; //int(2)
	private $SecondFUSurgeryType; //int(2)
	private $ThirdFU; //int(2)
	private $ThirdFUDate; //date
	private $ThirdFUMonths; //tinyint(3)
	private $ThirdFUDisposition; //int(2)
	private $ThirdFUNoRecurScarBx; //int(2)
	private $ThirdFUOutcome; //int(2)
	private $ThirdFUPostSurgery; //int(2)
	private $ThirdFURecurHisto; //int(2)
	private $ThirdFURecurrence; //int(2)
	private $ThirdFURecurrenceExcision; //int(2)
	private $ThirdFURecurrenceRx; //int(2)
	private $ThirdFURecurrenceSites; //int(2)
	private $ThirdFURecurrenceLocation; //tinyint(3)
	private $ThirdFURecurrenceLargest; //tinyint(3)
	private $ThirdFURecurrenceNotes; //varchar(80)
	private $ThirdFURecurHistoDysplasia; //tinyint(3)
	private $ThirdFUNextColon_Mths; //tinyint(3)
	private $ThirdFUSurgeryNotes; //varchar(80)
	private $ThirdFUSurgeryMethod; //int(2)
	private $ThirdFUSurgeryResidual; //int(2)
	private $ThirdFUSurgeryType; //int(2)
	private $FourthFU; //int(2)
	private $FourthFUMonths; //tinyint(3)
	private $FourthFURecurrenceLocation; //tinyint(3)
	private $FourthFURecurrenceLargest; //tinyint(3)
	private $FourthFURecurrenceNotes; //varchar(80)
	private $FourthFURecurHistoDysplasia; //tinyint(3)
	private $FourthFUNextColon_Mnths; //tinyint(3)
	private $FourthFUSurgeryResidual; //tinyint(3)
	private $FourthFUDate; //date
	private $FourthFUDisposition; //int(2)
	private $FourthFUNoRecurScarBx; //int(2)
	private $FourthFUOutcome; //int(2)
	private $FourthFUPostSurgery; //int(2)
	private $FourthFURecurHisto; //int(2)
	private $FourthFURecurrence; //int(2)
	private $FourthFURecurrenceExcision; //int(2)
	private $FourthFURecurrenceRx; //int(2)
	private $FourthFURecurrenceSites; //int(2)
	private $FourthFUSurgeryMethod; //int(2)
	private $FourthFUSurgeryNotes; //int(2)
	private $FourthFUSurgeryType; //int(2)
	private $ClinSignificantBleedYN; //int(2)
	private $ClinSignificantPerfYN; //int(2)
	private $SSACharact_Dysplasia; //int(2)
	private $SSACharact_Dysplasia_Confidence; //tinyint(2)
	private $IPPerforation_Clips; //int(2)
	private $NICE_Overall; //int(2)
	private $FirstFURecurrenceClipArtifact; //int(2)
	private $SecondFURecurrenceClipArtifact; //int(2)
	private $ThirdFURecurrenceClipArtifact; //int(2)
	private $FourthFURecurrenceClipArtifact; //int(2)
	private $ESD_enBloc; //int(10)
	private $SERT_size; //int(2)
	private $SERT_ipb; //int(2)
	private $SERT_dysplasia; //int(2)
	private $created; //timestamp
	private $creating_user; //int(10)
	private $updated; //timestamp(6)
	private $updating_user; //int(10)
	private $entrytype; //int(2)
	private $save; //int(10)
	private $consent_PROSPER; //int(2)
	private $inPROSPER; //int(2)
	private $SERT; //int(2)
	private $completeColon_PROSPER; //int(3)
	private $defectTattoo_PROSPER; //int(3)
	private $dateEnrolled_PROSPER; //date
	private $variation_PROSPER; //varchar(8000)
	private $CLIP_consent; //int(2)
	private $CLIP_preEMRexclusion; //varchar(100)
	private $CLIP_postEMRexclusion; //varchar(100)
	private $CLIP_randomisation; //int(2)
	private $CLIP_category; //int(2)
	private $CLIP_active_closure_complete; //int(2)
	private $CLIP_active_closure_number; //int(2)
	private $CLIP_no_closure_reason; //varchar(80)
	private $CLIP_doppler; //int(2)
	private $CLIP_doppler_signal; //int(2)
	private $CLIP_doppler_signal_location; //int(2)
	private $CLIP_doppler_signal_area_clipped; //int(2)
	private $CLIP_notes; //varchar(8000)
	private $SMSA; //int(3)
	private $preLesionID; //int(20)
	private $connection;

	public function Lesion(){
		$this->connection = new DataBaseMysql();
	}

    /**
     * New object to the class. Don¥t forget to save this new object "as new" by using the function $class->Save_Active_Row_as_New(); 
     *
     */
	public function New_Lesion($_k_procedure,$PreviousAttempt,$PreviousBiopsy,$PreviousSPOT,$Size,$Location,$Paris,$Morphology,$HighestKudo,$HighestSano,$Predict_Cancer,$Predict_Histo,$Predict_Histo_Confidence,$Feat_Invasion,$EnBloc,$Access,$EMRAttempted,$SMInjection,$Constituent,$Constituent_other,$Adrenaline,$Dye,$No_Injection,$Lifting,$SnareType,$SnareSize,$Current,$No_Pieces,$SnareExcision,$AddModality,$SuccessfulEMR,$STSC_Margin,$SCAR_complete,$BookTwoStage,$IPBleed,$IPBleed_Control,$SMF,$DeepInjury,$IPPerforation,$IPPerforation_Rx,$Defect_Clip_Closure,$Defect_Clip_Closure_Number,$Duration,$HistoPathMajor,$Cancer,$Dysplasia,$SMInvasion,$Margins,$SpecimenSize,$DelayedBleed,$DelayedBleed_Admit,$DelayedBleed_Colon,$DelayedPerforation,$DelayedPerforation_Rx,$Disposition2Weeks,$FollowUp2Weeks,$SurgReferral,$FirstFU,$FirstFUMonths,$FirstFUDate,$FirstFURecurrence,$FirstFUNoRecurScarBx,$FirstFURecurrenceSites,$FirstFURecurrenceLocation,$FirstFURecurrenceLargest,$FirstFURecurrenceRx,$FirstFURecurrenceExcision,$FirstFURecurrenceNotes,$FirstFURecurHisto,$FirstFURecurHistoDysplasia,$FirstFUNextColon_Mths,$FirstFUOutcome,$FirstFUDisposition,$FirstFUSurgery,$FirstFUSurgeryMethod,$FirstFUSurgeryResidual,$FirstFUSurgeryType,$FirstFUSurgeryNotes,$SecondFU,$SecondFUMonths,$SecondFUDate,$SecondFURecurrence,$SecondFUNoRecurScarBx,$SecondFURecurrenceLargest,$SecondFURecurrenceLocation,$SecondFURecurrenceSites,$SecondFUDisposition,$SecondFURecurrenceRx,$SecondFURecurrenceExcision,$SecondFURecurrenceNotes,$SecondFURecurHistoDysplasia,$SecondFUNextColon_Mths,$SecondFUOutcome,$SecondFUSurgery,$SecondFUSurgeryNotes,$SecondFURecurHisto,$SecondFUSurgeryMethod,$SecondFUSurgeryResidual,$SecondFUSurgeryType,$ThirdFU,$ThirdFUDate,$ThirdFUMonths,$ThirdFUDisposition,$ThirdFUNoRecurScarBx,$ThirdFUOutcome,$ThirdFUPostSurgery,$ThirdFURecurHisto,$ThirdFURecurrence,$ThirdFURecurrenceExcision,$ThirdFURecurrenceRx,$ThirdFURecurrenceSites,$ThirdFURecurrenceLocation,$ThirdFURecurrenceLargest,$ThirdFURecurrenceNotes,$ThirdFURecurHistoDysplasia,$ThirdFUNextColon_Mths,$ThirdFUSurgeryNotes,$ThirdFUSurgeryMethod,$ThirdFUSurgeryResidual,$ThirdFUSurgeryType,$FourthFU,$FourthFUMonths,$FourthFURecurrenceLocation,$FourthFURecurrenceLargest,$FourthFURecurrenceNotes,$FourthFURecurHistoDysplasia,$FourthFUNextColon_Mnths,$FourthFUSurgeryResidual,$FourthFUDate,$FourthFUDisposition,$FourthFUNoRecurScarBx,$FourthFUOutcome,$FourthFUPostSurgery,$FourthFURecurHisto,$FourthFURecurrence,$FourthFURecurrenceExcision,$FourthFURecurrenceRx,$FourthFURecurrenceSites,$FourthFUSurgeryMethod,$FourthFUSurgeryNotes,$FourthFUSurgeryType,$ClinSignificantBleedYN,$ClinSignificantPerfYN,$SSACharact_Dysplasia,$SSACharact_Dysplasia_Confidence,$IPPerforation_Clips,$NICE_Overall,$FirstFURecurrenceClipArtifact,$SecondFURecurrenceClipArtifact,$ThirdFURecurrenceClipArtifact,$FourthFURecurrenceClipArtifact,$ESD_enBloc,$SERT_size,$SERT_ipb,$SERT_dysplasia,$created,$creating_user,$updated,$updating_user,$entrytype,$save,$consent_PROSPER,$inPROSPER,$SERT,$completeColon_PROSPER,$defectTattoo_PROSPER,$dateEnrolled_PROSPER,$variation_PROSPER,$CLIP_consent,$CLIP_preEMRexclusion,$CLIP_postEMRexclusion,$CLIP_randomisation,$CLIP_category,$CLIP_active_closure_complete,$CLIP_active_closure_number,$CLIP_no_closure_reason,$CLIP_doppler,$CLIP_doppler_signal,$CLIP_doppler_signal_location,$CLIP_doppler_signal_area_clipped,$CLIP_notes,$SMSA,$preLesionID){
		$this->_k_procedure = $_k_procedure;
		$this->PreviousAttempt = $PreviousAttempt;
		$this->PreviousBiopsy = $PreviousBiopsy;
		$this->PreviousSPOT = $PreviousSPOT;
		$this->Size = $Size;
		$this->Location = $Location;
		$this->Paris = $Paris;
		$this->Morphology = $Morphology;
		$this->HighestKudo = $HighestKudo;
		$this->HighestSano = $HighestSano;
		$this->Predict_Cancer = $Predict_Cancer;
		$this->Predict_Histo = $Predict_Histo;
		$this->Predict_Histo_Confidence = $Predict_Histo_Confidence;
		$this->Feat_Invasion = $Feat_Invasion;
		$this->EnBloc = $EnBloc;
		$this->Access = $Access;
		$this->EMRAttempted = $EMRAttempted;
		$this->SMInjection = $SMInjection;
		$this->Constituent = $Constituent;
		$this->Constituent_other = $Constituent_other;
		$this->Adrenaline = $Adrenaline;
		$this->Dye = $Dye;
		$this->No_Injection = $No_Injection;
		$this->Lifting = $Lifting;
		$this->SnareType = $SnareType;
		$this->SnareSize = $SnareSize;
		$this->Current = $Current;
		$this->No_Pieces = $No_Pieces;
		$this->SnareExcision = $SnareExcision;
		$this->AddModality = $AddModality;
		$this->SuccessfulEMR = $SuccessfulEMR;
		$this->STSC_Margin = $STSC_Margin;
		$this->SCAR_complete = $SCAR_complete;
		$this->BookTwoStage = $BookTwoStage;
		$this->IPBleed = $IPBleed;
		$this->IPBleed_Control = $IPBleed_Control;
		$this->SMF = $SMF;
		$this->DeepInjury = $DeepInjury;
		$this->IPPerforation = $IPPerforation;
		$this->IPPerforation_Rx = $IPPerforation_Rx;
		$this->Defect_Clip_Closure = $Defect_Clip_Closure;
		$this->Defect_Clip_Closure_Number = $Defect_Clip_Closure_Number;
		$this->Duration = $Duration;
		$this->HistoPathMajor = $HistoPathMajor;
		$this->Cancer = $Cancer;
		$this->Dysplasia = $Dysplasia;
		$this->SMInvasion = $SMInvasion;
		$this->Margins = $Margins;
		$this->SpecimenSize = $SpecimenSize;
		$this->DelayedBleed = $DelayedBleed;
		$this->DelayedBleed_Admit = $DelayedBleed_Admit;
		$this->DelayedBleed_Colon = $DelayedBleed_Colon;
		$this->DelayedPerforation = $DelayedPerforation;
		$this->DelayedPerforation_Rx = $DelayedPerforation_Rx;
		$this->Disposition2Weeks = $Disposition2Weeks;
		$this->FollowUp2Weeks = $FollowUp2Weeks;
		$this->SurgReferral = $SurgReferral;
		$this->FirstFU = $FirstFU;
		$this->FirstFUMonths = $FirstFUMonths;
		$this->FirstFUDate = $FirstFUDate;
		$this->FirstFURecurrence = $FirstFURecurrence;
		$this->FirstFUNoRecurScarBx = $FirstFUNoRecurScarBx;
		$this->FirstFURecurrenceSites = $FirstFURecurrenceSites;
		$this->FirstFURecurrenceLocation = $FirstFURecurrenceLocation;
		$this->FirstFURecurrenceLargest = $FirstFURecurrenceLargest;
		$this->FirstFURecurrenceRx = $FirstFURecurrenceRx;
		$this->FirstFURecurrenceExcision = $FirstFURecurrenceExcision;
		$this->FirstFURecurrenceNotes = $FirstFURecurrenceNotes;
		$this->FirstFURecurHisto = $FirstFURecurHisto;
		$this->FirstFURecurHistoDysplasia = $FirstFURecurHistoDysplasia;
		$this->FirstFUNextColon_Mths = $FirstFUNextColon_Mths;
		$this->FirstFUOutcome = $FirstFUOutcome;
		$this->FirstFUDisposition = $FirstFUDisposition;
		$this->FirstFUSurgery = $FirstFUSurgery;
		$this->FirstFUSurgeryMethod = $FirstFUSurgeryMethod;
		$this->FirstFUSurgeryResidual = $FirstFUSurgeryResidual;
		$this->FirstFUSurgeryType = $FirstFUSurgeryType;
		$this->FirstFUSurgeryNotes = $FirstFUSurgeryNotes;
		$this->SecondFU = $SecondFU;
		$this->SecondFUMonths = $SecondFUMonths;
		$this->SecondFUDate = $SecondFUDate;
		$this->SecondFURecurrence = $SecondFURecurrence;
		$this->SecondFUNoRecurScarBx = $SecondFUNoRecurScarBx;
		$this->SecondFURecurrenceLargest = $SecondFURecurrenceLargest;
		$this->SecondFURecurrenceLocation = $SecondFURecurrenceLocation;
		$this->SecondFURecurrenceSites = $SecondFURecurrenceSites;
		$this->SecondFUDisposition = $SecondFUDisposition;
		$this->SecondFURecurrenceRx = $SecondFURecurrenceRx;
		$this->SecondFURecurrenceExcision = $SecondFURecurrenceExcision;
		$this->SecondFURecurrenceNotes = $SecondFURecurrenceNotes;
		$this->SecondFURecurHistoDysplasia = $SecondFURecurHistoDysplasia;
		$this->SecondFUNextColon_Mths = $SecondFUNextColon_Mths;
		$this->SecondFUOutcome = $SecondFUOutcome;
		$this->SecondFUSurgery = $SecondFUSurgery;
		$this->SecondFUSurgeryNotes = $SecondFUSurgeryNotes;
		$this->SecondFURecurHisto = $SecondFURecurHisto;
		$this->SecondFUSurgeryMethod = $SecondFUSurgeryMethod;
		$this->SecondFUSurgeryResidual = $SecondFUSurgeryResidual;
		$this->SecondFUSurgeryType = $SecondFUSurgeryType;
		$this->ThirdFU = $ThirdFU;
		$this->ThirdFUDate = $ThirdFUDate;
		$this->ThirdFUMonths = $ThirdFUMonths;
		$this->ThirdFUDisposition = $ThirdFUDisposition;
		$this->ThirdFUNoRecurScarBx = $ThirdFUNoRecurScarBx;
		$this->ThirdFUOutcome = $ThirdFUOutcome;
		$this->ThirdFUPostSurgery = $ThirdFUPostSurgery;
		$this->ThirdFURecurHisto = $ThirdFURecurHisto;
		$this->ThirdFURecurrence = $ThirdFURecurrence;
		$this->ThirdFURecurrenceExcision = $ThirdFURecurrenceExcision;
		$this->ThirdFURecurrenceRx = $ThirdFURecurrenceRx;
		$this->ThirdFURecurrenceSites = $ThirdFURecurrenceSites;
		$this->ThirdFURecurrenceLocation = $ThirdFURecurrenceLocation;
		$this->ThirdFURecurrenceLargest = $ThirdFURecurrenceLargest;
		$this->ThirdFURecurrenceNotes = $ThirdFURecurrenceNotes;
		$this->ThirdFURecurHistoDysplasia = $ThirdFURecurHistoDysplasia;
		$this->ThirdFUNextColon_Mths = $ThirdFUNextColon_Mths;
		$this->ThirdFUSurgeryNotes = $ThirdFUSurgeryNotes;
		$this->ThirdFUSurgeryMethod = $ThirdFUSurgeryMethod;
		$this->ThirdFUSurgeryResidual = $ThirdFUSurgeryResidual;
		$this->ThirdFUSurgeryType = $ThirdFUSurgeryType;
		$this->FourthFU = $FourthFU;
		$this->FourthFUMonths = $FourthFUMonths;
		$this->FourthFURecurrenceLocation = $FourthFURecurrenceLocation;
		$this->FourthFURecurrenceLargest = $FourthFURecurrenceLargest;
		$this->FourthFURecurrenceNotes = $FourthFURecurrenceNotes;
		$this->FourthFURecurHistoDysplasia = $FourthFURecurHistoDysplasia;
		$this->FourthFUNextColon_Mnths = $FourthFUNextColon_Mnths;
		$this->FourthFUSurgeryResidual = $FourthFUSurgeryResidual;
		$this->FourthFUDate = $FourthFUDate;
		$this->FourthFUDisposition = $FourthFUDisposition;
		$this->FourthFUNoRecurScarBx = $FourthFUNoRecurScarBx;
		$this->FourthFUOutcome = $FourthFUOutcome;
		$this->FourthFUPostSurgery = $FourthFUPostSurgery;
		$this->FourthFURecurHisto = $FourthFURecurHisto;
		$this->FourthFURecurrence = $FourthFURecurrence;
		$this->FourthFURecurrenceExcision = $FourthFURecurrenceExcision;
		$this->FourthFURecurrenceRx = $FourthFURecurrenceRx;
		$this->FourthFURecurrenceSites = $FourthFURecurrenceSites;
		$this->FourthFUSurgeryMethod = $FourthFUSurgeryMethod;
		$this->FourthFUSurgeryNotes = $FourthFUSurgeryNotes;
		$this->FourthFUSurgeryType = $FourthFUSurgeryType;
		$this->ClinSignificantBleedYN = $ClinSignificantBleedYN;
		$this->ClinSignificantPerfYN = $ClinSignificantPerfYN;
		$this->SSACharact_Dysplasia = $SSACharact_Dysplasia;
		$this->SSACharact_Dysplasia_Confidence = $SSACharact_Dysplasia_Confidence;
		$this->IPPerforation_Clips = $IPPerforation_Clips;
		$this->NICE_Overall = $NICE_Overall;
		$this->FirstFURecurrenceClipArtifact = $FirstFURecurrenceClipArtifact;
		$this->SecondFURecurrenceClipArtifact = $SecondFURecurrenceClipArtifact;
		$this->ThirdFURecurrenceClipArtifact = $ThirdFURecurrenceClipArtifact;
		$this->FourthFURecurrenceClipArtifact = $FourthFURecurrenceClipArtifact;
		$this->ESD_enBloc = $ESD_enBloc;
		$this->SERT_size = $SERT_size;
		$this->SERT_ipb = $SERT_ipb;
		$this->SERT_dysplasia = $SERT_dysplasia;
		$this->created = $created;
		$this->creating_user = $creating_user;
		$this->updated = $updated;
		$this->updating_user = $updating_user;
		$this->entrytype = $entrytype;
		$this->save = $save;
		$this->consent_PROSPER = $consent_PROSPER;
		$this->inPROSPER = $inPROSPER;
		$this->SERT = $SERT;
		$this->completeColon_PROSPER = $completeColon_PROSPER;
		$this->defectTattoo_PROSPER = $defectTattoo_PROSPER;
		$this->dateEnrolled_PROSPER = $dateEnrolled_PROSPER;
		$this->variation_PROSPER = $variation_PROSPER;
		$this->CLIP_consent = $CLIP_consent;
		$this->CLIP_preEMRexclusion = $CLIP_preEMRexclusion;
		$this->CLIP_postEMRexclusion = $CLIP_postEMRexclusion;
		$this->CLIP_randomisation = $CLIP_randomisation;
		$this->CLIP_category = $CLIP_category;
		$this->CLIP_active_closure_complete = $CLIP_active_closure_complete;
		$this->CLIP_active_closure_number = $CLIP_active_closure_number;
		$this->CLIP_no_closure_reason = $CLIP_no_closure_reason;
		$this->CLIP_doppler = $CLIP_doppler;
		$this->CLIP_doppler_signal = $CLIP_doppler_signal;
		$this->CLIP_doppler_signal_location = $CLIP_doppler_signal_location;
		$this->CLIP_doppler_signal_area_clipped = $CLIP_doppler_signal_area_clipped;
		$this->CLIP_notes = $CLIP_notes;
		$this->SMSA = $SMSA;
		$this->preLesionID = $preLesionID;
	}

    /**
     * Load one row into var_class. To use the vars use for exemple echo $class->getVar_name; 
     *
     * @param key_table_type $key_row
     * 
     */
	public function Load_from_key($key_row){
		$result = $this->connection->RunQuery("Select * from Lesion where _k_lesion = \"$key_row\" ");
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$this->_k_lesion = $row["_k_lesion"];
			$this->_k_procedure = $row["_k_procedure"];
			$this->PreviousAttempt = $row["PreviousAttempt"];
			$this->PreviousBiopsy = $row["PreviousBiopsy"];
			$this->PreviousSPOT = $row["PreviousSPOT"];
			$this->Size = $row["Size"];
			$this->Location = $row["Location"];
			$this->Paris = $row["Paris"];
			$this->Morphology = $row["Morphology"];
			$this->HighestKudo = $row["HighestKudo"];
			$this->HighestSano = $row["HighestSano"];
			$this->Predict_Cancer = $row["Predict_Cancer"];
			$this->Predict_Histo = $row["Predict_Histo"];
			$this->Predict_Histo_Confidence = $row["Predict_Histo_Confidence"];
			$this->Feat_Invasion = $row["Feat_Invasion"];
			$this->EnBloc = $row["EnBloc"];
			$this->Access = $row["Access"];
			$this->EMRAttempted = $row["EMRAttempted"];
			$this->SMInjection = $row["SMInjection"];
			$this->Constituent = $row["Constituent"];
			$this->Constituent_other = $row["Constituent_other"];
			$this->Adrenaline = $row["Adrenaline"];
			$this->Dye = $row["Dye"];
			$this->No_Injection = $row["No_Injection"];
			$this->Lifting = $row["Lifting"];
			$this->SnareType = $row["SnareType"];
			$this->SnareSize = $row["SnareSize"];
			$this->Current = $row["Current"];
			$this->No_Pieces = $row["No_Pieces"];
			$this->SnareExcision = $row["SnareExcision"];
			$this->AddModality = $row["AddModality"];
			$this->SuccessfulEMR = $row["SuccessfulEMR"];
			$this->STSC_Margin = $row["STSC_Margin"];
			$this->SCAR_complete = $row["SCAR_complete"];
			$this->BookTwoStage = $row["BookTwoStage"];
			$this->IPBleed = $row["IPBleed"];
			$this->IPBleed_Control = $row["IPBleed_Control"];
			$this->SMF = $row["SMF"];
			$this->DeepInjury = $row["DeepInjury"];
			$this->IPPerforation = $row["IPPerforation"];
			$this->IPPerforation_Rx = $row["IPPerforation_Rx"];
			$this->Defect_Clip_Closure = $row["Defect_Clip_Closure"];
			$this->Defect_Clip_Closure_Number = $row["Defect_Clip_Closure_Number"];
			$this->Duration = $row["Duration"];
			$this->HistoPathMajor = $row["HistoPathMajor"];
			$this->Cancer = $row["Cancer"];
			$this->Dysplasia = $row["Dysplasia"];
			$this->SMInvasion = $row["SMInvasion"];
			$this->Margins = $row["Margins"];
			$this->SpecimenSize = $row["SpecimenSize"];
			$this->DelayedBleed = $row["DelayedBleed"];
			$this->DelayedBleed_Admit = $row["DelayedBleed_Admit"];
			$this->DelayedBleed_Colon = $row["DelayedBleed_Colon"];
			$this->DelayedPerforation = $row["DelayedPerforation"];
			$this->DelayedPerforation_Rx = $row["DelayedPerforation_Rx"];
			$this->Disposition2Weeks = $row["Disposition2Weeks"];
			$this->FollowUp2Weeks = $row["FollowUp2Weeks"];
			$this->SurgReferral = $row["SurgReferral"];
			$this->FirstFU = $row["FirstFU"];
			$this->FirstFUMonths = $row["FirstFUMonths"];
			$this->FirstFUDate = $row["FirstFUDate"];
			$this->FirstFURecurrence = $row["FirstFURecurrence"];
			$this->FirstFUNoRecurScarBx = $row["FirstFUNoRecurScarBx"];
			$this->FirstFURecurrenceSites = $row["FirstFURecurrenceSites"];
			$this->FirstFURecurrenceLocation = $row["FirstFURecurrenceLocation"];
			$this->FirstFURecurrenceLargest = $row["FirstFURecurrenceLargest"];
			$this->FirstFURecurrenceRx = $row["FirstFURecurrenceRx"];
			$this->FirstFURecurrenceExcision = $row["FirstFURecurrenceExcision"];
			$this->FirstFURecurrenceNotes = $row["FirstFURecurrenceNotes"];
			$this->FirstFURecurHisto = $row["FirstFURecurHisto"];
			$this->FirstFURecurHistoDysplasia = $row["FirstFURecurHistoDysplasia"];
			$this->FirstFUNextColon_Mths = $row["FirstFUNextColon_Mths"];
			$this->FirstFUOutcome = $row["FirstFUOutcome"];
			$this->FirstFUDisposition = $row["FirstFUDisposition"];
			$this->FirstFUSurgery = $row["FirstFUSurgery"];
			$this->FirstFUSurgeryMethod = $row["FirstFUSurgeryMethod"];
			$this->FirstFUSurgeryResidual = $row["FirstFUSurgeryResidual"];
			$this->FirstFUSurgeryType = $row["FirstFUSurgeryType"];
			$this->FirstFUSurgeryNotes = $row["FirstFUSurgeryNotes"];
			$this->SecondFU = $row["SecondFU"];
			$this->SecondFUMonths = $row["SecondFUMonths"];
			$this->SecondFUDate = $row["SecondFUDate"];
			$this->SecondFURecurrence = $row["SecondFURecurrence"];
			$this->SecondFUNoRecurScarBx = $row["SecondFUNoRecurScarBx"];
			$this->SecondFURecurrenceLargest = $row["SecondFURecurrenceLargest"];
			$this->SecondFURecurrenceLocation = $row["SecondFURecurrenceLocation"];
			$this->SecondFURecurrenceSites = $row["SecondFURecurrenceSites"];
			$this->SecondFUDisposition = $row["SecondFUDisposition"];
			$this->SecondFURecurrenceRx = $row["SecondFURecurrenceRx"];
			$this->SecondFURecurrenceExcision = $row["SecondFURecurrenceExcision"];
			$this->SecondFURecurrenceNotes = $row["SecondFURecurrenceNotes"];
			$this->SecondFURecurHistoDysplasia = $row["SecondFURecurHistoDysplasia"];
			$this->SecondFUNextColon_Mths = $row["SecondFUNextColon_Mths"];
			$this->SecondFUOutcome = $row["SecondFUOutcome"];
			$this->SecondFUSurgery = $row["SecondFUSurgery"];
			$this->SecondFUSurgeryNotes = $row["SecondFUSurgeryNotes"];
			$this->SecondFURecurHisto = $row["SecondFURecurHisto"];
			$this->SecondFUSurgeryMethod = $row["SecondFUSurgeryMethod"];
			$this->SecondFUSurgeryResidual = $row["SecondFUSurgeryResidual"];
			$this->SecondFUSurgeryType = $row["SecondFUSurgeryType"];
			$this->ThirdFU = $row["ThirdFU"];
			$this->ThirdFUDate = $row["ThirdFUDate"];
			$this->ThirdFUMonths = $row["ThirdFUMonths"];
			$this->ThirdFUDisposition = $row["ThirdFUDisposition"];
			$this->ThirdFUNoRecurScarBx = $row["ThirdFUNoRecurScarBx"];
			$this->ThirdFUOutcome = $row["ThirdFUOutcome"];
			$this->ThirdFUPostSurgery = $row["ThirdFUPostSurgery"];
			$this->ThirdFURecurHisto = $row["ThirdFURecurHisto"];
			$this->ThirdFURecurrence = $row["ThirdFURecurrence"];
			$this->ThirdFURecurrenceExcision = $row["ThirdFURecurrenceExcision"];
			$this->ThirdFURecurrenceRx = $row["ThirdFURecurrenceRx"];
			$this->ThirdFURecurrenceSites = $row["ThirdFURecurrenceSites"];
			$this->ThirdFURecurrenceLocation = $row["ThirdFURecurrenceLocation"];
			$this->ThirdFURecurrenceLargest = $row["ThirdFURecurrenceLargest"];
			$this->ThirdFURecurrenceNotes = $row["ThirdFURecurrenceNotes"];
			$this->ThirdFURecurHistoDysplasia = $row["ThirdFURecurHistoDysplasia"];
			$this->ThirdFUNextColon_Mths = $row["ThirdFUNextColon_Mths"];
			$this->ThirdFUSurgeryNotes = $row["ThirdFUSurgeryNotes"];
			$this->ThirdFUSurgeryMethod = $row["ThirdFUSurgeryMethod"];
			$this->ThirdFUSurgeryResidual = $row["ThirdFUSurgeryResidual"];
			$this->ThirdFUSurgeryType = $row["ThirdFUSurgeryType"];
			$this->FourthFU = $row["FourthFU"];
			$this->FourthFUMonths = $row["FourthFUMonths"];
			$this->FourthFURecurrenceLocation = $row["FourthFURecurrenceLocation"];
			$this->FourthFURecurrenceLargest = $row["FourthFURecurrenceLargest"];
			$this->FourthFURecurrenceNotes = $row["FourthFURecurrenceNotes"];
			$this->FourthFURecurHistoDysplasia = $row["FourthFURecurHistoDysplasia"];
			$this->FourthFUNextColon_Mnths = $row["FourthFUNextColon_Mnths"];
			$this->FourthFUSurgeryResidual = $row["FourthFUSurgeryResidual"];
			$this->FourthFUDate = $row["FourthFUDate"];
			$this->FourthFUDisposition = $row["FourthFUDisposition"];
			$this->FourthFUNoRecurScarBx = $row["FourthFUNoRecurScarBx"];
			$this->FourthFUOutcome = $row["FourthFUOutcome"];
			$this->FourthFUPostSurgery = $row["FourthFUPostSurgery"];
			$this->FourthFURecurHisto = $row["FourthFURecurHisto"];
			$this->FourthFURecurrence = $row["FourthFURecurrence"];
			$this->FourthFURecurrenceExcision = $row["FourthFURecurrenceExcision"];
			$this->FourthFURecurrenceRx = $row["FourthFURecurrenceRx"];
			$this->FourthFURecurrenceSites = $row["FourthFURecurrenceSites"];
			$this->FourthFUSurgeryMethod = $row["FourthFUSurgeryMethod"];
			$this->FourthFUSurgeryNotes = $row["FourthFUSurgeryNotes"];
			$this->FourthFUSurgeryType = $row["FourthFUSurgeryType"];
			$this->ClinSignificantBleedYN = $row["ClinSignificantBleedYN"];
			$this->ClinSignificantPerfYN = $row["ClinSignificantPerfYN"];
			$this->SSACharact_Dysplasia = $row["SSACharact_Dysplasia"];
			$this->SSACharact_Dysplasia_Confidence = $row["SSACharact_Dysplasia_Confidence"];
			$this->IPPerforation_Clips = $row["IPPerforation_Clips"];
			$this->NICE_Overall = $row["NICE_Overall"];
			$this->FirstFURecurrenceClipArtifact = $row["FirstFURecurrenceClipArtifact"];
			$this->SecondFURecurrenceClipArtifact = $row["SecondFURecurrenceClipArtifact"];
			$this->ThirdFURecurrenceClipArtifact = $row["ThirdFURecurrenceClipArtifact"];
			$this->FourthFURecurrenceClipArtifact = $row["FourthFURecurrenceClipArtifact"];
			$this->ESD_enBloc = $row["ESD_enBloc"];
			$this->SERT_size = $row["SERT_size"];
			$this->SERT_ipb = $row["SERT_ipb"];
			$this->SERT_dysplasia = $row["SERT_dysplasia"];
			$this->created = $row["created"];
			$this->creating_user = $row["creating_user"];
			$this->updated = $row["updated"];
			$this->updating_user = $row["updating_user"];
			$this->entrytype = $row["entrytype"];
			$this->save = $row["save"];
			$this->consent_PROSPER = $row["consent_PROSPER"];
			$this->inPROSPER = $row["inPROSPER"];
			$this->SERT = $row["SERT"];
			$this->completeColon_PROSPER = $row["completeColon_PROSPER"];
			$this->defectTattoo_PROSPER = $row["defectTattoo_PROSPER"];
			$this->dateEnrolled_PROSPER = $row["dateEnrolled_PROSPER"];
			$this->variation_PROSPER = $row["variation_PROSPER"];
			$this->CLIP_consent = $row["CLIP_consent"];
			$this->CLIP_preEMRexclusion = $row["CLIP_preEMRexclusion"];
			$this->CLIP_postEMRexclusion = $row["CLIP_postEMRexclusion"];
			$this->CLIP_randomisation = $row["CLIP_randomisation"];
			$this->CLIP_category = $row["CLIP_category"];
			$this->CLIP_active_closure_complete = $row["CLIP_active_closure_complete"];
			$this->CLIP_active_closure_number = $row["CLIP_active_closure_number"];
			$this->CLIP_no_closure_reason = $row["CLIP_no_closure_reason"];
			$this->CLIP_doppler = $row["CLIP_doppler"];
			$this->CLIP_doppler_signal = $row["CLIP_doppler_signal"];
			$this->CLIP_doppler_signal_location = $row["CLIP_doppler_signal_location"];
			$this->CLIP_doppler_signal_area_clipped = $row["CLIP_doppler_signal_area_clipped"];
			$this->CLIP_notes = $row["CLIP_notes"];
			$this->SMSA = $row["SMSA"];
			$this->preLesionID = $row["preLesionID"];
		}
	}

    /**
     * Delete the row by using the key as arg
     *
     * @param key_table_type $key_row
     *
     */
	public function Delete_row_from_key($key_row){
		$this->connection->RunQuery("DELETE FROM Lesion WHERE _k_lesion = $key_row");
	}
	
	public function JS_var(){
		$result = get_object_vars($this);
		return json_encode($result);
	}

    /**
     * Update the active row table on table
     */
	public function Save_Active_Row(){
		$this->connection->RunQuery("UPDATE Lesion set _k_procedure = \"$this->_k_procedure\", PreviousAttempt = \"$this->PreviousAttempt\", PreviousBiopsy = \"$this->PreviousBiopsy\", PreviousSPOT = \"$this->PreviousSPOT\", Size = \"$this->Size\", Location = \"$this->Location\", Paris = \"$this->Paris\", Morphology = \"$this->Morphology\", HighestKudo = \"$this->HighestKudo\", HighestSano = \"$this->HighestSano\", Predict_Cancer = \"$this->Predict_Cancer\", Predict_Histo = \"$this->Predict_Histo\", Predict_Histo_Confidence = \"$this->Predict_Histo_Confidence\", Feat_Invasion = \"$this->Feat_Invasion\", EnBloc = \"$this->EnBloc\", Access = \"$this->Access\", EMRAttempted = \"$this->EMRAttempted\", SMInjection = \"$this->SMInjection\", Constituent = \"$this->Constituent\", Constituent_other = \"$this->Constituent_other\", Adrenaline = \"$this->Adrenaline\", Dye = \"$this->Dye\", No_Injection = \"$this->No_Injection\", Lifting = \"$this->Lifting\", SnareType = \"$this->SnareType\", SnareSize = \"$this->SnareSize\", Current = \"$this->Current\", No_Pieces = \"$this->No_Pieces\", SnareExcision = \"$this->SnareExcision\", AddModality = \"$this->AddModality\", SuccessfulEMR = \"$this->SuccessfulEMR\", STSC_Margin = \"$this->STSC_Margin\", SCAR_complete = \"$this->SCAR_complete\", BookTwoStage = \"$this->BookTwoStage\", IPBleed = \"$this->IPBleed\", IPBleed_Control = \"$this->IPBleed_Control\", SMF = \"$this->SMF\", DeepInjury = \"$this->DeepInjury\", IPPerforation = \"$this->IPPerforation\", IPPerforation_Rx = \"$this->IPPerforation_Rx\", Defect_Clip_Closure = \"$this->Defect_Clip_Closure\", Defect_Clip_Closure_Number = \"$this->Defect_Clip_Closure_Number\", Duration = \"$this->Duration\", HistoPathMajor = \"$this->HistoPathMajor\", Cancer = \"$this->Cancer\", Dysplasia = \"$this->Dysplasia\", SMInvasion = \"$this->SMInvasion\", Margins = \"$this->Margins\", SpecimenSize = \"$this->SpecimenSize\", DelayedBleed = \"$this->DelayedBleed\", DelayedBleed_Admit = \"$this->DelayedBleed_Admit\", DelayedBleed_Colon = \"$this->DelayedBleed_Colon\", DelayedPerforation = \"$this->DelayedPerforation\", DelayedPerforation_Rx = \"$this->DelayedPerforation_Rx\", Disposition2Weeks = \"$this->Disposition2Weeks\", FollowUp2Weeks = \"$this->FollowUp2Weeks\", SurgReferral = \"$this->SurgReferral\", FirstFU = \"$this->FirstFU\", FirstFUMonths = \"$this->FirstFUMonths\", FirstFUDate = \"$this->FirstFUDate\", FirstFURecurrence = \"$this->FirstFURecurrence\", FirstFUNoRecurScarBx = \"$this->FirstFUNoRecurScarBx\", FirstFURecurrenceSites = \"$this->FirstFURecurrenceSites\", FirstFURecurrenceLocation = \"$this->FirstFURecurrenceLocation\", FirstFURecurrenceLargest = \"$this->FirstFURecurrenceLargest\", FirstFURecurrenceRx = \"$this->FirstFURecurrenceRx\", FirstFURecurrenceExcision = \"$this->FirstFURecurrenceExcision\", FirstFURecurrenceNotes = \"$this->FirstFURecurrenceNotes\", FirstFURecurHisto = \"$this->FirstFURecurHisto\", FirstFURecurHistoDysplasia = \"$this->FirstFURecurHistoDysplasia\", FirstFUNextColon_Mths = \"$this->FirstFUNextColon_Mths\", FirstFUOutcome = \"$this->FirstFUOutcome\", FirstFUDisposition = \"$this->FirstFUDisposition\", FirstFUSurgery = \"$this->FirstFUSurgery\", FirstFUSurgeryMethod = \"$this->FirstFUSurgeryMethod\", FirstFUSurgeryResidual = \"$this->FirstFUSurgeryResidual\", FirstFUSurgeryType = \"$this->FirstFUSurgeryType\", FirstFUSurgeryNotes = \"$this->FirstFUSurgeryNotes\", SecondFU = \"$this->SecondFU\", SecondFUMonths = \"$this->SecondFUMonths\", SecondFUDate = \"$this->SecondFUDate\", SecondFURecurrence = \"$this->SecondFURecurrence\", SecondFUNoRecurScarBx = \"$this->SecondFUNoRecurScarBx\", SecondFURecurrenceLargest = \"$this->SecondFURecurrenceLargest\", SecondFURecurrenceLocation = \"$this->SecondFURecurrenceLocation\", SecondFURecurrenceSites = \"$this->SecondFURecurrenceSites\", SecondFUDisposition = \"$this->SecondFUDisposition\", SecondFURecurrenceRx = \"$this->SecondFURecurrenceRx\", SecondFURecurrenceExcision = \"$this->SecondFURecurrenceExcision\", SecondFURecurrenceNotes = \"$this->SecondFURecurrenceNotes\", SecondFURecurHistoDysplasia = \"$this->SecondFURecurHistoDysplasia\", SecondFUNextColon_Mths = \"$this->SecondFUNextColon_Mths\", SecondFUOutcome = \"$this->SecondFUOutcome\", SecondFUSurgery = \"$this->SecondFUSurgery\", SecondFUSurgeryNotes = \"$this->SecondFUSurgeryNotes\", SecondFURecurHisto = \"$this->SecondFURecurHisto\", SecondFUSurgeryMethod = \"$this->SecondFUSurgeryMethod\", SecondFUSurgeryResidual = \"$this->SecondFUSurgeryResidual\", SecondFUSurgeryType = \"$this->SecondFUSurgeryType\", ThirdFU = \"$this->ThirdFU\", ThirdFUDate = \"$this->ThirdFUDate\", ThirdFUMonths = \"$this->ThirdFUMonths\", ThirdFUDisposition = \"$this->ThirdFUDisposition\", ThirdFUNoRecurScarBx = \"$this->ThirdFUNoRecurScarBx\", ThirdFUOutcome = \"$this->ThirdFUOutcome\", ThirdFUPostSurgery = \"$this->ThirdFUPostSurgery\", ThirdFURecurHisto = \"$this->ThirdFURecurHisto\", ThirdFURecurrence = \"$this->ThirdFURecurrence\", ThirdFURecurrenceExcision = \"$this->ThirdFURecurrenceExcision\", ThirdFURecurrenceRx = \"$this->ThirdFURecurrenceRx\", ThirdFURecurrenceSites = \"$this->ThirdFURecurrenceSites\", ThirdFURecurrenceLocation = \"$this->ThirdFURecurrenceLocation\", ThirdFURecurrenceLargest = \"$this->ThirdFURecurrenceLargest\", ThirdFURecurrenceNotes = \"$this->ThirdFURecurrenceNotes\", ThirdFURecurHistoDysplasia = \"$this->ThirdFURecurHistoDysplasia\", ThirdFUNextColon_Mths = \"$this->ThirdFUNextColon_Mths\", ThirdFUSurgeryNotes = \"$this->ThirdFUSurgeryNotes\", ThirdFUSurgeryMethod = \"$this->ThirdFUSurgeryMethod\", ThirdFUSurgeryResidual = \"$this->ThirdFUSurgeryResidual\", ThirdFUSurgeryType = \"$this->ThirdFUSurgeryType\", FourthFU = \"$this->FourthFU\", FourthFUMonths = \"$this->FourthFUMonths\", FourthFURecurrenceLocation = \"$this->FourthFURecurrenceLocation\", FourthFURecurrenceLargest = \"$this->FourthFURecurrenceLargest\", FourthFURecurrenceNotes = \"$this->FourthFURecurrenceNotes\", FourthFURecurHistoDysplasia = \"$this->FourthFURecurHistoDysplasia\", FourthFUNextColon_Mnths = \"$this->FourthFUNextColon_Mnths\", FourthFUSurgeryResidual = \"$this->FourthFUSurgeryResidual\", FourthFUDate = \"$this->FourthFUDate\", FourthFUDisposition = \"$this->FourthFUDisposition\", FourthFUNoRecurScarBx = \"$this->FourthFUNoRecurScarBx\", FourthFUOutcome = \"$this->FourthFUOutcome\", FourthFUPostSurgery = \"$this->FourthFUPostSurgery\", FourthFURecurHisto = \"$this->FourthFURecurHisto\", FourthFURecurrence = \"$this->FourthFURecurrence\", FourthFURecurrenceExcision = \"$this->FourthFURecurrenceExcision\", FourthFURecurrenceRx = \"$this->FourthFURecurrenceRx\", FourthFURecurrenceSites = \"$this->FourthFURecurrenceSites\", FourthFUSurgeryMethod = \"$this->FourthFUSurgeryMethod\", FourthFUSurgeryNotes = \"$this->FourthFUSurgeryNotes\", FourthFUSurgeryType = \"$this->FourthFUSurgeryType\", ClinSignificantBleedYN = \"$this->ClinSignificantBleedYN\", ClinSignificantPerfYN = \"$this->ClinSignificantPerfYN\", SSACharact_Dysplasia = \"$this->SSACharact_Dysplasia\", SSACharact_Dysplasia_Confidence = \"$this->SSACharact_Dysplasia_Confidence\", IPPerforation_Clips = \"$this->IPPerforation_Clips\", NICE_Overall = \"$this->NICE_Overall\", FirstFURecurrenceClipArtifact = \"$this->FirstFURecurrenceClipArtifact\", SecondFURecurrenceClipArtifact = \"$this->SecondFURecurrenceClipArtifact\", ThirdFURecurrenceClipArtifact = \"$this->ThirdFURecurrenceClipArtifact\", FourthFURecurrenceClipArtifact = \"$this->FourthFURecurrenceClipArtifact\", ESD_enBloc = \"$this->ESD_enBloc\", SERT_size = \"$this->SERT_size\", SERT_ipb = \"$this->SERT_ipb\", SERT_dysplasia = \"$this->SERT_dysplasia\", created = \"$this->created\", creating_user = \"$this->creating_user\", updated = \"$this->updated\", updating_user = \"$this->updating_user\", entrytype = \"$this->entrytype\", save = \"$this->save\", consent_PROSPER = \"$this->consent_PROSPER\", inPROSPER = \"$this->inPROSPER\", SERT = \"$this->SERT\", completeColon_PROSPER = \"$this->completeColon_PROSPER\", defectTattoo_PROSPER = \"$this->defectTattoo_PROSPER\", dateEnrolled_PROSPER = \"$this->dateEnrolled_PROSPER\", variation_PROSPER = \"$this->variation_PROSPER\", CLIP_consent = \"$this->CLIP_consent\", CLIP_preEMRexclusion = \"$this->CLIP_preEMRexclusion\", CLIP_postEMRexclusion = \"$this->CLIP_postEMRexclusion\", CLIP_randomisation = \"$this->CLIP_randomisation\", CLIP_category = \"$this->CLIP_category\", CLIP_active_closure_complete = \"$this->CLIP_active_closure_complete\", CLIP_active_closure_number = \"$this->CLIP_active_closure_number\", CLIP_no_closure_reason = \"$this->CLIP_no_closure_reason\", CLIP_doppler = \"$this->CLIP_doppler\", CLIP_doppler_signal = \"$this->CLIP_doppler_signal\", CLIP_doppler_signal_location = \"$this->CLIP_doppler_signal_location\", CLIP_doppler_signal_area_clipped = \"$this->CLIP_doppler_signal_area_clipped\", CLIP_notes = \"$this->CLIP_notes\", SMSA = \"$this->SMSA\", preLesionID = \"$this->preLesionID\" where _k_lesion = \"$this->_k_lesion\"");
	}

    /**
     * Save the active var class as a new row on table
     */
	public function Save_Active_Row_as_New(){
		$this->connection->RunQuery("Insert into Lesion (_k_procedure, PreviousAttempt, PreviousBiopsy, PreviousSPOT, Size, Location, Paris, Morphology, HighestKudo, HighestSano, Predict_Cancer, Predict_Histo, Predict_Histo_Confidence, Feat_Invasion, EnBloc, Access, EMRAttempted, SMInjection, Constituent, Constituent_other, Adrenaline, Dye, No_Injection, Lifting, SnareType, SnareSize, Current, No_Pieces, SnareExcision, AddModality, SuccessfulEMR, STSC_Margin, SCAR_complete, BookTwoStage, IPBleed, IPBleed_Control, SMF, DeepInjury, IPPerforation, IPPerforation_Rx, Defect_Clip_Closure, Defect_Clip_Closure_Number, Duration, HistoPathMajor, Cancer, Dysplasia, SMInvasion, Margins, SpecimenSize, DelayedBleed, DelayedBleed_Admit, DelayedBleed_Colon, DelayedPerforation, DelayedPerforation_Rx, Disposition2Weeks, FollowUp2Weeks, SurgReferral, FirstFU, FirstFUMonths, FirstFUDate, FirstFURecurrence, FirstFUNoRecurScarBx, FirstFURecurrenceSites, FirstFURecurrenceLocation, FirstFURecurrenceLargest, FirstFURecurrenceRx, FirstFURecurrenceExcision, FirstFURecurrenceNotes, FirstFURecurHisto, FirstFURecurHistoDysplasia, FirstFUNextColon_Mths, FirstFUOutcome, FirstFUDisposition, FirstFUSurgery, FirstFUSurgeryMethod, FirstFUSurgeryResidual, FirstFUSurgeryType, FirstFUSurgeryNotes, SecondFU, SecondFUMonths, SecondFUDate, SecondFURecurrence, SecondFUNoRecurScarBx, SecondFURecurrenceLargest, SecondFURecurrenceLocation, SecondFURecurrenceSites, SecondFUDisposition, SecondFURecurrenceRx, SecondFURecurrenceExcision, SecondFURecurrenceNotes, SecondFURecurHistoDysplasia, SecondFUNextColon_Mths, SecondFUOutcome, SecondFUSurgery, SecondFUSurgeryNotes, SecondFURecurHisto, SecondFUSurgeryMethod, SecondFUSurgeryResidual, SecondFUSurgeryType, ThirdFU, ThirdFUDate, ThirdFUMonths, ThirdFUDisposition, ThirdFUNoRecurScarBx, ThirdFUOutcome, ThirdFUPostSurgery, ThirdFURecurHisto, ThirdFURecurrence, ThirdFURecurrenceExcision, ThirdFURecurrenceRx, ThirdFURecurrenceSites, ThirdFURecurrenceLocation, ThirdFURecurrenceLargest, ThirdFURecurrenceNotes, ThirdFURecurHistoDysplasia, ThirdFUNextColon_Mths, ThirdFUSurgeryNotes, ThirdFUSurgeryMethod, ThirdFUSurgeryResidual, ThirdFUSurgeryType, FourthFU, FourthFUMonths, FourthFURecurrenceLocation, FourthFURecurrenceLargest, FourthFURecurrenceNotes, FourthFURecurHistoDysplasia, FourthFUNextColon_Mnths, FourthFUSurgeryResidual, FourthFUDate, FourthFUDisposition, FourthFUNoRecurScarBx, FourthFUOutcome, FourthFUPostSurgery, FourthFURecurHisto, FourthFURecurrence, FourthFURecurrenceExcision, FourthFURecurrenceRx, FourthFURecurrenceSites, FourthFUSurgeryMethod, FourthFUSurgeryNotes, FourthFUSurgeryType, ClinSignificantBleedYN, ClinSignificantPerfYN, SSACharact_Dysplasia, SSACharact_Dysplasia_Confidence, IPPerforation_Clips, NICE_Overall, FirstFURecurrenceClipArtifact, SecondFURecurrenceClipArtifact, ThirdFURecurrenceClipArtifact, FourthFURecurrenceClipArtifact, ESD_enBloc, SERT_size, SERT_ipb, SERT_dysplasia, created, creating_user, updated, updating_user, entrytype, save, consent_PROSPER, inPROSPER, SERT, completeColon_PROSPER, defectTattoo_PROSPER, dateEnrolled_PROSPER, variation_PROSPER, CLIP_consent, CLIP_preEMRexclusion, CLIP_postEMRexclusion, CLIP_randomisation, CLIP_category, CLIP_active_closure_complete, CLIP_active_closure_number, CLIP_no_closure_reason, CLIP_doppler, CLIP_doppler_signal, CLIP_doppler_signal_location, CLIP_doppler_signal_area_clipped, CLIP_notes, SMSA, preLesionID) values (\"$this->_k_procedure\", \"$this->PreviousAttempt\", \"$this->PreviousBiopsy\", \"$this->PreviousSPOT\", \"$this->Size\", \"$this->Location\", \"$this->Paris\", \"$this->Morphology\", \"$this->HighestKudo\", \"$this->HighestSano\", \"$this->Predict_Cancer\", \"$this->Predict_Histo\", \"$this->Predict_Histo_Confidence\", \"$this->Feat_Invasion\", \"$this->EnBloc\", \"$this->Access\", \"$this->EMRAttempted\", \"$this->SMInjection\", \"$this->Constituent\", \"$this->Constituent_other\", \"$this->Adrenaline\", \"$this->Dye\", \"$this->No_Injection\", \"$this->Lifting\", \"$this->SnareType\", \"$this->SnareSize\", \"$this->Current\", \"$this->No_Pieces\", \"$this->SnareExcision\", \"$this->AddModality\", \"$this->SuccessfulEMR\", \"$this->STSC_Margin\", \"$this->SCAR_complete\", \"$this->BookTwoStage\", \"$this->IPBleed\", \"$this->IPBleed_Control\", \"$this->SMF\", \"$this->DeepInjury\", \"$this->IPPerforation\", \"$this->IPPerforation_Rx\", \"$this->Defect_Clip_Closure\", \"$this->Defect_Clip_Closure_Number\", \"$this->Duration\", \"$this->HistoPathMajor\", \"$this->Cancer\", \"$this->Dysplasia\", \"$this->SMInvasion\", \"$this->Margins\", \"$this->SpecimenSize\", \"$this->DelayedBleed\", \"$this->DelayedBleed_Admit\", \"$this->DelayedBleed_Colon\", \"$this->DelayedPerforation\", \"$this->DelayedPerforation_Rx\", \"$this->Disposition2Weeks\", \"$this->FollowUp2Weeks\", \"$this->SurgReferral\", \"$this->FirstFU\", \"$this->FirstFUMonths\", \"$this->FirstFUDate\", \"$this->FirstFURecurrence\", \"$this->FirstFUNoRecurScarBx\", \"$this->FirstFURecurrenceSites\", \"$this->FirstFURecurrenceLocation\", \"$this->FirstFURecurrenceLargest\", \"$this->FirstFURecurrenceRx\", \"$this->FirstFURecurrenceExcision\", \"$this->FirstFURecurrenceNotes\", \"$this->FirstFURecurHisto\", \"$this->FirstFURecurHistoDysplasia\", \"$this->FirstFUNextColon_Mths\", \"$this->FirstFUOutcome\", \"$this->FirstFUDisposition\", \"$this->FirstFUSurgery\", \"$this->FirstFUSurgeryMethod\", \"$this->FirstFUSurgeryResidual\", \"$this->FirstFUSurgeryType\", \"$this->FirstFUSurgeryNotes\", \"$this->SecondFU\", \"$this->SecondFUMonths\", \"$this->SecondFUDate\", \"$this->SecondFURecurrence\", \"$this->SecondFUNoRecurScarBx\", \"$this->SecondFURecurrenceLargest\", \"$this->SecondFURecurrenceLocation\", \"$this->SecondFURecurrenceSites\", \"$this->SecondFUDisposition\", \"$this->SecondFURecurrenceRx\", \"$this->SecondFURecurrenceExcision\", \"$this->SecondFURecurrenceNotes\", \"$this->SecondFURecurHistoDysplasia\", \"$this->SecondFUNextColon_Mths\", \"$this->SecondFUOutcome\", \"$this->SecondFUSurgery\", \"$this->SecondFUSurgeryNotes\", \"$this->SecondFURecurHisto\", \"$this->SecondFUSurgeryMethod\", \"$this->SecondFUSurgeryResidual\", \"$this->SecondFUSurgeryType\", \"$this->ThirdFU\", \"$this->ThirdFUDate\", \"$this->ThirdFUMonths\", \"$this->ThirdFUDisposition\", \"$this->ThirdFUNoRecurScarBx\", \"$this->ThirdFUOutcome\", \"$this->ThirdFUPostSurgery\", \"$this->ThirdFURecurHisto\", \"$this->ThirdFURecurrence\", \"$this->ThirdFURecurrenceExcision\", \"$this->ThirdFURecurrenceRx\", \"$this->ThirdFURecurrenceSites\", \"$this->ThirdFURecurrenceLocation\", \"$this->ThirdFURecurrenceLargest\", \"$this->ThirdFURecurrenceNotes\", \"$this->ThirdFURecurHistoDysplasia\", \"$this->ThirdFUNextColon_Mths\", \"$this->ThirdFUSurgeryNotes\", \"$this->ThirdFUSurgeryMethod\", \"$this->ThirdFUSurgeryResidual\", \"$this->ThirdFUSurgeryType\", \"$this->FourthFU\", \"$this->FourthFUMonths\", \"$this->FourthFURecurrenceLocation\", \"$this->FourthFURecurrenceLargest\", \"$this->FourthFURecurrenceNotes\", \"$this->FourthFURecurHistoDysplasia\", \"$this->FourthFUNextColon_Mnths\", \"$this->FourthFUSurgeryResidual\", \"$this->FourthFUDate\", \"$this->FourthFUDisposition\", \"$this->FourthFUNoRecurScarBx\", \"$this->FourthFUOutcome\", \"$this->FourthFUPostSurgery\", \"$this->FourthFURecurHisto\", \"$this->FourthFURecurrence\", \"$this->FourthFURecurrenceExcision\", \"$this->FourthFURecurrenceRx\", \"$this->FourthFURecurrenceSites\", \"$this->FourthFUSurgeryMethod\", \"$this->FourthFUSurgeryNotes\", \"$this->FourthFUSurgeryType\", \"$this->ClinSignificantBleedYN\", \"$this->ClinSignificantPerfYN\", \"$this->SSACharact_Dysplasia\", \"$this->SSACharact_Dysplasia_Confidence\", \"$this->IPPerforation_Clips\", \"$this->NICE_Overall\", \"$this->FirstFURecurrenceClipArtifact\", \"$this->SecondFURecurrenceClipArtifact\", \"$this->ThirdFURecurrenceClipArtifact\", \"$this->FourthFURecurrenceClipArtifact\", \"$this->ESD_enBloc\", \"$this->SERT_size\", \"$this->SERT_ipb\", \"$this->SERT_dysplasia\", \"$this->created\", \"$this->creating_user\", \"$this->updated\", \"$this->updating_user\", \"$this->entrytype\", \"$this->save\", \"$this->consent_PROSPER\", \"$this->inPROSPER\", \"$this->SERT\", \"$this->completeColon_PROSPER\", \"$this->defectTattoo_PROSPER\", \"$this->dateEnrolled_PROSPER\", \"$this->variation_PROSPER\", \"$this->CLIP_consent\", \"$this->CLIP_preEMRexclusion\", \"$this->CLIP_postEMRexclusion\", \"$this->CLIP_randomisation\", \"$this->CLIP_category\", \"$this->CLIP_active_closure_complete\", \"$this->CLIP_active_closure_number\", \"$this->CLIP_no_closure_reason\", \"$this->CLIP_doppler\", \"$this->CLIP_doppler_signal\", \"$this->CLIP_doppler_signal_location\", \"$this->CLIP_doppler_signal_area_clipped\", \"$this->CLIP_notes\", \"$this->SMSA\", \"$this->preLesionID\")");
	}

    /**
     * Returns array of keys order by $column -> name of column $order -> desc or acs
     *
     * @param string $column
     * @param string $order
     */
	public function GetKeysOrderBy($column, $order){
		$keys = array(); $i = 0;
		$result = $this->connection->RunQuery("SELECT _k_lesion from Lesion order by $column $order");
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$keys[$i] = $row["_k_lesion"];
				$i++;
			}
	return $keys;
	}

	/**
	 * @return _k_lesion - int(10)
	 */
	public function get_k_lesion(){
		return $this->_k_lesion;
	}

	/**
	 * @return _k_procedure - int(7)
	 */
	public function get_k_procedure(){
		return $this->_k_procedure;
	}

	/**
	 * @return PreviousAttempt - int(2)
	 */
	public function getPreviousAttempt(){
		return $this->PreviousAttempt;
	}

	/**
	 * @return PreviousBiopsy - int(2)
	 */
	public function getPreviousBiopsy(){
		return $this->PreviousBiopsy;
	}

	/**
	 * @return PreviousSPOT - int(2)
	 */
	public function getPreviousSPOT(){
		return $this->PreviousSPOT;
	}

	/**
	 * @return Size - int(4)
	 */
	public function getSize(){
		return $this->Size;
	}

	/**
	 * @return Location - int(2)
	 */
	public function getLocation(){
		return $this->Location;
	}

	/**
	 * @return Paris - int(2)
	 */
	public function getParis(){
		return $this->Paris;
	}

	/**
	 * @return Morphology - int(2)
	 */
	public function getMorphology(){
		return $this->Morphology;
	}

	/**
	 * @return HighestKudo - int(2)
	 */
	public function getHighestKudo(){
		return $this->HighestKudo;
	}

	/**
	 * @return HighestSano - int(2)
	 */
	public function getHighestSano(){
		return $this->HighestSano;
	}

	/**
	 * @return Predict_Cancer - int(2)
	 */
	public function getPredict_Cancer(){
		return $this->Predict_Cancer;
	}

	/**
	 * @return Predict_Histo - tinyint(2)
	 */
	public function getPredict_Histo(){
		return $this->Predict_Histo;
	}

	/**
	 * @return Predict_Histo_Confidence - tinyint(2)
	 */
	public function getPredict_Histo_Confidence(){
		return $this->Predict_Histo_Confidence;
	}

	/**
	 * @return Feat_Invasion - int(2)
	 */
	public function getFeat_Invasion(){
		return $this->Feat_Invasion;
	}

	/**
	 * @return EnBloc - int(2)
	 */
	public function getEnBloc(){
		return $this->EnBloc;
	}

	/**
	 * @return Access - int(2)
	 */
	public function getAccess(){
		return $this->Access;
	}

	/**
	 * @return EMRAttempted - int(2)
	 */
	public function getEMRAttempted(){
		return $this->EMRAttempted;
	}

	/**
	 * @return SMInjection - int(2)
	 */
	public function getSMInjection(){
		return $this->SMInjection;
	}

	/**
	 * @return Constituent - int(2)
	 */
	public function getConstituent(){
		return $this->Constituent;
	}

	/**
	 * @return Constituent_other - tinyint(2)
	 */
	public function getConstituent_other(){
		return $this->Constituent_other;
	}

	/**
	 * @return Adrenaline - int(2)
	 */
	public function getAdrenaline(){
		return $this->Adrenaline;
	}

	/**
	 * @return Dye - int(2)
	 */
	public function getDye(){
		return $this->Dye;
	}

	/**
	 * @return No_Injection - int(2)
	 */
	public function getNo_Injection(){
		return $this->No_Injection;
	}

	/**
	 * @return Lifting - int(2)
	 */
	public function getLifting(){
		return $this->Lifting;
	}

	/**
	 * @return SnareType - int(2)
	 */
	public function getSnareType(){
		return $this->SnareType;
	}

	/**
	 * @return SnareSize - int(2)
	 */
	public function getSnareSize(){
		return $this->SnareSize;
	}

	/**
	 * @return Current - int(2)
	 */
	public function getCurrent(){
		return $this->Current;
	}

	/**
	 * @return No_Pieces - int(2)
	 */
	public function getNo_Pieces(){
		return $this->No_Pieces;
	}

	/**
	 * @return SnareExcision - int(2)
	 */
	public function getSnareExcision(){
		return $this->SnareExcision;
	}

	/**
	 * @return AddModality - int(2)
	 */
	public function getAddModality(){
		return $this->AddModality;
	}

	/**
	 * @return SuccessfulEMR - int(2)
	 */
	public function getSuccessfulEMR(){
		return $this->SuccessfulEMR;
	}

	/**
	 * @return STSC_Margin - tinyint(2)
	 */
	public function getSTSC_Margin(){
		return $this->STSC_Margin;
	}

	/**
	 * @return SCAR_complete - int(2)
	 */
	public function getSCAR_complete(){
		return $this->SCAR_complete;
	}

	/**
	 * @return BookTwoStage - int(2)
	 */
	public function getBookTwoStage(){
		return $this->BookTwoStage;
	}

	/**
	 * @return IPBleed - int(2)
	 */
	public function getIPBleed(){
		return $this->IPBleed;
	}

	/**
	 * @return IPBleed_Control - int(2)
	 */
	public function getIPBleed_Control(){
		return $this->IPBleed_Control;
	}

	/**
	 * @return SMF - int(2)
	 */
	public function getSMF(){
		return $this->SMF;
	}

	/**
	 * @return DeepInjury - tinyint(2)
	 */
	public function getDeepInjury(){
		return $this->DeepInjury;
	}

	/**
	 * @return IPPerforation - int(2)
	 */
	public function getIPPerforation(){
		return $this->IPPerforation;
	}

	/**
	 * @return IPPerforation_Rx - int(2)
	 */
	public function getIPPerforation_Rx(){
		return $this->IPPerforation_Rx;
	}

	/**
	 * @return Defect_Clip_Closure - tinyint(3)
	 */
	public function getDefect_Clip_Closure(){
		return $this->Defect_Clip_Closure;
	}

	/**
	 * @return Defect_Clip_Closure_Number - int(2)
	 */
	public function getDefect_Clip_Closure_Number(){
		return $this->Defect_Clip_Closure_Number;
	}

	/**
	 * @return Duration - int(5)
	 */
	public function getDuration(){
		return $this->Duration;
	}

	/**
	 * @return HistoPathMajor - int(2)
	 */
	public function getHistoPathMajor(){
		return $this->HistoPathMajor;
	}

	/**
	 * @return Cancer - int(2)
	 */
	public function getCancer(){
		return $this->Cancer;
	}

	/**
	 * @return Dysplasia - int(2)
	 */
	public function getDysplasia(){
		return $this->Dysplasia;
	}

	/**
	 * @return SMInvasion - int(2)
	 */
	public function getSMInvasion(){
		return $this->SMInvasion;
	}

	/**
	 * @return Margins - int(2)
	 */
	public function getMargins(){
		return $this->Margins;
	}

	/**
	 * @return SpecimenSize - int(2)
	 */
	public function getSpecimenSize(){
		return $this->SpecimenSize;
	}

	/**
	 * @return DelayedBleed - int(2)
	 */
	public function getDelayedBleed(){
		return $this->DelayedBleed;
	}

	/**
	 * @return DelayedBleed_Admit - int(2)
	 */
	public function getDelayedBleed_Admit(){
		return $this->DelayedBleed_Admit;
	}

	/**
	 * @return DelayedBleed_Colon - int(2)
	 */
	public function getDelayedBleed_Colon(){
		return $this->DelayedBleed_Colon;
	}

	/**
	 * @return DelayedPerforation - int(2)
	 */
	public function getDelayedPerforation(){
		return $this->DelayedPerforation;
	}

	/**
	 * @return DelayedPerforation_Rx - int(2)
	 */
	public function getDelayedPerforation_Rx(){
		return $this->DelayedPerforation_Rx;
	}

	/**
	 * @return Disposition2Weeks - int(2)
	 */
	public function getDisposition2Weeks(){
		return $this->Disposition2Weeks;
	}

	/**
	 * @return FollowUp2Weeks - int(2)
	 */
	public function getFollowUp2Weeks(){
		return $this->FollowUp2Weeks;
	}

	/**
	 * @return SurgReferral - int(2)
	 */
	public function getSurgReferral(){
		return $this->SurgReferral;
	}

	/**
	 * @return FirstFU - int(2)
	 */
	public function getFirstFU(){
		return $this->FirstFU;
	}

	/**
	 * @return FirstFUMonths - tinyint(4)
	 */
	public function getFirstFUMonths(){
		return $this->FirstFUMonths;
	}

	/**
	 * @return FirstFUDate - date
	 */
	public function getFirstFUDate(){
		return $this->FirstFUDate;
	}

	/**
	 * @return FirstFURecurrence - tinyint(4)
	 */
	public function getFirstFURecurrence(){
		return $this->FirstFURecurrence;
	}

	/**
	 * @return FirstFUNoRecurScarBx - tinyint(3)
	 */
	public function getFirstFUNoRecurScarBx(){
		return $this->FirstFUNoRecurScarBx;
	}

	/**
	 * @return FirstFURecurrenceSites - tinyint(4)
	 */
	public function getFirstFURecurrenceSites(){
		return $this->FirstFURecurrenceSites;
	}

	/**
	 * @return FirstFURecurrenceLocation - tinyint(4)
	 */
	public function getFirstFURecurrenceLocation(){
		return $this->FirstFURecurrenceLocation;
	}

	/**
	 * @return FirstFURecurrenceLargest - tinyint(4)
	 */
	public function getFirstFURecurrenceLargest(){
		return $this->FirstFURecurrenceLargest;
	}

	/**
	 * @return FirstFURecurrenceRx - tinyint(4)
	 */
	public function getFirstFURecurrenceRx(){
		return $this->FirstFURecurrenceRx;
	}

	/**
	 * @return FirstFURecurrenceExcision - tinyint(4)
	 */
	public function getFirstFURecurrenceExcision(){
		return $this->FirstFURecurrenceExcision;
	}

	/**
	 * @return FirstFURecurrenceNotes - varchar(80)
	 */
	public function getFirstFURecurrenceNotes(){
		return $this->FirstFURecurrenceNotes;
	}

	/**
	 * @return FirstFURecurHisto - int(2)
	 */
	public function getFirstFURecurHisto(){
		return $this->FirstFURecurHisto;
	}

	/**
	 * @return FirstFURecurHistoDysplasia - int(2)
	 */
	public function getFirstFURecurHistoDysplasia(){
		return $this->FirstFURecurHistoDysplasia;
	}

	/**
	 * @return FirstFUNextColon_Mths - int(2)
	 */
	public function getFirstFUNextColon_Mths(){
		return $this->FirstFUNextColon_Mths;
	}

	/**
	 * @return FirstFUOutcome - int(2)
	 */
	public function getFirstFUOutcome(){
		return $this->FirstFUOutcome;
	}

	/**
	 * @return FirstFUDisposition - int(2)
	 */
	public function getFirstFUDisposition(){
		return $this->FirstFUDisposition;
	}

	/**
	 * @return FirstFUSurgery - tinyint(3)
	 */
	public function getFirstFUSurgery(){
		return $this->FirstFUSurgery;
	}

	/**
	 * @return FirstFUSurgeryMethod - int(2)
	 */
	public function getFirstFUSurgeryMethod(){
		return $this->FirstFUSurgeryMethod;
	}

	/**
	 * @return FirstFUSurgeryResidual - int(2)
	 */
	public function getFirstFUSurgeryResidual(){
		return $this->FirstFUSurgeryResidual;
	}

	/**
	 * @return FirstFUSurgeryType - int(2)
	 */
	public function getFirstFUSurgeryType(){
		return $this->FirstFUSurgeryType;
	}

	/**
	 * @return FirstFUSurgeryNotes - varchar(80)
	 */
	public function getFirstFUSurgeryNotes(){
		return $this->FirstFUSurgeryNotes;
	}

	/**
	 * @return SecondFU - tinyint(3)
	 */
	public function getSecondFU(){
		return $this->SecondFU;
	}

	/**
	 * @return SecondFUMonths - int(3)
	 */
	public function getSecondFUMonths(){
		return $this->SecondFUMonths;
	}

	/**
	 * @return SecondFUDate - date
	 */
	public function getSecondFUDate(){
		return $this->SecondFUDate;
	}

	/**
	 * @return SecondFURecurrence - int(3)
	 */
	public function getSecondFURecurrence(){
		return $this->SecondFURecurrence;
	}

	/**
	 * @return SecondFUNoRecurScarBx - int(2)
	 */
	public function getSecondFUNoRecurScarBx(){
		return $this->SecondFUNoRecurScarBx;
	}

	/**
	 * @return SecondFURecurrenceLargest - int(2)
	 */
	public function getSecondFURecurrenceLargest(){
		return $this->SecondFURecurrenceLargest;
	}

	/**
	 * @return SecondFURecurrenceLocation - int(2)
	 */
	public function getSecondFURecurrenceLocation(){
		return $this->SecondFURecurrenceLocation;
	}

	/**
	 * @return SecondFURecurrenceSites - int(2)
	 */
	public function getSecondFURecurrenceSites(){
		return $this->SecondFURecurrenceSites;
	}

	/**
	 * @return SecondFUDisposition - int(2)
	 */
	public function getSecondFUDisposition(){
		return $this->SecondFUDisposition;
	}

	/**
	 * @return SecondFURecurrenceRx - tinyint(3)
	 */
	public function getSecondFURecurrenceRx(){
		return $this->SecondFURecurrenceRx;
	}

	/**
	 * @return SecondFURecurrenceExcision - tinyint(3)
	 */
	public function getSecondFURecurrenceExcision(){
		return $this->SecondFURecurrenceExcision;
	}

	/**
	 * @return SecondFURecurrenceNotes - varchar(80)
	 */
	public function getSecondFURecurrenceNotes(){
		return $this->SecondFURecurrenceNotes;
	}

	/**
	 * @return SecondFURecurHistoDysplasia - tinyint(3)
	 */
	public function getSecondFURecurHistoDysplasia(){
		return $this->SecondFURecurHistoDysplasia;
	}

	/**
	 * @return SecondFUNextColon_Mths - tinyint(3)
	 */
	public function getSecondFUNextColon_Mths(){
		return $this->SecondFUNextColon_Mths;
	}

	/**
	 * @return SecondFUOutcome - tinyint(3)
	 */
	public function getSecondFUOutcome(){
		return $this->SecondFUOutcome;
	}

	/**
	 * @return SecondFUSurgery - int(2)
	 */
	public function getSecondFUSurgery(){
		return $this->SecondFUSurgery;
	}

	/**
	 * @return SecondFUSurgeryNotes - varchar(80)
	 */
	public function getSecondFUSurgeryNotes(){
		return $this->SecondFUSurgeryNotes;
	}

	/**
	 * @return SecondFURecurHisto - int(2)
	 */
	public function getSecondFURecurHisto(){
		return $this->SecondFURecurHisto;
	}

	/**
	 * @return SecondFUSurgeryMethod - int(2)
	 */
	public function getSecondFUSurgeryMethod(){
		return $this->SecondFUSurgeryMethod;
	}

	/**
	 * @return SecondFUSurgeryResidual - int(2)
	 */
	public function getSecondFUSurgeryResidual(){
		return $this->SecondFUSurgeryResidual;
	}

	/**
	 * @return SecondFUSurgeryType - int(2)
	 */
	public function getSecondFUSurgeryType(){
		return $this->SecondFUSurgeryType;
	}

	/**
	 * @return ThirdFU - int(2)
	 */
	public function getThirdFU(){
		return $this->ThirdFU;
	}

	/**
	 * @return ThirdFUDate - date
	 */
	public function getThirdFUDate(){
		return $this->ThirdFUDate;
	}

	/**
	 * @return ThirdFUMonths - tinyint(3)
	 */
	public function getThirdFUMonths(){
		return $this->ThirdFUMonths;
	}

	/**
	 * @return ThirdFUDisposition - int(2)
	 */
	public function getThirdFUDisposition(){
		return $this->ThirdFUDisposition;
	}

	/**
	 * @return ThirdFUNoRecurScarBx - int(2)
	 */
	public function getThirdFUNoRecurScarBx(){
		return $this->ThirdFUNoRecurScarBx;
	}

	/**
	 * @return ThirdFUOutcome - int(2)
	 */
	public function getThirdFUOutcome(){
		return $this->ThirdFUOutcome;
	}

	/**
	 * @return ThirdFUPostSurgery - int(2)
	 */
	public function getThirdFUPostSurgery(){
		return $this->ThirdFUPostSurgery;
	}

	/**
	 * @return ThirdFURecurHisto - int(2)
	 */
	public function getThirdFURecurHisto(){
		return $this->ThirdFURecurHisto;
	}

	/**
	 * @return ThirdFURecurrence - int(2)
	 */
	public function getThirdFURecurrence(){
		return $this->ThirdFURecurrence;
	}

	/**
	 * @return ThirdFURecurrenceExcision - int(2)
	 */
	public function getThirdFURecurrenceExcision(){
		return $this->ThirdFURecurrenceExcision;
	}

	/**
	 * @return ThirdFURecurrenceRx - int(2)
	 */
	public function getThirdFURecurrenceRx(){
		return $this->ThirdFURecurrenceRx;
	}

	/**
	 * @return ThirdFURecurrenceSites - int(2)
	 */
	public function getThirdFURecurrenceSites(){
		return $this->ThirdFURecurrenceSites;
	}

	/**
	 * @return ThirdFURecurrenceLocation - tinyint(3)
	 */
	public function getThirdFURecurrenceLocation(){
		return $this->ThirdFURecurrenceLocation;
	}

	/**
	 * @return ThirdFURecurrenceLargest - tinyint(3)
	 */
	public function getThirdFURecurrenceLargest(){
		return $this->ThirdFURecurrenceLargest;
	}

	/**
	 * @return ThirdFURecurrenceNotes - varchar(80)
	 */
	public function getThirdFURecurrenceNotes(){
		return $this->ThirdFURecurrenceNotes;
	}

	/**
	 * @return ThirdFURecurHistoDysplasia - tinyint(3)
	 */
	public function getThirdFURecurHistoDysplasia(){
		return $this->ThirdFURecurHistoDysplasia;
	}

	/**
	 * @return ThirdFUNextColon_Mths - tinyint(3)
	 */
	public function getThirdFUNextColon_Mths(){
		return $this->ThirdFUNextColon_Mths;
	}

	/**
	 * @return ThirdFUSurgeryNotes - varchar(80)
	 */
	public function getThirdFUSurgeryNotes(){
		return $this->ThirdFUSurgeryNotes;
	}

	/**
	 * @return ThirdFUSurgeryMethod - int(2)
	 */
	public function getThirdFUSurgeryMethod(){
		return $this->ThirdFUSurgeryMethod;
	}

	/**
	 * @return ThirdFUSurgeryResidual - int(2)
	 */
	public function getThirdFUSurgeryResidual(){
		return $this->ThirdFUSurgeryResidual;
	}

	/**
	 * @return ThirdFUSurgeryType - int(2)
	 */
	public function getThirdFUSurgeryType(){
		return $this->ThirdFUSurgeryType;
	}

	/**
	 * @return FourthFU - int(2)
	 */
	public function getFourthFU(){
		return $this->FourthFU;
	}

	/**
	 * @return FourthFUMonths - tinyint(3)
	 */
	public function getFourthFUMonths(){
		return $this->FourthFUMonths;
	}

	/**
	 * @return FourthFURecurrenceLocation - tinyint(3)
	 */
	public function getFourthFURecurrenceLocation(){
		return $this->FourthFURecurrenceLocation;
	}

	/**
	 * @return FourthFURecurrenceLargest - tinyint(3)
	 */
	public function getFourthFURecurrenceLargest(){
		return $this->FourthFURecurrenceLargest;
	}

	/**
	 * @return FourthFURecurrenceNotes - varchar(80)
	 */
	public function getFourthFURecurrenceNotes(){
		return $this->FourthFURecurrenceNotes;
	}

	/**
	 * @return FourthFURecurHistoDysplasia - tinyint(3)
	 */
	public function getFourthFURecurHistoDysplasia(){
		return $this->FourthFURecurHistoDysplasia;
	}

	/**
	 * @return FourthFUNextColon_Mnths - tinyint(3)
	 */
	public function getFourthFUNextColon_Mnths(){
		return $this->FourthFUNextColon_Mnths;
	}

	/**
	 * @return FourthFUSurgeryResidual - tinyint(3)
	 */
	public function getFourthFUSurgeryResidual(){
		return $this->FourthFUSurgeryResidual;
	}

	/**
	 * @return FourthFUDate - date
	 */
	public function getFourthFUDate(){
		return $this->FourthFUDate;
	}

	/**
	 * @return FourthFUDisposition - int(2)
	 */
	public function getFourthFUDisposition(){
		return $this->FourthFUDisposition;
	}

	/**
	 * @return FourthFUNoRecurScarBx - int(2)
	 */
	public function getFourthFUNoRecurScarBx(){
		return $this->FourthFUNoRecurScarBx;
	}

	/**
	 * @return FourthFUOutcome - int(2)
	 */
	public function getFourthFUOutcome(){
		return $this->FourthFUOutcome;
	}

	/**
	 * @return FourthFUPostSurgery - int(2)
	 */
	public function getFourthFUPostSurgery(){
		return $this->FourthFUPostSurgery;
	}

	/**
	 * @return FourthFURecurHisto - int(2)
	 */
	public function getFourthFURecurHisto(){
		return $this->FourthFURecurHisto;
	}

	/**
	 * @return FourthFURecurrence - int(2)
	 */
	public function getFourthFURecurrence(){
		return $this->FourthFURecurrence;
	}

	/**
	 * @return FourthFURecurrenceExcision - int(2)
	 */
	public function getFourthFURecurrenceExcision(){
		return $this->FourthFURecurrenceExcision;
	}

	/**
	 * @return FourthFURecurrenceRx - int(2)
	 */
	public function getFourthFURecurrenceRx(){
		return $this->FourthFURecurrenceRx;
	}

	/**
	 * @return FourthFURecurrenceSites - int(2)
	 */
	public function getFourthFURecurrenceSites(){
		return $this->FourthFURecurrenceSites;
	}

	/**
	 * @return FourthFUSurgeryMethod - int(2)
	 */
	public function getFourthFUSurgeryMethod(){
		return $this->FourthFUSurgeryMethod;
	}

	/**
	 * @return FourthFUSurgeryNotes - int(2)
	 */
	public function getFourthFUSurgeryNotes(){
		return $this->FourthFUSurgeryNotes;
	}

	/**
	 * @return FourthFUSurgeryType - int(2)
	 */
	public function getFourthFUSurgeryType(){
		return $this->FourthFUSurgeryType;
	}

	/**
	 * @return ClinSignificantBleedYN - int(2)
	 */
	public function getClinSignificantBleedYN(){
		return $this->ClinSignificantBleedYN;
	}

	/**
	 * @return ClinSignificantPerfYN - int(2)
	 */
	public function getClinSignificantPerfYN(){
		return $this->ClinSignificantPerfYN;
	}

	/**
	 * @return SSACharact_Dysplasia - int(2)
	 */
	public function getSSACharact_Dysplasia(){
		return $this->SSACharact_Dysplasia;
	}

	/**
	 * @return SSACharact_Dysplasia_Confidence - tinyint(2)
	 */
	public function getSSACharact_Dysplasia_Confidence(){
		return $this->SSACharact_Dysplasia_Confidence;
	}

	/**
	 * @return IPPerforation_Clips - int(2)
	 */
	public function getIPPerforation_Clips(){
		return $this->IPPerforation_Clips;
	}

	/**
	 * @return NICE_Overall - int(2)
	 */
	public function getNICE_Overall(){
		return $this->NICE_Overall;
	}

	/**
	 * @return FirstFURecurrenceClipArtifact - int(2)
	 */
	public function getFirstFURecurrenceClipArtifact(){
		return $this->FirstFURecurrenceClipArtifact;
	}

	/**
	 * @return SecondFURecurrenceClipArtifact - int(2)
	 */
	public function getSecondFURecurrenceClipArtifact(){
		return $this->SecondFURecurrenceClipArtifact;
	}

	/**
	 * @return ThirdFURecurrenceClipArtifact - int(2)
	 */
	public function getThirdFURecurrenceClipArtifact(){
		return $this->ThirdFURecurrenceClipArtifact;
	}

	/**
	 * @return FourthFURecurrenceClipArtifact - int(2)
	 */
	public function getFourthFURecurrenceClipArtifact(){
		return $this->FourthFURecurrenceClipArtifact;
	}

	/**
	 * @return ESD_enBloc - int(10)
	 */
	public function getESD_enBloc(){
		return $this->ESD_enBloc;
	}

	/**
	 * @return SERT_size - int(2)
	 */
	public function getSERT_size(){
		return $this->SERT_size;
	}

	/**
	 * @return SERT_ipb - int(2)
	 */
	public function getSERT_ipb(){
		return $this->SERT_ipb;
	}

	/**
	 * @return SERT_dysplasia - int(2)
	 */
	public function getSERT_dysplasia(){
		return $this->SERT_dysplasia;
	}

	/**
	 * @return created - timestamp
	 */
	public function getcreated(){
		return $this->created;
	}

	/**
	 * @return creating_user - int(10)
	 */
	public function getcreating_user(){
		return $this->creating_user;
	}

	/**
	 * @return updated - timestamp(6)
	 */
	public function getupdated(){
		return $this->updated;
	}

	/**
	 * @return updating_user - int(10)
	 */
	public function getupdating_user(){
		return $this->updating_user;
	}

	/**
	 * @return entrytype - int(2)
	 */
	public function getentrytype(){
		return $this->entrytype;
	}

	/**
	 * @return save - int(10)
	 */
	public function getsave(){
		return $this->save;
	}

	/**
	 * @return consent_PROSPER - int(2)
	 */
	public function getconsent_PROSPER(){
		return $this->consent_PROSPER;
	}

	/**
	 * @return inPROSPER - int(2)
	 */
	public function getinPROSPER(){
		return $this->inPROSPER;
	}

	/**
	 * @return SERT - int(2)
	 */
	public function getSERT(){
		return $this->SERT;
	}

	/**
	 * @return completeColon_PROSPER - int(3)
	 */
	public function getcompleteColon_PROSPER(){
		return $this->completeColon_PROSPER;
	}

	/**
	 * @return defectTattoo_PROSPER - int(3)
	 */
	public function getdefectTattoo_PROSPER(){
		return $this->defectTattoo_PROSPER;
	}

	/**
	 * @return dateEnrolled_PROSPER - date
	 */
	public function getdateEnrolled_PROSPER(){
		return $this->dateEnrolled_PROSPER;
	}

	/**
	 * @return variation_PROSPER - varchar(8000)
	 */
	public function getvariation_PROSPER(){
		return $this->variation_PROSPER;
	}

	/**
	 * @return CLIP_consent - int(2)
	 */
	public function getCLIP_consent(){
		return $this->CLIP_consent;
	}

	/**
	 * @return CLIP_preEMRexclusion - varchar(100)
	 */
	public function getCLIP_preEMRexclusion(){
		return $this->CLIP_preEMRexclusion;
	}

	/**
	 * @return CLIP_postEMRexclusion - varchar(100)
	 */
	public function getCLIP_postEMRexclusion(){
		return $this->CLIP_postEMRexclusion;
	}

	/**
	 * @return CLIP_randomisation - int(2)
	 */
	public function getCLIP_randomisation(){
		return $this->CLIP_randomisation;
	}

	/**
	 * @return CLIP_category - int(2)
	 */
	public function getCLIP_category(){
		return $this->CLIP_category;
	}

	/**
	 * @return CLIP_active_closure_complete - int(2)
	 */
	public function getCLIP_active_closure_complete(){
		return $this->CLIP_active_closure_complete;
	}

	/**
	 * @return CLIP_active_closure_number - int(2)
	 */
	public function getCLIP_active_closure_number(){
		return $this->CLIP_active_closure_number;
	}

	/**
	 * @return CLIP_no_closure_reason - varchar(80)
	 */
	public function getCLIP_no_closure_reason(){
		return $this->CLIP_no_closure_reason;
	}

	/**
	 * @return CLIP_doppler - int(2)
	 */
	public function getCLIP_doppler(){
		return $this->CLIP_doppler;
	}

	/**
	 * @return CLIP_doppler_signal - int(2)
	 */
	public function getCLIP_doppler_signal(){
		return $this->CLIP_doppler_signal;
	}

	/**
	 * @return CLIP_doppler_signal_location - int(2)
	 */
	public function getCLIP_doppler_signal_location(){
		return $this->CLIP_doppler_signal_location;
	}

	/**
	 * @return CLIP_doppler_signal_area_clipped - int(2)
	 */
	public function getCLIP_doppler_signal_area_clipped(){
		return $this->CLIP_doppler_signal_area_clipped;
	}

	/**
	 * @return CLIP_notes - varchar(8000)
	 */
	public function getCLIP_notes(){
		return $this->CLIP_notes;
	}

	/**
	 * @return SMSA - int(3)
	 */
	public function getSMSA(){
		return $this->SMSA;
	}

	/**
	 * @return preLesionID - int(20)
	 */
	public function getpreLesionID(){
		return $this->preLesionID;
	}

	/**
	 * @param Type: int(10)
	 */
	public function set_k_lesion($_k_lesion){
		$this->_k_lesion = $_k_lesion;
	}

	/**
	 * @param Type: int(7)
	 */
	public function set_k_procedure($_k_procedure){
		$this->_k_procedure = $_k_procedure;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setPreviousAttempt($PreviousAttempt){
		$this->PreviousAttempt = $PreviousAttempt;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setPreviousBiopsy($PreviousBiopsy){
		$this->PreviousBiopsy = $PreviousBiopsy;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setPreviousSPOT($PreviousSPOT){
		$this->PreviousSPOT = $PreviousSPOT;
	}

	/**
	 * @param Type: int(4)
	 */
	public function setSize($Size){
		$this->Size = $Size;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setLocation($Location){
		$this->Location = $Location;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setParis($Paris){
		$this->Paris = $Paris;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setMorphology($Morphology){
		$this->Morphology = $Morphology;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setHighestKudo($HighestKudo){
		$this->HighestKudo = $HighestKudo;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setHighestSano($HighestSano){
		$this->HighestSano = $HighestSano;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setPredict_Cancer($Predict_Cancer){
		$this->Predict_Cancer = $Predict_Cancer;
	}

	/**
	 * @param Type: tinyint(2)
	 */
	public function setPredict_Histo($Predict_Histo){
		$this->Predict_Histo = $Predict_Histo;
	}

	/**
	 * @param Type: tinyint(2)
	 */
	public function setPredict_Histo_Confidence($Predict_Histo_Confidence){
		$this->Predict_Histo_Confidence = $Predict_Histo_Confidence;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFeat_Invasion($Feat_Invasion){
		$this->Feat_Invasion = $Feat_Invasion;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setEnBloc($EnBloc){
		$this->EnBloc = $EnBloc;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setAccess($Access){
		$this->Access = $Access;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setEMRAttempted($EMRAttempted){
		$this->EMRAttempted = $EMRAttempted;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSMInjection($SMInjection){
		$this->SMInjection = $SMInjection;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setConstituent($Constituent){
		$this->Constituent = $Constituent;
	}

	/**
	 * @param Type: tinyint(2)
	 */
	public function setConstituent_other($Constituent_other){
		$this->Constituent_other = $Constituent_other;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setAdrenaline($Adrenaline){
		$this->Adrenaline = $Adrenaline;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setDye($Dye){
		$this->Dye = $Dye;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setNo_Injection($No_Injection){
		$this->No_Injection = $No_Injection;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setLifting($Lifting){
		$this->Lifting = $Lifting;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSnareType($SnareType){
		$this->SnareType = $SnareType;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSnareSize($SnareSize){
		$this->SnareSize = $SnareSize;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setCurrent($Current){
		$this->Current = $Current;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setNo_Pieces($No_Pieces){
		$this->No_Pieces = $No_Pieces;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSnareExcision($SnareExcision){
		$this->SnareExcision = $SnareExcision;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setAddModality($AddModality){
		$this->AddModality = $AddModality;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSuccessfulEMR($SuccessfulEMR){
		$this->SuccessfulEMR = $SuccessfulEMR;
	}

	/**
	 * @param Type: tinyint(2)
	 */
	public function setSTSC_Margin($STSC_Margin){
		$this->STSC_Margin = $STSC_Margin;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSCAR_complete($SCAR_complete){
		$this->SCAR_complete = $SCAR_complete;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setBookTwoStage($BookTwoStage){
		$this->BookTwoStage = $BookTwoStage;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setIPBleed($IPBleed){
		$this->IPBleed = $IPBleed;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setIPBleed_Control($IPBleed_Control){
		$this->IPBleed_Control = $IPBleed_Control;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSMF($SMF){
		$this->SMF = $SMF;
	}

	/**
	 * @param Type: tinyint(2)
	 */
	public function setDeepInjury($DeepInjury){
		$this->DeepInjury = $DeepInjury;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setIPPerforation($IPPerforation){
		$this->IPPerforation = $IPPerforation;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setIPPerforation_Rx($IPPerforation_Rx){
		$this->IPPerforation_Rx = $IPPerforation_Rx;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setDefect_Clip_Closure($Defect_Clip_Closure){
		$this->Defect_Clip_Closure = $Defect_Clip_Closure;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setDefect_Clip_Closure_Number($Defect_Clip_Closure_Number){
		$this->Defect_Clip_Closure_Number = $Defect_Clip_Closure_Number;
	}

	/**
	 * @param Type: int(5)
	 */
	public function setDuration($Duration){
		$this->Duration = $Duration;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setHistoPathMajor($HistoPathMajor){
		$this->HistoPathMajor = $HistoPathMajor;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setCancer($Cancer){
		$this->Cancer = $Cancer;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setDysplasia($Dysplasia){
		$this->Dysplasia = $Dysplasia;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSMInvasion($SMInvasion){
		$this->SMInvasion = $SMInvasion;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setMargins($Margins){
		$this->Margins = $Margins;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSpecimenSize($SpecimenSize){
		$this->SpecimenSize = $SpecimenSize;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setDelayedBleed($DelayedBleed){
		$this->DelayedBleed = $DelayedBleed;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setDelayedBleed_Admit($DelayedBleed_Admit){
		$this->DelayedBleed_Admit = $DelayedBleed_Admit;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setDelayedBleed_Colon($DelayedBleed_Colon){
		$this->DelayedBleed_Colon = $DelayedBleed_Colon;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setDelayedPerforation($DelayedPerforation){
		$this->DelayedPerforation = $DelayedPerforation;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setDelayedPerforation_Rx($DelayedPerforation_Rx){
		$this->DelayedPerforation_Rx = $DelayedPerforation_Rx;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setDisposition2Weeks($Disposition2Weeks){
		$this->Disposition2Weeks = $Disposition2Weeks;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFollowUp2Weeks($FollowUp2Weeks){
		$this->FollowUp2Weeks = $FollowUp2Weeks;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSurgReferral($SurgReferral){
		$this->SurgReferral = $SurgReferral;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFirstFU($FirstFU){
		$this->FirstFU = $FirstFU;
	}

	/**
	 * @param Type: tinyint(4)
	 */
	public function setFirstFUMonths($FirstFUMonths){
		$this->FirstFUMonths = $FirstFUMonths;
	}

	/**
	 * @param Type: date
	 */
	public function setFirstFUDate($FirstFUDate){
		$this->FirstFUDate = $FirstFUDate;
	}

	/**
	 * @param Type: tinyint(4)
	 */
	public function setFirstFURecurrence($FirstFURecurrence){
		$this->FirstFURecurrence = $FirstFURecurrence;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setFirstFUNoRecurScarBx($FirstFUNoRecurScarBx){
		$this->FirstFUNoRecurScarBx = $FirstFUNoRecurScarBx;
	}

	/**
	 * @param Type: tinyint(4)
	 */
	public function setFirstFURecurrenceSites($FirstFURecurrenceSites){
		$this->FirstFURecurrenceSites = $FirstFURecurrenceSites;
	}

	/**
	 * @param Type: tinyint(4)
	 */
	public function setFirstFURecurrenceLocation($FirstFURecurrenceLocation){
		$this->FirstFURecurrenceLocation = $FirstFURecurrenceLocation;
	}

	/**
	 * @param Type: tinyint(4)
	 */
	public function setFirstFURecurrenceLargest($FirstFURecurrenceLargest){
		$this->FirstFURecurrenceLargest = $FirstFURecurrenceLargest;
	}

	/**
	 * @param Type: tinyint(4)
	 */
	public function setFirstFURecurrenceRx($FirstFURecurrenceRx){
		$this->FirstFURecurrenceRx = $FirstFURecurrenceRx;
	}

	/**
	 * @param Type: tinyint(4)
	 */
	public function setFirstFURecurrenceExcision($FirstFURecurrenceExcision){
		$this->FirstFURecurrenceExcision = $FirstFURecurrenceExcision;
	}

	/**
	 * @param Type: varchar(80)
	 */
	public function setFirstFURecurrenceNotes($FirstFURecurrenceNotes){
		$this->FirstFURecurrenceNotes = $FirstFURecurrenceNotes;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFirstFURecurHisto($FirstFURecurHisto){
		$this->FirstFURecurHisto = $FirstFURecurHisto;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFirstFURecurHistoDysplasia($FirstFURecurHistoDysplasia){
		$this->FirstFURecurHistoDysplasia = $FirstFURecurHistoDysplasia;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFirstFUNextColon_Mths($FirstFUNextColon_Mths){
		$this->FirstFUNextColon_Mths = $FirstFUNextColon_Mths;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFirstFUOutcome($FirstFUOutcome){
		$this->FirstFUOutcome = $FirstFUOutcome;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFirstFUDisposition($FirstFUDisposition){
		$this->FirstFUDisposition = $FirstFUDisposition;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setFirstFUSurgery($FirstFUSurgery){
		$this->FirstFUSurgery = $FirstFUSurgery;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFirstFUSurgeryMethod($FirstFUSurgeryMethod){
		$this->FirstFUSurgeryMethod = $FirstFUSurgeryMethod;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFirstFUSurgeryResidual($FirstFUSurgeryResidual){
		$this->FirstFUSurgeryResidual = $FirstFUSurgeryResidual;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFirstFUSurgeryType($FirstFUSurgeryType){
		$this->FirstFUSurgeryType = $FirstFUSurgeryType;
	}

	/**
	 * @param Type: varchar(80)
	 */
	public function setFirstFUSurgeryNotes($FirstFUSurgeryNotes){
		$this->FirstFUSurgeryNotes = $FirstFUSurgeryNotes;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setSecondFU($SecondFU){
		$this->SecondFU = $SecondFU;
	}

	/**
	 * @param Type: int(3)
	 */
	public function setSecondFUMonths($SecondFUMonths){
		$this->SecondFUMonths = $SecondFUMonths;
	}

	/**
	 * @param Type: date
	 */
	public function setSecondFUDate($SecondFUDate){
		$this->SecondFUDate = $SecondFUDate;
	}

	/**
	 * @param Type: int(3)
	 */
	public function setSecondFURecurrence($SecondFURecurrence){
		$this->SecondFURecurrence = $SecondFURecurrence;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSecondFUNoRecurScarBx($SecondFUNoRecurScarBx){
		$this->SecondFUNoRecurScarBx = $SecondFUNoRecurScarBx;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSecondFURecurrenceLargest($SecondFURecurrenceLargest){
		$this->SecondFURecurrenceLargest = $SecondFURecurrenceLargest;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSecondFURecurrenceLocation($SecondFURecurrenceLocation){
		$this->SecondFURecurrenceLocation = $SecondFURecurrenceLocation;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSecondFURecurrenceSites($SecondFURecurrenceSites){
		$this->SecondFURecurrenceSites = $SecondFURecurrenceSites;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSecondFUDisposition($SecondFUDisposition){
		$this->SecondFUDisposition = $SecondFUDisposition;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setSecondFURecurrenceRx($SecondFURecurrenceRx){
		$this->SecondFURecurrenceRx = $SecondFURecurrenceRx;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setSecondFURecurrenceExcision($SecondFURecurrenceExcision){
		$this->SecondFURecurrenceExcision = $SecondFURecurrenceExcision;
	}

	/**
	 * @param Type: varchar(80)
	 */
	public function setSecondFURecurrenceNotes($SecondFURecurrenceNotes){
		$this->SecondFURecurrenceNotes = $SecondFURecurrenceNotes;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setSecondFURecurHistoDysplasia($SecondFURecurHistoDysplasia){
		$this->SecondFURecurHistoDysplasia = $SecondFURecurHistoDysplasia;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setSecondFUNextColon_Mths($SecondFUNextColon_Mths){
		$this->SecondFUNextColon_Mths = $SecondFUNextColon_Mths;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setSecondFUOutcome($SecondFUOutcome){
		$this->SecondFUOutcome = $SecondFUOutcome;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSecondFUSurgery($SecondFUSurgery){
		$this->SecondFUSurgery = $SecondFUSurgery;
	}

	/**
	 * @param Type: varchar(80)
	 */
	public function setSecondFUSurgeryNotes($SecondFUSurgeryNotes){
		$this->SecondFUSurgeryNotes = $SecondFUSurgeryNotes;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSecondFURecurHisto($SecondFURecurHisto){
		$this->SecondFURecurHisto = $SecondFURecurHisto;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSecondFUSurgeryMethod($SecondFUSurgeryMethod){
		$this->SecondFUSurgeryMethod = $SecondFUSurgeryMethod;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSecondFUSurgeryResidual($SecondFUSurgeryResidual){
		$this->SecondFUSurgeryResidual = $SecondFUSurgeryResidual;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSecondFUSurgeryType($SecondFUSurgeryType){
		$this->SecondFUSurgeryType = $SecondFUSurgeryType;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setThirdFU($ThirdFU){
		$this->ThirdFU = $ThirdFU;
	}

	/**
	 * @param Type: date
	 */
	public function setThirdFUDate($ThirdFUDate){
		$this->ThirdFUDate = $ThirdFUDate;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setThirdFUMonths($ThirdFUMonths){
		$this->ThirdFUMonths = $ThirdFUMonths;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setThirdFUDisposition($ThirdFUDisposition){
		$this->ThirdFUDisposition = $ThirdFUDisposition;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setThirdFUNoRecurScarBx($ThirdFUNoRecurScarBx){
		$this->ThirdFUNoRecurScarBx = $ThirdFUNoRecurScarBx;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setThirdFUOutcome($ThirdFUOutcome){
		$this->ThirdFUOutcome = $ThirdFUOutcome;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setThirdFUPostSurgery($ThirdFUPostSurgery){
		$this->ThirdFUPostSurgery = $ThirdFUPostSurgery;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setThirdFURecurHisto($ThirdFURecurHisto){
		$this->ThirdFURecurHisto = $ThirdFURecurHisto;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setThirdFURecurrence($ThirdFURecurrence){
		$this->ThirdFURecurrence = $ThirdFURecurrence;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setThirdFURecurrenceExcision($ThirdFURecurrenceExcision){
		$this->ThirdFURecurrenceExcision = $ThirdFURecurrenceExcision;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setThirdFURecurrenceRx($ThirdFURecurrenceRx){
		$this->ThirdFURecurrenceRx = $ThirdFURecurrenceRx;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setThirdFURecurrenceSites($ThirdFURecurrenceSites){
		$this->ThirdFURecurrenceSites = $ThirdFURecurrenceSites;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setThirdFURecurrenceLocation($ThirdFURecurrenceLocation){
		$this->ThirdFURecurrenceLocation = $ThirdFURecurrenceLocation;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setThirdFURecurrenceLargest($ThirdFURecurrenceLargest){
		$this->ThirdFURecurrenceLargest = $ThirdFURecurrenceLargest;
	}

	/**
	 * @param Type: varchar(80)
	 */
	public function setThirdFURecurrenceNotes($ThirdFURecurrenceNotes){
		$this->ThirdFURecurrenceNotes = $ThirdFURecurrenceNotes;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setThirdFURecurHistoDysplasia($ThirdFURecurHistoDysplasia){
		$this->ThirdFURecurHistoDysplasia = $ThirdFURecurHistoDysplasia;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setThirdFUNextColon_Mths($ThirdFUNextColon_Mths){
		$this->ThirdFUNextColon_Mths = $ThirdFUNextColon_Mths;
	}

	/**
	 * @param Type: varchar(80)
	 */
	public function setThirdFUSurgeryNotes($ThirdFUSurgeryNotes){
		$this->ThirdFUSurgeryNotes = $ThirdFUSurgeryNotes;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setThirdFUSurgeryMethod($ThirdFUSurgeryMethod){
		$this->ThirdFUSurgeryMethod = $ThirdFUSurgeryMethod;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setThirdFUSurgeryResidual($ThirdFUSurgeryResidual){
		$this->ThirdFUSurgeryResidual = $ThirdFUSurgeryResidual;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setThirdFUSurgeryType($ThirdFUSurgeryType){
		$this->ThirdFUSurgeryType = $ThirdFUSurgeryType;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFourthFU($FourthFU){
		$this->FourthFU = $FourthFU;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setFourthFUMonths($FourthFUMonths){
		$this->FourthFUMonths = $FourthFUMonths;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setFourthFURecurrenceLocation($FourthFURecurrenceLocation){
		$this->FourthFURecurrenceLocation = $FourthFURecurrenceLocation;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setFourthFURecurrenceLargest($FourthFURecurrenceLargest){
		$this->FourthFURecurrenceLargest = $FourthFURecurrenceLargest;
	}

	/**
	 * @param Type: varchar(80)
	 */
	public function setFourthFURecurrenceNotes($FourthFURecurrenceNotes){
		$this->FourthFURecurrenceNotes = $FourthFURecurrenceNotes;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setFourthFURecurHistoDysplasia($FourthFURecurHistoDysplasia){
		$this->FourthFURecurHistoDysplasia = $FourthFURecurHistoDysplasia;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setFourthFUNextColon_Mnths($FourthFUNextColon_Mnths){
		$this->FourthFUNextColon_Mnths = $FourthFUNextColon_Mnths;
	}

	/**
	 * @param Type: tinyint(3)
	 */
	public function setFourthFUSurgeryResidual($FourthFUSurgeryResidual){
		$this->FourthFUSurgeryResidual = $FourthFUSurgeryResidual;
	}

	/**
	 * @param Type: date
	 */
	public function setFourthFUDate($FourthFUDate){
		$this->FourthFUDate = $FourthFUDate;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFourthFUDisposition($FourthFUDisposition){
		$this->FourthFUDisposition = $FourthFUDisposition;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFourthFUNoRecurScarBx($FourthFUNoRecurScarBx){
		$this->FourthFUNoRecurScarBx = $FourthFUNoRecurScarBx;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFourthFUOutcome($FourthFUOutcome){
		$this->FourthFUOutcome = $FourthFUOutcome;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFourthFUPostSurgery($FourthFUPostSurgery){
		$this->FourthFUPostSurgery = $FourthFUPostSurgery;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFourthFURecurHisto($FourthFURecurHisto){
		$this->FourthFURecurHisto = $FourthFURecurHisto;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFourthFURecurrence($FourthFURecurrence){
		$this->FourthFURecurrence = $FourthFURecurrence;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFourthFURecurrenceExcision($FourthFURecurrenceExcision){
		$this->FourthFURecurrenceExcision = $FourthFURecurrenceExcision;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFourthFURecurrenceRx($FourthFURecurrenceRx){
		$this->FourthFURecurrenceRx = $FourthFURecurrenceRx;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFourthFURecurrenceSites($FourthFURecurrenceSites){
		$this->FourthFURecurrenceSites = $FourthFURecurrenceSites;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFourthFUSurgeryMethod($FourthFUSurgeryMethod){
		$this->FourthFUSurgeryMethod = $FourthFUSurgeryMethod;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFourthFUSurgeryNotes($FourthFUSurgeryNotes){
		$this->FourthFUSurgeryNotes = $FourthFUSurgeryNotes;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFourthFUSurgeryType($FourthFUSurgeryType){
		$this->FourthFUSurgeryType = $FourthFUSurgeryType;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setClinSignificantBleedYN($ClinSignificantBleedYN){
		$this->ClinSignificantBleedYN = $ClinSignificantBleedYN;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setClinSignificantPerfYN($ClinSignificantPerfYN){
		$this->ClinSignificantPerfYN = $ClinSignificantPerfYN;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSSACharact_Dysplasia($SSACharact_Dysplasia){
		$this->SSACharact_Dysplasia = $SSACharact_Dysplasia;
	}

	/**
	 * @param Type: tinyint(2)
	 */
	public function setSSACharact_Dysplasia_Confidence($SSACharact_Dysplasia_Confidence){
		$this->SSACharact_Dysplasia_Confidence = $SSACharact_Dysplasia_Confidence;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setIPPerforation_Clips($IPPerforation_Clips){
		$this->IPPerforation_Clips = $IPPerforation_Clips;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setNICE_Overall($NICE_Overall){
		$this->NICE_Overall = $NICE_Overall;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFirstFURecurrenceClipArtifact($FirstFURecurrenceClipArtifact){
		$this->FirstFURecurrenceClipArtifact = $FirstFURecurrenceClipArtifact;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSecondFURecurrenceClipArtifact($SecondFURecurrenceClipArtifact){
		$this->SecondFURecurrenceClipArtifact = $SecondFURecurrenceClipArtifact;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setThirdFURecurrenceClipArtifact($ThirdFURecurrenceClipArtifact){
		$this->ThirdFURecurrenceClipArtifact = $ThirdFURecurrenceClipArtifact;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setFourthFURecurrenceClipArtifact($FourthFURecurrenceClipArtifact){
		$this->FourthFURecurrenceClipArtifact = $FourthFURecurrenceClipArtifact;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setESD_enBloc($ESD_enBloc){
		$this->ESD_enBloc = $ESD_enBloc;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSERT_size($SERT_size){
		$this->SERT_size = $SERT_size;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSERT_ipb($SERT_ipb){
		$this->SERT_ipb = $SERT_ipb;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSERT_dysplasia($SERT_dysplasia){
		$this->SERT_dysplasia = $SERT_dysplasia;
	}

	/**
	 * @param Type: timestamp
	 */
	public function setcreated($created){
		$this->created = $created;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setcreating_user($creating_user){
		$this->creating_user = $creating_user;
	}

	/**
	 * @param Type: timestamp(6)
	 */
	public function setupdated($updated){
		$this->updated = $updated;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setupdating_user($updating_user){
		$this->updating_user = $updating_user;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setentrytype($entrytype){
		$this->entrytype = $entrytype;
	}

	/**
	 * @param Type: int(10)
	 */
	public function setsave($save){
		$this->save = $save;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setconsent_PROSPER($consent_PROSPER){
		$this->consent_PROSPER = $consent_PROSPER;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setinPROSPER($inPROSPER){
		$this->inPROSPER = $inPROSPER;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setSERT($SERT){
		$this->SERT = $SERT;
	}

	/**
	 * @param Type: int(3)
	 */
	public function setcompleteColon_PROSPER($completeColon_PROSPER){
		$this->completeColon_PROSPER = $completeColon_PROSPER;
	}

	/**
	 * @param Type: int(3)
	 */
	public function setdefectTattoo_PROSPER($defectTattoo_PROSPER){
		$this->defectTattoo_PROSPER = $defectTattoo_PROSPER;
	}

	/**
	 * @param Type: date
	 */
	public function setdateEnrolled_PROSPER($dateEnrolled_PROSPER){
		$this->dateEnrolled_PROSPER = $dateEnrolled_PROSPER;
	}

	/**
	 * @param Type: varchar(8000)
	 */
	public function setvariation_PROSPER($variation_PROSPER){
		$this->variation_PROSPER = $variation_PROSPER;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setCLIP_consent($CLIP_consent){
		$this->CLIP_consent = $CLIP_consent;
	}

	/**
	 * @param Type: varchar(100)
	 */
	public function setCLIP_preEMRexclusion($CLIP_preEMRexclusion){
		$this->CLIP_preEMRexclusion = $CLIP_preEMRexclusion;
	}

	/**
	 * @param Type: varchar(100)
	 */
	public function setCLIP_postEMRexclusion($CLIP_postEMRexclusion){
		$this->CLIP_postEMRexclusion = $CLIP_postEMRexclusion;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setCLIP_randomisation($CLIP_randomisation){
		$this->CLIP_randomisation = $CLIP_randomisation;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setCLIP_category($CLIP_category){
		$this->CLIP_category = $CLIP_category;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setCLIP_active_closure_complete($CLIP_active_closure_complete){
		$this->CLIP_active_closure_complete = $CLIP_active_closure_complete;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setCLIP_active_closure_number($CLIP_active_closure_number){
		$this->CLIP_active_closure_number = $CLIP_active_closure_number;
	}

	/**
	 * @param Type: varchar(80)
	 */
	public function setCLIP_no_closure_reason($CLIP_no_closure_reason){
		$this->CLIP_no_closure_reason = $CLIP_no_closure_reason;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setCLIP_doppler($CLIP_doppler){
		$this->CLIP_doppler = $CLIP_doppler;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setCLIP_doppler_signal($CLIP_doppler_signal){
		$this->CLIP_doppler_signal = $CLIP_doppler_signal;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setCLIP_doppler_signal_location($CLIP_doppler_signal_location){
		$this->CLIP_doppler_signal_location = $CLIP_doppler_signal_location;
	}

	/**
	 * @param Type: int(2)
	 */
	public function setCLIP_doppler_signal_area_clipped($CLIP_doppler_signal_area_clipped){
		$this->CLIP_doppler_signal_area_clipped = $CLIP_doppler_signal_area_clipped;
	}

	/**
	 * @param Type: varchar(8000)
	 */
	public function setCLIP_notes($CLIP_notes){
		$this->CLIP_notes = $CLIP_notes;
	}

	/**
	 * @param Type: int(3)
	 */
	public function setSMSA($SMSA){
		$this->SMSA = $SMSA;
	}

	/**
	 * @param Type: int(20)
	 */
	public function setpreLesionID($preLesionID){
		$this->preLesionID = $preLesionID;
	}

    /**
     * Close mysql connection
     */
	public function endLesion(){
		$this->connection->CloseMysql();
	}

}