import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { CercadorPage } from './cercador.page';

const routes: Routes = [
  {
    path: '',
    component: CercadorPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class CercadorPageRoutingModule {}
