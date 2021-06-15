import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { CocktailTabPage } from './cocktail-tab.page';

const routes: Routes = [
  {
    path: '',
    component: CocktailTabPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class CocktailTabPageRoutingModule {}
