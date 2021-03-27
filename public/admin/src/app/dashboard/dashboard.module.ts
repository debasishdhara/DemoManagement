import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { DashboardRoutingModule } from './dashboard-routing.module';
import { JobdetailsComponent } from './jobdetails/jobdetails.component';
import { MatrialModule } from '../matrial/matrial.module';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { ProgressSpinnerModule } from '../progress-spinner/progress-spinner.module';
import { ProgressSpinnerComponent } from '../progress-spinner/progress-spinner.component';


@NgModule({
  declarations: [JobdetailsComponent],
  imports: [
    CommonModule,
    DashboardRoutingModule,
    MatrialModule,
    ReactiveFormsModule,
    FormsModule,
    ProgressSpinnerModule
  ]
})
export class DashboardModule { }
