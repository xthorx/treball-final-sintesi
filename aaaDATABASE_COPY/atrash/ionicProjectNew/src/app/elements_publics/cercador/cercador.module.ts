import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { CercadorPageRoutingModule } from './cercador-routing.module';

import { CercadorPage } from './cercador.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    CercadorPageRoutingModule
  ],
  declarations: [CercadorPage]
})
export class CercadorPageModule {}
