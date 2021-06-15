import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { RecursosPreferitsPageRoutingModule } from './recursos-preferits-routing.module';

import { RecursosPreferitsPage } from './recursos-preferits.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    RecursosPreferitsPageRoutingModule
  ],
  declarations: [RecursosPreferitsPage]
})
export class RecursosPreferitsPageModule {}
