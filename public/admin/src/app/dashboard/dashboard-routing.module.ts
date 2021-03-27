import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { JobdetailsComponent } from './jobdetails/jobdetails.component';

const routes: Routes = [
  {
    path: '',
    component: JobdetailsComponent
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class DashboardRoutingModule { }
