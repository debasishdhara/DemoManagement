import { Component, OnInit } from '@angular/core';
import { AbstractControl, FormBuilder, FormControl, FormGroup, ValidationErrors, ValidatorFn, Validators } from '@angular/forms';

@Component({
  selector: 'app-jobdetails',
  templateUrl: './jobdetails.component.html',
  styleUrls: ['./jobdetails.component.scss']
})
export class JobdetailsComponent implements OnInit {
  isChecked:boolean;
  isLinear = true;

  firstFormGroup: FormGroup;
  secondFormGroup: FormGroup;
  maxagecheck:boolean=false;
  demoData:any = {
    jobtitleCtrl : "Software Developer",
    organizationnameCtrl : "Demo Company Private Limited",
    joblocationCtrl : "Kolkata",
    urlCtrl : "http://example.com",
    positionCtrl : 20,
    noOfOpeningCtrl : 55,
    interviewDateCtrl : new Date("3/27/2021"),
    salaryRangeCtrl : "4",
    jobDescriptionCtrl : "Laravel with Angular Development",
    servicetirmCtrl : "Nothing",

    minageCtrl : 18,
    maxageCtrl : 60,
    educationCtrl:"1",
    percentageCtrl:20,
    minexpCtrl:72,
    physicalcheckCtrl:"3",
    categoryCtrl:"2",
    genderCtrl:"2",
  };
  constructor(private _formBuilder: FormBuilder) {

  }

  ngOnInit() {
    this.firstFormGroup = this._formBuilder.group({
      jobtitleCtrl: new FormControl('', Validators.required),
      organizationnameCtrl: new FormControl('', Validators.required),
      joblocationCtrl: new FormControl('', Validators.required),
      urlCtrl:new FormControl(''),
      positionCtrl: new FormControl('', Validators.required),
      noOfOpeningCtrl: new FormControl('', Validators.required),
      interviewDateCtrl: new FormControl('', Validators.required),
      salaryRangeCtrl: new FormControl('', Validators.required),
      jobDescriptionCtrl: new FormControl('', Validators.required),
      servicetirmCtrl: new FormControl(''),
    });
    this.secondFormGroup = this._formBuilder.group({
      minageCtrl: new FormControl('', Validators.compose([Validators.required,JobdetailsComponent.minAgeValidator])),
      maxageCtrl: new FormControl('', Validators.compose([Validators.required,JobdetailsComponent.maxAgeValidator])),
      educationCtrl: new FormControl('', Validators.required),
      percentageCtrl: new FormControl(''),
      minexpCtrl: new FormControl(''),
      physicalcheckCtrl:new FormControl(''),
      categoryCtrl:new FormControl(''),
      genderCtrl:new FormControl(''),
    },{validator: this.ageConfirmation});

    this.setallvalue();

  }
  public hasfirstError = (controlName: string, errorName: string) =>{
    return this.firstFormGroup.controls[controlName].hasError(errorName);
  }
  public hassecoundError = (controlName: string, errorName: string) =>{
    return this.secondFormGroup.controls[controlName].hasError(errorName);
  }
  setallvalue(){

    this.firstFormGroup.controls['jobtitleCtrl'].setValue(this.demoData.jobtitleCtrl);
    this.firstFormGroup.controls['organizationnameCtrl'].setValue(this.demoData.organizationnameCtrl);
    this.firstFormGroup.controls['joblocationCtrl'].setValue(this.demoData.joblocationCtrl);
    this.firstFormGroup.controls['urlCtrl'].setValue(this.demoData.urlCtrl);
    this.firstFormGroup.controls['positionCtrl'].setValue(this.demoData.positionCtrl);
    this.firstFormGroup.controls['noOfOpeningCtrl'].setValue(this.demoData.noOfOpeningCtrl);
    this.firstFormGroup.controls['interviewDateCtrl'].setValue(this.demoData.interviewDateCtrl);
    this.firstFormGroup.controls['salaryRangeCtrl'].setValue(this.demoData.salaryRangeCtrl);
    this.firstFormGroup.controls['jobDescriptionCtrl'].setValue(this.demoData.jobDescriptionCtrl);
    this.firstFormGroup.controls['servicetirmCtrl'].setValue(this.demoData.servicetirmCtrl);

    this.secondFormGroup.controls['minageCtrl'].setValue(this.demoData.minageCtrl);
    this.secondFormGroup.controls['maxageCtrl'].setValue(this.demoData.maxageCtrl);
    this.secondFormGroup.controls['educationCtrl'].setValue(this.demoData.educationCtrl);
    this.secondFormGroup.controls['percentageCtrl'].setValue(this.demoData.percentageCtrl);
    this.secondFormGroup.controls['minexpCtrl'].setValue(this.demoData.minexpCtrl);
    this.secondFormGroup.controls['physicalcheckCtrl'].setValue(this.demoData.physicalcheckCtrl);
    this.secondFormGroup.controls['categoryCtrl'].setValue(this.demoData.categoryCtrl);
    this.secondFormGroup.controls['genderCtrl'].setValue(this.demoData.genderCtrl);

    this.isChecked=true;
  }

  saveDetails(){

  }

  ageConfirmation(c: AbstractControl): { invalid: boolean } {
      if (c.get('minageCtrl').value > c.get('maxageCtrl').value) {
          c.get('minageCtrl').markAsTouched({ onlySelf:true});
          c.get('maxageCtrl').markAsTouched({ onlySelf:true});
          return {invalid: true};
      }
  }

  static minAgeValidator: ValidatorFn = (ac): ValidationErrors => {
    if ( (+ ac.value < 18) || (+ ac.value > 60)) {
      return { tooOld: true }
    } else {
      null;
    }
  }

  static maxAgeValidator: ValidatorFn = (ac): ValidationErrors => {
    if ( (+ ac.value < 18) || (+ ac.value > 60) ) {
      return { tooOld: true }
    } else {
      null;
    }
  }


  static : ValidatorFn = (ac): ValidationErrors => {
    if ( + ac.value < 18 ) {
      return { tooOld: true }
    } else {
      null;
    }
  }
  public static minAgetoMaxAgeValidator(matchTo: any): (AbstractControl) => ValidationErrors | null {
    return (control: AbstractControl): ValidationErrors | null => {
      return !!control.parent &&
        !!control.parent.value &&
        control.value < control.parent.controls[matchTo].value
        ? null
        : { isMatching: false };
    };
  }

  public static maxAgetoMinAgeValidator(matchTo: any): (AbstractControl) => ValidationErrors | null {
    return (control: AbstractControl): ValidationErrors | null => {
      return !!control.parent &&
        !!control.parent.value &&
        control.value > control.parent.controls[matchTo].value
        ? null
        : { isMatching: false };
    };
  }
}
