import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { TabsPage } from './tabs.page';


const routes: Routes = [
  {
    path: '',
    component: TabsPage,
    children: [
      {
        path: 'main',
        loadChildren: () => import('./main-tab/main-tab.module').then( m => m.MainTabPageModule)
      },
      {
        path: '',
        redirectTo: 'main',
        pathMatch: 'full'
      },
      {
        path: 'cocktail',
        loadChildren: () => import('./cocktail-tab/cocktail-tab.module').then( m => m.CocktailTabPageModule)
      },
      {
        path: 'secondary',
        loadChildren: () => import('./secondary-tab/secondary-tab.module').then( m => m.SecondaryTabPageModule)
      }
    ]
  },

];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class TabsPageRoutingModule {}
