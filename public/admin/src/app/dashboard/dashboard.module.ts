import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { DashboardRoutingModule } from './dashboard-routing.module';
import { JobdetailsComponent } from './jobdetails/jobdetails.component';
import { MatrialModule } from '../matrial/matrial.module';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';


@NgModule({
  declarations: [JobdetailsComponent],
  imports: [
    CommonModule,
    DashboardRoutingModule,
    MatrialModule,
    ReactiveFormsModule,
    FormsModule
  ]
})
export class DashboardModule { }
