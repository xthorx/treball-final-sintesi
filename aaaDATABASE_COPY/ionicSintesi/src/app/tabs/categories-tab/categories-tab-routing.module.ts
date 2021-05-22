import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { CategoriesTabPage } from './categories-tab.page';

const routes: Routes = [
  {
    path: '',
    component: CategoriesTabPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class CategoriesTabPageRoutingModule {}
