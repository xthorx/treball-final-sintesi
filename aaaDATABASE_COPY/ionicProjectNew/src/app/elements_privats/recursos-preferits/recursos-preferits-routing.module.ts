import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { RecursosPreferitsPage } from './recursos-preferits.page';

const routes: Routes = [
  {
    path: '',
    component: RecursosPreferitsPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class RecursosPreferitsPageRoutingModule {}
