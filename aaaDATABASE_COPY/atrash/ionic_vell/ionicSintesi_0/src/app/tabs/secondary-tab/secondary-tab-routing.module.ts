import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { SecondaryTabPage } from './secondary-tab.page';

const routes: Routes = [
  {
    path: '',
    component: SecondaryTabPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class SecondaryTabPageRoutingModule {}
