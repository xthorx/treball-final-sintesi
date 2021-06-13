import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';
import { RecursComponent } from './elements_publics/recurs/recurs.component';
import { LogoutComponent } from './elements_publics/logout/logout.component';

const routes: Routes = [
  {
    path: '',
    redirectTo: 'inici',
    pathMatch: 'full'
  },
  {
    path: 'inici',
    loadChildren: () => import('./elements_publics/inici/inici.module').then( m => m.IniciPageModule)
  },
  {
    path: 'recursos',
    loadChildren: () => import('./elements_publics/recursos/recursos.module').then( m => m.RecursosPageModule)
  },
  {
    path: 'cercador',
    loadChildren: () => import('./elements_publics/cercador/cercador.module').then( m => m.CercadorPageModule)
  },
  {
    path: 'categories',
    loadChildren: () => import('./elements_publics/categories/categories.module').then( m => m.CategoriesPageModule)
  },
  { path: 'recurs/:id', component: RecursComponent },
  { path: 'recurs/:id/:w', component: RecursComponent },
  {
    path: 'login',
    loadChildren: () => import('./elements_publics/login/login.module').then( m => m.LoginPageModule)
  },
  {
    path: 'recursos-preferits',
    loadChildren: () => import('./elements_privats/recursos-preferits/recursos-preferits.module').then( m => m.RecursosPreferitsPageModule)
  },
  { path: 'logout', component: LogoutComponent },
  {
    path: 'perfil',
    loadChildren: () => import('./elements_privats/perfil/perfil.module').then( m => m.PerfilPageModule)
  },

  
  
  
  
  
  
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule {}
